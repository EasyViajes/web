<?php

function generate_secreto($strength = 10) {
    $permitted_chars = '0123456789';
    $permitted_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted[mt_rand(0, $permitted_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

function create_cliente($conn, $mail){
  try {
    $sql = "INSERT INTO Cliente (mail, secret, fecha_creacion) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /index.php?msg=creationFailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sss",
      $mail,
      generate_secreto(),
      date('Y-m-d')
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

function update_cliente($conn, $old_cliente, $new_cliente){
  try {
    $sql = "UPDATE Cliente SET mail=?, secreto=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/cliente-create.php?error=updateFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi",
      $new_cliente['mail'],
      $new_cliente['secreto'],

      $old_cliente['id'],
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_cliente()\n";
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

function get_cliente_by_mail($conn, $mail){
  $sql = "SELECT * FROM Cliente WHERE mail=?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /index.php?msg=failedGetCliente");
    exit();
  }

  try{
    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    //$row = fetch_assoc


    mysqli_stmt_close($stmt);

    return $result;
  }
  catch(Exception $e) {
    echo "Exception in update_cliente()\n";
    echo $e->getMessage();
    die();
  }
}
