<?php

include ("conexion.php");

$numeroDeFormulario = $_GET["id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/item-series.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <link rel="stylesheet" href="estilo.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<div class="menu">
<br>

    <div class="titulo">


        <p>ESTADISTICAS DE LA ENCUESTA</p>
    </div>
    <div class="total">
        <?php 
            include "totales.php"
        ?>
    </div>
    
</div>
<div class="principal">
    
    <div class="respuestas">
    <?php
        include ("numpreguntas.php");
        while($op = mysqli_fetch_array($resultadoxPregunta)){
            echo "<div id='container".$numeroSaltos."' class='contenedor' '></div>";
            $numeroSaltos = $numeroSaltos + 1;
        }
    ?>
    </div>
    <div class="graficototal">
    <?php
        include ("numpreguntas.php");
        while($op = mysqli_fetch_array($resultadoxPregunta)){
            echo "<div id='containertotal".$numeroSaltos."' class='contenedor' '></div>";
            $numeroSaltos = $numeroSaltos + 1;
        }
    ?>
    </div>

</div>
<?php
    include "grafico.php";
    
    include "graficototal.php";
?>
</body>
</html>