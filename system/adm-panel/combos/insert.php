<?php

require_once("../../../Connection.php"); 

$name = $_POST['product-name'];
$description = $_POST['description'];
$long_description = $_POST['long-description'];
$value = $_POST['value'];
$shipping_type = $_POST['shipping-type'];
$active = $_POST['active'];
$keywords = $_POST['keywords'];
$weight = $_POST['weight'];
$width = $_POST['width'];
$height= $_POST['height'];
$length = $_POST['length'];
$shipping_value = $_POST['shipping-value'];

$value = str_replace(',', '.', $value);
$shipping_value = str_replace(',', '.', $shipping_value);
$weight = str_replace(',', '.', $weight);
$width = str_replace(',', '.', $width);
$height = str_replace(',', '.', $height);
$length = str_replace(',', '.', $length);

$new_name = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($name)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
$url_name= preg_replace('/[ -]+/' , '-' , $new_name);

$old = $_POST['old'];
$id = $_POST['txtid2'];

if($name == ""){
	echo 'Fill the name field';
	exit();
}

if($value == ""){
	echo 'Fill the value field';
	exit();
}


$path = '../../../images/combos/' .@$_FILES['image']['name'];
if (@$_FILES['image']['name'] == ""){
  $image = "sem-foto.jpg";
}else{
  $image = @$_FILES['image']['name']; 
}

$image_temp = @$_FILES['image']['tmp_name']; 

$ext = pathinfo($image, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($image_temp, $path);
}else{
	echo 'Image extension not allowed!';
	exit();
}


if($id == "" || $id == NULL){
	$result = $pdo->prepare("INSERT INTO combos (name,url_name , description, long_description, value, image, shipping_type, keywords, active,  weight, width, height, length, shipping_value) VALUES (:name, :url_name , :description, :long_description, :value, :image, :shipping_type, :keywords, :active, :weight, :width, :height, :length, :shipping_value)");
	$result->bindValue(":image", $image);
}else{

	if($imagem == "sem-foto.jpg"){
		$result= $pdo->prepare("UPDATE combos SET name = :name, url_name = :url_name, description = :description , long_description  = :long_description, value = :value,  shipping_type = :shipping_type, keywords = :keywords, active = :active, weight = :weight, width = :width, height = :height, length = :length, shipping_value = :shipping_value,  WHERE id = :id");
	}else{
		$result = $pdo->prepare("UPDATE combos SET name = :name, url_name= :url_name, description = :description , long_description  = :long_description, value = :value,  shipping_type = :shipping_type, keywords = :keywords, active = :active, weight = :weight, width = :width, height = :height, length = :length, shipping_value = :shipping_value, image = :image,  WHERE id = :id");
		$result->bindValue(":image", $image);
	}

	$result->bindValue(":id", $id);
}

	$result->bindValue(":name", $name);
	$result->bindValue(":url_name", $url_name);
	
	$result->bindValue(":description", $description);
	$result->bindValue(":long_description", $long_description);
	$result->bindValue(":value", $value);
	$result->bindValue(":shipping_type", $shipping_type);
	$result->bindValue(":keywords", $keywords);
	$result->bindValue(":active", $active);
	$result->bindValue(":weight", $weight);
	$result->bindValue(":width", $width);
	$result->bindValue(":height", $height);
	$result->bindValue(":length", $length);
	$result->bindValue(":shipping_value", $shipping_value);
	
	$result->execute();


echo 'Saved successfully!';

?>