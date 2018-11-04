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

  if (empty($_POST["emailinput"])) {
    $emailErr = "email is required";
  } else {
    $emailinput = test_input($_POST["emailinput"]);
  }
  
  if (empty($_POST["usernameinput"])) {
    $locationErr = "username is required";
  } else {
    $usernameinput = test_input($_POST["usernameinput"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])) {

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
    $ownerID = pg_query($db, "SELECT DISTINCT user_id from users WHERE $_POST[emailInput] = email AND $_POST[usernameInput] = username");

    //tried to implement ownerID from input fields
    $queryString = "DELETE FROM entry WHERE name = $_POST[nameinput] AND $ownerID = user_id;";

    $result = pg_query($db, $queryString);

    // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
    if (!$result) {
            echo "Failed to delete!";
        } else {
            echo "Successfully deleted!";
        }
    }
?>