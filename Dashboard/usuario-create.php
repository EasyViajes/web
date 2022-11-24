<?php
require "models/Usuario.php";
require "models/Empresa.php";
require "models/Permiso.php";
require "utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /login.php");
}

#conection
require "utils/connection.php";
$conn = create_connection();

if ($_POST != Null) {

  $pwd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $usuario = array(
    'nombre'          => $_POST['nombre'],
    'mail'            => $_POST['mail'],
    'password'        => $pwd_hash,
    'fecha_creacion'  => date('Y-m-d'),
    'fk_estado'       => 1,
    'fk_empresa'      => $_POST['fk_empresa'],
    'fk_permiso'      => $_POST['fk_permiso'],
  );

  if (create_usuario($conn, $usuario)){
    header("location: /usuario-list.php?msg=creationSuccess");
  }else{
    header("location: /usuario-create.php?msg=creationFailed");
  }
}

$empresas = get_empresas($conn);
function print_empresas($data) {
  foreach ($data as $empresa){
    echo "<option value='", $empresa['id'], "'>", $empresa["nombre"], "</option>";
  }
}

$permisos = get_permisos($conn);
function print_permisos($data) {
  foreach ($data as $permiso){
    echo "<option value='", $permiso['id'], "'>", $permiso["nombre"], "</option>";
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Crear Usuario</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="css/classic.css">
    <link rel="stylesheet" href="css/classic.date.css">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/style.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include('navigation/navbar-mobile.php');?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php include('navigation/navbar-desktop.php');?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include('navigation/header-desktop.php');?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <strong>Crear Usuario</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" id="form" enctype="multipart/form-data" class="form-horizontal"
                                    action="empresa-create.php">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nombre" name="nombre" placeholder="Ingrese Nombre"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar Nombre</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Mail</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="email" name="mail" onkeydown="validacionCorreo()"
                                                placeholder="Ingrese Mail" class="form-control" required>
                                                <small class="help-block form-text">Ingresar Correo</small>
                                            <span id="text"></span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Contraseña</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password" name="password"
                                                onkeydown="validacionpwd()" placeholder="Ingrese Contraseña"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar Contraseña</small>
                                            <span id="text2"></span>

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Empresa</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="fk_empresa" id="fk_empresa" class="form-control" required>
                                              <option value="0">---</option>
                                              <?php print_empresas($empresas); ?>
                                            </select>
                                            <small class="help-block form-text">Seleccione Empresa</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Permiso</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="fk_permiso" id="fk_permiso" class="form-control" required>
                                              <option value="0">---</option>
                                              <?php print_permisos($permisos); ?>
                                            </select>
                                            <small class="help-block form-text">Seleccione Permiso</small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" id="button1">
                                            <i class="fa fa-dot-circle-o"></i> Ingresar
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js">
</script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js">
</script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>


    <!--JS-->
    <script src="js/popper.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
    <script src="js/funciones.js"></script>



</body>

</html>
<!-- end document-->
