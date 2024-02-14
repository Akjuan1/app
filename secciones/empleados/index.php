<?php  
include("../../bd.php");


if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT foto,cv FROM `tb_empleados` WHERE id=:id");
     $sentencia->bindParam(":id",$txtID);
     $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    
if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
    if(file_exists("./".$registro_recuperado["foto"])){
        unlink("./".$registro_recuperado["foto"]);
    } 
}    
if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
    if(file_exists("./".$registro_recuperado["cv"])){
        unlink("./".$registro_recuperado["cv"]);
    } 
}
    $sentencia=$conexion->prepare("DELETE FROM tb_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Evento Deportivo eliminado";
    header("Location:index.php?mensaje=".$mensaje);
}

$sentencia=$conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tb_puestos 
WHERE tb_puestos.id=tb_empleados.idpuesto limit 1) as puesto
FROM `tb_empleados`");
$sentencia->execute();
$lista_tb_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
  <title>Planificacion Deportiva</title>
  </head>
<?php include("../../templates/header.php"); ?>

<div class="position-relative">
   <div class="active">
   <img src="\app\templates\grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">

 <div class="container">
</br>

<h1>Planificación Deportiva</h1> 

  <!-- Content here -->
<div class="card bg-secondary bg-opacity-75">
   <div class="card-header">
        <a name="" id="" class="btn btn-outline-light text-black fw-bold" href="crear.php" role="button">
        Agregar Evento Deportivo </a>
    <div class="card-body ">
        
      <div class="table-responsive-sm">
        <div >
        <table class="" id="tabla_id">
            <thead>
                <tr >
                    <th scope="col">ID</th>
                    <th scope="col">Descripcion del Evento deportivo</th>
                    <th scope="col">Croquis de Ubicacion</th>
                    <th scope="col">Planilla de Participantes</th>
                    <th scope="col">Tipo de Evento</th>
                    <th scope="col">Fecha del Evento</th>
                    <th scope="col"></th>
                </tr>
            </thead>
        <tbody>
      
            <?php foreach($lista_tb_empleados as $registro) { ?>

                <tr class="text-white">
                    <td><?php echo $registro['id']; ?></td>
                    <td class="" scope="row">
                        <strong class="text-black">Coordinador: </strong> 
                        <?php echo $registro['primernombre']; ?>
                        <?php echo $registro['segundonombre']; ?>
                        <br/>
                        <strong class="text-black">Objetivo del Evento: </strong>
                        <?php echo $registro['primerapellido']; ?>
                        <br/>
                        <strong class="text-black">Financiación y presupuesto: </strong>
                        <?php echo $registro['segundoapellido']; ?>
                    </td>
                    <td>
                        <img width="150"
                        src="<?php echo $registro['foto']; ?>" 
                        class="img-fluid rounded" alt="" />
                    </td>
                    <td >
                        <a class="text-white" href="<?php echo $registro['cv']; ?>">
                    <?php echo $registro['cv']; ?> </a
                    </td>
                    <td><?php echo $registro['puesto']; ?></td>
                    <td><?php echo $registro['fechadeingreso']; ?></td>
                    <td>
                <a href="carta_recomendacion.php?txtID=<?php echo $registro['id']; ?>" class="btn btn-primary" role="button">Constancia</a>
                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                </tr> 
                <?php } ?>
            </tbody>

        </table>
      </div></div>
        </div>
    </div>
</div>
</div>
    </div>
</div>
            
<?php include("../../templates/footer.php"); ?>