
<!DOCTYPE html>
<?php
session_start(); 
if (!isset($_GET["link"])) {
  header('Location: index.php' );
}else{
    $link=$linkencript=preg_replace('/\s+/', '+', $_GET['link']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Document</title>
</head>
<body>
    <center>
<div id="app" class="container">
<input type="text" value="<?php echo $link ?>" id="link">
    <div class="tarjeta" v-for="pregunta of preguntas">
    <h3>{{pregunta.descripcion}}</h3>
    <div class="opciones">
        <div class="opcion opcion1">opcion1</div>
        <div class="opcion opcion2">opcion2</div>
        <div class="opcion opcion3">opcion3</div>
        <div class="opcion opcion4">opcion4</div>
        <div class="opcion opcion5">opcion5</div>
    </div>
    <div class="opcionfinal">
        <p><strong>Muy malo</strong></p>
        <p><strong>Excelente</strong></p>
    </div>
    </div>
</div>
</center>
<script  src="./assets/js/sweetalert.js"></script>
<script  src="./assets/js/axios.js" ></script>
<script  src="./assets/js/vue.js"></script>
<script  src="src/votacion.js"></script>
</body>
</html>