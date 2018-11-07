<html lang = 'en'>
    <body>
        <?php 
        session_start();

        if(isset($_POST['submit'])) {

            $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
            $queryString = "
                SELECT * FROM users
                    WHERE username = '$_POST[username]'
            ";

            $result = pg_query($db, $queryString);

            // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
            $row    = pg_fetch_assoc($result);
            echo"querystring = " .$query_string ;
            echo"give password = " . $_POST['password'];
            
            $userInputPassword = md5($_POST['password']);

            if($_POST['username'] == $row['username'] && $userInputPassword == $row['password']) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['admin'] = $row['admin'];
                header("Location: ../index.php");
            } else {
                header("Location: ../view/login.php?login=error");
                exit();
            }
        } else {
            header("Location: ../view/login.php?login=error");
            exit();
        }
    ?>
    </body>
</html>