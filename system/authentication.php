<?php

/*require_once("../Connection.php");

@session_start();

$email_client = $_POST['email-login'];
$password_client = md5($_POST['password-login']);

//this files is about login authentication

$result = $pdo->query("SELECT * FROM users where email ='$email_client' and password = '$password_client'");

$data = $result->fetchAll(PDO::FETCH_ASSOC);

if(@count($data) > 0){
    $_SESSION['id_user'] = $data[0]['id'];
    $_SESSION['name_user'] = $data[0]['name'];
    $_SESSION['cpf_user'] = $data[0]['cpf'];
    $_SESSION['level_user'] = $data[0]['level'];
    $_SESSION['image_user'] = $data[0]['image'];
    
    if($_SESSION['level_user'] == 'Administrator'){
        echo "<script language ='Javascript'>window.location = 'adm-panel'</script>";
    }

    if($_SESSION['level_user'] == 'Client'){
        echo "<script language ='Javascript'>window.location = 'client-panel'</script>";
    }   

}
else{
    echo "<script language='javascript'>window.alert('Data Wrong')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
}*/



require_once("../Connection.php");

@session_start();

$email_client = $_POST['email-login'];
$password_client = md5($_POST['password-login']);

// this file is about login authentication

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$stmt->bindParam(':email', $email_client);
$stmt->bindParam(':password', $password_client);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($data) > 0){
    $_SESSION['id_user'] = $data[0]['id'];
    $_SESSION['name_user'] = $data[0]['name'];
    $_SESSION['cpf_user'] = $data[0]['cpf'];
    $_SESSION['level_user'] = $data[0]['level'];
    $_SESSION['image_user'] = $data[0]['image'];
    
    if($_SESSION['level_user'] == 'Administrator'){
        header('Location: adm-panel');
        exit();
    }

    if($_SESSION['level_user'] == 'Client'){
        header('Location: client-panel');
        exit();
    }   
}
else{
    echo "<script language='javascript'>window.alert('Data Wrong')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
}







?>