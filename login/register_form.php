<?php

session_start();
require('log.php');

// Here we check a session is already ON
if (isset($_SESSION['connect'])) {
	header('location: ../index.php');
	exit();
}


if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])) {
	include('../src/connect.php');
	// variables
	$email 					= htmlspecialchars($_POST['email']);
	$password 				= htmlspecialchars($_POST['password']);
	$password_two  			= htmlspecialchars($_POST['password_two']);

	// password = password_two ?
	if ($password != $password_two) {
		header('location: register_form.php?error=1&message=Non identical password.');
		exit();
	}

	// email adress valid ?
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location : register_form.php?error=1&message=Email adress invalid');
		exit();
	}

	// email already exists ?
	$req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
	$req->execute(array($email));

	while ($email_verification = $req->fetch()) {
		if ($email_verification['numberEmail'] != 0) {
			header('location: register_form.php?error=1&message=Email already used.');
			exit();
		}
	}

	// hash
	$secret = sha1($email);

	// encryption password 
	$password = "aq1" . sha1($password . "123") . "25";

	// sending
	$req = $db->prepare("INSERT INTO user(email, password, secret) VALUES (?,?,?)");
	$req->execute(array($email, $password, $secret));
	header('location: profil_select.php?email=' . $email . '');
	exit();
}
?>



<!DOCTYPE html>

<head>
	<title>NOVA · Create an account</title>
	<?php include "../src/head_meta_tags.php"; ?>
	<link href="styles/styles.css" rel="stylesheet">
</head>

<body>



	<div class="container1">

		<!-- <img src="./images/logo.png" class="logo_login" alt="logo planet nova"/> -->
		<div class="logo_div_loginForm">
			<svg version="1.1" id="Calque_1" x="0px" y="0px" viewBox="0 0 115.83 106.61" enable-background="new 0 0 115.83 106.61">
				<g>
					<path fill="#FFFFFF" d="M90.224,63.354C81.04,70.287,72.823,78.416,65.79,87.523c-2.182,3.241-7.033,10.848-4.501,15.127
		c2.316,3.914,10.163,1.166,13.534,0.258c11.996-3.234,22.273-10.987,28.679-21.633c6.405-10.645,8.441-23.358,5.68-35.471
		C103.077,51.872,96.73,57.72,90.224,63.354L90.224,63.354z" />
					<path fill="#FFFFFF" d="M23.843,90.557c2.063-0.556,4.282-1.27,6.622-2.134c0.275-0.097,0.536-0.202,0.809-0.31
		c13.94-5.654,27.122-13.024,39.24-21.938c12.594-8.745,24.016-19.066,33.988-30.71c0.444-0.548,0.877-1.094,1.287-1.633
		c8.342-10.757,10.615-18.961,6.734-24.37c-4.073-5.693-13.224-5.973-27.217-0.821l0.001-0.001c-0.057,0.017-0.113,0.04-0.167,0.069
		C74.462,2.334,61.728,0.348,49.617,3.168C37.505,5.987,26.958,13.394,20.196,23.83c-6.763,10.435-9.217,23.087-6.845,35.294
		C3.573,70.442-1.453,81.035,3.253,87.612C6.65,92.341,13.557,93.33,23.843,90.557L23.843,90.557z M94.189,15.18
		c7.714-2.08,10.693-1.006,11.044-0.521l0.003,0.011c0.348,0.474,0.402,3.554-3.848,9.973c-2.123-3.423-4.673-6.564-7.585-9.348
		C93.93,15.25,94.06,15.215,94.189,15.18L94.189,15.18z M16.556,69.375c1.873,4.281,4.371,8.259,7.413,11.806
		c-9.495,3.001-13.041,1.755-13.428,1.221C10.147,81.847,10.132,77.877,16.556,69.375L16.556,69.375z" />
				</g>
				<rect x="0.118" y="0.11" fill="none" width="115.712" height="106.615" />
			</svg>
		</div>


		<h1 class="txtHelloRegister">You're a star,<br> join our Galaxy!</h1>


		<!-- HERE PHP  -->
		<?php if (isset($_GET['error'])) {
			if (isset($_GET['message'])) {
				echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
			}
		} else if (isset($_GET['success'])) {
			echo '<div>Welcome in Nova !<a href="login_form.php">Connect</a></div>';
		}
		?>

		<form method="post" action=register_form.php class="buttons1_RegisterForm">
			<input type="email" class="Register0_RegisterForm" name="email" label="email" id="Register0_RegisterForm" placeholder="your email here..." /></button><br>
			<input type="password" class="Register1_RegisterForm" name="password" label="Register" id="Register1_RegisterForm" placeholder="type your password..." /></button><br>
			<input type="password" class="Register2_RegisterForm" name="password_two" label="Register" id="Register2_RegisterForm" placeholder="check your password..." /></button>

			<button type="submit" class="Register_loginEnter" name="RegisterEnter" label="Register" id="RegisterRegister_loginEnter">Register</button>
		</form>



		<div class="arrowBack" onclick="location.href='./../index.php'">
			<svg version="1.1" id="Calque_1" x="0px" y="0px" width="97.411px" height="97.68px" viewBox="0 0 97.411 97.68" enable-background="new 0 0 97.411 97.68" xml:space="preserve">
				<g>
					<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M54.735,74.105c0.674,0.674,1.744,0.674,2.418,0l2.418-2.418
		c0.674-0.674,0.674-1.744,0-2.418L39.262,48.963L59.57,28.655c0.674-0.674,0.674-1.744,0-2.418l-2.418-2.418
		c-0.674-0.674-1.744-0.674-2.418,0L30.808,47.746c-0.674,0.674-0.674,1.744,0,2.418L54.735,74.105z" />
					<path fill="none" stroke="#FFFFFF" stroke-width="6" stroke-miterlimit="10" d="M81.373,95.944H16.039
		c-7.941,0-14.438-6.497-14.438-14.438V16.173c0-7.941,6.497-14.438,14.438-14.438h65.334c7.941,0,14.438,6.497,14.438,14.438
		v65.334C95.81,89.447,89.313,95.944,81.373,95.944z" />
				</g>
			</svg>
		</div>
		<div class="disclaimer">
			<p class="txt1">Already an account: <a href="login_form.php">Click here to login!</a></p>
			<p class="txt1"> Having trouble to connect? Reset <a href="forgot_password.php">password</a></p>
		</div>

	</div>

</body>
<footer>

</footer>

</html>