<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    protected $table = 'cart';

    public function add_to_cart($user_id, $product_id)
    {
        // Check if product already in cart for this user
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            // Update count = count + 1
            $this->db->set('count', 'count+1', FALSE);
            $this->db->where('user_id', $user_id);
            $this->db->where('product_id', $product_id);
            return $this->db->update($this->table);
        } else {
            // Insert new row
            $data = [
                'user_id'    => $user_id,
                'product_id' => $product_id,
                'count'      => 1
            ];
            return $this->db->insert($this->table, $data);
        }
    }

    public function get_cart($user_id)
    {
        $this->db->select('cart.*, products.name, products.price, products.image');
        $this->db->from('cart');
        $this->db->join('products', 'products.id = cart.product_id');
        $this->db->where('cart.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function remove_item($user_id, $product_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        return $this->db->delete($this->table);
    }

    public function clear_cart($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->delete($this->table);
    }
}
