<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Cette classe est reserver a l'admin
*/
class Utilisateur extends CI_Controller {

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
		$this->load->model("Utilisateur_model",'utilisateur');
		$this->load->model("Passation_model",'passation');
		$this->load->model("Crud");

		if(!$this->session->connected)
		{
			redirect('signinup/connexion');
		}
	}
	
	//================Partie accecible que par l'admin==================
	
	//list de users
	public function index()
	{
		if(trim($this->session->type) == trim('admin') || trim($this->session->type) == trim('doctor') 
		|| trim($this->session->type) == trim('reception'))
		{
			$doc = $this->Crud->get_data('utilisateur',['type'=>'doctor']);
			$patients = $this->Crud->get_data_desc('utilisateur',['type'=>'patient']);
			$d['admins'] = $this->Crud->get_data('utilisateur',['type'=>'admin']);			
			$d['appointment'] = $this->session->type == 'doctor'?$this->Crud->get_data('rendezvous',['etat'=>0,'doctor_id'=>$this->session->id]):[];
			$consultation_ask = $this->Crud->get_data('recommandation');
			
			$d['consultation_ask'] = $consultation_ask;
			$d['doctors'] = $doc;
			$d['patients'] = $patients;

			foreach($d['appointment'] as $a)
			{
				$a->doctor = $this->Crud->get_data('utilisateur',['id'=>$a->doctor_id])[0]->nomcomplet;
				$a->patient = $this->Crud->get_data('utilisateur',['id'=>$a->patient_id])[0]->nomcomplet;
			}

			foreach($consultation_ask as $a)
			{
				$a->doctor = $a->doctor_id != null? $this->Crud->get_data('utilisateur',['id'=>$a->doctor_id])[0]->nomcomplet:'Any doctor';
				$a->patient = $this->Crud->get_data('utilisateur',['id'=>$a->utilisateur_id])[0]->nomcomplet;
			}

			$d['add'] = $this->load->view('admin/add_patient',[],true);
			
			$d['add_doctor'] = $this->load->view('admin/add_doctor',[],true);
			$d['new_appointment'] = $this->load->view('admin/new_appointment',['doctor'=>$doc,'patient'=>$patients],true);
			
			$this->load->view('admin/users',$d);
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else{
			redirect('signinup/connexion');
		}		
	}
	
	//delete user
	public function delete()
	{
		$id = $this->input->post('id');
		$this->Crud->delete_data('utilisateur',['id'=>$id]);
		redirect('utilisateur/index');
	}


	//consultations
	public function user_detail()
    {
		if($this->input->post('id_patient') != null)
		{
			$id = $this->input->post('id_patient');
		}else
		{
			$id = $this->session->user_patient_id;
		}
		if($this->input->post('name_patient') != null)
		{
			$name = $this->input->post('name_patient');
		}else
		{
			$name = $this->session->user_patient_name;
		}

        $e = $this->passation->all_exercice_done_admin($id);

		foreach($e as $ex)
		{
			$ex->doctor = $this->Crud->get_data('utilisateur',['id'=>$ex->doctor_id])[0]->nomcomplet;
		}
		
		$appointment = $this->Crud->get_data('rendezvous',['patient_id'=>$id,'doctor_id'=>$this->session->id,'etat'=>0]);

		foreach($appointment as $a)
		{
			$a->doctor = $this->Crud->get_data('utilisateur',['id'=>$a->doctor_id])[0]->nomcomplet;
		}

		$exercice = $this->Crud->get_data('exercice');
		
		$new_consultation = $this->load->view('admin/new_consultation',[
			'appoint' => $appointment,
			'exercice' => $exercice,
			'patientId' => $id
		],true);

		$d['new_consultation'] = $new_consultation;
        $d['exercices'] = $e;
		$d['name_patient'] = $name;
		$d['id_patient'] = $id;
		$d['appointment'] = $appointment;
		$d['ordonnance'] = $this->Crud->get_data('ordonnance',['patient_id'=>$id]);		
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

	//voir resultat de la consultation cote admin
	public function voir_resultat()
	{
		if($this->input->post('id_patient') != null)
		{
			$id_patient = $this->input->post('id_patient');
		}else{
			$id_patient = $this->session->ordonnance_patient_id;
		}
		if($this->input->post('passation') != null)
		{
			$passation_id = $this->input->post('passation');
		}else{
			$passation_id = $this->session->ordonnance_passation;
		}

		$reponse = $this->Crud->get_data('reponse',['passation_id'=>$passation_id]);
		$data = $this->Crud->join_on_view_result($passation_id);
		$ordonnance = $this->Crud->get_data('ordonnance',['passation_id'=>$passation_id]);

		$reponse_indice = 0;

		foreach($data as $dt)
		{
			if($reponse_indice < count($reponse))
			{
				$dt->reponse = $reponse[$reponse_indice]->reponse != ''? $reponse[$reponse_indice]->reponse: 'None';
				$reponse_indice +=1;
			}		
		}

		$d['passation_id'] = $passation_id;
		$d['id_patient'] = $id_patient;
		$d['ordonnance'] = $ordonnance;
		$d['data'] = $data;		
		$d['patient'] = $this->Crud->get_data('utilisateur',['id'=>$id_patient])[0]; 
		
		$this->load->view('admin/voir_resultat',$d);
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
	}

	//add a doctor
	public function add_doctor()
	{
		$_POST['type'] = 'doctor';
		
		$this->Crud->add_data('utilisateur',$_POST);

		$this->session->set_flashdata(['doctor_added'=>true]);

		redirect('utilisateur/index');
	}
	
}
