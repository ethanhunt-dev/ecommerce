<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->model('Regis_model');
    }

    public function index()
    {
        $this->load->view('user/login');
    }

    public function do_login()
    {
        $data = $this->input->post(NULL, TRUE);

        // Check empty
        if (empty($data['email']) || empty($data['password'])) {
            $this->session->set_flashdata('error', 'Email and password required');
            redirect('login');
        }

        $email    = $data['email'];
        $password = $data['password'];

        // Call model
        $user = $this->Regis_model->check_login($email, $password);

        if ($user) {
            // Login success → set session
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('user_email', $user->email);

            //  Redirect to previous page if exists
            $redirect_url = $this->session->userdata('redirect_url');
            if ($redirect_url) {
                $this->session->unset_userdata('redirect_url');
                redirect($redirect_url);
            } else {
                redirect('users/products'); // default page
            }

        } else {
            // Login failed
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
