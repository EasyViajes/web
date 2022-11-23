<?php

function generate_secreto($strength = 16) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $permitted_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted[mt_rand(0, $permitted_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

function create_cliente($conn, $cliente){
  try {
    $sql = "INSERT INTO Cliente (nombre, fk_comuna) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /cliente-create.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sss",
      $cliente['mail'],
      $cliente['secreto'],
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
    die();
  }
}

function delete_cliente($conn, $id){
  $query="DELETE FROM Cliente WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}

