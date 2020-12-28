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
		$this->load->model("Niveau_model","niveau");
		$this->load->model("Recommandation","recommandation");
		$this->load->model("Crud");
		$this->load->model("Exercice_model","exercice");
		//verification du login
		if(!$this->session->connected)
		{
			redirect('signinup/connexion');
		}
	}
	
	//================Partie accecible que par l'admin==================

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

			 $id_exercice = $this->Crud->get_data_desc('exercice')[0]->id+1;	
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

			 	//===-------insertion--------------===
				$this->Crud->add_data('question',$d);

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

				  //===Insertion de l'image===
				  if($_FILES['image'.$i]['name'] != null)
				  {
					 $fichier = 'fichier'.md5(time())."_".$_FILES['image'.$i]['name'];
					 move_uploaded_file($_FILES['image'.$i]['tmp_name'], './assets/files/questions/'.$fichier);
					 $d = array(
						 'image' => $fichier,
						 'main' => true,
						 'question_id'=> $id_question
					 );
					 
					 $this->Crud->add_data('image',$d);
				  }				 
				  //===------------------------------===
			}
			//===---Fin questions---===

			//===--Fin transition--===
			$this->db->trans_commit();
			//===destruction de la session===
			$this->session->exercice = null;
			$this->session->set_flashdata(array('exercice_add'=>true));
			
			redirect('exercice/index');
		}
		
	}
	
	//delete exercice
	public function delete()
	{
		$id = $this->input->post('id');
		$this->Crud->delete_data('exercice',['id'=>$id]);
		redirect('exercice/index');
	}	

	//delete a recommanded exercice
	public function delete_recommandation()
	{
		$id = $this->input->post('id');
		$this->Crud->delete_data('recommandation',['id'=>$id]);
		redirect('exercice/index');
	}	
	//list de exercices
	public function index()
	{
		if(trim($this->session->type) == trim('admin'))
		{
			$exercice = $this->exercice->get();
			$most_recommanded = $this->recommandation->get_most();
			$r = count($this->recommandation->get_distinct());
			$dl = count($this->Crud->get_data('exercice',['niveau_id'=>1]));
			$dm = count($this->Crud->get_data('exercice',['niveau_id'=>2]));
			$ds = count($this->Crud->get_data('exercice',['niveau_id'=>3]));

			foreach($exercice as $e)
			{
				//===on cree un nouvel attribut===
				$e->nbquestion = count($this->Crud->get_data(
					'question',['exercice_id'=>$e->id])
				);
			}

			$d['exercices'] = $exercice;
			$d['r'] = $r;
			$d['dl'] = $dl;
			$d['dm'] = $dm;
			$d['ds'] = $ds;
			$d['mr'] = $most_recommanded;

			$this->load->view('admin/exercice/list',$d);
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else
		{
			redirect('signinup/connexion');
		}		
	}

}