<?php
    if($this->session->mmse)
    {
?>
    <script>
        $(function(){
            $('#section_index').attr('hidden',true);
            $('#section_mmse').removeAttr('hidden');
        })
    </script>
<?php
    }
?>
<section class="content" id="section_index">
    <header class="content__title">        
    </header>

    <div class="row stats animated fadeInLeft">

        <div class="col-sm-6 col-md-4 offset-md-8">
            <a href='#'>
                <button class="btn btn-success" id="lancer_mmse">
                    Lancer le MMSE
                </button>
            </a>
            &nbsp;&nbsp;
            <a href="#">
                <button id="exe-cognitif" class="btn btn-secondary">
                    Commencer un exercice
                </button>
            </a>
        </div>

        <br><br><br><br>

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
                        <h5><?=count($e_done)?></h5>
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
                                        <?php
                                            $action = $e->type == 'mmse'? 'voir_resultat_mmse' : 'voir_resultat_cognitif'; ?>
                                        <form action=<?=site_url('passation/'.$action)?> method="post">
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
                            <!-- <th>Nombre de questions</th> -->
                            <th>Actions</th>
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
                                    <!-- <td style="text-align: center;"><$r->nbquestion?></td> -->
                                    <td class="text-center">
                                        <form class="form-rec" id=<?="form-".$r->id?> action=<?=site_url('passation/recommanded_exercice')?> method="post">
                                            <input type="text" name="exercice_id" value=<?=$r->exercice_id?> hidden>
                                            <button id=<?=$r->type."-".$r->id?> class="btn btn-success btn--raised submit-rec" title="Commencer"><i class="zmdi zmdi-square-right zmdi-hc-fw"></i></button>
                                        </form>                                                                                                                        
                                    </td>
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
<?=$mmse?>



<script>
    $(function(){   
        //===En cliquant sur lancer mmse=== 
        $('#lancer_mmse').click(function(e)
        {
            $('#section_index').attr('hidden',true);
            $('#section_mmse').removeAttr('hidden');
            $.post("<?=site_url('ajax/mmse_flash')?>",{flash:'mmse'},function(data){
                console.log(data);
            })
            //===La voix est lancée===
            var speech = new SpeechSynthesisUtterance();
            speech.lang = "fr-Fr";
            speech.text = 'Je vais vous poser quelques questions pour apprécier comment fonctionne votre mémoire. Les unes sont très simples, les autres un peu moins. Vous devez répondre, du mieux que vous pouvez. Quelle est, la date complète d\'aujourd\'hui';
            speech.volume = 1;
            speech.rate = 0.7;
            speech.pitch = 1;
            speechSynthesis.speak(speech);
        });
       
        //en cliqant sur commencer exercice
        $('#exe-cognitif').click(function(e)
        {
            e.preventDefault();
            $.post("<?=site_url('ajax/check_mmse')?>",{},function(data){
                if(data == 0){
                    Swal.fire({
                        title: 'Vous n\'avez pas encore passé le test d\'evaluation de la mémoire!!',
                        showCancelButton: true,
                        cancelButtonText: 'Annuler',
                        confirmButtonText: `Lancer le test`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            console.log('hey!');
                            $('#lancer_mmse').click();
                        }
                    })
                }else{
                    location.assign("<?=site_url("passation/cognitive_exercice")?>");
                }
            })
        });

        //en cliquant sur le btn de recommandation
        $('.submit-rec').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var type = e.target.getAttribute('id').split('-')[0];

            if(type == 'mmse'){
                $('#lancer_mmse').click();
            }else{
                $('#form-'+id).submit();
            }

        })
    })
</script>