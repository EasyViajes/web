<?php

function create_empresa($conn, $empresa){
  try {
    $sql = "INSERT INTO Empresa (rut, nombre, fecha_creacion, direccion, fk_estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/empresa-create.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssi",
      $empresa['rut'],
      $empresa['nombre'],
      $empresa['fecha_creacion'],
      $empresa['direccion'],
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

function update_empresa($conn, $old_empresa, $new_empresa){
  try {
    $sql = "UPDATE Empresa SET rut=?, nombre=?, direccion=?, fk_estado=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/empresa-create.php?error=updateFailed");
      exit();
    }


    mysqli_stmt_bind_param($stmt, "sssii",
      $new_empresa['rut'],
      $new_empresa['nombre'],
      $new_empresa['direccion'],
      $new_empresa['fk_estado'],

      $old_empresa['id'],
    );

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_empresa()\n";
    echo $e->getMessage();
  }
}


function delete_empresa($conn, $id){
  $query="DELETE FROM Empresa WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
  }
}
