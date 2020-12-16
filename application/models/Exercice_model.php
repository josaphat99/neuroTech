<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercice_model extends Crud
{
    private $table = 'exercices';    

    public function add($data)
    {
        $this->add_data($this->table,$data);
    }

    public function get($clause=[],$ordre = null)
    {
        return $this->get_data($this->table,$clause,$ordre);
    }
}