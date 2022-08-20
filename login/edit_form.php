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

$id = $_GET['id_pseudo'];

if (!empty($_GET['id_pseudo'])) {
    // Connexion à la base de données
    require('../src/connect.php');
    $requete = $db->query("SELECT id_pseudo, pseudo, categorie, email, image FROM profile WHERE id_pseudo='$id'");
    $infosProfil = $requete->fetch();


    //--------- MISE À JOURS DES INFORMATIONS DE LA BDD ---------//

    if (!empty($_POST['pseudo'])) {
        include('../src/connect.php');

        // On reprend les variables du form
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $image = htmlspecialchars($_POST['imageProfile']);

        // Modification de la base de données

        $updateProfil = "UPDATE profile SET pseudo='$pseudo', categorie='$categorie', image='$image' WHERE id_pseudo='$id'";
        $updateExecution = $db->exec($updateProfil);

        // // Mise à jour des informations
        // $requete = $db->query("SELECT id_pseudo, pseudo, categorie, email, image FROM profile WHERE id_pseudo='$id'");
        // $infosProfil = $requete->fetch();



        header('location: profil_select.php');
    }
}

?>
<!DOCTYPE html>

<head>
    <title>NOVA · Edit your profile</title>
    <?php include "../src/head_meta_tags.php"; ?>
    <link href="styles/profil_select.css" rel="stylesheet">
</head>

<body>
    <div class="container1">

        <h1>Update your profile information</h1>

        <div id="container_form_edit">

            <div class="choose_your_image">
                <img src="<?php echo $infosProfil['image']; ?>" id="changeThis" alt="Profile's image" srcset="">
            </div>

            <form action='' method="post" id="form_profil">
                <input type="radio" id="imageProfile" name="imageProfile" value="<?php echo $infosProfil['image']; ?>" checked>
                <input type="text" name="pseudo" placeholder="Add your pseudo" value="<?php echo $infosProfil['pseudo']; ?>"></input>
                <select class="form-select" name="categorie">
                    <option value="" disabled selected hidden> Select your option</option>
                    <option value="adulte" <?php if ($infosProfil['categorie'] == 'adulte') {
                                                echo "selected";
                                            } ?>>Adulte</option>
                    <option value="enfant" <?php if ($infosProfil['categorie'] == 'enfant') {
                                                echo "selected";
                                            } ?>>Enfant</option>
                </select>

                <button type="submit" name="RegisterEnter" id="subButton">Submit</button>

            </form>

        </div>

        <a class="" href="profil_delete.php?id_pseudo=<?php echo $infosProfil['id_pseudo'] ?>&email=<?php echo $infosProfil['email'] ?>" style="">
             <button id="delButton">
                <div class="svg_white_delete">
                    <img class="X_WHITE" src="../images/X.svg" alt="delete your profile">
                </div>
                <div class="svg_red_delete">
                    <img class="X_RED" src='../images/X_red.svg' alt="delete your profile">
                </div>
             </button>
        </a>    


        <div id="container_form_images">

            <form action='' method="post" id="containerImages">

                <div class="row_images">
                    <input type="radio" id="4" name="brandtype" value="../images/user_pic/4.png" <?php if ($infosProfil['image'] == '../images/user_pic/4.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="4">
                        <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="2" name="brandtype" value="../images/user_pic/2.png" <?php if ($infosProfil['image'] == '../images/user_pic/2.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="2">
                        <img src="../images/user_pic/2.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="3" name="brandtype" value="../images/user_pic/3.png" <?php if ($infosProfil['image'] == '../images/user_pic/3.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="3">
                        <img src="../images/user_pic/3.png" alt="" style="border-radius: 250px">
                    </label>
                </div>

                <div class="row_images">
                    <input type="radio" id="10" name="brandtype" value="../images/user_pic/10.png" <?php if ($infosProfil['image'] == '../images/user_pic/10.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="10">
                        <img src="../images/user_pic/10.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="5" name="brandtype" value="../images/user_pic/5.png" <?php if ($infosProfil['image'] == '../images/user_pic/5.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="5">
                        <img src="../images/user_pic/5.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="6" name="brandtype" value="../images/user_pic/6.png" <?php if ($infosProfil['image'] == '../images/user_pic/6.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="6">
                        <img src="../images/user_pic/6.png" alt="" style="border-radius: 250px">
                    </label>
                </div>

                <div class="row_images">
                    <input type="radio" id="7" name="brandtype" value="../images/user_pic/7.png" <?php if ($infosProfil['image'] == '../images/user_pic/7.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="7">
                        <img src="../images/user_pic/7.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="12" name="brandtype" value="../images/user_pic/12.png" <?php if ($infosProfil['image'] == '../images/user_pic/12.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="12">
                        <img src="../images/user_pic/12.png" alt="" style="border-radius: 250px">
                    </label>
                    <input type="radio" id="11" name="brandtype" value="../images/user_pic/11.png" <?php if ($infosProfil['image'] == '../images/user_pic/11.png') {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                    <label for="11">
                        <img src="../images/user_pic/11.png" alt="" style="border-radius: 250px">
                    </label>
                </div>

            </form>

        </div>





    </div>
    <div class="arrowBack" onclick="location.href='profil_select.php' ">
             <svg version="1.1" id="Calque_1"   x="0px" y="0px"
 	         width="97.411px" height="97.68px" viewBox="0 0 97.411 97.68" enable-background="new 0 0 97.411 97.68" xml:space="preserve">
 			<g>
 				<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M54.735,74.105c0.674,0.674,1.744,0.674,2.418,0l2.418-2.418
 					c0.674-0.674,0.674-1.744,0-2.418L39.262,48.963L59.57,28.655c0.674-0.674,0.674-1.744,0-2.418l-2.418-2.418
 					c-0.674-0.674-1.744-0.674-2.418,0L30.808,47.746c-0.674,0.674-0.674,1.744,0,2.418L54.735,74.105z"/>
 				<path fill="none" stroke="#FFFFFF" stroke-width="6" stroke-miterlimit="10" d="M81.373,95.944H16.039
 					c-7.941,0-14.438-6.497-14.438-14.438V16.173c0-7.941,6.497-14.438,14.438-14.438h65.334c7.941,0,14.438,6.497,14.438,14.438
 					v65.334C95.81,89.447,89.313,95.944,81.373,95.944z"/>
 			</g>
             </svg>
 	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="script/script_edit_form.js"></script>

</html>