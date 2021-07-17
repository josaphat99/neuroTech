<section class="content" id="section_index">    
    <header class="content__title">
        <h1><b>Resultat</b></h1>
    </header> 
    <div class="card animated zoomIn">
        <div class="card-body">
            <header class="content__title">
                <h1><b><?=$patient->nomcomplet?></b></h1>
            </header>           
            <hr>
            <h6>Exercice : <?=$data[0]->titre?></h6>
            <h6>Resultat : <?=$data[0]->resultat?> | <?= $data[0]->maximum?></h6>
            <h6>Date : <?=$data[0]->datepassation?></h6>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <header class="content__title">
                            <h1 class="text-center"><b>Questions</b></h1>
                        </header>
                    </div>
                    <!-- <div class="col-md-3">
                        <header class="content__title">
                            <h1 class="text-center"><b>Reponses</b></h1>
                        </header>
                    </div>    -->
                    <div class="col-md-6">
                        <header class="content__title">
                            <h1 class="text-center"><b>Reponses correctes</b></h1>
                        </header>
                    </div>                   
                </div>
                <?php
                    foreach($data as $d)
                    {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <p class="alert alert-info text-center"><?=$d->question?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="alert alert-danger text-center"><?=$d->vraireponse?></p>
                    </div>
                </div>
                <?php
                    }
                ?>                
            </div>
        </div>
    </div>
</section>