<aside class="sidebar">
<div class="scrollbar-inner">
    <div class="user">
        <div class="user__info" data-toggle="dropdown">
            <img class="user__img" src=<?=base_url("assets/img/avatar/avatar.png")?> alt="">
            <div>
                <?php $t = explode(' ',$this->session->nomcomplet); $t_size = count($t);?>
                <div class="user__name"><?=$t[$t_size-1].' '.$t[0]?></div>
                <div class="user__email"><?=$this->session->email?></div>
            </div>
        </div>       
    </div>

    <ul class="navigation">
        <?php 
            if(trim($this->session->type) == trim('admin') || trim($this->session->type) == trim('doctor') || trim($this->session->type) == trim('reception')){                
        ?>        
                <li class="navigation__sub">
                    <a href="#"><i class="zmdi zmdi-account"></i> Users</a>
                    <ul>
                        <li><a href=<?=site_url('utilisateur/index')?>>List of users</a></li>               
                    </ul>
                </li>               
        <?php
            }if(trim($this->session->type) == trim('doctor')){
        ?>
                <li class="navigation__sub">
                    <a href="#"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>Tests</a>
                    <ul>
                        <li><a href=<?=site_url('exercice/index')?>>List of tests</a></li>
                        <li><a href=<?=site_url("exercice/add")?>>New test</a></li>                
                    </ul>
                </li>
        <?php
            }
            if(trim($this->session->type) == trim('patient')){
        ?>
              <li>
                    <a href=<?=site_url('passation')?> id="home"><i class="zmdi zmdi-home"></i>Home</a>                   
                </li>
                <li>
                    <a href=<?=site_url('exercice/view_consultations')?>><i class="zmdi zmdi-card-membership zmdi-hc-fw"></i> All past consultations</a>                   
                </li>
                <!-- <li>
                    <a href=<site_url('acceuil/view_guide')?>><i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>  User manual</a>                   
                </li> -->
        <?php
            }
        ?>
    </ul>
</div>
</aside>

<script>
    $(function(){
        $('#home').click(function(e)
        {
            e.preventDefault();
            $.post("<?=site_url('ajax/mmse_flash_check')?>",{flash:'mmse'},function(data){
                console.log(data);
            });
            location.assign("<?= site_url("passation")?>")
        });
    })
</script>