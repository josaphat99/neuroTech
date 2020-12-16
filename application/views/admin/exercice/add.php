<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1><b>Nouvel exercice</b></h1>              
        </header>
        <div class="card animated rotateInDownLeft">        
            <div class="card-body">
                <h4 class="card-title">Ajout d'un nouvel exercice cognitif</h4>                
                <h6 class="card-subtitle">Veuillez remplir les champs du formulaire en suivant les differentes etapes:</h6>

                <form action=<?=site_url("exercice/add")?> class="row" method="post" id="form"> 
                <!--Premiere colonne-->
                <div class="col-md-6">
                    <h3 class="card-body__title"></h3>

                    <div class="form-group form-group--float">
                        <input type="text" class="form-control" name="titre" id="titre">
                        <label>Titre</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <p><span id="titreSpan"></span></p>

                    <div class="form-group form-group--float">
                        <input type="text" class="form-control" name="maximum" id="maximum">
                        <label>Maximum</label>
                        <i class="form-group__bar"></i>
                    </div>   
                    <p><span id="maximumSpan"></span></p>         
                </div>
                <!--Deuxieme colonne-->
                <div class="col-md-6">
                <h3 class="card-body__title"></h3>
                <div class="form-group form-group--float">
                    <input type="text" class="form-control" name="nbquestion" id="nbquestion">
                    <label>Nombre de questions</label>
                    <i class="form-group__bar"></i>
                </div>
                <p><span id="nbquestionSpan"></span></p> 

                <div class="form-group form-group--float">
                    <label style="margin-top:-9px">Niveau</label>
                    <div class="select">
                        <select class="form-control" name="niveau" id="niveau">
                            <option></option>
                            <?php
                                foreach($niveau as $n){
                            ?>
                                    <option value=<?=$n->id?>><?=$n->nom?></option>
                            <?php
                                }
                            ?>                    
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div>        
                <p><span id="niveauSpan"></span></p>     
            </div>
            <div style="margin:auto">
                <input type="text" value='exercice' name='exercice' hidden>
                <button type="submit" id="Subtn" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>    
            </form>
        </div>
    </div>
</div>


<!--Les scripts-->

<script>
    //=====================validation formulaire de login=======================
      
    var form = document.getElementById("form");
    var titre = document.getElementById("titre");
    var titreSpan = document.getElementById("titreSpan");
    var maximum = document.getElementById("maximum");
    var maximumSpan = document.getElementById("maximumSpan"); 
    var nbquestion = document.getElementById("nbquestion");
    var nbquestionSpan = document.getElementById("nbquestionSpan");
    var niveau = document.getElementById("niveau");
    var niveauSpan = document.getElementById("niveauSpan"); 
    var Subtn = document.getElementById("Subtn");  
    
    Subtn.addEventListener("click",function(e){
        e.preventDefault();
        
        if(titre.value.length <= 0 || maximum.value.length <= 0 ||
        nbquestion.value.length <= 0 || niveau.value.length <= 0){    
                  
            if(titre.value.length <= 0){
                titre.setAttribute("style","border-color:red;transition:2s");
                titreSpan.innerHTML = "Le titre de l'exercice est requis";
                titreSpan.setAttribute("style","color:red;transition:1s;")
                console.log("titre pass pas");
            }
            if(maximum.value.length <= 0){
                maximum.setAttribute("style","border-color:red;transition:1s")
                maximumSpan.innerHTML = "Le maximum est requis";
                maximumSpan.setAttribute("style","color:red;transition:2s;");
                console.log("maximum pass pas");
            }
            if(nbquestion.value.length <= 0){
                nbquestion.setAttribute("style","border-color:red;transition:1s")
                nbquestionSpan.innerHTML = "Le nombre des questions est requis";
                nbquestionSpan.setAttribute("style","color:red;transition:2s;");
                console.log("nbquestion pass pas");
            }
            if(niveau.value.length <= 0){
                niveau.setAttribute("style","border-color:red;transition:1s")
                niveauSpan.innerHTML = "Le niveau de l'exercice est requis";
                niveauSpan.setAttribute("style","color:red;transition:2s;");
                console.log("niveau pass pas");
            }
           
        }
        else{
            form.submit();
        }        
    });

    titre.addEventListener("click",function(e){     
        titre.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        titreSpan.innerHTML = "";        
    });

    maximum.addEventListener("click",function(e){
        maximum.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");
        maximumSpan.innerHTML = "";        
    });
    nbquestion.addEventListener("click",function(e){     
        nbquestion.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        nbquestionSpan.innerHTML = "";        
    });

    niveau.addEventListener("click",function(e){
        niveau.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");
        niveauSpan.innerHTML = "";        
    });
</script>