<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function add($product_id)
    { 
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            $cart = [];
        }

        if (isset($cart[$product_id])) {
            $cart[$product_id] += 1;
        } else {
            $cart[$product_id] = 1;
        }

        $this->session->set_userdata('cart', $cart);

        redirect('user/cart/view');
    }

    public function view()
    {
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            $cart = [];
        }

        $data['cart'] = $cart;
        $this->load->view('user/cart_view', $data);
    }

    public function increase($product_id)
    {
        $cart = $this->session->userdata('cart');
        if (isset($cart[$product_id])) {
            $cart[$product_id]++;
        }
        $this->session->set_userdata('cart', $cart);
        redirect('user/cart/view');
    }

    public function decrease($product_id)
    {
        $cart = $this->session->userdata('cart');
        if (isset($cart[$product_id])) {
            $cart[$product_id]--;
            if ($cart[$product_id] <= 0) {
                unset($cart[$product_id]);
            }
        }
        $this->session->set_userdata('cart', $cart);
        redirect('user/cart/view');
    }

    public function remove($product_id)
    {
        $cart = $this->session->userdata('cart');
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }
        $this->session->set_userdata('cart', $cart);
        redirect('user/cart/view');
    }
}
