<?php
    session_start();
    if(isset($_POST['submit'])){
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $bid_closing_date = date('Y-m-d', date('d-m-Y', $_POST['bid_closing_date']));

        $queryString = "
            INSERT INTO entry(name, location, starting_bid, owner_id, total_quantity,
            current_quantity, bid_closing_date, loan_duration)
            values (
            '$_POST[name]',
            '$_POST[location]',
            '$_POST[starting_bid]',
            '$_SESSION[user_id]',
            '$_POST[total_quantity]',
            '$_POST[total_quantity]',
            '$bid_closing_date',
            '$_POST[loan_duration]')
        ";

        $result = pg_query($db, $queryString);

        if($result) {
            echo"Success";
            header("Location: ../my-items.php"); 
        } else {
            echo"'$_POST[name]',
            '$_POST[location]',
            '$_POST[starting_bid]',
            '$_SESSION[user_id]',
            '$_POST[total_quantity]',
            '$bid_closing_date',
            '$_POST[bid_closing_date]',
            '$_POST[loan_duration]'";
            // header("Location: index.php?add=fail");
        }
        
    } else {
        header("Location: index.php?add=error");
    }
?>