<?php
    if(($this->session->consultation_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Consultation created!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>
<?php
    if(($this->session->consultation_started))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Consultation started',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>
<section class="content" id="section_index">
    <header class="content__title">   
        <h1><b><?=$name_patient?></b></h1>     
    </header>

    <div class="row stats animated fadeInLeft" id="summurize">
        <div class="col-sm-6 col-md-3">
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
        <div class="col-sm-6 col-md-3">
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
        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-teal">
                    <div class="flot-chart flot-chart--xs stats-chart-4"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=count($appointment)?></h2>
                        <small>Coming appointments</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <button class="btn btn-success btn-lg" style="margin-top:60px;margin-left:30px" id="new_consult">
                <i class="zmdi zmdi-plus"></i>
                &nbsp; New Consultation
            </button>
        </div>
    </div>
    <?=$new_consultation?>
    <hr>
    <br>
    <div class="card animated zoomIn">
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
                        <tr class="text-center">
                            <th>No</th>                            
                            <th>Doctor</th>  
                            <th>Appointment date</th>
                            <th>Start Date</th>                        
                            <th>Done Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                    foreach ($exercices as $e) {
                        $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$e->doctor?></td>
                                    <td style="text-align: center;"><?=date('d-m-Y',strtotime($e->date))?></td>
                                    <td style="text-align: center;"><?=$e->started==1? $e->datestarted: 'None'?></td>                       
                                    <td style="text-align: center;"><?=$e->done==1?date('d-m-Y',strtotime($e->datepassation)): 'None'?></td>
                                    <td class="text-center">     
                                        <?php $style="float:right";?>                          
                                        <form action=<?=site_url('utilisateur/voir_resultat')?> method="post" style='<?=$e->started==0? $style:""?>'>
                                            <input type="text" name="exercice_id" value=<?=$e->id?> hidden>
                                            <input type="text" name="id_patient" value=<?=$id_patient?> hidden>
                                            <input type="text" name="date" value="<?=date('d-m-Y',strtotime($e->datepassation))?>" hidden>
                                            <input type="text" name="passation" value="<?=$e->passation_id?>" hidden>
                                            <button class="btn btn-success btn--raised" title="See"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
                                        </form>
                                    <?php
                                        if ($e->started ==0) {
                                            ?>                              
                                        <form action=<?=site_url('passation/start_consultation')?> method="post" style="margin-left:-30px">
                                            <input type="text" name="passation_id" value="<?=$e->passation_id?>" hidden>
                                            <button class="btn btn-secondary btn--raised" title="Start"><i class="zmdi zmdi-power zmdi-hc-fw"></i></button>
                                        </form>                                                                      
                                    </td>
                                    <?php
                                        }
                                    ?>
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
                <p class="text-center">No consultation done</p>
            <?php
            }
            ?>
        </div>
    </div>
    <hr>
    <br>
    <div class="card animated zoomIn">
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
                        <tr>
                            <th>No</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>heure</th>     
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($appointment as $a)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$a->doctor?></td>
                                    <td style="text-align: center;"><?=$a->date?></td>
                                    <td style="text-align: center;"><?=$a->heure?></td> 
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
</section>

<script>
     //jquery
     $(function(e)
    {
        $('#new_consult').click(function(e)
        {
            e.preventDefault();

            $('#new_consultation').removeAttr('hidden');            
        })
    })

</script>