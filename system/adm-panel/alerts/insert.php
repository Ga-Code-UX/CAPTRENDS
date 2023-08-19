<?php

require_once("../../../Connection.php"); 

$alert_title = $_POST['alert-title'];
$message_title= $_POST['message-title'];
$message = $_POST['message'];
$date = $_POST['date'];
$link = $_POST['link'];


$id = $_POST['txtid2'];




//SCRIPT PARA SUBIR FOTO NO BANCO
$image_name = $_FILES['image']['name'];
$image_name = preg_replace('/[ -]+/', '-', $image_name);
$path ='../../../images/alerts/'.$image_name;
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



if($id == ""){
	$res = $pdo->prepare("INSERT INTO alerts (	alert_title,message_title,message, link,alert_date, image, active) VALUES (:alert_title,:message_title,:message, :link,:alert_date, :image, :active)");
	$res->bindValue(":image", $image);
	$res->bindValue(":active", 'No');
}else{

	if($image == "sem-foto.jpg"){
		$res = $pdo->prepare("UPDATE alerts SET alert_title = :alert_title, message_title = :message_title, message = :message, link = :link, alert_date = :alert_date WHERE id = :id");
	}else{
		$res = $pdo->prepare("UPDATE alerts SET alert_title = :alert_title, message_title = :message_title, message = :message, link = :link, alert_date = :alert_date, image = :image WHERE id = :id");
		$res->bindValue(":image", $image);
	}

	$res->bindValue(":id", $id);
}

	$res->bindValue(":alert_title", $alert_title);
	$res->bindValue(":message_title", $message_title);
	$res->bindValue(":message", $message);
	$res->bindValue(":link", $link);
	$res->bindValue(":alert_date", $date);
	
	
	
	

	$res->execute();


echo 'Saved successfully!';

?>