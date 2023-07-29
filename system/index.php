
<?php

require_once("../Connection.php");

$result = $pdo->query("SELECT * FROM users");

$data = $result->fetchALL(PDO::FETCH_ASSOC);

$password_criptography = md5('1234');


if(@count($data) == 0){
  $result = $pdo->query("INSERT into users (name, cpf,email,password,level, image) values ('Geisa','000.000.000-00', 'geisamaral24@gmail.com','$password_criptography','Aministrator', 'sem-foto.jpg')");
}

?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!------ Include the above in your HEAD tag ---------->

    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
   
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  
    <link href="../css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
 
    
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
   
        <!--================login_part Area =================-->
        <section class="login_part section_padding ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-5">
                        <div class="login_part_text text-center">
                        <form id="create-account" method="post">
                            <div class="login_part_text_iner">
                                <h2>Novo no nosso site?</h2>
                                <p>Tire partido de todas as vantagens do nosso site. <br>Começe por:</p>
                            
                                    <a href="create-account.php"   >
                                        <p class="btn_4">Criar uma conta</p>
                                    </a>
                              
                                
                            </div>
                        </form>
                        </div>
                       
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3> Inicie a sua sessão</h3>
                                <form class="row contact_form" action="authentication.php" method="post" name="login">
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="email-login" name="email-login" placeholder="Email">
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password-login" name="password-login" placeholder="Palavra-passe">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">Iniciar sessão</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================login_part end =================-->
    </main>
    

</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.nice-select.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/jquery.slicknav.js"></script>
<script src="../js/mixitup.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="../js/mascara.js"></script>
</html>