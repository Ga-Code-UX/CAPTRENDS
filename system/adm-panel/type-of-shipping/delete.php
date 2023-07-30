<?php
require_once('../../../Connection.php');

$delete_id = $_POST['id'];

$pdo->query("DELETE FROM type_of_shipping  WHERE id = '$delete_id'");

echo 'Deleted Successfully!';

?>