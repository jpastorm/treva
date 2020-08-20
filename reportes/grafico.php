<script>

<?php
    include ("numpreguntas.php");
?>
// Make monochrome colors
var pieColors = (function () {
    var colors = {
        0:"rgb(242,28,27)",
        1:"rgb(234,86,21)",
        2:"rgb(249,184,16)",
        3:"rgb(124,202,83)",
        4:"rgb(76,183,19)"
    };
    return colors;
}());

<?php 
    while($op = mysqli_fetch_array($resultadoxPregunta)){

        include ("conexion.php");
        $consultaxFormulario = "SELECT p.id_pregunta,p.descripcion,count(d.puntaje) AS 'Puntaje',
        CASE
            WHEN d.puntaje = 1 THEN 'Malo'
            WHEN d.puntaje = 2 THEN 'Insuficiente'
            WHEN d.puntaje = 3 THEN 'Regular'
            WHEN d.puntaje = 4 THEN 'Bueno'
            WHEN d.puntaje = 5 THEN 'Excelente'
        END
        AS 'Opciones'
        FROM pregunta AS p
        INNER JOIN detallepregunta AS d ON d.id_pregunta = p.id_pregunta
        INNER JOIN formulario AS f ON f.id_formulario = p.id_formulario
        WHERE f.id_formulario = ".$numeroDeFormulario." AND p.id_pregunta = ".$op['Numero']."
        GROUP BY d.puntaje
        ORDER BY d.puntaje;
        ";
        $resultadoxFormulario = mysqli_query( $conexion, $consultaxFormulario ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        include ("cerrar_conexion.php");
        $fila = mysqli_fetch_array($resultadoxFormulario);
        if(!$fila){
            break;
        }
?>

Highcharts.chart(<?php echo "'container".$numeroSaltos."'"?>, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor: '#FCFFC5',
        width: 300
    },
    title: {
        text: <?php echo "'".$fila[1]." '";  ?>
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        colors:pieColors,
        data: [
            <?php
            echo "{ name:'".$fila[3] . "',
                y:" . $fila[2] . "},";
			while ($columna = mysqli_fetch_array($resultadoxFormulario)){ 
                echo "{ name:'".$columna['Opciones'] . "',
                        y:" . $columna['Puntaje'] . "},";
			}
			?>
        ]
    }]
});


<?php
        $numeroSaltos = $numeroSaltos + 1;
    }
?>


</script>