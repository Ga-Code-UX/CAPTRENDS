<?php
require_once('../../../Connection.php');

$delete_id = $_POST['id'];

//BUSCAR A IMAGEM PARA EXCLUIR DA PASTA
$query_con = $pdo->query("SELECT * FROM products WHERE id = '$delete_id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$image = $res_con[0]['image'];
if($image != 'sem-foto.jpg'){
	@unlink('../../../images/products/'.$image);
}

$pdo->query("DELETE FROM products  WHERE id = '$delete_id'");

echo 'Deleted Successfully!';

?>