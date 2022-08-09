<?php
if (!empty($_POST['pseudo'])) {
    include('../src/connect.php');
    // variables
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $categorie = htmlspecialchars($_POST['categorie']);

    // sending (ajouter les droits/accès Adulte ou enfant)
    $req = $db->prepare("INSERT INTO profile(pseudo, categorie, email) VALUES (?, ?, ?)");
    $req->execute(array($pseudo, $categorie, $_GET['email']));

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
    <div class="container1">
        <!-- <img src="./images/logo.png" class="logo_login" alt="logo planet nova"/> -->
        <div class="logo_div">
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
        <div class="guillaume_box">
            <!-- <div class="guillaume_box"> -->
            <h1>Who are you ? </h1>
            <!--ici code si aucun PSEUDO créé -->
            <?php
            require('../src/connect.php');
            // Calcul du nombres de pseudos de l'adresse mail
            $email = htmlspecialchars($_GET['email']);
            $requete = $db->query("SELECT COUNT(*) AS nbPseudo FROM profile WHERE email='$email'");
            $nbDePseudos = $requete->fetch();
            if ($nbDePseudos[0] < 4) { ?>
                <div class="buttons1">
                    <form method="post">
                        <!-- /////// NORDINE - START CODE AJOUTER ICI //////// -->
                        <!-- J'ai ajouter l'image de profil utilisateur relier a la BDD -->
                        <div class="img_creat_username_box">
                            <?php
                            if ($donnees['categorie'] == 'adulte') {
                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/adulte.png" alt="profil">';
                            } elseif ($donnees['categorie'] == 'enfant') {
                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/enfant.png" alt="profil" style="width: 60px;">';
                            } else {
                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/default_user.jpg" alt="profil" style="cursor: pointer">';
                            }
                            ?>
                        </div>
                        <!-- /////// NORDINE - END CODE AJOUTER ICI //////// -->
                        <div class="who_are_you_form">
                            <input type="text" class="Register0_loginForm" name="pseudo" label="Register" id="Register0_loginForm" placeholder="ADD YOUR PSEUDO" /></button><br>
                            <select class="form-select mb-2" name="categorie" aria-label="Default select example">
                                <option selected value="adulte">Adulte</option>
                                <option value="enfant">Enfant</option>
                            </select>
                            <button type="submit" class="Register_loginEnter" name="RegisterEnter" label="Register" id="RegisterRegister_loginEnter">CREATE</button>

                        </div>
                    </form>
                </div>
            <?php   }
            $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
            $requete->execute(array($_GET['email']));
            ?>

            <div class="guillaume_box">
                <ul class="profile-content">
                    <?php
                    while ($donnees = $requete->fetch()) {
                    ?>
                        <li>
                            <a href="catalogue.php">
                                <div class="profile-pic">
                                    <a class=" fa-solid fa-trash-can" href="profil_delete.php?id=<?php echo $donnees['id'] ?>&email=<?php echo $donnees['email'] ?>" style="">
                                        <a class=" fa-solid fa-pen" href="profil_modif.php?id=<?php echo $donnees['id'] ?>&email=<?php echo $donnees['email'] ?>" style="">
                                        </a>
                                        <div class=" row">
                                            <?php
                                            if ($donnees['categorie'] == 'adulte') {
                                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/adulte.png" alt="profil">';
                                            } elseif ($donnees['categorie'] == 'enfant') {
                                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/enfant.png" alt="profil">';
                                            } else {
                                                echo '<img class="w-25 mb-4 profile-pic-image" src="../images/default_user.jpg" alt="profil" style="">';
                                            }
                                            ?>
                                            <h1 class="mt-2 col text-center align-self-center profile-name"><?php echo $donnees['pseudo'] ?> <span style="font-size:20px"><?php echo $donnees['categorie'] ?></span></h1>
                                        </div>
                                        <!-- <div class="row_default">
                                            <?php
                                            echo '<img class="w-25 mb-4 profile-pic-image" src="../images/default_user.jpg" alt="profil" style="">';
                                            ?>
                                            <h1 class="mt-2 col text-center align-self-center profile-name">Add user</h1>
                                        </div> -->
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- </div> -->
        </div>
        <div class="disclaimer">
            <p class="txt1" style="font-size: 20px;">Sci-Fi streaming Solution</p>
        </div>
    </div>
    <script src="styles/nordine.js"></script>
</body>

<footer>
</footer>

</html>


<!-- //////////////////////////////////// -->