<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Regis_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $this->load->view('regis_view');
    }

    public function regis()
    {
        $validate = [
            [
                'field' => 'name',
                'label' => 'User Name',
                'rules' => 'required|trim|regex_match[/^[a-zA-Z0-9 ]+$/]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|trim|callback_email_check'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[4]|max_length[20]|trim'
            ]
        ];

        $this->form_validation->set_rules($validate);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('regis_view');
        } else {
            $data = $this->input->post(NULL, TRUE);

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            // Insert into DB
            if ($this->Regis_model->insert_data($data)) {
                $msg = "Registration successful! Please login.";
                $type = "success";
                $redirect = "login";
            } else {
                $msg = "Registration failed! Please try again.";
                $type = "error";
                $redirect = "register";
            }

            $this->session->set_flashdata($type, $msg);
            redirect($redirect);
        }
    }

    // Callback for email validation
    public function email_check($email)
    {
        if ($this->Regis_model->email_exists($email)) {
            $this->form_validation->set_message('email_check', 'This email already exists. Please use another email.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
