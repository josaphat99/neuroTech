<style>
    .titre{     
        color:white;
    }
</style>

<?php
    if (!$no_exercice) {
        $margin_reponse = "margin-top:-20px";
        $question_size = count($questions); 
?>
<section class="content" id="section_exercice">

    <div class="content__inner">
        <header class="content__title">
            <h1><b>Exercice cognitif</b></h1><br>
            <p><b>Niveau : <?=$niveau?></b></p>              
        </header>
        <div class="card animated zoomIn">    
            <div class="stats__item bg-green"> 
                <header class="content__title">
                    <h1 class="text-center" style="color:white;font-size:22px"><b><?=$exercice->titre?></b></h1>              
                </header>
            </div>
            <div class="card-body">   
                <?php
                    $num = 0;
        for ($i=0;$i<count($questions);$i++) {
            $num +=1; ?>    
                <div id="<?="div".$i?>" class="animated zoomIn" hidden>
                    <div class="row">
                        <div class="listview listview--bordered q-a">
                            <div class="listview__item q-a__item">
                                <div class="q-a__stat hidden-sm-down">
                                    <span>
                                        <strong><?=$num?></strong>                                        
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
                                    if (isset($questions[$i]->image)) {
                                        $margin_reponse = "margin:auto";
                                        if (count($questions[$i]->image) ==1) {
                                            ?>
                                            <div class="col-md-7" style="margin-left:50px">
                                                <img src="<?=base_url("assets/files/questions/".$questions[$i]->image[0]->image)?>" alt="Objet" height="400px" with="400px">
                                            </div>
                                        <?php
                                        } elseif (count($questions[$i]->image) ==2) {
                                            ?>
                                             <div class="col-md-3" style="margin-left:50px">
                                                <img src="<?=base_url("assets/files/questions/".$questions[$i]->image[0]->image)?>" alt="Objet" height="150px" with="150px">
                                            </div>
                                            <div class="col-md-3" style="margin-left:50px">
                                                <img src="<?=base_url("assets/files/questions/".$questions[$i]->image[1]->image)?>" alt="Objet" height="150px" with="150px">
                                            </div>
                                        <?php
                                        } else {
                                            $span = 0;
                                            for ($im=0;$im<count($questions[$i]->image);$im++) {
                                                $span +=1; ?>
                                                
                                                    <div class="col-md-4" style="margin-top:3px">
                                                        <span><b><?=$span?></b></span>
                                                        <img src="<?=base_url("assets/files/questions/".$questions[$i]->image[$im]->image)?>" alt="Objet" height="150px" with="150px">
                                                    </div>                                
                                <?php
                                            }
                                        }
                                    } else {
                                        $margin_reponse = "margin-top:-20px";
                                    }
            if ($questions[$i]->cote > 0 && $questions[$i]->type=='traditionnelle') {
                ?>      
                                <div class="col-md-3" style=<?=$margin_reponse?> id="<?="div-reponse".$i?>">
                                    <div class="form-group form-group--float">                        
                                        <input type="text" class="form-control" id=<?="reponse-".$i?> autocomplete="off">
                                        <label id=<?="label-".$i?>>Reponse</label>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <?php
            }
            if ($questions[$i]->type=='choixmultiple') {
                ?>
                                        <div class="col-md-5" style="margin:auto">
                                            <div class="form-group form-group--float" id="div-reponse10">                        
                                                <div class="select">
                                                    <label></label>
                                                    <select class="form-control assertion" id=<?="assertion-".$i?> autocomplete="off">
                                                        <option id=<?="assert-".$i?>>Assertions</option>
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
            } ?>
                            
                    </div>
                                           
                    <div class="row">
                        <div style="margin:auto">
                            <input type="text" name="answer" id=<?="answer-".$i?> hidden>
                            <input type="text" name="id" id=<?="id-".$i?> value="<?=$questions[$i]->id?>" hidden>
                            <button class="btn btn--icon login__block__btn Subtn" id=<?="submit-".$i?>><i id=<?="icon-".$i?> class="zmdi zmdi-arrow-right"></i></button>
                            <button class="btn  login__block__btn Terminer" id=<?="terminer-".$i?>>Terminer</button>
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
            <p class="text-center">Vous avez déjà epuisé tous les exercices de ce niveau.</p>
            <br>
            <a href="<?=site_url('exercice/view_recommandation')?>"><button class="btn btn-success">Voir récommandation</button></a>
        </div>
    </div>
</div>
<?php
    }
?>
<script>
    $(function(){
        //===Affichage et masquage=== 
        $('#div0').removeAttr('hidden');
        $('.Terminer').attr('hidden',true);
        
        //===pour les questions a choix multiple===
        $('.assertion').focus(function(e)
        {
            e.preventDefault();

            id = e.target.getAttribute('id').split('-')[1];
            $('#assert-'+id).attr('disabled',true);
        })

        $('.Subtn').click(function(e){
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var idPlus = parseInt(id) + 1; 
            var error_found = false;
             //===passage a la question suivante===
             if(error_found == false)
            {
                $('#div'+id).attr('hidden',true);
                $('#div'+idPlus).removeAttr('hidden');
            }
            //===correction par rapport au type de question===
            //-question traditionnelle ou qcm-
            if($('#reponse-'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-'+id).val());
            }
            if($('#assertion-'+id).val() != null)
            {
                $('#answer-'+id).val($('#assertion-'+id).val());
            }
            
            //-envoi a ajax-
            if($('#answer-'+id).val() != '')
            {
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
        });

        $('.Terminer').click(function(e)
        {
            e.preventDefault();
            id = e.target.getAttribute('id').split('-')[1];
            var error_found = false;

            //===correction par rapport au type de question===
            //-question traditionnelle ou qcm-
            if($('#reponse-'+id).val() != null)
            {
                $('#answer-'+id).val($('#reponse-'+id).val());
            }
            if($('#assertion-'+id).val() != null)
            {
                $('#answer-'+id).val($('#assertion-'+id).val());
            }

            //-envoi a ajax-
            if($('#answer-'+id).val() != '')
            {
                $.post("<?=site_url('passation/correct_question_cognitive')?>",{question_id:$('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                    console.log(data);
                    location.assign("<?=site_url("passation/cognitive_exercice_process")?>");
                })
            }

            
        })
    
    })
</script>