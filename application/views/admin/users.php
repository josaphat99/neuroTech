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
        <h1 class="animated"><b>Users</b></h1>
    </header>
    <div class="row stats animated fadeInLeft">
        <div class="col-sm-6 col-md-3">
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

        <div class="col-sm-6 col-md-3">
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

        <div class="col-sm-6 col-md-3">
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

        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-teal">
                    <div class="flot-chart flot-chart--xs stats-chart-4"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=count($appointment)?></h2>
                        <a href="#appoint"><small>Appointments</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <th>Full name</th>
                            <th>User name</th>
                            <th>Email</th>
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
                                    <td class=<?="td".$p->id?>><?=$p->nomcomplet?></td>
                                    <td class=<?="td-form".$p->id?> hidden><input id=<?="nomcomplet-".$p->id?> class="form-control animated bounceIn" type="text" value="<?=$p->nomcomplet?>"></td>                                 
                                    <td class=<?="td".$p->id?>><?=$p->username?></td>
                                    <td class=<?="td-form".$p->id?> hidden><input id=<?="username-".$p->id?> class="form-control animated bounceIn" type="text" value=<?=$p->username?>></td>
                                    <td class=<?="td".$p->id?>><?=$p->email?></td>
                                    <td class=<?="td-form".$p->id?> hidden><input id=<?="email-".$p->id?> class="form-control animated bounceIn" type="text" value=<?=$p->email?>></td>
                                    <td>
                                        <button class="btn btn-success btn--raised edit" id=<?='edit-'.$p->id?>><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                                        <button class="btn btn-success btn--raised animated bounceIn check" id=<?='check-'.$p->id?> hidden><i class="zmdi zmdi-check zmdi-hc-fw"></i></button>
                                       
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("utilisateur/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form>  

                                        <form action="<?= site_url("utilisateur/user_detail")?>" method="post" style="float:right; margin-right:90px">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id_patient">
                                            <input type="hidden" value="<?=$p->nomcomplet?>" name="name_patient">
                                            <button id="see" class="btn btn-secondary btn--raised" title="See">
                                                <i class="zmdi zmdi-eye zmdi-hc-fw"></i>
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
    <?=$add?>    
    <div class="card animated zoomIn" id="admins">
        <div class="card-body">
        <header class="content__title">
            <h1><b>Admins</b></h1>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
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
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$a->nomcomplet?></td>
                                    <td><?=$a->username?></td>
                                    <td><?=$a->email?></td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
    <hr><br>
    <div class="card animated zoomIn" id="doctors">
        <div class="card-body">
        <header class="content__title">
            <h1><b>Doctors</b></h1>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Full name</th>
                            <th>User name</th>
                            <th>Email</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body-admin">
                        <?php
                            $num = 0;
                            foreach($doctors as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$a->nomcomplet?></td>
                                    <td><?=$a->username?></td>
                                    <td><?=$a->email?></td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
    <hr><br>
    <div class="card animated zoomIn" id="appoint">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-3 content__title">
                    <h1><b>Appointments</b></h1>
                </div>
                <div class="col-md-1 offset-md-8">
                    <button class="btn btn--icon login__block__btn" id="plus-appointment">
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
                            <th>Doctor</th>
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
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$a->doctor?></td>
                                    <td><?=$a->patient?></td>
                                    <td><?=$a->date?></td>
                                    <td><?=$a->heure?></td>
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
</section>


<!--scripts-->
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
        var phone = $('#phone');

        $('#submit').click(function(e)
        {
            e.preventDefault();

            if(nom.val().length <= 0 || email.val().length <= 0 || username.val().length <= 0
            || mdp.val().length <= 0 || lieu.val().length <= 0 || phone.val().length <= 0)
            {
                $('#error_message').removeAttr('hidden');
            }
            else
            {
                $('#error_message').attr('hidden',true);

                $.post('<?=site_url('ajax/add_user')?>', { nomcomplet: nom.val(), email: email.val(), username:username.val(),
                mdp:mdp.val(),lieudeconsultation:lieu.val(),phone:phone.val()},
                    function(data,textStatus, jqXHR) 
                    {
                        console.log(data);            
                        $('#patient').removeClass('zoomIn');
                        $('#patient').addClass('fadeIn');
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
                        phone.val("");                  
                        
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
                    }
                );                
            }
           
        })
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
        var doctor = $('#doctor-from-new-appointment');
        var patient = $('#patient-from-new-appointment');
        var date = $('#date');
        var heure = $('#heure');
        
        $('#submit-appointment').click(function(e)
        {
            e.preventDefault();

            if(doctor.val().length <= 0 || patient.val().length <= 0 || date.val().length <= 0
            || heure.val().length <= 0 )
            {
                $('#error_message-appointment').removeAttr('hidden');
            }
            else
            {
                $('#error_message-appointment').attr('hidden',true);

                $.post('<?=site_url('ajax/add_appointment')?>', { doctor: doctor.val(), patient: patient.val(), date:date.val(),
                heure:heure.val()},
                    function(data,textStatus, jqXHR) 
                    {
                        console.log(data);            
                        $('#appoint').removeClass('zoomIn');
                        $('#appoint').addClass('fadeIn');
                        $('#appoint').removeAttr('hidden');  
                        $('#new_appointment').attr('hidden',true);             
                        $("#appointment_space").html(data);   
                        doctor.val("");
                        patient.val("");
                        date.val("");
                        heure.val(""); 
                    }
                )
            }
        })    
    })
</script> 