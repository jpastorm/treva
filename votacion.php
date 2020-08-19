
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

    <title>TREVA | Formulario</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="assetsform/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assetsform/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assetsform/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assetsform/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assetsform/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Caveat|Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="assetsform/css/bootstrap.min.css" rel="stylesheet">
    <link href="assetsform/css/style.css" rel="stylesheet">
	<link href="assetsform/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="assetsform/css/custom.css" rel="stylesheet">
</head>
<?php 
$randomnum= rand(1,3);

?>
<body class="style_<?php echo $randomnum?>">
    <div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->

	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->
    <header>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-5">
	                <a href="#"><img src="assetsform/img/logo.svg" alt="" width="50" height="55"></a>
	            </div>
	            <div class="col-7">
	                <div id="social">
	                    <ul>
	                        <li><a href="#0"><i class="social_facebook"></i></a></li>
	                        <li><a href="#0"><i class="social_twitter"></i></a></li>
	                        <li><a href="#0"><i class="social_instagram"></i></a></li>
	                        <li><a href="#0"><i class="social_linkedin"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	</header>
	<!-- /header -->
    <!-- Wrapping Center -->
    <div class="wrapper_centering">
    <!-- center -->
 <div class="container_centering">
    <div id="app" class="container">
  
           <input type="text" value="<?php echo $link ?>" id="link" hidden>
            <!-- SECCION DEL DATOS DEL FORM -->
            <div class="row justify-content-between">
               <div class="col-xl-12 col-lg-12 d-flex align-items-center">
	                    <div class="main_title_1 align-items-center" >
	                        <h3><img src="assetsform/img/main_icon_1.svg" width="80" height="80" alt=""> {{tituloform}}</h3>
	                        <p style="text-align: justify;">{{descform}}</p>
                            <p><em>Realizado por: {{autorform}}</em></p>
                  
                        </div>
                        
            </div>
            <!-- /SECCION DEL DATOS DEL FORM -->
            <!-- SECCION DEL FORMULARIO -->
            
             <div class="col-xl-12 col-lg-12">   
             <div v-if="isvoted == false">
            <div id="top-wizard">
               <!-- <form id="wrapped" @submit="checkform" autocomplete="off">-->
                <input id="website" name="website" type="text" value="">
				<!-- Leave for security protection, read docs for details -->
				<div id="middle-wizard">
                   
                    <!-- Cada step es una pregunta -->

                    <form>

                    <div class="step" v-for="(pregunta, index) in preguntas">

                         <br><br><br>
                         <input :id="'question_'+(index+1)" :name="'radio'+pregunta.id_pregunta" hidden/>
                      <h3 class="main_question"><strong>{{index+1}} de {{cantidadpreguntas}}</strong>{{pregunta.descripcion}}</h3>
                        <div class="review_block_smiles">
	                                    <ul class="clearfix">
	                                    		<li>
	                                    			 <div class="container_smile">
	                                                    <input type="radio" :id="'very_bad_'+(index+1)" :name="'radio'+pregunta.id_pregunta" class="required" value="1" @change="getSeleccion" required>
	                                                    <label class="radio smile_1" :for="'very_bad_'+(index+1)"><span>Muy mal</span></label>
	                                                </div>
	                                    		</li>
	                                    		<li>
	                                    		 <div class="container_smile">
	                                                    <input type="radio" :id="'bad_'+(index+1)" :name="'radio'+pregunta.id_pregunta" class="required" value="2" @change="getSeleccion" required> 
	                                                    <label class="radio smile_2" :for="'bad_'+(index+1)"><span>Mal</span></label>
	                                                </div>
	                                    		</li>
	                                    		<li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'average_'+(index+1)" :name="'radio'+pregunta.id_pregunta" class="required" value="3" @change="getSeleccion" required> 
	                                                    <label class="radio smile_3" :for="'average_'+(index+1)"><span>Normal</span></label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'good_'+(index+1)" :name="'radio'+pregunta.id_pregunta" class="required" value="4" @change="getSeleccion" required>
	                                                    <label class="radio smile_4" :for="'good_'+(index+1)"><span>Bueno</span></label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'very_good_'+(index+1)" :name="'radio'+pregunta.id_pregunta" class="required" value="5" @change="getSeleccion" required>
	                                                    <label class="radio smile_5" :for="'very_good_'+(index+1)"><span>Muy bueno</span></label>
	                                                </div>
	                                            </li>
	                                    	</ul>
	                                    	<div style="color: white;" class="row justify-content-between add_bottom_25">
	                                    		<div class="col-4">
	                                    			<em>Muy mal</em>
	                                    		</div>
	                                    		<div class="col-4 text-right">
	                                    			<em>Excelente</em>
	                                    		</div>
	                                    	</div>
                        </div>
               
                    </div>
                    
                </div>	
                  <!-- /row -->
               
                <div id="bottom-wizard">
                    <br><br>
                    <div class="row">
                 
                    <div class="col-5">
                              
                    <label class="container_check">Por favor acepte nuestros <a href="#" data-toggle="modal" data-target="#terms-txt" style="color:#fff; text-decoration: underline;">Terminos y condiciones</a>
	                                            <input type="checkbox" name="terms" value="Yes" class="required" required v-model="checked">
	                                            <span class="checkmark"></span>
	                                        </label>
                    </div>
                    <div class="col-7">
                    <button type="submit" name="process" class="submit" @click="checkform" >Enviar</button>
                    </div>
                    </div>
          
	            </form>
	            </div>
	            <!-- /bottom-wizard -->	
                <!--</form>-->
                </div>
                </div>
                <div v-else>
<div class="container">
<div class="row justify-content-between">
               <div class="col-xl-12 col-lg-12 d-flex align-items-center">
	                    <div class="main_title_1 align-items-center" >
	                        <p><em>Tu respuesta se registro exitosamente!</em></p>
                            <p><em>Gracias por utilizar TREVA!</em></p>
                            <a @click="recargar" class="botonrecargar">Enviar otra respuesta</a>
                        </div>
                        
</div>


</div>

</div>
            </div>
            <!-- /SECCION DEL FORMULARIO -->
    </div>
        
  
        </div>
    </div>
     <!-- center -->
     <!-- footer -->
    <footer>
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-3">
	                    ©2020 Grupo QWERTY
	                </div>
	                <div class="col-md-9">
	                    <ul class="clearfix">
	                        <li><a href="#terms-txt" class="animated_link" target="_parent">Crear mi propio formulario</a></li>

	                    </ul>
	                </div>
	            </div>
	            <!-- /row -->
	        </div>
	        <!-- /container-fluid -->
	</footer>
	<!-- /footer -->
    </div>
    
    <!-- /Wrapping center -->
	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<script  src="./assets/js/sweetalert.js"></script>
<script  src="./assets/js/axios.js" ></script>
<script  src="./assets/js/vue.js"></script>
<script  src="src/votacion.js"></script>
	<!-- COMMON SCRIPTS -->
	<script src="assetsform/js/jquery-3.2.1.min.js"></script>
    <script src="assetsform/js/common_scripts.min.js"></script>
	<script src="assetsform/js/functions.js"></script>

	<!-- Wizard script -->
	<script src="assetsform/js/survey_func.js"></script>
</body>
</html>