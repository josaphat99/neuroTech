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
    $style = '';
    if($this->session->orientation != null)
    {
        $style = 'margin-left:20px;height:150px';
    }else{
        $style = 'height:150px';
    }
?>
<section class="content" id="section_resutat">
    <div class="content__inner">
        <div class="card animated zoomIn">    
            <div class="card-body">   
                <h4 class="card-title">Résultat du MMSE</h4>
                <div class="row">
                    <div class="card card--inverse widget-pie col-md-5 offset-md-3" style="<?=$style?>">
                        <div class="col-6 col-sm-4 col-md-6 col-lg-6 widget-pie__item">
                            <div class="easy-pie-chart" data-percent=<?=$percent?> data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value"><?=$cote?></span>
                            </div>
                            <div class="widget-pie__title">Cote obtenu</div>
                        </div>

                        <div class="col-6 col-sm-4 col-md-6 col-lg-6 widget-pie__item">
                            <div class="easy-pie-chart" data-percent="100" data-size="80" data-track-color="rgba(0,0,0,0.08)" data-bar-color="#fff">
                                <span class="easy-pie-chart__value" id='pie-chart2'>30</span>
                            </div>
                            <div class="widget-pie__title">Maximum</div>
                        </div>
                    </div>
                    <?php
                        if($this->session->orientation != null)
                        {
                    ?>
                    <div class="animated fadeInRight table-responsive col-md-6" style="margin-left:20px">                    
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Fonction</th>
                                    <th>Cote</th>
                                    <th>Max</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Orientation</td>
                                    <td><?=$this->session->orientation?></td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>Apprentissage</td>
                                    <td><?=$this->session->rappel != 0? $this->session->rappel/2:0?></td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>Attention et calcul</td>
                                    <td><?=$this->session->attention?></td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <td>Rappel</td>
                                    <td><?=$this->session->rappel != 0? $this->session->rappel/2:0?></td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>Langage</td>
                                    <td><?=$this->session->langage?></td>
                                    <td>7</td>
                                </tr>
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
    })
</script>