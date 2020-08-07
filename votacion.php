
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <center>
<div id="app" class="container">
<div v-if="isvoted == false">
<input type="text" value="<?php echo $link ?>" id="link" hidden>
<form @submit="checkform">
    <div class="tarjeta" v-for="pregunta of preguntas">
    <h3>{{pregunta.descripcion}}</h3>
    
    <div class="opciones">
        <div v-for="(op,indice) of opciones">
        
            <div :class="'opcion opcion'+(indice+1)">
            <input type="radio" :name="'radio'+pregunta.id_pregunta" :value="op.value" @change="getSeleccion" required> {{op.text}}</input>
            </div>
            
            
        </div>
    </div>
    <div class="opcionfinal">
        <p class="malo"><strong>Muy malo</strong></p>
        <p class="malo"><strong>Excelente</strong></p>
    </div>
    </div>
    <br>
    <div class="izquierda">
    <input class="buttonstyle" type="submit" value="Enviar">
    </div>
</form>
</div>
<div v-else>
<div class="card">
<br>
<h1 class="guardado">{{titulo}}</h1>
<p class="guardado">Se ha registrado tu respuesta.</p>
<a @click="recargar" class="response">Enviar otra Respuesta</a>
</div>
<br>
<p class="guardado color">Este contenido no ha sido creado ni aprobado por Treva. Notificar uso inadecuado - Términos del Servicio - Política de Privacidad</p>      
<div><h2 class="guardado color">Treva</h2></div>
</div>
</div>
</center>
<script  src="./assets/js/sweetalert.js"></script>
<script  src="./assets/js/axios.js" ></script>
<script  src="./assets/js/vue.js"></script>
<script  src="src/votacion.js"></script>
</body>
</html>