<?php
    include ("conexion.php");
    //QUERYS_CONSULTAS
    $consultaxPregunta = "SELECT id_pregunta AS 'Numero' FROM pregunta
    WHERE id_formulario = ".$numeroDeFormulario;
    //RESULTADOS
    $resultadoxPregunta = mysqli_query( $conexion, $consultaxPregunta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    include ("cerrar_conexion.php");

    $numeroSaltos = 1;
?>