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

if(isset($_POST['submit'])) {

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
    $ownerID = pg_query($db, "SELECT user_id from users WHERE emailInput = email")

    //tried to implement ownerID from input fields
    $queryString = "
    INSERT INTO entry (name,location,starting_bid,current_bid,owner_id,total_quantity,current_quantity,bid_closing_date,loan_duration) 
    VALUES (nameinput,locationinput,startingbidinput,'0',$ownerID,quantityinput,quantityinput,dateinput,durationinput);"

    $result = pg_query($db, $queryString);

    // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
    if (!$result) {
            echo "Failed to add!";
        } else {
            echo "Successfully added!";
        }
    }
?>