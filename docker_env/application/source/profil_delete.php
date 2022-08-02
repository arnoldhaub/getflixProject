<?php
include('src/connect.php');

if (isset($_GET['id']) AND !empty($_GET['id']))
{
    $getid = $_GET['id'];
    $recupLine = $db->prepare('SELECT * FROM profile WHERE id= ?');
    $recupLine->execute(array($getid));

    if($recupLine->rowCount()>0){
        $suppressionLigne = $db->prepare('DELETE FROM profile WHERE id = ?');
        $suppressionLigne->execute(array($getid));
        header('location: profil_select.php?email='.$_GET['email'].'');
    }
    else{echo 'aucun membre trouvé';}
}
else{ echo "identifiant non récupéré";}

?>