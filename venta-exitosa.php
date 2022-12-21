<?php
#conection
require "./utils/connection.php";
$conn = create_connection();

# venta
require "./models/Venta.php";
# cliente
require "./models/Cliente.php";

# check if mail exists
$cliente = get_cliente_by_mail($conn, $_GET['mail']);
$id_cliente = $cliente['id'];

if(!isset($cliente['id'])){
  $cliente = array(
    'mail'          => $_GET['mail'],
    'secret'       => generate_secret(),
    'fecha_creacion'=> date('Y-m-d'),
  );

  $cliente = create_cliente($conn, $cliente);
  $id_cliente = $cliente;
}

$venta = array(
  'fecha_compra'  => date('Y-m-d h:i'),
  'fk_cliente'    => $id_cliente,
  'fk_estado'     => 1,
  'fk_ruta'       => $_GET['id_ruta'],
  'fk_empresa'    => $_GET['id_empresa'],
);

if (create_venta($conn, $venta)){
	echo "<h1>Compra exitosa.</h1>";
	echo "Por favor guarde su codigo secreto.";
	echo "<br>";
	echo "<br>";
	echo "Email: ". $cliente['mail'];
	echo "<br>";
	echo "Secreto: ". $cliente['secret'];
	echo "<br>";
	echo "<br>";
  	echo "<a href='/index.php?msg=sucessCreation'> Volver... </a>";
	echo "<br>";
	die();
  header("location: /index.php?msg=sucessCreation");
}
else{
  header("location: /index.php?msg=failedCreation");
}

