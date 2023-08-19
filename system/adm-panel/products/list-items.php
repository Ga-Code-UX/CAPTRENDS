<?php

require_once("../../../Connection.php"); 

$product_characteristic_id = @$_POST['id_characteristic_item_2']; 

$pag = "products";

$query = $pdo->query("SELECT * FROM characteristic_items where product_characteristic_id = '" .$product_characteristic_id. "' ");
echo "<div class='ml-2'>";
 $result = $query->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($result); $i++) { 
                      foreach ($result[$i] as $key => $value) {
                      }

                      $active = $result[$i]['active'];     
                  
                      echo "<span class='mb-2'><i class='text-secondary fas fa-check mr-1'></i><big><big> ".$result[$i]['name']."</big></big> <a title='Delete Item' href='#' onClick='deleteItem(". $result[$i]['id'] .")'><i class='text-danger fas fa-times ml-1'></i></a>";
                
                
                      if($active != 'No'){
                        echo "<a title='Deactivate Item' href='#' onClick='deactivateItem(". $result[$i]['id'] .")'><i class='text-secondary far fa-bell-slash ml-2'></i> Deactivate</a>";
                      }else{
                        echo "<a title='Activate Item' href='#' onClick='activateItem(". $result[$i]['id'] .")'><i class='text-success far fa-check-circle ml-2'></i> Activate </a>";
                      }
                      
                
                     echo " </span><br>";
                

    }
    echo "</div>";
?>
