<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    //========Le constructeur=================

	public function __construct()
	{
		parent::__construct();
		$this->load->view('layout/header');
        $this->load->view('layout/css');
        $this->load->view('layout/topbar');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/preloader');
    }	

    //==========La charger le js et le footer====

    public function js_footer()
    {
        $this->load->view('layout/js');
        $this->load->view('layout/footer');
    }

    public function index()
    {
        $this->load->view('patient/index');
        $this->js_footer();
    }
    


}
