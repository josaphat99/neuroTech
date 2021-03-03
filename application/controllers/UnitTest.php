<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->view('layout/header');
		$this->load->view('layout/css');
        
        //les model
        $this->load->model('Crud');
        $this->load->model('Question_model','question');
        $this->load->model('Recommandation','recommandation');

        //le test
        $this->load->library('unit_test');
    }
    
    public function test_checkAnswer()
    {
        $test = $this->question->checkAnswer(137,'response');
        $expected_result = 0;
        $this->unit->run($test, $expected_result,'Verification des reponses');
    }

    public function test_get_data()
    {
        $data  = $this->Crud->get_data('exercice');
        //verification du type de retour
        $this->unit->run(count($data), 'is_int','Récupération de données');
    }

    public function test_recommandation()
    {
        $test = $this->recommandation->create_recommandation(72,2);
        $expected_result = 'is_object';
        $this->unit->run($test, $expected_result,'Creation des recommandations');
    }

    public function index()
    {
        $this->test_checkAnswer();
        $this->test_get_data();
        $this->test_recommandation();
        echo $this->unit->report();
    }
}
