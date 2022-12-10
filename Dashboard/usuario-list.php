<?php
require "../models/Usuario.php";

session_start();

if(!isset($_SESSION['id'])) {
  header("location: /Dashboard/login.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();

$usuarios = get_all_usuarios($conn);

if (isset($_POST['id_usuario'])) {
    if (delete_usuario($conn, $_POST['id_conductor'])){
      header("location: /Dashboard/usuario-list.php?msg=successDelete");
    }
    else{
      header("location: /Dashboard/usuario-create.php?msg=failedDelete");
    }
}

function print_usuario($data){
  foreach ($data as $usuario){
    echo "<tr>";
    echo "  <td></td>";
    echo "  <td>", $usuario['id'],"</td>";
    echo "  <td>", $usuario['mail'],"</td>";
    echo "  <td>", $usuario['nombre'],"</td>";
    echo "  <td>", $usuario['fk_estado'],"</td>";
    echo "  <td>", $usuario['fk_empresa'],"</td>";
    echo "  <td>", $usuario['fk_permiso'],"</td>";
    echo "  <td>", $usuario['fecha_creacion'],"</td>";

    echo "  <td>";
    echo "    <form action='usuario-update.php' method='POST'>";
    echo "      <input type='hidden' id='id' name='id' value='", $usuario['id'],"'/>";
    echo "      <input type='hidden' id='mail' name='mail' value='", $usuario['mail'],"'/>";
    echo "      <input type='hidden' id='nombre' name='nombre' value='", $usuario['nombre'],"'/>";
    echo "      <input type='hidden' id='fk_estado' name='fk_estado' value='", $usuario['fk_estado'],"'/>";
    echo "      <input type='hidden' id='fk_empresa' name='fk_empresa' value='", $usuario['fk_empresa'],"'/>";
    echo "      <input type='hidden' id='fk_permiso' name='fk_permiso' value='", $usuario['fk_permiso'],"'/>";
    echo "      <input type='hidden' id='fecha_creacion' name='fecha_creacion' value='", $usuario['fecha_creacion'],"'/>";
    echo "      <button type='submit' class='btn btn-success btn-modal text-center'>";
    echo "        <i class='fa-regular fa-pen-to-square'></i>'";
    echo "      </button>";
    echo "    </form>";
    echo "  </td>";

    echo "  <td>";
    echo "    <form action='usuario-list.php' method='POST'>";
    echo "      <input type='hidden' id='id_usuario' name='id_usuario' value='", $usuario['id'],"'/>";
    echo "      <button type='submit' class='btn btn-danger btn-modal text-center'>";
    echo "      <i class='fa-solid fa-trash'></i>'";
    echo "    </button>";
    echo "    </form>";
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
    <title>Lista Usuario</title>

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
                                <h4>Tabla de Usuarios</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table_id">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">Más</th>
                                            <th>#</th>
                                            <th>Mail</th>
                                            <th data-priority="2">Nombre</th>
                                            <th>Estado</th>
                                            <th>Usuario</th>
                                            <th>Permisos</th>
                                            <th>Fecha de Creación</th>
                                            <th data-priority="3">Acción</th>
                                            <th data-priority="4">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php  print_usuario($usuarios);?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>

            <!-- Modal Editar Usuario-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="form-cond">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    Editar Usuario
                                </h5>
                                <br />


                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                                <h6 class="modal-title" id="staticBackdropLabel">
                                    <h5 class="modal-title">Usuario: <label class="pasaje"></label></h5>
                                </h6>
                                <br />
                                <div class="col">
                                    <div class="form-outline validacion">
                                        <label class="form-label" for="rut">Rut</label>
                                        <input name="rut" id="rut" type="text" class="form-control"
                                            onkeypress="return isNumber(event)" oninput="checkRut(this)"
                                            autocomplete="nope" required />

                                        <span id="mensaje2"></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline validacion">
                                            <label class="form-label" for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre"
                                                class="form-control" pattern="[a-zA-Z'-'\s]*"
                                                title="No se aceptan numeros" autocomplete="nope" required />
                                            <span id="mensaje1"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline validacion">
                                            <label class="form-label" for="direccion">Dirección</label>
                                            <input type="text" id="direccion" name="direccion"
                                                class="form-control" title="ingrese una dirección" autocomplete="nope"
                                                required />
                                            <span id="mensaje5"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline validacion">
                                            <label class="form-label" for="direccion">Fecha ingreso/salida</label>
                                            <div class="input-group input-daterange">
                                                <input type="text" id="start" class="form-control text-left mr-2"
                                                    placeholder="Ingreso" required>
                                                <span class="fa fa-calendar" id="fa-1"></span>
                                                <input type="text" id="end" class="form-control text-left ml-2"
                                                    placeholder="Salida" required>
                                                <span class="fa fa-calendar" id="fa-2"></span>
                                            </div>
                                            <br />
                                        </div>
                                    </div>
                                    <input type="submit" id="button1" name="ingresar" class="btn btn-primary" />

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
