<!DOCTYPE html>
<html lang="en">

<head>
    <title>NOVA · Update your profile</title>
    <?php include "../src/head_meta_tags.php"; ?>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <?php

    //connexion à la base de donnée
    require('../src/connect.php');
    $id_pseudo = $_GET["id_pseudo"];
    $requete = $db->query("SELECT pseudo FROM profile WHERE id_pseudo='$id_pseudo'");
    $pseudoActif = $requete->fetch();

    if (!empty($_POST['pseudo'])) {
        include('../src/connect.php');
        // variables
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $image = htmlspecialchars($_POST['brandtype']);

        // modififcation
        $req = $db->prepare('UPDATE profile SET (pseudo, categorie, image) VALUES (?, ?, ?) WHERE email=$_GET["email"]');
        $req->execute(array($pseudo, $categorie, $image));

        header('location: profil_select.php?email=' . $_GET['email'] . '');
    }


    ?>

    <!-- ///////////////////////////////////////////////////////////////////////////////: -->

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
                <h1>Update your info here please</h1>
                <!--ici code si aucun PSEUDO créé -->

                <div class="buttons1">
                    <form method="POST">
                        <!-- /////// NORDINE - START CODE AJOUTER ICI //////// -->
                        <!-- J'ai ajouter l'image de profil utilisateur relier a la BDD -->
                        <div class="img_creat_username_box">
                            <img class="w-25 mb-4 profile-pic-image default_image" src="../images/default_user.jpg" alt="profil" style="cursor: pointer">
                        </div>
                        <!-- /////// NORDINE - END CODE AJOUTER ICI //////// -->
                        <div class="who_are_you_form">
                            <input type="text" class="Register0_loginForm" name="pseudo" value="<?php echo $pseudoActif[0] ?>" /></button><br>
                            <select class="form-select mb-2" name="categorie" value="<?= ['categorie'] ?>">
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
                                                    <input type="radio" name="brandtype" id="4" class="hidetx" value="1">
                                                    <label for="4" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/4.png" alt="default image" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Story Bots<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="12" class="hidetx" value="12">
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
                                                    <input type=" radio" name="brandtype" id="3" class="hidetx" value="1">
                                                    <label for="3" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/3.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Junior<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type=" radio" name="brandtype" id="9" class="hidetx" value="9">
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
                                                    <input type=" radio" name="brandtype" id="5" class="hidetx" value="1">
                                                    <label for="5" class="lbl-radio">
                                                        <div class="display-box">
                                                            <img src="../images/user_pic/5.png" alt="" srcset="">
                                                        </div>
                                                        <h4 class="paper-title">Naruto<h4>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <input type="radio" name="brandtype" id="8" class="hidetx" value="8">
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
                            <button type="submit" class="Register_loginEnter" label="update" id="update_loginEnter">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
            <script src="styles/nordine.js"></script>
    </body>

    <footer>
        <div class="disclaimer">
            <p class="txt1" style="font-size: 20px;">Sci-Fi streaming Solution</p>
        </div>
    </footer>

</html>


<!-- //////////////////////////////////// -->