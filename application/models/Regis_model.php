<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regis_model extends CI_Model
{
    protected $table = 'regis'; // your table name

    public function __construct()
    {
        parent::__construct();
    }

    // Insert new user (registration)
    public function insert_data($data)
    {
        return $this->db->insert($this->table, $data); // returns TRUE / FALSE
    }

    // Check if email already exists
    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    // Check login using bcrypt
    public function check_login($email, $password)
    {
        // Get user by email
        $query = $this->db->get_where($this->table, ['email' => $email]);

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Verify hashed password
            if (password_verify($password, $user->password)) {
                return $user; // ✅ login success
            }
        }

        return false; // ❌ login failed
    }
}
