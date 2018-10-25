<?php
    session_start();

    if(isset($_POST['submit'])) {

        $previous_uri = $_SESSION['previous_uri'];
        if(!isset($_POST['new_bid']) || trim($_POST['new_bid'] == "")
        || !isset($_POST['quantity']) || trim($_POST['quantity'] == "")) {
            echo" You did not fill out the required tables.";
            header("Location: " . $previous_uri . "?submit=error");
        } else if(!$_SESSION['user_id'] || !$_SESSION['active_entry_id']) {
            header("Location: " . $previous_uri . "?submit=error");
        } else {
            $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
            $queryString = "
            INSERT INTO bid_record(bid_amount, quantity, user_id, entry_id) 
                VALUES($_POST[new_bid], $_POST[quantity], $_SESSION[user_id], $_SESSION[active_entry_id]);
            "; 
            
            $insert_result = pg_query($db, $queryString);
            if($insert_result) {
                $update_entry_query = "
                UPDATE entry SET current_bid = $_POST[new_bid], current_quantity = $_POST[quantity]
                WHERE entry_id = $_SESSION[active_entry_id];";
                // echo"$update_entry_query";
                $update_entry_result = pg_query($db, $update_entry_query);

                if($update_entry_result) {
                    header("Location: success.php");
                } else {
                    header("Location: " . $previous_uri . "?submit=error");
                }
            } else {
                header("Location: " . $previous_uri . "?submit=error");
            }
        }
    } else {
        header("Location: " . $previous_uri);
    }
?>
