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
		$this->load->model("Crud");

		if(!$this->session->connected)
		{
			redirect('signinup/connexion');
		}
	}
	
	

	//=============add a new user=======================

	public function add()
	{
			
	}

	//================Partie accecible que par l'admin==================
	
	//list de users
	public function index()
	{
		if(trim($this->session->type) == trim('admin'))
		{
			$d['patients'] = $this->Crud->get_data_desc('utilisateur',['type'=>'patient']);
			$d['admins'] = $this->Crud->get_data('utilisateur',['type'=>'admin']);			
			$d['add'] = $this->load->view('admin/add',[],true);
			$this->load->view('admin/users',$d);
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else{
			redirect('login');
		}		
	}
	
	//delete user
	public function delete()
	{
		$id = $this->input->post('id');
		$this->Crud->delete_data('utilisateur',['id'=>$id]);
		redirect('utilisateur/index');
	}
}
