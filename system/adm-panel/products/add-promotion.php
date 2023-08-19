<?php

require_once("../../../Connection.php"); 


$discount = $_POST['promotion-value'];
$start_date= $_POST['promotion-start-date'];
$end_date = $_POST['promotion-end-date'];
$active = $_POST['promotion-active'];

if($discount == ""){
	echo 'Please insert a value!';
	exit();
}

$product_id = $_POST['promotion_id'];


$result = $pdo->query("SELECT * FROM products where id = '$product_id' "); 
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$value = $data[0]['value'];
$value = $value - ($value * ($discount / 100));


$res = $pdo->query("SELECT * FROM promotions where product_id = '$product_id' "); 
	$data = $res->fetchAll(PDO::FETCH_ASSOC);


	if(@count($data) == 0){
			$pdo->query("INSERT INTO promotions (product_id, value,start_date, end_date, active, discount) VALUES ('$product_id', '$value', '$start_date', '$end_date', '$active', '$discount')");
			}
	else{
			$pdo->query("UPDATE promotions SET product_id = '$product_id', value = '$value', start_date = '$start_date', end_date = '$end_date', active = '$active', discount = '$discount' where product_id = '$product_id'");
		}


echo 'Saved Successfully!';

?>