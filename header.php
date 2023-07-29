<?php
require_once("Connection.php");
@session_start();

?>

<!DOCTYPE html>

<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!--bootraps 5-->
       
        <!---css-->
        <link rel="stylesheet"  href="css/style.css" >
        <link rel="stylesheet"  href="css/checkout.css" >

          <!-- Css Styles -->
      <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
      <!-- Css Styles -->
  
     
        <!--icons-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light ">
          <div class="container-fluid">
              <a class="navbar-brand text-uppercase" href="#">
                <img src="images/Logo-cap.png" width="50"height="50" alt="">
                CapTrends</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"  aria-expanded="false" >
                <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="store.php">Loja</a>
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
                      <?php
                        if(@$_SESSION['id_user'] == NULL  or @$_SESSION['level_user'] != 'Client'){
                      ?>
                        <a class="nav-link" href="system"><i class='bx bx-user'></i> Login </a>
                      <?php } else{?>
                        <a class="nav-link" href="system/client-panel"><i class='bx bx-user'></i> Panel</a>
                     <?php }?>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></i></a>
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