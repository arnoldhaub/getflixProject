<?php

// ici on check si un commentaires a été envoyé
	if (!empty($_POST['comments']))
	{
		include('../src/connect.php');
		// variables
		$comments = htmlspecialchars($_POST['comments']);
        $id_film = $_GET['id'];
		
		// sending les commentaires ajoutés à la bdd
		$req = $db->prepare("INSERT INTO comments(id_film, pseudo, commentaires) VALUES (?, ?, ?)");
		$req->execute(array($id_film, $pseudo, $_POST['comments']));
		
	}


// ici on affiche tous les commentaires de la DB lié à l'ID du film
$id = $_GET['id'];
include "api/api/info.php";


include('../src/connect.php');
$requete = $db->prepare('SELECT * FROM comments WHERE id_film = ?');
$requete->execute(array($id));
?>
    <div class="buttons1">
        <ul class="list-unstyled">
            <?php
            while ($donnees = $requete->fetch())
                    { ?>
                        <!-- ici on affichera id_film / pseudo / comments / date -->
            <?php   } ?> 

        </ul>
    </div>
