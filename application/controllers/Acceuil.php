<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceuil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->view('layout/header');
		$this->load->view('layout/css');
		//$this->load->view('layout/preloader');		
	}
	
	public function index()
	{
		//destruction de la session
		$this->session->sess_destroy();

		$this->load->view('public/app_title');
		$this->load->view('layout/js');
	}

	public function view_guide()
	{
		if($this->session->connected)
		{
			$this->load->view('layout/topbar');
			$this->load->view('layout/sidebar');
		}

		$this->load->view('public/guide');
		$this->load->view('layout/js');

		if($this->session->connected)
		{
			$this->load->view('layout/footer');
		}
	}
}
