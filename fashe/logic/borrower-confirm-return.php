<?php 
    if(isset($_POST['submit'])) {
        
        $parts = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parts['query'], $query);

        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
        if(isset($_POST['submit'])) {
            echo"";

            $recordId = $query['record_id'];
            $queryString = "UPDATE borrowed_record set borrower_returned = TRUE where record_id = $recordId;";

            $result = pg_query($db, $queryString);

            if($result) {
                header("Location: ../view/borrowed-items.php?updated=success");
            } else {
                header("Location: ../view/borrowed-items.php?updated=success");
            }
        }
    }
?>