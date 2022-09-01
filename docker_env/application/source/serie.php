<?php

// On prolonge la session
session_start();

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['email'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: index.php');
    exit();
}

//======================================================================
// connexion DB
//======================================================================

include('src/connect.php');
$seriesListingQuery = $db->query('SELECT id_film FROM listing WHERE id_pseudo="'.$_SESSION['pseudo'].'" AND id_film="'.$_GET['id'].'"');


//======================================================================
// FETCH ALL INFORMATION FROM THE API && PUT ID IN VARIABLE
//======================================================================

$id = $_GET['id'];
if(!isset($_GET['page'])){
    $page = 0;
}
else{
    $page = $_GET['page'];
}

include "api/info.php";
 
?>

<!DOCTYPE html>
    <head>
        <title>NOVA · <?php echo $infoSerie->name; ?></title>
        <?php include "src/head_meta_tags.php"; ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link href="styles/styles_general.css" rel="stylesheet">
        <link href="styles/styles_movie_preview.css" rel="stylesheet">
        <link href="styles/comments_styles.css" rel="stylesheet">
    </head>
    <body>  
<!-----------------------------------------------------------------------
                     HEADER + MENU
------------------------------------------------------------------------->
    <?php   
    include('src/header.php');
    ?>
<!-----------------------------------------------------------------------
                     WEBSITE
------------------------------------------------------------------------->
        <div class="BackgroundImage">
                <img src="<?php echo $imgurl.$infoSerie->backdrop_path;?>" id="testImage" style="max-width: 100%;">
                <div class="headerMovie">

                    <div class="nameMovie">
                        <h1>
                            <?php echo $infoSerie->name; ?>
                            <?php   if(empty($seriesListingQuery->fetch())){
                                        echo '<a href="src/listing.php?id_film='.$id.'&id_pseudo='.$_SESSION['pseudo'].'&type=serie&action=add"><i id="notListed" class="fa-regular fa-bookmark fa-fade" style="color:#06060f"></i></a>';}
                                    else { echo '<a href="src/listing.php?id_film='.$id.'&id_pseudo='.$_SESSION['pseudo'].'&type=serie&action=remove"><i id="listed" class="fa-solid fa-bookmark" style="color:#06060f"></i></a>';} ?>
                        </h1>
                    </div>

                    <div class="infosMovie">
                        <button disabled>
                            18+
                            <?php 
                            // include "api/age_rating.php"; 
                            // $key = array_search('NL', $serieAgeRating);
                            // echo $key;  ?>
                            
                        </button>
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
                        <button type="button" class="play video-btn" id="playButton" data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $infoSerie->videos->results[0]->key;?>"  data-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                    </div>
<!----------------------------------------------
                     MODAL
------------------------------------------------>
                    <div class="modal fade" data-backdrop="false"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        &times;</span>
                                    </button>    

                                        <!-- 16:9 aspect ratio -->
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="" id="video"  allow="autoplay" allowfullscreen></iframe>
                                    </div>
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
        <div class="container_movie">
            <?php include ('src/serie_season.php') ?>
            
        </div>

<!-----------------------------------------------------------------------
                     SERIES RECOMMANDATIONS
------------------------------------------------------------------------->
        <div class="container_recommended">
            <div class="container">
                <p class="title_slide">You are going to like...</p>  
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <?php
                        foreach ($seriesRecommandations->results as $p) { 
                            if (!empty($p->poster_path && $p->backdrop_path)) {
                                echo  "<div class='swiper-slide' id='first-swiper'>
                                <a href='serie.php?id=" . $p->id ."'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
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
            $request = $db ->prepare('SELECT * FROM comments WHERE id_film = ? ORDER BY id DESC');
            $request ->execute(array($id));
            $comment = $request->fetchAll();
            
            if(isset($_POST['commentaires']))
            {
                $commentaire =htmlspecialchars($_POST['commentaires']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $id_film = htmlspecialchars($id);
                
                $push = $db->prepare('INSERT INTO `comments` (`id`, `id_film`, `film_serie`, `nom_film`, `id_pseudo`, `pseudo`, `commentaires`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
                $push->execute(array($id_film,'serie', $infoSerie->name, $_SESSION['pseudo'], $pseudo, $commentaire));
                echo "<meta http-equiv='refresh' content='0'>";
            }
            
        ?>

                                        
        <div class="com_container">
        <div class="container_comments_all">
            <div class="container">
                <p class="title_slide_comments">Comments about "<?php echo $infoSerie->name; ?>"</p>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($comment as $comment) {
                            echo "<div class='swiper-slide' id='commentSwiper'>";
                        ?>
                            <div class="test">
                                <img src="<?php echo $pseudoActif[1] ?>" id="UserCommentImage">
                                <div class="infos_comments">
                                    <span class="pseudo"><?php echo $comment['pseudo'] ?></span>
                                    <span><?= $comment['date'] ?></span>
                                </div>
                            </div>

                            <div class="test2">
                                <p class="comment_itself">
                                    <?= $comment['commentaires']; ?>
                                </p>
                            </div>

                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container_comment">
        <p class="title_slide_comments"><?php echo $pseudoActif[0] ?> post a review about "<?php echo $infoSerie->name; ?>"</p>
        <div class="form_com">
            <form method="POST" id="formPost">
                <input style="display:none" name="pseudo" value="<?php echo $pseudoActif[0] ?>">
                <textarea type="text" placeholder="Share your opinion with others! (You  have 200 characters.)" name="commentaires" id="commentForm"></textarea></br>
                <button type="submit">Post Comment</button>
            </form>
        </div>
    </div>
                                                 
             
<!-----------------------------------------------------------------------
                     FOOTER
------------------------------------------------------------------------->
        <?php
        include "src/footer.php";
        ?>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/movie_preview_script.js"></script>
        <script src="js/js_comment.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>