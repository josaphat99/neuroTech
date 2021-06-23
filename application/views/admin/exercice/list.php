<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->exercice_add))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Exercice enrégistré',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Exercices</b></h1>
    </header>

    <div class="row stats animated fadeInLeft">
        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-lime">
                    <div class="flot-chart flot-chart--xs stats-chart-1"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=$dl?></h2>
                        <small>Déficit cognitif leger</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-cyan">
                    <div class="flot-chart flot-chart--xs stats-chart-2"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=$dm?></h2>
                        <small>Déficit cognitif modéré</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-blue-grey">
                    <div class="flot-chart flot-chart--xs stats-chart-3"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=$ds?></h2>
                        <small>Déficit cognitif sévère</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="stats__item">
                <div class="stats__chart bg-teal">
                    <div class="flot-chart flot-chart--xs stats-chart-4"></div>
                </div>

                <div class="stats__info">
                    <div>
                        <h2><?=$r?></h2>
                        <small>Recommandés</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h1><b>EXERCICES COGNITIFS</b></h1>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Maximum</th>
                            <th>Niveau</th>                            
                            <th>Nombre de questions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($exercices as $e)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$e->titre?></td>
                                    <td><?=$e->type?></td>
                                    <td style="text-align: center;"><?=$e->maximum?></td>
                                    <td><?=$e->nom?></td>                                    
                                    <td style="text-align: center;"><?=$e->nbquestion?></td>
                                    <td>
                                        <!-- <button class="btn btn-success btn--raised"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button> -->
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("exercice/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$e->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Supprimer">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form>                                                                                 
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h1><b>LES PLUS RECOMMANDES</b></h1>
        </header>
            <div class="table-responsive">
                <?php
                    if(count($mr) > 0)
                    {
                ?>                   

                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>No</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Maximum</th>
                            <th>Niveau</th>                    
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($mr as $r)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td ><?=$r->titre?></td>
                                    <td><?=$r->type?></td>
                                    <td><?=$r->maximum?></td>
                                    <td style="text-align: center;"><?=$r->nom?></td>                                    
                                    <!-- <td style="text-align: center;"><$r->nbquestion?></td> -->
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
                <?php
                }else{
                ?>
                    <p class="text-center">Aucun exercice recommandé</p>
                    <!-- <p><span id="minutes"></span>:<span id="seconds"></span></p> -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    var del = document.getElementById('delete');
    var form = document.getElementById('form-delete');

    del.addEventListener('click',function(e){
        e.preventDefault();
        form.click();
    }); 

    function confirmation(anchor)
    {
        Swal.fire({
        title: 'Voulez-vous vraiment supprimer cet exercice?',
        text: "Vous ne serez plus capable de le récupérer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Supprimé!',
                'Exercice supprimé.',
                'success'
                )
                anchor.submit();
            }
        })
    }  

    $(function()
    {
        // var sec = 0;
        // function pad ( val ) { return val > 9 ? val : "0" + val; }

        // setInterval( function(){
        //     // $("#seconds").html(10%3);
        //     var s = ++sec;
        //     $("#seconds").html(pad(s%60));
        //     $("#minutes").html(pad(parseInt(sec/60,10)));   
        //     if(s%60 == 5)
        //     {
        //         console.log("vous avez epuisé tout votre temps!!!");                
        //     }
        // }, 1000);
    })
</script>