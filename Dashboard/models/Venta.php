<?php

function create_venta($conn, $venta){ try { $sql = "INSERT INTO Venta (fecha_compra, fk_estado, fk_ruta, fk_empresa, fk_cliente) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/conductor-create.php?err=failedPrepStmt"); exit();
    }
    mysqli_stmt_bind_param($stmt, "siiii",
      $conductor['fecha_compra'],
      $conductor['fk_estado'],
      $conductor['fk_ruta'],
      $conductor['fk_empresa'],
      $conductor['fk_cliente'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in create_venta()\n";
    echo $e->getMessage();
    die();
  }
}

function get_ventas($conn, $id_empresa){
  $query="SELECT * FROM Venta WHERE fk_empresa = $id_empresa";
  $result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}

function get_all_ventas($conn){
  $query="SELECT * FROM Venta";
  $result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;
}


function getVentas_dia($conn, $id_empresa){
  $query = "SELECT COUNT(*) FROM Venta WHERE CAST(fecha_compra as Date) = CAST(CURDATE() as Date) AND fk_empresa = $id_empresa";

  try {
    $response = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($response);

    return $result["COUNT(*)"];
  }
  catch(Exception $e){
    echo $e->getMessage();
    die();
  }
}

function getVentas_semana($conn, $id_empresa){
  $query = "SELECT COUNT(*) FROM Venta WHERE fecha_compra BETWEEN CURDATE() - INTERVAL 7 DAY AND Now() AND id=$id_empresa;";

  try {
    $response = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($response);

    return $result["COUNT(*)"];
  }
  catch(Exception $e){
    echo $e->getMessage();
    die();
  }

}

function getVentas_ganancias($conn, $id_empresa){

}

function get_ultimas_ventas($conn, $id_empresa){
  $query = "SELECT * FROM Empresa ORDER BY id DESC LIMIT 5;";

  try {
    $response = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($response);

    return $result;
  }
  catch(Exception $e){
    echo $e->getMessage();
    die();
  }

}

function update_venta($conn, $old_venta, $new_venta){
  try {
    $sql = "UPDATE Venta SET fk_estado=?, fk_ruta=?, fk_cliente=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/venta-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "iiii",
      $new_venta['fk_estado'],
      $new_venta['fk_ruta'],
      $new_venta['fk_cliente'],

      $old_venta['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_venta()\n";
    echo $e->getMessage();
    die();
  }
}

function delete_venta($conn, $id){
  $query="DELETE FROM Venta WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}

