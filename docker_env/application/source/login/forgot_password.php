<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require('../src/connect.php');

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./styles/styles.css" rel="stylesheet">
</head>
<body>


<div class="container1">

   <!-- <img src="./images/logo.png" class="logo_login" alt="logo planet nova"/> -->
   <div class="logo_div_loginForm">
   <svg version="1.1" id="Calque_1" x="0px" y="0px"
	  viewBox="0 0 115.83 106.61" enable-background="new 0 0 115.83 106.61">
<g>
	<path fill="#FFFFFF" d="M90.224,63.354C81.04,70.287,72.823,78.416,65.79,87.523c-2.182,3.241-7.033,10.848-4.501,15.127
		c2.316,3.914,10.163,1.166,13.534,0.258c11.996-3.234,22.273-10.987,28.679-21.633c6.405-10.645,8.441-23.358,5.68-35.471
		C103.077,51.872,96.73,57.72,90.224,63.354L90.224,63.354z"/>
	<path fill="#FFFFFF" d="M23.843,90.557c2.063-0.556,4.282-1.27,6.622-2.134c0.275-0.097,0.536-0.202,0.809-0.31
		c13.94-5.654,27.122-13.024,39.24-21.938c12.594-8.745,24.016-19.066,33.988-30.71c0.444-0.548,0.877-1.094,1.287-1.633
		c8.342-10.757,10.615-18.961,6.734-24.37c-4.073-5.693-13.224-5.973-27.217-0.821l0.001-0.001c-0.057,0.017-0.113,0.04-0.167,0.069
		C74.462,2.334,61.728,0.348,49.617,3.168C37.505,5.987,26.958,13.394,20.196,23.83c-6.763,10.435-9.217,23.087-6.845,35.294
		C3.573,70.442-1.453,81.035,3.253,87.612C6.65,92.341,13.557,93.33,23.843,90.557L23.843,90.557z M94.189,15.18
		c7.714-2.08,10.693-1.006,11.044-0.521l0.003,0.011c0.348,0.474,0.402,3.554-3.848,9.973c-2.123-3.423-4.673-6.564-7.585-9.348
		C93.93,15.25,94.06,15.215,94.189,15.18L94.189,15.18z M16.556,69.375c1.873,4.281,4.371,8.259,7.413,11.806
		c-9.495,3.001-13.041,1.755-13.428,1.221C10.147,81.847,10.132,77.877,16.556,69.375L16.556,69.375z"/>
</g>
<rect x="0.118" y="0.11" fill="none" width="115.712" height="106.615"/>
</svg>
    </div>
        <br/>
        <h1 class="txtHello">Lost in our Galaxy ?</h1>
        <h2 class="txtHello">Yes, send me a new password please !</h2>
    <form method="post">
            <input type="email" class="Register1_loginForm" name="email" label="Register" id="Register1_loginForm" placeholder="type your email adress..."/>
        <div class="mx-auto" style="width:100px";>
            <button type="submit" name="forgot_password" class="btn btn-secondary">Click Here</button>	
        </div>
	
    </form>
    
    <div class="arrowBack" onclick="location.href='./index_login.php'">
            <svg version="1.1" id="Calque_1"   x="0px" y="0px"
	 width="97.411px" height="97.68px" viewBox="0 0 97.411 97.68" enable-background="new 0 0 97.411 97.68" xml:space="preserve">
<g>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M54.735,74.105c0.674,0.674,1.744,0.674,2.418,0l2.418-2.418
		c0.674-0.674,0.674-1.744,0-2.418L39.262,48.963L59.57,28.655c0.674-0.674,0.674-1.744,0-2.418l-2.418-2.418
		c-0.674-0.674-1.744-0.674-2.418,0L30.808,47.746c-0.674,0.674-0.674,1.744,0,2.418L54.735,74.105z"/>
	<path fill="none" stroke="#FFFFFF" stroke-width="6" stroke-miterlimit="10" d="M81.373,95.944H16.039
		c-7.941,0-14.438-6.497-14.438-14.438V16.173c0-7.941,6.497-14.438,14.438-14.438h65.334c7.941,0,14.438,6.497,14.438,14.438
		v65.334C95.81,89.447,89.313,95.944,81.373,95.944z"/>
</g>
            </svg>
        </div>

            <div class="disclaimer">
<p class="txt1">Not yet in our Galaxy? <a href="register_form.php">Click here to join!</a></p>
            </div>
</div>
</body>

</html>

<?php

if (isset($_POST['email']))
    {
    $newPassword = uniqid();
    $hashedNewPassword = "aq1".sha1($newPassword."123")."25";

    $sql = "UPDATE user SET password = ? WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$hashedNewPassword, $_POST['email']]);
    try
        {    
    // envoi du mail
    require "../src/Exception.php";
    require "../src/PHPMailer.php";
    require_once "../src/SMTP.php";

    $mail = new PHPMailer(true);
    //configuration

    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // information de debug
    $mail->isSMTP();
    $mail->Host = "sql11.freesqldatabase.com";
    $mail->Port = 3306;
    $mail->CharSet = "utf-8";
    $mail->SMTPSecure = 'ssl';
    $mail->addAddress($_POST['email']);
    $mail->setFrom("novaflixbecode@gmail.com");
    $mail->Subject = "New password - NOVA";
    $mail->Body = "Hello, here is the new password : .$newPassword.";

    $mail->send();
    echo 'new password just sent';
        }
    catch (Exception $e)
        {
    echo "message non envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }
    
?>