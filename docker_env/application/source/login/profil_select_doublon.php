<?php



	if (!empty($_POST['pseudo']))
	{
		include('../src/connect.php');
		// variables
		$pseudo = htmlspecialchars($_POST['pseudo']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $image = htmlspecialchars($_POST['imageProfile']);
		
		// // sending (ajouter les droits/accès Adulte ou enfant)
		$req = $db->prepare("INSERT INTO profile(pseudo, categorie, email, image) VALUES (?, ?, ?, ?)");
        $req->execute(array($pseudo, $categorie, $_GET['email'],$image));

        header('location: profil_select_doublon.php?email=' . $_GET['email'] . '');
        }

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>NOVA · Select a profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="./styles/profil_select.css" rel="stylesheet">
    <link href="./styles/media_queeries.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../images/favicon.svg">
    
</head>

<body>

 <?php
    require('../src/connect.php');
    // Calcul du nombres de pseudos de l'adresse mail
    $email = htmlspecialchars($_GET['email']);
    $requete = $db->query("SELECT COUNT(*) AS nbPseudo FROM profile WHERE email='$email'");
    $nbDePseudos = $requete->fetch();
    $i = 0;
    $a = 0;
    if ($nbDePseudos[0] < 5) { 
?>
        
    <div class="container1">

        <h1>Who are you ?</h1>

        <?php   }
        $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
        $requete->execute(array($_GET['email']));
        ?>
        
        
        <div class="profile_select">
            <?php if ($nbDePseudos[0] == 0){
                echo    '<svg class="buttonAdd" version="1.1" id="buttonAdd" x="0px" y="0px"
                        width="452px" height="469px" viewBox="0 0 452 469" style="enable-background:new 0 0 452 469;">
                            <style type="text/css">.st0{fill:#FFFFFF;}</style>
                            <g>
                                <path class="st0" d="M138.5,444.5h175c32.5,0,63.6-13,86.6-35.9S436,354.5,436,322V147c0-32.5-13-63.6-35.9-86.6
                                c-23-23-54.1-35.9-86.6-35.9h-175c-32.5,0-63.6,13-86.6,35.9S16,114.5,16,147v175c0,32.5,13,63.6,35.9,86.6S106,444.5,138.5,444.5
                                L138.5,444.5z M51,147c0-23.2,9.3-45.4,25.7-61.8s38.6-25.6,61.8-25.7h175c23.2,0,45.4,9.3,61.8,25.7
                                c16.4,16.4,25.6,38.6,25.7,61.8v175c0,23.2-9.3,45.4-25.7,61.8s-38.6,25.6-61.8,25.7h-175c-23.2,0-45.4-9.3-61.8-25.7
                                S51,345.2,51,322V147z"/>
                                <path class="st0" d="M147.2,252h61.2v61.2c0,6.3,3.3,12,8.8,15.2s12.1,3.1,17.5,0s8.8-8.9,8.8-15.2V252h61.3c6.3,0,12-3.3,15.2-8.8
                                s3.1-12.1,0-17.5s-8.9-8.8-15.2-8.8h-61.3v-61.2c0-6.3-3.3-12-8.8-15.2s-12.1-3.1-17.5,0s-8.8,8.9-8.8,15.2V217h-61.2
                                c-6.3,0-12,3.3-15.2,8.8s-3.1,12.1,0,17.5S141,252,147.2,252z"/>
                            </g>
                        </svg>';
                };
            ?>
            
            <?php
            while ($donnees = $requete->fetch()) {
            ?>
            
            <div class="profil_un" id="<?php echo $donnees['id_pseudo'] ?>">
                <div class="image_profile" style="text-align: center;">
                    
                    <a href='<?php  if($donnees['categorie'] == "enfant" ){ echo '../Home/kids.php';}else{ echo '../Home/home.php';}?>?id_pseudo=<?php echo $donnees["id_pseudo"] ?>&email=<?php echo $donnees["email"] ?>' id='<?php $a++; echo "redirectMe$a";?>' style='align-items: center; justify-content: center; margin: 0; display: flex;'>
                        <img class="profil1" src="<?php if(!empty($donnees['image'])){echo $donnees['image'];}else{echo '../images/user_pic/4.png';} ?>" alt="Profile image" style="cursor: pointer; align-items: center; justify-content: center; margin: 0; display: flex;"></img>
                    </a>
                    <a href='./edit_form.php?id_pseudo=<?php echo $donnees["id_pseudo"] ?>&email=<?php echo $donnees["email"] ?>' id='<?php $a++; echo "redirectMe$a";?>' style='align-items: center; justify-content: center; margin: 0; display: flex;'>
                        <img class="profil1" src="<?php if(!empty($donnees['image'])){echo $donnees['image'];}else{echo '../images/user_pic/4.png';} ?>" alt="Profile image" style="cursor: pointer"></img>
                    </a>
                    <svg class="test" version="1.1" id="<?php $i++; echo "Calque_$i";?>"  x="0px" y="0px" width="582.8px" height="582.8px" viewBox="0 0 582.8 582.8" style="enable-background:new 0 0 582.8 582.8;">
                        <style type="text/css">
                            .st0{fill:#FFFFFF;}
                        </style>
                        <path class="st0"   d="M52.5,403.9l-7.3,80.6c-1.1,12.5,3,24.9,11.5,34.1c8.5,9.3,20.4,14.5,32.9,14.5c1.3,0,2.7,0,4.1-0.2l80.6-7.3h0
                                            c21.4-1.9,41.3-11.3,56.5-26.5L438,292l78.5-78.4c13.6-13.6,21.2-32,21.2-51.2c0-19.2-7.6-37.6-21.2-51.2l-49.4-49.4
                                            c-13.6-13.6-32-21.2-51.2-21.2c-19.2,0-37.6,7.6-51.2,21.2l-78.4,78.4L79,347.3C63.8,362.5,54.4,382.5,52.5,403.9L52.5,403.9z
                                            M405.6,102.6c2.7-2.7,6.4-4.2,10.2-4.2c3.8,0,7.5,1.5,10.3,4.2l49.4,49.4c2.7,2.7,4.2,6.4,4.2,10.3c0,3.8-1.5,7.5-4.2,10.2
                                            L438,209.9l-69.9-69.9L405.6,102.6z M110.2,409.1c0.7-7.9,4.2-15.2,9.7-20.8l207.2-207.2L397,251L189.8,458.2
                                            c-5.6,5.6-12.9,9-20.8,9.7l-64.7,5.9L110.2,409.1z"/>
                                                            
                    </svg> <!-- pen svg for editing -->


                </div>
                <p class="name_User"><?php echo $donnees['pseudo'] ?></p>
                                         
            </div>
            <?php } ?>
            <?php if ($nbDePseudos[0] < 4){
             echo'  <div class="add_div">
                      
                            <img src="../images/add_button.svg" >
                      
                      <p class="name_User">New User</p>
                    </div>';
                    };
            ?>        
            
            

            <div id="container_form">
                 <div class="choose_your_image">
                        <input type="radio" id="imageProfile" name="imageProfile" value="../images/user_pic/4.png" checked></input>
                        <img src="../images/user_pic/4.png" id="changeThis" alt="Profile's image" srcset="">
                    </div>
                       
                <form action='' method="post" id="form_profil">
                   
                   
                    <input type="text" name="pseudo" placeholder="" id="changePseudo"></input>
                    
                    <select class="form-select" name="categorie">
                        <option value="" disabled selected hidden > Select your option</option>
                        <option value="adulte">Adulte</option>
                        <option value="enfant">Enfant</option>
                    </select>
                    <button type="submit" name="RegisterEnter" id="subButton">Create New User</button>
                </form>
                
            </div>
 

            <div id="container_form_images">
                <form action='' method="post" id="containerImages">
                    <div class="row_images">
                        <input type="radio" id="4" name="brandtype" value="../images/user_pic/4.png" >
                            <label for="4">
                                <img src="../images/user_pic/4.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="2" name="brandtype" value="../images/user_pic/2.png">
                            <label for="2">
                                <img src="../images/user_pic/2.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="3" name="brandtype" value="../images/user_pic/3.png">
                            <label for="3">
                                <img src="../images/user_pic/3.png" alt="" style="border-radius: 250px">
                            </label>
                    </div>

                    <div class="row_images">
                        <input type="radio" id="10" name="brandtype" value="../images/user_pic/10.png">
                            <label for="10">
                                <img src="../images/user_pic/10.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="5" name="brandtype" value="../images/user_pic/5.png">
                            <label for="5">
                                <img src="../images/user_pic/5.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="6" name="brandtype" value="../images/user_pic/6.png">
                            <label for="6">
                                <img src="../images/user_pic/6.png" alt="" style="border-radius: 250px">
                            </label>
                    </div>

                    <div class="row_images">
                        <input type="radio" id="7" name="brandtype" value="../images/user_pic/7.png">
                            <label for="7">
                                <img src="../images/user_pic/7.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="12" name="brandtype" value="../images/user_pic/12.png">
                            <label for="12">
                                <img src="../images/user_pic/12.png" alt="" style="border-radius: 250px">
                            </label>
                        <input type="radio" id="11" name="brandtype" value="../images/user_pic/11.png">
                            <label for="11">
                                <img src="../images/user_pic/11.png" alt="" style="border-radius: 250px">
                            </label>
                    </div> 
                </form>
            </div>
        </div>

        <div class="edit_buttons">
            <?php 
            if ($nbDePseudos[0] > 0){
                echo    '<button class="modif_button" label="edit" id="edit">Edit</button> ';
            };
            ?>
        </div>
    
        <?php 
        $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
        $requete->execute(array($_GET['email']));
        ?>
        
    </div>

    <div class="arrowBack" onclick="getBack()">
            <svg version="1.1" id="Calque_1"  x="0px" y="0px"
            	 width="97.4px" height="97.7px" viewBox="0 0 97.4 97.7" style="enable-background:new 0 0 97.4 97.7;" xml:space="preserve">
            <style type="text/css">
            	.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF;}
            </style>
            <path class="st0" d="M54.7,74.1c0.7,0.7,1.7,0.7,2.4,0l2.4-2.4c0.7-0.7,0.7-1.7,0-2.4L39.3,49l20.3-20.3c0.7-0.7,0.7-1.7,0-2.4
            	l-2.4-2.4c-0.7-0.7-1.7-0.7-2.4,0L30.8,47.7c-0.7,0.7-0.7,1.7,0,2.4L54.7,74.1z"/>
            </svg>

	</div>
</body>
<footer>
    <div class="disclaimer">
        <p class="txt1">Sci-Fi streaming Solution</p>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='./script/script_profil.js'></script>
</html>



