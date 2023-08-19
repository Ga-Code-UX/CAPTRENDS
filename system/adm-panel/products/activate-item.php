<?php

require_once("../../../Connection.php"); 

$id = $_POST['activate_characteristic_item_id'];

$pdo->query("UPDATE characteristic_items set active = 'Yes' WHERE id = '$id'");

echo 'Activated Successfully!';

?>