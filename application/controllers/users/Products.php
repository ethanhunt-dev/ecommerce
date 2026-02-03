<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('My_pagination');
    }

    // 👇 MUST accept $page
    public function index($page = 1)
    {
        $total_rows = $this->Product_model->count_products();

        $pagination = $this->my_pagination->paginate($total_rows, $page);

        $data['products'] = $this->Product_model->get_products(
            $pagination['per_page'],
            $pagination['offset']
        );

        $data['pagination'] = $pagination;

        $this->load->view('user/products_view', $data);
    }
}
