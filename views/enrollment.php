<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/regular.css" integrity="sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css" integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
	<link href="/views/css/enrollment.css" rel="stylesheet">
	<title>Enrollment</title>
</head>
<body>
	<?php
		if (isset($_SESSION['user_id'])) {
			echo 'Hello ' . $_SESSION['user_login'];
	?>
		<a href="/logout"><button>Logout</button></a>

	<?php } ?>
	<div class="enrollment-wrapper">
		<div class="sign-in-wrapper">
		
			<div class="banner">
				<a href="/">
					<i class="fab fa-grav fa-4x"></i>
					<div class="banner-text">Photo Creator</div>
					<div id="dot">.</div>
				</a>
			</div>
			<?php if (!isset($_SESSION['user_id'])) { ?>
			<div class="sign-up-wrapper">
				<p id="text">Don't have an account?</p>
				<div id="sign-up">Sign Up</div>
			</div>

			<div class="form-wrapper">
				<form method="post" action="signin" id="sign-in-form" name="enrollment-form">

					<div class="input-name" id="login-div">Login</div>
					<input type="text" name="login" id="login-input" required>

					<div class="input-name disappear" id='email-div'>Email</div>
					<input class="disappear" type="email" name="email" id='email-input'>

					<div class="input-name" id="pass-div">Password</div>
					<input type="password" name="password" id="pass-input" required >

					<div class="input-name disappear" id="re-pass-div">Retype password</div>
					<input class="disappear" type="password" name="repassword" id="re-pass-input">

					<div class='input-name forgot-pass'>Forgot my password</div>
					<input class="login-button" type="submit" value="Sign In" required>
				</form>
				<div id='error' class='fade-in fade-out'></div>
				
			</div>
		</div>
	</div>
		<?php } ?>
	<?php include 'footer.php';?>
	<script src="/views/js/enrollment.js"></script>
</body>
</html>