<?php
require_once("../Connection.php");


$name_register_client = $_POST['name'];
$cpf_register_client = $_POST['cpf'];
$email_register_client = $_POST['email-client'];
$password_register_client = md5($_POST['password']);
$confirm_password_register_client = $_POST['confirm-password'];


if($name_register_client == ""){
    echo 'Preencha o Campo Nome';
    exit();
}

if($cpf_register_client  == ""){
    echo 'Preencha o Campo CPF';
    exit();
}

if($email_register_client  == ""){
    echo 'Preencha o Campo Email';
    exit();
}
if($password_register_client  == ""){
    echo 'Preencha o Campo Password';
    exit();
}
if($confirm_password_register_client  == ""){
    echo 'Preencha o Campo Confirm Password';
    exit();
}

$result = $pdo->query("SELECT *FROM users where CPF = '$_POST[cpf]'");

$data = $result->fetchAll(PDO::FETCH_ASSOC);


if(@count($data) == 0){
    $result = $pdo->prepare("INSERT users (name,cpf,email,password,level) values (:name,:cpf,:email,:password,:level)");
    
    $result->bindValue(":name", $name_register_client);
    $result->bindValue(":cpf", $cpf_register_client);
    $result->bindValue(":email", $email_register_client);
    $result->bindValue(":password", $password_register_client);
    $result->bindValue(":level",'Client');


    $result->execute();

    echo 'Successfully Registered!';

}
else{

    echo 'CPF is already Registered!';
}


?>