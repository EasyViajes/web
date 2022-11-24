<?php

function create_direccion($conn, $direccion){
  try {
    $sql = "INSERT INTO Direccion (nombre, fk_comuna) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/direccion-create.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "si",
      $direccion['nombre'],
      $direccion['fk_comuna']
    );

    mysqli_stmt_execute($stmt);
    $id = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);
    return $id;
  }

  catch(Exception $e) {
    echo "Exception in createDireccion()\n";
    echo $e->getMessage();
    die();
  }
}

function delete_direccion($conn, $id){
  $query="DELETE FROM Direccion WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
