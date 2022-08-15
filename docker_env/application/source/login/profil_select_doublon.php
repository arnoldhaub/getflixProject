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

        header('location: profil_select_doublon.php?email=' . $_GET['email'] . '');
        }

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="./styles/profil_select.css" rel="stylesheet">
    
</head>

<body>

 <?php
            require('../src/connect.php');
            // Calcul du nombres de pseudos de l'adresse mail
            $email = htmlspecialchars($_GET['email']);
            $requete = $db->query("SELECT COUNT(*) AS nbPseudo FROM profile WHERE email='$email'");
            $nbDePseudos = $requete->fetch();
            $i = 0;
            if ($nbDePseudos[0] < 5) { 
        ?>
        
    <div class="container1">

        
                    
                            

                            <?php   }
                                $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
                                $requete->execute(array($_GET['email']));
                            ?>
                            

                            <h1>Who are you ?</h1>

                           
                     
                            <div class="profile_select">

                            <?php if ($nbDePseudos[0] == 0){
                                            echo '<svg class="buttonAdd" version="1.1" id="buttonAdd" x="0px" y="0px"
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


                                                    <a href="../Home/home.php?id_pseudo=<?php echo $donnees['id_pseudo'] ?>&email=<?php echo $donnees['email'] ?>" id="width_image">
                                                        <img class="profil1" src="../images/user_pic/4.png" alt="default image" style="cursor: pointer"></img>
                                                    </a>
                                                    <svg class="test" version="1.1" id="<?php $i++; echo "Calque_$i";?>"  x="0px" y="0px" width="582.8px" height="582.8px" viewBox="0 0 582.8 582.8" style="enable-background:new 0 0 582.8 582.8;">
                                                        <style type="text/css">
                                                        	.st0{fill:#FFFFFF;}
                                                        </style>
                                                        <path class="st0" d="M52.5,403.9l-7.3,80.6c-1.1,12.5,3,24.9,11.5,34.1c8.5,9.3,20.4,14.5,32.9,14.5c1.3,0,2.7,0,4.1-0.2l80.6-7.3h0
                                                        	c21.4-1.9,41.3-11.3,56.5-26.5L438,292l78.5-78.4c13.6-13.6,21.2-32,21.2-51.2c0-19.2-7.6-37.6-21.2-51.2l-49.4-49.4
                                                        	c-13.6-13.6-32-21.2-51.2-21.2c-19.2,0-37.6,7.6-51.2,21.2l-78.4,78.4L79,347.3C63.8,362.5,54.4,382.5,52.5,403.9L52.5,403.9z
                                                        	 M405.6,102.6c2.7-2.7,6.4-4.2,10.2-4.2c3.8,0,7.5,1.5,10.3,4.2l49.4,49.4c2.7,2.7,4.2,6.4,4.2,10.3c0,3.8-1.5,7.5-4.2,10.2
                                                        	L438,209.9l-69.9-69.9L405.6,102.6z M110.2,409.1c0.7-7.9,4.2-15.2,9.7-20.8l207.2-207.2L397,251L189.8,458.2
                                                        	c-5.6,5.6-12.9,9-20.8,9.7l-64.7,5.9L110.2,409.1z"/>
                                                            
                                                    </svg> <!-- pen svg for editing -->


                                           </div>
                                            <p class="name_User"><?php echo $donnees['pseudo'] ?></p>
                                           <!-- <a class="" href="profil_delete.php?id_pseudo=<?php echo $donnees['id_pseudo'] ?>&email=<?php echo $donnees['email'] ?>" style="">Delete</button> -->
                                          
                                            
                                        </div>
                            
                               

                                    
                                        <?php } ?> 
                                       
                                         <div id="container_form">
                                                <form action='' method="post" id="form_profil">
                                                         <input type="text" name="pseudo" placeholder="Add your pseudo"></input>
                                                         <select class="form-select" name="categorie">
                                                                    <option value="" disabled selected hidden > Select your option</option>
                                                                    <option value="adulte">Adulte</option>
                                                                    <option value="enfant">Enfant</option>
                                                         </select>
                                                         <button type="submit" name="RegisterEnter" id="subButton">Submit</button>
                                                </form>
                                               <!-- <form action="" method="get">
                                                 <a class="" href="profil_delete.php?id_pseudo=<?php echo $donnees['id_pseudo'] ?>&email=<?php echo $donnees['email'] ?>" style="">
                                                 <button>Delete</button></a> 
                                                <form> -->
                                        </div>
                            </div>

                            
                            <?php if ($nbDePseudos[0] > 0){
                          
                                    echo'
                                    <div class="edit_buttons">
                                    <button class="modif_button" label="edit" id="edit">Edit</button> <button class="modif_button" label="edit" id="addButton">Add</button>
                                    </div>';
                        
                                };

                               
                                        
                            ?> 
                        
                            
                            
    </div>



                    

    
    
              
        <?php 
    $requete = $db->prepare('SELECT * FROM profile WHERE email = ?');
    $requete->execute(array($_GET['email']));
        ?>

    
            
          
</body>

<footer>
    <div class="disclaimer">
        <p class="txt1" style="font-size: 20px;">Sci-Fi streaming Solution</p>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='./script/script_profil.js'></script>



</html>



