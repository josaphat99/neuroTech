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
                    <div class="col-md-2 col-sm-2 text-center" style="margin-top:20px">
                        <div class="radio">
                            <input type="radio" name="checkbox'.$num_question.'" id="checkbox'.$num_question.$j.'" class="r_dio">
                            <label class="radio__label" for="checkbox'.$num_question.$j.'">Vrai</label>
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
        //===Insertion===
        $this->Crud->add_data('utilisateur',$d);
        
        //===Recuperation===
        $users = $this->Crud->get_data_desc('utilisateur');
        $html = '';
        $num = 0;

        foreach($users as $u)
        { 
            $num++;
            $html .= '<tr>
                <td style="text-align: center;">'.$num.'</td>
                <td >'.$u->nomcomplet.'</td>
                <td>'.$u->type.'</td>
                <td>'.$u->username.'</td>
                <td>
                    <button class="btn btn-success btn--raised"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
                    <form id="form-delete" onclick="javascript:confirmation($(this));return false;"action='.site_url("utilisateur/delete").' method="post" style="float:right;">                                
                        <input type="hidden" value='.$u->id.' name="id">
                        <button id="delete" class="btn btn-danger btn--raised" title="Supprimer">
                            <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                        </button>
                    </form>                                                                                 
                </td>
            </tr>';   
        }

        echo $html;
    }
}
?>