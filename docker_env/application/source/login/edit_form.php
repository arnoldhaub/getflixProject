<?php
    $id = $_GET['id'];

	if (!empty($_GET['id']))
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

        <div id="container_form_edit">


            <div class="choose_your_image">
            <img src="../images/user_pic/4.png" id="changeThis" alt="default image" srcset="">
            </div>


            <form action='' method="post" id="form_profil">
                <input type="text" name="pseudo" placeholder="Add your pseudo" value="<?php echo $infosProfil['pseudo']; ?>"></input>
                <select class="form-select" name="categorie">
                    <option value="" disabled selected hidden > Select your option</option>
                    <option value="adulte" <?php if($infosProfil['categorie'] == 'adulte'){ echo "selected";} ?>>Adulte</option>
                    <option value="enfant" <?php if($infosProfil['categorie'] == 'enfant'){ echo "selected";} ?>>Enfant</option>
                </select>
                 
                <button type="submit" name="RegisterEnter" id="subButton">Submit</button>
               
            </form>
                                               
        </div>

        <a class="" href="profil_delete.php?id_pseudo=<?php echo $donnees['id_pseudo'] ?>&email=<?php echo $donnees['email'] ?>" style="">
        <button>Delete</button>
        </a>


         <div id="container_form_images">
                
                <form action='' method="post" id="containerImages">


                <div class="row_images">
                        <input type="radio" id="1" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="2" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="3" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                </div>

                <div class="row_images">
                        <input type="radio" id="4" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="5" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="6" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                </div>

                <div class="row_images">
                        <input type="radio" id="7" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="8" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                        <input type="radio" id="9" name="brandtype" value="./url">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                </div>
                
                
                </form>
                                               
        </div>

        <button id="LetMeOut">Let Me Out</button>

        



    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./script/script_edit_form.js"></script>

</html>