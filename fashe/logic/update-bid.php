<?php

    session_start();

    $parts = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parts['query'], $query);

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
    if(isset($_POST['submit'])) {

        echo"submitted";
        $bidId = $query['bid_id'];
        $amount = $_POST['amount'];

        $queryString = "UPDATE bid_record set bid_amount = $amount where bid_id = $bidId;";

        $result = pg_query($db, $queryString);

        if($result) {
            header("Location: ../view/my-bids.php?updated=success");
        } else {
            header("Location: ../view/my-bids.php?updated=error");
        }

    } else {
        echo"never submit?";
    }
?>