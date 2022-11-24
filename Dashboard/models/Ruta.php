<?php

function create_ruta($conn, $ruta){
  try {
    $sql = "INSERT INTO Ruta (hora_salida, precio, fecha_creacion, direccion_origen, direccion_destino, fk_estado, fk_empresa, fk_vehiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/ruta-create.php?err=failedPrepStmt");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sisssiii",
      $ruta['hora_salida'],
      $ruta['precio'],
      $ruta['fecha_creacion'],
      $ruta['direccion_origen'],
      $ruta['direccion_destino'],
      $ruta['fk_estado'],
      $ruta['fk_empresa'],
      $ruta['fk_vehiculo'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in createRuta()\n";
    echo $e->getMessage();
    die();
  }
}

function get_rutas($conn, $id_empresa){
  $query="SELECT * FROM Ruta WHERE fk_empresa=$id_empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  return $rows;
}

function getRuta_pasaje($conn, $id_ruta){
  $query="SELECT * FROM Ruta WHERE id=$id_ruta";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }

  mysqli_close($conn);
  return $rows;
}

function update_ruta($conn, $old_ruta, $new_ruta){
  try {
    $sql = "UPDATE Ruta SET hora_salida=?, precio=?, direccion_origen=?, direccion_destino=?, fk_estado=?, fk_vehiculo=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/ruta-create.php?msg=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sissiii",
      $new_ruta['hora_salida'],
      $new_ruta['precio'],
      $new_ruta['direccion_origen'],
      $new_ruta['direccion_destino'],
      $new_ruta['fk_estado'],
      $new_ruta['fk_vehiculo'],

      $old_ruta['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_ruta()\n";
    echo $e->getMessage();
    die();
  }
}

function delete_ruta($conn, $id){
  $query="DELETE FROM Ruta WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
