<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Exercices_model extends CI_Model
{
    private $table = 'exercices';
    

    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id'=>$id));
        return $query->result();
    }
}