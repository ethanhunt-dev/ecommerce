<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    protected $table = 'products';
     public function __construct()
    {
        parent::__construct();
       
    }

    // insert product
    public function insert_product($data)
    {  
          return $this->db->insert($this->table, $data);
      
    }
       public function count_products()
       {
          return $this->db->count_all($this->table);
       }
    // get all products
    public function get_products($limit,$offset)
    {      $this->db->order_by('id', 'DESC');

         $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }public function delete_by_id($id)
    {
        return $this->db->where('id',$id)->delete($this->table);
    }
      public function get_by_id($id)
        {
            return $this->db->where('id',$id)->get('products')->row();
        }
    public function update_by_id($id,$data)
    {
        return $this->db->where('id',$id)->update($this->table,$data);    }
          public function get_all_products()
    {
        return $this->db->get('products')->result_array();
    }
     

        

}
