<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('My_pagination');
    }

   
    public function index($page = 1)
    {
        $total_rows = $this->product_model->count_products();
         $per_page = 10;
            $total_pages = ($total_rows > 0)
        ? ceil($total_rows / $per_page)
        : 1;

    
    if ($page < 1 || $page > $total_pages) {
        show_404();
        return;
    }

        $pagination = $this->my_pagination->paginate($total_rows, $page);

        $data['products'] = $this->product_model->get_products(
            $pagination['per_page'],
            $pagination['offset']
        );

        $data['pagination'] = $pagination;

        // add cart count for header link
        $cart = $this->session->userdata('cart');
        $data['cart_count'] = $cart ? array_sum($cart) : 0;

        $this->load->view('user/products_view', $data);
    }
}
