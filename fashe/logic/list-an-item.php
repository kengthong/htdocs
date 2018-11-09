<?php
    session_start();

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");

    //entry_id, name, location, starting_bid, current_bid, owner_id, total_quantity, current_quantity, bid_closing_date, loan_duration, active
    if(isset($_POST['fileSubmitted'])) {
        $filename = $_FILES['upload-image']['name'];
        $filetmpname = $_FILES['upload-image']['tmp_name'];
        $folder = "../images-uploaded/";
        $ownerID = $_SESSION['user_id'];

        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $savedFileName = $folder . $_POST['name']."." .$imageFileType;

        $queryString = "
            INSERT INTO entry (name, description, image_path, location, starting_bid,current_bid,owner_id,total_quantity,current_quantity,bid_closing_date,loan_duration) 
            VALUES ('$_POST[name]','$_POST[description]', '$savedFileName', '$_POST[location]', $_POST[starting_bid], 0, $ownerID, $_POST[total_quantity],$_POST[total_quantity],
            '$_POST[bid_closing_date]','$_POST[loan_duration]');
        ";
        // echo "<div>
        //     $savedFileName test

        //     $queryString
        // </div>";

        // echo "<p>" . $_POST['upload-image'] . " => file input successfull</p>";
        

        if(move_uploaded_file($filetmpname, $savedFileName)) {
            echo"moved successfully $imageFileType";
        } else {
            echo"failed";
        }

        pg_send_query($db,$queryString);
        $result = pg_get_result($db);

        if (!$result){
            header("Location: ../view/list-an-item.php?add=error");
        } else{
            header("Location: ../view/list-an-item.php?add=success");
        }
        
    }


?>