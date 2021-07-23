<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1><b>New test</b></h1>              
        </header>
        <div class="card animated rotateInDownLeft">        
            <div class="card-body">
                <h4 class="card-title">Add a new test</h4>                
                <h6 class="card-subtitle">Please complete the form fields by following the different steps:</h6>

                <form action=<?=site_url("exercice/add")?> class="row" method="post" id="form"> 
                   
                    <!--Premiere colonne-->
                    <div class="col-md-6">
                        <h3 class="card-body__title"></h3>

                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name="titre" id="titre">
                            <label>Title</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p><span id="titreSpan"></span></p>
                    </div>

                    <!--Deuxieme colonne-->
                    <div class="col-md-6">
                        <h3 class="card-body__title"></h3>
                        <div class="form-group form-group--float">
                            <input type="text" class="form-control" name="nbquestion" id="nbquestion">
                            <label>Number of questions</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p><span id="nbquestionSpan"></span></p>                       
                    </div>

                    <div style="margin:auto">
                        <input type="text" value='exercice' name='exercice' hidden>
                        <button type="submit" id="Subtn" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-arrow-right"></i></button>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</section>


<!--Les scripts-->

<script>
    //=====================validation formulaire de login=======================
      
    var form = document.getElementById("form");
    var titre = document.getElementById("titre");
    var titreSpan = document.getElementById("titreSpan");   
    var nbquestion = document.getElementById("nbquestion");
    var nbquestionSpan = document.getElementById("nbquestionSpan");    
    var Subtn = document.getElementById("Subtn");  
    
    Subtn.addEventListener("click",function(e){
        e.preventDefault();
        
        if(titre.value.length <= 0 ||nbquestion.value.length <= 0){    
                  
            if(titre.value.length <= 0){
                titre.setAttribute("style","border-color:red;transition:2s");
                titreSpan.innerHTML = "Le titre de l'exercice est requis";
                titreSpan.setAttribute("style","color:red;transition:1s;")
                console.log("titre pass pas");
            }
            if(nbquestion.value.length <= 0){
                nbquestion.setAttribute("style","border-color:red;transition:1s")
                nbquestionSpan.innerHTML = "Le nombre des questions est requis";
                nbquestionSpan.setAttribute("style","color:red;transition:2s;");
                console.log("nbquestion pass pas");
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

    nbquestion.addEventListener("click",function(e){     
        nbquestion.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        nbquestionSpan.innerHTML = "";        
    });
</script>