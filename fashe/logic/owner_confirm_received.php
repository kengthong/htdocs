<?php
    if(isset($_POST['submit'])) {
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $parts = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parts['query'], $query);

        $recordId = $query['record_id'];
        $entryId = $query['entry_id'];

        //change borrowed record to owner_received
        // change entry to available

        $updateBorrowedRecordString = "UPDATE borrowed_record set owner_received = TRUE, returned_date = now() where record_id = $recordId;";
        $firstResult = pg_query($db, $updateBorrowedRecordString);

        if($firstResult) {
            $updateEntryToAvailableString = "UPDATE entry set available = TRUE where entry_id = $entryId;";
            $secondResult = pg_query($db, $updateEntryToAvailableString);

            if($secondResult) {
                header("Location: ../view/my-listings.php?loaned_out=true&received=success");
            } else {
                header("Location: ../view/my-listings.php?loaned_out=true&received=error");
            }

        } else {
            header("Location: ../view/my-listings.php?loaned_out=true&received=error");
        }
    } else {
        echo"no submit?";
    }
?>