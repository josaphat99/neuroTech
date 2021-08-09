
<section class="content">
    <div class="content__inner content__inner--sm">
        <div class="card animated flipInX">
            <div class="card-body">
                <header class="content__title">
                    <h1><b>Manage your informations</b></h1>
                </header>            
                <form class="row" method='post' action=<?=site_url('signinup/profile')?>>
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group form-group--float">                        
                            <input type="email" class="form-control" name="email" value="<?=$user[0]->email?>" required>
                            <label>Email</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="username" value="<?=$user[0]->username?>" required> 
                            <label>Username</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="password" class="form-control" name="mdp" value="<?=$user[0]->mdp?>" required>
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="phone" value="<?=$user[0]->phone?>" required>
                            <label>Phone</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="town" value="<?=$user[0]->town?>" required>
                            <label>Town</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="street" value="<?=$user[0]->street?>" required>
                            <label>Street</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float">                        
                            <input type="text" class="form-control" name="house_number" value="<?=$user[0]->house_number?>" required>
                            <label>House number</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="text-center">
                            <p id="error_message" class="text-red animated fadeInUp" hidden>Please! make sure you have given all the needed informations</p>
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