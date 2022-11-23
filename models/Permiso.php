<?php

function get_permisos($conn){
  $query="SELECT * FROM Permiso";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  mysqli_close($conn);
  return $rows;
}
