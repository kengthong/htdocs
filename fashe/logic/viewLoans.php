<?php
//variables for connection
$servername = "localhost";
$portnum = "5543";
$username = "postgres"; //username
$password = "password"; //pass
$dbname = "fashe";
$table = "items_on_loan"; //table name
$userid = $_SESSION[user_id];

//Create connection
$db = pg_connect($servername, $portnum, $dbname, $username, $password);

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
echo "<table>";
$serial = 1; //s/n of num of borrowed items.
while($row = pg_fetch_array($result)){
  if($row[owner_received]) {
    continue;
  }
  $startdate = $row[start_from];
  $enddate = $row[return_by];
  $datediff = $date_diff($startdate, $enddate);
  $status = "borrowed";
  
//item_img is the item pic.
  echo "<tr><td>" . $serial++ . "</td><td>" .$row["item_name"] ."</td>"?>
   <img src="<?php echo $row["image_path"]; ?>" height="50px" width="50px"> 
   <?php echo "</td><td>" . $datediff->format('%a') . "</td><td>" .$row["return_by"] ."</td><td>" .$status ."</td></tr>";
  }
echo "</table>";
?>