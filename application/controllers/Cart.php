<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->library('session');
    }

    public function add($product_id)
    {
        // Example: get user id from session
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            redirect('login'); // or show error
        }

        $this->Cart_model->add_to_cart($user_id, $product_id);

        redirect('cart/view');
    }

    public function view()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            redirect('login');
        }

        $data['cart_items'] = $this->Cart_model->get_cart($user_id);

        $this->load->view('cart_view', $data);
    }

    public function remove($product_id)
    {
        $user_id = $this->session->userdata('user_id');

        if ($user_id) {
            $this->Cart_model->remove_item($user_id, $product_id);
        }

        redirect('cart/view');
    }
}
