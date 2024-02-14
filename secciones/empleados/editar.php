<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tb_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $foto=$registro["foto"];
    $cv=$registro["cv"];

    $idpuesto=$registro["idpuesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    $sentencia=$conexion->prepare("SELECT * FROM `tb_puestos`");
    $sentencia->execute();
    $lista_tb_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
  

}
if ($_POST) {
  
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  $sentencia=$conexion->prepare("
  UPDATE tb_empleados 
  SET 
    primernombre=:primernombre,
    segundonombre=:segundonombre,
    primerapellido=:primerapellido,
    segundoapellido=:segundoapellido,
    idpuesto=:idpuesto,
    fechadeingreso=:fechadeingreso
  WHERE id=:id
  ");
  
  $sentencia->bindParam(":primernombre",$primernombre);
  $sentencia->bindParam(":segundonombre",$segundonombre);
  $sentencia->bindParam(":primerapellido",$primerapellido);
  $sentencia->bindParam(":segundoapellido",$segundoapellido);
  $sentencia->bindParam(":idpuesto",$idpuesto);
  $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
  $sentencia->bindParam(":id",$txtID);

  $sentencia->execute();

  $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
  $fecha_=new DateTime();
  $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
  $tmp_foto=$_FILES["foto"]["tmp_name"];

  if($tmp_foto!=''){
    move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    $sentencia=$conexion->prepare("SELECT foto FROM `tb_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
      if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
          if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
           } 
      }   
  $sentencia=$conexion->prepare("UPDATE tb_empleados SET foto=:foto WHERE id=:id");
  $sentencia->bindParam(":foto",$nombreArchivo_foto);
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();
  }

  $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");

    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    $tmp_cv=$_FILES["cv"]["tmp_name"];
    if($tmp_cv!=''){
      move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);

      $sentencia=$conexion->prepare("SELECT cv FROM `tb_empleados` WHERE id=:id");
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();
      $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
      
      if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
                unlink("./".$registro_recuperado["cv"]);
        } 
    }
      $sentencia=$conexion->prepare("UPDATE tb_empleados SET cv=:cv WHERE id=:id");
      $sentencia->bindParam(":cv",$nombreArchivo_cv);
      $sentencia->bindParam(":id",$txtID);
      $sentencia->execute();

    }
    $mensaje="Evento Deportivo Actualizado";
    header("Location:index.php?mensaje=".$mensaje);
}
?>
<?php include("../../templates/header.php"); ?>

<div class="position-relative">
<div class="active">
  
   <img src="\app\templates\grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10 ">
<div class= "container">  

<h3>Editar Evento Deportivo</h3>       

<div class="card bg-secondary bg-opacity-50">
    <div class="card-header text-white h5"> Datos del Evento Deportivo </div>
    <div class="card-body">
    
    <form class="row" action="" method="post" enctype="multipart/form-data">

    <div class="mb-1">
      <label for="txtID" class="form-label text-white">ID</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control bg-secondary" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
      
    </div>

    <div class="mb-1">
      <label for="primernombre" class="form-label text-white">Nombre del Coordinador:</label>
      <input type="text"
      value="<?php echo $primernombre;?>"
        class="form-control bg-secondary" name="primernombre"
        id="primernombre" aria-describedby="helpId" 
    placeholder="Nombre del Coordinador:">
    </div>
    
    
    <div class="mb-1">
      <label for="segundonombre" class="form-label text-white">Apellido del Coordinador:</label>
      <input type="text"
      value="<?php echo $segundonombre;?>"
        class="form-control bg-secondary" name="segundonombre" 
        id="segundonombre" aria-describedby="helpId" 
        placeholder="Apellido del Coordinador:" >
    </div>

    <div class="mb-1">
      <label for="primerapellido" class="form-label text-white">Objetivo del Evento:</label>
      <input type="text"
      value="<?php echo $primerapellido;?>"
        class="form-control bg-secondary" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Objetivo del Evento:">
    </div>

    <div class="mb-1">
      <label for="segundoapellido" class="form-label text-white">Financiación y presupuesto:</label>
      <input type="text"
      value="<?php echo $segundoapellido;?>"
        class="form-control bg-secondary" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Financiación y presupuesto:" >
    </div>

    <div class="mb-1">
      <label for="foto" class="form-label text-white">Croqui</label>
      <br/> 

      <img width="120"
        src="<?php echo $foto;?>"
        class="rounded" alt="" />
      <br/> 
      <br/> 
       <input type="file"
        class="form-control bg-secondary " name="foto" id="foto" aria-describedby="helpId" placeholder="Foto:">
    </div>

    <div class="mb-2">
      <label for="cv" class="form-label text-white">Planilla de Participantes:</label>
            <br/>
        <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
        <input type="file"
        class="form-control bg-secondary" name="cv" id="cv" aria-describedby="helpId" placeholder="CV:">
    </div>

    <div class="mb-2">
        <label for="idpuesto" class="form-label text-white">Tipo de Evento:</label>
       
        <select class="form-select form-select-sm bg-secondary" name="idpuesto" id="idpuesto">
            <?php foreach($lista_tb_puestos as $registro) { ?>

                <option <?php echo ($idpuesto== $registro['id'])?"selected":"";?> value="<?php echo $registro['id'];?>">
                <?php echo $registro['nombredelpuesto']; ?>
            </option> 

            <?php } ?>
        </select>
    </div>

<div class="mb-2">
  <label for="fechadeingreso" class="form-label text-white">Fecha del Evento Deportivo:</label>
  <input 
  value="<?php echo $fechadeingreso;?>"
  type="date" class="form-control bg-secondary" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
</div>

<div class="container">
<button type="submit" class="btn btn-success">Actualizar Evento Deportivo</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
</div>

    </form>
    </div>    
    </div>
    <div class="card-footer text-muted"></div>
 </div>
</div>
</div>

<?php include("../../templates/footer.php"); ?>