<?php

function create_ruta($conn, $ruta){
  try {
    $sql = "INSERT INTO Ruta (hora_salida, fecha_creacion, direccion_origen, direccion_destino, fk_estado, fk_vehiculo, fk_empresa) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /ruta-create.php?err=failedPrepStmt");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "ssiiii",
      $ruta['hora_salida'],
      $ruta['fecha_creacion'],
      $ruta['direccion_origen'],
      $ruta['direccion_destino'],
      $ruta['fk_estado'],
      $ruta['fk_vehiculo'],
      $ruta['fk_empresa']
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

function getRutas($conn, $id_empresa){
  $query="SELECT * FROM Ruta WHERE fk_empresa=$id_empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  mysqli_close($conn);
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

function get_top_rutas($conn, $id_empresa){

  $query ='SELECT * FROM Ruta INNER JOIN Venta ON Ruta.id = Venta.fk_ruta';
    //GROUP BY product order by sum(amount) desc limit 3;';

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
