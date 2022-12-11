<?php
session_start();

if(!isset($_SESSION["id_cliente"])) {
  header("location: /Anulacion/index.php");
}

#conection
require "../utils/connection.php";
$conn = create_connection();


#ventas
include "../models/Venta.php";
$ventas = get_ventas_cliente($conn, $_SESSION['id_cliente']);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
      name="viewport"
    />
    <title>Anulacion de pasajes</title>


    <!--Font Awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!--css-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <!--Pantalla de carga-->
    <div class="loader">
        <div></div>
    </div>
    <!--header principal de la seccion-->
    <span class="loader"><span class="loader-inner"></span></span>
    <div
      class="container col-md-12 p-5 "
      style="background-color: white; border-radius: 12px"
    >
      <h1 class="fs-4 pt-3">Bienvenido</h1>
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/Anulacion/logout.php">Volver</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pasajes</li>
        </ol>
      </nav>
      <h1 class="fs-4">Condiciones de anulación</h1>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;La devolución se realizara
        por el 85 % del valor.
      </p>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;El reembolso puede tardar
        hasta 5 dias habiles en caso de débito y un máximo de 10 días hábiles en
        caso de crédito.
      </p>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;Puedes anular hasta algunas
        horas antes de la salida del servicio, para mayor información haz click
        aqui.
      </p>

      <!--Tabla con los datos de la compra y devolucion-->
      
        <div class="container table-responsive">
          <table class="table table-striped align-content-center">

<?php
if(count($ventas) == 0){
  echo "<h1>No hay pasajes</h1>";
}else {
?>
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha de Compra</th>
                <th scope="col">Ruta</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr>

<?php
  foreach($ventas as $venta){
    echo "<td>", $venta['id'], "</td>";
    echo "<td>", $venta['fecha_compra'], "</td>";
    echo "<td>", $venta['fk_ruta'], "</td>";
    echo "<td>", $venta['fk_estado'], "</td>";
  }
}
?>
              </tr>
            </tbody>
          </table>
        </div>

    <!--js-->
    <script src="js/funciones.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
