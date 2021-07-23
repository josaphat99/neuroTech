<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passation_model extends CI_Model
{
    //dernier exercice mmse
    public function get_last_mmse($id)
    {
        $user_id = $id;
        
        return $this->db->select('*')
                 ->from('passation')
                 ->join('exercice','exercice.id = passation.exercice_id')
                 ->where(['exercice.type'=>'mmse','passation.utilisateur_id'=>$user_id])
                 ->order_by('passation.id','DESC')
                 ->get()
                 ->result();
    }
    //dernier exercice cognitif
    public function get_last_cognitif()
    {
        $user_id = $this->session->id;

        return $this->db->select('*')
                 ->from('passation')
                 ->join('exercice','exercice.id = passation.exercice_id')
                 ->where(['utilisateur_id'=>$user_id,'exercice.type' =>'cognitif'])
                 ->order_by('passation.id','DESC')
                 ->limit(1)
                 ->get()
                 ->result();

    }

    //les tous les exercices passé par un user
    public function all_exercice_done($id)
    {
        $user_id = $id;

        return $this->db->select('*, exercice.id as id,passation.id as passation_id')
                    ->from('passation')
                    ->join('exercice','exercice.id = passation.exercice_id')
                    ->join('rendezvous','passation.rendezvous_id = rendezvous.id')
                    ->where(['passation.utilisateur_id'=>$user_id,'passation.done'=>1])
                    ->order_by('passation.id','DESC')
                    ->get()
                    ->result();
    }

    //Les 5 derniers exercices passé par un user
    public function five_exercice_done($id)
    {
        $user_id = $id;

        return $this->db->select('*, exercice.id as id,passation.id as passation_id')
                    ->from('passation')
                    ->join('exercice','exercice.id = passation.exercice_id')
                    ->join('rendezvous','passation.rendezvous_id = rendezvous.id')
                    ->where(['passation.utilisateur_id'=>$user_id,'passation.done'=>1])
                    ->order_by('passation.id','DESC')
                    ->limit(5)
                    ->get()
                    ->result();
    }

    public function all_exercice_done_admin($id)
    {
        $user_id = $id;

        return $this->db->select('*, exercice.id as id,passation.id as passation_id')
                 ->from('passation')
                 ->join('exercice','exercice.id = passation.exercice_id')
                 ->join('rendezvous','passation.rendezvous_id = rendezvous.id')
                 ->where(['passation.utilisateur_id'=>$user_id])
                 ->order_by('passation.id','DESC')
                 ->get()
                 ->result();
    }   
}
