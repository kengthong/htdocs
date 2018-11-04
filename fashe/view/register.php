<?php
    session_start();
    if(isset($_SESSION['username'])) {
        echo"
            <div>
                Redirecting
            </div>
        ";
        
        header("Location: ../index.php");
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
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

			<div class="wrap_header">
				<!-- Logo -->
				<a href="../index.php" class="logo">
					<img src="../images/cs2102.png" alt="IMG-LOGO" style="width: 80px">
				</a>

			</div>
		</div>
	</header>

    <div class="container">
        <div style='border: 1px solid #e8e8e8; border-radius: 8px; padding: 16px; width: 80%; margin-left: auto; margin-right: auto;'>
            <div style='font-weight: bold; border-bottom: 1px solid #e8e8e8; padding-bottom: 14px; margin-bottom: 36px;'> 
                Register as a new user
            </div>
            <form action="../logic/register.php" method="POST" class='row' style='width: 95%; margin-left: auto; margin-right: auto'>
                <div class='col-lg-6'>
                    <div class='row register-row'>
                        <div class='col-lg-5 form-labels'>
                            Username
                        </div>

                        <div class='col-lg-7'>
                            <input 
                                name='username'
                                type='text'
                                class='register-form'
                                style="opacity:0.65;"
                                placeholder="username"
                            />
                        </div>
                    </div>

                    <div class='row register-row'>
                        <div class='col-lg-5 form-labels'>
                            Name
                        </div>

                        <div class='col-lg-7'>
                            <input 
                                name='name'
                                type='text'
                                class='register-form'
                                style="opacity:0.65;"
                                placeholder="name"
                            />
                        </div>
                    </div>

                    <div class='row register-row'>
                        <div class='col-lg-5 form-labels'>
                            Email
                        </div>

                        <div class='col-lg-7'>
                            <input 
                                name='email'
                                type='text'
                                class='register-form'
                                style="opacity:0.65;"
                                placeholder="email"
                            />
                        </div>
                    </div>
                </div>
                <div class='col-lg-6'>
                    <div class='row register-row'>
                        <div class='col-lg-5 form-labels'>
                            Password
                        </div>

                        <div class='col-lg-7'>
                            <input 
                                name='password'
                                type='password'
                                class='register-form'
                                style="opacity:0.65;"
                                placeholder="password"
                            />
                        </div>
                    </div>

                    <div class='row register-row'>
                        <div class='col-lg-5 form-labels'>
                            Contact Number
                        </div>

                        <div class='col-lg-7'>
                            <input 
                                name='contact_number'
                                type='text'
                                class='register-form'
                                style="opacity:0.65;"
                                placeholder="+65"
                            />
                        </div>
                    </div>
                </div>

                <div style='height: 40px; width: 100%'></div>

                <div class='register-buttons-row'>
                    <button name="submit" type="submit" class="btn btn-primary"> 
                        Register
                    </button>
                    <button type='button' class='btn' id='cancelBtn'style='opacity: 0.65;width: 92px; border: 2px solid #e8e8e8 !important;'> 
                        Cancel 
                    </button>
                </div>
                
                <!-- //user_id, password, username, name, contact_number, email, admin -->
			</form>
			
        </div>
    </div>

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