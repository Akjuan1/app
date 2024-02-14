<?php
include("../../bd.php");

if ($_POST) {
   print_r($_POST);
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
    $sentencia=$conexion->prepare("INSERT INTO tb_puestos(id,nombredelpuesto,descripcion)
        VALUES (null, :nombredelpuesto, :descripcion)");
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->bindParam(":descripcion",$descripcion);
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
<div class= "container">

<br/>
<h1>Crear tipo de Evento Deportivo</h1> 
<div class="card bg-secondary bg-opacity-50">
    <div class="card-header text-white">
        Evento Deportivo
    </div>
    <div class="card-body">
        
<form class="needs-validation" action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nombredelpuesto" class="form-label text-white">Tipo de Evento Deportivo:</label>
      <input type="text"
        class="form-control bg-secondary" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del tipo de Evento Deportivo" required="" pattern="[a-zA-Z]+">
    </div>
    <div class="mb-3">
      <label for="nombredelpuesto" class="form-labe text-white">Descripcion:</label>
      <input type="text"
        class="form-control bg-secondary" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion del Tipo de Evento Deportivo" required="" pattern="[a-zA-Z]+">
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