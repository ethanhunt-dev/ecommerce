<?php
defined('BASEPATH') OR exit('NO  direct script access allowed ');
class User_model extends CI_Model{
    protected $table = 'users';
    public function __construct()
    {
        parent::__construct();
       
    }

     public function email_exists($email)
   {
        return $this->db->where('email',$email)->get($this->table)->num_rows();
   }
   public function insert_user($data)
   {     $count = $this->email_exists($data['email']);
       if($count==0)
        {
            return $this->db->insert($this->table,$data);
        }
        else{
            return false;
        }
           
   }
  
   public function get_user_by_email($email)
   {
        return $this->db->where('email',$email)->get($this->table)->row();
   }
   


}