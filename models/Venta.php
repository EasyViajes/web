<?php
function getVentas($conn, $id_empresa){
  $query="SELECT * FROM Venta WHERE fk_empresa = $id_empresa";
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
  $query = "SELECT COUNT(*) FROM Venta WHERE fecha_compra BETWEEN CURDATE() - INTERVAL 7 DAY AND Now();";

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
