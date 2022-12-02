<?php
#conection
require "utils/connection.php";
$conn = create_connection();

# venta
require "models/Venta.php";

# cliente
require "models/Cliente.php";

# check if mail exists
$user_id = get_cliente_by_mail($conn, $_GET['mail']);

var_dump($user_id);
die();

if(!$user_id){
  $user_id = create_cliente($conn, $_GET['mail']);
}

$venta = array(
  'fecha_compra'  => date('Y-m-d h:i:a'),
  'fk_cliente'    => $user_id,
  'fk_estado'     => 1,
  'fk_ruta'       => $_GET['id_ruta'],
  'fk_empresa'    => $_GET['id_empresa'],
);

if (create_venta($conn, $venta)){
  header("location: /index.php?msg=sucessCreation");
}
else{
  header("location: /index.php?msg=failedCreation");
}

