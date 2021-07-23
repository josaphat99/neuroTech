<header class="header">
    <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>

    <div class="header__logo hidden-sm-down">      
        <h1><a href="#" style="font-family:JetBrains Mono;font-size:20px;font-weight:bold">  <img class="user__img" src=<?=base_url("assets/img/logo/brain-logo.png")?> alt="">neuroTech</a></h1>
    </div>


    <ul class="top-nav">       

        <li class="dropdown">
            <a href="#" data-toggle="dropdown"><i class="zmdi zmdi-account"></i> &nbsp;<?=ucfirst($this->session->type)?></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                <div class="listview listview--hover">
                    <div class="listview__header">
                    <img class="user__img" src=<?=base_url("assets/img/avatar/avatar.png")?> alt=""> <?=ucfirst($this->session->nomcomplet)?>                    
                    </div>

                    <a href=<?=site_url("signinup/profile")?> class="listview__item">
                        <div class="listview__content">
                            <div class="listview__heading">
                            <i class="zmdi zmdi-account" style="font-size: 20px;"></i>&nbsp;&nbsp; Profile
                            </div>                            
                        </div>
                    </a>
                    <?php
                        if($this->session->type == 'admin')
                        {
                    ?>                            
                        <a href=<?=site_url("utilisateur/add_user")?> class="listview__item">
                            <div class="listview__content">
                                <div class="listview__heading">
                                <i class="zmdi zmdi-account" style="font-size: 20px;"></i>&nbsp;&nbsp; Add a doctor
                                </div>                            
                            </div>
                        </a>
                    <?php
                        }
                    ?>
                    <a href=<?=site_url("signinup/deconnexion")?> class="listview__item">
                        <div class="listview__content">
                            <div class="listview__heading">
                            <i class="zmdi zmdi-arrow-left" style="font-size: 20px;"></i>&nbsp;&nbsp;Logout                                
                            </div>                            
                        </div>
                    </a>                
                </div>
            </div>
        </li>        
    </ul>
</header> 