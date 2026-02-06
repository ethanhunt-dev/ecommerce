<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Cart_model'); // only if you want to sync to DB
    }

    public function index()
    {
        // 1️⃣ If user NOT logged in → send to login
        if (!$this->session->userdata('user_id')) {
            // remember where to come back after login
            $this->session->set_userdata('redirect_url', 'checkout');
            redirect('login');
            return;
        }

        // 2️⃣ User is logged in here ✅

        // 3️⃣ OPTIONAL: Move session cart to DB cart
        $session_cart = $this->session->userdata('cart'); // array: product_id => qty

        if (!empty($session_cart)) {
            $user_id = $this->session->userdata('user_id');

            foreach ($session_cart as $product_id => $qty) {
                // Add each quantity to DB cart
                for ($i = 0; $i < $qty; $i++) {
                    $this->Cart_model->add($user_id, $product_id);
                }
            }

            // Clear session cart after syncing
            $this->session->unset_userdata('cart');
        }

        // 4️⃣ Now continue checkout page (for now just show message or load view)
        // Later you can load address/payment page here
        echo "User logged in. Cart ready. Continue checkout...";
        // Example:
        // $this->load->view('checkout_view');
    }
}
