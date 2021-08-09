<div class="card animated fadeIn" id="ask_consultation_form" hidden>
    <div class="card-body">
        <header class="content__title">
            <h1><b>Ask a consultation</b></h1>
        </header>            
        <form class="row">
            <div class="col-md-4">  
                <p style="line-height:30px;">Once your request sent, some time will be needed to join the doctor for an appointment of which you will be notified</p>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group--float">
                    <label style="margin-top:-18px">Select a doctor</label>
                    <div class="select">
                        <select class="form-control" name="doctor" id="doctor-from-ask-consultation">                            
                            <?php
                                foreach($doctors as $d){
                            ?>
                                    <option value=<?=$d->id?>><?=$d->nomcomplet?></option>
                            <?php
                                }
                            ?>            
                            <option value=''>Any doctor</option>        
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div> 

               
                <div class="text-center">
                    <p id="error_message-appointment" class="text-red animated fadeInUp" hidden>Please give the information needed</p>
                    <button type="submit" id="submit-ask-consultation" class="btn btn--icon login__block__btn">
                        <i class="zmdi zmdi-check"></i>
                    </button><br><br><br>
                    <button type="submit" id="cancel-ask" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    
<hr id="hr-appoint" hidden>
<br id="br-appoint" hidden>

