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
        $e = $this->passation->all_exercice_done();
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
        $d['exercices'] = $e;
        $d['mmse'] = $this->mmse();

        $this->load->view('patient/index',$d);
        $this->js_footer();
    }
    //===Test MMSE==

    //-recupertion de la position-
    public function get_position()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'));
        $city = 'lubumbashi';
        $region = 'haut-katanga';

        if($query && $query['status'] == 'success') 
        {
            $city = $query['city'];
            $region = $query['region'];
        }
        return [$city,$region];
    }    

    public function mmse_base($mmse)
    {
        $questions = $this->Crud->get_data('question',['exercice_id' => $mmse->id]);              
        $num_question = 1;
        
        foreach($questions as $q)
        {
            if($num_question == 4)
            {
                $question = explode(',',$q->question);
                $q->question = 'a. '.$question[0].' &nbsp&nbsp&nbsp&nbsp&nbsp&nbspb. '.$question[1].' &nbsp&nbsp&nbspc. '.$question[2];
            }
            
            if($num_question == 8 || $num_question == 9)
            {
                $q->image = $this->Crud->get_data('image',['question_id'=>$q->id])[0]->image;
            }

            $q->num_question = $num_question;
            $num_question++;
        }

        $d['question'] = $questions;      
        $d['mmse_id'] = $mmse->id;  
        // $d['city'] = $city;
        
        //===Creation des sessions pour les cotes, l'id de l'exercice===
        $this->session->set_userdata(['cote_mmse'=>0]);
        $this->session->set_userdata(['exercice_id'=>$mmse->id]);

        return $d;
    }
    //===le test mmse===
    public function mmse()
    {  
        $mmse = $this->Crud->get_data('exercice',['type'=>'mmse'])[0];
        $d = $this->mmse_base($mmse);
        $mmse = $this->load->view('patient/mmse',$d,true);
        return $mmse;
    }

    //===correction de questions de type mmse===
    public function correct_question_mmse()
    {
        $id = $this->input->post('id');
        $response = $this->input->post('answer');  
        $indice = $this->input->post('indice');        
        $cote = 0;
       
        //===Verification par rapport aux differentes questions===
        if($indice == 0)
        {
            //annee
            $annee = date('Y',time());
            //mois sans zero au debut
            $mois = date('n',time());
            //numero du jours du mois sans zero  au  debut
            $jours_mois = date('j',time());
            //numero du jours de la semaine
            $jours_semaine = date('w',time()); 
            //saison
            $saison = '';
            //===trouver la saison===
            $pluie = [1,2,3,4,5,6];
            // $seche = ['7,8,9,10,11,12'];

            if(in_array($mois,$pluie))
            {
                $saison = 'pluie';
            }else{
                $saison = 'seche';
            }
            //correction
            $r = explode(',',$response);

            if(trim($r[0])==$annee)
            {
                $cote +=1;
            }if(trim($r[1])==$saison)
            {
                $cote +=1;
            }if(trim($r[2])==$mois)
            {
                $cote +=1;
            }if(trim($r[3])==$jours_mois)
            {
                $cote +=1;
            }if(trim($r[4])==$jours_semaine)
            {
                $cote +=1;
            }

            $orientation = $this->session->orientation;
            $orientation += $cote;
            $this->session->set_userdata(['orientation'=>$orientation]);

        }else if($indice == 1){
            if($response == $this->get_position()[0])
            {
                $cote += 2;
            }

            $orientation = $this->session->orientation;
            $orientation += $cote;
            $this->session->set_userdata(['orientation'=>$orientation]);

        }else if($indice == 2){
            if($response == $this->get_position()[1])
            {
                $cote += 3;
            }

            $orientation = $this->session->orientation;
            $orientation += $cote;
            $this->session->set_userdata(['orientation'=>$orientation]);

        }else if($indice == 4){
            //correction
            $r = explode(',',$response);
            if(trim($r[0])==100){
                $cote +=1;
            }if(trim($r[1])==93){
                $cote +=1;
            }if(trim($r[2])==86){
                $cote +=1;
            }if(trim($r[3])==79){
                $cote +=1;
            }if(trim($r[4])==72){
                $cote +=1;
            }if(trim($r[5])==65){
                $cote +=1;
            }if(trim($r[6])==58){
                $cote +=1;
            }if(trim($r[7])==51){
                $cote +=1;
            }if(trim($r[8])==44){
                $cote +=1;
            }if(trim($r[9])==37){
                $cote +=1;
            }if(trim($r[10])==30){
                $cote +=1;
            }if(trim($r[11])==23){
                $cote +=1;
            }if(trim($r[12])==16){
                $cote +=1;
            }if(trim($r[13])==9){
                $cote +=1;
            }if(trim($r[14])==2){
                $cote +=1;
                $cote = $cote/3;
            } 

            $attention = $this->session->attention;
            $attention += $cote;
            $this->session->set_userdata(['attention'=>$attention]);
        }
        else{
            $cote = $this->question->checkAnswer($id,$response);

            if($cote != 0)
            {
                if($indice == 5){
                    $attention = $this->session->attention;
                    $attention += $cote;
                    $this->session->set_userdata(['attention'=>$attention]);
                }if($indice == 6){
                    $rappel = $this->session->rappel;
                    $rappel += $cote;
                    $this->session->set_userdata(['rappel'=>$rappel]);
                }if($indice == 7 || $indice == 8 || $indice == 9)
                {
                    $langage = $this->session->langage;
                    $langage += $cote;
                    $this->session->set_userdata(['langage'=>$langage]);                    
                }
            }
        }    

        $cote_mmse = $this->session->cote_mmse;
        $cote_mmse += $cote;
        $this->session->set_userdata(['cote_mmse'=>$cote_mmse]); 

        //===enregistrement de la reponse===
        $this->Crud->add_data('reponse',array('reponse'=>$response,'question_id'=>$id));

        //renvoi des donnees
        echo $this->session->cote_mmse;
        die();
    }

    //===creation passation, niveau, redirection===
    public function mmse_process()
    {
        //===creer une nouvelle passation===
        $this->Crud->add_data('passation',array(
            'datepassation' => date('d-m-Y, H:i'),
            'resultat' => $this->session->cote_mmse,
            'utilisateur_id' => $this->session->id,
            'exercice_id' => $this->session->exercice_id
        ));

        //===creer un niveau par rapport au resultat du mmse===
        $cote = $this->session->cote_mmse;
        $niveau_indice = '';
        //-verification de la cote et determinatoin du niveau-
        if($cote <= 9)
        {
            $niveau_indice = 3;
        }else if($cote >= 10 && $cote <= 19)
        {
            $niveau_indice = 2;
        }else if($cote >= 20 && $cote <= 25)
        {
            $niveau_indice = 1;
        }else{
            $niveau_indice = 4;
        }
        
        //-recuperation du niveau-
        $niveau = $this->Crud->get_data('niveau',['indice'=>$niveau_indice])[0];        
        
        //-creation du detail niveau-
        $this->Crud->add_data('detailniveau',array(
            'date' => date('d-m-Y, H:i'),
            'niveau_id' => $niveau->id,
            'utilisateur_id' => $this->session->id
        ));

        $d = array('cote' => $cote,'niveau'=> $niveau->nom);

        //-destruction des session-
        $this->session->cote_mmse = null;
        $this->session->exercice_id = null; 

        //creation de la session de la cote
        $this->session->set_userdata($d);
        //===redirection a la page voir_resultat===        
        redirect('passation/voir_resultat_mmse');
    }

    //===Recuperer le dernier niveau d'un patient===
    public function last_niveau()
    {
        $user_id = $this->session->id;

        $niveau = $this->Crud->get_data('niveau',['id'=>
                  $this->Crud->get_data_desc('detailniveau',
                  ['utilisateur_id'=>$user_id])[0]->niveau_id])[0];
        return $niveau;
    }
    
    public function voir_resultat_mmse()
    {
        //===recuperation de la dernière cote et du niveau===
        if($this->input->post('exercice_id') != null)
        {
            $date = $this->input->post('date');
            $passation = $this->Crud->get_data('passation',['datepassation'=>$date,'exercice_id'=>$this->input->post('exercice_id')])[0];
        }else{
            $passation = $this->passation->get_last_mmse()[0];
        }

        $niveau = $this->last_niveau();

        $d['cote'] = $passation->resultat;
        $d['date'] = $passation->datepassation;
        $d['niveau'] = $niveau->nom;

        //calcul du pourcentage
        $d['percent'] = $d['cote']*100/30;

        $this->load->view('patient/resultat_mmse',$d);
        $this->js_footer();
    }

   //===Exercices cognitifs===
   public function cognitive_exercice()
   {
        $no_exercice = false;
       if ($this->input->post('exercice_id') != null) {
           $exercice = $this->Crud->get_data('exercice', ['id'=>$this->input->post('exercice_id')])[0];
           $niveau = $this->Crud->get_data('niveau',['id'=>$exercice->niveau_id])[0];
       }else{
            $niveau = $this->last_niveau();            
            if (count($this->exercice->exercice_not_done($niveau->id)) <= 0) {
                $no_exercice = true;
            } else {
                $index = random_int(0, count($this->exercice->exercice_not_done($niveau->id))-1);
                $exercice = $this->exercice->exercice_not_done($niveau->id)[$index];                
            }
        }
        if(!$no_exercice)
        {
            $questions = $this->Crud->get_data('question', ['exercice_id' => $exercice->id]);

                //===parcour de questions===
                foreach ($questions as $q) {
                    if (count($this->Crud->get_data('image', ['question_id'=>$q->id])) > 0) {
                        foreach ($this->Crud->get_data('image', ['question_id'=>$q->id]) as $im) {
                            $q->image[] = $im;
                        }
                    }
                    if (count($this->Crud->get_data('assertion', ['question_id'=>$q->id])) > 0) {
                        foreach ($this->Crud->get_data('assertion', ['question_id'=>$q->id]) as $as) {
                            $q->assertion[] = $as;
                        }
                    }
                }

                $d['exercice'] = $exercice;
                $d['questions'] = $questions;
                $d['niveau'] = $niveau->nom;

                //===session de la cote===
                $this->session->set_userdata(['cote_cognitive'=>0]);
                $this->session->set_userdata(['exercice_id'=>$exercice->id]);
        }

        $d['no_exercice'] = $no_exercice;
        $this->load->view('patient/exercice_cognitif',$d);
        $this->js_footer();
   }

   //===correction de question exercice cogntif===
   public function correct_question_cognitive()
   {
        $question_id = $this->input->post('question_id');
        $response = $this->input->post('answer');     
        $cote = 0;
        $cote_cognitve = $this->session->cote_cognitive;
        $cote = $this->question->checkAnswer($question_id,$response);

        if($cote > 0)
        {
            $cote_cognitve += $cote;
            $this->session->set_userdata(['cote_cognitive'=>$cote_cognitve]);
        }

        //===enregistrement de la reponse===
        $this->Crud->add_data('reponse',['reponse'=>$response,'question_id'=>$question_id]);
        
        echo $this->session->cote_cognitive;
        die();
   }

   //===Traitement du formulaire exercice cogntif===
   public function cognitive_exercice_process()
   {
       //===creer une nouvelle passation===
       $this->Crud->add_data('passation',array(
        'datepassation' => date('d-m-Y, H:i'),
        'resultat' => $this->session->cote_cognitive,
        'utilisateur_id' => $this->session->id,
        'exercice_id' => $this->session->exercice_id
        ));

        $exercice = $this->Crud->get_data('exercice',['id'=>$this->session->exercice_id])[0];
        $max_exercice = $exercice->maximum;
        $exercice_niveau = $this->Crud->get_data('niveau',['id'=>$exercice->niveau_id])[0];
        $indice = $exercice_niveau->indice;
        $recommandation = '';
        $next_exercice = '';
        
        //===Creation d'une recommandation par rapport a la cote===
        $percent_got = $this->session->cote_cognitive * 100 / $max_exercice;

        if($percent_got >= 70)
        {
            //selection d'un exercice du niveau superieur
            if($indice == 3 || $indice == 2)
            {
                $niveau_sup = $this->Crud->get_data('niveau',['indice'=>$indice-1])[0];
                $index = random_int(0,count($this->exercice->exercice_not_done($niveau_sup->id))-1);
                $recommandation = $this->exercice->exercice_not_done($niveau_sup->id)[$index];
            }
            else if($indice == 1)
            {
                $niveau = $this->Crud->get_data('niveau',['indice'=>$indice])[0];
                $nb_exercice = count($this->exercice->nb_exercice_done($niveau->id));

                //===s'il y a au moins deux exercices fait a c niveau on passe au mme===
                if($nb_exercice >= 2)
                {
                    $recommandation = $this->Crud->get_data('exercice',['type'=>'mmse'])[0];
                }else{
                    //selection d'un exercice du meme niveau
                    $index = random_int(0,count($this->exercice->exercice_not_done($exercice_niveau->id))-1);
                    $next_exercice = $this->exercice->exercice_not_done($exercice_niveau->id)[$index];
                }
                
            }
        }
        else if($percent_got >= 50 && $percent_got <= 69){
            //selection d'un exercice du meme niveau
            $index = random_int(0,count($this->exercice->exercice_not_done($exercice_niveau->id))-1);
            $next_exercice = $this->exercice->exercice_not_done($exercice_niveau->id)[$index];
        }
        else{
            //selection d'un exercice du niveau inferieur
            if($indice == 1 || $indice == 2)
            {
                $niveau_inf = $this->Crud->get_data('niveau',['indice'=>$indice+1])[0];
                $index = random_int(0,count($this->exercice->exercice_not_done($niveau_inf->id))-1);
                $recommandation = $this->exercice->exercice_not_done($niveau_inf->id)[$index];
            }
            //exercice du meme niveau 
            else if($indice == 3){
                $index = random_int(0,count($this->exercice->exercice_not_done($exercice_niveau->id))-1);
                $next_exercice = $this->exercice->exercice_not_done($exercice_niveau->id)[$index];
            }
        }
        if($recommandation != '')
        {
            $this->Crud->add_data('recommandation',array(
                'utilisateur_id' => $this->session->id,
                'exercice_id' => $recommandation->id
            ));
        }

        $this->session->cote_cognitive = null;
        $this->session->exercice_id = null; 

        redirect('passation/voir_resultat_cognitif');
       
   }
   public function voir_resultat_cognitif()
   {
       //===recuperation de la dernière cote et du niveau===
       if($this->input->post('exercice_id') != null)
       {
        $passation = $this->Crud->get_data('passation',['exercice_id'=>$this->input->post('exercice_id')])[0];
       }else{
        $passation = $this->passation->get_last_cognitif()[0];
       }
        
        $exercice = $this->Crud->get_data('exercice',['id'=>$passation->exercice_id])[0];
        $recommandation = '';
        $next_exercice = '';
        $niveau = $this->last_niveau();
        
        if(count($this->Crud->get_data('recommandation',['utilisateur_id'=>$this->session->id])) >= 1)
        {
            $recommandation = $this->Crud->get_data('recommandation',['utilisateur_id'=>$this->session->id]);  
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

   //===exxercice recommandé===
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
}