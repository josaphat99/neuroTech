<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passation extends CI_Controller {
    
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
        $this->load->model("Crud");        
        $this->load->model('Passation_model','passation');
        $this->load->model("Exercice_model",'exercice');
        $this->load->model("Niveau_model",'niveau');
        $this->load->model("Question_model",'question');
        $this->load->model("Recommandation",'recommandation');         
        //$this->load->model("Exercice_model",'exercice');   
        if(!$this->session->connected)
		{
			redirect('signinup/connexion');
		}     
    }
    //===footer & js===
    public function js_footer()
    {
        $this->load->view('layout/js');
        $this->load->view('layout/footer');
    }
    //===fonction index===
    public function index()
    {
        $user_id = $this->session->id;
        $e = $this->passation->five_exercice_done($user_id);
        $appointment = $this->Crud->get_data('rendezvous',['patient_id'=>$user_id,'etat'=>0]);
        //consultation started but not done
        $consultation = $this->Crud->get_data('passation',['utilisateur_id'=>$user_id,'started'=>1,'done'=>0]);
        $doc = $this->Crud->get_data('utilisateur',['type'=>'doctor']);

        foreach($e as $ex)
		{
			$ex->doctor = $this->Crud->get_data('utilisateur',['id'=>$ex->doctor_id])[0]->nomcomplet;
            $ex->ordonnance = $this->Crud->get_data('ordonnance',['passation_id'=>$ex->passation_id]);
        }
        
        foreach($appointment as $a)
		{
			$a->doctor = $this->Crud->get_data('utilisateur',['id'=>$a->doctor_id])[0]->nomcomplet;
		}

        $d['ask_consultation'] = $this->load->view('patient/ask_consultation',['doctors'=>$doc],true);

        $d['ordonnance'] = $this->Crud->get_data('ordonnance',['patient_id'=>$user_id]);
        $d['appointment'] = $appointment;
        $d['consultation'] = $consultation;
        $d['exercices'] = $e;      
        $this->load->view('patient/index',$d);
        $this->js_footer();
    }

    //===Recuperer le dernier niveau d'un patient===
    public function last_niveau()
    {
        $user_id = $this->session->id;
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

   //===Consultation, patient side===
   public function cognitive_exercice()
   {
        $user_id = $this->session->id;
        $no_exercice = false; //variable qui permet de verifier s'il y a une consultation lancée
        $consultation = $this->Crud->get_data('passation',['utilisateur_id'=>$user_id,'started'=>1,'done'=>0]);
        
        if(count($consultation) <= 0)
        {
            $no_exercice = true;
        }else{
            $test = $this->Crud->get_data('exercice',['id'=>$consultation[0]->exercice_id])[0];
        }
  
        if(!$no_exercice)
        {
            $questions = $this->Crud->get_data('question', ['exercice_id' => $test->id]);

                //===parcour de questions===
                foreach ($questions as $q) 
                {
                    if($q->type == 'choixmultiple')
                    {
                        foreach ($this->Crud->get_data('assertion', ['question_id'=>$q->id]) as $as) 
                        {
                            $q->assertion[] = $as;
                        }
                    }                    
                }

                $d['test'] = $test;
                $d['questions'] = $questions;

                //===session de reponses===
                $this->session->set_userdata(['answer'=>[]]);
                $this->session->set_userdata(['consultation_id'=>$consultation[0]->id]);
        }

        $d['no_exercice'] = $no_exercice;
        $this->load->view('patient/exercice_cognitif',$d);
        $this->js_footer();
   }

   //===correction de question de la consultation cote patient (utilisé en Ajax)===
   public function correct_question_cognitive()
   {
        $question_id = $this->input->post('question_id');
        $response = $this->input->post('answer');     

        $sess_reponse = $this->session->answer;
        $sess_reponse[$question_id] = $response;

        $this->session->set_userdata(['answer'=>$sess_reponse]);
        
        echo $this->session->answer[$question_id];
        die();
   }

   //===Traitement du formulaire consultation cote patient===
   public function cognitive_exercice_process()
    {
       //===recuperation de donnees de la session===
       $consultation_id = $this->session->consultation_id;
       $answer = $this->session->answer;

       //===cloture de la consultation===
       $this->Crud->update_data('passation',['id'=>$consultation_id],
       ['datepassation' => date('d-m-Y, H:i',time()),'done' => 1]);

       //===enregistrement de reponses===
        foreach($answer as $question_id=>$reponse)
        {
            $this->Crud->add_data('reponse',[
                'reponse' => $reponse,
                'question_id' => $question_id,
                'passation_id' => $consultation_id
            ]);
        }

        //===destruction de la session===
        $this->session->consultation_id = null;
        $this->session->answer = null;

        $this->session->set_flashdata(['consultation_done'=>true]);

        redirect('passation/index');       
    }

   public function voir_resultat_cognitif()
   {
       //===recuperation de la dernière cote et du niveau===
       if($this->input->post('exercice_id') != null)
       {
        $date = $this->input->post('date');
        $passation = $this->Crud->get_data('passation',[
            'utilisateur_id'=>$this->session->id,
            'exercice_id'=>$this->input->post('exercice_id'),
            'datepassation' => $date
            ])[0];
       }else{
        $passation = $this->passation->get_last_cognitif()[0];
       }
        
        $exercice = $this->Crud->get_data('exercice',['id'=>$passation->exercice_id])[0];
        $recommandation = null;
        $next_exercice = '';
        $niveau = $this->last_niveau();
        
        if(count($this->Crud->get_data('recommandation',['utilisateur_id'=>$this->session->id,'on_exe_id'=>$exercice->id])) >= 1)
        {
            $recommandation = $this->Crud->get_data_desc('recommandation',['utilisateur_id'=>$this->session->id,'on_exe_id'=>$exercice->id]);  
            foreach($recommandation as $r)
            {
                $r->titre = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->titre;
                $r->type = $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->type;
                $r->niveau = $this->Crud->get_data('niveau',['id'=>
                             $this->Crud->get_data('exercice',['id'=>$r->exercice_id])[0]->niveau_id])[0]->nom;                
            }      
        }

        $nb_undone_exercice = count($this->exercice->exercice_not_done($niveau->id));
        if($nb_undone_exercice > 0)
        {
            $nb_undone_exercice -=1;
            $index = random_int(0,$nb_undone_exercice);
            $next_exercice = $this->exercice->exercice_not_done($niveau->id)[$index];
        }else{
            $next_exercice = '';
        }
        
        //data
        $d = array(
        'recommandation' => $recommandation,
        'next_exercice' => $next_exercice,
        'titre' => $exercice->titre,
        'cote' => $passation->resultat,
        'date' => $passation->datepassation,
        'maximum' => $exercice->maximum,
        'niveau' => $niveau->nom,
        'percent'=> $passation->resultat * 100 / $exercice->maximum,
        );

       $this->load->view('patient/resultat_cognitif',$d);
       $this->js_footer();
   }

   //===exercice recommandé===
   public function recommanded_exercice()
   {
       $exercice_id = $this->input->post('exercice_id');
       $exercice = $this->Crud->get_data('exercice',['id'=>$exercice_id])[0];

       if($exercice->type == 'mmse')
       {
           $d = $this->mmse_base($exercice);
           $d['recommanded'] = true;
           $this->load->view('patient/mmse',$d);
           $this->js_footer();
       }
       else{
           $this->cognitive_exercice();
       }       
   }
  
   //===new consultation from admin===
   public function new_consultation()
   {
       $patient_id = $this->input->post('patient_id');
       $name = $this->Crud->get_data('utilisateur',['id'=>$patient_id])[0]->nomcomplet;
       $rdv_id = $this->input->post('appointment');

       $this->session->set_userdata(['user_patient_id'=> $patient_id]);
       $this->session->set_userdata(['user_patient_name'=> $name]);

       $this->Crud->add_data('passation',[
           'utilisateur_id' => $patient_id,
           'exercice_id' => $this->input->post('exercice'),
           'rendezvous_id' => $rdv_id
       ]);

       $this->Crud->update_data('rendezvous',['id'=>$rdv_id],['etat'=>1]);

       $this->session->set_flashdata(['consultation_added'=>true]);

       redirect('utilisateur/user_detail');
   }

   //===start consultation admin side===
   public function start_consultation()
   {
       $passation = $this->Crud->get_data('passation',['id'=>$this->input->post('passation_id')])[0];
       $utilisateur = $this->Crud->get_data('utilisateur',['id'=>$passation->utilisateur_id])[0];

       $this->session->set_userdata(['user_patient_id'=> $utilisateur->id]);
       $this->session->set_userdata(['user_patient_name'=> $utilisateur->nomcomplet]);

       $this->Crud->update_data('passation',['id'=>$passation->id],
       ['started'=>1,'datestarted'=>date('d-m-Y',time())]);

       $this->session->set_flashdata(['consultation_started'=>true]);

       redirect('utilisateur/user_detail');
   }

   //===new ordonnance admin side===
   public function new_ordonnance()
   {
       $nb_produit = $this->input->post('nb_produit');
       $patient_id = $this->input->post('id_patient');
       $passation_id = $this->input->post('id_passation');
       $description = '';

       $this->session->set_userdata(['ordonnance_patient_id'=> $patient_id]);
       $this->session->set_userdata(['ordonnance_passation'=> $passation_id]);

       for($i=1;$i<=$nb_produit;$i++)
       {
            $description .= $this->input->post('ordonnance-'.$i);
            if($i<$nb_produit){$description .= ',';}
       }

       $this->Crud->add_data('ordonnance',[
           'numero' => $this->input->post('numero_ordonnance'),
           'description' => $description,
           'patient_id' => $patient_id,
           'passation_id' => $passation_id
       ]);

       $this->session->set_flashdata(['ordonnance_added'=>true]);

       redirect('utilisateur/voir_resultat');
   }

   //===voir_ordonnance_patient===
   public function voir_ordonnance_patient()
   {
        $passation_id = $this->input->post('passation_id');

        $d['ordonnance'] = $this->Crud->get_data('ordonnance',['passation_id'=>$passation_id]);
        $d['doctor'] = $this->input->post('doctor');
        $d['titre'] = $this->input->post('exercice_titre');
        $d['date_passation'] = $this->input->post('date_passation');

        $this->load->view('patient/view_ordonnance',$d);
        $this->js_footer();
   }
}
//+27 41 390 1239