
<?php 
	session_start();
	$parts = parse_url($_SERVER['REQUEST_URI']);
	parse_str($parts['query'], $query);
	$db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
	// $queryString = "
	// SELECT DISTINCT name, location, description, starting_bid, image_path, entry_id, current_bid, total_quantity, current_quantity, loan_duration, bid_closing_date, owner_id
	// FROM entry
	// WHERE entry_id = " . $query['id'] . ";"; 
	$queryString = "
	SELECT DISTINCT e.name, available, e.location, e.description, e.starting_bid, e.image_path, e.entry_id, e.current_bid, e.total_quantity, e.current_quantity, e.loan_duration, e.bid_closing_date, e.owner_id, bir.user_id as bidder_id
	FROM entry e LEFT OUTER JOIN bid_record bir
	ON e.entry_id = bir.entry_id
	WHERE e.entry_id = $query[id];";

	$_SESSION['active_entry_id'] = $query['id'];
	
	// echo $queryString;
	$result = pg_query($db, $queryString);
	$row = pg_fetch_assoc($result);		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>My borrowed items</title>
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
					<div class='list-an-item-btn'>
						<a href='list-an-item.php' class='header-wrapicon1 dis-block'>
							List An Item
						</a>
					</div>

					<span class='linedivide1'></span>

					<?php 
						$login = isset($_SESSION['username']);

						if($query['bid'] == 'success') {
							echo '<script type="text/javascript">'; 
							echo 'alert("Successfully submitted the bid");'; 
							echo 'window.location.href = "../index.php";';
							echo '</script>';
						}

						if($query['bid'] == 'error'){
							echo "<script type='text/javascript'> 
								alert('Failed to add item. Please make sure that all fields are filled correctly.');
							</script>";
						}

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


	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.html" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="product.html" class="s-text16">
			Women
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="#" class="s-text16">
			T-Shirt
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Boxy T-Shirt with Roll Sleeve Detail
		</span>
	</div>

	<?php 
		if(!$result || $row['available'] == false) {
			echo"redirect to error page?";
			echo "<script type='text/javascript'> document.location = 'error-page.php'; </script>";
		}
	?>

	<!-- Product Detail -->
	<div class='container bgwhite p-t-35 p-b-80'>
		<div class='flex-w flex-sb'>
			<div class='w-size13 p-t-30 respon5'>
				<div class='wrap-slick3 flex-sb flex-w'>
					<!-- <div class='wrap-slick3-dots'></div> -->
					
					<?php
						if($row['image_path'] != "-") {
							echo"
								<div>
									<img src='$row[image_path]' alt='hi' style='max-width: 500px; max-height: 500px'/>
								</div>
							";
						} else {
							echo"
								<div>
									<img src='https://picsum.photos/500/666' alt='hi' width='500px'/>
								</div>
							";
						}
					?>

					
				</div>
			</div>

			<div class='w-size14 p-t-30 respon5'>
				<div style='width: 100%; display: flex;'>
					<div style='width: 70%'>
						<h4 class='m-text17'>
							<?php echo "$row[name]"; ?>
						</h4>
		
						<div class='product-detail-name m-text16 p-b-13' style='width: 100%'>
							<?php 
								if($current_bid != '0') {
									echo"
									<div style='width: 100%;opacity: 0.6; '>
										Current Bid: $ $row[current_bid] 
									</div>"; 
									if($_SESSION['user_id'] == $row['owner_id'] && $row['bidder_id'] != null && $row['available'] == 't') {
										echo"
											<form action='../logic/accept-bid.php' method='POST'>
												<button type='submit' name='accept_bid' class='btn-primary btn' id='accept' style='font-size: 14px;'>
													Accept Bid
												</button>
											</form>
										";
									}
								} else {
									echo"Starting Bid: $row[starting_bid]";
								}
							
							?>
						</div>

						<div style='font-size: 14px; font-weight: 600; opacity: 0.6; width: 100%'>
							<?php if($row['available'] == 't'){echo"Available";} else { echo "Item unavailable";}; ?>
						</div>
					</div>

					<?php 
						if($_SESSION['admin'] == true || $_SESSION['user_id'] == $row['owner_id']){
							echo "
								<div style='width: 30%' >
									<div class='btn-group'>
										<button  class = 'edit-btn' id='edit'>
											Edit 
										</button>
										<button class='delete-btn' id='delete' > 
											Delete 
										</button>
									</div>
								</div>";

							echo "
							<script>
								var editBtn = document.getElementById('edit');
								editBtn.addEventListener('click', function() {
									location.href = 'edit-an-item.php?id=$row[entry_id]';
								})

								var deleteBtn = document.getElementById('delete');
								deleteBtn.addEventListener('click', function() {
									$.ajax({
										type: 'POST',
										url: '../logic/delete-listing.php',
										data:{
											entry_id:'$row[entry_id]',

										},
										success:function(response) {
											console.log('hi');
											console.log(response);
										}
							
									});
									console.log('here');
								}); 

								var acceptBtn = document.getElementById('accept');
								acceptBtn.addEventListener('click', function() {
									location.href = 'edit-an-item.php?id=$row[entry_id]';
								})

								
									
							</script>";
						};
					?>
				</div> 

				<div class='wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content'>
					<h5 class='js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4'>
						Description
						<i class='down-mark fs-12 color1 fa fa-minus dis-none' aria-hidden='true'></i>
						<i class='up-mark fs-12 color1 fa fa-plus' aria-hidden='true'></i>
					</h5>

					<div class='dropdown-content dis-none p-t-15 p-b-23'>
						<p class='s-text8'>
							<?php 
								$description = $row['description'];
								if($description) {
									echo"
										$description
									";
								} else {
									echo"
										No description
									";
								}
							?>
						</p>
						<p class='s-text8'
							<?php echo"Bid closes at $row[bid_closing_date]";?>
						</p>
					</div>
				</div>

				<div class='wrap-dropdown-content bo7 p-t-15 p-b-14'>
					<h5 class='js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4'>
						Additional information
						<i class='down-mark fs-12 color1 fa fa-minus dis-none' aria-hidden='true'></i>
						<i class='up-mark fs-12 color1 fa fa-plus' aria-hidden='true'></i>
					</h5>

					<div class='dropdown-content dis-none p-t-15 p-b-23'>
						<div style='width: 100%; display:flex'>
							<div style='width: 30%; font-size: 14px; font-weight: 600; opacity: 0.8'>
								Location:
							</div>
							<div class='s-text8' style='width: 70%'>
								<?php echo"$row[location]"; ?>
							</div>
						</div>

						<div style='width: 100%; display:flex'>
							<div style='width: 30%; font-size: 14px; font-weight: 600; opacity: 0.8'>
								Loan Duration:
							</div>
							<div class='s-text8' style='width: 70%'>
								<?php echo"$row[loan_duration]"; ?>
							</div>
						</div>
					</div>
				</div>

				<!--  -->
				<?php
					if($_SESSION['user_id'] && $_SESSION['user_id'] != $row['owner_id'] && $row['current_quantity'] != '0') {
						echo"
						<div class='p-t-33 p-b-60'>
							<div class='flex-r-m flex-w p-t-10:' style='flex-direction: column; display: flex'>
								<form action='../logic/make-bid.php' method='POST'>
									<div style='width: 100%; display: flex; flex-direction: row'>
										<div style='width: 30%'>
											Bidding Price: 
										</div>
										<div style='width: 70%'>
											<span>$</span>
											<input name='new_bid' style='border: 2px solid #e6e6e6 !important; border-radius: 3px;'/>
										</div>
									</div>
									<div class='flex-m flex-w' style='width: 100%; padding-left: 8px;'>
										<div style='display: flex; flex-direction: row; align-items: center; margin-left: -8px;margin-right: 16px;'>
											<div class='flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10'>

												<input name='quantity' class='size8 m-text18 t-center num-product' id='quantityInput'type='number' name='num-product' value='1' max='$row[current_quantity]'>
											</div>
											out of $row[current_quantity]
										</div>

										<div class='btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10'>
											<!-- Button -->
											<button id='submitBid' type='submit' name='submit' class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4'>
												Make Bid
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						";
					}

					$bid = $query['bid'];
					echo"
						<script type='text/javascript'>
							var quantityInput = document.getElementById('quantityInput');
							if(quantityInput) {
								quantityInput.addEventListener('change', function(){
									console.log('quantityInput.value', quantityInput.value);
									console.log('quantityInput.innerHtml', quantityInput.innerHtml);
									if(quantityInput.value > $row[current_quantity]){
										quantityInput.value = $row[current_quantity];
									}
	
								})
							}
						</script>
					";

				?>
				

				

			</div>
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

			<div class="t-center s-text8 p-t-20">
				Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
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

