<?php

$pag= "products";
require_once('../../Connection.php');
@session_start();

// Check if the user is authenticated.
if(@$_SESSION['id_user'] == NULL or @$_SESSION['level_user'] != 'Administrator'){
    echo "<script language='javascript'>window.location='../index.php'</script>";

    }


    $now = date('Y-m-d');
?>
<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#modalData">New Product</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag?>&function=new" data-toggle="modal" data-target="#modalData">+</a>   
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
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

                        $query = $pdo->query("SELECT * FROM products order by id desc");
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i=0; $i < count($result); $i++) { 
                            foreach ($result[$i] as $key => $value) {
                            }

                        $name = $result[$i]['name'];
                        $value = $result[$i]['value'];
                        $stock = $result[$i]['stock'];
                        $subcategory = $result[$i]['subcategory'];
                        $image = $result[$i]['image'];
                        $active = $result[$i]['active'];
                        $promotion = $result[$i]['promotion'];
                        $id = $result[$i]['id'];
                        $value = number_format($value, 2, ',', '.');
                        
                        // recuperar o nome da categoria
                        $query2 = $pdo->query("SELECT * FROM subcategories where id = '$subcategory' ");
                        $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $subcategory_name = @$result2[0]['name']; // percorrer primeira linha
                            
                        $classe = "";
                        if($active == "Yes"){
                            $classe = "text-success";
                        }
                        else{
                            $classe = "text-secondary";
                        }
                       
                    ?>


                    <tr>
                        <td>
                            <i class="fas fa-square <?php echo $classe?>"></i>
                            <a href="index.php?pag=<?php echo $pag ?>&function=characteristics&id=<?php echo $id ?>" class="text-info">
                                <?php echo $name ?>
                            </a>
                          
                        </td>
                        <td>R$ <?php echo $value ?></td>
                        <td><?php echo $stock ?></td>
                        <td><?php echo $subcategory_name?></td>
                        <td> <img src="../../images/products/<?php echo $image ?>" width="50"></td>

                        <td>
                            <a href="index.php?pag=<?php echo $pag ?>&function=edit&id=<?php echo $id ?>" class='text-primary mr-1' title='Edit Record'><i class='far fa-edit'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=delete&id=<?php echo $id ?>" class='text-danger mr-1' title='Delete Record'><i class='far fa-trash-alt'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=images&id=<?php echo $id ?>" class='text-info mr-1' title='Insert Images'><i class='fas fa-images'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&function=promotion&id=<?php echo $id ?>" class=' mr-1' title='Add Promotion' >
                                <?php 
                                
                                    if($promotion == 'Yes'){
                                    echo "<i class='fas fa-coins text-success'></i>";
                                    }
                                    else{
                                    echo "<i class='fas fa-coins text-danger'></i>";
                                    } 
                                ?>
                           </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Dados -->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['function'] == 'edit') {
                    $title = "Edit Record";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM products where id = '" . $id2 . "' ");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    $name2 = $result[0]['name'];
                    $image2 = $result[0]['image'];
                    $subcategory2 = $result[0]['subcategory'];
                    $value2 = $result[0]['value'];
                    $stock2 = $result[0]['stock'];
                    $description2 = $result[0]['description'];
                    $long_description2 = $result[0]['long_description'];
                    $shipping_type2 = $result[0]['shipping_type'];
                    $keywords2 = $result[0]['keywords'];
                    $active2 = $result[0]['active'];
                    $weight2 = $result[0]['weight'];
                    $height2 = $result[0]['height'];
                    $width2 = $result[0]['width'];
                    $length2 = $result[0]['length'];
                    $brand2 = $result[0]['brand'];
                    $shipping_cost2 = $result[0]['shipping_cost'];
                    $category_name2 = $result[0]['category'];
                 
                    
            
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >Name</label>
                                <input value="<?php echo @$name2 ?>" type="text" class="form-control  form-control-sm" id="product-name" name="product-name" placeholder="Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control form-control-sm " name="category" id="category">
                                    <?php 
                                            // averigua se está em modo edição
                                            if(@$_GET['function'] == 'edit'){
                                                $query = $pdo->query("SELECT * FROM
                                                    categories where id = '$category_name2'
                                                ");
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                $category_name = $result[0]['name']; // percorrer primeira linha
                                                echo "<option value='".$category_name2."'>".$category_name."</option>";
                                            }
                                                
                                            $query3 = $pdo->query("SELECT * FROM
                                                categories ORDER BY name ASC
                                            ");
                                            $result3 = $query3->fetchAll(PDO::FETCH_ASSOC);

                                            for ($i=0; $i < count($result3); $i++) { 
                                                foreach ($result3[$i] as $key => $value) {
                                                }
                                                
                                                // $result2[$i]['id'] - > percorre todas as linhas
                                                if(@$category_name != $result3[$i]['name'] ){
                                                    echo "<option value='".$result3[$i]['id']."'>".$result3[$i]['name']."</option>";
                                                }
                                            }
                                    ?>
                                </select>
                                <input type="hidden" id="txtCat" name="txtCat">
                               <!-- <input value="<?php echo $subcategory2?>" type="hidden" id="txtSub" name="txtSub">-->
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label >Subcategory</label>
                                <span id="list-subcategories"></span>
                                
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Value</label>
                                <input value="<?php echo @$value2 ?>" type="text" class="form-control  form-control-sm" id="value" name="value" placeholder="Value">
                            </div>             
                        </div>

                    </div>
                    
                    <div class="form-group">
                            <label>Description (1000 caracteres)</label>
                            <textarea type="text" maxlength="500" class="form-control  form-control-sm" id="description" name="description" >
                            <?php echo @$description2 ?>
                            </textarea>
                    </div>
                    <div class="form-group">
                            <label>Long Description </label>
                            <textarea type="text" class="form-control  form-control-sm" id="long-description" name="long-description" >
                            <?php echo @$long_description2 ?>
                            </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Stock</label>
                                <input value="<?php echo @$stock2 ?>" type="text" class="form-control  form-control-sm" id="stock" name="stock" placeholder="stock">
                            </div>             
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Shipping Type</label>
                                <select class="form-control form-control-sm " name="shipping-type" id="shipping-type">
                                    <?php 
                                            // averigua se está em modo edição
                                            if(@$_GET['function'] == 'edit'){
                                                $query = $pdo->query("SELECT * FROM
                                                   type_of_shipping where id = '$shipping_type2'
                                                ");
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                $type_name = $result[0]['name']; // percorrer primeira linha
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Active</label>
                                <select class="form-control form-control-sm " name="active" id="active">
                                    <?php 
                                            // averigua se está em modo edição
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
                        <label>Keywords</label>
                        <input value="<?php echo @$keywords2 ?>" type="text" class="form-control  form-control-sm" id="keywords" name="keywords" placeholder="keywords">
                    </div> 

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label >Weight <small><small>(in KG -Ex:200g -> 0.2)</small></small></label>
                                <input value="<?php echo @$weight2 ?>" type="text" class="form-control  form-control-sm" id="weight" name="weight" placeholder="weight in KG">
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Width</label>
                                <input value="<?php echo @$width2 ?>" type="text" class="form-control  form-control-sm" id="width" name="width" placeholder="width">
                            </div> 
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Height</label>
                                <input value="<?php echo @$height2 ?>" type="text" class="form-control  form-control-sm" id="height" name="height" placeholder="height">
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Length</label>
                                <input value="<?php echo @$length2 ?>" type="text" class="form-control  form-control-sm" id="length" name="length" placeholder="length">
                            </div> 
                        </div>

                    </div>
                  
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Brand</label>
                                <input value="<?php echo @$brand2 ?>" type="text" class="form-control  form-control-sm" id="brand" name="brand" placeholder="brand">
                            </div> 
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Shipping Cost</label>
                                <input value="<?php echo @$shipping_cost2 ?>" type="text" class="form-control  form-control-sm" id="shipping-cost" name="shipping-cost" placeholder="shipping cost">
                            </div> 
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Image</label>
                                <input value="<?php echo @$image2 ?>" type="file" class="form-control-file" id="image" name="image" onChange="uploadImage();">
                            </div>

                            <?php 
                                
                            if(@$image2 != ""){?>

                                <img src="../../images/products/<?php echo $image2 ?>" alt="" width="100px" id="target" height="100px">
                            <?php
                                }else{
                            ?>
            
                                <img src="../../images/products/sem-foto.jpg" alt="" width="100px" id="target" height="100px">
                            
                            <?php
                                }
                            ?>                   
                        </div>

                    </div>
                       
                   

                    <small>
                        <div id="message">

                        </div>
                    </small> 

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <input value="<?php echo @$name2 ?>" type="hidden" name="antigo" id="antigo">
                   

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

                <p>Are you sure you want to delete this record?</p>

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

<!--- Photos Modal-->
<div class="modal" id="photosModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Images</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-photos" method="POST" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Product Images</label>
                                <input type="file" class="form-control-file" id="productImage" name="productImage" onchange="uploadProductImage();">

                            </div>

                            <div class="col-md-12 mb-2">
                                <img src="../../images/products/details/sem-foto.jpg" width="100px" height="100px" alt="Carregue sua Imagem" id="targetProductImage" >
                            </div>

                        </div>

                        <div class="col-md-7" id="list-images">

                        </div>

                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-pic">Cancel</button>
                        
                        <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                        <button type="submit" id="btn-pic" name="btn-pic" class="btn btn-info">Save</button>

                    </div>


                    <small>     
                        <div align="center" id="pic_message" class="">

                        </div>
                    </small>   
                </form>
            </div>

        </div>
    </div>
</div>   


<div class="modal" id="DeleteImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to delete this image?</p>

                <div align="center" id="delete_photo_message" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-image">Cancel</button>
                <form method="post">
                    <input type="hidden" name="photo_id" id="photo_id">                  
                    <button type="button" id="btn-delete-image" name="btn-delete-image" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal" id="characteristics-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" id="form-feature">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Feature</label>
                        <select class="form-control form-control-sm" name="product-feature" id="product-feature">
                            <?php 
                                
                                $query2 = $pdo->query("SELECT * from characteristic order by name asc ");
                                    $result_feature = $query2->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i=0; $i < count($result_feature); $i++) { 
                                        foreach ($result_feature[$i] as $key => $value) {
                                         }
                                        echo "<option value='".$result_feature[$i]['id']."' >" .$result_feature[$i]['name'] . "</option>"; 
                                      
                                    }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" id="list-feature"></div>
                </div>
                
                <small><div id="feature-message" class=""></div></small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-feature">Cancel</button>
               

                    <input type="hidden" id="txtid-feature"  name="txtid-feature" value="<?php echo @$_GET['id'] ?>">


                    <button type="button" id="btn-add-feature" name="btn-add-feature" class="btn btn-info">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="modal" id="modalDeleteCharacteristic" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to delete this feature?</p>

                <div align="center" id="delete-feature-message" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-feature-delete">Cancel</button>
                <form method="post">
                    <input type="hidden" name="product-feature-id" id="product-feature-id">                  
                    <button type="button" id="btn-delete-feature" name="btn-delete-feature" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="promotionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <?php 
                $id_pro = @$_GET['id'];
                $result_promo = $pdo->query("SELECT * FROM promotions where product_id = '$id_pro'"); 
                $data = $result_promo->fetchAll(PDO::FETCH_ASSOC);
                if(@count($data) > 0){
                  $promotion_value = $data[0]['value'];
                  $start_date = $data[0]['start_date'];
                  $end_date = $data[0]['end_date'];
                  $active2 = $data[0]['active'];
                  $discount2 = $data[0]['discount'];
                  $edit = 'yes';
                  $promotion_text = 'Promotional Value of this Product - '.$promotion_value;
                }else{
                  $edit = 'no';
                  $start_date = $now;
                  $end_date = $now;
                }
               ?>
             <form method="post" id="form-promotion">
              
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Discount % <small>(e.g. 20, 30)<small></small></label>
                            <input  type="number" class="form-control" id="promotion-value" name="promotion-value" placeholder="Value in % ex 15" value="<?php echo @$discount2  ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Active</label>
                            <select class="form-control form-control-sm" name="promotion-active" id="promotion-active">
                                    <?php 
                                    if (@$edit == 'yes') {
                                    
                                        echo "<option value='".$active2."' >" .$active2. "</option>";
                                    }


                                    if(@$active2 != "Yes"){
                                        echo "<option value='Yes'>Yes</option>"; 
                                    }

                                    if(@$active2 != "No"){
                                        echo "<option value='No'>No</option>"; 
                                    }

                                ?>
                            </select>               
                        </div>
                    </div>
                </div>
                    
                 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Start Date</label>
                            <input  type="date" class="form-control" id="promotion-start-date" name="promotion-start-date" value="<?php echo $start_date ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label >End Date</label>
                            <input  type="date" class="form-control" id="promotion-end-date" name="promotion-end-date" value="<?php echo $end_date ?>">
                        </div>
                    </div>
                </div>
                
                <p class="text-success"><?php echo @$promotion_text ?></p>                 
                <div align="center" id="promotion_message" class=""></div>
            </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-promotion">Cancel</button>
               
                    <input type="hidden" name="promotion_id" id="promotion_id" value="<?php echo @$_GET['id'] ?>">                  
                    <button type="button" id="btn-promotion" name="btn-promotion" class="btn btn-info">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal" id="modalAddItem" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

             <form method="post" id="form-item-list">
                <input type="hidden" name="id_characteristic_item_2" id="id_characteristic_item_2">
                <a id="btn-item-list" name="btn-item-list"></a>
             </form>
             <form method="post" id="form-item">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >*Description</label>
                            <input value="" type="text" class="form-control" id="item-name" name="item-name" placeholder="Item description">
                        </div>

                        <div class="form-group">
                                <label >Value <small>If Exists - Addition<small></label>
                                <input value="" type="text" class="form-control" id="item-addition" name="item-addition" placeholder="Valor de Acréscimo">
                        </div

                        <div class="form-group">
                                <label ><small>If Exists - (e.g. Hexadecimal Color Code)<small></label>
                                <input value="" type="text" class="form-control" id="item-value" name="item-value" placeholder="Valor Item Ex #FFFFFF">
                        </div>
                    </div>

                    <div class="col-md-12" id="list-items">
                        
                    </div>
                </div>
                

                <div align="center" id="message_item" class="">

                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-item">Cancel</button>
               
                    <input type="hidden" name="id_characteristic_item" id="id_characteristic_item">                  
                    <button type="button" id="btn-item" name="btn-item" class="btn btn-info">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalDeleteItem" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Do you really want to delete this item?</p>

                <div align="center" id="message_delete_item" class=""></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-item-delete">Cancel</button>
                <form method="post">
                    <input type="hidden" name="id_item_characteristic" id="id_item_characteristic">                  
                    <button type="button" id="btn-delete-item" name="btn-delete-item" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="deactivateItemModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deactivate Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p>Do you really want to deactivate this item?</p>

        <div align="center" id="deactivate_item_message" class="">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-deactivated-item">Cancel</button>
        <form method="post">
          <input type="hidden" name="deactivate_characteristic_item_id" id="deactivate_characteristic_item_id">                  
          <button type="button" id="btn-deactivate-item" name="btn-deactivate-item" class="btn btn-danger">Deactivate</button>
        </form>
      </div>
    </div>
  </div>
</div>





<div class="modal" id="activateItemModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Activate Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <p>Do you really want to Activate this item?</p>

        <div align="center" id="activate_item_message" class="">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-item-ativo">Cancel</button>
        <form method="post">
          <input type="hidden" name="activate_characteristic_item_id" id="activate_characteristic_item_id">                  
          <button type="button" id="btn-activate-item" name="btn-activate-item" class="btn btn-success">Activate</button>
        </form>
      </div>
    </div>
  </div>
</div>




<?php

    if(@$_GET["function"] != NULL and @$_GET["function"] == "new"){
        echo "<script> $('#modalData').modal('show');</script>";
    
    }
    if(@$_GET["function"] != NULL and @$_GET["function"] == "edit"){
        echo "<script> $('#modalData').modal('show');</script>";
    }
    if(@$_GET["function"] != NULL and @$_GET["function"] == "delete"){
        echo "<script> $('#deleteModal').modal('show');</script>";
    }
    if(@$_GET["function"] != NULL and @$_GET["function"] == "images"){
        echo "<script> $('#photosModal').modal('show');</script>";
    }

    if(@$_GET["function"] != NULL and @$_GET["function"] == "characteristics"){
        echo "<script> $('#characteristics-modal').modal('show');</script>";
    }
    if (@$_GET["function"] != NULL and @$_GET["function"] == "promotion") {
        echo "<script> $('#promotionModal').modal('show'); </script>";
    }
?>

<!--Script executed on page load-->
<script type="text/javascript">
    $(document).ready(function () {
        listProductImages();
        listProductFeature();
        document.getElementById('txtCat').value = document.getElementById('category').value;
        ListSubcategories();

    })
</script>

<script type="text/javascript">
    function ListSubcategories() {
        var pag = "<?=$pag?>";

        $.ajax({
            url: pag + "/list-subcategories.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function (result) {

                $('#list-subcategories').html(result);
            }
        })
    }
</script>


<!-- Script to search using the select -->
<script type="text/javascript">

    $('#category').change(function () {
        document.getElementById('txtCat').value = $(this).val();
        ListSubcategories();
    })

</script>

<!--SCRIPT TO LOAD MAIN IMAGE-->
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

<!--SCRIPT TO LOAD PRODUCT IMAGE-->
<script type="text/javascript">

    function uploadProductImage() {

        var target = document.getElementById('targetProductImage');
        var file = document.querySelector("input[id=productImage]").files[0];
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

            success: function (message) {
                //alert(message)
                $('#message').removeClass()

                if (message.trim() == "Saved successfully!") {

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



<!------------------------- THIS SCRIPT IS FOR THE IMAGES PART --------------------------->


<!-- AJAX FOR INSERTION AND EDITING OF PRODUCT IMAGE DATA -->
<script type="text/javascript">
    $("#form-photos").submit(function () {
        
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/insert-images.php",
            type: 'POST',
            data: formData,

            success: function (message) {
                //alert(mensagem)
                $('#pic_message').removeClass()

                if (message.trim() == "Saved successfully!") {
                    $('#pic_message').addClass('text-success')
                    $('#pic_message').text(message)
                    listProductImages();
                } else {

                    $('#pic_message').addClass('text-danger')
                }

                $('#pic_message').text(message)

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

 <!-- Script to list product images -->
<script type="text/javascript">
    function listProductImages() {
        var pag = "<?=$pag?>";

        $.ajax({
            url: pag + "/list-images.php",
            method: "post",
            data: $('#form-photos').serialize(),
            dataType: "html",
            success: function (result) {

                $('#list-images').html(result);
            }
        })
    }
</script>

 <!-- FUNCTION TO CALL THE IMAGE DELETION MODAL -->
<script type="text/javascript">
    function deleteImage(image) {
        document.getElementById('photo_id').value = image;
        $('#DeleteImageModal').modal('show');
    }
</script>

 <!-- AJAX FOR IMAGE DELETION -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        
        //var formData = new FormData(this);
        $('#btn-delete-image').click(function(event){
            event.preventDefault();
                    
                $.ajax({
                    url: pag + "/delete-image.php",
                    type: 'POST',
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (message) {

                        if (message.trim() === "Deleted Successfully!") {
                            
                            $('#pic_message').text(message);
                            $('#btn-cancel-image').click();
                          
                            listProductImages();
                           
                        } 

                        $('#delete_photo_message').text(message);

                    },

                })
        });
    });
</script>



<!------------------------- THIS SCRIPT IS FOR THE ADD PRODUCT FEATURE --------------------------->

<!-- AJAX TO INSERT PRODUCT FEATURE DATA -->

<script type="text/javascript">
    $('#btn-add-feature').click(function(event){
        event.preventDefault();
        var pag = "<?=$pag?>";
        $.ajax({
            url: pag + "/add-feature.php",
            method:"post",
            data: $('#form-feature').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Saved successfully!'){

                    $('#feature-message').addClass('text-success')
                    $('#feature-message').text(msg);
                    listProductFeature();
                    
                    }
                 else{
                    $('#feature-message').addClass('text-danger')
                    $('#feature-message').text(msg);
                   

                 }
            }
        })
    })
</script>


<!-- script to list features-->
<script type="text/javascript">
    function listProductFeature() {
        var pag = "<?=$pag?>";
        
        $.ajax({
            url: pag + "/list-feature.php",
            method: "post",
            data: $('#form-feature').serialize(),
            dataType: "html",
            success: function (result) {

                $('#list-feature').html(result);
            }
        })
    }
</script>

<!--Function to call the delete product feature modal-->
<script type="text/javascript">
    function deleteCharacteristic(id) {

        document.getElementById('product-feature-id').value = id;
        $('#modalDeleteCharacteristic').modal('show');

    }
</script>



<!--AJAX to delete the product feature -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-delete-feature').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/delete-feature.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (message) {

                    if (message.trim() === 'Deleted Successfully!') {

                        $('#btn-cancel-feature-delete').click();
                        listProductFeature();
                        $('#feature-message').text(message)
   
                    }

                    $('#delete-feature-message').text(message)

                },

            })
        })
    })
</script>

<!------------------------- THIS SCRIPT IS FOR THE ADD ITEM OF THE FEATURE --------------------------->

<!--Function to call delete item modal for characteristics. -->
<script type="text/javascript">
    function deleteItem(id) {

        document.getElementById('id_item_characteristic').value = id;
        $('#modalDeleteItem').modal('show');

    }
</script>


<!-- AJAX for item deletion -->
<script type="text/javascript">
  $(document).ready(function () {
    var pag = "<?=$pag?>";
    $('#btn-delete-item').click(function (event) {

      event.preventDefault();

      $.ajax({
        url: pag + "/delete-item.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function (message) {

          if (message.trim() === 'Successfully deleted!') {

            $('#btn-cancel-item-delete').click();
            $('#message_item').text(message)

            $('#btn-item-list').click();
          }

          $('#message_delete_item').text(message)



        },

      })
    })
  })
</script>

<!-- Function to call add item to characteristics modal -->
<script type="text/javascript">
    function addItem(id) {

        document.getElementById('id_characteristic_item').value = id;
        document.getElementById('id_characteristic_item_2').value = id;
        $('#btn-item-list').click();
        $('#modalAddItem').modal('show');

    }
</script>


<!-- AJAX for adding item to product characteristics -->
<script type="text/javascript">
    $('#btn-item').click(function(event){
        event.preventDefault();
        var pag = "<?=$pag?>";
        $.ajax({
            url: pag + "/add-item.php",
            method:"post",
            data: $('#form-item').serialize(),
            dataType: "text",
            success: function(message){
                if(message.trim() === 'Saved Successfully!'){

                    $('#message_item').addClass('text-success')
                    $('#message_item').text(message);
                    $('#btn-item-list').click();
                    document.getElementById('item-name').value = "";
                    document.getElementById('item-name').focus();
                    }
                 else{
                    $('#message_item').addClass('text-danger')
                    $('#message_item').text(message);
                   

                 }
            }
        })
    })
</script>


<script type="text/javascript">
    $('#btn-item-list').click(function(event){
        event.preventDefault();
        var pag = "<?=$pag?>";
        
        $.ajax({
            url: pag + "/list-items.php",
            method: "post",
            data: $('#form-item-list').serialize(),
            dataType: "html",
            success: function (result) {

                $('#list-items').html(result);
            }
        })
    })
    
</script>

<script type="text/javascript">
    $('#btn-promotion').click(function(event){
        
        event.preventDefault();
        var pag = "<?=$pag?>";
        $.ajax({
            url: pag + "/add-promotion.php",
            method:"post",
            data: $('#form-promotion').serialize(),
            dataType: "text",
            success: function(message){
                if(message.trim() === 'Saved Successfully!'){   
                    $('#btn-cancel-promotion').click();
                    window.location = "index.php?pag="+pag;
                }
                else{
                    
                    $('#promotion_message').addClass('text-danger')
                    $('#promotion_message').text(message);
                }
            }
        })
    })
</script>
<!------------------------- THIS SCRIPT IS FOR THE Deactivate and Activate ITEM OF THE FEATURE --------------------------->

<!--Function to call deactivate item modal-->
<script type="text/javascript">
  function deactivateItem(id) {
    //console.log('aaaaaaaaaa' + id);
    document.getElementById('deactivate_characteristic_item_id').value = id;
    $('#deactivate_item_message').text("")
    $('#deactivateItemModal').modal('show');

  }
</script>


<!-- AJAX to deactivate characteristic item -->
<script type="text/javascript">
  $(document).ready(function () {
    var pag = "<?=$pag?>";
    $('#btn-deactivate-item').click(function (event) {

      event.preventDefault();

      $.ajax({
        url: pag + "/deactivate-item.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function (message) {

          if (message.trim() === 'Deactivated Successfully!') {

            $('#btn-cancel-deactivated-item').click();
            $('#deactivate_item_message').text(message)

            $('#btn-item-list').click();
          }

          $('#deactivate_item_message').text(message)



        },

      })
    })
  })
</script>

<!--Function to call activate item modal-->
<script type="text/javascript">
  function activateItem(id) {

    document.getElementById('activate_characteristic_item_id').value = id;
    $('#activate_item_message').text("") // o text('') passado vazio serve para ativar
    $('#activateItemModal').modal('show');

  }
</script>

<!-- AJAX to activate characteristic item -->
<script type="text/javascript">
  $(document).ready(function () {
    var pag = "<?=$pag?>";
    $('#btn-activate-item').click(function (event) {

      event.preventDefault();

      $.ajax({
        url: pag + "/activate-item.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function (mensagem) {

          if (mensagem.trim() === 'Activated Successfully!') {

            $('#btn-cancelar-item-ativo').click();
            $('#activate_item_message').text(mensagem)

            $('#btn-item-list').click();
          }

          $('#activate_item_message').text(mensagem)



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

    });
</script>