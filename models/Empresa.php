<?php

function create_empresa($conn, $empresa){
  try {
    $sql = "INSERT INTO Empresa (rut, nombre, fecha_creacion, fk_direccion, fk_estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /empresa-create.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sssii",
      $empresa['rut'],
      $empresa['nombre'],
      $empresa['fecha_creacion'],
      $empresa['fk_direccion'],
      $empresa['fk_estado']
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }

  catch(Exception $e) {
    return false;
  }
}

function get_empresas($conn){
  $query="SELECT * FROM Empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}

function delete_empresa($conn, $id){
  $query="DELETE FROM Empresa WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
