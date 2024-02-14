<?php
session_start();
if($_POST){
  include("./bd.php");

  $sentencia=$conexion->prepare("SELECT *,count(*) as n_usuario 
  FROM `tb_usuarios`
  WHERE usuario=:usuario 
  AND password=:password");
  
  $usuario=$_POST["usuario"];
  $contrasena=$_POST["contrasena"];

  $sentencia->bindParam(":usuario",$usuario);
  $sentencia->bindParam(":password",$contrasena);

  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  if($registro["n_usuario"]>0){

    $_SESSION['usuario']=$registro["usuario"];
    $_SESSION['logueado']=true;
    header("Location:index.php");
  }else{
    $mensaje="Error: El usuario o contraseña son inconrrectos";
  }

  }



?>
<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
 
    <!-- place navbar here -->
    <nav class="navbar p-0 navbar-light bg-white">
      
  <div class="container-fluid">
  <div  class="navbar-brand h5" href="">Login<span class="visually-hidden">(current)</span></div>
    <div class="navbar-logo h5" href="">
      <img src="\app\templates\logo.png" alt="Bootstrap" width="80" height="70">Club Deportivo Zamora F.C
</div>
  </div>
</nav>
  </header>

 
<main class="container-fluid p-0">

<div class="position-relative">
   <div class="active">
   <img src="./Loginfondo.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

    <br/><br/>
    <div class="card text-black card bg-secondary bg-opacity-75 fw-bold">
      <div class="card-header text-white h4">Ingreso Al Sistema Web</div>
      <div class="card-body">
      
      <?php if(isset($mensaje)) { ?>

      <div class="alert alert-danger" role="alert">
        <strong><?php echo $mensaje;?></strong>
      </div>

      <?php  } ?>

      <form action="" method="post">

        <div class="mb-3 text-black">
          <label for="usuario" class="form-label">Usuario:</label>
          <input
            type="text"
            class="form-control"
            name="usuario"
            id="usuario"
            placeholder="Escriba su usuario"/>
        </div>

        <div class="mb-3">
          <label for="contrasena" class="form-label">Contraseña:</label>
          <input
            type="password"
            class="form-control"
            name="contrasena"
            id="contrasena"
            placeholder="Escriba su contraseña"/>
        </div>
        
        <button
          type="submit"
          class="btn btn-outline-light text-black fw-bold"
        >
          Entrar al Sistema
        </button>
      </form>

      </div>
      
    </div>
    </div>
<div>
</div>
    </div>
<div>
  </main>

    <!-- place footer here -->
    <?php include("./templates/footer.php"); ?>
  

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>