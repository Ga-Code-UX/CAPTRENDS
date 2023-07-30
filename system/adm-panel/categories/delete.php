<?php
require_once('../../../Connection.php');

$delete_id = $_POST['id'];

// SEARCH THE IMAGE TO DELETE FROM THE FOLDER
$query_delete_image = $pdo->query("SELECT * FROM categories WHERE id = '$delete_id'");
$result_delete_image = $query_delete_image->fetchAll(PDO::FETCH_ASSOC);
$image = $result_delete_image[0]['image'];
if($image != 'sem-foto.jpg'){
	@unlink('../../../images/categories/'.$image);
}

$pdo->query("DELETE FROM categories  WHERE id = '$delete_id'");

echo 'Successfully deleted!';

?>