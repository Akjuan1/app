<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tb_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto=$registro["nombredelpuesto"];
    $descripcion=$registro["descripcion"];
}
if ($_POST) {
   
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
     $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
     $descripcion=(isset($_POST["descripcion"])?$_POST["descripcion"]:"");
     $sentencia=$conexion->prepare("UPDATE tb_puestos SET nombredelpuesto=:nombredelpuesto, descripcion=:descripcion WHERE id=:id ");
     $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
     $sentencia->bindParam(":descripcion",$descripcion); 
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
      <div class="carousel-caption top-0 start-10 ">
<div class= "container">  

<br/>
<h1>Editar tipo de Evento Deportivo</h1>
<div class="card bg-secondary bg-opacity-50">
    <div class="card-header text-white h4">
        Evento Deportivo
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
      <label for="nombredelpuesto" class="form-label text-white">Tipo de Evento Deportivo:</label>
      <input type="text"
      value="<?php echo $nombredelpuesto;?>"
        class="form-control bg-secondary" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del tipo de evento deportivo">
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label text-white">Descripcion:</label>
      <input type="text"
      value="<?php echo $descripcion;?>"
        class="form-control bg-secondary" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion del Tipo de Evento Deportivo">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button>

    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
</form>
</div>
    </div>
    <div class="card-footer text-muted">  </div>
</div>
</div>
</div>
<?php include("../../templates/footer.php"); ?>