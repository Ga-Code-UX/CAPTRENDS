<?php
require_once('../../../Connection.php');

$product_name = $_POST['product-name'];
$category_id = $_POST['category'];
$subcategory_id = @$_POST['subcategory'];
$description = $_POST['description'];
$long_description = $_POST['long-description'];
$value = $_POST['value'];
$stock = $_POST['stock'];
$shipping_type = $_POST['shipping-type'];
$active= $_POST['active'];
$keywords= $_POST['keywords'];
$weight= $_POST['weight'];
$width = $_POST['width'];
$height = $_POST['height'];
$length = $_POST['length'];
$brand = $_POST['brand'];
$shipping_cost = $_POST['shipping-cost'];


$value = str_replace(',','.',$value);
$shipping_type = str_replace(',','.',$shipping_type);
$weight = str_replace(',','.',$weight);
$width = str_replace(',','.',$width);
$height= str_replace(',','.',$height);
$length= str_replace(',','.',$length);


//echo $value;
$new_name = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($product_name)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$url_name =preg_replace('/[ -]+/' , '-' , $new_name);

$old =$_POST['antigo'];

$id = $_POST['txtid2'];

if($product_name == ""){
    echo 'Please fill in the name field.';
    exit();
}
if($value == ""){
    echo 'Please fill in the value field.';
    exit();
}

if($product_name != $old){
   
    // Check the record of the email in the database.
    $result = $pdo->query("SELECT * FROM products where name = '$product_name'");
   // Retrieve all data from the database.
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    if(@count($data) > 0){
        echo 'The product is already registered in the database.';
        exit();
    }
}

$res = $pdo->query("SELECT * FROM type_of_shipping where id = '$shipping_type'"); 
$data = $res->fetchAll(PDO::FETCH_ASSOC);
$shipping_name = $data[0]['name'];
$shipping_name= strtoupper($shipping_name);
if($shipping_name == 'CORREIOS'){
	if($weight == 0){
		echo 'The weight must be greater than zero for Correios (Brazilian postal service) shipping!';
		exit();
	}
}

// SCRIPT FOR UPLOADING PHOTO TO THE DATABASE
$image_name = $_FILES['image']['name'];
$image_name = preg_replace('/[ -]+/', '-', $image_name);
$path ='../../../images/products/'.$image_name;
//$target='C:/xampp/htdocs/Loja-Virtual-One/images/'.basename($_FILES['image']['name']);


if (@$_FILES['image']['name'] == "") {
  $image = "sem-foto.jpg";
} else {
  $image = $image_name;
}

$image_temp = @$_FILES['image']['tmp_name'];

$extension = pathinfo($image, PATHINFO_EXTENSION);

    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif') {
        
        move_uploaded_file($image_temp, $path);
    } else {
    echo 'Image extension not allowed!';
    exit();
    }

////////////////



if ($id == "" || $id == NULL) {
    $result = $pdo->prepare("INSERT INTO products (category, subcategory, name, url_name, description, long_description, value, image, stock, shipping_type, keywords, active, weight, width, height, length, brand, shipping_cost) VALUES (:category, :subcategory, :name, :url_name, :description, :long_description, :value, :image, :stock, :shipping_type, :keywords, :active, :weight, :width, :height, :length, :brand, :shipping_cost)");
    $result->bindValue(":image", $image);
} else {
    if ($image == "sem-foto.jpg") {
        $result = $pdo->prepare("UPDATE products SET category = :category, subcategory = :subcategory, name = :name, url_name= :url_name, description = :description, long_description = :long_description, value = :value, stock = :stock, shipping_type = :shipping_type, keywords = :keywords, active = :active, weight = :weight, width = :width, height = :height, length = :length, brand = :brand, shipping_cost = :shipping_cost WHERE id = :id");
    } else {
        $result = $pdo->prepare("UPDATE products SET category = :category, subcategory = :subcategory, name = :name, url_name = :url_name,description = :description,long_description= :long_description,value = :value,stock = :stock,shipping_type = :shipping_type,keywords = :keywords,active = :active,weight = :weight, width = :width, height = :height, length = :length, brand = :brand, shipping_cost = :shipping_cost, image = :image WHERE id = :id");
        $result->bindValue(":image", $image);
    }

    $result->bindValue(":id", $id);
}



    $result->bindValue(":name",$product_name);
    $result->bindValue(":url_name", $url_name);
    $result->bindValue(":category", $category_id);
    $result->bindValue(":subcategory", $subcategory_id);
    $result->bindValue(":description", $description);
    $result->bindValue(":long_description", $long_description);
    $result->bindValue(":value", $value);
    $result->bindValue(":stock", $stock);
    $result->bindValue(":shipping_type", $shipping_type);
    $result->bindValue(":keywords", $keywords);
    $result->bindValue(":active", $active);
    $result->bindValue(":weight", $weight);
    $result->bindValue(":width", $width);
    $result->bindValue(":height", $height);
    $result->bindValue(":length", $length);
    $result->bindValue(":brand", $brand);
    $result->bindValue(":shipping_cost", $shipping_cost);

   
    $result->execute();
    

echo 'Saved successfully!';

?>