<script>
<?php
    include ("numpreguntas.php");
?>

<?php
while($op = mysqli_fetch_array($resultadoxPregunta)){
    include ("conexion.php");
    //QUERYS_CONSULTAS
    $consultaxTotalPregunta = "SELECT p.id_pregunta,p.descripcion,count(d.puntaje) AS 'Puntaje',
    CASE
        WHEN d.puntaje = 1 THEN 'Malo'
        WHEN d.puntaje = 2 THEN 'Insuficiente'
        WHEN d.puntaje = 3 THEN 'Regular'
        WHEN d.puntaje = 4 THEN 'Bueno'
        WHEN d.puntaje = 5 THEN 'Excelente'
    END
    AS 'Opciones',
    CASE 
        WHEN d.puntaje = 1 THEN 'rgb(242,28,27)'
        WHEN d.puntaje = 2 THEN 'rgb(234,86,21)'
        WHEN d.puntaje = 3 THEN 'rgb(249,184,16)'
        WHEN d.puntaje = 4 THEN 'rgb(124,202,83)'
        WHEN d.puntaje = 5 THEN 'rgb(76,183,19)'
    END
    AS 'Colores'
    FROM pregunta AS p
    INNER JOIN detallepregunta AS d ON d.id_pregunta = p.id_pregunta
    INNER JOIN formulario AS f ON f.id_formulario = p.id_formulario
    WHERE f.id_formulario = ".$numeroDeFormulario." AND p.id_pregunta = ".$op['Numero']."
    GROUP BY d.puntaje
    ORDER BY d.puntaje";
    //RESULTADOS
    $resultadoxTotalPregunta = mysqli_query( $conexion, $consultaxTotalPregunta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    include ("cerrar_conexion.php");

    $fila = mysqli_fetch_array($resultadoxTotalPregunta);
    if(!$fila){
       break;
    }
?>

Highcharts.chart(<?php echo "'containertotal".$numeroSaltos."'"?>, {
chart: {
    type: 'item',
    backgroundColor: '#FCFFC5'
},

title: {
    text: <?php echo "'".$fila[1]." '";  ?>
},

subtitle: {
     text: 'Parliament visualization'
},

legend: {
    labelFormat: '{name} <span style="opacity: 0.4">{y}</span>'
},

series: [{
    name: 'Representatives',
    keys: ['name', 'y', 'color', 'label'],
    data: [
        <?php
            echo "['".$fila[3] . "',
                    " . $fila[2] . ",
                    '". $fila[4]."',
                    '".$fila[3]."'],";
			while ($columna = mysqli_fetch_array($resultadoxTotalPregunta)){ 
                echo "['".$columna['Opciones'] . "',
                " . $columna['Puntaje'] . ",
                '". $columna['Colores'] ."',
                '". $columna['Opciones'] ."'],";
			}
        ?>
    ],
    dataLabels: {
        enabled: true,
        format: '{point.label}'
    },

    // Circular options
    center: ['50%', '88%'],
    size: '170%',
    startAngle: -100,
    endAngle: 100
}]
});

<?php
        $numeroSaltos = $numeroSaltos + 1;
    }
?>

</script>