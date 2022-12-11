<?php
require "../models/Vehiculo.php";
require "../models/Conductor.php";
require "../models/Estado.php";
require "../utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

$old_vehiculo = array(
  'id'         => $_POST['id'],
  'patente'    => $_POST['patente'],
  'marca'      => $_POST['marca'],
  'asientos'   => $_POST['asientos'],
  'mensualidad'=> $_POST['mensualidad'],
  'fk_estado'  => $_POST['fk_estado'],
  'fk_empresa' => $_POST['fk_empresa'],
);

if ($_POST['update'] == 1) {
  $new_vehiculo = array(
    'patente'         => $_POST['new_patente'],
    'marca'           => $_POST['new_marca'],
    'asientos'        => $_POST['new_asientos'],
    'mensualidad'     => $_POST['new_mensualidad'],
    'fk_estado'       => $_POST['new_fk_estado'],
    'fk_empresa'      => $_SESSION['fk_empresa'],
  );
  
  if (update_vehiculo($conn, $old_vehiculo, $new_vehiculo)){
    header("location: /Dashboard/vehiculo-list.php?msg=successUpdate");
  }else{
    header("location: /Dashboard/vehiculo-create.php?msg=failedUpdate");
  }
}

$conductores = getConductores_all($conn, $_SESSION['fk_empresa']);
function print_conductor($data) {
  foreach ($data as $conductor){
    echo "<option value='", $conductor['id'], "'>", $conductor['nombre'], "</option>";
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
    <title>Actualizar Vehículo</title>

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
                                <strong>Actualizar Vehículo</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                  <?php
                                    echo "      <input type='hidden' id='id'          name='id'           value='", $old_vehiculo['id'],"'/>";
                                    echo "      <input type='hidden' id='patente'     name='patente'      value='", $old_vehiculo['patente'],"'/>";
                                    echo "      <input type='hidden' id='marca'       name='marca'        value='", $old_vehiculo['marca'],"'/>";
                                    echo "      <input type='hidden' id='asientos'    name='asientos'     value='", $old_vehiculo['asientos'],"'/>";
                                    echo "      <input type='hidden' id='mensualidad' name='mensualidad'  value='", $old_vehiculo['mensualidad'],"'/>";
                                    echo "      <input type='hidden' id='fk_empresa'  name='fk_empresa'   value='", $old_vehiculo['fk_empresa'],"'/>";
                                    echo "      <input type='hidden' id='fk_estado'name='fk_estado' value='", $old_vehiculo['fk_estado'],"'/>";
                                  ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Patente</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="patente" name="new_patente" placeholder="Ingrese patente"
                                            value="<?php echo $old_vehiculo['patente']?>"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar patente</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Marca</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="marca" name="new_marca" placeholder="Ingrese marca"
                                            value="<?php echo $old_vehiculo['marca']?>"
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar Marca</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Asientos</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="asientos" name="new_asientos"
                                              value="<?php echo $old_vehiculo['asientos']?>"
                                                placeholder="Ingrese asiento" class="form-control" min="1" max="4" required>
                                            <small class="help-block form-text">Ingresar asientos</small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Estado</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="new_fk_estado" id="fk_estado" class="form-control" required>
                                                <?php print_estados($estados);?>
                                            </select>
                                            <small class="help-block form-text">Seleccione un Estado</small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Mensualidad</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" id="mensualidad" name="new_mensualidad"
                                              value="<?php echo $old_vehiculo['mensualidad']?>"
                                                placeholder="Ingrese mensualidad" class="form-control" min="1" required>
                                            <small class="help-block form-text">Ingresar mensualidad</small>
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
