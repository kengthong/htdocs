<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
//$db     = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");

$result = pg_query($db, "SELECT * FROM entry where entry_id = '$_POST[entryidinput]'");		// Query template query only 4 fields to find

$row    = pg_fetch_assoc($result);		// To store the result row
if (isset($_POST['submit'])) {
    echo"<ul><form action= 'updateListings.php' method='post'>
    Name of item: <input type='text' name='nameinput_update' value =$row[name]/><br>
    Email: <input type ='text' name ='emailinput_update' value =$_POST[emailInput]/><br>
    Location of collection: <input type ='text' name ='locationinput_update' value =$row[location]/><br>
    starting bid: <input type ='integer' name ='startingbidinput_update' value =$row[starting_bid]/><br>
    total quantity:<input type ='integer' name ='quantityinput_update' value =$row[total_quantity]/><br>
    Bid closing date: <input type='date' name='dateinput_update' value='<?php echo date('d/m/y'); ?>' /><br/>
    loan duration:<br>
    <input type='radio' name='durationinput_update' value='1' checked> 1<br>
    <input type='radio' name='durationinput_update' value='2'> 2<br>
    <input type='radio' name='durationinput_update' value='7'> 7<br>
    <input type='radio' name='durationinput_update' value='14'> 14<br>
    </form>
    </ul>";

    /*echo "<ul><form name='update' action='updateListings.php' method='POST' >  
    <li>Book ID:</li>  
    <li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
    <li>Book Name:</li>  
    <li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
    <li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
    <li>Date of publication:</li>  
    <li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
    <li><input type='submit' name='new' /></li>  
    </form>  
    </ul>";
    */
}
if (isset($_POST['new'])) {	// Submit the update SQL command
    $result = pg_query($db, "UPDATE entry SET name = '$_POST[nameinput_update]',  
location = '$_POST[locationinput_updated]', starting_bid = '$_POST[startingbidinput_updated]',  
total_quantity = '$_POST[quantityinput_updated]', bid_closing_date = '$_POST[dateinput_update], loan_duration = '$_POST[durationinput_update]");
    
    if (!$result) {
        echo "Update failed!!";
    } else {
        echo "Update successful!";
    }
}
?>