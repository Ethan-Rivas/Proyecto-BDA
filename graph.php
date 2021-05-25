<?php
require_once('./vendor/jpgraph/src/jpgraph.php');
require_once('./vendor/jpgraph/src/jpgraph_bar.php');

include_once("./db_connect.php");

$sql = "SELECT * FROM animales ORDER BY id ASC";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

$animals = [];
$genderMale = [];
$genderFemale = [];

$currentAnimal = "";

if(mysqli_num_rows($resultset)) {
  while( $rows = mysqli_fetch_assoc($resultset) ) {
    if ($currentAnimal != $rows['name']) {
      array_push($animals, $rows['name']);
      
      $currentAnimal = $rows['name'];
    }

    if ($rows['gender'] == "M") {
      array_push($genderMale, intval($rows['quantity']));
    } else {
      array_push($genderFemale, intval($rows['quantity']));
    }
  }
}

// Create the graph. These two calls are always required
$graph = new Graph(800,600,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,1,2,3,4,5,6,7,8,9,10), array(0,1,2,3,4,5,6,7,8,9,10));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($animals);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($genderMale);
$b2plot = new BarPlot($genderFemale);

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot));
// ...and add it to the graPH
$graph->Add($gbplot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#cc1111");

$b2plot->SetColor("white");
$b2plot->SetFillColor("#11cccc");

$graph->title->Set("Conteo de Género");

// Display the graph
$graph->Stroke();

?>