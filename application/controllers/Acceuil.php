<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceuil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->view('layout/header');
		$this->load->view('layout/css');
	}
	
	public function index()
	{
		$this->load->view('pages/acceuil');
		$this->load->view('layout/js');
		$this->load->view('layout/footer');
	}
}
