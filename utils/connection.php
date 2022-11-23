<?php
function create_connection(){
  $conf = include_once $_SERVER["DOCUMENT_ROOT"] . "/utils/config.php";

  $db_host      = $conf["host"];
  $db_username  = $conf["username"];
  $db_password  = $conf["password"];
  $db_name      = $conf["name"];

  try {
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    return $conn;

  } catch (Exception $e) {
    echo "Failed to connect! <br>";
    echo $e->getMessage();
    return false;
  }
}

