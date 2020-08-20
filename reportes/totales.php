<?php

include ("conexion.php");
//QUERYS_CONSULTAS
$consultaxTotales= "SELECT COUNT(d.id_detallepregunta) AS 'Participantes' FROM detallepregunta AS d
INNER JOIN pregunta AS p ON p.id_pregunta = d.id_pregunta
WHERE p.id_formulario = ".$numeroDeFormulario;
//RESULTADOS
$resultadoxTotales = mysqli_query( $conexion, $consultaxTotales ) or die ( "Algo ha ido mal en la consulta a la base de datos");
include ("cerrar_conexion.php");

?>
<div class="card">
    <h1>Total de respuestas en la encuesta</h1>
    <?php 
        $respuesta = mysqli_fetch_array($resultadoxTotales);
        echo "<h2>".$respuesta['Participantes']."</h2>";
    ?>
    <h3>Respuestas en total</h3>
</div>

<?php

include ("conexion.php");
//QUERYS_CONSULTAS
$consultaxTotales= "SELECT COUNT(id_pregunta) AS 'Total' FROM pregunta
WHERE id_formulario = ".$numeroDeFormulario;
//RESULTADOS
$resultadoxTotales = mysqli_query( $conexion, $consultaxTotales ) or die ( "Algo ha ido mal en la consulta a la base de datos");
include ("cerrar_conexion.php");

?>

<div class="card">
    <h1>Numero de Preguntas</h1>
    <?php 
        $respuesta = mysqli_fetch_array($resultadoxTotales);
        echo "<h2>".$respuesta['Total']."</h2>";
    ?>
    <h3>Preguntas en total</h3>
</div>