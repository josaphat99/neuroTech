
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

    <div class="row stats animated fadeInLeft">

        <div class="col-sm-6 col-md-3 offset-md-9">           
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
    <hr>
    <br>
    <!--consultations-->
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
                                    <td ><?=$e->doctor?></td>
                                    <td><?=date('d-m-Y',strtotime($e->date))?></td>
                                    <td style="text-align: center;"><?=date('d-m-Y',strtotime($e->datepassation))?></td>
                                    <td class="text-center">
                                        <?php
                                            // $action = $e->type == 'mmse'? 'voir_resultat_mmse' : 'voir_resultat_cognitif'; ?>
                                        <form action=<?=site_url('passation/voir_resultat_patient')?> method="post">
                                            <input type="text" name="exercice_id" value=<?=$e->id?> hidden>
                                            <input type="text" name="date" value="<?=$e->datepassation?>" hidden>
                                            <button class="btn btn-success btn--raised" title="Voir"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
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
    // $(function()
    // {     
    // })
</script>