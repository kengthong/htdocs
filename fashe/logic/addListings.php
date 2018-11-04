<?php
// define variables and set to empty values
$nameErr = $locationErr = $bidErr = $quantityErr = "";
$nameinput = $locationinput = $startingbidinput = $quantityinput = $dateinput = $durationinput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nameinput"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }
  
  if (empty($_POST["locationinput"])) {
    $locationErr = "location is required";
  } else {
    $locationinput = test_input($_POST["locationinput"]);
  }
    
  if (empty($_POST["startingbidinput"])) {
    $startingbidinput = "";
  } else {
    $startingbidinput = test_input($_POST["startingbidinput"]);
  }

  if (empty($_POST["quantityinput"])) {
    $quantityinput = "";
  } else {
    $quantityinput = test_input($_POST["quantityinput"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


