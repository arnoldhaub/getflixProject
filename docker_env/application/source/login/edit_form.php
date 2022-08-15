<?php
    $id = $_GET['id_pseudo'];

	if (!empty($_GET['id_pseudo']))
	{
        // Connexion à la base de données
        require('../src/connect.php');
        $requete = $db->query("SELECT id_pseudo, pseudo, categorie, email, image FROM profile WHERE id_pseudo='$id'");
        $infosProfil = $requete->fetch();

        
//--------- MISE À JOURS DES INFORMATIONS DE LA BDD ---------//

        if (!empty($_POST['pseudo'])){
		include('../src/connect.php');

		// On reprend les variables du form
		$pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
		
		// Modification de la base de données
        
		$updateProfil = "UPDATE profile SET pseudo='$pseudo', categorie='$categorie' WHERE id_pseudo='$id'";
        $updateExecution = $db->exec($updateProfil);
        
        // // Mise à jour des informations
        // $requete = $db->query("SELECT id_pseudo, pseudo, categorie, email, image FROM profile WHERE id_pseudo='$id'");
        // $infosProfil = $requete->fetch();

    
		
        header('location: profil_select_doublon.php?email=' . $infosProfil['email'] . '');
	    }
    }

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./styles/profil_select.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e48c77929d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container1">
        <h1>Update your profile information</h1>
        <div id="container_form">
            <form action='' method="post" id="form_profil">
                <input type="text" name="pseudo" placeholder="Add your pseudo" value="<?php echo $infosProfil['pseudo']; ?>"></input>
                <select class="form-select" name="categorie">
                    <option value="" disabled selected hidden > Select your option</option>
                    <option value="adulte" <?php if($infosProfil['categorie'] == 'adulte'){ echo "selected";} ?>>Adulte</option>
                    <option value="enfant" <?php if($infosProfil['categorie'] == 'enfant'){ echo "selected";} ?>>Enfant</option>
                </select>
                <button type="submit" name="RegisterEnter" id="subButton">Submit</button>
            </form>
                                                <!-- <form action="" method="get">
                                                    <a class="" href="profil_delete.php?id_pseudo=<?php echo $donnees['id_pseudo'] ?>&email=<?php echo $donnees['email'] ?>" style="">
                                                    <button>Delete</button></a> 
                                                    <form> -->
        </div>
    </div>
</body>

</html>