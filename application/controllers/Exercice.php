<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercice extends CI_Controller {

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
		$this->load->model("Niveau_model",'niveau');
        $this->load->model("Crud");
        
	}
	
	

	//=============add a new exercice=======================

	public function add()
	{
		if(count($_POST) <= 0)
		{
			$data['niveau'] = $this->niveau->get();

			// verification de l'existence d'une session
			if($this->session->exercice != null)
			{
				$this->session->exercice = null;						
			}

			$this->load->view('admin/exercice/add',$data);
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else if($this->input->post('exercice') != null)
		{
			//creation de la session
			$data = array(
				'titre' => $this->input->post('titre'),
				'maximum' => $this->input->post('maximum'),
				'nbquestion' => $this->input->post('nbquestion'),
				'niveau' => $this->input->post('niveau'),
			);
			$session = array('exercice' => $data);
			$this->session->set_userdata($session);

			//recuperation du niveau selectionné:
			$d['niveau'] = $this->niveau->get(['id'=>(int)$data['niveau']])[0]->nom;

			//chargement de la vue de questions
			$this->load->view('admin/exercice/add_question.php',$d);
			$this->load->view('layout/js');
			$this->load->view('layout/footer');

		}else if($this->input->post('question') != null)
		{
			 //===creation de la transition===
			 $this->db->trans_start();

			 $id_exercice = count($this->Crud->get_data('exercice'))+1;	
			 $nbquestion = $this->session->exercice['nbquestion'];	

			 $data = array(
			 	'id' => $id_exercice,
			 	'titre' => $this->session->exercice['titre'],
			 	'type' => 'cognitif',
			 	'maximum' => $this->session->exercice['maximum'],				
			 	'niveau_id' => $this->session->exercice['niveau']
			 );

			 //===----insertion de l'exercice----===
			 $this->Crud->add_data('exercice',$data);
			 //===--------------------------------===

			 //===--insertion des questions--===			 

			 for($i = 0; $i < $nbquestion; $i++)
			 {
			 	$d = array(
			 		'type' => $this->input->post('type'.$i),
			 		'question' => $this->input->post('question'.$i),
			 		'cote' => $this->input->post('cote'.$i),
			 		'vraireponse' => $this->input->post('vraiereponse'.$i),
			 		'exercice_id' => $id_exercice
			 	);

			 	//===-------insertion-------------===
			 	$this->Crud->add_data('question',$d);
			 	//===------------------------------===

				 //===-------insertion des assertions------===
				$id_question = $this->Crud->get_data_desc('question')[0]->id; //recupere le dernier id
				
			 	$nbassert = $this->input->post('nbassert'.$i);
				$add = $i+1;
			 	for($j = 1; $j <= $nbassert ; $j++)
			 	{
			 		$t = array(
			 			'assertion' => $this->input->post('assert'.$add.$j),
			 			'question_id' => $id_question
			 		);

			 		$this->Crud->add_data('assertion',$t);
			 	}
			 	//===---Fin assertions---===
			}
			//===---Fin questions---===

			//===--Fin transition--===
			$this->db->trans_commit();
			//===destruction de la session===
			$this->session->exercice = null;

			redirect('exercice/add');
		}
		
	}
	

	//================Partie accecible que par l'admin==================
	
	//list de exercices
	public function index()
	{
		if(trim($this->session->type) == trim('admin')){
			$this->load->view('admin/exercice/index');
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else{
			redirect('signinup/connexion');
		}		
	}

}
