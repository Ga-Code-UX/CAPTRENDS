<?php
require_once('../../../Connection.php');

$characteristic_name = $_POST['characteristic-name'];




$old =$_POST['old'];
$id = $_POST['txtid2'];

if($characteristic_name == ""){
    echo 'Fill in the characteristic name field';
    exit();
}


if($characteristic_name!= $old){
    
    $result = $pdo->query("SELECT * FROM characteristic where name = '$characteristic_name'");
  
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

   //  if the variable $data does not find any record in 
    //  the database of the email typed by the user,
    //  he inserts it otherwise it does nothing
    if(@count($data) > 0){
        echo 'Characteristic is already registered in the database';
        exit();
    }
}






if($id == "" or $id == NULL){
    $result = $pdo->prepare("INSERT INTO characteristic (name) VALUES (:name)");
   
}else{
    
    $result = $pdo->prepare("UPDATE characteristic SET name = :name WHERE id = :id");
    $result->bindValue(":id", $id);
}

$result->bindValue(":name",$characteristic_name);
   
    try {
      
        $result->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
 
    //var_dump($result->errorInfo());

echo 'Saved successfully!';

?>