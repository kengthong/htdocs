<?php
  //retrieve entry's owner_id

  //if $_session['user_id'] == owner_id || $_SESSION['admin'] == true => delete
  // else you do not have the permission to do so
  // define variables and set to empty values
  session_start();

  $entry_id = $_POST['entry_id'];
  $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
  $query_string = "SELECT DISTINCT owner_id FROM entry as e WHERE e.entry_id = " . $entry_id.";";
  $result = pg_query($db, $query_string);
  $row = pg_fetch_assoc($result);		

  if($owner_id == $_SESSION['user_id'] || $_SESSION['admin'] == true) {
    $delete_query = "UPDATE entry as e set active = 'FALSE' WHERE e.entry_id = " . $entry_id .";";  
    pg_query($db, $delete_query);
  }
  
  echo json_encode(array("success"=> true));
  // if($_POST['entry_id']) {

  //   $variable = 'success';
  //   echo json_encode(array("blablabla"=>'success'));
  // }


  // $nameErr = $locationErr = $bidErr = $quantityErr = "";
  // $nameinput = $locationinput = $startingbidinput = $quantityinput = $dateinput = $durationinput = "";

  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //   if (empty($_POST["nameinput"])) {
  //     $nameErr = "Name is required";
  //   } else {
  //     $name = test_input($_POST["name"]);
  //   }

  //   if (empty($_POST["emailinput"])) {
  //     $emailErr = "email is required";
  //   } else {
  //     $emailinput = test_input($_POST["emailinput"]);
  //   }
    
  //   if (empty($_POST["usernameinput"])) {
  //     $locationErr = "username is required";
  //   } else {
  //     $usernameinput = test_input($_POST["usernameinput"]);
  //   }

  // }

  // function test_input($data) {
  //   $data = trim($data);
  //   $data = stripslashes($data);
  //   $data = htmlspecialchars($data);
  //   return $data;
  // }

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