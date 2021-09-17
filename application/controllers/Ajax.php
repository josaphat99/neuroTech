<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require __DIR__ . '/vendor/autoload.php';
// use Twilio\Rest\Client;

class Ajax extends CI_Controller
{
    public function assertion_ajax()
    {
        $nbassert = $this->input->post('nbassert');
        $num_question = $this->input->post('num_question');
        $html = '';
        //===affichage des champs par rapport au nombre saisi===
        /*
        *Les name des assertions seront de la forme assert12 pour dire: deuxieme assertion
        *de la premiere question.border
        *Les id seront de la meme forme, et le labels : assert12_label 
        *Les checkbox seront de la form checkbox12 : idem assertion
        */
        for($i = 0; $i < $nbassert; $i++)
        {
            $j = $i + 1;

            $html .= '<div class="col-md-8"  style="margin-top:-33px">
                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name="assert'.$num_question.$j.'" id="assert'.$num_question.$j.'">
                            <label id="assert'.$num_question.$j.'_label">Assertion '.$j.'</label>
                            <i class="form-group__bar"></i>
                        </div>      
                    </div>         
                    ';
        }        
        echo $num_question.','.$html;
    }

    public function image()
    {
        $nbimg = $this->input->post('nbimg');
        $num_question = $this->input->post('num_question');
        $num_question = $num_question + 1;
        $html = '<p><small>La premiere image doit etre l\'image principale</small></p>';
        //===affichage des champs par rapport au nombre saisi===
        /*
        *Les name des images seront de la forme img12 pour dire: deuxieme image
        *de la premiere question.border
        *Les id seront de la meme forme, et le labels : assert12_label 
        *Les checkbox seront de la form checkbox12 : idem image
        */

        for($i = 0; $i < $nbimg; $i++)
        {
            $j = $i + 1;

            $html .= '<div class="col-md-8"  style="margin-top:-33px">            
                        <div class="form-group form-group--float">
                            <input type="file" class="form-control " name="img'.$num_question.$j.'" id="img'.$num_question.$j.'" hidden>
                            <button class="btn btn-success btn-image" id="btn-img'.$num_question.$j.'">Image '.$j.'</button>
                            <small id="small-img'.$num_question.$j.'">Aucun fichier choisi</small> 
                            <i class="form-group__bar"></i>
                        </div>      
                    </div>                          
                    ';
        }        
        echo $num_question.','.$html;
    }
    
    public function add_user()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        //===-------------------===
        $d['nomcomplet'] = $this->input->post('nomcomplet');
        $d['email'] = $this->input->post('email');
        $d['type'] = 'patient';
        $d['username'] = strtolower(explode(' ',$this->input->post('nomcomplet'))[0]);
        $d['mdp'] = '@'.strtolower(explode(' ',$this->input->post('nomcomplet'))[0]).date('Y',time());
        $d['birth_date'] = $this->input->post('bthdate');
        $d['phone'] = $this->input->post('phone');
        $d['town'] = $this->input->post('town');
        $d['street'] = $this->input->post('street');
        $d['house_number'] = $this->input->post('house_number');
        $d['sex'] = $this->input->post('sex');
        //===Insertion===
        $this->Crud->add_data('utilisateur',$d);

        $this->session->set_flashdata(['user_add'=>true]);

        $html = 'Good work';

       echo $html;       
    }

    public function edit_user()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        
        //===recuperations des donnees ajax===
        $d['town'] = $this->input->post('town');
        $d['street'] = $this->input->post('street');
        $d['house_number'] = $this->input->post('house_number');
        
        $id = $this->input->post('id');

        //===Modification des donnnees dans la BD===
        $this->Crud->update_data('utilisateur',['id'=>$id],$d);

        //===recuperation des donnees dans la BD===
        $p = $this->Crud->get_data_desc('utilisateur',['id'=>$id])[0];
        $html = '';

        $html .= '                                
            <td class="td'.$p->id.'">'.$p->town.'</td>
            <td class="td-form'.$p->id.'" hidden><input id="town-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->town.'"></td>
            <td class="td'.$p->id.'">'.$p->street.'</td>
            <td class="td-form'.$p->id.'" hidden><input id="street-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->street.'"></td>
            <td class="td'.$p->id.'">'.$p->house_number.'</td>
            <td class="td-form'.$p->id.'" hidden><input id="house_number-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->house_number.'"></td>           
        ';   

        echo $html;        
    }

  

    public function add_appointment()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        //===-------------------===
        $d['doctor_id'] = $this->session->id;
        $d['patient_id'] = $this->input->post('patient');
        $d['date'] = $this->input->post('date');
        $d['heure'] = $this->input->post('heure');
        //===Insertion===
        $this->Crud->add_data('rendezvous',$d);

        echo 'well done';
    }

    public function ordonnance()
    {
        $nb_product= $this->input->post('nb_product');

        $html = '';

        for($i = 1 ; $i<=$nb_product;$i++)
        {
            $name = 'ordonnance-'.$i;

            $html .='  <div class="col-md-6 col-sm-6 col-xs-2 offset-sm-3">
                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name='.$name.'>
                            <label>Product '.$i.'</label>
                            <i class="form-group__bar"></i>
                        </div>   
                    </div>';
        }

        $html .=' <div class="col-md-9 col-sm-9 offset-sm-1 text-center">
                    <p id="error_message-ordonnance" class="text-red animated fadeInUp" hidden>Please give all the informations needed</p>
                    <button type="submit" id="submit-ordonnance" class="btn btn--icon login__block__btn">
                        <i class="zmdi zmdi-check"></i>
                    </button>
                </div>';
        
        echo $html;    
    }

    public function con_detail()
    {
        $id = $this->input->post('id');

        //===Chargement du model===
        $this->load->model('Crud');
        //===-------------------===

        $this->Crud->update_data('utilisateur',['id'=>$id],['etat'=>1]);
        $patient = $this->Crud->get_data('utilisateur',['id'=>$id])[0];
        $username = $patient->username;
        $mdp = $patient->mdp;
        $html = $username.'-'.$mdp;        

        echo $html;
    }

    public function ask_consultation()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        //===-------------------===

        $doctor_id = $this->input->post('doctor_id');

        $this->Crud->add_data('recommandation',[
            'doctor_id' => $doctor_id != ''? $doctor_id: null,
            'utilisateur_id' => $this->session->id,            
        ]);
        
        echo $doctor_id;
    }

    public function prescription()
    {
        $nb_prod = $this->input->post('nb_prod');
        $html = '';
       
        for($i = 0; $i < $nb_prod; $i++)
        {
            $j = $i + 1;

            $html .= '  <div class="col-md-4 offset-md-4  col-sm-3" style="margin-top:-20px" id="#">
                            <div class="form-group form-group--float">                        
                                <input type="text" class="form-control" name="prod'.$j.'" autocomplete="off">
                                <label id="#">Product '.$j.'</label>
                                <i class="form-group__bar"></i>
                            </div>                           
                        </div>        
                    ';
        }        
        echo $html;
    }

    //save/update diagnostic
	public function save_diagnostic()
	{
        //=========================
        $this->load->model('Crud');
        //=========================

        $file_name = $_FILES['diagnostic_file']['name'];
        
        $file_name_array = explode(' ', $file_name);
        $passation_id = $this->input->post('passation_id');

		if (count($file_name_array)>1)
        {
            $file =str_replace([' ','-'],'_',$file_name);
		} else 
        {
			$file = $file_name;
		}
        
		$fichier = md5(time()).'-'.$file;
        
		move_uploaded_file($_FILES['diagnostic_file']['tmp_name'], './assets/files/covid/'.$fichier);
	
		$d = [
			'diagnostic_file' => $fichier,
		];

		$this->Crud->update_data('passation', ['id'=>$passation_id],$d);

        $html = '
            <div class="col-md-12 col-sm-12">
                <p class="alert alert-light text-black">Clic on the file icon to open the diagnostic file</p>
            </div>
            <div class="col-md-4 col-sm-4 offset-md-5 offset-sm-4">                                
                <a target="_blanc" href="'.base_url("assets/files/covid/".$fichier).'"><h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>                            
            </div>
        ';
        
        echo $html;	
	}

    public function save_medical_plan()
    {
        //=========================
        $this->load->model('Crud');
        //=========================

        $file_name = $_FILES['medical_plan_file']['name'];
        
        $file_name_array = explode(' ', $file_name);
        $passation_id = $this->input->post('passation_id');

        if (count($file_name_array)>1)
        {
            $file =str_replace([' ','-'],'_',$file_name);
        } else 
        {
            $file = $file_name;
        }
        
        $fichier = md5(time()).'-'.$file;
        
        move_uploaded_file($_FILES['medical_plan_file']['tmp_name'], './assets/files/covid/'.$fichier);
    
        $d = [
            'medical_plan_file' => $fichier,
        ];

        $this->Crud->update_data('passation', ['id'=>$passation_id],$d);

        $html = '
            <div class="col-md-12 col-sm-12">
                <p class="alert alert-light text-black">Clic on the file icon to open the medical plan file</p>
            </div>
            <div class="col-md-4 col-sm-4 offset-md-6 offset-sm-6">                                
                <a target="_blanc" href="'.base_url("assets/files/covid/".$fichier).'"><h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>                            
            </div>
        ';
        
        echo $html;	
    }
    
}
?>