<div class="card animated flipInX" id="add" hidden>
        <div class="card-body">
            <header class="content__title">
                <h1><b>Patients</b></h1>
            </header>            
            <form class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" id="nomcomplet">
                        <label>Nom complet</label>
                        <i class="form-group__bar"></i>
                    </div>                    

                    <div class="form-group form-group--float">                        
                        <input type="email" class="form-control" id="email">
                        <label>Email</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" id="username">
                        <label>Nom d'utilisateur</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">                        
                        <input type="password" class="form-control" id="mdp">
                        <label>Mot de passe</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" id="lieudeconsultation">
                        <label>Lieu de consultation</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="text-center">
                        <p id="error_message" class="text-red animated fadeInUp" hidden>Veuillez remplir tous les champs</p>
                        <button type="submit" id="submit" class="btn btn--icon login__block__btn">
                            <i class="zmdi zmdi-check"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr id="hr" hidden>
    <br id="br" hidden>