


<?php



	if (!empty($_POST['pseudo']))
	{
		include('../src/connect.php');
		// variables
		$pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $image = htmlspecialchars($_POST['brandtype']);
		
		// // sending (ajouter les droits/accès Adulte ou enfant)
		$req = $db->prepare("INSERT INTO profile(pseudo, categorie, email, image) VALUES (?, ?, ?, ?)");
        $req->execute(array($pseudo, $categorie, $_GET['email'],$image));

        header('location: profil_select.php?email=' . $_GET['email'] . '');
        }

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./styles/styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e48c77929d.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
            require('../src/connect.php');
            // Calcul du nombres de pseudos de l'adresse mail
            $email = htmlspecialchars($_GET['email']);
            $requete = $db->query("SELECT COUNT(*) AS nbPseudo FROM profile WHERE email='$email'");
            $nbDePseudos = $requete->fetch();
            if ($nbDePseudos[0] < 4) { 
    ?>
                <div class="buttons1">
                    <form method="post">
                        <!-- /////// NORDINE - START CODE AJOUTER ICI //////// -->
                        <!-- J'ai ajouter l'image de profil utilisateur relier a la BDD -->
                        <div class="img_creat_username_box">
                            <img class="w-25 mb-4 profile-pic-image default_image" src="../images/default_user.jpg" alt="profil" style="cursor: pointer">
                        </div>
                        <!-- /////// NORDINE - END CODE AJOUTER ICI //////// -->
                        <div class="who_are_you_form">
                            <input type="text" class="Register0_loginForm" name="pseudo" label="Register" id="Register0_loginForm" placeholder="ADD YOUR PSEUDO" /></button><br>
                            <select class="form-select mb-2" name="categorie" aria-label="Default select example">
                                <option selected value="adulte">Adulte</option>
                                <option value="enfant">Enfant</option>
                            </select>
                            <div class="third_img_userprofil_choices">
                                <h1>Choose your profil picture</h1>
                                <div class="box_picture1">
                                    <div class="box1">
                                        <div class="container9">
                                            <div class="col">
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="4" class="hidetx" value="../images/user_pic/4.png" checked>
                                                    <label for="4" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/4.png" alt="default image" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Story Bots<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="12" class="hidetx" value="../images/user_pic/12.png">
                                                    <label for="12" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/12.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Arcane Vi<h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="3" class="hidetx" value="../images/user_pic/3.png">
                                                    <label for="3" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/3.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Junior<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="9" class="hidetx" value="../images/user_pic/9.png checked">
                                                    <label for="9" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/9.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Squid game<h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="5" class="hidetx" value="../images/user_pic/5.png">
                                                    <label for="5" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/5.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Naruto<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="8" class="hidetx" value="../images/user_pic/8.png">
                                                    <label for="8" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/8.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Omar Sy<h4>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End code choix des image de profil -->
                            </div>
                            <button type="submit" class="Register_loginEnter" name="RegisterEnter" label="Register" id="RegisterRegister_loginEnter">CREATE</button>

                        </div>
                    </form>
                </div>

                <small><a href="logout.php">Log Out</a></small>
            <?php   }
            $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
            $requete->execute(array($_GET['email']));
            ?>
                    
            

<?php



	if (!empty($_POST['pseudo']))
	{
		include('../src/connect.php');
		// variables
		$pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $image = htmlspecialchars($_POST['brandtype']);
		
		// // sending (ajouter les droits/accès Adulte ou enfant)
		$req = $db->prepare("INSERT INTO profile(pseudo, categorie, email, image) VALUES (?, ?, ?, ?)");
        $req->execute(array($pseudo, $categorie, $_GET['email'],$image));

        header('location: profil_select.php?email=' . $_GET['email'] . '');
        }

?>