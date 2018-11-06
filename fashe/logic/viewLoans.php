<?php
//variables for connection
$servername = "localhost";
$portnum = "8080";
$username = "postgres"; //username
$password = "password"; //pass
$dbname = "fashe";
$table = "items_on_loan"; //table name
$userid = 1;

//Create connection
$db = pg_connect($servername, $portnum, $dbname, $username, $password);

//num is autoincrement serial num(borrowed items ID), item_name is item name + image, start_from is start date, return by is end date, owner received is boolean true/false.
$sql = 
"SELECT item_name, item_img, start_from, return_by, owner_received
FROM $table
WHERE borrower_id=$userid //not sure how to get around this
ORDER BY borrowed_recordID;";

$result = pg_query($db, $sql);

if (! $result) {
  die("Could not get data: ");
}
  //output data of each row
  //item_name needs to return item_img too. 
echo "<table>";
$serial = 1;
while($row = pg_fetch_array($result)){
  if($row[owner_received]) {
    continue;
  }
  $startdate = $row[start_from];
  $enddate = $row[return_by];
  $datediff = $date_diff($startdate, $enddate);
  $status = "borrowed";
  

  echo "<tr><td>" . $serial++ . "</td><td>" .$row["item_name"] ."</td>"?>
   <img src="<?php echo $row["item_img"]; ?>" height="50px" width="50px"> 
   <?php echo "</td><td>" . $datediff->format('%a') . "</td><td>" .$row["return_by"] ."</td><td>" .$status ."</td></tr>";
  }
echo "</table>";
?>