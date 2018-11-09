<?php
    session_start();

    //echo"anything"; //for debugging
    if(isset($_POST['accept_bid'])) {
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $queryString = "
            INSERT INTO borrowed_record(entry_id, borrower_id, start_from, return_by, quantity, borrowed_price) 
            SELECT DISTINCT e.entry_id, u.user_id, now(), now() + interval '1 days' * e.loan_duration, e.current_quantity, e.current_bid 
            FROM users u, entry e, bid_record bir
            WHERE e.entry_id = $_SESSION[active_entry_id]
            AND u.user_id = bir.user_id
            AND e.entry_id = bir.entry_id
            AND e.current_bid = bir.bid_amount; 
        "; 
        
        //echo"$queryString"; //for debugging
        $insert_result = pg_query($db, $queryString);

        if($insert_result) {
            $updatedQuantity =  $entryRow['current_quantity'] - $_POST['quantity'];
            //current_quantity = $updatedQuantity
            $update_entry_query = "
                UPDATE entry SET available = false
                WHERE entry_id = $_SESSION[active_entry_id];";
            echo"$update_entry_query";
            $update_entry_result = pg_query($db, $update_entry_query);

            if($update_entry_result) {
                header("Location: ../view/my-listings.php");
            } else {
                // header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]");
            }
        } else {
            // header("Location: failed-to-insert.php");
        }
        
        echo " hi= $_SESSION[active_entry_id]";
    } else {
        // header("Location: ../view/item-detail.php?id=$_SESSION[active_entry_id]");
        // header("Location: error.php");
    }

    

?>