<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        //$this->load->library('upload');
    }

    public function index()
    {
        
        $per_page = 5;

        
        $page_input = $this->input->get('page');

       
        $page = is_numeric($page_input) ? (int)$page_input : 1;

        $total_records = $this->product_model->count_products();

       
        $total_pages = ($total_records > 0)
            ? ceil($total_records / $per_page)
            : 1;

     
        $page = max($page, 1);
        $page = min($page, $total_pages);

        
        $offset = ($page - 1) * $per_page;

      
        $products = $this->product_model->get_products($per_page, $offset);

        
        $prev = max($page - 1, 1);
        $next = min($page + 1, $total_pages);

       
        $data = [
            'products'     => $products,
            'page'         => $page,
            'per_page'     => $per_page,
            'total_pages'  => $total_pages,
            'total_records'=> $total_records,
            'offset'       => $offset,
            'prev'         => $prev,
            'next'         => $next
        ];

        $this->load->view('admin/product_view', $data);
    }



    public function add_product()
{      //echo '<pre>';
//print_r($_POST);
//die;
       // image 
          $config =['upload_path'=>'./images/',
                  'allowed_types'=>'jpg|png',
                  'max_size'=>2048,
                  'encrypt_name'=>TRUE
                  ];

                  $this->load->library('upload', $config);

                  if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $path = 'images/' .$upload_data['file_name'];
                  }else
                  {
                    $data['upload_error']=$this->upload->display_errors();
                   return  $this->load->view('admin/add_product_view',$data);
                  }


    // success

   


   
    
$rules = [
    [
        'field' => 'name',
        'label' => 'Product Name',
        'rules' => 'required|regex_match[/^[a-zA-Z0-9 ]+$/]'
    ],
    [
        'field' => 'price',
        'label' => 'Product Price',
        'rules' => 'required|numeric'
    ],
    [
        'field' => 'sp',
        'label' => 'Selling Price',
        'rules' => 'required|numeric'
    ],
    
    [
        'field' => 'description',
        'label' => 'Description',
        'rules' => 'required'
    ]
];

     $this->form_validation->set_rules($rules);

     if ($this->form_validation->run() == FALSE) {

         $this->load->view('admin/add_product_view');

    } else {

       $data = [
    'name'        => $this->input->post('name', TRUE),
    'price'       => $this->input->post('price', TRUE),
    'sp'          => $this->input->post('sp', TRUE),
    'image'       => $path ,
    'description' => $this->input->post('description', TRUE)
];

        if ($this->product_model->insert_product($data)) {
            $this->session->set_flashdata('msg', 'Product inserted successfully');
            $this->session->set_flashdata('type', 'success');
        } else {
            $this->session->set_flashdata('msg', 'Insert failed');
            $this->session->set_flashdata('type', 'error');
        }

        redirect('admin/product_controller/add_product');
        exit;
    }


}

        public function delete($id)

        {
            if(($id==NULL )||!is_numeric($id))
                {
                    show_error('invalid id');
                }
                $this->product_model->delete_by_id($id);
                $this->session->set_flashdata('succcess','deleted');
                redirect('admin/product_controller');

        }
       public function edit($id)
{
    // validate ID
    if ($id == NULL || !is_numeric($id)) {
        show_error('Invalid ID');
    }

    // fetch existing record (NOT update)
    $data['product'] = $this->product_model->get_by_id($id);

    if (!$data['product']) {
        show_error('Product not found');
    }

    // load update form with previous values
    $this->load->view('admin/update_view', $data);
}

public function update($id)

{ // echo 'UPDATE METHOD HIT, ID = ' . $id;
//die;

    if ($id == NULL || !is_numeric($id)) {
        show_error('Invalid ID');
    }

    // get old record
    $product = $this->product_model->get_by_id($id);
    if (!$product) {
        show_error('Product not found');
    }

    // base data (text fields)
    $data = [
        'name'        => $this->input->post('name', TRUE),
        'price'       => $this->input->post('price', TRUE),
        'sp'          => $this->input->post('sp', TRUE),
        'description' => $this->input->post('description', TRUE),
    ];

    // 🔁 IMAGE IS OPTIONAL ON UPDATE
    if (!empty($_FILES['image']['name'])) {

        $config = [
            'upload_path'   => './images/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $data['upload_error'] = $this->upload->display_errors();
            $data['product'] = $product;
            return $this->load->view('admin/update_view', $data);
        }

        // upload success
        $upload_data = $this->upload->data();
        $new_path = 'images/' . $upload_data['file_name'];

        // delete old image
        if (!empty($product->image) && file_exists($product->image)) {
            unlink($product->image);
        }

        $data['image'] = $new_path;
    }

    // update DB
     $this->product_model->update_by_id($id, $data);
     $this->session->set_flashdata('msg', 'Product updated successfully');
     $this->session->set_flashdata('type', 'success');
    redirect('admin/product_controller');
}




}    

   
       


