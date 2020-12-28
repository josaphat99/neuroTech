
<section class="content">
    <div class="content__inner content__inner--sm">
        <div class="card animated flipInX">
            <div class="card-body">
                <header class="content__title">
                    <h1><b>Modifier vos informations</b></h1>
                </header>            
                <form class="row" method='post' action=<?=site_url('signinup/profile')?>>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="nomcomplet" value="<?=$user[0]->nomcomplet?>">
                            <label>Nom complet</label>
                            <i class="form-group__bar"></i>
                        </div>                    

                        <div class="form-group form-group--float">                        
                            <input type="email" class="form-control" name="email" value="<?=$user[0]->email?>">
                            <label>Email</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="username" value="<?=$user[0]->username?>"> 
                            <label>Nom d'utilisateur</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="password" class="form-control" name="mdp" value="<?=$user[0]->mdp?>">
                            <label>Mot de passe</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="lieudeconsultation" value="<?=$user[0]->lieudeconsultation?>">
                            <label>Lieu de consultation</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="text-center">
                            <p id="error_message" class="text-red animated fadeInUp" hidden>Veuillez remplir tous les champs</p>
                            <button type="submit" class="btn btn--icon login__block__btn">
                                <i class="zmdi zmdi-check"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>