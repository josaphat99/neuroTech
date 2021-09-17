<div class="card animated fadeIn" id="add_doctor" hidden>
    <div class="card-body">
        <header class="content__title">
            <h1><b>Add a new doctor</b></h1>
        </header>            
        <form class="row" action="<?=site_url('utilisateur/add_doctor')?>" method="post">
            <div class="col-md-6 offset-md-3">
                <div class="form-group form-group--float">                        
                    <input type="text" class="form-control" name="nomcomplet" required>
                    <label>Full name</label>
                    <i class="form-group__bar"></i>
                </div>    

                <div class="form-group form-group--float">
                    <label style="margin-top:-9px">Gender</label>
                    <div class="select">
                        <select class="form-control" name="sex" id="sex" required>
                            <option value=""></option> 
                            <option value="Male">Male</option>   
                            <option value="Female">Female</option>   
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div> 

                <div class="form-group form-group--float">                        
                    <input type="email" class="form-control" name="email" required>
                    <label>Email</label>
                    <i class="form-group__bar"></i>
                </div>

                <div class="form-group form-group--float">                        
                    <input type="text" class="form-control" name="phone" required>
                    <label>Phone number</label>
                    <i class="form-group__bar"></i>
                </div>

                <!-- <div class="form-group form-group--float">                        
                    <input type="text" class="form-control" name="username" required>
                    <label>User name</label>
                    <i class="form-group__bar"></i>
                </div>

                <div class="form-group form-group--float">                        
                    <input type="password" class="form-control" name="mdp" required>
                    <label>Password</label>
                    <i class="form-group__bar"></i>
                </div>                 -->
                
                <div class="text-center">
                    <p id="error_message" class="text-red animated fadeInUp" hidden>Please give all the informations needed!!</p>
                    <button type="submit" id="submit" class="btn btn--icon login__block__btn">
                        <i class="zmdi zmdi-check"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>