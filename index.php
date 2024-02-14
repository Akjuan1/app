
<head>
<link rel="stylesheet" href="/templates/style.css"  >
  <title>Inicio || Planificación de Eventos Deportivos</title>
  </head>
  <?php include("templates/header.php");?>
<div class="carousel-inner position-relative">
  <div class="carousel-item active ">
    <img src="./templates/grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">
</br>
        <h1 class="text-white display-0 fw-bold">Bienvenido al Sistema Web para la Planificación de Eventos Deportivos</h1>
         <p class="text-white fst-italic col-md-8 fs-4">Usuario: <?php echo  $_SESSION["usuario"];?></p>
          <div class=" text-black card-header">
            <a name="" id="" class="btn btn-outline-secondary text-black fw-bold" href="/app/secciones/empleados/crear.php" role="button">
              Agregar Evento Deportivo</a>    
          </div>
          <br>
                <div class="grid text-center">
                 <div class="g-col-3">
                  <img src="./templates/zamora.jpg" class="d-flex w-100 img-thumbnail rounded float-start" alt="">
                </div>
                </div>
      </div>
  </div>

</div>
<?php include("templates/footer.php"); ?>  

