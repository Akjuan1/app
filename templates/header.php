<?php 
session_start();
$url_base="http://localhost/app/";

if(!isset($_SESSION["usuario"])){
header("Location:".$url_base."Login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
  <title></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
   
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link rel="stylesheet" href="./templates/style.css"  >
      <link rel="icon" href="logo2.png"/>
</head>

<body>
  <header class="header">
      <!-- place navbar here -->
<nav class="navbar p-0 navbar-light bg-white">
      
  <div class="container-fluid">
  <a  class="navbar-brand text-black" href="<?php echo $url_base="http://localhost/app/"; ?>" aria-current="page">Inicio<span class="visually-hidden">(current)</span></a>
    <a class="navbar-brand" href="<?php echo $url_base="http://localhost/app/"; ?>">
      <img src="\app\templates\logo.png" alt="Bootstrap" width="80" height="80" >Club Deportivo Zamora F.C
    </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse hover" id="navbarNavDropdown">
      <ul class="navbar-nav h5 ">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base="http://localhost/app/"; ?>secciones/empleados/">Planificacion Deportiva</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base="http://localhost/app/"; ?>secciones/evento_calendario/">Calendario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base="http://localhost/app/"; ?>secciones/puestos/">Tipos de Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base="http://localhost/app/"; ?>secciones/usuarios/">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base="http://localhost/app/"; ?>cerrar.php">Cerrar Sesion</a>
                </li>
      </ul>
    </div>
  </div>
</nav>

  </header>

  
  
  <?php if(isset($_GET['mensaje'])) { ?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
    </script>
    <?php } ?>
    