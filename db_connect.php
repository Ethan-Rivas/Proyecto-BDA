<?php
  /* Database connection start */
  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $dbname = "zoologico";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %sn", mysqli_connect_error());
  exit();
  }
?>