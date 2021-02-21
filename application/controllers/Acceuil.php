<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceuil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->view('layout/header');
		$this->load->view('layout/css');
		$this->load->view('layout/preloader');
		
		if($this->session->connected)
		{
			$this->load->view('layout/topbar');
			$this->load->view('layout/sidebar');
		}
	}
	
	public function index()
	{
		$this->load->view('public/acceuil');
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
	}

	public function view_guide()
	{
		$this->load->view('public/guide');
		$this->load->view('layout/js');
		if($this->session->connected)
		{
			$this->load->view('layout/footer');
		}
	}
}
