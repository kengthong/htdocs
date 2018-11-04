<?php
    if(isset($_POST['submit'])) {
        echo"
            <div>works</div>
        ";
        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
        $q_str = "select * from users where username= '".$_POST['username'] . "';";
        $res = pg_query($db, $q_str);
        $count = pg_num_rows($res);

        $data = pg_fetch_assoc($res);
        echo"<div> hi $data[username] $q_str</div>";
        if($count >0) {
            header("Location: ../view/register.php?register=error");
        } else {
            $query_string = "insert into users(name, email, password, contact_number, username, admin) values($1, $2, $3, $4, $5, $6);";
            $name = strval($_POST['name']);
            $email = strval($_POST['email']);
            $password = strval($_POST['password']);
            $contact_number = strval($_POST['contact_number']);
            $username = strval($_POST['username']);

            $query = pg_query_params($db, $query_string, 
                array($name, $email, $password, $contact_number, $username, 'false')
            );
            
            header("Location: ../view/login.php?register=success");
        }
        
    } else {
        header("Location: register.php?register=error");
    }
?>