<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tb_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];
}
if ($_POST) {

    $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
  
    $sentencia=$conexion->prepare("UPDATE tb_usuarios 
    SET usuario=:usuario,
        password=:password,
        correo=:correo 
    WHERE id=:id");
  
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();
    $mensaje="Registro actualizado";
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
<h1>Editar Usuario</h1> 

<div class="card bg-secondary bg-opacity-75">
    <div class="card-header text-white h4">
       Datos del Usuarios
    </div>
    <div class="card-body">
        
<form action="" method="post" enctype="multipart/form-data">
    
<div class="mb-3">
      <label for="txtID" class="form-label text-white">ID</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control bg-secondary" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
      
    </div>

    <div class="mb-3">
      <label for="usuario" class="form-label text-white">Nombre del Usuario:</label>
      <input type="text"
      value="<?php echo $usuario;?>"
        class="form-control bg-secondary" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
    </div>

<div class="mb-3">
  <label for="password" class="form-label text-white">Password:</label>
  <input type="password"
  value="<?php echo $password;?>"
    class="form-control bg-secondary" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
</div>

<div class="mb-3">
  <label for="correo" class="form-label text-white">Correo:</label>
  <input type="email"
  value="<?php echo $correo;?>"
    class="form-control bg-secondary" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
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