<?php

require_once('../../../Connection.php');

$category_name = $_POST['category-name'];

$new_name = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($category_name)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$url_name =preg_replace('/[ -]+/' , '-' , $new_name);

$old =$_POST['old'];
$id = $_POST['txtid2'];


if($category_name == ""){
    echo 'Fill in the category name field';
    exit();
}


if($category_name != $old){
    $result = $pdo->query("SELECT * FROM categories where name = '$category_name'");
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    //  if the variable $data does not find any record in 
    //  the database of the email typed by the user,
    //  he inserts it otherwise it does nothing
    if(@count($data) > 0){
        echo 'Category is already registered in the database';
        exit();
    }
}


$image_name = $_FILES['image']['name'];
$image_name = preg_replace('/[ -]+/', '-', $image_name);
$path ='../../../images/categories/'.$image_name;
//$target='C:/xampp/htdocs/Loja-Virtual-One/images/'.basename($_FILES['image']['name']);


if (@$_FILES['image']['name'] == "") {
  $image = "sem-foto.jpg";
} else {
  $image = $image_name;
}

$image_temp = @$_FILES['image']['tmp_name'];

$extension = pathinfo($image, PATHINFO_EXTENSION);

    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif') {
        
        move_uploaded_file($image_temp, $path);
    } else {
    echo 'Image extension not allowed!';
    exit();
    }


if($id == "" || $id == NULL){
 
        $result = $pdo->prepare("INSERT INTO categories (name, name_url, image) VALUES (:name, :name_url, :image)");
        $result->bindValue(":image", $image);
}else{
    
        if($image == "sem-foto.jpg"){
            $result = $pdo->prepare("UPDATE categories SET name = :name, name_url = :name_url WHERE id = :id");
        }else{
            $result = $pdo->prepare("UPDATE categories SET name = :name, name_url = :name_url, image = :image WHERE id = :id");
            $result->bindValue(":image", $image);
        }
    
        $result->bindValue(":id",$id);
}


    $result->bindValue(":name", $category_name);
    $result->bindValue(":name_url", $url_name);
    $result->execute();
    
echo 'Saved successfully!';


?>