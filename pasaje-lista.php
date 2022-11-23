<?php
require "$_SERVER[DOCUMENT_ROOT]/models/Ruta.php";

#conection
require "$_SERVER[DOCUMENT_ROOT]/utils/connection.php";
$conn = create_connection();

$rutas = get_all_rutas($conn);

function print_rutas($data){
  foreach ($data as $ruta){
    echo "<tr>";
    echo "  <td>", $ruta['id'], "</td>";
    echo "  <td>", $ruta['fk_empresa'], "</td>";
    echo "  <td>", $ruta['direccion_origen'], "</td>";
    echo "  <td>", $ruta['direccion_destino'], "</td>";
    echo "  <td>", $ruta['hora_salida'], "</td>";
    echo "  <td>", $ruta['precio'], "</td>";
    echo "  <td>";
    echo "    <form action='compra.php' method='POST'>";
    echo "      <input type='hidden' id='id' name='id' value='", $ruta['id'],"'/>";
    echo "      <input type='hidden' id='dir' name='direccion_origen' value='", $ruta['direccion_origen'],"'/>";
    echo "      <input type='hidden' id='dir' name='direccion_destino' value='", $ruta['direccion_destino'],"'/>";
    echo "      <input type='hidden' id='hr' name='hora_salida' value='", $ruta['hora_salida'],"'/>";
    echo "      <input type='hidden' id='precio' name='precio' value='", $ruta['precio'],"'/>";
    echo '      <button type="submit" class="btn btn-success">Comprar</button>';
    echo "    </form>";
    echo "</tr>";

  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>EasyViajes | Lista pasajes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('navigation/navbar.php');?>

    <!--tabla de para mostrar pasajes -->
    <section class="ftco-section">
        <div class="table-responsive-lg">
            <div class="container">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Origen</th>
                            <th scope="col">Destino</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Precio</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php print_rutas($rutas)?>
                    </tbody>
                </table>
            </div>
        </div>
        </div><br>
    </section>

    <?php include('navigation/footer.php');?>

    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
