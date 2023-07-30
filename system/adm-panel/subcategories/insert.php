<?php
require_once('../../../Connection.php');

$subcategory_name = $_POST['subcategory-name'];
$category_id = $_POST['category'];

$new_name = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($subcategory_name)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );

$url_name =preg_replace('/[ -]+/' , '-' , $new_name);

$old =$_POST['old'];
$id = $_POST['txtid2'];

if($subcategory_name == ""){
    echo 'Fill in the category name field';
    exit();
}


if($subcategory_name!= $old){
    
    $result = $pdo->query("SELECT * FROM subcategories where name = '$subcategory_name'");
  
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

   //  if the variable $data does not find any record in 
    //  the database of the email typed by the user,
    //  he inserts it otherwise it does nothing
    if(@count($data) > 0){
        echo 'Subcategory is already registered in the database';
        exit();
    }
}



//SCRIPT TO UPLOAD PHOTO IN THE DATABASE
$image_name = $_FILES['image']['name'];
$image_name = preg_replace('/[ -]+/', '-', $image_name);
$path ='../../../images/subcategories/'.$image_name;
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


if($id == "" or $id == NULL){
    $result = $pdo->prepare("INSERT INTO subcategories (name, name_url, image ,id_category) VALUES (:name, :name_url, :image,:id_category)");
    $result->bindValue(":image", $image);
}else{
    
    if($image == "sem-foto.jpg"){
        $result = $pdo->prepare("UPDATE subcategories SET name = :name, name_url = :name_url, id_category = :id_category WHERE id = :id");
    }else{
        $result = $pdo->prepare("UPDATE subcategories SET name = :name, name_url = :name_url, image = :image, id_category = :id_category WHERE id = :id");
        $result->bindValue(":image", $image);
    }
    
        $result->bindValue(":id", $id);
}


    $result->bindValue(":name",$subcategory_name);
    $result->bindValue(":name_url", $url_name);
    $result->bindValue(":id_category", $category_id);
   
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