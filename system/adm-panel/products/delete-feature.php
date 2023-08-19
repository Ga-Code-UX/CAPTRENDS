<?php

require_once("../../../Connection.php"); 

$id = $_POST['product-feature-id'];

$pdo->query("DELETE from feature_product WHERE id = '$id'");

echo 'Deleted Successfully!';

?>