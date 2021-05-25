<?php
  include_once("./db_connect.php");

  $mysql_insert = "TRUNCATE table animales;";
  mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));

  header("Location: index.php");
?>