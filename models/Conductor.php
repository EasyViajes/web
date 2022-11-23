<?php
function create_conductor($conn, $conductor){
  try {
    $sql = "INSERT INTO Conductor (rut, nombre, fecha_ingreso, fin_contrato, fk_estado, fk_empresa, fk_direccion, fk_vehiculo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /conductor-create.php?err=failedPrepStmt");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssiiii",
      $conductor['rut'],
      $conductor['nombre'],
      $conductor['fecha_ingreso'],
      $conductor['fin_contrato'],
      $conductor['fk_estado'],
      $conductor['fk_empresa'],
      $conductor['fk_direccion'],
      $conductor['fk_vehiculo'],
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
