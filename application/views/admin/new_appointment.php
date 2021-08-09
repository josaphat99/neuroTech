<div class="card animated fadeIn" id="new_appointment" hidden>
    <div class="card-body">
        <header class="content__title">
            <h1><b>Create an appointment</b></h1>
        </header>            
        <form class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group form-group--float">
                    <label style="margin-top:-9px">Select a patient</label>
                    <div class="select">
                        <select class="form-control" name="patient" id="patient-from-new-appointment">
                            <option></option>
                            <?php
                                foreach($patient as $p){
                            ?>
                                    <option value=<?=$p->id?>><?=$p->nomcomplet?></option>
                            <?php
                                }
                            ?>                    
                        </select>
                        <i class="form-group__bar"></i>
                    </div>            
                    <i class="form-group__bar"></i>
                </div> 

                <div class="form-group form-group--float">
                    <span>Date</span>                        
                    <input type="date" class="form-control" id="date">
                    <label></label>
                    <i class="form-group__bar"></i>
                </div>

                <div class="form-group form-group--float">                        
                    <input type="text" class="form-control" id="heure">
                    <label>Heure</label>
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="text-center">
                    <p id="error_message-appointment" class="text-red animated fadeInUp" hidden>Please give all the informations needed</p>
                    <button type="submit" id="submit-appointment" class="btn btn--icon login__block__btn">
                        <i class="zmdi zmdi-check"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
    
<hr id="hr-appoint" hidden>
<br id="br-appoint" hidden>