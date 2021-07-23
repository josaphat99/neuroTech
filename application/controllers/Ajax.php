<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        $d['username'] = $this->input->post('username');
        $d['mdp'] = $this->input->post('mdp');
        $d['lieudeconsultation'] = $this->input->post('lieudeconsultation');
        $d['phone'] = $this->input->post('phone');
        //===Insertion===
        $this->Crud->add_data('utilisateur',$d);
        
       //===recuperation des donnees dans la BD===
       $patients = $this->Crud->get_data_desc('utilisateur',['type'=>'patient']);
       $html = '';
       $num = 0;

       foreach($patients as $p)
       { 
           $num++;
           $html .= '<tr>
                <td style="text-align: center;">'.$num.'</td>                                    
                <td class="td'.$p->id.'">'.$p->nomcomplet.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="nomcomplet-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->nomcomplet.'"></td>               
                <td class="td'.$p->id.'">'.$p->username.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="username-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->username.'"></td>
                <td class="td'.$p->id.'">'.$p->email.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="email-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->email.'"></td>
                <td>
                    <button class="btn btn-success btn--raised edit" id="edit-'.$p->id.'"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                    <button class="btn btn-success btn--raised animated bounceIn check" id="check-'.$p->id.'" hidden><i class="zmdi zmdi-check zmdi-hc-fw"></i></button>
                    <form id="form-delete" onclick="javascript:confirmation($(this));return false;"action="'.site_url("utilisateur/delete").'" method="post" style="float:right;">                                
                        <input type="hidden" value='.$p->id.' name="id">
                        <button id="delete" class="btn btn-danger btn--raised" title="Supprimer">
                            <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                        </button>
                    </form>       
                    <form action="'.site_url("utilisateur/user_detail").'" method="post" style="float:right; margin-right:60px">                                
                    <input type="hidden" value='.$p->id.' name="id_patient">
                    <input type="hidden" value='.$p->nomcomplet.' name="name_patient">
                    <button id="see" class="btn btn-secondary btn--raised" title="See">
                        <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                    </button>
                    </form>                                                                           
                </td>
            </tr>';    
       }

       echo $html;
       
    }

    public function edit_user()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        
        //===recuperations des donnees ajax===
        $d['nomcomplet'] = $this->input->post('nomcomplet');
        $d['username'] = $this->input->post('username');
        $d['email'] = $this->input->post('email');
        $id = $this->input->post('id');

        //===Modification des donnnees dans la BD===
        $this->Crud->update_data('utilisateur',['id'=>$id],$d);

        //===recuperation des donnees dans la BD===
        $patients = $this->Crud->get_data_desc('utilisateur',['type'=>'patient']);
        $html = '';
        $num = 0;

        foreach($patients as $p)
        { 
            $num++;
            $html .= '<tr>
                <td style="text-align: center;">'.$num.'</td>                                    
                <td class="td'.$p->id.'">'.$p->nomcomplet.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="nomcomplet-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->nomcomplet.'"></td>
                <td class="td'.$p->id.'">'.$p->username.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="username-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->username.'"></td>
                <td class="td'.$p->id.'">'.$p->email.'</td>
                <td class="td-form'.$p->id.'" hidden><input id="email-'.$p->id.'" class="form-control animated bounceIn" type="text" value="'.$p->email.'"></td>
                <td>
                    <button class="btn btn-success btn--raised edit" id="edit-'.$p->id.'"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                    <button class="btn btn-success btn--raised animated bounceIn check" id="check-'.$p->id.'" hidden><i class="zmdi zmdi-check zmdi-hc-fw"></i></button>
                    <form id="form-delete" onclick="javascript:confirmation($(this));return false;"action="'.site_url("utilisateur/delete").'" method="post" style="float:right;">                                
                        <input type="hidden" value='.$p->id.' name="id">
                        <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                            <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                        </button>
                    </form>    

                    <form action="'.site_url("utilisateur/user_detail").'" method="post" style="float:right; margin-right:60px">                                
                    <input type="hidden" value='.$p->id.' name="id_patient">
                    <input type="hidden" value='.$p->nomcomplet.' name="name_patient">
                    <button id="see" class="btn btn-secondary btn--raised" title="See">
                        <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                    </button>
                    </form>                                                                             
                </td>
            </tr>';   
        }

        echo $html;
        
    }

    public function mmse_flash(){
        $d = array('mmse'=>true);
        $this->session->set_flashdata($d);
        
         //===creation de la session des fonction===
         $this->session->set_userdata([
            'orientation' => 0,
            'apprentissage' => 0,
            'attention' => 0,
            'rappel' => 0,
            'langage' => 0
        ]);
        echo 'session creee';
    }
    
    public function mmse_flash_check()
    {
        if($this->session->mmse)
        {
            $this->session->mmse = null;
            echo 'session detruite';
        }else{
            echo 'pas de session';
        }        
    }
   
    public function check_mmse()
    {
        $this->load->model('Exercice_model','exercice');
        if($this->exercice->check_mmse() == false){
           echo 0;
        }
        else{
            echo 1;
        }
    }

    public function add_appointment()
    {
        //===Chargement du model===
        $this->load->model('Crud');
        //===-------------------===
        $d['doctor_id'] = $this->input->post('doctor');
        $d['patient_id'] = $this->input->post('patient');
        $d['date'] = $this->input->post('date');
        $d['heure'] = $this->input->post('heure');
        //===Insertion===
        $this->Crud->add_data('rendezvous',$d);
        
       //===recuperation des donnees dans la BD===
       $appoint = $this->Crud->get_data_desc('rendezvous',['etat'=>0]);
       $html = '';
       $num = 0;

       foreach($appoint as $a)
       {
           $num++;
           $doctor = $this->Crud->get_data('utilisateur',['id'=>$a->doctor_id])[0]->nomcomplet;
           $patient = $this->Crud->get_data('utilisateur',['id'=>$a->patient_id])[0]->nomcomplet;
           $html .='
           <tr>
               <td style="text-align: center;">'.$num.'</td>
               <td >'.$doctor.'</td>
               <td>'.$patient.'</td>
               <td>'.$a->date.'</td>
               <td>'.$a->heure.'</td>
           </tr>
           ';           
       }

       echo $html;
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
}
?>