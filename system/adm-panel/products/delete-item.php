<?php

require_once("../../../Connection.php"); 

$id = $_POST['id_item_characteristic'];

$pdo->query("DELETE from characteristic_items WHERE id = '$id'");

echo 'Successfully deleted!';

?>