<?php
function login($mail, $pwd)
{
  #conection
  require "utils/connection.php";
  $conn = create_connection();

  $query = "SELECT * FROM Usuario WHERE mail=?";

  if (!($stmt = mysqli_prepare($conn, $query))) {
    echo "Error while preparing statement.";
    echo "utils/login.php login()";
    die(); }

  mysqli_stmt_bind_param($stmt, "s", $mail);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  // close connections
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  if (password_verify($pwd, $row['password'])){
    $_SESSION["id"]         =  $row["id"];
    $_SESSION["nombre"]     =  $row["nombre"];
    $_SESSION["mail"]       =  $row["mail"];
    $_SESSION["fecha_creacion"] =  $row["fecha_creacion"];

    $_SESSION["fk_estado"]  =  $row["fk_estado"];
    $_SESSION["fk_empresa"] =  $row["fk_empresa"];
    $_SESSION["fk_permiso"] =  $row["fk_permiso"];
    header("location: /Dashboard/index.php");
  }
  else{
    header("location: /Dashboard/login.php?msg=loginFailed");
  }
}

function logout(){
}
