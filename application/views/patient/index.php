
<?php
    if(($this->session->consultation_done))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Consultation done!!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content" id="section_index">
    <header class="content__title">        
    </header>

    <div class="row stats animated fadeInLeft" id="info-detail">

        <div class="col-sm-6 col-md-3 offset-md-6">           
            <a href="<?=site_url('passation/cognitive_exercice')?>">
                <button id="ask_consultation" class="btn btn-success">
                <i class="zmdi zmdi-notifications-active zmdi-hc-fw"></i> Ask a consultation
                </button>
            </a>
        </div>        
        <br><br><br>
        <div class="col-sm-6 col-md-3">           
            <a href="<?=site_url('passation/cognitive_exercice')?>">
                <button id="exe-cognitif" class="btn btn-secondary">
                <i class="zmdi zmdi-power zmdi-hc-fw"></i> Start a consultation  &nbsp;<span class="badge-pill  badge-success"><?=count($consultation)?></span>
                </button>
            </a>
        </div> 

        <br><br><br><br>
        <div class="col-sm-6 col-md-4">
            <div class="stats__item">
                <div class="stats__chart bg-blue-grey">
                    <div class="flot-chart flot-chart--xs stats-chart-3"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h5><?=count($exercices)?></h5>
                        <small>Consultations</small>
                    </div>
                </div>
            </div>
        </div>       

        <div class="col-sm-6 col-md-4">
            <div class="stats__item">
                <div class="stats__chart bg-cyan">
                    <div class="flot-chart flot-chart--xs stats-chart-2"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h6><?=count($ordonnance)?></h6>
                        <small>Prescriptions</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="stats__item">
                <div class="stats__chart bg-lime">
                    <div class="flot-chart flot-chart--xs stats-chart-1"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h6><?=count($appointment)?></h6>
                        <small>Coming appointments</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=$ask_consultation?>
    <hr>
    <br>
    <!--consultations-->
    <div class="row">    
        <div class="card animated zoomIn col-md-5">
            <div class="card-body">
            <header class="content__title">
                <h1><b>Consultations</b></h1>
            </header>
                <?php
                    if (count($exercices) > 0) {
                        ?>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                            <tr class="text-center alert alert-secondary">
                                <!-- <th>No</th>     -->
                                <!-- <th>Title</th>                        
                                <th>Doctor</th>   -->
                                <!-- <th>Appointment date</th>                        -->
                                <th>Date</th>
                                <th>Prescriptions</th>
                            </tr>
                        </thead>                    
                        <tbody id="t-body">
                            <?php
                                $num = 0;
                        foreach ($exercices as $e) {
                            $num++?> 
                                    <tr>
                                        <!-- <td style="text-align: center;" class="alert alert-secondary"><?=$num?></td> -->
                                        <td style="text-align: center;" class="alert alert-success"><?=date('d-m-Y',strtotime($e->datepassation))?></td>                                    
                                        <td class="text-center alert alert-light">
                                            <form action=<?=site_url('passation/voir_ordonnance_patient')?> method="post">
                                                <input type="text" name="exercice_titre" value="<?=$e->titre?>" hidden>
                                                <input type="text" name="doctor" value="<?=$e->doctor?>" hidden> 
                                                <input type="text" name="date_passation" value="<?=date('d-m-Y',strtotime($e->datepassation))?>" hidden>                                           
                                                <input type="text" name="passation_id" value="<?=$e->passation_id?>" hidden>
                                                <button class="btn btn-secondary btn--raised" title="Voir"><i class="zmdi zmdi-eye zmdi-hc-fw"></i>&nbsp;<span class="badge-pill"><?=count($e->ordonnance)?></span></button>
                                            </form>                                                                      
                                        </td>
                                    </tr>
                            <?php
                        }
                    
                            ?>                                                          
                        </tbody>
                    </table>
                </div>
                <?php
                }else{
                ?>
                    <p class="text-center">No consultation done yet!</p>
                <?php
                }
                ?>
            </div>
        </div>
        <hr>
        <br>
        <!--rendez-vous-->
        <div class="card animated zoomIn col-md-6">
            <div class="card-body">
            <header class="content__title">
                <h1><b>Coming appointments</b></h1>
            </header>
                <div class="table-responsive">
                    <?php
                        if(count($appointment) > 0)
                        {
                    ?>                   

                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                            <tr class="alert alert-secondary">
                                <!-- <th>No</th> -->
                                <th>Doctor</th>
                                <th>Date</th>  
                                <th>Hour</th> 
                            </tr>
                        </thead>                    
                        <tbody id="t-body">
                            <?php
                                $num = 0;
                                foreach($appointment as $a)
                                { $num++?> 
                                    <tr>                                        
                                        <td style="text-align: center;" class="alert alert-success"><?=$a->doctor?></td>
                                        <td style="" class="alert alert-success"><?=date('d-m-Y',strtotime($a->date))?></td>
                                        <td style="text-align: center;" class="alert alert-secondary"><?=$a->heure?></td>
                                    </tr>
                            <?php
                                }
                            ?>                                                          
                        </tbody>
                    </table>
                    <?php
                    }else{
                    ?>
                        <p class="text-center">No appointment available</p>
                        <!-- <p><span id="minutes"></span>:<span id="seconds"></span></p> -->
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(function()
    {   
        $('#ask_consultation').click(function(e)
        {
            e.preventDefault();

            $('#ask_consultation_form').removeAttr('hidden');
            $('#info-detail').removeClass('fadeInLeft');
            $('#info-detail').addClass('fadeIn');
            $('#info-detail').attr('hidden',true);
        })  

        $('#cancel-ask').click(function(e)
        {
            e.preventDefault();

            $('#ask_consultation_form').attr('hidden',true);       
            $('#info-detail').removeAttr('hidden');     
        })

        $('#submit-ask-consultation').click(function(e)
        {
            e.preventDefault();

            var doctor_id = $('#doctor-from-ask-consultation').val();

            $.post("<?=site_url('ajax/ask_consultation')?>",{doctor_id:doctor_id},function(data)
            {
                $('#ask_consultation_form').attr('hidden',true);       
                $('#info-detail').removeAttr('hidden'); 

                Swal.fire({            
                    icon: 'success',
                    title: 'Consultation request sent!!',
                    showConfirmButton: false,
                    timer: 3000
                })
                    console.log(data);
            })
        })
    })
</script>