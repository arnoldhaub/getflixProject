<?php

// On prolonge la session
session_start();
$userEmail = $_SESSION['email'];

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['email'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: index.php');
    exit();
}

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                        <h1><?php echo $infoSerie->name; ?></h1>
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
                        <button type="button" class="play video-btn" id="playButton" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $infoSerie->videos->results[0]->key;?>"  data-bs-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                    </div>
<!----------------------------------------------
                     MODAL
------------------------------------------------>
                    <div class="modal fade" data-bs-backdrop="false"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></span></button>    

                                        <!-- 16:9 aspect ratio -->
                                    <div class="ratio ratio-16x9">
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

            <!-- DROPDOWN - SELECTION DE LA SAISON -->
            <?php
            if (!empty($infoSerie->seasons)) {
                echo    '<div class="dropdown-center" style="margin-left: 4vh;">
                            <button class="btn dropdown-toggle play" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Which season?
                            </button>
                            <ul class="dropdown-menu">';
                foreach($infoSerie->seasons as $p){
                    if($p->episode_count > 0){
                        echo    '<li <?php if(@$type == "serie"){echo "checked";}><a class="dropdown-item" href="serie.php?id='. $id .'&page='.$p->season_number. '" value="'.$p->season_number.'">'.$p->name.'</a></li>';
                    }
                }
                echo        '</ul>
                        </div>';

                        // SI SAISON SELECTIONNÉ, AFFICHER LES ÉPISODES
                if(isset($page)){
                    if($page == 0){$season = 1;}
                    else{$season = $page;}
                    echo    '<div class="container_serie">
                                    <div class="container">
                                        <p class="title_slide">'.$infoSerie->seasons[$page]->name.'</p>
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">';
                                            include "api/episodeInfo.php"; 
                                            foreach($episodeInfo->episodes as $i){
                                                $ep = $i->episode_number;
                                                include "api/episodeInfo.php";
                                                echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                                                if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                                                    echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-bs-target="#myModal">';
                                                }
                                                else{ // Sinon afficher celle de la série
                                                    echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-bs-target="#myModal">';
                                                }
                                                // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                                                    echo                    '<img src="';if($i->still_path != null){ echo $imgurl_500 . $i->still_path;} else{echo "images/picturetocome.png";}
                                                    echo                        '" style="object-fit: cover;"></a>
                                                                        <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>
                        
                                                                    </div>';
                                            }
                                            echo                    '<div class="swiper-button-next"></div>
                                                                    <div class="swiper-button-prev"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                                    
                                    


                }
            }
        




                // foreach($infoSerie->seasons as $p){
                //     if($p->episode_count > 0){
                //         $season = $p->season_number;
                //         echo    '<div class="container_movie">
                //                     <div class="container">
                //                         <p class="title_slide">'.$p->name.'</p>
                //                         <div class="swiper-container">
                //                             <div class="swiper-wrapper">';
                        
                //         include "api/episodeInfo.php"; 
                //         foreach($episodeInfo->episodes as $i){
                //             $ep = $i->episode_number;
                //             include "api/episodeInfo.php";
                //             echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                //             if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                //                 echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-bs-target="#myModal">';
                //             }
                //             else{ // Sinon afficher celle de la série
                //                 echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-bs-target="#myModal">';
                //             }
                //             // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                //                 echo                    '<img src="' . $imgurl_500 . $i->still_path . '" style="object-fit: cover;"></a>
                //                                     <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>
    
                //                                 </div>';
                //         }
                //         echo                    '<div class="swiper-button-next"></div>
                //                                 <div class="swiper-button-prev"></div>
                //                             </div>
                //                         </div>
                //                     </div>
                //                 </div>';
                                
                //         }
                //     }
                
                // }
            ?>
        </div>







        <!-- if (!empty($infoSerie->seasons)) {
            foreach($infoSerie->seasons as $p){
                if($p->episode_count > 0){
                    $season = $p->season_number;
                    echo    '<div class="container_movie">
                                <div class="container">
                                    <p class="title_slide">'.$p->name.'</p>
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">';
                    
                    include "api/episodeInfo.php"; 
                    foreach($episodeInfo->episodes as $i){
                        $ep = $i->episode_number;
                        include "api/episodeInfo.php";
                        echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                        if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                            echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-bs-target="#myModal">';
                        }
                        else{ // Sinon afficher celle de la série
                            echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-bs-target="#myModal">';
                        }
                        // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                            echo                    '<img src="' . $imgurl_500 . $i->still_path . '" style="object-fit: cover;"></a>
                                                <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>

                                            </div>';
                    }
                    echo                    '<div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            
                    }
                }
            
            }
        ?> -->

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
                
                $push = $db ->prepare('INSERT INTO `comments` (`id`, `id_film`, `pseudo`, `commentaires`, `date`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)');
                $push->execute(array($id_film, $pseudo, $commentaire));
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="js/movie_preview_script.js"></script>
        <script src="js/js_comment.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>