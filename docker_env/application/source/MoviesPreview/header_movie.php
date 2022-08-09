<header>
            <img class="logo" src="/images/logo.svg" alt="logo">
            <img class="logo_minia" src="/images/logo_planete.svg" alt="logo_minia">
            <nav style="align-self: center">
                <ul class="nav_links">
                    <li><a href="home.php?id=<?php echo $_GET['id']?>&email=<?php echo $_GET['email']?>">HOME</a></li>
                    <li><a href="#">SERIES</a></li>
                    <li><a href="#">FILMS</a></li>
                    <li><a href="search.php?id=<?php echo $_GET['id']?>&email=<?php echo $_GET['email']?>">RECHERCHE</a></li>
                </ul>

                <ul class="nav_links_responsive">
                    <li><a href="home.php?id=<?php echo $_GET['id']?>&email=<?php echo $_GET['email']?>"><i class="fa-solid fa-house"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-film"></i></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-tv"></i></i></a></li>
                    <li><a href="search.php?id=<?php echo $_GET['id']?>&email=<?php echo $_GET['email']?>"></a><i class="fa-solid fa-magnifying-glass"></i></i></a></li>
                </ul>
            </nav>

            <!--   <div class="searchbar">
                        <input type="text" name="searchBar" placeholder="Search"><i class="fa-solid fa-magnifying-glass"></i>
            </div> -->

            <?php
            require('../src/connect.php');
            $id_pseudo = $_GET["id"];
            $requete = $db->query("SELECT PSEUDO FROM profile WHERE id='$id_pseudo'");
            $pseudoActif = $requete->fetch();
            
            ?>

            <div id="sectionUser">

            <div class="user mb-2">
                <p class="p_username"><?php echo $pseudoActif[0] ?></p>
                <img class="userImage" name="userImage" src="/images/CN.jpg" alt="userImage">
                <i id="fleche" class="fa-solid fa-angle-down"></i>
            </div>


            <div id=listePseudos>
            <?php
            $email = $_GET["email"];
            $requete2 = $db->query("SELECT PSEUDO,ID FROM profile WHERE email='$email'");
            while($donnees = $requete2->fetch())
                    { ?>
                <li class="mb-3 " style="list-style-type:none">
                    <div class="container">
                        <div style="flex-wrap:nowrap" class="row">
                <img id="photoListeProfil" src="../images/adulte.png" alt="profil">
                <a style="color:white" href="home.php?id=<?php echo $donnees[1]?>&email=<?php echo $email?>"><?php echo $donnees[0] ?>
                </a>
                        </div>
                    </div>
                </li>
            <?php   }
            ?>
            <hr style="height:1px">
             <li class="mb-3" style="list-style-type:none">
                    <div class="container">
                        <div style="flex-wrap:nowrap" class="row">
                
                <i class="fa-solid fa-pen"></i>
                <a style="color:white" href="../login/profil_select.php?email=<?php echo $_GET['email'] ?>" class="ml-2">Settings</a>
                </a>
                        </div>
                    </div>
            </li>
               
            <li class="mb-3" style="list-style-type:none">
                    <div class="container">
                        <div style="flex-wrap:nowrap" class="row">
                <i class="fa-solid fa-share-from-square"></i>
                <a style="color:white" href="../login/logout.php" class="ml-2">Disconnect</a>
                        </div>
                    </div> 
            </li>

            </div>
            </div>

</header>