<?php
require "$_SERVER[DOCUMENT_ROOT]/models/Venta.php";

#conection
require "$_SERVER[DOCUMENT_ROOT]/utils/connection.php";
$conn = create_connection();

$venta = array(
  'fecha_compra'  => date('Y-m-d'),
  'fk_estado'     => 1,
  'fk_ruta'       => $_GET['id_ruta'],
  'fk_empresa'    => $_GET['id_empresa'],
);

if (create_venta($conn, $venta)){
  header("location: /index.php?msg=sucess");
}
else{
  header("location: /index.php?msg=failed");
}
