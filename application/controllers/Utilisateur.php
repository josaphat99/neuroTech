<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//chargement des entete============
		$this->load->view('layout/header');
		$this->load->view('layout/css');
		//chargement des model============
		$this->load->model("Utilisateur_model",'utilisateur');
	}
	
	

	//=============add a new user=======================

	public function add()
	{
			
	}

	//================Partie accecible que par l'admin==================
	
	//list de users
	public function index()
	{
		if(trim($this->session->type) == trim('admin')){
			$this->load->view('utilisateurs/index');
			$this->load->view('layout/js');
			$this->load->view('layout/footer');
		}
		else{
			redirect('login');
		}		
	}

}
