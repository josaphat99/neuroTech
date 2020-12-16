<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passation extends CI_Controller {
    
	public function __construct()
	{
		parent::__construct();
		//chargement des entete============
		$this->load->view('layout/header');
		$this->load->view('layout/css');
		$this->load->view('layout/topbar');
		$this->load->view('layout/sidebar');
		$this->load->view('layout/preloader');
        //chargement des model============
        $this->load->model("Crud",'crud');
        $this->load->model("Exercice_model",'exercice');
        $this->load->model("Niveau_model",'niveau');
        $this->load->model("Question_model",'question');        
        //$this->load->model("Exercice_model",'exercice');        
    }
    
    //recuperer le dernier niveau du patient
    public function get_user_niveau()
    {
        $id_user = $this->session->id;
        $niveau = $this->crud->join_data('niveau','detailniveau', 
        'niveau.id,detailniveau.niveau_id', ['utilisateur_id'=>$id_user],['detailniveau.id','DESC'])[0]->niveau;
        return $niveau;
    } 

    public function create_exercice()
    {
        $user_niveau = $this->get_user_niveau();
        $exercice = $this->exercice->get_one($user_niveau);        
        $questions = $this->question->get_by_exercice($exercice->id);             
        $this->select_question($exercice,$questions);
    }

    public function correct_question($id,$response)
    {
        $cote = $this->question->checkAnswer($id,$response);
        return $cote;
    }

    public function select_question($exercice,$questions)
    {
        $exercice_id = $exercice->id;
        $d['titre'] = $exercice->titre;
        $d['max'] = $exercice->maximum;
        //creation de la session qui contiendra les questions repondues        
        $data = array($exercice_id =>[]);
        $this->session->set_userdata($data);
        $session = $this->session->$exercice_id;
        foreach($questions as $q)
        {
            for($i=0;$i < count($session); $i++)
            {
                if(strtolower(trim($session[$i])) == strtolower(trim($q->question)))
                {
                    continue;
                }
                else{
                    $session[] = $q->question;
                    $d['question'] = $q->question;
                    return $d;                    
                }
            }
        }
    }

    // public function tst()
    // {
    //     $niveau  = $this->get_user_niveau();
    //     //verification du type de retour
    //     echo $this->unit->run($niveau, 'is_string');
    // }
}