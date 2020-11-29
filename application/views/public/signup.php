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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <form action=<?=site_url('signinup/signup')?> method="post">
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="nomcomplet">
                            <label>Nom complet</label>
                            <i class="form-group__bar"></i>
                        </div>                        

                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="lieudeconsultation">
                            <label>Lieu de consultation</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" name="username">
                            <label>Nom d'utilisateur</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" class="form-control" name="mdp">
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>                  
                        <input type="text" value="signup" name="signup" hidden>
                        <button type="submit" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
                    </form>
                </div>
            </div>        
        </div>


<!--Les scripts-->

<script>
    //=====================validation formulaire de login=======================
      
    var form = document.getElementById("form");
    var username1 = document.getElementById("username1");
    var mdp1 = document.getElementById("mdp1");
    var loginSub = document.getElementById("loginSub");    
    var userspan = document.getElementById("userspan");
    var mdpspan = document.getElementById("mdpspan");   

    loginSub.addEventListener("click",function(e){
        e.preventDefault();
        
        if(username1.value.length <= 0 || mdp1.value.length <= 0){    
                  
            if(mdp1.value.length <= 0){
                mdp1.setAttribute("style","border-color:red;transition:2s");
                mdpspan.innerHTML = "Le mot de passe est requis";
                mdpspan.setAttribute("style","color:red;transition:1s;")
                console.log("mdp pass pas");
            }
            if(username1.value.length <= 0){
                username1.setAttribute("style","border-color:red;transition:1s")
                userspan.innerHTML = "Le nom d'utilisateur est requis";
                userspan.setAttribute("style","color:red;transition:2s;");
                console.log("username pass pas");
            }
        }
        else{
            form.submit();
        }        
    });

    username1.addEventListener("click",function(e){     
        username1.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");   
        userspan.innerHTML = "";        
    });

    mdp1.addEventListener("click",function(e){
        mdp1.setAttribute("style","border-color:rgba(0,0,50,0.1);transition:2s");
        mdpspan.innerHTML = "";        
    });
</script>