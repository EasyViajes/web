<?php
require "../models/Ruta.php";
require "../utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

$rutas = get_rutas($conn, $_SESSION['fk_empresa']);

if (isset($_POST['id_ruta'])) {
    if (delete_ruta($conn, $_POST['id_ruta'])){
      header("location: /Dashboard/ruta-list.php?msg=successDelete");
    }
    else{
      header("location: /Dashboard/ruta-create.php?msg=failedDelete");
    }
}

function print_rutas($data){
  foreach ($data as $ruta){
    echo "<tr>";
    echo "  <td></td>";
    echo "  <td>", $ruta['id'], "</td>";
    echo "  <td>", $ruta['dia'], ' ', $ruta['hora_salida'], "</td>";
    echo "  <td>", $ruta['precio'], "</td>";
    echo "  <td>", $ruta['direccion_origen'], " - ", $ruta['direccion_destino'], "</td>";
    echo "  <td>", $ruta['fk_vehiculo'], "</td>";
    echo "  <td>", $ruta['fecha_creacion'], "</td>";
    echo "  <td>", $ruta['fk_estado'], "</td>";
    echo "  <td>", $ruta['fk_empresa'], "</td>";
    

    echo "  <td>";
    echo "    <form action='/Dashboard/ruta-update.php' method='POST'>";
    echo "      <input type='hidden' id='id' name='id' value='", $ruta['id'],"'/>";
    echo "      <input type='hidden' id='hora_salida' name='hora_salida' value='", $ruta['hora_salida'],"'/>";
    echo "      <input type='hidden' id='dia' name='dia' value='", $ruta['dia'],"'/>";
    echo "      <input type='hidden' id='precio' name='precio' value='", $ruta['precio'],"'/>";
    echo "      <input type='hidden' id='fecha_creacion' name='fecha_creacion' value='", $ruta['fecha_creacion'],"'/>";
    echo "      <input type='hidden' id='direccion_origen' name='direccion_origen' value='", $ruta['direccion_origen'],"'/>";
    echo "      <input type='hidden' id='direccion_destino' name='direccion_destino' value='", $ruta['direccion_destino'],"'/>";
    echo "      <input type='hidden' id='fk_estado' name='fk_estado' value='", $ruta['fk_estado'],"'/>";
    echo "      <input type='hidden' id='fk_empresa' name='fk_empresa' value='", $ruta['fk_empresa'],"'/>";
    echo "      <input type='hidden' id='fk_vehiculo' name='fk_vehiculo' value='", $ruta['fk_vehiculo'],"'/>";
    echo "      <button type='submit' class='btn btn-success btn-modal text-center'>";
    echo "        <i class='fa-regular fa-pen-to-square'></i>'";
    echo "      </button>";
    echo "    </form>";
    echo "  </td>";

    echo "  <td>";
    echo "    <form action='ruta-list.php' method='POST'>";
    echo "      <input type='hidden' id='id_ruta' name='id_ruta' value='", $ruta['id'],"'/>";
    echo "      <button type='submit' class='btn btn-danger btn-modal text-center'>";
    echo "      <i class='fa-solid fa-trash'></i>'";
    echo "    </button>";
    echo "    </form>";
    echo "  </td>";

    echo "</tr>";

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
    <title>Lista Conductor</title>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
                                <h4>Tabla de Rutas</h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">Más</th>
                                            <th>#</th>
                                            <th data-priority="2">Salida</th>
                                            <th>Precio</th>
                                            <th>Ruta</th>
                                            <th data-priority="3">Vehículo</th>
                                            <th>Fecha de creación</th>
                                            <th>Estado</th>
                                            <th>Empresa</th>
                                            <th data-priority="4">Editar</th>
                                            <th data-priority="5">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php print_rutas($rutas) ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>

            <!-- Modal Editar ruta-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="form-cond">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    Editar Ruta
                                </h5>
                                <br />


                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                                <h6 class="modal-title" id="staticBackdropLabel">
                                    <h5 class="modal-title">Ruta: <label class="pasaje"></label></h5>
                                </h6>
                                <br />
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="precio">Precio</label>
                                        <input name="precio" id="precio" value="20.330.184-7" type="number"
                                            class="form-control" onkeypress="return isNumber(event)" autocomplete="nope"
                                            required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="ruta">Ruta</label>
                                        <select name="select" id="select" class="form-control" required>
                                            <option value="1">Seleccione una ruta</option>
                                            <option value="1">Los heroes - Las condes</option>
                                            <option value="2">Estación central - Los heroes</option>
                                            <option value="3">Puente alto - Maipú</option>
                                            <option value="4">San bernarno - Santiago</option>
                                        </select>

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="empresa">Empresa</label>
                                        <select name="select" id="select" class="form-control" required>
                                            <option value="0">Seleccione una empresa</option>
                                            <option value="1">Colectivos Felipe</option>
                                            <option value="2">Cooperativa Simón</option>
                                            <option value="3">Transportes Antonia</option>
                                            <option value="4">Capybara Transports</option>
                                        </select>

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-4">
                                    <input type="submit" id="button1" name="ingresar" class="btn btn-primary"
                                         />

                                    <br />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" >
                                        Borrar
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
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
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

        <!-- Datatable Dependency start -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
        </script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
        </script>


        <!-- Datatable Dependency end -->
</body>

</html>
<!-- end document-->
