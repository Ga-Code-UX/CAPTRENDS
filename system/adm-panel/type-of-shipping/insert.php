<?php
require_once('../../../Connection.php');

$type_of_shipping_name = $_POST['type_of_shipping_name'];



$old =$_POST['old'];
$id = $_POST['txtid2'];

if($type_of_shipping_name == ""){
    echo 'Fill in the Type of shipping name field';
    exit();
}


if($type_of_shipping_name != $old){
    
    $result = $pdo->query("SELECT * FROM type_of_shipping where name = '$type_of_shipping_name'");
  
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

   //  if the variable $data does not find any record in 
    //  the database of the email typed by the user,
    //  he inserts it otherwise it does nothing
    if(@count($data) > 0){
        echo 'Type of shipping is already registered in the database';
        exit();
    }
}



if($id == "" or $id == NULL){
    $result = $pdo->prepare("INSERT INTO type_of_shipping (name) VALUES (:name)");
 
}else{
    
    $result = $pdo->prepare("UPDATE type_of_shipping  SET nome = :nome WHERE id = :id");
    $result->bindValue(":id", $id);
}
    $result->bindValue(":name",$type_of_shipping_name);
    try {
        // Your database operations here
        // ...
        
        $result->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
 
    //var_dump($result->errorInfo());

echo 'Saved successfully!';

?>