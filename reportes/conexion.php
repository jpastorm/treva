<?php
//Conexion a la base de datos
$usuario = "root";
$contrasena = "Sistemas.123!"; 
$servidor = "localhost";
$basededatos = "saponte_db_treva";
$conexion = 
mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos");
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
?>