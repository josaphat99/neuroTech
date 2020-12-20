<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model
{
   
    public function checkAnswer($id,$response)
    {
        $this->load->model('Crud');
        $question = $this->Crud->get_data('question',['id'=>$id]);

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