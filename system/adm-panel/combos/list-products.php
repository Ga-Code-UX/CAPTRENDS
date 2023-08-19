<?php

require_once("../../../Connection.php"); 

$combo_id = @$_POST['txtid']; 

$pag = "combos";
$query = $pdo->query("SELECT * FROM products_combo where combo_id = '" .$combo_id. "' ");

 $result = $query->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($result); $i++) { 
                      foreach ($result[$i] as $key => $value) {
                      }

                      $product_id = $result[$i]['product_id'];
       				
                      $query2 = $pdo->query("SELECT * from products where id = '$product_id' ");
                      $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                      $product_name = @$result2[0]['name'];
                  
      echo "<center><span class='text-dark mr-1'><small>".@$product_name."</small></span><a href='#' onClick='deleteProduct(". @$result[$i]['id'] .")' title='Delete Product'><small><i class='text-danger far fa-trash-alt'></i></small></a></center>
                   <hr/>";

    }
    
?>
