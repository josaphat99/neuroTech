<section class="content" id="section_index">
    <header class="content__title">   
        <h1><b><?=$name_patient?></b></h1>     
    </header>

    <div class="row stats animated fadeInLeft">
        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-lime">
                    <div class="flot-chart flot-chart--xs stats-chart-1"></div>
                </div>

                <div class="stats__info">
                    <div>
                    <?php
                        if($last_mmse != null){
                    ?>
                        <h5><?=$last_mmse->resultat?></h5>
                    <?php
                        }else{
                    ?>
                        <h6>Aucun test d'evaluation passé</h6>
                    <?php
                        }
                    ?>
                        <small>Résultat du test d'évaluation</small>
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
                        <h6><?=$niveau?></h6>
                        <small>Niveau Mental</small>
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
                        <h5><?=count($exercices)?></h5>
                        <small>Exercices passés</small>
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
                        <h2><?=count($mr)?></h2>
                        <small>Exercices recommandés</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h1><b>EXERCICES PASSES</b></h1>
        </header>
            <?php
                if (count($exercices) > 0) {
                    ?>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Titre</th>
                            <th>Type</th>                            
                            <th>Maximum</th>
                            <th>Niveau</th>                            
                            <th>Date</th>
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
                                    <td ><?=$e->titre?></td>
                                    <td><?=$e->type?></td>
                                    <td style="text-align: center;"><?=$e->maximum?></td>
                                    <td><?=$e->nom?></td>                                    
                                    <td style="text-align: center;"><?=$e->datepassation?></td>
                                    <td class="text-center">                               
                                        <form action=<?=site_url('exercice/voir_resultat')?> method="post">
                                            <input type="text" name="exercice_id" value=<?=$e->id?> hidden>
                                            <input type="text" name="id_patient" value=<?=$id_patient?> hidden>
                                            <input type="text" name="date" value="<?=$e->datepassation?>" hidden>
                                            <input type="text" name="passation" value="<?=$e->passation_id?>" hidden>
                                            <button class="btn btn-success btn--raised" title="See"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
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
                <p class="text-center">Aucun exercice passé</p>
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
            <h1><b>EXERCICES RECOMMANDES</b></h1>
        </header>
            <div class="table-responsive">
                <?php
                    if(count($mr) > 0)
                    {
                ?>                   

                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Maximum</th>
                            <th>Niveau</th>    
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($mr as $r)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$r->titre?></td>
                                    <td><?=$r->type?></td>
                                    <td><?=$r->maximum?></td>
                                    <td style="text-align: center;"><?=$r->niveau?></td>  
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
                <?php
                }else{
                ?>
                    <p class="text-center">Aucun exercice recommandé</p>
                    <!-- <p><span id="minutes"></span>:<span id="seconds"></span></p> -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
