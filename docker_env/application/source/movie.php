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
// connexion DB
//======================================================================

include('src/connect.php');

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
include "api/info.php";

?>

<!DOCTYPE html>

<head>
    <title>NOVA · <?php echo $infoMovie->title; ?></title>
    <?php include "src/head_meta_tags.php"; ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link href="styles/styles_general.css" rel="stylesheet">
    <link href="styles/styles_movie_preview.css" rel="stylesheet">
    <link href="styles/comments_styles.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    </style>
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
        <img src="<?php echo $imgurl . $infoMovie->backdrop_path; ?>" id="testImage" style="max-width: 100%;">
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
                    foreach ($infoMovie->genres as $i) {
                        if ($i === end($infoMovie->genres)) {
                            echo $i->name;
                        } else {
                            // not last element
                            echo $i->name . ', ';
                        }
                    } ?>
                </p>
            </div>

            <div class="buttonsMovie">
                <button type="button" class="play video-btn" id="playButton" data-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $infoMovie->videos->results[0]->key; ?>" data-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>PLAY</button>
            </div>
            <!-- MODAL  -->
            <div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</span></button>    
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOOTSTRAP 5 
            <div class="buttonsMovie">
                <button type="button" class="play video-btn" id="playButton" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $infoMovie->videos->results[0]->key; ?>" data-bs-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>PLAY</button>
            </div>
            
            <div class="modal fade" data-bs-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></span></button>
                            
                            <div class="ratio ratio-16x9">
                                <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

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
                            echo  "<div class='swiper-slide' id='first-swiper'>
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
    </div>
    <!-----------------------------------------------------------------------
                     COMMENTS
------------------------------------------------------------------------->



    <?php
    $request = $db->prepare('SELECT * FROM comments WHERE id_film = ? ORDER BY id DESC');
    $request->execute(array($id));
    $comment = $request->fetchAll();

    if (isset($_POST['commentaires'])) {
        $commentaire = htmlspecialchars($_POST['commentaires']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $id_film = htmlspecialchars($id);

        $push = $db->prepare('INSERT INTO `comments` (`id`, `id_film`, `film_serie`, `nom_film`, `id_pseudo`, `pseudo`, `commentaires`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
        $push->execute(array($id_film,'film', $infoMovie->title, $_SESSION['pseudo'], $pseudo, $commentaire));
        echo "<meta http-equiv='refresh' content='0'>";
    }

    ?>


    <div class="com_container">
        <div class="container_comments_all">
            <div class="container">
                <p class="title_slide_comments">Comments about "<?php echo $infoMovie->title; ?>"</p>
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
        <p class="title_slide_comments"><?php echo $pseudoActif[0] ?> post a review about "<?php echo $infoMovie->title; ?>"</p>
        <div class="form_com">
            <form method="POST" id="formPost">
                <input style="display:none" name="pseudo" value="<?php echo $pseudoActif[0] ?>">
                <textarea type="text" placeholder="Share your opinion with others! (You  have 200 characters.)" name="commentaires" id="commentForm"></textarea></br>
                <button type="submit">COMMENT</button>
            </form>
        </div>
    </div>


    <!-----------------------------------------------------------------------
                     FOOTER
------------------------------------------------------------------------->
    <?php
    include "src/footer.php";
    ?>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/movie_preview_script.js"></script>
    <script src="js/js_comment.js"></script>
</body>

</html>