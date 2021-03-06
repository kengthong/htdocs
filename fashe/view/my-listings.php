<?php 
    session_start();
    $login = isset($_SESSION['username']);

    if(!$login) {
        header( "Location: error-page.php");
    }

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
    $parts = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parts['query'], $query);
    $userId = $_SESSION['user_id'];

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
    <section class="newproduct bgwhite p-t-45 p-b-105">
        <div class="container">
            <div class="sec-title p-b-60" >
                <h3 class="m-text5 t-center" style='display: flex; flex-direction: row; justify-content: center; align-items: center;'>
                    <div>
                        My Listings
                    </div>
                    <span style='width: 20px'></span>
                    <a href="my-listings.php">
                        <img src="..\images\icons\Listings Icons\checklist.png" alt="delete Listings" style="width:100px;height:100px;border:20;hspace=50">
                    </a>
                </h3>

                
            </div>

            <div style='width: 100%; display: flex; justify-content: flex-start; padding-bottom: 16px;'>
                <a href='my-listings.php' style='font-size: 16px; <?php if(!$query['loaned_out']) {echo"color: #2277ff";}?>' >
                    Available Items
                </a>

                <span style='padding-left: 8px; padding-right: 8px'> 
                    |
                </span>

                <a href='my-listings.php?loaned_out=true' style=' font-size: 16px; <?php if($query['loaned_out']) {echo"color: #2277ff";}?>' '>
                    Items Loaned Out
                </a>
            </div>

            <!-- SQL code to retrieve My listings -->
            <div class="wrap-slick2" style="display: flex; flex-flow: row wrap; width: 100%">

                <?php 
                    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
                    $parts = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($parts['query'], $query);
                    $userId = $_SESSION['user_id'];

                    if($query['loaned_out'] && $query['loaned_out'] == 'true') {
                        $queryString = "
                        SELECT *
                        FROM entry e inner join (select record_id, return_by, borrowed_price, entry_id, owner_received from borrowed_record) as bir
                        ON (bir.entry_id = e.entry_id AND bir.owner_received = FALSE)
                        WHERE e.owner_id = $userId
                        AND e.active = TRUE
                        AND e.available = FALSE
                        ORDER BY bid_closing_date DESC;";

                        $result = pg_query($db, $queryString);
                        if($result) {
                            if(pg_num_rows($result)>0) {
                                $i = 1;
                                while($oneRecord = pg_fetch_array($result)) {
                                    echo"
                                        <div style='width: 50%; margin-right: auto; padding: 8px'> 
                                            <div style='margin-left: auto; border: 1px solid #e8e8e8; border-radius: 8px; padding: 8px'>
                                                <div class='w-100 entry-title flex-row' style='justify-content: space-between'>
                                                    $oneRecord[name]

                                                    <a href='item-detail.php?id=$oneRecord[entry_id]'>
                                                        View more
                                                    </a>
                                                </div>
                        
                                                <div class='flex-col w-90'>
                                                    <div style='width: 100%; display: flex'>
                                                        <div style='width: 20%'>";

                                                        if($oneRecord['image_path'] != '-'){
                                                            echo"
                                                                <img style='height: 100px; width: 100px'
                                                                src='$oneRecord[image_path]'>
                                                            ";
                                                        } else {
                                                            echo "
                                                                <img style='height: 100px; width: 100px'
                                                                src='https://loremflickr.com/320/240/gadgets?lock=$i'>
                                                            ";
                                                        }
                                                            
                                                        echo "</div>
                            
                                                        <div style='width: 30%'>

                                                        </div>

                                                        <form action='../logic/owner_confirm_received.php?record_id=$oneRecord[record_id]&entry_id=$oneRecord[entry_id]' method='POST' style='width: 50%; flex-direction: column; display:flex'>
                                                            <div style='width: 100%; display: flex; align-items: center;'>
                                                                <div style='padding-right: 8px; opacity:0.65; width: 50%'>
                                                                    Return by
                                                                </div>
                                                                <div style='color: #6169e6'>
                                                                    $oneRecord[return_by]
                                                                </div>
                                                            </div>

                                                            <div style='width: 100%; margin-top: 8px; display: flex; align-items: center;'>
                                                                <div style='padding-right: 8px; opacity:0.65; width: 50%'>
                                                                    Meet up location 
                                                                </div>
                                                                <div style='color: #6169e6'>
                                                                    $oneRecord[location]
                                                                </div>
                                                            </div>

                                                            <input name='empty' value='' id='empty' style='display:none'>
                                                            
                                                            <div style='width: 100%; display: flex; justify-content: flex-end; padding-top: 16px;'>
                                                                <button class='btn btn-primary' type='submit' name='submit' style='font-size: 12px'>
                                                                    Confirm received
                                                                </button> 
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }
                                $i = $i + 17;
                            } else {
                                echo"
                                <div style='height: 400px; display: flex; justify-content: center; align-items: center; width: 100%'>
                                    No data
                                </div>
                                ";
                            }
                        } else {
                            echo "Failed to query";
                        }
                    }

                ?>

                <?php 

                    if(!$query['loaned_out']){
                        $queryString = "
                        SELECT *
                        FROM entry e
                        WHERE e.owner_id = $userId
                        AND e.active = TRUE
                        AND e.available = TRUE
                        ORDER BY bid_closing_date DESC;";


                        $result = pg_query($db, $queryString);

                        if($result) {
                            if(pg_num_rows($result) >0) {
                                $i = 1;
                                while($oneRecord = pg_fetch_array($result)) {
                                    echo"
                                        <div class='item-slick2 p-l-15 p-r-15' style='height: 431px; width: 300px; max-width: 25%; margin-top: 8px; margin-bottom: 8px'>
                                            <!-- Block2 -->
                                            <div class='block2' style='border: 1px solid #e8e8e8; border-radius: 8px;'>
                                                <a href='item-detail.php?id=$oneRecord[entry_id]' class='block2-img wrap-pic-w of-hidden pos-relative block2-labelnew'>
                                                    <div style='width: 270px; height: 320px; justify-content:center; align-items: center; display: flex;'>
                                                        <img src='https://loremflickr.com/320/240/gadgets?lock=$i' alt=''>
                                                    </div>
                                                </a>

                                                <div class='block2-txt p-t-20'>
                                                    <div style='width: 95%; padding: 8px; margin-left: auto; margin-right: auto; border-top: 1px solid #e8e8e8'>
                                                        <a href='product-detail.html?id=$oneRecord[entry_id]' style='font-size: 16px'>
                                                            $oneRecord[name]
                                                        </a>

                                                        <span class='block2-name dis-block s-text3 p-b-5' style='opacity:0.8'>
                                                            Current Bid: $$oneRecord[current_bid]
                                                        </span>

                                                        <span style='font-size: 10px;'>
                                                            Bid closes at $oneRecord[bid_closing_date]
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";

                                    $i=$i+10;
                                }
                            } else {
                                echo "
                                    <div style='height: 400px'>
                                        No data currently
                                    </div>
                                ";
                            } 
                        } else {
                            echo" failed to query";
                        }
                    }
                ?>

            </div>
            
            <!--Navigation icons-->
            <!-- <div class = navbar>
            
            <a href="my-listings.php">
                <img src="..\images\icons\Listings Icons\checklist.png" alt="delete Listings" style="width:100px;height:100px;border:20;hspace=50">
                <p>my listings</p>
            </a>

            <a href="addListings.php">
                <img src="..\images\icons\Listings Icons\plus.png" alt="Add Listings" style="width:100px;height:100px;border:0;hspace=50">
                <p>Add listing</p>
            </a>

            <a href="updateListings.php">
                <img src="..\images\icons\Listings Icons\pencil.png" alt="update Listings" style="width:100px;height:100px;border:0;hspace=50">
                <p>update listing  </p>
            </a>
  
            <a href="deleteListings.php">
                <img src="..\images\icons\Listings Icons\minus.png" alt="delete Listings" style="width:100px;height:100px;border:0;hspace=50">
                <p>delete listing</p>
            </a>
            </div> -->
            
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

<?php
    // Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=test");
    //$db     = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");
    $result = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid]'");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    if (isset($_POST['submit'])) {
        echo "<ul><form name='update' action='index.php' method='POST' >  
        <li>Book ID:</li>  
        <li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
        <li>Book Name:</li>  
        <li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
        <li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
        <li>Date of publication:</li>  
        <li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
        <li><input type='submit' name='new' /></li>  
        </form>  
        </ul>";
    }
    if (isset($_POST['new'])) {	// Submit the update SQL command
        $result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
    name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
    date_of_publication = '$_POST[dop_updated]'");
        if (!$result) {
            echo "Update failed!!";
        } else {
            echo "Update successful!";
        }
    }
    ?>  

</body>
</html>
