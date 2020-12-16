<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Niveau_model extends CI_Model
{
    private $table = 'niveau'; 

    public function get($clause = [])
    {
        $query = $this->db->get_where($this->table, $clause);
        return $query->result();
    }
}