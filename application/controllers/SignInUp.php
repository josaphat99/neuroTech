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
        $this->signUp();
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
                    "connected"=>true,                    
                ];

                $this->session->set_userdata($session);

                //gestion des interfaces selon les differents utilisateurs
                if(trim($res[0]->type) == trim("patient"))
                {
                    redirect('patients');                    
                }               
                else if(trim($res[0]->type) == trim("admin"))
                {
                    redirect('utilisateur/index'); 
                }
                else{
                    redirect('patients'); 
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
}