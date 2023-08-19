<?php
require_once('../../../Connection.php');

$category = @$_POST['txtCat'];

echo "<select class='sm-width form-control form-control-sm' name='subcategory' id='subcategory'>";


$result = $pdo->query("SELECT * FROM subcategories where id_category = '$category' order by name asc");
          $data = $result->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($data); $i++) { 
            foreach ($data[$i] as $key => $value) {
            }
            
           echo "<option value='" . $data[$i]['id'] . "'>" . $data[$i]['name'] . "</option>";

       }

       echo "</select>";


?>