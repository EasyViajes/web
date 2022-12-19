<?php

function generate_secret($strength = 10) {
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $strength; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];

  }
  return $randomString;


}

function create_cliente($conn, $cliente){
  try {
    $sql = "INSERT INTO Cliente (mail, secret, fecha_creacion) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /index.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sss",
      $cliente['mail'],
      $cliente['secret'],
      $cliente['fecha_creacion']
    );

    mysqli_stmt_execute($stmt);
    $id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    return $id;
  }

  catch(Exception $e) {
    echo "Exception in create_cliente()\n";
    echo $e->getMessage();
  }
}

function update_cliente($conn, $old_cliente, $new_cliente){
  try {
    $sql = "UPDATE Cliente SET nombre=?, apellido=?, mail=?, secret=?, fecha_creacion=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/cliente-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssi",
      $new_cliente['nombre'],
      $new_cliente['apellido'],
      $new_cliente['mail'],
      $new_cliente['secret'],
      $new_cliente['fecha_creacion'],

      $old_cliente['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_cliente()\n";
    echo $e->getMessage();
  }
}

function delete_cliente($conn, $id){
  $query="DELETE FROM Cliente WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
  }
}

function get_cliente_by_mail($conn, $mail){
  $query = 'SELECT * FROM Cliente WHERE mail = ?';
  $stmt = mysqli_prepare($conn, $query);

  mysqli_stmt_bind_param($stmt, 's',$mail);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $cliente = mysqli_fetch_assoc($result);

  return $cliente;

}

