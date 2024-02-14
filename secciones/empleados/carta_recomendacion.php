<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *, (SELECT nombredelpuesto 
    FROM tb_puestos 
    WHERE tb_puestos.id=tb_empleados.idpuesto limit 1) as puesto FROM tb_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $nombreCompleto= $primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido;

    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $idpuesto=$registro["idpuesto"];
    $puesto=$registro["puesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    $fechaInicio=new DateTime($fechadeingreso);
    $fechaFin=new Datetime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);

}
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Evento Deportivo</title>
</head>
<body>

<h1>Constancia de Planificación de un Evento Deportivo</h1>
<br/><br/>
Barinas, estado Barinas.<strong> <?php echo $fechadeingreso;?></strong>
<br/><br/>
A quien pueda interesar: 
<br/><br/>
Reciba un cordial y respetuoso saludo.
<br/><br/>
A traves de estas lineas deseo hacer de su conocimiento que Sr(a) 
<strong> <?php echo $primernombre; ?> <?php echo $segundonombre; ?></strong>, 
a Planificado un Evento Deportivo de tipo: <strong> <?php echo $puesto;?>. </strong> Nombrado: <strong> <?php echo $primerapellido;?> </strong>
Financiado o Prosupuestado por: <strong> <?php echo $segundoapellido;?>. </strong>
Se desea dejar constancia de mi participación en el evento deportivo planificado, siendo un ciudadano con una conducta intachable. Demostrando ser un gran trabajador,
comprometido, responsable y fiel cumplidor de sus tareas dentro del la coordinación. 
Siempre ha manifestado peocupacion por mejorar, capacitarse y actualizar sus conocimientos.
<br/><br/>
Este evento deportivo de tipo: <strong><?php echo $puesto;?>.</strong> Es de gran influencia para la comunidad y la ubicación delimitada, ya que genera beneficios economicos, sociales y ambientales.
Es por ello se consta finalmente, con la confianza de que estara siempre a la altura de sus compromisos y responsabilidades dentro y fuera del Club Deportivo Zamora F.C.
<br/><br/>
Sin mas nada a que referirme y, esperando que esta carta sea tomada en cuenta, dejo mi numero de contacto para cualquier informacion de interes.
<br/><br/><br/><br/><br/><br/><br/><br/>
_______________________________<br/>
Atentamente,
<br/>
Coordinacion de Comunicacion y Marketing
</body>
</html>
<?php
$HTML=ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf=new Dompdf();

$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));

?>