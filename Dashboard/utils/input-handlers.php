<?php

// empty input
function emptyInput($rut, $nombreEmpresa, $passwd, $passwdRepeat, $direccion){
  $result = false;

  if(empty($rut) || empty($nombreEmpresa) || empty($passwd) || empty($passwdRepeat) || empty($direccion)){
    $result = true;
  }else{
    $result = false;
  }
  return $result;
}

// passwd verification
function passwdMatch($passwd, $passwdRepeat){
  $result = true;
  if($passwd !== $passwdRepeat){
    $result = true;
  }else{
    $result = false;
  }
  return $result;
}

function rutExists($conn, $rut){

  $sql = "SELECT * FROM empresa WHERE RUT = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../form-signup.php?error=queryError");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $rut);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)){
    return $row;
  }else{
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

//Login Functions
// Should be changed ro use ...*kwargs or something similar
function emptyInputLogin($rut, $passwd){
  $result = false;

  if(empty($rut) || empty($passwd)){
    $result = true;
  }else{
    $result = false;
  }
  return $result;
}

