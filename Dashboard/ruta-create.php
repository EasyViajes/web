<?php
require "../models/Ruta.php";
require "../models/Direccion.php";
require "../models/Vehiculo.php";
require "../utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

if (isset($_POST['precio'])) {
      $ruta = array(
        'hora_salida'         => $_POST['hora_salida'],
        'precio'              => $_POST['precio'],
        'fecha_creacion'      => date('Y-m-d'),
        'direccion_origen'    => $_POST['origen'],
        'direccion_destino'   => $_POST['destino'],
        'fk_estado'           => 1,
        'fk_vehiculo'         => $_POST['fk_vehiculo'],
        'fk_empresa'          => $_SESSION['fk_empresa'],
      );
      if(create_ruta($conn, $ruta)){
        header("location: /Dashboard/ruta-list.php?msg=creation_success");
      }

      else{
        // ruta
        header("location: /Dashboard/ruta-create.php?msg=creationFailed");
      }
}
$vehiculos = get_vehiculos($conn, $_SESSION['fk_empresa']);
function print_vehiculos($data) {
  foreach ($data as $vehiculo){
    echo "<option value='", $vehiculo['id'], "'>", $vehiculo["marca"], ' : ', $vehiculo['patente'], ' | ', $vehiculo['asientos'], " asientos</option>";
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
    <title>Crear Ruta</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

    <!--CSS-->
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
                                <strong>Crear Ruta</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Precio</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="precio" name="precio" placeholder="Ingrese Precio"
                                                class="form-control" min="1" required>
                                            <small class="help-block form-text">Ingresar Precio</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Hora de Salida</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="time" id="hora_salida" name="hora_salida" required>
                                            <label class="form-text text-muted">Ingrese Hora de salida</label>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Origen</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="origen" name="origen" placeholder="Ingrese Origen"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar origen</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Destino</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="destino" name="destino" placeholder="Ingrese Destino"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar destino</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Vehículo</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="fk_vehiculo" id="select-empresa" class="form-control" required>
                                                <option value="0">---</option>
                                                <?php print_vehiculos($vehiculos);?>
                                            </select>
                                            <small class="help-block form-text">Seleccione un Vehículo</small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
