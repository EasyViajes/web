<?php

# messages
if(isset($_GET["msg"])){
  $msg = $_GET["msg"];

  switch($msg){
  case "successCreation":
    $display = 'Creacion exitosa.';
    break;

  case "failedCreation":
    $display = 'No se ha guardado.';
    break;

  case "sessionClosed":
    $display = 'Sesion cerrada.';
    break;

  default:
    $display = false;
    break;
  }

  display($display);
}

# errors
if(isset($_GET["err"])){
  $err = $_GET["err"];

  switch($err){
  case "failedPrepStmt":
    $display = 'ERROR: Prepare statement failed.';
    break;

  default:
    $display = false;
    break;
  }
  display($display);
}

function display($display){
  if($display){
    echo "<script> alert('$display')</script>;";
  }
}
