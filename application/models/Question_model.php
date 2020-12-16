<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model
{
    private $table = 'questions';
    

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

    public function checkAnswer($id,$response)
    {
        $question = $this->get_by_id($id);

        //verification de la reponse
        if(strtolower(trim($question[0]->vraireponse)) == strtolower(trim($response)))
        {
            return $question->cote;
        }
        else{
            return 0;
        }
    }

    // public function test()
    // {
    //     $test = $this->checkAnswer(1,'response');
    //     $expected_result = 1;
    //     echo $this->unit->run($test, $expected_result);

       
    // }
}