<?php
    session_start();

    if(isset($_POST['submit'])) {
        
        if(!isset($_POST['new_bid']) || trim($_POST['new_bid'] == "")
        || !isset($_POST['quantity']) || trim($_POST['quantity'] == "")) {
            echo" You did not fill out the required tables.";
            header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");
        } else if(!$_SESSION['active_entry_id']) {
            header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");
        } else {
            $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	

            $queryForEntry = "SELECT DISTINCT current_bid, starting_bid, current_quantity from entry where entry_id = $_SESSION[active_entry_id];";
            $entryResult = pg_query($db, $queryForEntry);
            $entryRow = pg_fetch_assoc($entryResult);		

            //new bid is more than currentbid & starting bid
            if($_POST['new_bid'] > $entryRow['starting_bid'] && $_POST['new_bid'] > $entryRow['current_bid']) {
             
                $queryString = "
                INSERT INTO bid_record(bid_amount, quantity, user_id, entry_id) 
                    VALUES($_POST[new_bid], $_POST[quantity], $_SESSION[user_id], $_SESSION[active_entry_id]);
                "; 
                
                $updatedQuantity =  $entryRow['current_quantity'] - $_POST['quantity'];
                echo"current_quantity = $entryRow[current_quantity] |";
                echo"quantity = $_POST[quantity]";
                echo"updated quantity = $updatedQuantity";
                $insert_result = pg_query($db, $queryString);


                if($insert_result) {
                    
                    $updateString = "Update entry set current_bid = $_POST[new_bid] where entry_id = $_SESSION[active_entry_id];";
                    $update_result = pg_query($db, $updateString);
                    if($update_result) {
                        header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=success");
                    } else {
                        header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");    
                    }
                } else {
                    header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");
                }
                
            } else {
                header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");
            }
        }
    } else {
        header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]&bid=error");
    }
?>
