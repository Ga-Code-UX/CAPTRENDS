<?php
require_once("header.php");
require_once("Connection.php");
@session_start();
?>
    <section id="banner">
      <div class="container-fluid">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="Images/banner11.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>NOVOS ESTILOS, NOVAS FUNCIONALIDADE</h5>
                      <p class="p">Encontre isso com os nossos bonés"</p>
                      <a href=" ">
                        <button type="button" class="button">Comprar</button>
                      </a>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="Images/banner12.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>PROTEÇÃO</h5>
                      <p class="p">Proteja-se do sol com estilo com nossos bonés de alta qualidade</p>
                      <a href=" ">
                        <button type="button" >Comprar</button>
                      </a>
                  </div>
                </div>
                <div class="carousel-item">
                  <img src="Images/banner10.jpg" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                      <h5>NOVOS VISUAIS</h5>
                      <p class="p">Toque seu visual com nossos bonés da moda</p>
                      <a href=" ">
                        <button type="button" >Comprar</button>
                      </a>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
        </div>
    </section>

    <section id="produtos">
        <div class="container-fluid">
            <div class="row">
                <h1>COLEÇÃO DE EDIÇÃO LIMITADA</h1>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-1-1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>  
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-4.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-5.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="images/products/bone-1-1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title text-center">Card title</h5>
                              <p class="card-text text-center">R$ 25,00</p>
                              
                            </div>
                        </div>
                    </div>
          
            </div>
            <div class="col-lg-12 ">
                  
                      <a href=" ">
                        <button type="button" >Ver Tudo</button>
                      </a>
                  
            </div>

        </div>

    </section>
    
    <section class="instagram-section">
            <h2 class="instagram-title">#Instagram</h2>
           
              <div class="instagram-container">
                <div class="instagram-item">
                  <img class="instagram-image" src="images/bone2.jpg" alt="Image 1">
                  <div class="instagram-text-overlay">
                    <div class="instagram-text">"#Toda imagem conta uma história."</div>
                  </div>
                </div>

                <div class="instagram-item">
                  <img class="instagram-image" src="images/bone1.jpg" alt="Image 2">
                  <div class="instagram-text-overlay">
                    <div class="instagram-text">"#Capturar momentos que duram uma vida."</div>
                  </div>
                </div>

                <div class="instagram-item">
                  <img class="instagram-image" src="images/bone3.jpg" alt="Image 3">
                  <div class="instagram-text-overlay">
                    <div class="instagram-text">"#Abrace a beleza ao seu redor."</div>
                  </div>
                </div>
                <div class="instagram-item">
                  <img class="instagram-image" src="images/man-boné.jpg" alt="Image 3">
                  <div class="instagram-text-overlay">
                    <div class="instagram-text">"#Apaixonada pela arte da fotografia."</div>
                  </div>
                </div>
              
                <!-- Add more instagram-item blocks for additional images -->
              </div>
              <div class="col-lg-12 ">
                  <a href=" ">
                      <button type="button" >Ver Mais</button>
                  </a> 
              </div>
            
  </section>
       

  <!--<div class="col-lg-2 " >
            <div class="card image-container" style="width: 20rem;" onmouseover="changeImage()" onmouseout="restoreImage()">
                          
                <img id="image" src="images/products/bone-1.png" alt="Original Image">
                <div class="card-body">
                    <h5 class="card-title text-center">Card title</h5>
                    <p class="card-text text-center">R$ 25,00</p> 
                </div>
            </div>
      </div>
  <script>
    function changeImage() {
      var image = document.getElementById("image");
      image.src = "images/products/bone-1.png";
      image.alt = "New Image";
    }

    function restoreImage() {
      var image = document.getElementById("image");
      image.src = "images/products/bone-1-1.png";
      image.alt = "Original Image";
    }
  </script>--->

   <!--js bibliotecas-->
  
   <?php
  require_once("footer.php");
?>