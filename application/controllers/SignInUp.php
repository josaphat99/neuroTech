<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Cette class concerne la creation des comptes et le login
*/

class SignInUp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //========chargement des entetes=====
        $this->load->view('layout/header');
        $this->load->view('layout/css');
        //=========chargement des models=====
        $this->load->model("Utilisateur_model","utilisateur");
    }

    public function index()
    {
        $this->connexion();
    }
    
    //===Creer un compte===
    public function signUp()
    {
        if (count($_POST) <= 0) {
            $this->load->view('public/signup');
            $this->load->view('layout/js');        
        }
        else{
            $data = array(
				"nomcomplet" => $this->input->post('nomcomplet'),
				"type" => 'patient',				
				"lieudeconsultation" => $this->input->post("lieudeconsultation"),
				"username" => $this->input->post("username"),
				"mdp" => $this->input->post("mdp"),
			);
			//add user
            $this->utilisateur->add($data);
            $this->session->set_flashdata(array('account_created'=>true));
			redirect('signinup/connexion');
        }
    }

    //===Authentification===
    public function connexion()
    {
        if (count($_POST) <= 0) {
            $this->load->view('public/signin');
            $this->load->view('layout/js');        
        } 
        else{

            $data = array(
                "username" => trim($this->input->post("username")),
                "mdp" => trim($this->input->post("mdp"))
            );

            if(count($res = $this->utilisateur->get_specific_data($data)) > 0)
            {
                //creation de la session
                $session =[
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "nomcomplet"=>$res[0]->nomcomplet,
                    "mdp"=>$res[0]->mdp,
                    "type"=>$res[0]->type,
                    "email"=>$res[0]->email,
                    "connected"=>true,                    
                ];

                $this->session->set_userdata($session);

                //gestion des interfaces selon les differents utilisateurs
                if(trim($res[0]->type) == trim("patient"))
                {
                    redirect('passation');                    
                }               
                else if(trim($res[0]->type) == trim("admin"))
                {
                    redirect('utilisateur/index'); 
                }
                else{
                    redirect('passation'); 
                }
            }
            else{
                $session_flash = array("error_login" => "Login ou mot de passe incorrecte!! veuillez reesayer");
                $this->session->set_flashdata($session_flash);
                redirect("signinup/connexion");
            }

        }
    }

    //se deconnecter de l'application
    public function deconnexion()
    {
        $this->session->sess_destroy();
		redirect("signinup/connexion");
    }

    //===profile===
    public function profile()
    {
        //===chargement du model===
        $this->load->model('Crud');

        //===l'id d'utilisateur===
        $id = $this->session->id;

        if(count($_POST)<=0)
        {
            $d['user'] = $this->Crud->get_data('utilisateur',['id'=>$id]);

            //===Passage a la vue===
            $this->load->view('layout/topbar');
            $this->load->view('layout/sidebar');
            $this->load->view('layout/preloader');
            $this->load->view('public/profile',$d);
            $this->load->view('layout/js');
            $this->load->view('layout/footer');
        }
        else
        {
            $this->Crud->update_data('utilisateur',['id'=>$id],$_POST);

            if($this->session->type == 'admin')
            {
                redirect('utilisateur/index');
            }
            else
            {
                redirect('patient/index');
            }

        }
  
    }

    
}