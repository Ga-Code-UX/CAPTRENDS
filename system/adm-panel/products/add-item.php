<?php

require_once("../../../Connection.php"); 

$item_name = $_POST['item-name'];
$item_value= $_POST['item-value'];
$item_addition= $_POST['item-addition'];
$product_characteristic_id = $_POST['id_characteristic_item'];

if($item_name == ""){
	echo 'Enter a description for the item!';
	exit();
}

if($item_addition == ""){
	$item_addition = 0;
}


	$res = $pdo->query("SELECT * FROM characteristic_items where name = '$item_name' and product_characteristic_id = '$product_characteristic_id' "); 
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	if(@count($dados) > 0){
			echo 'Item for this characteristic already registered!';
			exit();
		}





$pdo->query("INSERT INTO characteristic_items (product_characteristic_id, name, item_value, active,value) VALUES ('$product_characteristic_id', '$item_name', '$item_value','Yes','$item_addition')");


echo 'Saved Successfully!';

?>