<?php

require_once("../../../Connection.php"); 

$product_id = $_POST['id'];


// SCRIPT FOR UPLOADING PHOTO TO THE DATABASE
$path = '../../../images/products/details/' .@$_FILES['productImage']['name'];
if (@$_FILES['productImage']['name'] == ""){
  $image = "sem-foto.jpg";
}else{
  $image = @$_FILES['productImage']['name']; 
}

$image_temp = @$_FILES['productImage']['tmp_name']; 

$ext = pathinfo($image, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($image_temp, $path);
}else{
	echo 'Image extension not allowed!';
	exit();
}



	$pdo->query("INSERT INTO images (product_id,  image) VALUES ( '$product_id', '$image')");

	echo 'Saved successfully!';

?>