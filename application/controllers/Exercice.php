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
		$this->load->model("Passation_model","passation");
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

				//===Insertion des images===
				$nbimg = $this->input->post('nbimg'.$i);
				 $count = 0;
				for($im = 1; $im <= $nbimg ; $im++)
				{
					$count++;
					if($_FILES['img'.$add.$im]['name'] != null)
					{
						$fichier = 'fichier'.md5(time())."_".$_FILES['img'.$add.$im]['name'];
						$d = array(
							'image' => $fichier,
							'main' => $im ==1?true:false,
							'question_id'=> $id_question
						);

						move_uploaded_file($_FILES['img'.$add.$im]['tmp_name'], './assets/files/questions/'.$fichier);						
						
						$this->Crud->add_data('image',$d);
					}
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

	public function view_recommandation()
	{
		if($this->session->type != 'patient')
		{
			redirect('signinup/connexion');
		}

		$recommandation = $this->Crud->get_data('recommandation',['utilisateur_id'=>$this->session->id]);  

		foreach($recommandation as $r)
		{
			$r->titre = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->titre;
			$r->type = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->type;
			$r->maximum = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->maximum;
			$r->niveau = $this->Crud->get_data('niveau',['id'=>
						 $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->niveau_id])[0]->nom;                
		} 

		$d['mr'] = $recommandation;
		$this->load->view('patient/recommandations',$d);
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
	}

	public function user_detail()
    {
		$id = $this->input->post('id_patient');
		$name = $this->input->post('name_patient');

        $e = $this->passation->all_exercice_done_admin($id);
        // $e_done = $this->Crud->get_data('passation',['utilisateur_id'=>$id]);
        $last_mmse = null;
        if(count($this->passation->get_last_mmse($id)) > 0)
        {
            $last_mmse = $this->passation->get_last_mmse($id)[0];
        }
        $recommandation = $this->Crud->get_data_desc('recommandation',['utilisateur_id'=>$id]);  


        foreach($recommandation as $r)
        {
            $r->titre = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->titre;
            $r->type = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->type;
            $r->maximum = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->maximum;
            $r->niveau = $this->Crud->get_data('niveau',['id'=>
                            $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->niveau_id])[0]->nom;                
        }
        $niveau = null;
        if($this->last_niveau($id) != null)
        {
            $niveau = $this->last_niveau($id)->nom;
        }else{
            $niveau = 'Aucun niveau défini';
        }
        $d['mr'] = $recommandation;
        $d['exercices'] = $e;
        $d['niveau'] = $niveau;
        $d['last_mmse'] = $last_mmse;
		$d['name_patient'] = $name;
		$d['id_patient'] = $id;
        $this->load->view('admin/user_detail',$d);
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
    }

	//recuperer ledernier niveau
	public function last_niveau($id)
    {
        $user_id = $id;

        if(count($this->Crud->get_data('detailniveau',['utilisateur_id'=>$user_id])) > 0)
        {
            $niveau = $this->Crud->get_data('niveau',['id'=>
            $this->Crud->get_data_desc('detailniveau',
            ['utilisateur_id'=>$user_id])[0]->niveau_id])[0];
        }else{
            $niveau = null;
        }
       
        return $niveau;
    }

	//voir resultat cote admin
	public function voir_resultat()
	{
		$id_patient = $this->input->post('id_patient');
		$exercice_id = $this->input->post('exercice_id');
		$date = $this->input->post('date');
		$passation_id = $this->input->post('passation');

		$d['data'] = $this->Crud->join_on_view_result($exercice_id,$id_patient,$date,$passation_id);
		$d['patient'] = $this->Crud->get_data('utilisateur',['id'=>$id_patient])[0]; 
		
		$this->load->view('admin/voir_resultat',$d);
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
	}
}
