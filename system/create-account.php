<?php

require_once("../Connection.php");

?>


<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
   
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  
    <link href="../css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 
    
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light ">
          <div class="container-fluid">
              <a class="navbar-brand text-uppercase" href="#">CapTrends</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"  aria-expanded="false" >
                <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Loja</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Quem Somos
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Quem Somos</a></li>
                        <li><a class="dropdown-item" href="#">Contatos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Blog</a></li>
                      </ul>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php"><i class='bx bx-user'></i> Login </a>
                    </li>
                  
                </ul>
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
          </div>
        </nav>
    </header>
    <main>
    
        <section class="registration section_padding ">
            <div class="container">                
                <div class="col-lg-12 col-md-12">
                    <h3 class="text-center">Introduza os dados para criar sua conta</h3>
                    
                    <form id="form-register" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 form-group p_star">
                                <label for="exampleInputEmail1">Nome Completo</label>
                                <input type="text" value="" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="text" value="" class="form-control" id="email-client" name="email-client" placeholder="Email">
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="exampleInputEmail1">CPF:</label>
                                <input type="text" value="" class="form-control" id="cpf" name="cpf" placeholder="Enter your CPF">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group p_star">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            
                            <div class="col-md-4 form-group p_star">
                                <label for="exampleInputEmail1">Password confirmation:</label>
                               
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Password Confirmation">
                            </div>
                        </div>
                        <small><div id="div-message-register"></div></small>
                        <div class="row">
                        <div class="col-md-4 form-group"></div>
                            <div class="col-md-6 form-group">
                                <button type="button" id="btn-register" class="btn_3">Criar conta</button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
                
            </div>
        </section>
    </main>

    
<script type="text/javascript">
    $('#btn-register').click(function(event){
              
        $.ajax({
            url:"register.php",
            method:"post",
            data: $('#form-register').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Successfully Registered!'){
                    
                    $('#div-message-register').addClass('text-success')
                    $('#div-message-register').text(msg);
                   
                    }
                 else{
                    $('#div-message-register').addClass('text-danger')
                    $('#div-message-register').text(msg);
                   
                 }
            }
        })
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="../js/mascara.js"></script>

