<section class="content" id="section_index">
<header class="content__title">
            <h1><b>Recommandations</b></h1>              
        </header>
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
                            <th>Action</th>
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
                                        <form action=<?=site_url('passation/recommanded_exercice')?> method="post">
                                            <input type="text" name="exercice_id" value=<?=$r->exercice_id?> hidden>
                                            <button class="btn btn-success btn--raised" title="Commencer"><i class="zmdi zmdi-square-right zmdi-hc-fw"></i></button>
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