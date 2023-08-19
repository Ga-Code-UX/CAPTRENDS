<?php

$pag= "alerts";
require_once('../../Connection.php');
@session_start();

// Check if the user is authenticated.
if(@$_SESSION['id_user'] == NULL or @$_SESSION['level_user'] != 'Administrator'){
    echo "<script language='javascript'>window.location='../index.php'</script>";

    }


    $now = date('Y-m-d');
?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#dataModal">New Alert</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#dataModal">+</a>   
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                   <?php 

                   $query = $pdo->query("SELECT * FROM alerts order by id desc ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);

                   for ($i=0; $i < count($res); $i++) { 
                      foreach ($res[$i] as $key => $value) {
                      }

                      $message_title = $res[$i]['message_title'];
                      $active = $res[$i]['active'];
                      $id = $res[$i]['id'];
                      $link = $res[$i]['link'];
                      $date = $res[$i]['alert_date'];
                      $date = implode('-',array_reverse(explode('-', $date)));
                     
                       
                      ?>


                    <tr>
                        <td><a target="_blank" href="<?php echo $link ?>"> <?php echo $message_title ?></a></td>
                        <td><?php echo $date ?></td>
                        <td>
                            <a href="index.php?pag=<?php echo $pag ?>&function=edit&id=<?php echo $id ?>" class='text-primary mr-1' title='Edit Record'><i class='far fa-edit'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=delete&id=<?php echo $id ?>" class='text-danger mr-1' title='Delete Record'><i class='far fa-trash-alt'></i></a>

                             
                                <?php if($active == 'Yes'){

                                echo "<a href='index.php?pag=$pag&function=deactivate&id=$id' class='mr-1' title='Deactivate Promotion'><i class='fas fa-square  text-success'></i> </a>";
                                }else{
                                    echo "<a href='index.php?pag=$pag&function=activate&id=$id' class='mr-1' title='Activate Promotion'><i class='fas fa-check-square text-danger'></i></a>";
                                } ?>
                                

                           
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['function'] == 'edit') {
                    $title = "Edit Record";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM alerts where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $alert_title2 = $res[0]['alert_title'];
                    $message_title2 = $res[0]['message_title'];
                    $link2 = $res[0]['link'];
                    $image2 = $res[0]['image'];
                    $message2 = $res[0]['message'];
                    $date2 = $res[0]['alert_date'];
                    
                                        

                } else {
                    $title = "Insert Record";
                    $date2= $now;

                }


                ?>
                
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Alert Title<small>(Max 20 characters)<small></small></label>
                                <input value="<?php echo @$alert_title2 ?>" type="text" class="form-control" id="alert-title" name="alert-title" placeholder="Alert Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Message Title</label>
                                <input value="<?php echo @$message_title2 ?>" type="text" class="form-control" id="message-title" name="message-title" placeholder="Message Title">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label > Message <small>(Max 1000 characters)</small></label>
                        <textarea name="message" id="message" maxlength="1000" class="form-control">
                            <?php echo @$message2 ?>
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Link</label>
                                <input value="<?php echo @$link2 ?>" type="text" class="form-control" id="link" name="link" placeholder="Link">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Image</label>
                                <input type="file" value="<?php echo @$image2 ?>"  class="form-control-file" id="image" name="image" onChange="uploadImage();">
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Date (Until when will it be displayed)</label>
                                <input value="<?php echo @$date2 ?>" type="date" class="form-control" id="date" name="date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if(@$image2 != ""){ ?>
                    	    <img src="../../images/alerts/<?php echo $image2 ?>" width="200" height="200" id="target">
                            <?php  }else{ ?>
                            <img src="../../images/alerts/sem-foto.jpg" width="200" height="200" id="target">
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <small>
                    <div id="message_alert">

                    </div>
                </small> 

                <div class="modal-footer">
                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn-save" id="btn-save" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to delete this record?</p>

                <div align="center" id="delete_message" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-delete">Cancel</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-delete" name="btn-delete" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>







<div class="modal" id="activateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activate Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to activate this alert?</p>

                <div align="center" id="activate_message" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-activate">Cancel</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-activate" name="btn-activate" class="btn btn-danger">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="modal" id="deactivateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deactivate Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <p>Do you really want to deactivate this alert?</p>

                <div align="center" id="deactivate_message" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-deactivate">Cancel</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deactivate" name="btn-deactivate" class="btn btn-danger"> Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php 

if (@$_GET["function"] != null && @$_GET["function"] == "new") {
    echo "<script>$('#dataModal').modal('show');</script>";
}

if (@$_GET["function"] != null && @$_GET["function"] == "edit") {
    echo "<script>$('#dataModal').modal('show');</script>";
}

if (@$_GET["function"] != null && @$_GET["function"] == "delete") {
    echo "<script>$('#deleteModal').modal('show');</script>";
}

if (@$_GET["function"] != null && @$_GET["function"] == "activate") {
    echo "<script>$('#activateModal').modal('show');</script>";
}

if (@$_GET["function"] != null && @$_GET["function"] == "deactivate") {
    echo "<script>$('#deactivateModal').modal('show');</script>";
}

?>


<script type="text/javascript">
    $("#form").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/insert.php",
            type: 'POST',
            data: formData,

            success: function (message) {

                $('#message').removeClass()

                if (message.trim() == "Saved successfully!") {
                    
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-close').click();
                    window.location = "index.php?pag="+pag;

                } else {

                    $('#message').addClass('text-danger')
                }

                $('#message').text(message)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { 
                    myXhr.upload.addEventListener('progress', function () {
                        
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-delete').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/delete.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (message) {

                    if (message.trim() === 'Deleted successfully!') {


                        $('#btn-cancel-delete').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#delete_message').addClass('text-danger')
                    $('#delete_message').text(message)



                },

            })
        })
    })
</script>

<!-- AJAX for activating promotion -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-activate').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/activate.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Activated successfully!') {


                        $('#btn-cancel-activate').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#message_activate').addClass('text-danger')
                    $('#message_activate').text(mensagem)



                },

            })
        })
    })
</script>




<!--AJAX PARA DESATIVAR PROMOCAO -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-deactivate').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/deactivate.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Deactivated successfully!') {


                        $('#btn-cancel-deactivate').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#deactivate_message').text(mensagem)



                },

            })
        })
    })
</script>



<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

    function uploadImage() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

</script>





<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>