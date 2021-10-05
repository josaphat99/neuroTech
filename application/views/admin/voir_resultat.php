<?php
    if(($this->session->ordonnance_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Prescription created!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>
<section class="content" id="section_index">    
    <header class="content__title">
        <h1><b>RESULT</b></h1>
    </header>

    <div class="card animated zoomIn">
        <div class="card-body">
            <header class="content__title">
                <form action=<?=site_url('utilisateur/user_detail')?> method="post">
                    <input type="text" name="id_patient" value=<?=$id_patient?> hidden>
                    <input type="text" name="name_patient" value="<?=$patient->nomcomplet?>" hidden>
                    <button class="btn btn-secondary"><b><i class="zmdi zmdi-arrow-left zmdi-hc-fw"></i> Go back</b></button>
                </form>
                <h1 class="text-right"><b><?=$patient->nomcomplet?></b></h1>
            </header>           
            <hr>
            <h6>Test : <?=$data[0]->titre?></h6>
            <h6>Date : <?=$data[0]->datepassation?></h6>
            <p><?=$data[0]->done == 1? "": "Consultation not done yet!"?></p>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <header class="content__title">
                            <h1 class="text-center"><b>Questions</b></h1>
                        </header>
                    </div>
                    <div class="col-md-6">
                        <header class="content__title">
                            <h1 class="text-center"><b>Given answers</b></h1>
                        </header>
                    </div>                   
                </div>
                <?php
                    foreach($data as $d)
                    {
                        if(!isset($d->reponse) && $data[0]->done == 1){continue;}
                        if(isset($d->reponse)){if($d->reponse == '--'){continue;}}                        
                        ?>
                <div class="row">
                    <div class="col-md-6">
                        <p class="alert alert-primary text-center"><?=$d->question?></p>
                    </div>  
                    <?php
                        if (isset($d->reponse)) {
                            ?>
                        <div class="col-md-6">
                            <p class="alert alert-secondary text-center"><?=$d->reponse?></p>
                        </div>  
                    <?php
                        } ?>                                   
                </div>
                <?php
                        
                    }
                    if ($data[0]->done == 1) {
                        ?>
                <div class="row">
                    <div class="col-md-6">
                        <p class="alert alert-primary text-center">Are you having a prescription right now?</p>
                    </div>
                    <div class="col-md-6">
                        <p class="alert alert-secondary text-center"><?=count($ordonnance_patient)<=0? 'No':'Yes'?></p>
                    </div>                               
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 offset-5">
                        <h6>CURRENT PRESCRIPTION</h6>
                    </div>
                    <?php
                        if(count($ordonnance_patient) > 0)
                        {
                            foreach ($ordonnance_patient as $ord) 
                            {
                                $products = explode(',', $ord->description); 
                            ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 offset-5">
                                    <?php
                                        for ($i=0;$i<count($products);$i++) {
                                            ?>
                                            <p><?=$products[$i]?></p>
                                            <hr>
                                    <?php
                                        } ?>
                                </div>
                                <hr><br>
                    <?php
                            }
                    }else{
                    ?>
                    <div class="col-lg-5 col-md-5 col-sm-5 offset-5">
                        <p class="">No current prescription!</p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
        if($data[0]->done == 1){
    ?>  
    <hr><br>
    <div class="row">
        <div class="card animated zoomIn col-md-5">
            <div class="card-head alert alert-secondary">
                <header class="content__title">
                    <h1 class="text-center text-white"><b>Diagnostic</b></h1>
                </header>
            </div>
            <div class="card-body">  
                <div class="row">
                    <div id="diagnostic_file_space">
                    <?php
                        if($data[0]->diagnostic_file != null)
                        {?>
                            <div class="col-md-12 col-sm-12">
                                <p class="alert alert-light text-black">Clic on the file icon to open the diagnostic file</p>
                            </div>
                            <div class="col-md-4 col-sm-4 offset-md-5 offset-sm-4">                                
                                <a target="_blanc" href="<?=base_url("assets/files/covid/".$data[0]->diagnostic_file)?>"> <h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>                              
                            </div>
                    <?php                            
                        }
                        else{
                    ?>
                        <div class="col-md-12 col-sm-11">
                            <p class="alert alert-light text-black">Clic on the button bellow to upload a diagnostic pdf file</p>                            
                        </div>                       
                    <?php
                        }
                    ?>  
                        </div>
                     <div class="col-md-5 col-sm-5 offset-md-4">
                        <form id="form_diagnostic" action="#" method="post" enctype="multipart/form-data">
                            <input type="file" name="diagnostic_file" id="diagnostic_file" hidden>
                            <input type="text" name="passation_id" id="passation_id" value="<?=$data[0]->id_passation?>" hidden>
                            <!-- <button type=suclass="btn btn-secondary btn--icon-text" hidden><i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Choose a file</button>  -->
                        </form>
                    </div>                            
                </div>
                <hr>
                <br>
                
                <div class="text-center">
                    <button id="diagnostic_upload_btn" class="btn btn-success btn-lg">
                        <?=$data[0]->diagnostic_file != null? "<i class='zmdi zmdi-swap-vertical zmdi-hc-fw'></i> Update the diagnostic file":"<i class='zmdi zmdi-upload zmdi-hc-fw'></i> Upload the diagnostic file"?>
                    </button><br><br>
                    <p id="diagnostic_file_name" class="animated fadeInUp" hidden></p>
                    <button id="submit_diagnostic_file" class="btn btn-secondary btn-lg animated zoomIn" hidden>
                    <i class="zmdi zmdi-caret-up zmdi-hc-fw"></i> Submit
                    </button>
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
                    <div id="medical_plan_file_space">
                    <?php
                        if($data[0]->medical_plan_file  != null)
                        {?>
                            <div class="col-md-12 col-sm-12">
                                <p class="alert alert-light text-black">Clic on a file icon to open the medical plan file</p>
                            </div>
                            <div class="col-md-4 col-sm-4 offset-md-6 offset-sm-6">                                
                                <a target="_blanc" href="<?=base_url("assets/files/covid/".$data[0]->medical_plan_file)?>"> <h6><span style="font-size:80px" class="btn btn-secondary"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i></span></h6></a>              
                            </div>
                    <?php                            
                        }
                        else{
                    ?>
                        <div class="col-md-12 col-sm-11">
                            <p class="alert alert-light text-black">Clic on the button bellow to upload a medical plan pdf file</p>                            
                        </div>
                    <?php
                        }
                    ?>     
                    </div> 
                    <div class="col-md-5 col-sm-5 offset-md-4">
                        <form id="form_medical_plan" action="#" method="post" enctype="multipart/form-data">
                            <input type="file" name="medical_plan_file" id="medical_plan_file" hidden>
                            <input type="text" name="passation_id" id="passation_id" value="<?=$data[0]->id_passation?>" hidden>
                            <!-- <button type=suclass="btn btn-secondary btn--icon-text" hidden><i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Choose a file</button>  -->
                        </form>
                    </div>                                           
                </div>
                <hr>
                <br>
                <div class="text-center">
                    <button id="medical_plan_upload_btn" class="btn btn-success btn-lg">
                        <?=$data[0]->medical_plan_file  != null? "<i class='zmdi zmdi-swap-vertical zmdi-hc-fw'></i> Update the medical plan file":"<i class='zmdi zmdi-upload zmdi-hc-fw'></i> Upload the medical plan file"?>
                    </button><br><br>
                    <p id="medical_plan_file_name" class="animated fadeInUp" hidden></p>
                    <button id="submit_medical_plan_file" class="btn btn-secondary btn-lg animated zoomIn" hidden>
                    <i class="zmdi zmdi-caret-up zmdi-hc-fw"></i> Submit
                    </button>
                </div>
            </div>
        </div>        
    </div>
    <?php
        }
    ?>
    <hr><br>
    <div class="row">
        <div class="card animated zoomIn col-md-5">
            <div class="card-head alert alert-secondary">
                <header class="content__title">
                    <h1 class="text-center text-white"><b>Prescriptions</b></h1>
                </header>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                        if(count($ordonnance) > 0)
                        {
                            foreach ($ordonnance as $ord) {
                                $products = explode(',', $ord->description); ?>                   
                                <div class="col-md-5">
                                    <h6>Number : <?=$ord->numero?></h6>
                                    <hr>
                                </div>
                    
                                <div class="col-md-9">
                                    <?php
                                        for ($i=0;$i<count($products);$i++) {
                                            ?>
                                            <p><?=$products[$i]?></p>
                                            <hr>
                                    <?php
                                        } ?>
                                </div>
                                <hr><br>
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

        <?php
            if($data[0]->done == 1){
        ?>            
            <div class="card animated zoomIn col-md-6   offset-md-1">
                <div class="card-head alert alert-secondary">
                    <header class="content__title">
                        <h1 class="text-center text-white"><b>Write a prescription</b></h1>
                    </header>
                </div>
                <div class="card-body">        
                    <form method="post" action='<?=site_url('passation/new_ordonnance')?>'>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-2 offset-sm-3">
                                <div class="form-group form-group--float">                        
                                    <input type="text" class="form-control" id="numero_ordonnance" name="numero_ordonnance">
                                    <label>Prescription number</label>
                                    <i class="form-group__bar"></i>
                                </div>   
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-2 offset-sm-3" style="margin-top:-36px">
                                <div class="form-group form-group--float">                        
                                    <input type="text" class="form-control" id="nb_produit" name="nb_produit">
                                    <label>How many products?</label>
                                    <i class="form-group__bar"></i>
                                </div>   
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <button class="btn btn--icon login__block__btn animated bounceIn" id="plus-ordonnance" hidden>
                                    <i class="zmdi zmdi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id_patient" value="<?=$id_patient?>">
                        <input type="hidden" name="id_passation" value="<?=$passation_id?>">
                        <div class="row animated fadeInUp" id="ordonnance_spacce" hidden></div>                
                    </form>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</section>

<script>
    $(function()
    {
        $('#nb_produit').click(function(e){
            e.preventDefault();

            $('#plus-ordonnance').removeAttr('hidden');
        })

        $('#plus-ordonnance').click(function(e){
            e.preventDefault();

            $.post('<?=site_url('ajax/ordonnance')?>',{nb_product:$('#nb_produit').val()},function(data){
                $('#ordonnance_spacce').html(data);
                $('#ordonnance_spacce').removeAttr('hidden');
            });
        })

        //===upload files for diagnostic===
        $("#diagnostic_upload_btn").click(function(e)
        {
            e.preventDefault();
            $("#diagnostic_file").click();
        })

        //apparution du btn submit file
        $("#diagnostic_file").change(function(e)
        {
            if($("#diagnostic_file").val() != '')
            {
                $("#diagnostic_file_name").html($("#diagnostic_file").val());
                $("#diagnostic_file_name").removeAttr('hidden');
                $("#submit_diagnostic_file").removeAttr('hidden');
            }            
        })
    //=================================================================================================
    //ajax uploading file

    $("#submit_diagnostic_file").click(function(e)
    {
        $("#form_diagnostic").submit();
    })

    $("#form_diagnostic").on('submit',(function(e) {
        e.preventDefault();
        // alert(this.diagnostic_file);
        $.ajax(
        {
            url: "<?=site_url('ajax/save_diagnostic')?>",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,

            success: function(data)
            {
                Swal.fire({            
                icon: 'success',
                title: 'Diagnostic saved successfully!',
                showConfirmButton: false,
                timer: 3000
                });

                $("#diagnostic_file_space").html(data);

                $("#diagnostic_upload_btn").html("<i class='zmdi zmdi-swap-vertical zmdi-hc-fw'></i> Update the diagnostic file");
                
                $("#diagnostic_file_name").attr('hidden',true);
                $("#submit_diagnostic_file").attr('hidden',true);
            }         
        });
    }));

    //===================================================================
    
    //===upload files for medical plan===
    $("#medical_plan_upload_btn").click(function(e)
    {
        e.preventDefault();
        $("#medical_plan_file").click();
    })

    //apparution du btn submit file
    $("#medical_plan_file").change(function(e)
    {
        if($("#medical_plan_file").val() != '')
        {
            $("#medical_plan_file_name").html($("#medical_plan_file").val());
            $("#medical_plan_file_name").removeAttr('hidden');
            $("#submit_medical_plan_file").removeAttr('hidden');
        }            
    })
    //=================================================================================================
    //ajax uploading file

    $("#submit_medical_plan_file").click(function(e)
    {
        $("#form_medical_plan").submit();
    })

    $("#form_medical_plan").on('submit',(function(e) {
        e.preventDefault();
        $.ajax(
        {
            url: "<?=site_url('ajax/save_medical_plan')?>",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,

            success: function(data)
            {
                Swal.fire({            
                icon: 'success',
                title: 'Medical plan saved successfully!',
                showConfirmButton: false,
                timer: 3000
                });

                $("#medical_plan_file_space").html(data);

                $("#medical_plan_upload_btn").html("<i class='zmdi zmdi-swap-vertical zmdi-hc-fw'></i> Update the medical plan file");
                
                $("#medical_plan_file_name").attr('hidden',true);
                $("#submit_medical_plan_file").attr('hidden',true);
            }         
        });
    }));

    })
</script>