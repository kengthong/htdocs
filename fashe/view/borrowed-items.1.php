<?php 
    session_start();
    $login = isset($_SESSION['username']);

    if(!$login) {
        header( "Location: error-page.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Listings</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->
    </head>
    <body class="animsition">

        <!-- Header -->
        <header class="header1">
            <!-- Header desktop -->
            <div class="container-menu-header">
                <div class="topbar">
                    <div class="topbar-social">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>

                    <span class="topbar-child1">
                        Free shipping for standard order over $100
                    </span>

                    <div class="topbar-child2">
                        <span class="topbar-email">
                            hustlers@u.nus.edu
                        </span>

                        <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>SGD</option>
                                <option>USD</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="wrap_header">
                    <!-- Logo -->
                    <a href="../index.php" class="logo">
                        <img src="../images/cs2102.png" alt="IMG-LOGO" style="width: 80px">
                    </a>

                    <!-- Header Icon -->
                    <div class='header-icons'>

                        <span class='linedivide1'></span>

                        <?php 
                            $login = isset($_SESSION['username']);

                            if($login) {
                                echo "
                                    <!-- Header Icon -->
                                            

                                    <div class='header-wrapicon2 js-show-header-dropdown header-icon1' style='width: 52px'>
                                        <img src='../images/icons/icon-header-01.png' class='header-icon1' alt='ICON'>
                                        <span class='header-icon-notif'>0</span>
                                        <span class='caret'></span>

                                        <!-- Header cart noti -->
                                        <div class='header-user header-dropdown' style='width: 200px'>
                                            <div style='border-bottom: 1px solid #e8e8e8; padding-bottom: 8px; display:flex; justify-content: flex-end'>
                                                $_SESSION[name]
                                            </div>
                                            <ul class='header-cart-wrapitem' style='align-items: flex-end;display: flex; flex-direction: column;'>
                                                <li class='header-cart-item'>
                                                    <a href='my-listings.php'>
                                                        My Listings
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='borrowed-items.php'>
                                                        My borrowed items
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='my-bids.php'>
                                                        My bids
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='settings/profile.php'>
                                                        Setting
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='logout.php'>
                                                        Log Out
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>	
                                    </div>							
                                    ";
                            } else {
                                //prompt login button
                                echo "
                                    <button type='submit' id='loginBtn'>
                                        Log In
                                    </button>
                                ";

                                echo "
                                <script type='text/javascript'>
                                    document.getElementById('loginBtn').onclick = function () {
                                        location.href = 'login.php';
                                    };
                                </script>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- PUT YOUR CODE HERE -->
        <!-- Retrieve my current listings -->
        <section class="newproduct bgwhite p-b-105" style='min-height: 500px; padding-top: 20px;'>
            <div class="container">
                <div class="sec-title p-b-60" >
                    <div style='width: 100%; height: 40px; border-bottom: 1px solid #e8e8e8; font-size: 22px;'>
                        Borrowed Items
                    </div>
                </div>
                <!-- SQL code to retrieve My listings -->
                <div class="wrap-slick2" style="display: flex; flex-flow: row wrap;">
                    <?php 
                        #query database
                        $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
                        $queryString = "
                            select * 
                            from borrowed_record bir INNER JOIN (SELECT e.entry_id, e.name, e.current_bid, e.bid_closing_date, e.image_path, e.location
                            FROM entry e ) as e
                            ON bir.entry_id = e.entry_id
                            WHERE bir.borrower_id = 1;
                        ";

                        $result = pg_query($db, $queryString);

                        if($result) {
                            if(pg_num_rows($result) >0) {
                                $i = 2;
                                while($oneRecord = pg_fetch_array($result)) {
                                    // echo"$oneRecord[name]";

                                    echo"
                                        <div style='width: 100%; border: 1px solid #e8e8e8; border-radius: 8px; padding: 8px'>
                                            <div class='w-100 entry-title flex-row' style='justify-content: space-between'>
                                                $oneRecord[name]

                                                <a href='my-entry.php?id=$oneRecord[entry_id]'>
                                                    View more
                                                </a>
                                            </div>
                    
                                            <div class='flex-col w-90'>
                                                <div class='w-100 flex-row'>
                                                    <div class='w-30'>
                                                        <img style='height: 100px; width: '00px'
                                                        src='https://loremflickr.com/320/240/gadgets?lock=$i'>
                                                    </div>
                        
                                                    <div class='w-70'>
                                                        <div class='row w-100'>
                                                            $$oneRecord[current_bid]
                                                        </div>
                        
                                                        <div class='row w-100'>
                                                            $oneRecord[current_quantity]/$oneRecord[total_quantity]
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div>
                                                    Bid closing date: $oneRecord[bid_closing_date]
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                    $i = $i + 17;
                                }
                            } else {
                                echo"less than 1";
                            }
                        } else {
                            echo"
                                <div style='width: 100%; height: 400px;justify-content: center; font-size: 16px; opacity: 0.8; display: flex; align-items: center'>
                                    You have no borrowed items currently.
                                </div>
                            ";
                        }

                    ?>
                    
                </div>
                
            </div>
        </section>


        <!-- Footer -->
        <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
            <div class="flex-w p-b-90">
                <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                    <h4 class="s-text12 p-b-30">
                        GET IN TOUCH
                    </h4>

                    <div>
                        <p class="s-text7 w-size27">
                            Any questions? Let us know in store at National University of Singapore COM2 or call us on (+65) 9676 6879
                        </p>

                        <div class="flex-m p-t-30">
                            <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                            <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                            <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
                            <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                            <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                        </div>
                    </div>
                </div>

                <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                    <h4 class="s-text12 p-b-30">
                        Categories
                    </h4>

                    <ul>
                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Men
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Women
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Dresses
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Sunglasses
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                    <h4 class="s-text12 p-b-30">
                        Links
                    </h4>

                    <ul>
                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Search
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                About Us
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Contact Us
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Returns
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                    <h4 class="s-text12 p-b-30">
                        Help
                    </h4>

                    <ul>
                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Track Order
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Returns
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                Shipping
                            </a>
                        </li>

                        <li class="p-b-9">
                            <a href="#" class="s-text7">
                                FAQs
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                    <h4 class="s-text12 p-b-30">
                        Newsletter
                    </h4>

                    <form>
                        <div class="effect1 w-size9">
                            <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                            <span class="effect1-line"></span>
                        </div>

                        <div class="w-size2 p-t-20">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                                Subscribe
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="t-center p-l-15 p-r-15">
                <a href="#">
                    <img class="h-size2" src="../images/icons/paypal.png" alt="IMG-PAYPAL">
                </a>

                <a href="#">
                    <img class="h-size2" src="../images/icons/visa.png" alt="IMG-VISA">
                </a>

                <a href="#">
                    <img class="h-size2" src="../images/icons/mastercard.png" alt="IMG-MASTERCARD">
                </a>

                <a href="#">
                    <img class="h-size2" src="../images/icons/express.png" alt="IMG-EXPRESS">
                </a>

                <a href="#">
                    <img class="h-size2" src="../images/icons/discover.png" alt="IMG-DISCOVER">
                </a>
                
            </div>
        </footer>



        <!-- Back to top -->
        <div class="btn-back-to-top bg0-hov" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="fa fa-angle-double-up" aria-hidden="true"></i>
            </span>
        </div>

        <!-- Container Selection1 -->
        <div id="dropDownSelect1"></div>



    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/bootstrap/js/popper.js"></script>
        <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/select2/select2.min.js"></script>
        <script type="text/javascript">
            $(".selection-1").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });
        </script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/slick/slick.min.js"></script>
        <script type="text/javascript" src="../js/slick-custom.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/lightbox2/js/lightbox.min.js"></script>
    <!--===============================================================================================-->
        <script type="text/javascript" src="../vendor/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.block2-btn-addcart').each(function(){
                var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to cart !", "success");
                });
            });

            $('.block2-btn-addwishlist').each(function(){
                var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");
                });
            });
        </script>

    <!--===============================================================================================-->
        <script src="../js/main.js"></script>

    </body>
</html>
