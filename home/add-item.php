<?php

    function base_url()
    {
        $url = "http://" . $_SERVER['HTTP_HOST'];
        return $url;
    }

    if(isset($_POST['submit'])) {
        #code...

    }

    if(isset($_POST['add-item'])) {
        $url = baseurl();
        // $testUrl = 'google.com';
        // header("Location: ".$testUrl);
        echo '<script type="text/javascript">
            window.location = "http://www.google.com/"
        </script>';
        // $full_url = $url . '/add-item/index.php';
        // header("Location: $full_url");
    }

?>