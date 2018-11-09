<html lang='en'>
    <body>
        <?php
            session_start();

            $userId = $_SESSION['user_id'];
            $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");

            if(isset($_POST['change-profile-submit'])) {

                $name = strval($_POST['name']);
                $email = strval($_POST['email']);
                $contact_number = strval($_POST['contact_number']);
                $username = strval($_POST['username']);

                echo" $name| $email | $contact_number | $username";

                $queryString = "
                UPDATE users 
                SET name = $1, email = $2, contact_number = $3, username = $4 
                where user_id = '$userId' ;
                ";
                    
                echo"queryString = " . $queryString;


                if($name == '' || $email == '' || $contact_number == '' || $username == '') {
                    header("Location: ../view/settings/profile.php?changed=error");
                    echo"error";
                } else {
                    echo"success";
                    $query = pg_query_params($db, $queryString, 
                        array($name, $email, $contact_number, $username)
                    );

                    header("Location: ../view/settings/profile.php?changed=success");
                }
            }
        ?>
    </body>
</html>