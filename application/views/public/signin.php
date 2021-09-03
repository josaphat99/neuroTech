
<body data-ma-theme="green">
    <div class="login animated fadeIn" id="login-section">

        <!-- Login -->
        <div class="login__block active" id="l-register">
            <div class="login__block__header">
                <i class="zmdi zmdi-account-circle"></i>
                Login please       
                <!-- <div class="actions actions--inverse text-right">
                    <div class="dropdown">
                        <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href=<site_url("acceuil/view_guide")?>>How to use the app?</a>
                        </div>
                    </div>
                </div>              -->
            </div>                
            
            <div class="login__block__body">                   
                <form action=<?=site_url("signinup/connexion")?> method="post" id="form">

                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control" name="username" id="username1">
                        <label>User name</label>
                        <i class="form-group__bar"></i>                            
                    </div>

                    <p><span id="userspan"></span></p>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="password" class="form-control" name="mdp" id="mdp1">
                        <label>Password</label>
                        <i class="form-group__bar"></i>                            
                    </div>      

                    <p><span id="mdpspan"></span></p>

                    <input type="text" value="login" name="login" hidden>
                    <p style="color:red"><?=$this->session->error_login?></p>
                    <button type="submit" id="loginSub" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>                    
                </form>                    
            </div>         
        </div>
    </div>    


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
                mdpspan.innerHTML = "The password is required";
                mdpspan.setAttribute("style","color:red;transition:1s;")
            }
            if(username1.value.length <= 0){
                username1.setAttribute("style","border-color:red;transition:1s")
                userspan.innerHTML = "The user name is required";
                userspan.setAttribute("style","color:red;transition:2s;");
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

