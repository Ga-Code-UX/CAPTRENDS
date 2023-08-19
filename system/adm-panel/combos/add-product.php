<?php

require_once("../../../Connection.php"); 

$product_id= $_POST['txtidProduct'];

$combo_id = $_POST['txtid'];




	$result = $pdo->query("SELECT * FROM products_combo where product_id = '$product_id' and combo_id = '$combo_id' "); 
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	if(@count($data) > 0){
			echo 'Product already added!';
			exit();
		}





$pdo->query("INSERT INTO products_combo  (product_id, combo_id) VALUES ('$product_id', '$combo_id')");


echo 'Saved successfully!';

?>