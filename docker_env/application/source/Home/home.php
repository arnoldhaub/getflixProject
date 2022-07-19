<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edege">
        <title>Navbar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="styles/styles_home.css" rel="stylesheet">
    </head>


    <body>
        <header>
            <img class="logo" src="images/logo.svg" alt="logo">
            <img class="logo_minia" src="images/logo_planete.svg" alt="logo_minia">
            <nav>
                <ul class="nav_links">
                    <li><a href="#"><i class="fa-solid fa-house"></i> HOME</a></li>
                    <li><a href="#"><i class="fa-solid fa-film"></i></i> FILMS</a></li>
                    <li><a href="#"><i class="fa-solid fa-tv"></i></i> SERIES</a></li>
                    <li><a href="#"></a><i class="fa-solid fa-magnifying-glass"></i></i> RECHERCHE</a></li>
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
            <div class="user">
                <p class="p_username">USER</p>
                <img class="userImage" name="userImage" src="images/CN.jpg" alt="userImage">
            </div>
        </header>

        <div class="container_content">
            <div class="jumbotron"></div>
        </div>

        <!-- <div class="container_content2">
        <h4>Nouveau sur NovaFlix</h4>
            <ul class="ListBox">
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
            </ul>
        -->

        <!-- ======================================================================
                                    MOVIES
        //======================================================================-->

        <p>Nouveauté</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    include "../api/api/info.php";
                    foreach ($moviesLatest->results as $p) { // RECENT SF MOVIE
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='movie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <p>Incontournables</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($moviesTopRated->results as $p) { // TOP-RATED SF MOVIE
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='movie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <p>Populaires</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($moviesPopular->results as $p) { // POPULAR SF MOVIE
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='movie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>


        <!-- ======================================================================
                                    SERIES
        //======================================================================-->

        <p>Nouveauté</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    include "../api/api/info.php";
                    foreach ($seriesLatest->results as $p) { // SF & FANTAST - SERIES
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='serie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <p>Incontournables</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($seriesTopRated->results as $p) { // TOP RATED - SF & FANTAST - SERIES
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='serie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <p>Populaires</p>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    foreach ($seriesPopular->results as $p) { // POPULAR - SF & FANTAST - SERIES
                        if (!empty($p->poster_path)) {
                            echo  "<div class='swiper-slide'>
                            <a href='serie.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
                        </div>";
                        }
                    } ?>

                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <footer>
            <div class="footer_div">
                <img class="logo_bottom" src="images/logo.svg" alt="logo"> 
                </div>
            <div>
                <img class="logo_resp_bottom" src="images/logo_planete_resp.svg" alt="logo">
            </div>
           <div class="span_div">
                <span class="span_footer">SCI-FI STREAMING SOLUTION</span>
                <span class="span_footer">CREDITS & COOKIES</span>
                <span class="span_footer">NOVA 2022©</span>
                <span class="span_footer">ACCESSIBILITY</span>
                <span class="span_footer">REPORT A BUG</span>
            </div>
        </footer> 

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
        <script src="./script.js"></script>
    </body>
</html>