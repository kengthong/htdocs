<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: ../../login.php");
    };

    $db = pg_connect("host=127.0.0.1  port=8080 dbname=cs2102Project user=postgres password=kengthong");	
    $queryString = "
        SELECT * FROM users where user_id = '$_SESSION[user_id]'; 
    ";
    $result = pg_query($db, $queryString);
    $row    = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Settings</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../../images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../css/util.css">
	<link rel="stylesheet" type="text/css" href="../../css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">

			<div class="wrap_header">
				<!-- Logo -->
				<div class="wrap_header">
                    <!-- Logo -->
                    <a href="../../index.php" class="logo">
                        <img src="../../images/cs2102.png" alt="IMG-LOGO" style="width: 80px">
                    </a>

                    <!-- Header Icon -->
                    <div class='header-icons'>

                        <div class='list-an-item-btn'>
                            <a href='../list-an-item.php' class='header-wrapicon1 dis-block'>
                                List An Item
                            </a>
                        </div>

                        <span class='linedivide1'></span>

                        <?php 
                            $login = isset($_SESSION['username']);

                            if($login) {
                                echo "
                                    <!-- Header Icon -->
                                            

                                    <div class='header-wrapicon2 js-show-header-dropdown header-icon1' style='width: 52px'>
                                        <img src='../../images/icons/icon-header-01.png' class='header-icon1' alt='ICON'>
                                        <span class='header-icon-notif'>0</span>
                                        <span class='caret'></span>

                                        <!-- Header cart noti -->
                                        <div class='header-user header-dropdown' style='width: 200px'>
                                            <div style='border-bottom: 1px solid #e8e8e8; padding-bottom: 8px; display:flex; justify-content: flex-end'>
                                                $_SESSION[name]
                                            </div>
                                            <ul class='header-cart-wrapitem' style='align-items: flex-end;display: flex; flex-direction: column;'>
                                                <li class='header-cart-item'>
                                                    <a href='../my-listings.php'>
                                                        My Listings
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='../borrowed-items.php'>
                                                        My borrowed items
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='../settings/profile.php'>
                                                        Setting
                                                    </a>
                                                </li>

                                                <li class='header-cart-item'>
                                                    <a href='../logout.php'>
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
		</div>
	</header>

    <div class="container">
        <div class="page-body container">
            <section class="row settings-wrapper">
                <div class="col-md-3 col-sm-4" style='padding: 0px'>
                    <ul style='flex-direction: column; display: flex;'>
                        <li class="settings-type-row" style='background: #fff;' >
                            <a href="profile.php" class="F-g" style='font-size: 18px; color: #4b4d52; font-weight: 600;'>
                                <b>Edit Profile</b>
                            </a>
                        </li>
                        <li class="settings-type-row">
                            <a href="password.php" class="F-g">
                                <span>Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-8 F-h" style='background-color: white'>
                    <form autocomplete="off" class="cs-form F-i" action='../../logic/change-profile.php' method='POST'>
                        <div style='font-size: 20px; padding: 16px;color: #666;text-shadow: 0 1px 1px #fff;font-weight: 800;text-transform: uppercase;letter-spacing: 2px; text-align:center;'>
                            <span class="letterpress-heading-text mod-bg-white">
                                Edit Profile
                            </span>
                        </div>
                        <div class="cs-form-section">   
                            <div style='width: 100%; padding: 8px;'>
                                Public Profile
                            </div>
                            <div class='settings-big-box'>
                                <div class="form-group cs-form-group">
                                    <label>
                                        Username
                                    </label>
                                    <input 
                                        type="text" autocapitalize="off" autocomplete="off" autocorrect="off" 
                                        placeholder="Username" 
                                        name='username'
                                        id="username" 
                                        class="form-control"
                                        style="border-bottom: 1px solid #e8e8e8 !important;  opacity:0.65;">
                                </div>
                                <div class="form-group cs-form-group">
                                    <label>
                                        Name
                                    </label>
                                    <input 
                                        type="text" autocapitalize="off" autocomplete="off" autocorrect="off" 
                                        placeholder="Your name" 
                                        name='name'
                                        id="name" 
                                        class="form-control"
                                        style="border-bottom: 1px solid #e8e8e8 !important;  opacity:0.65;">
                                </div>
                                <div class="form-group cs-form-group">
                                    <label>
                                        Contact Number
                                    </label>
                                    <input 
                                        type="text" autocapitalize="off" autocomplete="off" autocorrect="off" 
                                        placeholder="+65"
                                        name='contact_number'
                                        id="contact_number" 
                                        class="form-control"
                                        style="border-bottom: 1px solid #e8e8e8 !important;  opacity:0.65;">
                                </div>
                                <div class="form-group cs-form-group">
                                    <label>
                                        Email
                                    </label>
                                    <input 
                                        type="email" 
                                        placeholder="example@gmail.com"
                                        required
                                        name='email'
                                        id='email'
                                        class="form-control"
                                        style="border-bottom: 1px solid #e8e8e8 !important;  opacity:0.65;">
                                </div>
                            </div>
                        </div>
                            
                        <div style='width: 100%; justify-content: flex-end; display: flex; padding: 8px;'>
                            <button type="submit" name='change-profile-submit'class="btn F-b btn-primary">
                                <span>Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <?php
		echo"
			<script type='text/javascript'>
				
				document.getElementById('username').defaultValue = '$row[username]';
				document.getElementById('name').defaultValue = '$row[name]';
				document.getElementById('contact_number').defaultValue = '$row[contact_number]';
				document.getElementById('email').defaultValue = '$row[email]';

			</script>
		";
    ?>
    
    <?php
        $parts = parse_url($_SERVER['REQUEST_URI']);
        parse_str($parts['query'], $query);

        if($query['changed'] == 'success') {
            echo '<script type="text/javascript">'; 
            echo 'alert("Successfully updated your profile");'; 
            echo 'window.location.href = "../index.php";';
            echo '</script>';
        }

        if($query['changed'] == 'error'){
            echo "<script type='text/javascript'> alert('Failed to update profile. Ensure all fields are filled');</script>";
        }
    ?>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="../../js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="../../vendor/sweetalert/sweetalert.min.js"></script>
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

		var registerBtn = document.getElementById('register');
		registerBtn.addEventListener('click', function() {
			window.location.href='register.php';
		})
	</script>

<!--===============================================================================================-->
	<script src="../../js/main.js"></script>

</body>
</html>
