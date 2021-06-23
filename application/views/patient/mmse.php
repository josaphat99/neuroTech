
<style>
    .titre{     
        font-size: 20px;
        font-family:'Segoe UI';
        color:white;
    }
    .cadre{
        display:none;
    }
    .div-question{
        margin-top: -40px;
    }
    .phrase{
        margin-top: -35px;        
        padding-bottom: 20px;
    }

    .div-question-down{
        margin-top:40px;
    }
    .speaker{
        padding-bottom: 20px;
    }
</style>
<?php
    if(isset($recommanded))
    {
?>
        <script>
            $(function(){
                $('#section_mmse').removeAttr('hidden');
            })
        </script>
<?php
    }
?>
<section class="content" id="section_mmse" hidden>
    <div class="content__inner">
        <header class="content__title">
            <h1><b>test d'evaluation de la memoire</b></h1>              
        </header>
        <div class="card animated zoomIn">       
            <div class="stats__item bg-green"> 
                <h4 class="card-title text-center titre">Mini Mental State Examination</h4>
            </div>
            <div class="card-body">   
                <button class="btn btn-light" style="margin-top:-30px;" id="fonction"></button>           
                <?php
                    for($i=0;$i<count($question);$i++)
                    {
                ?>                        
                    <div id="<?="div".$i?>" class="div-question animated zoomIn" hidden>                        
                        <br><br>    
                        <div class="row">
                            <div class="col-md-11"> 
                                <div class="listview__content">
                                    <div class="listview__heading text-center" id="<?="phrase-".$i?>">                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <form action="<?=site_url('passation/mmse_process')?>" method="post" class="form-group">
                            <div class="row">                                            
                                <div class="listview listview--bordered q-a">
                                    <div class="listview__item q-a__item">
                                        <div class="q-a__stat hidden-sm-down">
                                            <span>
                                                <strong><?=$question[$i]->num_question?></strong>                                        
                                            </span>
                                        </div>
                                        <?php
                                            $img = false;
                                            if($i == 7 || $i ==8)
                                            {
                                                $img = true;
                                        ?>
                                                <div class="col-md-3">
                                                    <img src="<?=base_url("assets/files/questions/".$question[$i]->image)?>" alt="Objet" height="150px" with="150px">
                                                </div>
                                               <br><br>
                                        <?php
                                            }
                                        ?>
                                        <div class="col-md-7" id=<?="question-".$i?>>
                                            <div class="listview__content" style="margin-top:18px">
                                                <div class="listview__heading"><?=$question[$i]->question?></div>
                                            </div>
                                        </div>
                                        <?php
                                            if($question[$i]->num_question == 1)
                                            {                                        
                                        ?>
                                            <div class="col-md-5" style="margin-top:-35px" id=<?="reponse-".$i?>>
                                                <div class="form-group form-group--float">
                                                    <label style="margin-top:-11px"></label>
                                                    <div class="select">
                                                        <select class="form-control" id="annee" autocomplete="off">
                                                            <option id="saison_option">Year</option>
                                                            <?php
                                                                $index_tab = [];
                                                                for($y=7;$y>=0;$y--){
                                                                    $index = random_int(0,$y);
                                                                    if (!in_array($index, $index_tab)) {
                                                                        ?>
                                                                <option value="<?=date('Y', time()) - $index?>"><?=date('Y', time()) - $index?></option>
                                                            <?php
                                                                $index_tab[]=$index;
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group--float">
                                                    <label style="margin-top:-11px"></label>
                                                    <div class="select">
                                                        <select class="form-control" id="saison" autocomplete="off">
                                                            <option id="saison_option">Saison</option>
                                                            <option value="pluie">Rain</option>
                                                            <option value="seche">Dry</option>
                                                        </select>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group--float">                        
                                                <label style="margin-top:-11px"></label>
                                                    <div class="select">
                                                        <select class="form-control" id="mois" autocomplete="off">
                                                            <option id="mois_option">Month</option>
                                                            <option value=1>January</option>
                                                            <option value=2>February</option>
                                                            <option value=3>March</option>
                                                            <option value=4>April</option>
                                                            <option value=5>May</option>
                                                            <option value=6>June</option>
                                                            <option value=7>Jully</option>
                                                            <option value=8>August</option>
                                                            <option value=9>September</option>
                                                            <option value=10>October</option>
                                                            <option value=11>November</option>
                                                            <option value=12>December</option>
                                                        </select>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group--float">                        
                                                    <label style="margin-top:-11px"></label>
                                                    <div class="select">
                                                        <select class="form-control" id="jours_mois" autocomplete="off">
                                                            <option id="mois_option">Day of month</option>
                                                            <?php
                                                                for($l=1;$l<=31;$l++)
                                                                {
                                                            ?>
                                                                <option value=<?=$l?>><?=$l?></option>
                                                            <?php
                                                                }
                                                            ?>                                                            
                                                        </select>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group--float">                        
                                                    <div class="select">
                                                        <label style="margin-top:-11px"></label>
                                                        <select class="form-control" id="jours_semaine" autocomplete="off">
                                                            <option id="jsemaine_option">Week day</option>
                                                            <option value=1>Monday</option>
                                                            <option value=2>Tuesday</option>
                                                            <option value=3>Wednesday</option>
                                                            <option value=4>Thursday</option>
                                                            <option value=5>Friday</option>
                                                            <option value=6>Saturday</option>
                                                            <option value=0>Sunday</option>                                                            
                                                        </select>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                            </div>       
                                    <?php
                                        }else{
                                            if ($question[$i]->num_question != 4 && 
                                                $question[$i]->num_question != 5 && 
                                                $question[$i]->num_question != 10
                                            ) 
                                            {
                                                ?>      
                                            <div class="col-md-5" style="margin-top:-35px" id="<?="div-reponse".$i?>">
                                                <div class="form-group form-group--float">                        
                                                    <input type="text" class="form-control" id=<?="reponse-".$i?> autocomplete="off">
                                                    <label id=<?="label-".$i?>>Reponse</label>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </div>
                                    <?php
                                            }
                                            if($question[$i]->num_question == 5)
                                            {
                                            ?>
                                            <div class="row" style="margin-top:-35px">
                                            <?php
                                                for($p=1;$p<=15;$p++)
                                                {
                                            ?>
                                                <div class="col-md-2">
                                                    <div class="form-group form-group--float">                        
                                                        <input type="text" class="form-control" id=<?="nb-".$p?> autocomplete="off">
                                                        <label><?=$p==1? '100':''?></label>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>                                                
                                            <?php
                                            }
                                            ?>
                                            </div>                                                
                                    <?php
                                            }
                                            if($question[$i]->num_question == 10)
                                            {
                                    ?>
                                    <div class="col-md-5" style="margin-top:-35px">
                                        <div class="form-group form-group--float" id="div-reponse10">                        
                                            <div class="select">
                                                <label style="margin-top:-7px">Reponse</label>
                                                <select class="form-control" id="reponse10" autocomplete="off">
                                                    <option></option>
                                                    <option value='met,si,est'>Met,Si,Est</option>
                                                    <option value='mais,ci,et'>Mais,Ci,Et</option>
                                                    <option value='mais,si,et'>Mais,Si,Et</option>
                                                    <option value='met,si,et'>Met,Si,Et</option>                                                                                                                      
                                                </select>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                                
                                    <?php
                                            }
                                        }
                                    ?>                  
                                    </div>
                                </div>                    
                            </div>     
                        <div class="row">
                            <div style="margin:auto">
                                    <input type="text" name="answer" id=<?="answer-".$i?> hidden>
                                    <input type="text" name="id" id=<?="id-".$i?> value="<?=$question[$i]->id?>" hidden>
                                <button class="btn btn--icon login__block__btn Subtn" id=<?="submit-".$i?>><i id=<?="icon-".$i?> class="zmdi zmdi-arrow-right"></i></button>
                                <button class="btn  login__block__btn Terminer" id=<?="terminer-".$i?>>Terminer</button>
                            </div>
                        </div>                                             
                    </div>               
                <?php
                }
                ?>          
                </form>          
            </div>
        </div>
    </div>
</section>


<!--Les scripts-->
<script>

    $(function(e)
    {
        //===Placement de questions===
        for(var i =0 ;i < <?=count($question)?>; i++)
        {
            //orientation
            if(i==0)
            {
                $('#phrase-'+i).html('I will ask you some questions to appreciate how your memory works, some of theme are easier, others a bit less, you must answer as well as you can!');
                $('#fonction').html('Orientation');
                $('#submit-0').attr('disabled','disabled');
                setTimeout(function(){$('#submit-0').removeAttr('disabled');},20000);
                // $('#div'+i).removeClass('div-question');
            }          

            if(i==1)
            {
                $('#phrase-'+i).html('Je vais vous poser maintenant quelques questions sur l\'endroit où nous sommes.');
                $('#submit'+i).attr('hidden',true);
            }                

            if(i==2)
            {
                $('#phrase-'+i).html('Je vais vous poser maintenant quelques questions sur l\'endroit où nous sommes.');
            }

            //===Apprentissage===
            if(i==3)
            {
                $('#phrase-'+i).html('Je vais vous dire trois mots; je voudrais que vous me les répétiez et que vous essayiez de les retenir car je vous les redemanderai tout à l\'heure.');
                $('#question-'+i).removeClass('col-md-7');
                $('#question-'+i).addClass('col-md-12');
            }

            if(i==6)
            {
                // $('#fonction-'+i).html('Attention et calcul');
                $('#label-'+i).html('Exemple: Mot1,Mot2,Mot3');
                // $('#div'+i).addClass('div-question-down');
            }

            // if(i==5)
            // {
            //     $('#fonction-'+i).removeClass('btn-light');
            // }
            
            // if(i==6)
            // {
            //     // $('#fonction-'+i).html('Rappel');
            //     $('#div'+i).removeClass('div-question');
            //     $('#div'+i).addClass('div-question-down');
            // }

            if(i==7)
            {
                $('#question-'+i).removeClass('col-md-7');
                $('#question-'+i).addClass('col-md-4');
            }

            if(i==8)
            {
                $('#question-'+i).removeClass('col-md-7');
                $('#question-'+i).addClass('col-md-4');
            }

            if(i == 9)
            {
                $('#div-reponse'+i).removeClass('col-md-5');
                $('#div-reponse'+i).addClass('col-md-12');
            }
        }        

        //===On commence par afficher uniquement la premeire question===
        $('#div0').removeAttr('hidden');

        $('.Terminer').attr('hidden',true);

        //===passage a une autre question===
        $('.Subtn').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var idPlus = parseInt(id) + 1; 
            var error_found = false;
            //===Ajax===
            if(id != 0 && id != 3 && id != 4)
            {
                //-validation du formulaire-
                if($('#reponse-'+id).val().length <= 0)
                {
                    error_found = true;
                }
                $('#answer-'+id).val($('#reponse-'+id).val());
            }else{
                if(id == 0)
                {
                    //-validation du formulaire-
                    if($('#annee').val().length <= 0 || $('#saison').val().length <= 0 || 
                        $('#mois').val().length <= 0 || $('#jours_mois').val().length <= 0 || 
                        $('#jours_semaine').val().length <= 0
                        )
                    {
                        error_found = true;
                    }
                    $('#answer-'+id).val(
                        $('#annee').val()+','+$('#saison').val()+','+$('#mois').val()+','+$('#jours_mois').val()+
                        ','+$('#jours_semaine').val()
                    );
                    
                }else if(id == 4)
                {
                    //-validation du formulaire-
                    if($('#nb-1').val().length <= 0)
                    {
                        error_found = true;
                    }

                    $('#answer-'+id).val($('#nb-1').val());

                    for(var h=2;h<=15;h++)
                    {
                        if($('#nb-'+h).val().length <= 0)
                        {
                            error_found = true;
                        }

                        $('#answer-'+id).val($('#answer-'+id).val()+','+$('#nb-'+h).val());
                    }
                }
            }

            if(id != 3 && error_found == false)
            {
                $.post("<?=site_url('passation/correct_question_mmse')?>",{indice:id,id: $('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                    console.log(data);
                })
                console.log($('#answer-'+id).val());
            }
            

            if(id == 0 && error_found == false)
            {
                $('#question-'+idPlus).attr('hidden',true);
                $('#submit-'+idPlus).attr('disabled','disabled');
                $('#question-'+idPlus).addClass('animated fadeInLeft')
                setTimeout(function(){ $('#question-'+idPlus).removeAttr('hidden');
                    $('#submit-'+idPlus).removeAttr('disabled');}, 5000);

                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Je vais vous poser maintenant, quelques questions sur l\'endroit où nous sommes. Quel est, le nom de la ville où nous sommes.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);

            }                  
            if(id == 1 && error_found == false)
            {
                $('#div'+idPlus).removeClass('animated');
                $('#question-'+idPlus).addClass('animated fadeInLeft');
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Dans quelle province ou région sommes-nous.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }
            if(id == 2 && error_found == false)
            {
                $('#fonction').html('Apprentissage');
                $('#question-'+idPlus).attr('hidden',true);
                $('#question-'+idPlus).addClass('animated fadeInLeft');
                $('#submit-'+idPlus).attr('disabled','disabled');

                setTimeout(function(){ $('#question-'+idPlus).removeAttr('hidden'); }, 8000);
                setTimeout(function(){ $('#submit-'+idPlus).removeAttr('disabled'); }, 13000);

                var question = $('#question-'+idPlus).html();
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Je vais vous dire trois mots; je voudrais que vous me les répétiez et que vous essayiez de les retenir car je vous les redemanderai tout à l\'heure. Cigare, Fleur, Porte';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;

                var mot = new SpeechSynthesisUtterance();
                mot.lang = "fr-Fr";
                mot.volume = 1;
                mot.rate = 0.7;
                mot.pitch = 1;
                mot.text = 'cigare, fleur, porte';

                speechSynthesis.speak(speech);
                speechSynthesis.speak(mot);
            }

            if(id == 3 && error_found == false)
            {
                $('#fonction').html('Attention et calcul');
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Voulez-vous compter à partir de 100 en retirant 7 à chaque fois.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }
            if(id == 4 && error_found == false)
            {
                $('#question-'+idPlus).attr('hidden',true);
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Voulez-vous, épeler, le mot MONDE, à l\'envers?';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;

                var i = 0;
                while(i<=1)
                {
                    speechSynthesis.speak(speech);
                    i++;
                }
            }

            if(id == 5 && error_found == false)
            {
                $('#fonction').html('Rappel');
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Pouvez-vous me dire quels étaient les 3 mots que je vous ai demandés de répéter et de réténir tout à l\'heure?';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }
            if(id == 6 && error_found == false)
            {
                $('#fonction').html('Langage');
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Quel est le nom de cet objet.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }
            if(id == 7 && error_found == false)
            {
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Quel est le nom de cet objet.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }

            if(id == 8 && error_found == false)
            {
                $('#question-'+idPlus).html('Ecoutez bien et repetez apres mois:');
                $('#div-reponse10').attr('hidden',true);
                $('#submit-'+idPlus).attr('hidden',true);
                $('#terminer-'+idPlus).removeAttr('hidden');
                $('#terminer-'+idPlus).attr('disabled','disabled');

                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Ecoutez bien et repetez apres mois. PAS DES MAIS, DE SI, NI DE ET.';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
                
                var mot = new SpeechSynthesisUtterance();
                mot.lang = "fr-Fr";
                mot.volume = 1;
                mot.rate = 0.7;
                mot.pitch = 1;
                mot.text = 'PAS DES MAIS, DE SI, NI DE ET. Quels sont les trois mots qui figurent dans cette phrase.';
                speechSynthesis.speak(mot);

                setTimeout(function(){ 
                    $('#div-reponse10').addClass('animated fadeInRight');
                    $('#div-reponse10').removeAttr('hidden');
                    $('#terminer-'+idPlus).removeAttr('disabled');
                 }, 10000);
                
            }
            //===capture d'erreur===
            if(error_found == true)
            {                
                var speech = new SpeechSynthesisUtterance();
                speech.lang = "fr-Fr";
                speech.text = 'Rassurez-vous d\'avoir bien repondu avant de passer à la question suivante!!';
                speech.volume = 1;
                speech.rate = 0.7;
                speech.pitch = 1;
                speechSynthesis.speak(speech);
            }
            //===passage a la question suivante===
            if(error_found == false)
            {
                $('#div'+id).attr('hidden',true);
                $('#div'+idPlus).removeAttr('hidden');
            }
            
        });

        //===Bouton terminer===
        $('.Terminer').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];

            if(id == 9)
            {
                if($('#reponse10').val().length <= 0)
                {
                    var speech = new SpeechSynthesisUtterance();
                    speech.lang = "fr-Fr";
                    speech.text = 'Veuillez repondre à la question s\'il vous plait!!';
                    speech.volume = 1;
                    speech.rate = 0.7;
                    speech.pitch = 1;
                    speechSynthesis.speak(speech);
                }else{
                    $('#answer-'+id).val($('#reponse10').val());

                    $.post("<?=site_url('passation/correct_question_mmse')?>",{indice:id,id: $('#id-'+id).val(),answer:$('#answer-'+id).val()},function(data){
                        console.log(data);
                        location.assign("<?=site_url("passation/mmse_process")?>");
                    })
                }
            }
        })
        // $('#submit0').click(function(e){
        //     e.preventDefault();
        //     console.log('bonjour jquery');
        //     var speech = new SpeechSynthesisUtterance();

        //     speech.lang = "fr-Fr";
        //     speech.text = 'Voulez-vous, épeler, le mot MONDE à l\'envers.';
        //     speech.volume = 1;
        //     speech.rate = 0.7;
        //     speech.pitch = 1;
        //     speechSynthesis.speak(speech);

        //     console.log(speechSynthesis.getVoices());
        // });
        $('#saison').focus(function(e){
            $('#saison_option').attr('disabled','disabled');
        })
        $('#mois').focus(function(e){
            $('#mois_option').attr('disabled','disabled');
        })
        $('#jours_semaine').focus(function(e){
            $('#jsemaine_option').attr('disabled','disabled');
        })
    })

</script>