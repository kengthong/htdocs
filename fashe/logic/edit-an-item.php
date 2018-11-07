<html lang='en'>
    <body>
        <div>
            <?php
                session_start();

                $parts = parse_url($_SERVER['REQUEST_URI']);
                parse_str($parts['query'], $query);
                
                $entryId = $query['id'];
                $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");

                //entry_id, name, location, starting_bid, current_bid, owner_id, total_quantity, current_quantity, bid_closing_date, loan_duration, active
                if(isset($_POST['fileSubmitted'])) {
                    $filename = $_FILES['upload-image']['name'];
                    echo"file name = $filename";
                    echo"filename ==== ? " . ($filename == '');
                    $filetmpname = $_FILES['upload-image']['tmp_name'];
                    $folder = "../images-uploaded/";

                    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                    $savedFileName = $folder . $_POST['name']."." .$imageFileType;

                    $queryString = '';
                    $ownerID = $_SESSION['user_id'];

                    if($filename !== '') {
                        $queryString = "
                            UPDATE entry SET name = '$_POST[name]', description = '$_POST[description]', image_path = '$savedFileName', location ='$_POST[location]', starting_bid = $_POST[starting_bid], total_quantity = $_POST[total_quantity],
                            bid_closing_date = '$_POST[bid_closing_date]', loan_duration = '$_POST[loan_duration]'
                            WHERE entry_id = '$entryId';
                        ";

                        if(move_uploaded_file($filetmpname, $savedFileName)) {
                            echo"moved successfully $imageFileType";
                        } else {
                            echo"failed";
                        }
                    } else {
                        $queryString = "
                            UPDATE entry SET name = '$_POST[name]', description = '$_POST[description]',  location ='$_POST[location]', starting_bid = $_POST[starting_bid], total_quantity = $_POST[total_quantity],
                            bid_closing_date = '$_POST[bid_closing_date]', loan_duration = '$_POST[loan_duration]'
                            WHERE entry_id = '$entryId';
                        ";
                    }

                    

                    
                    echo "<div>
                        $savedFileName test

                        $queryString
                    </div>";

                    // echo "<p>" . $_POST['upload-image'] . " => file input successfull</p>";
                    

                    
                    // echo"Location: ../view/edit-an-item.php?id=$entryId&edit=success";

                    pg_send_query($db,$queryString);
                    $result = pg_get_result($db);

                    if (!$result){
                        header("Location: ../view/edit-an-item.php?id=$entryId&edit=error");
                    } else{
                        header("Location: ../view/edit-an-item.php?id=$entryId&edit=success");
                    }
                    
                }


            ?>
        </div>
    </body>
</html>