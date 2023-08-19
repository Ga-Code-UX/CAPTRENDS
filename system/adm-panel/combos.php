<?php

$pag = "combos";
require_once('../../Connection.php');
@session_start();
    

// Check if the user is authenticated.
if(@$_SESSION['id_user'] == NULL or @$_SESSION['level_user'] != 'Administrator'){
    echo "<script language='javascript'>window.location='../index.php'</script>";

    }



?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#dataModal">New Combos</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#dataModal">+</a>   
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Products</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

                        $query = $pdo->query("SELECT * FROM combos order by id desc");
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i=0; $i < count($result); $i++) { 
                            foreach ($result[$i] as $key => $value) {
                            }

                        $name = $result[$i]['name'];
                        $value = $result[$i]['value'];
                       
                        $image = $result[$i]['image'];
                        $active = $result[$i]['active'];

                        $id = $result[$i]['id'];
                        $value = number_format($value,2,',','.');
                        
                       
                        $query2 = $pdo->query("SELECT * FROM products_combo where combo_id = '$id'");
                        $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $total_products = @count($result2);
                            
                        $class = "";
                        if($active == "Yes"){
                            $class = "text-success";
                        }
                        else{
                            $class = "text-secondary";
                        }
                       
                    ?>


                    <tr>
                        <td>
                            <i class="fas fa-square <?php echo $class?>"></i>
                            <a href="index.php?pag=<?php echo $pag ?>&function=products&id=<?php echo $id ?>" class="text-info">
                                <?php echo $name ?>
                             /
                                <i class='far fa-edit'>Add Product</i>
                            </a>
                          
                        </td>
                        <td>R$ <?php echo $value ?></td>
                        <td><?php echo $total_products ?></td>
                        <td> <img src="../../images/combos/<?php echo $image ?>" width="50"></td>

                        <td>
                            <a href="index.php?pag=<?php echo $pag ?>&function=edit&id=<?php echo $id ?>" class='text-primary mr-1' title='Edit Record'><i class='far fa-edit'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=delete&id=<?php echo $id ?>" class='text-danger mr-1' title='Delete Record'><i class='far fa-trash-alt'></i></a>
                            
                        </td>
                    </tr>
                    <?php } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Dados -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['function'] == 'edit') {
                    $title = "Edit Record";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM combos where id = '" . $id2 . "' ");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    $name2 = $result[0]['name'];
                    $image2 = $result[0]['image'];
                    $value2 = $result[0]['value'];
                    $description2 = $result[0]['description'];
                    $long_description2 = $result[0]['long_description'];
                    $shipping_type2 = $result[0]['shipping_type'];
                    $keywords2 = $result[0]['keywords'];
                    $active2 = $result[0]['active'];
                    $weight2 = $result[0]['weight'];
                    $height2 = $result[0]['height'];
                    $width2 = $result[0]['width'];
                    $length2 = $result[0]['length'];
                    $shipping_value2 = $result[0]['shipping_value'];
                    

                   
            
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Name</label>
                                <input value="<?php echo @$name2 ?>" type="text" class="form-control  form-control-sm" id="product-name" name="product-name" placeholder="Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Value</label>
                                <input value="<?php echo @$valor2 ?>" type="text" class="form-control  form-control-sm" id="value" name="value" placeholder="Value">
                            </div>             
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Type of Shipping</label>
                                <select class="form-control form-control-sm " name="shipping-type" id="shipping-type">
                                    <?php 
                                            
                                            if(@$_GET['function'] == 'edit'){
                                                $query = $pdo->query("SELECT * FROM
                                                    type_of_shipping where id = '$shipping_type2'
                                                ");
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                $type_name = $result[0]['name']; 
                                                echo "<option value='".$shipping_type2."'>".$type_name."</option>";
                                            }
                                                
                                            $query4 = $pdo->query("SELECT * FROM
                                                type_of_shipping ORDER BY name ASC
                                            ");
                                            $result4 = $query4->fetchAll(PDO::FETCH_ASSOC);

                                            for ($i=0; $i < count($result4); $i++) { 
                                                foreach ($result4[$i] as $key => $value) {
                                                }
                                                
                                                // $result2[$i]['id'] - > percorre todas as linhas
                                                if(@$type_name != $result4[$i]['name'] ){
                                                    echo "<option value='".$result4[$i]['id']."'>".$result4[$i]['name']."</option>";
                                                }
                                            }
                                    ?>
                                </select>
                            </div>             
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Active</label>
                                <select class="form-control form-control-sm " name="active" id="active">
                                    <?php 
                                            
                                            if(@$_GET['function'] == 'edit'){
                    
                                                echo "<option value='".$active2."'>".$active2."</option>";
                                            }
                                                
                                            if(@$active2 != 'No' ){
                                                echo "<option value='No'>No</option>";
                                            }
                                          
                                            if(@$active2 != 'Yes' ){
                                                    echo "<option value='Yes'>Yes</option>";
                                            }
                                            
                                    ?>
                                </select>
                            </div>             
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <label>Short Description (1000 characters)</label>
                            <textarea type="text" maxlength="500" class="form-control  form-control-sm" id="description" name="description" >
                            <?php echo @$description2 ?>
                            </textarea>
                    </div>
                    <div class="form-group mt-4">
                            <label>Long Description</label>
                            <textarea type="text" class="form-control  form-control-sm" id="long-description" name="long-description" >
                            <?php echo @$long_description2 ?>
                            </textarea>
                    </div>
                  
                    <div class="form-group mt-4">
                        <label>Keywords</label>
                        <input value="<?php echo @$keywords2 ?>" type="text" class="form-control  form-control-sm" id="keywords" name="keywords" placeholder="Keywords">
                    </div> 

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Weight</label>
                                <input value="<?php echo @$weight2 ?>" type="text" class="form-control  form-control-sm" id="weight" name="weight" placeholder="Weight">
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Width</label>
                                <input value="<?php echo @$width2 ?>" type="text" class="form-control  form-control-sm" id="width" name="width" placeholder="Width">
                            </div> 
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Height</label>
                                <input value="<?php echo @$height2 ?>" type="text" class="form-control  form-control-sm" id="height" name="height" placeholder="Height">
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Length</label>
                                <input value="<?php echo @$length2 ?>" type="text" class="form-control  form-control-sm" id="length" name="length" placeholder="Length">
                            </div> 
                        </div>

                    </div>
                 
                    <div class="row mt-4">
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fixed Freight Value</label>
                                <input value="<?php echo @$shipping_value2 ?>" type="text" class="form-control  form-control-sm" id="shipping-value" name="shipping-value" placeholder="Shipping Value">
                            </div> 
                        </div>
                      
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Image</label>
                                <input value="<?php echo @$image2 ?>" type="file" class="form-control-file" id="image" name="image" onChange="uploadImage();">
                            </div>
                        </div>
                        <div class="col-md-4">

                                <?php if(@$image2 != ""){?>

                                    <img src="../../images/combos/<?php echo $image2 ?>" alt="" width="100px" id="target" height="100px">
                                <?php
                                    }else{
                                ?>
                
                                    <img src="../../images/combos/sem-foto.jpg" alt="" width="100px" id="target" height="100px">
                                
                                <?php  } ?>  
                        </div>                 
                    

                    </div>
                       
                   

                    <small>
                        <div id="message">

                        </div>
                    </small> 

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <input value="<?php echo @$name2 ?>" type="hidden" name="old" id="old">
                   

                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
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


<div class="modal" id="productsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-9" >
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 

                                        $query = $pdo->query("SELECT * FROM products where active = 'Yes'");
                                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                                        for ($i=0; $i < count($result); $i++) { 
                                            foreach ($result[$i] as $key => $value) {
                                            }

                                        $product_name = $result[$i]['name'];
                                        $product_value = $result[$i]['value'];
                                        $product_id= $result[$i]['id'];
                                        $product_value  = number_format($product_value,2,',','.');
                                        
                                    ?>

                                
                                    <tr>
                                        <td>
                                            <?php echo $product_name?>
                                        </td>
                                        <td>R$ <?php echo $product_value ?></td>
                                        <td>

                                            <form id="form-product" method="post">

                                                <input type="hidden" id="txtid"  name="txtid" value="<?php echo @$_GET['id'] ?>">

                                                <input type="hidden" id="txtidProduct"  name="txtidProduct">


                                                <a id="btn-add-products" href="#" onClick="addProduct(<?php echo $product_id ?>)" class="text-success mr-1" title="Add Product"><i class="fas fa-check"></i></a>

                                            </form>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>      
                    <div class="col-md-3">
                        <p>Combo Products</p>
                        <div id="combo-product" >
                            
                        </div>

                        <small><div id="message_product" class="mt-6"></div></small>

                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal" id="deleteProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to delete this product from the combo?</p>

                <div align="center" id="message_delete_product" class=""></div>

            </div>
            <div class="modal-footer">

                <form method="post">
                    <input type="hidden" name="product_id" id="product_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-delete-product">Cancel</button>                  
                    <button type="button" id="btn-delete-product" name="btn-delete-product" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php

    if(@$_GET["function"] != NULL and @$_GET["function"] == "new"){
        echo "<script> $('#dataModal').modal('show');</script>";
    }
    if(@$_GET["function"] != NULL and @$_GET["function"] == "edit"){
        echo "<script> $('#dataModal').modal('show');</script>";
    }
    if(@$_GET["function"] != NULL and @$_GET["function"] == "delete"){
        echo "<script> $('#deleteModal').modal('show');</script>";
    }
  
    if(@$_GET["function"] != NULL and @$_GET["function"] == "products"){
        echo "<script> $('#productsModal').modal('show');</script>";
    }
?>
<!--Script que é executado ao carregar a página-->
<script type="text/javascript">
    $(document).ready(function () {
        listProducts();
        

    })
</script>
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
                //alert(mensagem)
                $('#message').removeClass()

                if (message.trim() == "Saved successfully!") {
                
                    window.location = "index.php?pag="+pag;

                } else {
                    //$('#btn-fechar').click();
                    $('#message').addClass('text-danger')
                }
                
                $('#message').addClass('text-success')
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
                    success: function (mensagem) {

                        if (mensagem.trim() == "Deleted Successfully!") {
                            
                            $('#btn-cancel-delete').click();
                            window.location = "index.php?pag="+pag;

                        } 
                        $('#delete_message').addClass('text-success')
                        $('#delete_message').text(mensagem)
                       

                    },

                })
        });
    });
</script>


<script type="text/javascript">
    function listProducts() {
        var pag = "<?=$pag?>";
        
        $.ajax({
            url: pag + "/list-products.php",
            method: "post",
            data: $('#form-product').serialize(),
            dataType: "html",
            success: function (result) {

                $('#combo-product').html(result);
            }
        })
    }
</script>





<!--FUNCAO PARA CHAMAR MODAL DE ADD Prod  -->
<script type="text/javascript">
    function addProduct(id) {
        document.getElementById('txtidProduct').value = id;
       
        event.preventDefault();
        var pag = "<?=$pag?>";
        $.ajax({
        url: pag + "/add-product.php",
        method:"post",
        data: $('#form-product').serialize(),
        dataType: "text",
        success: function(message){
            if(message.trim() === 'Saved successfully!'){

                        listProducts();
                        $('#message_product').text('')
                    }
                    else{
                        $('#message_product').addClass('text-danger')
                        $('#message_product').text(message);


                    }
                    }
        });

    }
</script>


<script type="text/javascript">
  function deleteProduct(id) {
    console.log(id);
    document.getElementById('product_id').value = id;
    $('#deleteProductModal').modal('show');

  }
</script>

<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
  $(document).ready(function () {
    var pag = "<?=$pag?>";
    $('#btn-delete-product').click(function (event) {
      event.preventDefault();

      $.ajax({
        url: pag + "/delete-product.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function (message) {

          if (message.trim() === 'Successfully deleted!') {


            listProducts();
            $('#btn-cancel-delete-product').click();
            $('#message_product').text('')

          }else{
            $('#btn-cancel-delete-product').click();
            $('#message_delete_product').text(message)
          }

        },

      })
    })
  })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })
        $('#dataTable2').dataTable({
            "ordering": false
        })

    });
</script>

<style>
  hr{
    margin:3px;
  }
</style>