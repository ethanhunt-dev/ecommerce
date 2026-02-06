<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 class Auth extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session','form_validation']);
        $this->load->helper(['form','url']);
        $this->load->model('user_model');

    }
    public function login()
    { //print_r("");
    //die;
        $this->load->view('user/auth/login');
    }
    public function register()
    { //print_r("sdfghj");
    //die;
     // echo '<pre>';
   // print_r($this->input->post(NULL, TRUE));
   // die();
        $this->load->view('user/auth/register');
    }
    public function do_register()
    {  
      $validation =[
        [
            'field'=>'name',
            'label'=>'username',
            'rules'=>'required|min_length[5]|trim'
        ],
        [
            'field'=>'email',
            'label'=>'email',
            'rules'=>'required|valid_email|callback_test|trim'
        ],
        [
            'field'=>'password',
            'label'=>'password',
            'rules'=>'required|min_length[3]|trim'
        ]

      ];
      $this->form_validation->set_rules($validation);


       if($this->form_validation->run()==FALSE)
        {  
            $this->load->view('user/auth/register');
            
        }
        else{
          
            $data = $this->input->post(NULL,TRUE);
            $data['password']= password_hash($data['password'], PASSWORD_BCRYPT);
               // echo '<pre>';
            // print_r($data);
    //die();
            if($this->user_model->insert_user($data))
                {
                    $this->session->set_flashdata('success','reg ok');
                    redirect('users/auth/login');
                }
                else{
                    $this->session->set_flashdata('error','reg failed');
                    redirect('users/auth/register');
                }


        }


    }
    public function test($email)
    {
        if($this->user_model->email_exists($email))
            {
                $this->form_validation->set_message('test','email already exists');
                return FALSE;

            }else{
               return TRUE;
            }
    }
    public function do_login()
    {  
            $data =$this->input->post(NULL, TRUE);
            //echo '<pre>';
             //print_r($data);
   // die();

        if(empty($data['email']) || empty($data['password']))
            {
                $this->session->set_flashdata('error','email & password required');
                redirect ('users/auth/login');

            }
            $user = $this->user_model->get_user_by_email($data['email']);
            if($user && password_verify($data['password'], $user->password))
                {
                    $this->session->set_userdata(
                        [
                            'user_id' =>$user->uid,
                            'logged_in' => TRUE
                        ]
                    );
                    redirect('users/products');
                }
                else{
                    $this->session->set_flashdata('error', ' invalid ');
                    redirect('users/auth/login');
                }

    }
 }