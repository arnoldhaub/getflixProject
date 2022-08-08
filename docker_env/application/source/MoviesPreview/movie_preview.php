<?php

//======================================================================
// connexion DB
//======================================================================

include('../src/connect.php');

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
        <style>
            .modal-dialog {
                max-width: 800px;
                margin: 30px auto;
            }
            .modal-body {
            position:relative;
            padding:0px;
            }
            .close {
            position:absolute;
            right:-30px;
            top:0;
            z-index:999;
            font-size:2rem;
            font-weight: normal;
            color:#fff;
            opacity:1;
            }
        </style>
        <script>
            $(document).ready(function() {
  var $videoSrc;
  $(".video-btn").click(function() {
    $videoSrc = $(this).data("src");
  });
  $("#myModal").on("shown.bs.modal", function(e) {
    $("#video").attr(
      "src",
      $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
    );
  });
  $("#myModal").on("hide.bs.modal", function(e) {
    $("#video").attr("src", ""); // Remove the video source.
  });
});
        </script>
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
            <img src="<?php echo $imgurl.$infoMovie->backdrop_path;?>" id="testImage" style="max-width: 100%;">
            <div class="headerMovie">
                <div class="nameMovie">
                    <h1><?php echo $infoMovie->title; ?></h1>
                </div>

                <div class="infosMovie">
                    <button disabled>18+</button>
                    <button disabled>VO</button>
                    <button disabled>VOSTFR</button>
                    <p><?php echo substr($infoMovie->release_date, 0, 4); ?></p> 
                </div>

                <div class="typeMovie">
                    <p class="typeMovieDescription">
                        <?php 
                            foreach($infoMovie->genres as $i){
                                if ($i === end($infoMovie->genres)) {
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
                    <button type="button" class="play video-btn" id="playButton" data-toggle="modal" data-src=""  data-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                </div>
                <!-- MODAL  -->
                <div class="modal fade" data-backdrop="false"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>        
                                        <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $infoMovie->videos->results[0]->key;?>" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="descriptionMovie">
                    <p class="description"><?php echo $infoMovie->overview ?></p>
                    <p class="empty"></p>
                </div>
            </div>
        </div> 
<!-----------------------------------------------------------------------
                     SERIES RECOMMANDATIONS
------------------------------------------------------------------------->
        <div class="container_movie">
            <div class="container">
                <p class="title_slide">You are going to like...</p>  
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <?php
                        foreach ($moviesRecommandations->results as $p) { 
                            if (!empty($p->poster_path && $p->backdrop_path)) {
                                echo  "<div class='swiper-slide'>
                                <a href='movie_preview.php?id=" . $p->id . "'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
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
                     COMMENTS
------------------------------------------------------------------------->
        <?php 
            $request = $db ->prepare('SELECT * FROM comments WHERE id_film = ?');
            $request ->execute(array($id));
            $comment = $request->fetchAll();
            
            if(isset($_POST['commentaires'], $_POST['pseudo']))
            {
                $commentaire =htmlspecialchars($_POST['commentaires']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $id_film = htmlspecialchars($id);
                
                $push = $db ->prepare('INSERT INTO `comments` (`id`, `id_film`, `pseudo`, `commentaires`, `date`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)');
                $push->execute(array($id_film, $pseudo, $commentaire));
                //header('location: movie_preview.php');
            }
            
        ?>
        <div name="com">
            <?php
               foreach($comment as $comment)
            {?>
            <p> <?= $comment['date'],' ', $comment['pseudo'], ' ' ,$comment['commentaires']; ?> </p>
            <?php
            }?>
        </div>
        <div name="form_com">
            <form method="POST">
                <input type="text" placeholder="pseudo" name="pseudo"><br/>
                <input type="text" placeholder="votre commentaire" name="commentaires"><br/> 
                <button type="submit">envoyer</button>
            </form>
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