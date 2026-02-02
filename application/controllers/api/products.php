<?php
defined('BASEPATH') OR  exit ('no direct access allowed');
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        header("Content-Type: application/json");    
        
     }

     public function index()
     {
        $products = $this->product_model->get_all_products();
        echo json_encode(
          [
            'status' => true,
            'data' => $products
          ]  
        );
     }



}