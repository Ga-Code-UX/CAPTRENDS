<?php

require_once("../../../Connection.php"); 

$product_feature = $_POST['product-feature'];

$id = $_POST['txtid-feature'];

if($product_feature  == ""){
	echo 'Choose a Feature!';
	exit();
}



	$result = $pdo->query("SELECT * FROM feature_product where feature_id = '$product_feature' and product_id = '$id' "); 
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	if(@count($data) > 0){
			echo 'Feature already registered!';
			exit();
		}





$pdo->query("INSERT INTO feature_product (feature_id, product_id) VALUES ('$product_feature', '$id')");


echo 'Saved successfully!';

?>