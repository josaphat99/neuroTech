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
                        }
                    ?>                                   
                </div>
                <?php
                    }
                ?>

            </div>
        </div>
    </div>
    <hr><br>
    <div class="row">
        <div class="card animated zoomIn col-md-5">
            <div class="card-body">
                <header class="content__title">
                    <h1 class="text-center"><b>Prescriptions</b></h1>
                </header>
                <hr>
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
                <div class="card-body">
                    <header class="content__title">
                        <h1 class="text-center"><b>Write a prescription</b></h1>
                    </header>            
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

    })
</script>