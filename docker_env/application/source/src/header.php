<header>
    <img class="logo" src="images/logo.svg" alt="logo">
    <img class="logo_minia" src="images/logo_planete.svg" alt="logo_minia">
    <nav style="align-self: center;">
        <ul class="nav_links">
            <li><a href="home.php">HOME</a></li>
            <li><a href="home.php#ancre_serie">SERIES</a></li>
            <li><a href="home.php#ancre_film">FILMS</a></li>
            <li><a href="listing.php">LISTING</a></li>
            <li><a href="search.php">SEARCH</a></li>
        </ul>

        <ul class="nav_links_responsive">
            <li><a href="home.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="home.php#ancre_film"><i class="fa-solid fa-film"></i></a></li>
            <li><a href="home.php#ancre_serie"><i class="fa-solid fa-tv"></i></a></li>
            <li><a href="listing.php"><i class="fa-solid fa-solid fa-bookmark"></i></a></li>
            <li><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
        </ul>
    </nav>

    <!--   <div class="searchbar">
                        <input type="text" name="searchBar" placeholder="Search"><i class="fa-solid fa-magnifying-glass"></i>
            </div> -->

    <?php
    require('src/connect.php');
    $id_pseudo = $_SESSION['pseudo'];
    $requete = $db->query("SELECT PSEUDO, IMAGE FROM profile WHERE id_pseudo='$id_pseudo'");
    $pseudoActif = $requete->fetch();

    ?>

    <div id="sectionUser">

        <div class="user">
            <p class="p_username"><?php echo $pseudoActif[0] ?></p>
            <img class="userImage" name="userImage" src="<?php echo $pseudoActif[1] ?>" alt="userImage">
            <i id="fleche" class="fa-solid fa-angle-down"></i>
        </div>


        <div id="listePseudos">
            <?php
            $requete2 = $db->query("SELECT PSEUDO,ID_PSEUDO,IMAGE FROM profile WHERE email='".$_SESSION['email']."'");
            while ($donnees = $requete2->fetch()) { ?>
                <li class="mb-3">
                    <div class="container">
                        <div style="flex-wrap:nowrap" class="row">
                            <img id="photoListeProfil" src="<?php echo $donnees[2] ?>" alt="profil">
                            <a style="color:white" href="home.php?id_pseudo=<?php echo $donnees[1] ?>"><?php echo $donnees[0] ?></a>
                        </div>
                    </div>
                </li>
            <?php   }
            ?>
            <hr style="height:1px">
            <?php if($_SESSION['role']  == "administrateur" or ($_SESSION['role'] =="modérateur")): ?>
                <li class="mb-3">
                <div class="container">
                    <div style="flex-wrap:nowrap" class="row">
                        <i class="fa-solid fa-user-gear"></i>
                        <a style="color:white" href="admin.php" class="ml-2">Admin</a>
                        </a>
                    </div>
                </div>
            </li>
            <?php endif?>

            <li class="mb-3">
                <div class="container">
                    <div style="flex-wrap:nowrap" class="row">

                        <i class="fa-solid fa-gear"></i>
                        <a style="color:white" href="login/profil_select.php" class="ml-2">Settings</a>
                        </a>
                    </div>
                </div>
            </li>

            <li class="mb-3">
                <div class="container">
                    <div style="flex-wrap:nowrap" class="row">
                        <i class="fa-solid fa-share-from-square"></i>
                        <a style="color:white" href="login/logout.php" class="ml-2">Disconnect</a>
                    </div>
                </div>
            </li>

        </div>
    </div>

</header>