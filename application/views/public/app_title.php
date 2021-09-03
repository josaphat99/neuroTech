<style>
    #app-div{
        background-color: grey;
        margin-top : 250px;
    }

    #app-title{        
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;        
        padding:30px 0px 0px 0px;
        color: white
    }
    #app-subtitle{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;
        color: white
    }
</style>
<body data-ma-theme="green">
    <div class="row" id="app-intro">
        <div class="col-12 text-center">
            <div class="animated fadeInLeftBig" id="app-div">
                <h1 class="animated fadeInRight" id="app-title">neuroTech</h1>
                <p class="animated fadeInDown" id='app-subtitle' hidden>Make a remote consultation</p>                    
                <br>
            </div>  
            <br>
            <a href="<?=site_url('signinup')?>">
                <button class="btn btn-success btn-lg animated bounceIn" id="btn-start" hidden><i class="zmdi zmdi-power zmdi-hc-fw"></i> Start</button>
            </a>
        </div>
    </div>

<!--Les scripts-->
<script>
    $(function(){
        setTimeout(function(){$('#app-subtitle').removeAttr('hidden');},1000);
        setTimeout(function(){$('#btn-start').removeAttr('hidden');},2000);       
    })
</script>