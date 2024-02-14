<?php
include("../../bd.php");

if ($_POST) {

  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
  
  $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
  $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");

  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  $sentencia=$conexion->prepare("INSERT INTO `tb_empleados` 
  (`id`,`primernombre`,`segundonombre`, 
  `primerapellido`, `segundoapellido`, 
  `foto`, `cv`, `idpuesto`, `fechadeingreso`)
   VALUES (NULL, :primernombre,:segundonombre, 
  :primerapellido, :segundoapellido, 
  :foto, :cv, :idpuesto, :fechadeingreso);");

  $sentencia->bindParam(":primernombre",$primernombre);
  $sentencia->bindParam(":segundonombre",$segundonombre);
  $sentencia->bindParam(":primerapellido",$primerapellido);
  $sentencia->bindParam(":segundoapellido",$segundoapellido);

  $fecha_=new DateTime();
  
  $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
  $tmp_foto=$_FILES["foto"]["tmp_name"];
  if($tmp_foto!=''){
    move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
  }
  $sentencia->bindParam(":foto",$nombreArchivo_foto);
  
  $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
  $tmp_cv=$_FILES["cv"]["tmp_name"];
  if($tmp_cv!=''){
    move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
  }
  
  $sentencia->bindParam(":cv",$nombreArchivo_cv);

  $sentencia->bindParam(":idpuesto",$idpuesto);
  $sentencia->bindParam(":fechadeingreso",$fechadeingreso);

  $sentencia->execute();
  $mensaje="Evento Deportivo Agregado";
  header("Location:index.php?mensaje=".$mensaje);
  
}

  $sentencia=$conexion->prepare("SELECT * FROM `tb_puestos`");
  $sentencia->execute();
  $lista_tb_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
  
?>

<?php include("../../templates/header.php"); ?>

<div class="position-relative">
   <div class="active">
   <img src="\app\templates\grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">
<div class= "container">

<br/> 
<h1>Crear Evento Deportivo</h1> 

<div class="card bg-secondary bg-opacity-50">
    <div class="card-header text-white"> Datos del Evento Deportivo </div>
    <div class="card-body">

     <div class="container">

    <form class="row needs-validation" action="" method="post" enctype="multipart/form-data" >

    <div class="mb-3">
      <label for="primernombre" class="form-label text-white">Nombre del Coordinador:</label>
      <input type="text"
        class="form-control bg-secondary" name="primernombre"
        id="primernombre" aria-describedby="helpId" 
        placeholder="Nombre del Coordinador" required="" pattern="[a-zA-Z]+">
      </div>
    

    <div class="mb-3">
      <label for="segundonombre" class="form-label text-white">Apellido del Coordinador:</label>
      <input type="text"
        class="form-control bg-secondary" name="segundonombre" 
        id="segundonombre" aria-describedby="helpId" 
        placeholder="Apellido del Coordinador" required="" pattern="[a-zA-Z]+">
    </div>

    <div class="mb-3">
      <label for="primerapellido" class="form-label text-white">Objetivo del Evento:</label>
      <input type="text"
        class="form-control bg-secondary" name="primerapellido" 
        id="primerapellido" aria-describedby="helpId" 
        placeholder="Objetivo del Evento" required="" pattern="[a-zA-Z]+">
    </div>

    <div class="mb-3">
      <label for="segundoapellido" class="form-label text-white">Financiación y presupuesto:</label>
      <input type="text"
        class="form-control bg-secondary" name="segundoapellido" 
        id="segundoapellido" aria-describedby="helpId" 
        placeholder="Financiación y presupuesto" required="" pattern="[a-zA-Z]+">
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label text-white">Croqui:</label>
      <input type="file"
        class="form-control bg-secondary" name="foto" 
        id="foto" aria-describedby="helpId" 
        placeholder="Foto" required>
    </div>

    <div class="mb-3">
      <label for="cv" class="form-label text-white">Planilla de Participantes:</label>
      <input type="file"
        class="form-control bg-secondary" name="cv" 
        id="cv" aria-describedby="helpId" 
        placeholder="Planilla de Participantes" required>
    </div>

    <div class="mb-3">
        <label for="idpuesto" class="form-label text-white">Tipo de Evento Deportivo:</label>
        <select class="form-select form-select-sm bg-secondary" name="idpuesto" id="idpuesto">
            <option selected>
            </option>
            <?php foreach($lista_tb_puestos as $registro) { ?>
            <option value="<?php echo $registro['id'];?>"><?php echo $registro['nombredelpuesto']; ?></option>  <?php } ?>
        </select>
    </div>

<div class="mb-3">
  <label for="fechadeingreso" class="form-label text-white">Fecha del Evento Deportivo:</label>
  <input type="date" class="form-control bg-secondary " name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
</div>
<div class="container">
  <button type="submit" class="btn btn-success">Agregar Evento Deportivo</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
</div>

    </form>
    </div>
    </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>
</div>
    </div> 
<?php include("../../templates/footer.php"); ?>