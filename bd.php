<?php

$servidor= "localhost"; //127.0.0.1
$baseDeDatos= "app";
$usuario="root";
$constraseña="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$constraseña);
}catch(Exception $ex){
    echo $ex->getmessage();
}

?>