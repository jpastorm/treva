
<?php
session_start(); 
if (!isset($_SESSION['id_usuario'])) {
  header('Location: index.php' );
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <!-- <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div> -->
          <!-- <p>CT</p> -->
        </a>
        <a href="#" class="simple-text logo-normal">
          Your Logo
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="home.php">
              <i class="nc-icon nc-bank"></i>
              <p>Panel Principal</p>
            </a>
          </li>
          <li class="active ">
            <a href="formulario.php">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>Formularios</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>Estadisticas</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Treva</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Salir</a>
                  <a class="dropdown-item" href="#">Perfil de Usuario</a>
                  <a class="dropdown-item" href="#">also mas aqui</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content" id="app">
      <div class="d-flex justify-content-between">
      <h4><i class="nc-icon nc-single-copy-04"></i>Tus Formularios</h4>
      <button class="btn btn-primary" @click="nuevoFormulario"><i class="nc-icon nc-simple-add"></i> Nuevo Formulario</button>
      </div>
      <hr style="color: #0056b2;" />
        <input type="text" name="" value="<?php echo $_SESSION['id_usuario'] ?>" id="id_usuario" hidden>
        <div class="row d-flex justify-content-around">
          <div class="col-md-2" v-for="formulario in formularios">
            <div class="card d-flex justify-content-center">
              <div class="card-header">
                <h4 class="card-title" style="text-align: center"> {{formulario.titulo}} </h4>
        
              </div>
       
              <div class="card-body" >
                  <!--COMIENZO DE LA TABLA GAAA-->
                
                  <p style="text-align: center; color: #373636; font-style: italic;">Creado el {{formulario.fecha}} a las {{formulario.hora}}</p>
                  
                    <div class="row">
                    
                      <div class="col-md-6">
                      <a :href="'pregunta.php?id_form=' + formulario.id_formulario" class="btn btn-success" style="width: 100%; height: 80% "><i class="fa fa-table fa-5x" style="padding-top:3px"></i><h6></h6>Ver</a>
                      </div>
                      <div class="col-md-6">
                      <a href="#" @click="verlink(formulario.titulo,formulario.link)" class="btn btn-warning" style="width: 100%; height: 80%; text-align: center"><i class="fa fa-globe fa-5x" style="padding-top:3px"></i><h6></h6>Link</a>
                      </div>
               
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                      <a :href="'reportes?id='+formulario.id_formulario" target="_blank" class="btn btn-info" style="width: 100%; height: 80%; text-align: center"><i class="fa fa-area-chart fa-5x" style="padding-top:3px"></i><h6></h6>Datos</a>                      </div>
                      <div class="col-md-6">
                      <a href="#" class="btn btn-danger" style="width: 100%; height: 80%; text-align: center"><i class="fa fa-trash-o fa-5x" style="padding-top:3px"></i><h6></h6>Borrar</a>
                      </div>
            
                    </div>
               
             
                  <!--ACABA LA TABLA GAAA-->
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>


  </div>

</div>

</div>
</div>
</div>


<!--   Core JS Files   -->
<script src="./assets/js/core/jquery.min.js"></script>
<script src="./assets/js/core/popper.min.js"></script>
<script src="./assets/js/core/bootstrap.min.js"></script>
<script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
<script src="./assets/js/sweetalert.js"></script>
<script src="./assets/js/axios.js"></script>
<script src="./assets/js/vue.js"></script>
<script src="src/formulario.js"></script>
</body>

</html>
