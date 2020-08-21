<?php
//Conexion a la base de datos
$usuario = "admin";
$contrasena = "password"; 
$servidor = "localhost";
$basededatos = "treva";
$conexion = 
mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos");
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
?>