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

    //===Les exercice pas encore passé par un utilisateur===
    public function exercice_not_done($niveau_id)
    {
        $user_id = $this->session->id;
        $exercice = $this->db->where(['niveau_id'=>$niveau_id,'type'=>'cognitif'])
                 ->get('exercice')
                 ->result();
                 
        $passation = $this->db->where(['utilisateur_id'=>$user_id])->get('passation')->result();
        $exr_array = [];

        foreach($exercice as $e)
        {
            $exercice_done = false;
            foreach($passation as $p)
            {
                if($e->id == $p->exercice_id)
                {
                    $exercice_done = true;
                }
            }
            if(!$exercice_done && !in_array($e,$exr_array))
            {
                $exr_array[] = $e;
            } 
        }
        return $exr_array;
    }

    public function nb_exercice_done($niveau_id)
    {
        $user_id = $this->session->id;
        $passation = $this->db->where(['utilisateur_id'=>$user_id])->get('passation')->result();
        $exercice = $this->db->where(['niveau_id'=>$niveau_id,'type'=>'cognitif'])->get('exercice')->result();
        $exr_array = [];

        foreach ($exercice as $e)
        {
            foreach($passation as $p)
            {
                if($e->id == $p->exercice_id)
                {
                    $exr_array [] = $e;
                    break;
                }
            }
        }
        return $exr_array;
    }

    //verifie si le patient a deja passe le mmse
    public function check_mmse()
    {
        $this->load->model('Crud');

        $user_id = $this->session->id;
        $e = $this->Crud->get_data('exercice',['type'=>'mmse'])[0];
        $passation = $this->Crud->get_data('passation',['utilisateur_id'=>$user_id,'exercice_id'=>$e->id]);
        
        if(count($passation) > 0)
        {
            return true;
        }

        return false;
    }
}