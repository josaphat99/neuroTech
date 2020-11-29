<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur_model extends CI_Model
{
    private $table = 'utilisateur';
    

    //add data in a table

    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }

    //get all data from a table

    public function get()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //get specific data (used also for authentification)

    public function get_specific_data($data)
    {
        $query = $this->db->get_where($this->table,$data);
        return $query->result();
    }

    //update data 

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    //delete data

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
