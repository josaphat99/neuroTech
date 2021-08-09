<section class="content">    
    <header class="content__title">
        <h1><b>Prescriptions</b></h1>
    </header>

    <div class="card animated zoomIn">
        <div class="card-body">
            <header class="content__title">
                <p>Test : <?=$titre?></p>
                <p>Doctor : <?=$doctor?></p>
                <p>Consultation date : <?=$date_passation?></p>
            </header>                   
            <hr>
            <div class="connaiter">
                <div class="row">
                    <?php
                        if(count($ordonnance) > 0)
                        {
                            foreach ($ordonnance as $ord) {
                                $products = explode(',', $ord->description); ?>    
                                <div class="card animated zoomIn col-md-6 col-sm-6">
                                    <div class="card-body">                                        
                                        <p><b><?="Prescription number ".$ord->numero?></b></p>                                        
                                        <?php
                                            for ($i=0;$i<count($products);$i++) {
                                                ?>
                                                <p><?=$products[$i]?></p>
                                                <hr>                                
                                            <?php
                                            } 
                                            ?>      
                                    </div>
                                </div>                        
                    <?php
                            }
                    }else{
                    ?>
                        <p class="text-center">No prescription yet!</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>