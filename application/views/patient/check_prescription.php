<section class="content" id="check_prescription">

    <div class="content__inner">
        <header class="content__title">
            <h1><b>Consultation test</b></h1><br>          
        </header>
        <div class="card animated zoomIn">    
            <div class="stats__item bg-green"> 
                <header class="content__title">
                    <h1 class="text-center" style="color:white;font-size:22px"><b>Prescription checking</b></h1>              
                </header>
            </div>
            <form action="<?=site_url('passation/check_prescription')?>" method="post">
            <div class="card-body"> 
                <div class="animated zoomIn">
                    <div class="row">
                        <div class="listview listview--bordered q-a">
                            <div class="listview__item q-a__item">                                   
                                <div class="col-md-12">
                                    <div class="listview__content" style="margin-top:18px">
                                        <div class="listview__heading" style="font-size:15px">Are you having any prescription right now?</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-5" style="margin:auto">                            
                            <input type="hidden" name="consultation_id" value=<?=isset($consultation_id)?$consultation_id:null?>> 
                            <div class="form-group form-group--float">                        
                                <div class="select">
                                    <label></label>
                                    <select class="form-control" autocomplete="off" id="having_prescript">
                                        <option value="" id="answer_option">Answer</option>
                                        <option value="yes">Yes</option>             
                                        <option value="no">No</option>                                                                                                      
                                    </select>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="animated fadeIn" id="number_product" hidden>
                        <div class="col-md-4 offset-md-4  col-sm-3" style="margin-top:-20px" id="#">
                            <div class="form-group form-group--float">                        
                                <input type="text" class="form-control" name="prod_number" id="prod_number" autocomplete="off">
                                <label id="prod_number_label">How many products are you taking?</label>
                                <i class="form-group__bar"></i>
                            </div>                           
                        </div>

                        <!--products space-->
                        <div class="row animated fadeInUp" id="product_space" hidden>                        
                        </div>

                        <div class="row">
                            <div style="margin:auto" id="check-1">
                                <button class="btn btn--icon login__block__btn submit1"> <i class="zmdi zmdi-check"></i></button>                                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="margin:auto">
                            <button class="btn  login__block__btn finish animated fadeIn" hidden>Finish</button>
                        </div>
                    </div>                                           
                </div>
            </div>
            </form>  
        </div>
    </div>
</section>
                       
<script>
    $(function()
    {
        $('#having_prescript').change(function(e)
        {
            if($('#having_prescript').val() == 'yes')
            {
                $('#number_product').removeAttr('hidden');
                $('.finish').attr('hidden',true);   
            }

            if($('#having_prescript').val() == 'no')
            {
                $('#number_product').attr('hidden',true);
                $('#product_space').attr('hidden',true);
                $('.finish').removeAttr('hidden');                
            }
        })

        $('#answer_option').attr('disabled','disabled');

        $('.submit1').click(function(e)
        {
            e.preventDefault();
            $.post("<?=site_url('ajax/prescription')?>",{nb_prod:$('#prod_number').val()},function(data)
            {
                $('#product_space').removeAttr('hidden');
                $('#product_space').html(data);
                $("#prod_number_label").attr('hidden',true);

                $('.finish').removeAttr('hidden');                 
                $('.submit1').attr('hidden',true);
            });
        })

        // $('.finish').click(function(e)
        // {
        //     e.preventDefault();

        // })
        
    })
</script>