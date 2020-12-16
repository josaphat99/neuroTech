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
}
?>