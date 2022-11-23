<?php
function create_usuario($conn, $usuario){
  try {
    $sql = "INSERT INTO Usuario (nombre, mail, password, fecha_creacion, fk_estado, fk_empresa, fk_permiso) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /usuario-create.php?err=failedPrepStmt");
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
    die();
  }

}

function update_usuario($conn, $usuario, $data){
  try {
    $sql = "UPDATE Usuario SET nombre=?, mail=?, password=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /usuario-create.php?error=creationFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sssi",
      $usuario['nombre'],
      $usuario['mail'],
      $usuario['pwd'],
      $usuario['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in create_usuario()\n";
    echo $e->getMessage();
    die();
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
  mysqli_close($conn);
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
    die();
  }
}
