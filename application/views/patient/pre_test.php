<style>
    .titre{     
        color:white;
    }
</style>

<?php
  if (!$no_exercice) 
  {
        $margin_reponse = "margin-top:-20px";
        $question_size = count($questions); 
?>
<section class="content" id="section_exercice">
    <div class="content__inner">
        <header class="content__title">
            <h1><b>Consultation test</b></h1><br>          
        </header>
        <div class="card animated zoomIn">    
            <div class="stats__item bg-green"> 
                <header class="content__title">
                    <h1 class="text-center" style="color:white;font-size:22px"><b><?=$test->titre?></b></h1>              
                </header>
            </div>
            <div class="card-body">   
            <?php
            $num = 0;
            for ($i=0;$i<count($questions);$i++) 
            {
                $num +=1; ?>    
                <div id="<?="div".$i?>" class="animated zoomIn" hidden>
                    <div class="row">
                        <div class="listview listview--bordered q-a">
                            <div class="listview__item q-a__item">
                                <div class="q-a__stat hidden-sm-down">
                                    <span>
                                        <strong id=<?="numero-".$i?>><?=$num?></strong>                                        
                                    </span>
                                </div>
                                <div class="col-md-12" id=<?="question-".$i?>>
                                    <div class="listview__content" style="margin-top:18px">
                                        <div class="listview__heading" style="font-size:15px"><?=$questions[$i]->question?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if($questions[$i]->type=='traditionnelle')
                            {
                        ?>
                                <div class="col-md-3" style=<?=$margin_reponse?> id="<?="div-reponse".$i?>">
                                    <div class="form-group form-group--float">                        
                                        <input type="text" class="form-control" id=<?="reponse-".$i?> autocomplete="off">
                                        <label id=<?="label-".$i?>>Answer</label>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                        <?php
                            }else if($questions[$i]->type=='choixmultiple'){                            
                        ?>
                            <div class="col-md-5" style="margin:auto">
                                <div class="form-group form-group--float" id="div-reponse10">                        
                                    <div class="select">
                                        <label></label>
                                        <select class="form-control assertion" id=<?="assertion-".$i?> autocomplete="off">
                                            <option id=<?="assert-".$i?> value="">Assertions</option>
                                            <?php
                                                for ($as=0;$as<count($questions[$i]->assertion);$as++) {
                                                    ?>
                                                    <option value='<?=$questions[$i]->assertion[$as]->assertion?>'>
                                                    <?=$questions[$i]->assertion[$as]->assertion?>
                                                    </option>
                                                <?php
                                                } ?>                                                                                                                     
                                        </select>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>   
                        <?php
                            }else{
                        ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control textarea-autosize" placeholder="Start typing..." id="<?='reponse-text'.$i?>"></textarea>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>                     
                    </div>
                    <p class="text-red text-center animated fadeIn" id=<?="error_found".$i?> hidden>
                        Please answer before going to the next question!
                    </p>
                    <div class="row">
                        <div style="margin:auto">
                            <input type="text" name="answer" id=<?="answer-".$i?> value="" hidden>
                            <input type="text" name="id" id=<?="id-".$i?> value="<?=$questions[$i]->id?>" hidden>
                            <button class="btn btn--icon login__block__btn Subtn" id=<?="submit-".$i?>><i id=<?="icon-".$i?> class="zmdi zmdi-arrow-right"></i></button>
                            <button class="btn  login__block__btn Terminer" id=<?="terminer-".$i?>>Finish</button>
                        </div>
                    </div>
                </div>   
                <?php
        } ?>
            </div>
        </div>
    </div>
</section>
<?php
    }else{
?>
<section class="content">
<div class="content__inner">  
    <div class="card animated zoomIn" style="margin-top:10%">            
        <div class="card-body text-center"> 
            <p class="text-center">There is no consultation available for you</p>
            <br>
            <a href="<?=site_url('passation/index')?>"><button class="btn btn-success">Go back</button></a>
        </div>
    </div>
</div>
</section>
<?php
    }
?>
<script>
    $(function(){
        //===Affichage et masquage=== 
        $('#div0').removeAttr('hidden');
        $('.Terminer').attr('hidden',true);
        
        $('.Subtn').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var idPlus = parseInt(id) + 1; 
            var error_found = false;
       
            //===checking de la reponse===
            if($('#reponse-'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-'+id).val());
            }

            if($('#assertion-'+id).val() != null)
            {
                $('#answer-'+id).val($('#assertion-'+id).val());
            }

            if($('#reponse-text'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-text'+id).val());
            }

            //===passage a la question suivante===
            if($('#answer-'+id).val() == '')
            {
                $('#error_found'+id).removeAttr('hidden'); 
            }
            else
            {
                //===passage a la question suivante===
                $('#div'+id).attr('hidden',true);

                if(id == 0 || id == 2)
                {
                    if($("#assertion-"+id).val() == 'No')
                    {
                        var idP = idPlus + 1;
                        $("#numero-"+idP).html(parseInt($("#numero-"+id).html()) +1);
                        $('#div'+idP).removeAttr('hidden');
                        
                        //-envoi a ajax question encours-
                        $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                            console.log(data);
                        })

                        //-envoi a ajax question suivante-
                        $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+idPlus).val(),answer:'--'},function(data){
                            console.log(data);
                        })
                    }
                    else{
                        $("#numero-"+idPlus).html(parseInt($("#numero-"+id).html()) +1);
                        $('#div'+idPlus).removeAttr('hidden');
                         
                        //-envoi a ajax question encours- 
                        $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                            console.log(data);
                        })
                    }
                }
                else{
                    $("#numero-"+idPlus).html(parseInt($("#numero-"+id).html()) +1);
                    $('#div'+idPlus).removeAttr('hidden');
                        //-envoi a ajax-
                    $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                        console.log(data);
                    })
                }                   
                

                  
                //===Le bouton terminer===
                //-affichage-
                if(idPlus == <?=$question_size-1?>)
                {
                    $('.Terminer').removeAttr('hidden');
                    $('.Subtn').attr('hidden',true);
                } 
            }     
        });

        $("#assertion-6").change(function(e)
        {
            e.preventDefault();

            if($("#assertion-6").val() == 'No')
            {
                $('.Terminer').removeAttr('hidden');
                $('.Subtn').attr('hidden',true);                
            }else
            {
                $('.Terminer').attr('hidden',true);
                $('.Subtn').removeAttr('hidden');
            }
        })

        $('.Terminer').click(function(e)
        {
            e.preventDefault();
            id = e.target.getAttribute('id').split('-')[1];
            idPlus = parseInt(id) + 1;
            var error_found = false;

            //===checking de la reponse===
            if($('#reponse-'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-'+id).val());
            }

            if($('#assertion-'+id).val() != null)
            {
                $('#answer-'+id).val($('#assertion-'+id).val());
            }

            if($('#reponse-text'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-text'+id).val());
            }
            //===passage a la question suivante===
            if($('#answer-'+id).val() == '')
            {
                $('#error_found'+id).removeAttr('hidden'); 
            }else{
                 //-envoi a ajax question suivante-
                 if($("#assertion-7").val() == 'No')
                 {
                    $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+idPlus).val(),answer:'--'},function(data){
                    console.log(data);
                    })
                 }                 

                //-envoi a ajax-
                $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                    console.log(data);
                    location.assign("<?=site_url("passation/cognitive_exercice_process")?>");
                })               
            }
        })
    })
</script>