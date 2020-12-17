<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercice_model extends CI_Model
{
    public function get()
    {
        $this->db->select("*,exercice.id as id")
                 ->from('exercice')                 
                 ->join('niveau','exercice.niveau_id = niveau.id')
                 ->order_by('exercice.id','DESC');
        
        return $this->db->get()->result();
    }
}