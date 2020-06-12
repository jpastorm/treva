<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="assets/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="assets/img/bg.svg">
		</div>
		<div class="login-content">
			<div class="form" id="app">
				<img src="assets/img/avatar.svg">
				<h2 class="title">Bienvenido!</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Olvidaste tu Contraseña?</a>
              <button @click="ingresar" class="btn">Iniciar Sesión</button>
            </div>
        </div>
    </div>
    
    <script src="./assets/js/axios.js"></script>
  <script src="./assets/js/vue.js"></script>
<script src="src/login.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
