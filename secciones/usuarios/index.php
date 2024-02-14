<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM tb_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje);
    
}

$sentencia=$conexion->prepare("SELECT * FROM `tb_usuarios`");
$sentencia->execute();
$lista_tb_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<head>
  <title>Usuarios</title>
  </head>
<?php include("../../templates/header.php"); ?>

<div class="position-relative">
   <div class="active">
   <img src="\app\templates\grama.jpg" class="d-relative w-100 img-fluid" alt="">
      <div class="carousel-caption top-0 start-10">


      <br/>
<div class= "container">
<h1>Usuario Agregados</h1> 

<div class="card bg-secondary bg-opacity-75 fw-bold">
    <div class="card-header ">
    <a name="" id="" class="btn btn-outline-light text-black fw-bold" 
        href="crear.php" role="button">
        Agregar Usuario
        </a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="fw-bold" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lista_tb_usuarios as $registro) { ?>
            <tr class="">
            <td scope="row"><?php echo $registro['id']; ?></td>
            <td ><?php echo $registro['usuario']; ?></td>
                <td>********</td>
                <td><?php echo $registro['correo']; ?></td>
                <td>
                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                    
                    <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                </td>
         </tr>
         <?php } ?>
        </tbody>
    </table>
</div>
    </div>
</div>
</div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>