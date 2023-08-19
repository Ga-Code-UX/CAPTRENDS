<?php

require_once("../../../Connection.php"); 

$product_id = @$_POST['txtid-feature']; 

$pag = "products";

$query = $pdo->query("SELECT * FROM feature_product where product_id = '" .$product_id. "' ");
echo "<div class='ml-2'>";
 $result = $query->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($result); $i++) { 
                      foreach ($result[$i] as $key => $value) {
                      }

                      $feature_id = $result[$i]['feature_id'];
       				//recuperar o nome da carac
                      $query2 = $pdo->query("SELECT * from characteristic where id = '$feature_id' ");
                      $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                      $characteristic_name = @$result2[0]['name'];
                  
      echo "<span class='mb-2'><small><small><small><i class='text-info fas fa-circle mr-1'></i></small></small></small><a title='Add Item' class='text-info' href='#' onClick='addItem(".$result[$i]['id'].")'> ".$characteristic_name."</a> <a title='Delete Characteristic' href='#' onClick='deleteCharacteristic(".$result[$i]['id'].")'><small><small><i class='text-danger fas fa-times ml-1'></i></small></small></a></span><br>";

    }
    echo "</div>";
?>
