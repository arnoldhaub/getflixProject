<?php

//======================================================================
// SECURITY - ID VERIFICATION // BACK TO MOVIES INDEX
//======================================================================

if (empty($_GET['id'])) {
    header("location: index.php");
}


//======================================================================
// FETCH ALL INFORMATION FROM THE API && PUT ID IN VARIABLE
//======================================================================

$id = $_GET['id'];
include "../api/api/info.php";
 
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edege">
        <title>Movie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  media="screen">
        <link href="./styles/styles_movie_preview.css" rel="stylesheet">
        <link href="./styles/styles_nav_footer.css" rel="stylesheet"> 
    </head>
    <body>  
<!-----------------------------------------------------------------------
                     HEADER + MENU
------------------------------------------------------------------------->
        <header>
            <img class="logo" src="../images/logo.svg" alt="logo">
            <img class="logo_minia" src="../images/logo_planete.svg" alt="logo_minia">
            <nav>
                <ul class="nav_links">
                    <li><a href="/Home/home.php"> HOME</a></li>
                    <li><a href="#">FILMS</a></li>
                    <li><a href="#">SERIES</a></li>
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
            <div class="user">
                <p class="p_username">USER</p>
                <img class="userImage" name="userImage" src="../images/CN.jpg" alt="userImage">
            </div>
        </header>
<!-----------------------------------------------------------------------
                     WEBSITE
------------------------------------------------------------------------->
        <div class="BackgroundImage">
                <img src="<?php echo $imgurl.$infoSerie->backdrop_path;?>" id="testImage" style="max-width: 100%;">
                <div class="headerMovie">

                    <div class="nameMovie">
                        <h1><?php echo $infoSerie->name; ?></h1>
                    </div>

                    <div class="infosMovie">
                        <button disabled>18+</button>
                        <button disabled>VO</button>
                        <button disabled>VOSTFR</button>
                        <p><?php echo substr($infoSerie->first_air_date, 0, 4)." | ".$infoSerie->number_of_seasons; if($infoSerie->number_of_seasons > 1){ echo " seasons";}else{ echo " season";}?></p> 
                    </div>

                    <div class="typeMovie">
                        <p class="typeMovieDescription">
                            <?php 
                            
                            foreach($infoSerie->genres as $i){
                                if ($i === end($infoSerie->genres)) {
                                    echo $i->name;
                                }
                                else{
                                    // not last element
                                    echo $i->name.', ' ;
                                }
                            }?>
                        </p>
                    </div>

                    <div class="buttonsMovie">
                        <button class="play" id="playButton" data-toggle="modal" data-target="#watch2"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                    </div>
                    <!-- MODAL  -->
                    <div id="watch2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="watch3" src="https://www.youtube.com/embed/<?php echo $infoSerie->videos->results[0]->key;?>" allow="autoplay;" allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="descriptionMovie">
                        <p class="description"><?php echo $infoSerie->overview ?></p>
                        <p class="empty"></p>
                    </div>
                </div>
        </div> 

<!-----------------------------------------------------------------------
                     DISPLAY SEASONS + EPISODE
------------------------------------------------------------------------->
        <?php
        if (!empty($infoSerie->seasons)) {
            foreach($infoSerie->seasons as $p){
                $season = $p->season_number;
                echo    '<div class="container_movie">
                            <div class="container">
                                <p class="title_slide">'.$p->name.'</p>
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">';
                
                include "../api/api/episodeInfo.php"; 
                foreach($episodeInfo->episodes as $i){
                    echo                '<div class="swiper-slide">
                                            <a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                                            <img src="' . $imgurl_500 . $i->still_path . '"></a>
                                            <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'<br>
                                        </div>';
                }
                echo                '<div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        
                }
            
            }
        ?>

<!-----------------------------------------------------------------------
                     SERIES RECOMMANDATIONS
------------------------------------------------------------------------->
        <div class="container_movie">
            <div class="container">
                <p class="title_slide">You are going to like...</p>  
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <?php
                        foreach ($seriesRecommandations->results as $p) { 
                            if (!empty($p->poster_path && $p->backdrop_path)) {
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
        </div>
<!-----------------------------------------------------------------------
                     FOOTER
------------------------------------------------------------------------->
        <footer>
            <div class="footer_div">
                <img class="logo_bottom" src="../images/logo.svg" alt="logo"> 
            </div>
            <div>
                <img class="logo_resp_bottom" src="../images/logo_planete_resp.svg" alt="logo">
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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./movie_preview_script.js"></script>
        <script src="/Home/script.js"></script>
    </body>
</html>