<?php

include_once("./db_connect.php");

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Ethan Rivas 25/05/2021 -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto #1 - BDA</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-body">
          <br>
          <form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
            <div class="row">
              <div class="col-md-3">
                <input type="file" name="file" />
              </div>
              <div class="col-md-3">
                <input type="submit" class="btn btn-primary" name="import_data" value="Importar">
              </div>
            </div>
          </form>

          <br>

          <div class="row">
            <form action="delete.php" method="post" enctype="multipart/form-data" id="import_form">
              <div class="row">
                <div class="col-11">
                  <h5 class="text-center">Lista de Animales</h5>
                </div>
                
                <div class="col-1">
                  <input type="submit" class="btn btn-danger" name="import_data" value="Borrar Datos" style="float: right; margin-bottom: 10px;">
                </div>
              </div>
            </form>

            <?php
              $sql = "SELECT * FROM animales ORDER BY id ASC";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
            ?>

            <table class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Género</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(mysqli_num_rows($resultset)) {
                    while( $rows = mysqli_fetch_assoc($resultset) ) {
                ?>
                    <tr class="text-center">
                      <td><?php echo $rows['id']; ?></td>
                      <td><?php echo $rows['name']; ?></td>
                      <td><?php echo $rows['gender']; ?></td>
                      <td><?php echo $rows['quantity']; ?></td>
                    </tr>
                  <?php 
                    } 
                  } else { 
                  ?>
                    <tr class="text-center">
                      <td colspan="5">No hay datos para mostrar.</td>
                    </tr>
                  <?php 
                  } 
                  ?>
              </tbody>
            </table>

            <?php 
              if(mysqli_num_rows($resultset)) {
            ?>

              <div class="container">
                <img src="./graph.php" alt="" style="display: block; margin: 0 auto; width: 100%; max-width: 800px;">
              </div>

            <?php
              }
            ?>

          </div>
        </div>
      </div>
    </div>
  </body>

</html>
