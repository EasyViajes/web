<?php
function create_usuario($conn, $usuario){
  try {
    $sql = "INSERT INTO Usuario (nombre, mail, password, fecha_creacion, fk_estado, fk_empresa, fk_permiso) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/usuario-create.php?err=failedPrepStmt");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssiii",
      $usuario['nombre'],
      $usuario['mail'],
      $usuario['password'],
      $usuario['fecha_creacion'],
      $usuario['fk_estado'],
      $usuario['fk_empresa'],
      $usuario['fk_permiso']
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in create_usuario()\n";
    echo $e->getMessage();
  }

}

function update_usuario($conn, $old_usuario, $new_usuario){
  try {
    $sql = "UPDATE Usuario SET nombre=?, mail=?, password=?, fk_estado=?, fk_permiso=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/usuario-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sssiii",
      $new_usuario['nombre'],
      $new_usuario['mail'],
      $new_usuario['password'],
      $new_usuario['fk_estado'],
      $new_usuario['fk_permiso'],

      $old_usuario['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_usuario()\n";
    echo $e->getMessage();
  }
}

function update_usuario_security($conn, $usuario){
  try {
    $sql = "UPDATE Usuario SET nombre=?, mail=?, password=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/usuario-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sssi",
      $usuario['nombre'],
      $usuario['mail'],
      $usuario['password'],

      $usuario['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_usuario()\n";
    echo $e->getMessage();
  }
}


function get_usuarios($conn, $id_empresa){
  $query="SELECT * FROM Usuario WHERE fk_empresa=$id_empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  return $rows;
}

function get_all_usuarios($conn){
  $query="SELECT * FROM Usuario";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  mysqli_close($conn);
  return $rows;
}

function delete_usuario($conn, $id){
  $query="DELETE FROM Usuario WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
  }
}
