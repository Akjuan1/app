<?php 
require_once('db-connect.php');

if($_SERVER['REQUEST_METHOD'] !='POST'){
    //echo "<script> alert('Error: No hay datos para guardar.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);
$allday = isset($allday);

// Obtener fecha y hora de inicio del nuevo registro
$start_datetime = date('Y-m-d H:i:s', strtotime($start_datetime));

// Verificar si ya existe un registro en la misma fecha y hora, dentro del rango de 15 minutos
$sql = "SELECT * FROM `schedule_list` WHERE `start_datetime` BETWEEN DATE_ADD('$start_datetime', INTERVAL -30 MINUTE) AND DATE_ADD('$start_datetime', INTERVAL 30 MINUTE)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ya existe un registro en la misma fecha y hora, dentro del rango de 15 minutos
    //echo "<script> alert('Error: Ya existe un evento deportivo en la misma fecha y hora, dentro del rango.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

if(empty($id)){
    $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')";
}else{
    $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}
$save = $conn->query($sql);
if($save){
    //echo "<script> alert('Evento Guardado Correctamente.'); location.replace('./') </script>";
}else{
    //echo "<pre>";
    //echo "An Error occured.<br>";
    //echo "Error: ".$conn->error."<br>";
    //echo "SQL: ".$sql."<br>";
    //echo "</pre>";
}
$conn->close(); 
header("Location:http://localhost/app/secciones/evento_calendario/");
 ?>

 <!--Este código utiliza la función DATE_ADD de MySQL para calcular la fecha y hora límite para la búsqueda de registros en el rango de 15 minutos. La consulta SQL busca registros cuya fecha y hora de inicio estén entre la fecha y hora de inicio del nuevo registro menos 15 minutos y la fecha y hora de inicio del nuevo registro más 15 minutos. Si se encuentra algún registro que cumpla con esas condiciones, se impide la inserción del nuevo registro.-->