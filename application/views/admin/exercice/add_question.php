<section class="content">
    <div class="content__inner">
        <header class="content__title">
        <h1><b>Nouvel exercice</b></h1>            
        </header>

        <form action=<?=site_url("exercice/add")?> method="post" id="form">
        <?php
            $nbquestion = $this->session->exercice['nbquestion'];
            for($i=0;$i < $nbquestion;$i++)
            {
        ?>     

        <div class="card animated zoomIn" id=<?=$i?> hidden>        
            <div class="card-body">
                <div class="content__title">
                    <h1 style="text-transform: initial;margin-left:-25px;margin-bottom:-15px;">
                        <b><?=$this->session->exercice['titre']?></b>
                    </h1>
                </div> 
                <p>Niveau: <?=$niveau?></p>
                <p>Nombre de questions: <?=$this->session->exercice['nbquestion']?></p>
                <p>Maximum: <?=$this->session->exercice['maximum']?></p><br>
                <h6 class="card-subtitle">Veuillez completer les questions en specifiant le type:</h6>
                <button type="button" class="btn btn-success">Question <?=$i+1?></button>
               <div class="row">
                <div class="col-md-6">
                        <h3 class="card-body__title"></h3>
                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name=<?="question".$i?> id=<?="question".$i?> autocomplete="off">
                            <label>Question</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name=<?="cote".$i?> id=<?="cote".$i?> autocomplete="off">
                            <label>Cote</label>
                            <i class="form-group__bar"></i>
                        </div>

                    </div>

                    <div class="col-md-6">      

                        <div class="form-group form-group--float">                
                            <label style="margin-top:-20px">Type de question</label>
                            <div class="select">
                                <select class="form-control type" name=<?="type".$i?> style="margin-top:5px" id=<?="type".$i?>>
                                    <option value="void"></option>
                                    <option value="traditionnelle">Trationnelle</option>
                                    <option value="choixmultiple">Choix multiple</option>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>                
                        </div>       

                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name=<?="vraiereponse".$i?> id=<?="v_reponse".$i?> autocomplete="off" hidden>
                            <label id=<?="v_reponse_label".$i?> hidden>Vraie reponse</label>
                            <i class="form-group__bar"></i>
                        </div> 
                        
                        <div class="row">
                            <div class="col-md-8 col-xs-3 col-sm-3" style="margin-top:-33px">
                                <div class="form-group form-group--float">
                                    <input type="text" class="form-control nbassert" name=<?="nbassert".$i?> id=<?="nbassert".$i?> autocomplete="off" hidden>                                
                                    <label id=<?="nbassert_label".$i?> hidden>Nombre d'assertions</label>
                                    <i class="form-group__bar"></i>
                                </div> 
                                <p class="text-red animated fadeIn" id=<?="error_assert".$i?> hidden>Veuillez saisir le nombre d'assertions</p>
                                <p class="text-red animated fadeIn" id=<?="error_nb_assert".$i?> hidden>Vous ne pouvez avoir qu'au plus 5 assertions</p>
                            </div>
                            <!--icon plus pour les assertions-->
                            <div class="col-md-2 col-sm-2 text-center">
                                <button class="btn btn--icon login__block__btn  animated bounceIn plus" id=<?="plus".$i?> title="completer les assertions" hidden>
                                    <i class="zmdi zmdi-plus"></i>
                                </button>
                            </div>                           
                        </div>    
                                        
                       <div class="row animated bounceInUp" id=<?="assert_space".$i?> hidden>      
                         <!--Partie assertions-->         
                       </div>
                                           
                    </div>                                      
               </div>     

               <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <div style="margin:auto">
                            <p id=<?="error_message".$i?> style="color:red" hidden>Veuillez remplir tous les champs SVP!!!</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div style="margin:auto">                                                
                        <button class="btn btn--icon login__block__btn Subtn"><i class="zmdi zmdi-arrow-right"></i></button>
                        <button class="btn login__block__btn ajouter" hidden>Ajouter</button>
                    </div> 
                </div>               
            </div>
        </div>      
        <?php
        }
        ?>
        <input type="text" value='question' name='question' hidden>  
        </form>
    </div>    
</section>

<!--=============================les scripts======================================-->
<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script>

<script>
   $(function()
   {
    //===Gestion de l'affichage des feuilles de questions===//

       $('#0').removeAttr('hidden');      
       $('#0').addClass('affiche');

        $('.Subtn').click(function(e)
        {      
            e.preventDefault();            
            for(var i =0; i < <?=$nbquestion?>; i++)
            { 
                if($('#'+i).hasClass('affiche'))
                {   
                    //===Validation du formulaire===
                    /*
                    *Partie assertion
                    *Si le champ nbassert est rempli, on verifie les champs assert. 
                    */
                    if($('#v_reponse'+i).val().length <= 0 && $('#nbassert'+i).val().length <= 0)
                    {
                        $('#'+i).removeClass('zoomIn');
                        $('#'+i).addClass('shake');
                        $('#error_message'+i).removeAttr('hidden');
                        break;
                    }
                    //===Control du champ nbassert===
                    if($('#nbassert'+i).val().length > 0)
                    {
                        var found = false;

                        for(var a = 1; a <= $('#nbassert'+i).val(); a++)
                        {
                            var add = i+1;

                            if($('#assert'+add+''+a).val().length <= 0)
                            {
                                $('#'+i).removeClass('zoomIn');
                                $('#'+i).addClass('shake');
                                $('#error_message'+i).removeAttr('hidden');
                                found = true;
                                break;
                            }
                            //===verification du bouton radio===
                            if($('#checkbox'+add+''+a+':checked').val())
                            {
                                $('#v_reponse'+i).val($('#assert'+add+''+a).val());                                
                            }
                        }
                        //===si un champ est vide on coupe la premiere boucle===
                        if(found){break;}
                    }

                    //===Partie question,cote,type===
                    if($('#question'+i).val().length <= 0 || $('#cote'+i).val().length <= 0 ||
                    $('.type')[i].value.length <= 0)
                    {
                        $('#'+i).removeClass('zoomIn');
                        $('#'+i).addClass('shake');
                        $('#error_message'+i).removeAttr('hidden');
                        break;
                        //===Fin validation===
                    }                    
                    else
                    {                     
                        //===Si il y avait erreur===
                        if($('#'+i).hasClass('shake'))
                        {
                            $('#'+i).removeClass('shake');
                            $('#'+i).addClass('zoomIn');
                            $('#error_message'+i).attr('hidden',true);
                        }

                        var j = i+1;

                        //===a la derniere question le bouton change===
                        if(j+1 == <?=$nbquestion?>)
                        {
                            $('.ajouter').removeAttr('hidden');
                            $('.Subtn').attr('hidden',true);                       
                        }    

                        $('#'+i).removeClass('affiche');  
                        $('#'+i).attr('hidden',true);
                        $('#'+j).removeAttr('hidden');
                        $('#'+j).addClass('affiche');                                          
                            
                        i++;break;  
                    }
                                        
                }                        
            }
        })
        //s'il n'y a qu'une question
        if(<?=$nbquestion?> == 1)
        {
            $('.ajouter').removeAttr('hidden');
            $('.Subtn').attr('hidden',true);                       
        } 

        //===En cliquant sur le bouton ajouter===
        $('.ajouter').click(function(e)
        {
            e.preventDefault();
            for(var i =0; i < <?=$nbquestion?>; i++)
            { 
                if($('#'+i).hasClass('affiche'))
                {   
                    //===Validation du formulaire===
                    if($('#v_reponse'+i).val().length <= 0 && $('#nbassert'+i).val().length <= 0)
                    {
                        $('#'+i).removeClass('zoomIn');
                        $('#'+i).addClass('shake');
                        $('#error_message'+i).removeAttr('hidden');
                        break;
                    }
                    //===Control du champ nbassert===
                    if($('#nbassert'+i).val().length > 0)
                    {
                        var found = false;

                        for(var a = 1; a <= $('#nbassert'+i).val(); a++)
                        {
                            var add = i+1;
                            if($('#assert'+add+''+a).val().length <= 0)
                            {
                                $('#'+i).removeClass('zoomIn');
                                $('#'+i).addClass('shake');
                                $('#error_message'+i).removeAttr('hidden');
                                found = true;
                                break;
                            }
                            //===verification du bouton radio===
                            if($('#checkbox'+add+''+a+':checked').val())
                            {
                                $('#v_reponse'+i).val($('#assert'+add+''+a).val());                                
                            }
                        }
                        //===si un champ est vide on coupe la premiere boucle===
                        if(found){break;}

                    }
                    //===partie question,cote,type===
                    if($('#question'+i).val().length <= 0 || $('#cote'+i).val().length <= 0 ||
                    $('.type')[i].value.length <= 0)
                    {
                        $('#'+i).removeClass('zoomIn');
                        $('#'+i).addClass('shake');
                        $('#error_message'+i).removeAttr('hidden');
                        break;
                    }
                    else
                    { 
                        $('#form').submit();
                    }
                }
            }
        })
    //===Fin gestion questions===

    //===Gestion du type de question===    

    $('.type').change(function(e)
    {          
        for(var q = 0; q < <?=$nbquestion?>; q++)
        {
            if($('.type')[q].value != "" && $('#'+q).hasClass('affiche'))
            {
                if($('.type')[q].value == 'traditionnelle')
                {
                    $("#v_reponse"+q).removeAttr('hidden');
                    $("#v_reponse_label"+q).removeAttr('hidden');
                    $('#nbassert'+q).attr('hidden',true);                    
                    $('#nbassert_label'+q).attr('hidden',true);  
                    $('#nbassert'+q).val("");
                    $('#plus'+q).attr('hidden',true);
                    $("#assert_space"+q).attr('hidden',true);
                     $('#error_assert'+q).attr('hidden',true);   
                    $('#error_nb_assert'+q).attr('hidden',true);
                }
                else if($('.type')[q].value == 'choixmultiple')
                {
                    $('#nbassert'+q).removeAttr('hidden');
                    $('#nbassert_label'+q).removeAttr('hidden');
                    $('#nbassert'+q).removeClass('shake');
                    $('#nbassert_label'+q).removeClass('shake');
                    $("#v_reponse"+q).attr('hidden',true);
                    $("#v_reponse_label"+q).attr('hidden',true);
                    $("#v_reponse"+q).val("");
                    $('#plus'+q).attr('hidden',true);
                }
                else
                {
                    $("#nbassert"+q).attr('hidden',true);
                    $("#nbassert_label"+q).attr('hidden',true);
                    $("#v_reponse"+q).attr('hidden',true);
                    $("#v_reponse_label"+q).attr('hidden',true);
                    $('#plus'+q).attr('hidden',true);
                }                
            }
        }
    })  
    //===Fin gestion du type de question===  

    //===Gestion des assertions===  
    $('.nbassert').click(function(e)
    {
        for(var q = 0; q < <?=$nbquestion?>; q++)
        {
            if($('#'+q).hasClass('affiche'))
            {      
                $('#plus'+q).removeAttr('hidden');               
                $('#error_assert'+q).attr('hidden',true);   
                $('#error_nb_assert'+q).attr('hidden',true);             
                // $('#assert'+q).removeAttr('hidden');                
            }
        }        
    })
    //===Fin assertions===

    //===Bouton plus===
    $('.plus').click(function(e)
    {
        e.preventDefault();
        for(var k = 0; k < <?=$nbquestion?>; k++)
        {
            if($('#'+k).hasClass('affiche'))
            {   
                if($('#nbassert'+k).val() > 5){
                    $('#error_nb_assert'+k).removeAttr('hidden');
                    $('#nbassert'+k).addClass('animated shake');
                    $('#nbassert_label'+k).addClass('animated shake');                    
                }
                else if($('#nbassert'+k).val() > 0 && $('#nbassert'+k).val() <=5 )
                {                                        
                    $.post('<?=site_url('ajax/assertion_ajax')?>', { nbassert: $('#nbassert'+k).val(), num_question: k+1},
                        function(data,textStatus, jqXHR) 
                        {
                            var indice = data.split(',')[0] - 1;
                            console.log(data.split(',')[1]);                            
                            $("#assert_space"+indice).removeAttr('hidden');
                            $("#assert_space"+indice).html(data.split(',')[1]);                           
                        });
                    // console.log($('#nbassert'+k).val());
                }
                else
                {
                    $('#error_assert'+k).removeAttr('hidden');
                    $('#nbassert'+k).addClass('animated shake');
                    $('#nbassert_label'+k).addClass('animated shake');                    
                }                          
            }
        }
    })
})  
</script>


