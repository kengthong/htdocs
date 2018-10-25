<?php
    session_start();

    if($_POST['accept_bid']) {
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $queryString = "
        INSERT INTO borrowed_record(entry_id, borrower_id, start_from, return_by, quantity, borrowed_price) 
        SELECT DISTINCT e.entry_id, u.user_id, now(), now(), e.current_quantity, e.current_bid 
        FROM users u, entry e, bid_record bir
        WHERE e.entry_id = $_SESSION[active_entry_id]
        AND u.user_id = bir.user_id
        AND e.entry_id = bir.entry_id
        AND e.current_bid = bir.bid_amount; 
        "; 
        
        $insert_result = pg_query($db, $queryString);
        echo " hi= $_SESSION[active_entry_id]";
    }

?>