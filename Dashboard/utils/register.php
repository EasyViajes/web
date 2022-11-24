<?php

function register($nombre, $mail, $pwd, $id_empresa){
  require "$_SERVER[DOCUMENT_ROOT]/models/Usuario.php";
  require "$_SERVER[DOCUMENT_ROOT]/utils/connection.php";
  $conn = create_connection();

  $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
  $today = date('d-m-y h:i:s');
  $estado = 1; // is active

  $user = array(
    "nombre" => $nombre,
    "mail" => $mail,
    "pwd" => $pwd_hash,
    "fecha_creacion" => $today,
    "fk_estado" => $estado,
    "fk_empresa" => $fk_empresa,
  );

  if (createUser($conn, $user)) { 
    header("location: /login.php?msg=registerSuccess");
  }
  else{
    header("location: /registro.php?msg=registerFailed");
  }

}
