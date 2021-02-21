<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passation_model extends CI_Model
{
    //dernier exercice mmse
    public function get_last_mmse()
    {
        $user_id = $this->session->id;
        
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
    public function all_exercice_done()
    {
        $user_id = $this->session->id;

        return $this->db->select('*, exercice.id as id')
                 ->from('passation')
                 ->join('exercice','exercice.id = passation.exercice_id')
                 ->join('niveau','exercice.niveau_id = niveau.id')
                 ->where(['utilisateur_id'=>$user_id])
                 ->order_by('passation.id','DESC')
                 ->limit(5)
                 ->get()
                 ->result();
    }

    // public function get_result_by_fonction($passation_id)
    // {
    //     $passation = $this->db
    //                       ->where(['id'=>$passation_id])
    //                       ->get('passation')
    //                       ->result()[0];

    //     $exercice = $this->db
    //                      ->where(['id'=>$passation->exercice_id])
    //                      ->get('exercice')
    //                      ->result()[0];
        
    //     $questions = $this->db
    //                       ->where(['exercice_id'=>$exercice->id])
    //                       ->get('question')
    //                       ->result();
        
    //     $or = 0;$ap = 0;$at = 0;$rap = 0;$lang = 0;

    //     $resultat = array(
    //         'Orientation' => $or,
    //         'Apprentissage' => $ap,
    //         'Attention' => $at,
    //         'Rappel' => $rap,
    //         'Langage' => $lang
    //     );
        
    //     foreach($questions as $q)
    //     {
    //         $fonction = $this->db
    //                          ->where(['id'=>$q->fonction_id])
    //                          ->get('fonction')
    //                          ->result()[0];

    //         if($fonction->fonction == 'Orientation')
    //         {
    //             if($this->db->where(['question_id'=>$q])->get('reponse')->result()[0])
    //         }
                                
    //     }
        
    // }
}
