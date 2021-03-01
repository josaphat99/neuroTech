<style>
    .titre{     
        font-size: 20px;
        font-family:'Segoe UI';
        color: white;
    }
    .stats__item{
        background-color: rgba(100,100,1,0.4);
    }
    
</style>
<?php
    if($recommandation == null)
    {
        $style = "margin:auto";
    }else{
        $style = "margin-left:20px;height:150px";
    }
?>

<section class="content" id="section_resutat">
    <div class="content__inner">
        <div class="card animated zoomIn">    
            <div class="card-body">   
                <h4 class="card-title"><b><?=$titre?> : Résultat</b></h4>
                <div class="row">
                    <div class="card card--inverse widget-pie col-md-5 offset-md-3" style=<?=$style?>>
                        <div class="col-6 col-sm-4 col-md-6 col-lg-6 widget-pie__item">
                            <div class="easy-pie-chart" data-percent=<?=$percent?> data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"><?=$cote?></span>
                            </div>
                            <div class="widget-pie__title">Cote obtenu</div>
                        </div>

                        <div class="col-6 col-sm-4 col-md-6 col-lg-6 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="100" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value" id='pie-chart2'><?=$maximum?></span>
                            </div>
                            <div class="widget-pie__title">Maximum</div>
                        </div>
                    </div>
                    <?php
                        if($recommandation != null)
                        {
                    ?>    
                    <div class="animated fadeInRight table-responsive col-md-6" style="margin-left:20px">                    
                        <table class="table mb-0">
                        <b>Recommandations</b>
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Num</td>
                                    <td>Titre</td>
                                    <td>Niveau</td>
                                    <td>Action</td>
                                </tr>
                                <?php
                                    $num = 0;
                                    foreach($recommandation as $r)
                                    {
                                    $num +=1;
                                ?>                                
                                    <tr>
                                        <td><?=$num?></td>
                                        <td><?=$r->titre?></td>
                                        <td><?=$r->niveau?></td> 
                                        <form action=<?=site_url('passation/recommanded_exercice')?> method="post">
                                            <input type="text" name="exercice_id" value=<?=$r->exercice_id?> hidden>
                                            <td><button id=<?=$r->type=='mmse'? 'mmse':'cognitif'?> type="submit" class="btn btn-success">Lancer</button></td>     
                                        </form>                                  
                                    </tr>                                
                                <?php
                                    }
                                ?>                
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="row"">
                    <div class="col-md-4">
                        <h6 style="margin-left:7px;">
                        <p>Passé le : <?=$date?></p>
                            <button class="animated bounceIn btn btn-light" id='niveau' hidden>
                                Niveau : <?=$niveau?>
                            </button> 
                        </h6>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div style="margin:auto">
                        <a href=<?=site_url('passation/cognitive_exercice')?>><button class="btn btn-success" id="">Commencer un exercice cognitif</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        setTimeout(function(){ $('#niveau').removeAttr('hidden'); }, 2500);

        $('#mmse').click(function(e)
        {
           //===La voix est lancée===
            var speech = new SpeechSynthesisUtterance();
            speech.lang = "fr-Fr";
            speech.text = 'Je vais vous poser quelques questions pour apprécier comment fonctionne votre mémoire. Les unes sont très simples, les autres un peu moins. Vous devez répondre, du mieux que vous pouvez. Quelle est, la date complète d\'aujourd\'hui';
            speech.volume = 1;
            speech.rate = 0.7;
            speech.pitch = 1;
            speechSynthesis.speak(speech);          
        })
    })
</script>