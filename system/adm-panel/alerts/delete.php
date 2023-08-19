<?php
require_once('../../../Connection.php');

$delete_id = $_POST['id'];

$pdo->query("DELETE FROM alerts WHERE id = '$delete_id'");

echo 'Deleted successfully!';

?>