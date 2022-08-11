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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link href="./styles/styles_movie_preview.css" rel="stylesheet">
        <link href="./styles/styles_nav_footer.css" rel="stylesheet"> 
        <link href="./styles/comments_styles.css" rel="stylesheet">
        <style>
            .modal-body {
                position:relative;
                padding:0px;
                background-color: #06060f;
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
                        $videoSrc + "?autoplay=1&amp;showinfo=0"
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
<?php   
    include('header_movie.php');
    ?>
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
                    <button type="button" class="play video-btn" id="playButton" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/<?php echo $infoMovie->videos->results[0]->key;?>"  data-bs-target="#myModal"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                </div>
                <!-- MODAL  -->
                <div class="modal fade" data-bs-backdrop="false"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></span></button>     
                                    <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
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
                                echo  "<div class='swiper-slide' id='first-swiper'>
                                <a href='movie_preview.php?id=".$p->id.'&id_pseudo='.$_GET['id_pseudo'].'&email='.$_GET['email']."'><img src='" . $imgurl_500 . $p->poster_path . "'></a>
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
                    <p class="title_slide_comments">Comments about "<?php echo $infoMovie->title; ?>"</p>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            foreach($comment as $comment){ 
                                echo "<div class='swiper-slide' id='commentSwiper'>
                            "?>
                                                                                                  
                                <div class="test">
                                    <img src="../images/CN.jpg" id="UserCommentImage">
                                    <div class="infos_comments">
                                        <span class="pseudo">User</span>
                                        <span><?= $comment['date'] ?></span>
                                    </div>
                                </div>   

                                <div class="test2">
                                    <p class="comment_itself">
                                        <?= $comment['pseudo'], ' ' ,$comment['commentaires']; ?> 
                                    </p>
                                </div>
                                                                        
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container_comment">
            <p class="title_slide_comments">Post a review about "<?php echo $infoMovie->title; ?>"</p>
                <div class="form_com">
                                                            
                    <form method="POST" id="formPost">
                        <textarea type="text" placeholder="max 200 carac." name="commentaires" id="commentForm"></textarea></br>  
                        <button type="submit">Post Comment</button>
                    </form>
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="./movie_preview_script.js"></script>
        <script src="./js_comment.js"></script>
    </body>
</html>