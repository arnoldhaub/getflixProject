<?php
    // On prolonge la session
    session_start();
    $userEmail = $_SESSION['email'];

    // On teste si la variable de session existe et contient une valeur
    if (empty($_SESSION['email'])) {
        // Si inexistante ou nulle, on redirige vers le formulaire de login
        header('Location: ../index.php');
        exit();
    }
include('../src/connect.php');

if (isset($_GET['id_pseudo']) AND !empty($_GET['id_pseudo']))
{
    $getid = $_GET['id_pseudo'];
    $recupLine = $db->prepare('SELECT * FROM profile WHERE id_pseudo= ?');
    $recupLine->execute(array($getid));

    if($recupLine->rowCount()>0){
        $suppressionLigne = $db->prepare('DELETE FROM profile WHERE id_pseudo = ?');
        $suppressionLigne->execute(array($getid));
        header('location: profil_select_doublon.php');
    }
    else{echo 'aucun membre trouvé';}
}
else{ echo "identifiant non récupéré";}

?>