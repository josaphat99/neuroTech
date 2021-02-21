<body data-ma-theme="green">
        <div class="login">           
<!--==========================================================================================-->
            <!-- Creation d'un nouveau compte-->

            <div class="login__block active" id="l-register">
                <div class="login__block__header palette-Blue bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Creer un nouveau compte
                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href=<?=site_url("signinup/connexion")?>>Avez-vous déjà un compte?</a>                                
                                <a class="dropdown-item" href=<?=site_url("acceuil/view_guide")?>>Guide d'utilisation</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <form action=<?=site_url('signinup/signup')?> method="post" id="form">
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="nomcomplet" id="nom">
                            <label>Nom complet</label>
                            <i class="form-group__bar"></i>
                        </div>                        
                        <p><span id="namespan"></span></p>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="lieudeconsultation" id="email">
                            <label>Email</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p><span id="emailspan"></span></p>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="lieudeconsultation" id="place">
                            <label>Lieu de consultation</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p><span id="placespan"></span></p>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="username" id="username">
                            <label>Nom d'utilisateur</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <p><span id="userspan"></span></p>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" class="form-control" name="mdp" id="mdp">
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>                  
                        <p><span id="mdpspan"></span></p>

                        <input type="text" value="signup" name="signup" hidden>
                        <button type="submit" id="Subtn" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
                    </form>
                </div>
            </div>        
        </div>


<!--Les scripts-->

<script>
    //=====================validation formulaire de login=======================
      
    var form = document.getElementById("form");
    var username = document.getElementById("username");
    var userspan = document.getElementById("userspan");
    var mdp = document.getElementById("mdp");
    var mdpspan = document.getElementById("mdpspan"); 
    var nom = document.getElementById("nom");
    var namespan = document.getElementById("namespan");
    var place = document.getElementById("place");
    var placespan = document.getElementById("placespan"); 
    var Subtn = document.getElementById("Subtn");  
    
    Subtn.addEventListener("click",function(e){
        e.preventDefault();
        
        if(username.value.length <= 0 || mdp.value.length <= 0 ||
        nom.value.length <= 0 || place.value.length <= 0){    
                  
            if(mdp.value.length <= 0){
                mdp.setAttribute("style","border-color:red;transition:2s");
                mdpspan.innerHTML = "Le mot de passe est requis";
                mdpspan.setAttribute("style","color:red;transition:1s;")
                console.log("mdp pass pas");
            }
            if(username.value.length <= 0){
                username.setAttribute("style","border-color:red;transition:1s")
                userspan.innerHTML = "Le nom d'utilisateur est requis";
                userspan.setAttribute("style","color:red;transition:2s;");
                console.log("username pass pas");
            }
            if(place.value.length <= 0){
                place.setAttribute("style","border-color:red;transition:1s")
                placespan.innerHTML = "Le lieu de consultation est requis";
                placespan.setAttribute("style","color:red;transition:2s;");
                console.log("place pass pas");
            }
            if(nom.value.length <= 0){
                nom.setAttribute("style","border-color:red;transition:1s")
                namespan.innerHTML = "Le nom complet est requis";
                namespan.setAttribute("style","color:red;transition:2s;");
                console.log("name pass pas");
            }
           
        }
        else{
            form.submit();
        }        
    });

    username.addEventListener("click",function(e){     
        username.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        userspan.innerHTML = "";        
    });

    mdp.addEventListener("click",function(e){
        mdp.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");
        mdpspan.innerHTML = "";        
    });
    nom.addEventListener("click",function(e){     
        nom.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        namespan.innerHTML = "";        
    });

    place.addEventListener("click",function(e){
        place.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");
        placespan.innerHTML = "";        
    });
</script>