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
            title: 'Patient saved',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
    if(($this->session->doctor_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Doctor saved',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }

?>

<section class="content">
    <?php
        if($this->session->type == 'admin'){
    ?>
    <header class="content__title">
        <h1 class="animated"><b>Users</b></h1>
    </header>
    <?php
        }
        $class = $this->session->type =='admin'? 'col-md-4':'col-md-6';
    ?>
    <div class="row stats animated fadeInLeft">
        <div class='<?="col-sm-6 ".$class?>'>
            <div class="stats__item">
                <div class="stats__chart bg-lime">
                    <div class="flot-chart flot-chart--xs stats-chart-1"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h5><?=count($patients)?></h5>
                        <a href="#patient"><small>Patients</small></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if ($this->session->type == 'admin') {
                ?>
        <div class="col-sm-6 col-md-4">
            <div class="stats__item">
                <div class="stats__chart bg-cyan">
                    <div class="flot-chart flot-chart--xs stats-chart-2"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h6><?=count($doctors)?></h6>
                        <a href="#doctors"><small>Doctors</small></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="stats__item">
                <div class="stats__chart bg-blue-grey">
                    <div class="flot-chart flot-chart--xs stats-chart-3"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h5><?=count($admins)?></h5>
                        <a href="#admins"><small>Admins</small></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        if ($this->session->type == 'doctor') {
            ?>
        <div class="col-sm-6 col-md-6">
            <div class="stats__item">
                <div class="stats__chart bg-teal">
                    <div class="flot-chart flot-chart--xs stats-chart-4"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=count($appointment)?></h2>
                        <a href="#appoint"><small>Your coming appointments</small></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        if ($this->session->type == 'reception') {
            ?>
        <div class="col-sm-6 col-md-6">
            <div class="stats__item">
                <div class="stats__chart bg-teal">
                    <div class="flot-chart flot-chart--xs stats-chart-4"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=count($consultation_ask)?></h2>
                        <a href="#appoint"><small>Consultation requests</small></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <div class="card animated zoomIn" id="patient">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-3 content__title">
                    <h1><b>Patients</b></h1>
                </div>
                <?php
                    if ($this->session->type == 'admin' || $this->session->type == 'reception') {
                        ?>
                <div class="col-md-1 offset-md-8">
                    <button class="btn btn--icon login__block__btn" id="plus">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
                <?php
                }
                ?>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="alert alert-secondary">
                            <th>No</th>
                            <th>Full name</th>
                            <th>Birth date</th>
                            <th>Gender</th>
                            <th>Town</th>
                            <th>Street</th>
                            <th>House number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="user_space">
                        <?php
                            $num = 0;
                            foreach($patients as $p)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td>                                    
                                    <td style="text-align: center;"><?=$p->nomcomplet?></td>
                                    <td style="text-align: center;"><?=date('d-m-Y',strtotime($p->birth_date))?></td>
                                    <td style="text-align: center;"><?=$p->sex?></td>
                                    <td style="text-align: center;"><?=$p->town?></td>
                                    <td style="text-align: center;"><?=$p->street?></td>        
                                    <td style="text-align: center;"><?=$p->house_number?></td>            
                                    <td>
                                        <?php 
                                            if ($this->session->type == 'admin') {
                                        ?>
                                        <button class="btn btn-success btn--raised edit" id=<?='edit-'.$p->id?>><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                                        <button class="btn btn-success btn--raised animated bounceIn check" id=<?='check-'.$p->id?> hidden><i class="zmdi zmdi-check zmdi-hc-fw"></i></button>

                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("utilisateur/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form>                                          
                                        <?php
                                        }
                                            if($this->session->type == 'doctor'){
                                        ?>
                                        <form action="<?= site_url("utilisateur/user_detail")?>" method="post" style="float:right; margin-right:90px">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id_patient">
                                            <input type="hidden" value="<?=$p->nomcomplet?>" name="name_patient">
                                            <button id="see" class="btn btn-secondary btn--raised" title="See">
                                                <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
                                            </button>
                                        </form>  
                                        <?php
                                        }
                                        if($this->session->type == 'reception' || $this->session->type == 'admin'){
                                            $margin_right = $this->session->type == 'reception'? "15px":"10px";
                                            ?>
                                            <form action="<?= site_url("utilisateur/user_detail")?>" method="post" style="float:right; margin-right:<?=$margin_right?>">                                
                                                <input type="hidden" value="<?=$p->id?>" name="id_patient">
                                                <input type="hidden" value="<?=$p->nomcomplet?>" name="name_patient">
                                                <?php $disabled = $p->etat == 1? 'disabled': '';?>
                                                <button id=<?="con_detail-".$p->id?> class="btn btn-secondary btn--raised con_detail" title="Connexion details" <?=$disabled?>>
                                                    <span><i class="zmdi zmdi-square-down zmdi-hc-fw con_detail"></i><span>
                                                </button>
                                            </form>  
                                            <?php
                                            }
                                        ?>                                                                                                                 
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
    <?=$add?>    
    <?php
        if($this->session->type == 'admin'){
    ?>
    <hr id="hr1">
    <br>
    <div class="card animated zoomIn" id="doctors">
        <div class="card-body">
            <header class="content__title">
                <div class="row">
                    <div class="col-md-3 content__title">
                        <h1><b>Doctors</b></h1>
                    </div>
                    <div class="col-md-1 offset-md-8">
                        <button class="btn btn--icon login__block__btn" id="plus-doctors">
                            <i class="zmdi zmdi-plus"></i>
                        </button>
                    </div>
                </div>
            </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="alert alert-secondary">
                            <th>No</th>
                            <th>Full name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width:210px">Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body-admin">
                        <?php
                            $num = 0;
                            foreach($doctors as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td>
                                    <td style="text-align: center;"><?=$a->nomcomplet?></td>
                                    <td style="text-align: center;"><?=$a->sex?></td>
                                    <td style="text-align: center;"><?=$a->email?></td>
                                    <td style="text-align: center;"><?=$a->phone?></td>
                                    <td>
                                        <button class="btn btn-success btn--raised edit" id=<?='edit-'.$a->id?>><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                                        
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("utilisateur/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$a->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form> 
                                                                        
                                        <form action="<?= site_url("utilisateur/user_detail")?>" method="post" style="float:right; margin-right:20px">                                
                                            <input type="hidden" value="<?=$a->id?>" name="id_patient">
                                            <input type="hidden" value="<?=$a->nomcomplet?>" name="name_patient">
                                            <?php $disabled = $a->etat == 1? 'disabled': '';?>
                                            <button id="see" class="btn btn-secondary btn--raised" title="Connexion details" <?=$disabled?>>
                                                <span><i class="zmdi zmdi-square-down zmdi-hc-fw"></i> <span>
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
    <?=$add_doctor?>
    <hr><br>  
    <div class="card animated zoomIn" id="admins">
        <div class="card-body">
        <header class="content__title">
            <h1><b>Admins</b></h1>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="alert alert-secondary">
                            <th>No</th>
                            <th>Full name</th>
                            <th>User name</th>
                            <th>Email</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body-admin">
                        <?php
                            $num = 0;
                            foreach($admins as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td>
                                    <td style="text-align: center;"><?=$a->nomcomplet?></td>
                                    <td style="text-align: center;"><?=$a->username?></td>
                                    <td style="text-align: center;"><?=$a->email?></td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>  
            </div>
        </div>
    </div>      
    <?php
    }
    ?>
    <?php
        if($this->session->type == 'doctor'){
    ?>
    <hr><br>
    <div class="card animated zoomIn" id="appoint">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-11 col-sm-11 content__title">
                    <h1><b>Your appointments</b></h1>
                </div>
                <div class="col-md-1 col-sm-1">
                    <button class="btn btn--icon login__block__btn" id="plus-appointment">
                        <i class="zmdi zmdi-plus"></i>
                    </button>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="alert alert-secondary">
                            <th>No</th>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>heure</th>                            
                        </tr>
                    </thead>                    
                    <tbody id="appointment_space">
                        <?php
                            $num = 0;
                            foreach($appointment as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td>
                                    <td style="text-align: center;" class="alert alert-success"><?=$a->patient?></td>
                                    <td style="text-align: center;" class="alert alert-success"><?=$a->date?></td>
                                    <td style="text-align: center;" class="alert alert-secondary"><?=$a->heure?></td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
    <?=$new_appointment?> 
    <?php
    }
    if($this->session->type == 'reception'){
        ?>
        <hr><br>
        <div class="card animated zoomIn" id="consultation_requests">
            <div class="card-body">
            <header class="content__title">
                <div class="row">
                    <div class="col-md-11 col-sm-11 content__title">
                        <h1><b>Consultation requests</b></h1>
                    </div>
                </div>
            </header>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                            <tr class="alert alert-secondary">
                                <th>No</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Action</th>                           
                            </tr>
                        </thead>                    
                        <tbody>
                            <?php
                                $num = 0;
                                foreach($consultation_ask as $a)
                                { $num++;
                                    $class = $num % 2 == 0?"alert alert-secondary":"";                                 
                                ?> 
                                    <tr>
                                        <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td>
                                        <td style="text-align: center;" class="<?=$class?>"><?=$a->patient?></td>
                                        <td style="text-align: center;" class="<?=$class?>"><?=$a->doctor?></td>
                                        <td style="text-align: center;" class="<?=$class?>">
                                            <button class="btn-success">
                                                <i class="zmdi zmdi-check zmdi-hc-fw"></i> 
                                            </button>                                        
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
        <?php
        }
    ?>
</section>


<!--scripts-->
<?php
if($this->session->type == 'admin'){
?>
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
        title: 'Do you realy want to delete this user?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'User deleted.',
                'success'
                )
                anchor.submit();
            }
        })
    }  
</script>
<?php
}
?>

<!--//jquery-->
<script>    
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

        $('#plus-doctors').click(function(e)
        {
            e.preventDefault();

            $('#doctors').attr('hidden',true);
            $('#add_doctor').removeAttr('hidden');
        })

        //===selection des elements ajout d'un patient===
        var nom = $('#nomcomplet');
        var email = $('#email');
        var username = $('#username');
        var mdp = $('#mdp');
        var bthdate = $('#birth_date');
        var phone = $('#phone');
        var sex = $('#sex');
        var town = $('#town');
        var street = $('#street');
        var house_number = $('#house_number');

        $('#submit').click(function(e)
        {
            e.preventDefault();

            if(nom.val().length <= 0 || email.val().length <= 0 || username.val().length <= 0
            || mdp.val().length <= 0 || bthdate.val().length <= 0 || phone.val().length <= 0
            || sex.val().length <= 0 || town.val().length <= 0 || street.val().length <= 0
            || house_number.val().length <= 0)
            {
                $('#error_message').removeAttr('hidden');
            }
            else
            {
                $('#error_message').attr('hidden',true);

                $.post('<?=site_url('ajax/add_user')?>', { nomcomplet: nom.val(), email: email.val(), username:username.val(),
                mdp:mdp.val(),bthdate:bthdate.val(),phone:phone.val(),sex:sex.val(),town:town.val(),street:street.val(),house_number:house_number.val()},
                    function(data,textStatus, jqXHR) 
                    {
                       location.assign('<?=site_url('utilisateur/index')?>');           
                    }
                )
            }           
        });

         //===Bouton edit===        
         $('.edit').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
           
            $('.td'+id).attr('hidden',true);
            $('.td-form'+id).removeAttr('hidden'); 
            $('#edit-'+id).attr('hidden',true);
            $('#check-'+id).removeAttr('hidden');
        })

        $('.check').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];

            var nomcomplet = $('#nomcomplet-'+id).val();
            var type = $('#type-'+id).val();
            var username = $('#username-'+id).val();
            var email = $('#email-'+id).val();

            $.post('<?=site_url('ajax/edit_user')?>', { nomcomplet: nomcomplet, email: email, username:username,
                type:type,id:id},
                    function(data,textStatus, jqXHR) 
                    {
                        $("#user_space").html(data);
                        $('.td'+id).removeAttr('hidden');
                        $('.td-form'+id).attr('hidden',true); 
                        $('#edit-'+id).removeAttr('hidden');
                        $('#check-'+id).attr('hidden',true);                       
                    }
                )
        })        

        //the script for the appointment
        $('#plus-appointment').click(function(e)
        {
            e.preventDefault();

            $('#appoint').attr('hidden',true);
            $('#new_appointment').removeAttr('hidden');
        })
        
        //===selection des elements du rendez-vous===
        // var doctor = $('#doctor-from-new-appointment');
        var patient = $('#patient-from-new-appointment');
        var date = $('#date');
        var heure = $('#heure');
        
        $('#submit-appointment').click(function(e)
        {
            e.preventDefault();

            if(patient.val().length <= 0 || date.val().length <= 0
            || heure.val().length <= 0 )
            {
                $('#error_message-appointment').removeAttr('hidden');
            }
            else
            {
                $('#error_message-appointment').attr('hidden',true);

                $.post('<?=site_url('ajax/add_appointment')?>', {patient: patient.val(), date:date.val(),
                heure:heure.val()},
                    function(data,textStatus, jqXHR) 
                    {
                        console.log(data);            
                        location.assign("<?=site_url("utilisateur/index")?>");                        
                    }
                )
            }
        })    

        $('.con_detail').click(function(e)
        {
            e.preventDefault();

            id = e.target.getAttribute('id').split('-')[1];
            $('#con_detail-'+id).attr('disabled',true);

            $.post("<?=site_url('ajax/con_detail')?>",{id:id},function(response)
            {
                var username = response.split('-')[0];
                var mdp = response.split('-')[1];
                // alert(username+' '+mdp);
                Swal.fire({      
                title: 'Connexion details',
                html : '<br/><h4>Username : '+username+'</h4><br/><h4>Password : '+mdp+'</h4>',
                showConfirmButton: true,
                })
            })
        })
    })
</script> 