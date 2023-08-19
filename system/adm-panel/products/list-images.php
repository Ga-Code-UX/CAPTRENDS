<?php

require_once("../../../Connection.php"); 



$id = @$_POST['id']; 
$pag = "products";

$query = $pdo->query("SELECT * FROM images where product_id = '" .$id. "' ");
echo "<div class='row'>";
 $result1 = $query->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($result1); $i++) { 
                      foreach ($result1[$i] as $key => $value) {
                      }
                  
      echo "<img class='ml-4 mb-2' src='../../images/products/details/".$result1[$i]['image']. "' width='70'><a href='#' onClick='deleteImage(".$result1[$i]['id'].")'><i class='text-danger fas fa-times ml-1'></i></a>";

    }
    echo "</div>";
?>
