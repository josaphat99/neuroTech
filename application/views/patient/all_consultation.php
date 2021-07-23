<section class="content" id="section_index">
     <!--consultations-->
     <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h1><b>All Consultations</b></h1>
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
</section>