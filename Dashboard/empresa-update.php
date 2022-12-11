<?php
require "../models/Empresa.php";
require "../models/Estado.php";
require "../utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();


$old_empresa = array(
  'id'              => $_POST['id'],
  'rut'             => $_POST['rut'],
  'nombre'          => $_POST['nombre'],
  'direccion'       => $_POST['direccion'],
  'fk_estado'       => $_POST['fk_estado']
);

foreach ($old_empresa as $data){
  if($data == Null) {
    header("location: /Dashboard/empresa-list.php?msg=old_isNull");
  }
}

if ($_POST['update'] == 1) {
  $new_empresa = array(
    'rut'             => $_POST['new_rut'],
    'nombre'          => $_POST['new_nombre'],
    'direccion'       => $_POST['new_direccion'],
    'fk_estado'       => $_POST['new_fk_estado']
  );

  if (update_empresa($conn, $old_empresa, $new_empresa)){
    header("location: /Dashboard/empresa-list.php?msg=updateSuccess");
  }else{
    header("location: /Dashboard/empresa-create.php?msg=updateFailed");
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
    <title>Crear empresa</title>

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
                                <strong>Crear empresa</strong> Formulario
                            </div>
                            <div class="card-body card-block">
                                <form action="empresa-update.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                  <?php
                                  echo "      <input type='hidden' id='id'            name='id'             value='", $old_empresa['id'],"'/>";
                                  echo "      <input type='hidden' id='rut'           name='rut'            value='", $old_empresa['rut'],"'/>";
                                  echo "      <input type='hidden' id='nombre'        name='nombre'         value='", $old_empresa['nombre'],"'/>";
                                  echo "      <input type='hidden' id='direccion'     name='direccion'      value='", $old_empresa['direccion'],"'/>";
                                  echo "      <input type='hidden' id='fecha_creacion'name='fecha_creacion' value='", $old_empresa['fecha_creacion'],"'/>";
                                  echo "      <input type='hidden' id='fk_estado'     name='fk_estado'      value='", $old_empresa['fk_estado'],"'/>";
                                  ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">RUT</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="rut" name="new_rut" placeholder="Ingrese Rut"
                                            value='<?php echo $old_empresa['rut'] ?>'
                                                onkeypress="return isNumber(event)" oninput="checkRut(this)"
                                                class="form-control" required>
                                            <span id="mensaje2"></span>
                                            <small class="form-text text-muted">Ingrese RUT empresa</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label type="text" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="nombre" name="new_nombre" placeholder="Ingrese Nombre"
                                            value='<?php echo $old_empresa['nombre'] ?>'
                                                class="form-control" required>
                                            <small class="help-block form-text">Ingresar Nombre</small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="name-input" class=" form-control-label">Dirección</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="direccion" name="new_direccion"
                                            value='<?php echo $old_empresa['direccion'] ?>'
                                                placeholder="Ingrese Dirección" class="form-control" required>
                                            <small class="help-block form-text">Ingresar Dirección</small>
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

                                    <div class="card-footer">
                                        <input type='hidden' id='update' name='update' value='1'/>
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
    <script src="js/funciones.js"></script>
    <script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>



</body>

</html>
<!-- end document-->
