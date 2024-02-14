<?php
include("../../bd.php");
if ($_POST) {
  

  $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $password=(isset($_POST["password"])?$_POST["password"]:"");
  $correo=(isset($_POST["correo"])?$_POST["correo"]:"");

  $sentencia=$conexion->prepare("INSERT INTO tb_usuarios (id,usuario,password,correo) 
   VALUES (NULL, :usuario, :password, :correo) ");

  $sentencia->bindParam(":usuario",$usuario);
  $sentencia->bindParam(":password",$password);
  $sentencia->bindParam(":correo",$correo);

  $sentencia->execute();
  $mensaje="Registro agregado";
  header("Location:index.php?mensaje=".$mensaje);
  
}

?>
<?php include("../../templates/header.php"); ?>
<div class="position-relative">
   <div class="active">
   <img src="\app\templates\grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">


<br/>
<div class= "container">
<h1>Crear Usuario Nuevo</h1> 

<div class="card bg-secondary bg-opacity-50">
    <div class="card-header text-white h4">
       Datos del Usuarios
    </div>
    <div class="card-body">
        
<form class="needs-validation" action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="usuario" class="form-label text-white">Nombre del Usuario:</label>
      <input type="text"
        class="form-control bg-secondary" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" required="" pattern="[a-zA-Z]+">
    </div>

<div class="mb-3">
  <label for="password" class="form-label text-white">Password:</label>
  <input type="password"
    class="form-control bg-secondary" name="password" id="password" aria-describedby="helpId" placeholder="Escriba una contraseña." required="">
</div>

<div class="mb-3">
  <label for="correo" class="form-label text-white">Correo Electronico:</label>
  <input type="email"
    class="form-control bg-secondary" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su direccion de correo electronico." required="">
</div>



    <button type="submit" class="btn btn-success">Agregrar</button>

    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
</form>
</div>
    </div>
    <div class="card-footer text-muted">  </div>
</div>
</div>
</div>
<?php include("../../templates/footer.php"); ?>