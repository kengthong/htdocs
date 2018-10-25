<!DOCTYPE html>  
<head>
  <title>UPDATE PostgreSQL data with PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Insert new item and enter</h2>
  <ul>
    <form name="display" action="index.php" method="POST" >
      <li>Item ID: 
        <input type="number" name="bookid" />
      </li>

      <li>
        Price:
        <input type="number" name="price" />
      </li>

      <li>
        Quantity:
        <input type="number" name="quantity" />
      </li>

      <li>
        Name:
        test1
        <input type="text" name="name" />
      </li>

      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <ul>
    <li>
      <form name="display" action="index.php" method="POST" >
        <li>bookID_updated: 
          <input type="number" name="bookid_updated" />
        </li>

        <li>
          Updated price:
          <input type="number" name="price_updated" />
        </li>

        <li>
          updated Name:
          <input type="text" name="book_name_updated" />
        </li>

        <li><input type="submit" name="submit" /></li>
      </form>
    </li>
  </ul>
  <?php
    // Connect to the database. Please change the password in the following line accordingly

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102proj user=postgres password=kengthong");	
    // $queryString = "INSERT INTO book (name, price) values ('$POST[name]', '$POST[price]');";
    // $queryString = "SELECT * FROM book WHERE book_id = '$_POST[bookid]'";
    $queryString = "
    UPDATE book 
      SET name = '$_POST[book_name_updated]', price = '$_POST[price_updated]'
      WHERE book_id = '$_POST[bookid_updated]'
    ";

    $result = pg_query($db, $queryString);

    // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    // $password = sha1("test");
    $password = "HI"; 
    // $insertResult = pg_query($db, "INSERT INTO book values('test', 'test@gmail.com', '$password')");

    // $res = pg_fetch_assoc($result);

    if (isset($_POST['submit'])) {

      // echo "<script>console.log( 'Debug Objects: " . $row[name] . "' );</script>";

      echo "<ul><form name='update' action='index.php' method='POST' >  
    	<li>Book ID:</li>  
      <li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
      <li>'$row[book_id]'</li>
    	<li>Book Name:</li>  
    	<li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
    	<li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
    	<li>Date of publication:</li>  
    	<li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
      <li><input type='submit' name='new' /></li>  
      
      <li>book id = '$_POST[bookid]'</li>
      <li>book id = '$_POST[name]'</li>
      <li>book id = '$_POST[price]'</li>
    	</form>  
    	</ul>";
    }
    
    // if (isset($_POST['new'])) {	// Submit the update SQL command
    //     $result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
    // name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
    // date_of_publication = '$_POST[dop_updated]'");
    //     if (!$result) {
    //         echo "Update failed!!";
    //     } else {
    //         echo "Update successful!";
    //     }
    // }
    ?> 
</body>
</html>
