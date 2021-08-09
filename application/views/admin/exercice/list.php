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
            title: 'Test saved',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Tests</b></h1>
    </header>

    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <h6><b>Here are all the available tests saved</b></h6>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 180px;">No</th>
                            <th>Title</th>                         
                            <th style="width: 250px;">Nombre de questions</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($exercices as $e)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$e->titre?></td>                  
                                    <td style="text-align: center;"><?=$e->nbquestion?></td>
                                    <td>
                                        <button class="btn btn-success btn--raised"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button>
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("exercice/delete")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$e->id?>" name="id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Delete">
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
        title: 'Do you realy want to delete this test?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Test deleted.',
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