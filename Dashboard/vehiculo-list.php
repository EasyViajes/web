<?php
require "models/Vehiculo.php";
require "utils/message-handlers.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "utils/connection.php";
$conn = create_connection();

$vehiculos = get_vehiculos($conn, $_SESSION['fk_empresa']);

if ($_POST['id_vehiculo'] != Null) {
    if (delete_vehiculo($conn, $_POST['id_vehiculo'])){
      header("location: /Dashboard/conductor-list.php?msg=successDelete");
    }
    else{
      header("location: /Dashboard/conductor-create.php?msg=failedDelete");
    }
}

function print_vehiculo($data){
  foreach ($data as $vehiculo){
    echo "<tr>";
    echo "  <td></td>";
    echo "  <td>", $vehiculo['id'],"</td>";
    echo "  <td>", $vehiculo['patente'],"</td>";
    echo "  <td>", $vehiculo['marca'],"</td>";
    echo "  <td>", $vehiculo['asientos'],"</td>";
    echo "  <td>", $vehiculo['mensualidad'],"</td>";
    echo "  <td>", $vehiculo['fk_empresa'],"</td>";
    echo "  <td>", $vehiculo['fk_estado'],"</td>";

    echo "  <td>";
    echo "    <form action='vehiculo-update.php' method='POST'>";
    echo "      <input type='hidden' id='id'          name='id'           value='", $vehiculo['id'],"'/>";
    echo "      <input type='hidden' id='patente'     name='patente'      value='", $vehiculo['patente'],"'/>";
    echo "      <input type='hidden' id='marca'       name='marca'        value='", $vehiculo['marca'],"'/>";
    echo "      <input type='hidden' id='asientos'    name='asientos'     value='", $vehiculo['asientos'],"'/>";
    echo "      <input type='hidden' id='mensualidad' name='mensualidad'  value='", $vehiculo['mensualidad'],"'/>";
    echo "      <input type='hidden' id='fk_empresa'  name='fk_empresa'   value='", $vehiculo['fk_empresa'],"'/>";
    echo "      <input type='hidden' id='fk_estado'name='fk_estado' value='", $vehiculo['fk_estado'],"'/>";
    echo "      <button type='submit' class='btn btn-success btn-modal text-center'>";
    echo "        <i class='fa-regular fa-pen-to-square'></i>'";
    echo "      </button>";
    echo "    </form>";
    echo "  </td>";

    echo "  <td>";
    echo "    <form action='vehiculo-list.php' method='POST'>";
    echo "      <input type='hidden' id='id_conductor' name='id_vehiculo' value='", $vehiculo['id'],"'/>";
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
    <title>Lista Vehículo</title>

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
                                <h4>Tabla de Vehiculos</h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">Más</th>
                                            <th>#</th>
                                            <th data-priority="2">Patente</th>
                                            <th data-priority="3">Marca</th>
                                            <th>Asientos</th>
                                            <th>Mensualidad</th>
                                            <th>Empresa</th>
                                            <th>Conductor</th>
                                            <th data-priority="4">Editar</th>
                                            <th data-priority="5">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php  print_vehiculo($vehiculos);?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>

            <!-- Modal Editar conductor-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="form-cond">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    Editar Vehiculo
                                </h5>
                                <br />


                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                                <h6 class="modal-title" id="staticBackdropLabel">
                                    <h5 class="modal-title">Vehiculo: <label class="pasaje"></label></h5>
                                </h6>
                                <br />
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="patente">Patente</label>
                                        <input name="patente" id="patente" type="text" class="form-control"
                                             autocomplete="nope" required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="marca">Marca</label>
                                        <input name="marca" id="marca" type="text" class="form-control"
                                             autocomplete="nope" required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="asiento">Asientos</label>
                                        <input name="asiento" id="asiento" type="text" class="form-control"
                                             autocomplete="nope" required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="serie">Numero de serie</label>
                                        <input name="serie" id="serie" type="number" class="form-control"
                                            onkeypress="return isNumber(event)" autocomplete="nope" required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="mensualidad">Mensualidad</label>
                                        <input name="mensualidad" id="mensualidad" type="number" class="form-control"
                                            onkeypress="return isNumber(event)" autocomplete="nope" required />

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
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="ruta">Ruta</label>
                                        <select name="select" id="select" class="form-control" required>
                                            <option value="0">Seleccione una ruta</option>
                                            <option value="1">Los heroes - Las condes</option>
                                            <option value="2">Estación central - Los heroes</option>
                                            <option value="3">Puente alto - Maipú</option>
                                            <option value="4">San bernarno - Santiago</option>
                                        </select>

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row mb-4">
                                    <input type="submit" id="button2" name="ingresar" class="btn btn-primary" />

                                    <br />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger">
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
