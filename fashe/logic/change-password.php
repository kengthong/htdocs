<html lang='en'>
    <body>
        <?php
        session_start();

        $userId = $_SESSION['user_id'];
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");


        $query_string = "SELECT * FROM users as u WHERE u.user_id = ". $userId.";";
    
        $result = pg_query($db, $query_string);
        $userData = pg_fetch_assoc($result);		

        $userInputCurrentPassword = $_POST['current_password'];
        $userInputNewPassword = $_POST['new_password'];
        $userInputConfirmPassword = $_POST['confirm_password'];

        //echo"querystring = " .$query_string ; //debug
 
        //debug
        //echo"database current password = $userData[password]"; 
        //echo"user input current password = ". $userInputCurrentPassword;
        //echo"hashedd current password = " . md5($userInputCurrentPassword); 

        if(isset($_POST['change-password-submit'])) {
            if($userData['password'] == md5($userInputCurrentPassword)) {
                if($userInputNewPassword == $userInputConfirmPassword) {
                    $changePasswordQuery = "
                        UPDATE users set password = '$userInputNewPassword' where user_id = '$userId' ;
                    ";

                    echo"<p>query string = " . $changePasswordQuery ."</p>";

                    pg_send_query($db, $changePasswordQuery);
                    $updateResult = pg_get_result($db);

                    if(!$updateResult) {
                        header("Location: ../view/settings/password.php?changed=error");    
                    } else {
                        header("Location: ../view/settings/password.php?changed=success");    
                    }
                } else {
                    header("Location: ../view/settings/password.php?changed=error");    
                }
            } else {
                header("Location: ../view/settings/password.php?changed=error");
            }
        }
    ?>
    </body>
</html>