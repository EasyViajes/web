<?php
require "utils/message-handlers.php";
require "models/Usuario.php";
session_start();


if(!isset($_SESSION["id"])) {
  header("location: /login.php");
}

$id_empresa = $_SESSION['fk_empresa'];

#conection
require "utils/connection.php";
$conn = create_connection();

if ($_POST['update'] == 1) {
  password_hash($_POST['password'], PASSWORD_DEFAULT);
  $user = array(
    'id'        => $_SESSION['id'],
    'nombre'    => $_POST['nombre'],
    'mail'      => $_POST['mail'],
    'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
  );

  if (update_usuario_security($conn, $user)){
      $_SESSION['nombre'] = $user['nombre'];
      $_SESSION['mail'] = $user['mail'];
      header("location: /Dashboard/index.php?msg=successUpdate");
    }
    else{
      header("location: /Dashboard/index.php?msg=failedUpdate");
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
    <title>Seguridad</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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
                                <strong>Seguridad de cuenta</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="security.php" method="post" id="form" enctype="multipart/form-data" class="form-horizontal"
                                    action="security-edit.php">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nombre" name="nombre" placeholder="Ingrese Rut"
                                            value='<?php echo $_SESSION['nombre'] ?>'
                                                class="form-control" required>
                                            <span id="mensaje2"></span>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Correo</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="email" name="mail" onkeydown="validacionCorreo()"
                                            value='<?php echo $_SESSION['mail'] ?>'
                                                placeholder="Ingrese Mail" class="form-control" required>
                                            <small class="help-block form-text">correo</small>
                                            <span id="text"></span>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Estado</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                        <input type="text" id="estado" name="fk_estado" value="Activo" placeholder=""
                                                class="form-control" required disabled>
                                            <small class="help-block form-text">Estado</small>

                                        </div>
                                    </div>
                                    </br>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Contraseña</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="password" id="password" name="password" placeholder=""
                                                class="form-control" required>
                                            <small class="help-block form-text">Contraseña</small>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="card-footer">
                                        <input type='hidden' id='update' name='update' value='1'/>
                                        <button type="submit" class="btn btn-success btn-sm" id="button1">
                                            <i class="fa fa-dot-circle-o"></i> Editar
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/popper.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="js/main.js"></script>
    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>

</body>

</html>
<!-- end document-->
