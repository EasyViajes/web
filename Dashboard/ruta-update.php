<?php
require "../models/Ruta.php";
require "../models/Vehiculo.php";
require "../models/Estado.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

$old_ruta = array(
  'id'                => $_POST['id'],
  'hora_salida'       => $_POST['hora_salida'],
  'precio'            => $_POST['precio'],
  'fecha_creacion'    => $_POST['fecha_creacion'],
  'direccion_origen'  => $_POST['direccion_origen'],
  'direccion_destino' => $_POST['direccion_destino'],
  'fk_estado'         => $_POST['fk_estado'],
  'fk_vehiculo'       => $_POST['fk_vehiculo'],
  'fk_empresa'        => $_POST['fk_empresa'],
);

foreach ($old_ruta as $data){
  if($data == Null) {
    header("location: /Dashboard/ruta-list.php?msg=old_hasNull");
  }
}

if (isset($_POST['update']) && $_POST['update'] == 1) {
  $new_ruta = array(
    'hora_salida'         => $_POST['new_hora_salida'],
    'precio'              => $_POST['new_precio'],
    'direccion_origen'    => $_POST['new_direccion_origen'],
    'direccion_destino'   => $_POST['new_direccion_destino'],
    'fk_estado'           => $_POST['new_fk_estado'],
    'fk_vehiculo'         => $_POST['new_fk_vehiculo'],
    'fk_empresa'          => $_SESSION['fk_empresa'],
  );

  if(update_ruta($conn, $old_ruta, $new_ruta)){
    header("location: /Dashboard/ruta-list.php");
  }

  else{
    // ruta
    header("location: /Dashboard/ruta-list.php?msg=failedUpdate");
  }
}

$vehiculos = get_vehiculos($conn, $_SESSION['fk_empresa']);
function print_vehiculos($data) {
  foreach ($data as $vehiculo){
    echo "<option value='", $vehiculo['id'], "'>", $vehiculo["marca"], ' : ', $vehiculo['patente'], ' | ', $vehiculo['asientos'], " asientos</option>";
  }
}

$estados = get_estados($conn);
function print_estados($data) {
  foreach ($data as $estado){
    echo "<option value='", $estado['id'], "'>", $estado["nombre"], "</option>";
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
    <title>Actualizar Ruta</title>

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
                                <strong>Actualizar Ruta</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="ruta-update.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <?php
                                  echo "<input type='hidden' id='id' name='id' value='", $old_ruta['id'],"'/>";
                                  echo "<input type='hidden' id='hora_salida' name='hora_salida' value='", $old_ruta['hora_salida'],"'/>";
                                  echo "<input type='hidden' id='precio' name='precio' value='", $old_ruta['precio'],"'/>";
                                  echo "<input type='hidden' id='fecha_creacion' name='fecha_creacion' value='", $old_ruta['fecha_creacion'],"'/>";
                                  echo "<input type='hidden' id='direccion_origen' name='direccion_origen' value='", $old_ruta['direccion_origen'],"'/>";
                                  echo "<input type='hidden' id='direccion_destino' name='direccion_destino' value='", $old_ruta['direccion_destino'],"'/>";
                                  echo "<input type='hidden' id='fk_estado' name='fk_estado' value='", $old_ruta['fk_estado'],"'/>";
                                  echo "<input type='hidden' id='fk_empresa' name='fk_empresa' value='", $old_ruta['fk_empresa'],"'/>";
                                  echo "<input type='hidden' id='fk_vehiculo' name='fk_vehiculo' value='", $old_ruta['fk_vehiculo'],"'/>";
                                ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Precio</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="precio" name="new_precio" placeholder="Ingrese Precio" 
                                            value="<?php echo $old_ruta['precio'] ?>"
                                                class="form-control" min="1" required>
                                            <small class="help-block form-text">Ingresar Precio</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Hora de Salida</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="time" id="hora_salida" name="new_hora_salida"
                                            value="<?php echo $old_ruta['hora_salida'] ?>"
                                            required>
                                            <label class="form-text text-muted">Ingrese Hora de salida</label>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Origen</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="origen" name="new_direccion_origen" placeholder="Ingrese Origen"
                                            value="<?php echo $old_ruta['direccion_origen'] ?>"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar origen</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Destino</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="destino" name="new_direccion_destino" placeholder="Ingrese Destino"
                                            value="<?php echo $old_ruta['direccion_destino'] ?>"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar destino</small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Estado</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="new_fk_estado" id="select-empresa" class="form-control">
                                                <option value="0">---</option>
                                                <?php print_estados($estados);?>
                                            </select>
                                            <small class="help-block form-text">Seleccione un Estado</small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Vehiculo</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="new_fk_vehiculo" id="select-empresa" class="form-control">
                                                <option value="0">---</option>
                                                <?php print_vehiculos($vehiculos);?>
                                            </select>
                                            <small class="help-block form-text">Seleccione un Vehiculo</small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type='hidden' id='update' name='update' value='1'/>
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
