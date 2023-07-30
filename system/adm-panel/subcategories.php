<?php

$pag= "subcategories";
require_once('../../Connection.php');
@session_start();
    // Check if the user is authenticated.
if(@$_SESSION['id_user'] == NULL or @$_SESSION['level_user'] != 'Administrator'){
    echo "<script language='javascript'>window.location='../index.php'</script>";

    }



?>
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#DataModal">New Subcategory</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#DataModal">+</a>   
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        
	    <div class="table-responsive">
            
		    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Categories</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 

                        $query = $pdo->query("SELECT * FROM subcategories order by id DESC");
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i=0; $i < count($result); $i++) { 
                            foreach ($result[$i] as $key => $value) {
                            }

                        $name = $result[$i]['name'];
                        $image = $result[$i]['image'];
                        $category = $result[$i]['id_category'];
                        $id = $result[$i]['id'];

                        // Retrieve the category name.
                        $query2 = $pdo->query("SELECT * FROM categories where id = '$category' ");
                        $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $name_category = @$result2[0]['name']; // Traverse the first row.


                        $query3 = $pdo->query("SELECT * FROM products where subcategory = '$id' ");
                        $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);

                        $items= @count($result3);



                    ?>
                    <tr>
                        <td><?php echo $name ?></td>
                        <td><?php echo $items?></td>
                        <td><?php echo $name_category?></td>
                        <td> <img src="../../images/subcategories/<?php echo $image ?>" width="50"></td>
                        <td>
                            <a href="index.php?pag=<?php echo $pag ?>&function=edit&id=<?php echo $id ?>"  title='Edit Data'><i class="far fa-edit"></i></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=delete&id=<?php echo $id ?>"  title='Delete Record'><i class='far fa-trash-alt'></i></a> 

                        </td>
                    </tr>
                    <?php } ?>
		        </tbody>
            </table>
        </div>
    </div>
</div>

<!--  Data Modal-->
<div class="modal fade"  id="DataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                
            <?php 
                if (@$_GET['function'] == 'edit') {
                    $title = "Edit Record";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM subcategories where id = '" . $id2 . "' ");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    $name2 = $result[0]['name'];
                    $image2 = $result[0]['image'];
                    $category2 = $result[0]['id_category'];

                   
            
                } else {
                    $title = "Insert Record";

                }


            ?>
                
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label >Name</label>
                        <input value="<?php echo @$name2?>"  type="text" class="form-control" id="subcategory-name" name="subcategory-name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label >Category</label>
                        <select class="form-control form-control-sm mt-4" name="category" id="category">
                           <?php 
                               
                                // Check if it is in edit mode.
                                if(@$_GET['function'] == 'edit'){
                                    $query = $pdo->query("SELECT * FROM
                                        categories where id = '$category2'
                                    ");
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $category_name = $result[0]['name']; // Traverse the first row.
                                    echo "<option value='".$category2."'>".$category_name."</option>";
                                }
                                    
                                $query2 = $pdo->query("SELECT * FROM
                                    categories ORDER BY name ASC
                                ");
                                $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                                for ($i=0; $i < count($result2); $i++) { 
                                    foreach ($result2[$i] as $key => $value) {
                                    }
                                    
                                    // this ($result2[$i]['id']) - > Traverse the first row.
                                    if(@$category_name != $result2[$i]['name'] ){
                                        echo "<option value='".$result2[$i]['id']."'>".$result2[$i]['name']."</option>";
                                    }
                                }
                           ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input value="<?php echo @$image2?>"  type="file" class="form-control-file" id="image" name="image"  onChange="uploadImage();" >
                    </div>
                    
                    <?php 
                        
                        if(@$image2 != ""){?>
    
                            <img src="../../images/subcategories/<?php echo $image2 ?>" alt="" width="150px" id="target" height="150px">
                        <?php
                            }else{
                        ?>
        
                            <img src="../../images/subcategories/sem-foto.jpg" alt="" width="150px" id="target" height="150px">
                        
                        <?php
                            }
                    ?> 
                    <small><div id="message"></div></small>
                   
                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <input value="<?php echo @$name2 ?>" type="hidden" name="old" id="old">

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

<?php
    if (@$_GET["function"] != NULL and @$_GET["function"] == "new") {
        echo "<script>  $('#DataModal').modal('show');</script>";
    }
    if (@$_GET["function"] != NULL and @$_GET["function"] == "edit") {
        echo "<script>$('#DataModal').modal('show');</script>";
    }
    if (@$_GET["function"] != NULL and @$_GET["function"] == "delete") {
        echo "<script>$('#deleteModal').modal('show');</script>";
    }
?>




<!--SCRIPT TO LOAD MAIN IMAGE-->
<script type="text/javascript">

    function uploadImage(){

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



<!-- AJAX FOR DATA INSERTION AND EDITING  -->
<script type="text/javascript">
    $("#form").submit(function () {
        
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/insert.php",
            type: 'POST',
            data: formData,

            success: function (message1) {

                $('#message').removeClass()

                if (message1.trim() == "Saved successfully!") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-close').click();
                    window.location = "index.php?pag="+pag;

                } else {

                    $('#message').addClass('text-danger')
                }

                $('#message').text(message1)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>

<!-- AJAX FOR DATA DELETION -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        
        //var formData = new FormData(this);
        $('#btn-delete').click(function(event){
            event.preventDefault();
                    
                $.ajax({
                    url: pag + "/delete.php",
                    type: 'POST',
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (message) {

                        if (message.trim() == "Deleted Successfully!") {
                            
                            $('#btn-cancel-delete').click();
                            window.location = "index.php?pag="+pag;

                        } 

                        $('#delete_message').text(message)

                    },

                })
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>

