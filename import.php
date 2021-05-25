<?php
  include_once("./db_connect.php");

  $row = "1";

  if(isset($_POST['import_data'])) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
      if(is_uploaded_file($_FILES['file']['tmp_name'])) {
        $csv_file = fopen($_FILES['file']['tmp_name'], 'r');

        while(($animal = fgetcsv($csv_file)) !== FALSE) {
          if($row == 1){ $row++; continue; }

          $mysql_insert = "INSERT INTO animales (name, gender, quantity)VALUES('".$animal[1]."', '".$animal[2]."', ".$animal[3].")";
          mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
        }

        fclose($csv_file);
      }
    }
  }

  header("Location: index.php");
?>