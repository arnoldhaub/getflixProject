<?php

require_once('../src/connect.php');

if($_POST['dbName'] == "user"){

    $id = $_POST['userOriginalID'];
    $newID = $_POST['userID'];

    $email = $_POST['userMail'];
    $table = $_POST['dbName'];

    // On supprimme la ligne de la bdd
    $userUpdate = $db->query("UPDATE `$table` SET id='$newID', email='$email' WHERE id='$id'");

    if ($userUpdate) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to update member id ".$id;
    }
}

if($_POST['dbName'] == "profile"){

    $id = $_POST['profileOriginalID'];
    $newID = $_POST['profileID'];
    $pseudo = $_POST['profilePseudo'];
    $email = $_POST['userMail'];
    $emailOriginal = $_POST['profileOriginalEmail'];
    $profileImage = $_POST['profileImage'];
    $categorie = $_POST['categorie'];
    $table = $_POST['dbName'];

    // On supprimme la ligne de la bdd
    $profileUpdate = $db->query("UPDATE `$table` SET id_pseudo='$newID', pseudo='$pseudo', categorie='$categorie', email='$email', image='$profileImage' WHERE id_pseudo='$id'");

    if($emailOriginal != $email && !empty($emailOriginal)){
        $emailUpdate = $db->query("UPDATE `$table` SET email='$email' WHERE email='$emailOriginal'");
    }

    if ($profileUpdate) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to update the profile of ".$pseudo.", id ".$id;
    }
}

if($_POST['dbName'] == "comments"){

    $id = (int)htmlspecialchars($_POST['commentID']);
    $filmID = (int) htmlspecialchars($_POST['filmID']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $comment = filter_input(INPUT_POST,"comment", FILTER_SANITIZE_SPECIAL_CHARS);
    $date = htmlspecialchars($_POST['date']);
    $originalID = (int)htmlspecialchars($_POST['originalID']);
    $table = $_POST['dbName'];

    // On supprimme la ligne de la bdd
    $commentsUpdate = $db->query("UPDATE `$table` SET id='$id', id_film='$filmID', pseudo='$pseudo', commentaires='$comment', date='$date' WHERE id=$originalID");

    if ($commentsUpdate) {
        header("Location: ../admin.php");
    } else {
        echo "Failed to update the comment of ".$pseudo.", for the movie ID ".$originalID;
    }
}
