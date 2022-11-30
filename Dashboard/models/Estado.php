<?php

function get_estados($conn){
  $query="SELECT * FROM Estado";
	$result = mysqli_query($conn, $query);

  /* fetch associative array */
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;

  }
  return $rows;
}
