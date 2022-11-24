<?php
function create_vehiculo($conn, $vehiculo){
  try {
    $sql = "INSERT INTO Vehiculo (patente, marca, asientos, mensualidad, fk_estado, fk_empresa) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /vehiculo-create.php?msg=failedPrepStmt");
      exit();
    }

    echo($vehiculo['mensualidad']);
    mysqli_stmt_bind_param($stmt, "ssiiii",
      $vehiculo['patente'],
      $vehiculo['marca'],
      $vehiculo['asientos'],
      $vehiculo['mensualidad'],
      $vehiculo['fk_estado'],
      $vehiculo['fk_empresa'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in createConductor()\n";
    echo $e->getMessage();
    die();
  }
}

function get_vehiculos($conn, $id_empresa){
  $query="SELECT * FROM Vehiculo WHERE fk_empresa=$id_empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  return $rows;
}

function update_vehiculo($conn, $old_vehiculo, $new_vehiculo){
  try {
    $sql = "UPDATE Vehiculo SET patente=?, marca=?, asientos=?, mensualidad=?, fk_estado=?, fk_empresa=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /vehiculo-create.php?msg=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ssiiiii",
      $new_vehiculo['patente'],
      $new_vehiculo['marca'],
      $new_vehiculo['asientos'],
      $new_vehiculo['mensualidad'],
      $new_vehiculo['fk_estado'],
      $new_vehiculo['fk_empresa'],

      $old_vehiculo['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_vehiculo()\n";
    echo $e->getMessage();
    die();
  }
}

function delete_vehiculo($conn, $id){
  $query="DELETE FROM Vehiculo WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
