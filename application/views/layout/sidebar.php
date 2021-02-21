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
            if(trim($this->session->type) == trim('admin')){                
        ?>        
                <li class="navigation__sub">
                    <a href="#"><i class="zmdi zmdi-account"></i> Utilisateurs</a>
                    <ul>
                        <li><a href=<?=site_url('utilisateur/index')?>>Liste d'utilisateurs</a></li>               
                    </ul>
                </li>
                <li class="navigation__sub">
                    <a href="#"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>Exercices</a>
                    <ul>
                        <li><a href=<?=site_url('exercice/index')?>>Liste d'exercices</a></li>
                        <li><a href=<?=site_url("exercice/add")?>>Nouvel exercice</a></li>                
                    </ul>
                </li>
        <?php
            }else{
        ?>
              <li>
                    <a href=<?=site_url('passation')?> id="home"><i class="zmdi zmdi-home"></i>Acceuil</a>                   
                </li>
                <li>
                    <a href=<?=site_url('exercice/view_recommandation')?>><i class="zmdi zmdi-receipt zmdi-hc-fw"></i>Recommandations</a>                   
                </li>
                <li>
                    <a href=<?=site_url('acceuil/view_guide')?>><i class="zmdi zmdi-receipt zmdi-hc-fw"></i>Guide d'utilisation</a>                   
                </li>
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