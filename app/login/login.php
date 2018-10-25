<?php 
    #query database
    session_start();

    if(isset($_POST['submit'])) {

        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $queryString = "
            SELECT * FROM users
                WHERE username = '$_POST[username]'
                AND password = '$_POST[password]' 
        ";

        $result = pg_query($db, $queryString);

        // $result = pg_query($db, "SELECT * FROM book WHERE book_id = '$_POST[bookid]'");		// Query template
        $row    = pg_fetch_assoc($result);
        
        if($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            header("Location: ../my-items.php");
        } else {
            header("Location: index.php?login=errpr");
            exit();
        }
        
        
    // } else {
    //     echo"
    //         <div>
    //             login failed
    //         </div>
    //     ";  
    } else {
        header("Location: index.php?login=error");
        exit();
    }
?>