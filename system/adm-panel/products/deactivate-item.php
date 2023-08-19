<?php

require_once("../../../Connection.php"); 

$id = $_POST['deactivate_characteristic_item_id'];

$pdo->query("UPDATE characteristic_items set active = 'No' WHERE id = '$id'");

echo 'Deactivated Successfully!';

?>