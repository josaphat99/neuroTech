<div class="card animated zoomIn" id="new_consultation" hidden>
    <div class="card-body">
        <header class="content__title">
            <h1><b>Create a new consultation</b></h1>
        </header>            
        <form class="row" id="form_new_consultation" method="post" action="<?=site_url('passation/new_consultation')?>">
            <div class="col-md-6 offset-md-3">
                <div class="form-group form-group--float">
                    <label style="margin-top:-9px">Select the appointment</label>
                    <div class="select">
                        <select class="form-control" name="appointment" id="appointment" required>
                            <option></option>
                            <?php
                                foreach($appoint as $a){
                            ?>
                                    <option value=<?=$a->id?>><?=$a->doctor?> , <?=$a->date?> , <?=$a->heure?></option>
                            <?php
                                }
                            ?>                    
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div>                   
                <p class="text-red animated fadeIn" id="error_message_newcons_appointment" hidden>Select an appointment please!</p>
               
                <div class="form-group form-group--float">
                    <label style="margin-top:-9px">Consultation</label>
                    <div class="select">
                        <select class="form-control" name="exercice" id="exercice" required>
                            <option></option>
                            <?php
                                foreach($exercice as $e)
                                {
                            ?>
                                    <option value=<?=$e->id?>><?=$e->titre?></option>
                            <?php
                                }
                            ?>                    
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div> 
                <p class="text-red animated fadeIn" id="error_message_newcons_test" hidden>Select a test please!</p>

                <input type="hidden" name="patient_id" value=<?=$patientId?>>
                
                <div class="text-center">
                    <p id="error_message-consultation" class="text-red animated fadeInUp" hidden>Please give all the informations needed</p>
                    <button type="submit" id="submit-consultation" class="btn btn--icon login__block__btn">
                        <i class="zmdi zmdi-check"></i>
                    </button>
                    <br><br>
                    <button type="submit" id="cancel-new_consultation" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    
<hr id="hr-appoint" hidden>
<br id="br-appoint" hidden>

<script>
    $(function()
    {
        $('#submit-consultation').click(function(e){
            e.preventDefault();

            if($('#exercice').val().length <=0)
            {
                $('#error_message_newcons_test').removeAttr('hidden');
            }
            else{
                $('#error_message_newcons_test').attr('hidden',true);
            }
            if($('#appointment').val().length <=0)
            {
                $('#error_message_newcons_appointment').removeAttr('hidden');
            }else{
                $('#error_message_newcons_appointment').attr('hidden',true);
            }
            if($('#appointment').val().length > 0 && $('#exercice').val().length > 0){
                $('#form_new_consultation').submit();
            }
        })
    })
</script>