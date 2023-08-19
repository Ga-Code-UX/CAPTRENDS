<?php
require_once('../../../Connection.php');

$delete_id = $_POST['photo_id'];

$pdo->query("DELETE FROM images WHERE id = '$delete_id'");

echo 'Deleted Successfully!';

?>