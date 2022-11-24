<?php
require "utils/login.php";

session_start();

if (isset($_SESSION["id"])){
  header("location: /Dashboard/index.php");
}

if (isset($_POST['email']) || isset($_POST['password'])) {
  $mail = $_POST['email'];
  $pwd = $_POST['password'];
  login($mail, $pwd);
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
    <title>Iniciar Sesión</title>

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
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <!--volver-->
                        <div class="d-flex justify-content-between" style="margin-bottom: 20px">
                          <p><a href="http://easyviajes.cl" class="text-primary">Volver</a></p>
                        </div>
                        <div class="login-form">
                            <form method="post" id="form" action="login.php">
                                <div class="txt_field">
                                    <input type="text" id="email" name="email" onkeydown="validacionCorreo()"
                                        autocomplete="nope" required />
                                    <span></span>
                                    <label>Correo</label>
                                </div>

                                <div class="txt_field">
                                    <input type="password" name="password" id="password" onkeydown="validacionpwd()"
                                        autocomplete="nope" required />
                                    <span></span>
                                    <label>Contraseña</label>
                                </div>

                                <!--olvidaste tu pwd-->
                                <div class="d-flex justify-content-between" style="display: flex; width: 100%">
                                  <p><a href="forgot-pwd.php" class="text-secondary">Olvidaste tu Contraseña?</a></p>
                                </div>

                                <!--Ingresar-->
                                <input type="submit" name="ingresar" value="ingresar" id="button1"
                                    class="btn btn-primary" disabled />
                                <br />
                                <br />
                                <span id="text"></span>
                                <br />
                                <span id="text2"></span>
                            </form>
                        </div>
                    </div>
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

    <!--JS-->
    <script src="js/main.js"></script>
    <script src="js/funciones.js"></script>

</body>

</html>
<!-- end document-->
