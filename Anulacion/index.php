<?php
require "../utils/login.php";

session_start();

if (isset($_SESSION["id_cliente"])){
  header("location: /Anulacion/anulacion.php");
}

if (isset($_POST['mail']) || isset($_POST['secreto'])) {
  $mail   = $_POST['mail'];
  $secret = $_POST['secreto'];

  require "../utils/connection.php";

  $conn = create_connection();
  $query = "SELECT * FROM Cliente WHERE mail=?";

  if (!($stmt = mysqli_prepare($conn, $query))) {
    header("location: /Anulacion/index.php?msg=stmtError");
  }

  mysqli_stmt_bind_param($stmt, "s", $mail);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  // close connections
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  if ($secret == $row['secret']){
    $_SESSION["id_cliente"]   = $row["id"];
    $_SESSION["mail_cliente"] = $row["mail"];
    header("location: /Anulacion/anulacion.php");
  }
  header("location: /Anulacion/index.php?msg=loginFailed");
}

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
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Anulacion de pasajes</title>
    <!--css-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <!--Formulario de ingreso de anulacion-->
    <div class="center formulario" id="submit-button">
      
      <h1>Anulacion de pasaje</h1>

      <a href='/'>Volver</a>

      <form method="POST" id="form" action="/Anulacion/index.php">
        <div class="txt_field">
          <input type="text" id="email" name="mail" onkeydown="validacionCorreo()" autocomplete="nope" required />
          <span></span>
          <label>Correo</label>
        </div>
        <div class="txt_field">
          <input type="number" name="secreto" id="idpagotur" onkeydown="validacionnumeros()" autocomplete="nope" required />
          <span></span>
          <label>Codigo Secreto</label>
        </div>

        <input type="submit" name="ingresar" value="ingresar" id="button1" class="btn btn-primary" disabled />
        <br />
        <br />
        <span id="text"></span>
        <span id="text2"></span>
        <div class="space"></div>
      </form>
    <!--</div>-->

    </div>
      </div>
    <script src="js/funciones.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
