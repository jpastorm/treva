
<!DOCTYPE html>
<?php
session_start(); 
if (!isset($_GET["link"])) {
  header('Location: index.php' );
}else{
    $link=$linkencript=preg_replace('/\s+/', '+', $_GET['link']);
    
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Satisfaction Survey form Wizard by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>Satisfyc | Satisfaction Survey form Wizard</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="assets2/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets2/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets2/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets2/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets2/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Caveat|Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="assets2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets2/css/style.css" rel="stylesheet">
	<link href="assets2/css/vendors.css" rel="stylesheet">
	

    <!-- YOUR CUSTOM CSS -->
    <link href="assets2/css/custom.css" rel="stylesheet">
    
</head>

<body class="style_2">


	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->


		<!-- Header -->
		<header class="header" style="max-width:1500px">
			
		  
		  </header>
	<div class="wrapper_centering">
	    <div class="container_centering">
        <br><br>
	        <div class="container" id="app">
                
                <input type="text" id="link" value="<?php echo $link ?>  ">
	            <div class="row justify-content-between">
              
	                <!-- /col -->
	                <div class="col-xl-12 col-lg-5 align-items-center" >
	                    <div id="wizard_container">
	                        <div id="top-wizard">
	                            <div id="progressbar"></div>
	                        </div>
	                        <!-- /top-wizard -->
	                        <form id="wrapped" method="POST" autocomplete="off">
	                            <input id="website" name="website" type="text" value="">
	                            <!-- Leave for security protection, read docs for details -->
	                            <div id="middle-wizard">
                                    
	                                <div class="step" v-for="(pregunta,indice) of preguntas">
	                                    <h3 class="main_question"><strong>1 de 5</strong>{{pregunta.descripcion}}</h3>
	                                    <div class="review_block_smiles">
	                                    	<ul class="clearfix">
	                                    		<li>
	                                    			 <div class="container_smile">
	                                                    <input type="radio" :id="'very_bad_'+indice" name="question_1" class="required" value="Very bad<" onchange="getVals(this, 'question_1');">
	                                                    <label class="radio smile_1" for="very_bad_1"><span>Muy malo</span></label>
	                                                </div>
	                                    		</li>
	                                    		<li>
	                                    		 <div class="container_smile">
	                                                    <input type="radio" :id="'bad_'+indice" name="question_1" class="required" value="Bad" onchange="getVals(this, 'question_1');">
	                                                    <label class="radio smile_2" for="bad_1"><span>Malo</span></label>
	                                                </div>
	                                    		</li>
	                                    		<li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'average_'+indice" name="question_1" class="required" value="Average" onchange="getVals(this, 'question_1');">
	                                                    <label class="radio smile_3" for="average_1"><span>Normal</span></label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'good_'+indice" name="question_1" class="required" value="Good" onchange="getVals(this, 'question_1');">
	                                                    <label class="radio smile_4" for="good_1"><span>Bueno</span></label>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="container_smile">
	                                                    <input type="radio" :id="'very_good_'+indice" name="question_1" class="required" value="Very Good" onchange="getVals(this, 'question_1');">
	                                                    <label class="radio smile_5" for="very_good_1"><span>Muy Bueno</span></label>
	                                                </div>
	                                            </li>
	                                    	</ul>
	                                    	<div class="row justify-content-between add_bottom_25">
	                                    		<div class="col-4">
	                                    			<em>Muy malo</em>
	                                    		</div>
	                                    		<div class="col-4 text-right">
	                                    			<em>Excelente</em>
	                                    		</div>
	                                    	</div>
	                                    </div>
	                                  
                                    </div>	                               
                                      
	                            </div>
	                            <!-- /middle-wizard -->

	                            <div id="bottom-wizard">
	                                <button type="button" name="backward" class="backward">Prev</button>
	                                <button type="button" name="forward" class="forward">Siguiente</button>
	                                <button type="submit" name="process" class="submit">Submit</button>
	                            </div>
	                            <!-- /bottom-wizard -->

	                        </form>
	                    </div>
	                    <!-- /Wizard container -->
	                </div>
	                <!-- /col -->
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container_centering -->
	    <footer>
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-3">
	                    ©2020 Grupo QWERTY
	                </div>
	                <div class="col-md-9">
	                    <ul class="clearfix">
	                        <li><a href="#" class="animated_link" target="_parent">TREVA</a></li>
	                        <li><a href="#" class="animated_link">Registrarme</a></li>
	                        <li><a href="#" class="animated_link">Ingresar</a></li>
	                    </ul>
	                </div>
	            </div>
	            <!-- /row -->
	        </div>
	        <!-- /container-fluid -->
	    </footer>
	    <!-- /footer -->
	</div>
	<!-- /wrapper_centering -->

	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>	<!-- Scripts -->

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


        <script src="./assets/js/sweetalert.js" async=false defer=false></script>
<script src="./assets/js/axios.js" ></script>
<script src="./assets/js/vue.js"></script>
<script src="src/votacion.js" async=false defer=false></script>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="assets2/js/jquery-3.2.1.min.js"></script>
    <script src="assets2/js/common_scripts.min.js" async=false defer=false></script>
	<script src="assets2/js/functions.js" async=false defer=false></script>

	<!-- Wizard script -->
	<script src="assets2/js/survey_func.js"></script>
    

</body>
</html>
