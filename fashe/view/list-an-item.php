
<?php 
    session_start();
    $login = isset($_SESSION['username']);

    $parts = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parts['query'], $query);


    if(!$login) {
        header( "Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>List An Item</title>
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

	<!-- Product Detail -->
	<div class='container bgwhite p-t-35 p-b-80'>

        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                List a new item
            </h3>
        </div>
		<div class='flex-w flex-sb'>
			<form action="../logic/list-an-item.php" method="POST" class='row' enctype="multipart/form-data" style='width: 100%'>
                <div class='w-size13 p-t-30 respon5' style='padding-right: 16px; width:50%'>
                    <div class='wrap-slick3 flex-sb flex-w' style='display: flex; flex-direction: column'>
                        <!-- <div class='wrap-slick3-dots'></div> -->
                        
                        <input class='image-placeholder' type="button" value="Upload +" onclick="document.getElementById('fileToUpload').click();" />

                        <div style='display:flex; justify-content: space-between'>
                            <div id="filename" style='padding: 4px 8px; color:#3f83f1;'></div>    
                            <input class='upload-image-btn' type='button' value = 'Choose a file' onclick="document.getElementById('fileToUpload').click()" />
                        </div>
                        
                        <input type="file" name="upload-image" id="fileToUpload" style='display:none'>
                        

                        <script type="text/javascript">

                            var uploadBtn = document.getElementById('fileToUpload');
                            var fileNameDiv = document.getElementById('filename');
                            uploadBtn.addEventListener('change', function() {
                                console.log("value = " , uploadBtn.value);
                                var parts = uploadBtn.value.split('\\');
                                var fileName = parts[parts.length-1];
                                fileNameDiv.innerText = fileName;
                            })
                        </script>
                        
                    </div>
                </div>

                <div class='w-size14 p-t-30 respon5' style='width: 50%'>
                    <div class='col-lg-12' style='padding-left: 16px;'>
                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Name
                            </div>

                            <div class='col-lg-8'>
                                <input 
                                    name='name'
                                    type='text'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="Name of Listing"
                                />
                            </div>
                        </div>
                        
                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Description
                            </div>

                            <div class='col-lg-8'>
                                <textArea
                                    name='description'
                                    type='text'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="Description"
                                ></textArea>
                            </div>
                        </div>

                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Location
                            </div>

                            <div class='col-lg-8'>
                                <input 
                                    name='location'
                                    type='text'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="Meet up location"
                                />
                            </div>
                        </div>

                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Starting Bid
                            </div>

                            <div class='col-lg-8'>
                                <input 
                                    name='starting_bid'
                                    type='number'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="$0"
                                />
                            </div>
                        </div>

                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Total Quantity
                            </div>

                            <div class='col-lg-8'>
                                <input 
                                    name='total_quantity'
                                    type='number'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="1"
                                />
                            </div>
                        </div>

                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Bid Closing Date
                            </div>

                            <div class='col-lg-8'>
                                <input 
                                    name='bid_closing_date'
                                    type='date'
                                    class='register-form'
                                    style="opacity:0.65;"
                                    placeholder="YYYY/MM/DD"
                                />
                            </div>
                        </div>

                        <div class='row register-row'>
                            <div class='col-lg-4 form-labels'>
                                Loan Duration
                            </div>

                            <div class='col-lg-8'>
                                <input type="radio" name="loan_duration" value="1" checked> 1<br>
                                <input type="radio" name="loan_duration" value="2"> 2<br>
                                <input type="radio" name="loan_duration" value="7"> 7<br>
                                <input type="radio" name="loan_duration" value="14"> 14<br>
                            </div>
                        </div>
                    </div>

                    <div style='height: 40px; width: 100%'></div>

                    <div class='register-buttons-row'>
                        <button name="fileSubmitted" type="submit" class="btn btn-primary"> 
                            Submit
                        </button>
                        <button 
                            type='button' 
                            class='btn' 
                            id='cancelBtn'
                            style='opacity: 0.65;width: 92px; border: 2px solid #e8e8e8 !important;'> 
                            Cancel 
                        </button>
                    </div>

                    <?php
                        echo"
                            <script type='text/javascript'>
                                var cancelBtn = document.getElementById('cancelBtn');
                                cancelBtn.addEventListener('click', function() {
                                    location.href='../index.php';
                                })
                            </script>
                        ";
                    ?>
                </div>
            </form>

            <?php
                if($query['add'] == 'success') {
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Successfully listed an item. Redirecting back to the home page");'; 
                    echo 'window.location.href = "../index.php";';
                    echo '</script>';
                }

                if($query['add'] == 'error'){
                    echo "<script type='text/javascript'> alert('Failed to add item. Please make sure that all fields are filled.</script>";
                }
            ?>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					GET IN TOUCH
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
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



