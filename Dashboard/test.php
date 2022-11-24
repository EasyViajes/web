<?php
require $_SERVER['DOCUMENT_ROOT']. '/utils/connection.php';
$conn = create_connection();

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* check if server is alive */
if (mysqli_ping($conn)) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>
