
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
    <hr>
    <div class="row">
        <div class="card animated zoomIn col-md-5">
            <div class="card-head alert alert-secondary">
                <header class="content__title">
                    <h1 class="text-center text-white"><b>Diagnostic</b></h1>
                </header>
            </div>
            <div class="card-body">  
                <div class="row">
                    
                    <?php
                        if($diagnostic_file != null)
                        {?>
                            <div class="col-md-12 col-sm-12">
                                <p class="alert alert-light text-black">Clic on the file icon to open the diagnostic file</p>
                            </div>
                            <div class="col-md-4 col-sm-4 offset-md-4 offset-sm-4">                                
                                <a target="_blanc" href="<?=base_url("assets/files/covid/".$diagnostic_file)?>"> <h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>                              
                            </div>
                    <?php                            
                        }
                        else{
                    ?>
                        <div class="col-md-12 col-sm-11">
                            <p class="alert alert-light text-black">No diagnostic yet!</p>                            
                        </div>                       
                    <?php
                        }
                    ?>                                                 
                </div>
                
            </div>
        </div>
                  
        <div class="card animated zoomIn col-md-6 offset-md-1">
            <div class="card-head alert alert-secondary">
                <header class="content__title">
                    <h1 class="text-center text-white"><b>Medical plan</b></h1>
                </header>
            </div>
            <div class="card-body">  
                <div class="row">
                    <?php
                        if($medical_plan_file  != null)
                        {?>
                            <div class="col-md-12 col-sm-12">
                                <p class="alert alert-light text-black">Clic on a file icon to open the medical plan file</p>
                            </div>
                            <div class="col-md-4 col-sm-4 offset-md-4 offset-sm-4">                                
                                <a target="_blanc" href="<?=base_url("assets/files/covid/".$medical_plan_file)?>"> <h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>              
                            </div>
                    <?php                            
                        }
                        else{
                    ?>
                        <div class="col-md-12 col-sm-11">
                            <p class="alert alert-light text-black">No medical plan yet!</p>                            
                        </div>
                    <?php
                        }
                    ?>                                                              
                </div>               
            </div>
        </div>        
    </div>
</section>