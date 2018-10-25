<?php 
    session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="custom-styles.css">
    <link rel="stylesheet" href="css/core-style.css">

    <!-- <link rel="stylesheet" href="style.css" type="text/css"/> -->

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/cs2102.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/cs2102.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="shop.html">My Items</a></li>
                    <li><a href="product-details.html">Product</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="cart.html" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="img/core-img/airsfavorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-8" >
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products" style="border-bottom: 1px solid #e8e8e8">
                                My Entry
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-4">
                        <button id="add-item-button" class="add-item-button">
                            Add an item
                        </button>
                    </div> -->
                </div>

                <?php 
                    $parts = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($parts['query'], $query);
                    echo "$query[id]";
                    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
                    $queryString = "
                    SELECT DISTINCT name, entry_id, current_bid, total_quantity, current_quantity, loan_duration, bid_closing_date
                    FROM entry 
                    WHERE owner_id = " . $_SESSION['user_id']. "
                    AND entry_id = " . $query['id'] . ";"; 
                    
                    // echo $queryString;
                    $result = pg_query($db, $queryString);
                    $row = pg_fetch_assoc($result);		
                    if($result) {
                        $amount_left = $row['total_quantity'] - $row['current_quantity'];
                        echo "
                        <div class='w-100 flex-col' style='display: flex; padding: 16px; border-radius: 8px; border: 1px solid #e8e8e8;'>
                            <div>
                                $row[name]
                            </div>
                            <div class='w-100 flex-row'>
                                <div class='w-30'>
                                    <img style='height: 120px; width: 120px'
                                    src='https://picsum.photos/200/300/?random'>
                                </div>
                                <div class='w-70 flex-col'>
                                    <div style='padding-bottom:8px; font-size: 16px;'>
                                        Details: 
                                    </div>

                                    <div style='font-size: 14px; opacity: 0.8; font-weight: 300';>
                                        <div>
                                            Current Bid: $$row[current_bid]
                                        </div>
                                        <div>
                                            Current Qty: $row[current_quantity]
                                        </div>
                                        <div>
                                            Amount Left: $amount_left
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    } else {
                        echo"failed";
                    }


                    //LIST BIDS (ONLY CAN BE DONE AFTER BIDS_RECORD IS POPULATED)
                    
                    $query_for_highest_bid = "
                        SELECT dISTINCT u.username as username, u.name as name, u.user_id as user_id, u.contact_number as contact_number, e.current_bid as current_bid, e.entry_id as entry_id, bir.quantity as quantity
                        FROM users u, entry e, bid_record bir
                        WHERE e.entry_id = $query[id]
                        AND u.user_id = bir.user_id
                        AND e.entry_id = bir.entry_id
                        AND e.current_bid = bir.bid_amount;";

                    $highest_bid_result = pg_query($db, $queryString);
                    $hbr = pg_fetch_assoc($highest_bid_result);	
                    
                    if($hbr) {

                        echo"
                            <div class='w-100 flex-col' style='display: flex; padding: 16px; border-radius: 8px; border: 1px solid #e8e8e8;'>
                                <div>
                                    Name: $hbr[name]
                                </div>
                                <div>
                                    Contact number: $hbr[contact_number]
                                </div>

                                <div class='flex-col'>
                                    Bid amount: $hbr[current_bid]
                                    Quantity: $hbr[quantity]
                                </div>

                                <form action='accept-bid.php' method='POST'>
                                    <button name='accept_bid'>
                                        Accept bid    
                                    </button>
                                </form>

                            </div>	
                        ";
                    } else {
                        echo" failed to retrieve bids";
                    }

                ?>

            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.php"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.html">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="product-details.html">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.html">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.html">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <script>
        var addItemBtn = document.getElementById("add-item-button")
        var baseUrl = "http://localhost:8080/";
        addItemBtn.addEventListener('click', function() {
            document.location.href=baseUrl + 'app/add-item/index.php';
        })
    </script>

</body>

</html>