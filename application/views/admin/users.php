<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->user_add))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Utilisateur enrégistré',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Utilisateurs</b></h1>
    </header>

    <div class="card animated zoomIn" id="patient">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-3 content__title">
                    <h1><b>Patients</b></h1>
                </div>
                <div class="col-md-1 offset-md-8">
                    <button class="btn btn--icon login__block__btn" id="plus">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nom complet</th>
                            <th>Type</th>
                            <th>Nom d'utilisateur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="user_space">
                        <?php
                            $num = 0;
                            foreach($patients as $p)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$p->nomcomplet?></td>
                                    <td><?=$p->type?></td>
                                    <td><?=$p->username?></td>
                                    <td>
                                        <button class="btn btn-success btn--raised"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("utilisateur/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Supprimer">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form>                                                                                 
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr id="hr1">
    <br>
    
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
    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h1><b>Admins</b></h1>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Nom complet</th>
                            <th>Type</th>
                            <th>Nom d'utilisateur</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body-admin">
                        <?php
                            $num = 0;
                            foreach($admins as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$a->nomcomplet?></td>
                                    <td><?=$a->type?></td>
                                    <td><?=$a->username?></td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</section>

<script>
    var del = document.getElementById('delete');
    var form = document.getElementById('form-delete');

    del.addEventListener('click',function(e){
        e.preventDefault();
        form.click();
    }); 

    function confirmation(anchor)
    {
        Swal.fire({
        title: 'Voulez-vous vraiment supprimer cet Utilisateur?',
        text: "Vous ne serez plus capable de le récupérer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Supprimé!',
                'Utilisateur supprimé.',
                'success'
                )
                anchor.submit();
            }
        })
    }  

    //jquery
    $(function(e)
    {
        $('#plus').click(function(e)
        {
            e.preventDefault();

            $('#patient').attr('hidden',true);
            $('#hr1').attr('hidden',true);
            $('#add').removeAttr('hidden');
            $('#hr').removeAttr('hidden');
            $('#br').removeAttr('hidden');
        })

        //===selection des elements===
        var nom = $('#nomcomplet');
        var email = $('#email');
        var username = $('#username');
        var mdp = $('#mdp');
        var lieu = $('#lieudeconsultation');
        
        $('#submit').click(function(e)
        {
            e.preventDefault();

            if(nom.val().length <= 0 || email.val().length <= 0 || username.val().length <= 0
            || mdp.val().length <= 0 || lieu.val().length <= 0)
            {
                $('#error_message').removeAttr('hidden');
            }
            else
            {
                $('#error_message').attr('hidden',true);

                $.post('<?=site_url('ajax/add_user')?>', { nomcomplet: nom.val(), email: email.val(), username:username.val(),
                mdp:mdp.val(),lieudeconsultation:lieu.val()},
                    function(data,textStatus, jqXHR) 
                    {
                        console.log(data);            
                        $('#patient').removeClass('zoomIn');
                        $('#patient').addClass('flipInX');
                        $('#patient').removeAttr('hidden');
                        $('#hr1').removeAttr('hidden');
                        $('#add').attr('hidden',true);
                        $('#hr').attr('hidden',true);
                        $('#br').attr('hidden',true);                
                        $("#user_space").html(data);   
                        nom.val("");
                        email.val("");
                        username.val("");
                        mdp.val("");
                        lieu.val("");                       
                    }
                );                
            }
           
        })
    })
</script>