<?php
require "../models/Conductor.php";
require "../models/Vehiculo.php";
require "../utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

if ($_POST != Null) {
    $conductor = array(
      'rut'           => $_POST['rut'],
      'nombre'        => $_POST['nombre'],
      'direccion'     => $_POST['direccion'],
      'fecha_ingreso' => $_POST['fecha_ingreso'],
      'fin_contrato'  => $_POST['fin_contrato'],
      'fk_estado'     => 1,
      'fk_empresa'    => $_SESSION['fk_empresa'],
      'fk_vehiculo'   => $_POST['fk_vehiculo'],
    );

    if (create_conductor($conn, $conductor)){
      header("location: /Dashboard/conductor-list.php?msg=successCreation");
    }
    else{
      header("location: /Dashboard/conductor-create.php?msg=failedCreation");
    }
}

$vehiculos = get_vehiculos($conn, $_SESSION['fk_empresa']);
function print_vehiculos($data) {
  foreach ($data as $vehiculo){
    echo "<option value='", $vehiculo['id'], "'>", $vehiculo["marca"], ': ', $vehiculo['patente'], "</option>";
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
    <title>Crear Conductor</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="css/classic.css">
    <link rel="stylesheet" href="css/classic.date.css">
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
                                <strong>Crear Conductor</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"
                                    action="conductor-create.php">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">RUT</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="rut" name="rut" placeholder="Ingrese Rut"
                                                onkeypress="return isNumber(event)" oninput="checkRut(this)"
                                                class="form-control" required>
                                            <span id="mensaje2"></span>
                                            <small class="form-text text-muted">Ingrese RUT</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nombre" name="nombre" placeholder="Ingrese Nombre"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar Nombre</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Direcciòn</label>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <select name="region" id="regiones" class="form-control" required>
                                                <option value="0">---</option>
                                               
                                            </select>
                                            <small class="help-block form-text">Seleccione una region</small>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <select name="comuna" id="comunas" class="form-control" required>
                                                <option value='0'>---</option>
                                               
                                            </select>
                                            <small class="help-block form-text">Seleccione una comuna</small>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <input type="text" id="calle" name="direccion" placeholder="Ingrese Calle"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingrese Calle</small>
                                        </div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="Ingreso-input" class=" form-control-label">Fecha
                                                Ingreso/Fin de contrato</label>
                                        </div>
                                        <div class="col-12 col-md-9">

                                            <div class="form-group">
                                                <label for="input_from">Desde</label>
                                                <input type="text" name="fecha_ingreso" class="form-control"
                                                    id="input_from" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_to">Fin de contrato</label>
                                                <input type="text" name="fin_contrato" class="form-control"
                                                    id="input_to"  required>
                                            </div>

                                            <small class="help-block form-text">Seleccione Fecha de
                                                ingreso/Fin de contrato</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Vehiculo</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="fk_vehiculo" id="fk_vehiculo" class="form-control" required>
                                                <option value='0'>---</option>
                                                <?php print_vehiculos($vehiculos);?>
                                            </select>
                                            <small class="help-block form-text">Seleccione un Vehiculo</small>
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
    <script src="js/funciones.js"></script>
    <script src="js/main.js"></script>
    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>

</body>

</html>
<!-- end document-->
