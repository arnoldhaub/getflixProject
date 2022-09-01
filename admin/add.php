<?php

require_once('../src/connect.php');

if($_POST['dbName'] == "user"){

    $email = htmlspecialchars($_POST['userMail']);
    $password = htmlspecialchars($_POST['password']);
	$role = htmlspecialchars($_POST['role']);
    $table = htmlspecialchars($_POST['dbName']);

    // email adress valid ?
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location : ../admin.php?error=1&message=Email adress invalid');
		exit();
	}

    // email already exists ?
	$req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
	$req->execute(array($email));

	while ($email_verification = $req->fetch()) {
		if ($email_verification['numberEmail'] != 0) {
			header('location: ../admin.php?error=1&message=Email already used.');
			exit();
		}
	}

    // hash
	$secret = sha1($email);

    // encryption password 
	$password = "aq1" . sha1($password . "123") . "25";

	// sending
	$req = $db->prepare("INSERT INTO `$table` (email, password, secret, role) VALUES (?,?,?,?)");
	$req->execute(array($email, $password, $secret, $role));
	header('location: ../admin.php');
	exit();

    if ($req) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to add member: ".$email;
    }
}

if($_POST['dbName'] == "profile"){

    $email = htmlspecialchars($_POST['mail']);
    $pseudo = htmlspecialchars($_POST['profilePseudo']);
    $profileImage = $_POST['profileImage'];
    $categorie = htmlspecialchars($_POST['categorie']);
    $table = htmlspecialchars($_POST['dbName']);


    // verification => less than 4 profiles ?
	$req = $db->prepare("SELECT count(*) as numberEmail FROM `$table` WHERE email = ?");
	$req->execute(array($email));

	while ($profile_count_verification = $req->fetch()) {
		if ($profile_count_verification['numberEmail'] >= 4) {
			header('location: ../admin.php?error=1&message=Already four profiles.');
			exit();
		}
	}

	// sending
	$req = $db->prepare("INSERT INTO `$table` ( pseudo, categorie, email, image) VALUES (?,?,?,?)");
	$req->execute(array($pseudo, $categorie, $email, $profileImage));
	header('location: ../admin.php');
	exit();

    if ($req) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to add a profile (" .$pseudo. " to : ".$email;
    }
}


if($_POST['dbName'] == "comments"){

    $filmID = (int) htmlspecialchars($_POST['filmID']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $comment = filter_input(INPUT_POST,"comment", FILTER_SANITIZE_SPECIAL_CHARS);
    $date = htmlspecialchars($_POST['date']);
    $table = $_POST['dbName'];

    // sending
	$req = $db->prepare("INSERT INTO `$table` (id_film, pseudo, commentaires, date) VALUES (?,?,?,?)");
	$req->execute(array($filmID, $pseudo, $comment, $date));
	header('location: ../admin.php');
	exit();

    if ($req) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to add your comment " .$pseudo. " saying : <br> ".$comment;
    }

}
