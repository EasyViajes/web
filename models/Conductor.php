<?php
function create_conductor($conn, $conductor){
  try {
    $sql = "INSERT INTO Conductor (rut, nombre, direccion, fecha_ingreso, fin_contrato, fk_estado, fk_empresa, fk_vehiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/conductor-create.php?err=failedPrepStmt");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssiii",
      $conductor['rut'],
      $conductor['nombre'],
      $conductor['direccion'],
      $conductor['fecha_ingreso'],
      $conductor['fin_contrato'],
      $conductor['fk_estado'],
      $conductor['fk_empresa'],
      $conductor['fk_vehiculo'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    return false;
  }
}

function getConductores_all($conn, $id_empresa){
  $query="SELECT * FROM Conductor WHERE fk_empresa=$id_empresa";
  $result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}

function getConductores_count($conn, $id_empresa){
  $query="SELECT COUNT(*) FROM Conductor WHERE fk_empresa = $id_empresa";

  try {
    $response = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($response);
    return $result["COUNT(*)"];

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}

function update_conductor($conn, $old_conductor, $new_conductor){
  try {
    $sql = "UPDATE Conductor SET rut=?, nombre=?, direccion=?, fecha_ingreso=?, fin_contrato=?, fk_estado=?, fk_empresa=?, fk_vehiculo=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/conductor-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssiiii",
      $new_conductor['rut'],
      $new_conductor['nombre'],
      $new_conductor['direccion'],
      $new_conductor['fecha_ingreso'],
      $new_conductor['fin_contrato'],
      $new_conductor['fk_estado'],
      $new_conductor['fk_empresa'],
      $new_conductor['fk_vehiculo'],

      $old_conductor['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_conductor()\n";
    echo $e->getMessage();
    die();
  }
}

function delete_conductor($conn, $id){
  $query="DELETE FROM Conductor WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
