<?php
function createPasaje($conn, $pasaje){
  try {
    $sql = "INSERT INTO Pasaje (precio, fk_estado, fk_ruta, fk_empresa) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: /Dashboard/pasaje-create.php?err=failedPrepStmt");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "iiii",
      $pasaje['precio'],
      $pasaje['fk_ruta'],
      $pasaje['fk_estado'],
      $pasaje['fk_empresa']
    );

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }
  catch(Exception $e) {
    echo "Exception in createPasaje()\n";
    echo $e->getMessage();
    die();
  }
}

function getPasajes_all($conn, $id_empresa){
  $query="SELECT * FROM Pasaje WHERE fk_empresa=$id_empresa";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  mysqli_close($conn);
  return $rows;
}

function delete_pasaje($conn, $id){
  $query="DELETE FROM Pasaje WHERE id = $id";

  try {
    $result = mysqli_query($conn, $query);
    return $result;

  }catch (Exception $e) {
    echo $e->getMessage();
    die();
  }
}
