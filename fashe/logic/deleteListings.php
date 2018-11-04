<?php
// define variables and set to empty values
$entryidErr = "";
$entryid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["entryidinput"])) {
    $entryidErr = "Name is required";
  } else {
    $entryid = test_input($_POST["name"]);
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

    //tried to implement ownerID from input fields
    $queryString = "DELETE FROM entry WHERE entryid = $_POST[entryidinput]";

    $result = pg_query($db, $queryString);

    // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
    if (!$result) {
            echo "Failed to delete!";
        } else {
            echo "Successfully deleted!";
        }
    }
?>