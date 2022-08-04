<header>
            <img class="logo" src="/images/logo.svg" alt="logo">
            <img class="logo_minia" src="/images/logo_planete.svg" alt="logo_minia">
            <nav>
                <ul class="nav_links">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">SERIES</a></li>
                    <li><a href="#">FILMS</a></li>
                    <li><a href="#"></a>RECHERCHE</a></li>
                </ul>

                <ul class="nav_links_responsive">
                    <li><a href="#"><i class="fa-solid fa-house"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-film"></i></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-tv"></i></i></a></li>
                    <li><a href="#"></a><i class="fa-solid fa-magnifying-glass"></i></i></a></li>
                </ul>
            </nav>

            <!--   <div class="searchbar">
                        <input type="text" name="searchBar" placeholder="Search"><i class="fa-solid fa-magnifying-glass"></i>
            </div> -->

            <?php
            require('../src/connect.php');
            $id_pseudo = $_GET["id"];
            $requete = $db->query("SELECT PSEUDO FROM profile WHERE id='$id_pseudo'");
            $pseudo = $requete->fetch();
            ?>

            <div class="user">
                <p class="p_username"><?php echo $pseudo[0] ?></p>
                <img class="userImage" name="userImage" src="/images/CN.jpg" alt="userImage">
            </div>
        </header>