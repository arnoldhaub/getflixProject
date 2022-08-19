<?php
// On prolonge la session
session_start();
$userEmail = $_SESSION['email'];

if ($_GET['id_pseudo']) {
    $_SESSION['pseudo'] = $_GET['id_pseudo'];
}

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['email'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: index.php');
    exit();
}

include "api/info.php";
?>

<!-- SCRIPT - Masquer information GET dans URL -->
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<!DOCTYPE html>

<head>

    <title>NOVA · Home for kids</title>
    <?php include "src/head_meta_tags.php"; ?>
    <link href="styles/styles_home.css" rel="stylesheet">
</head>


<body>
    <!-----------------------------------------------------------------------
                     HEADER + MENU
------------------------------------------------------------------------->
    <?php
    include('src/header.php');
    ?>
    <!-----------------------------------------------------------------------
                     JUMBOTRON - CAROUSEL
------------------------------------------------------------------------->
    <div class="bootstrap-iso">
        <div id="carouselHome" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
                <li data-target="#carouselHome" data-slide-to="1"></li>
                <li data-target="#carouselHome" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" <?php $page = 1;
                                                include "api/age_rating.php";
                                                echo 'src="' . $imgurl . $movieForKids->results[0]->backdrop_path . '" alt="' . $imgurl . $movieForKids->results[0]->original_title . '"'; ?>>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $movieForKids->results[0]->title; ?></h5>
                        <p><?php echo substr($movieForKids->results[0]->overview, 0, 250);
                            if (strlen($movieForKids->results[0]->overview) > 250) {
                                echo '(...)';
                            } ?>
                        </p>
                        <?php echo "<a href='movie.php?id=" . $movieForKids->results[0]->id ."'>"; ?>
                        <button type="button" class="btn play"><i class="fa-solid fa-play" id="fa-play"></i>PLAY !</button>
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" <?php echo 'src="' . $imgurl . $movieForKids->results[1]->backdrop_path . '" alt="' . $imgurl . $movieForKids->results[1]->original_title . '"'; ?>>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $movieForKids->results[1]->title; ?></h5>
                        <p><?php echo substr($movieForKids->results[1]->overview, 0, 250);
                            if (strlen($movieForKids->results[1]->overview) > 250) {
                                echo '(...)';
                            } ?>
                        </p>
                        <?php echo "<a href='movie.php?id=" . $movieForKids->results[1]->id ."'>"; ?>
                        <button type="button" class="btn play"><i class="fa-solid fa-play" id="fa-play"></i>PLAY !</button>
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" <?php echo 'src="' . $imgurl . $movieForKids->results[2]->backdrop_path . '" alt="' . $imgurl . $movieForKids->results[2]->original_title . '"'; ?>>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $movieForKids->results[2]->title; ?></h5>
                        <p><?php echo substr($movieForKids->results[2]->overview, 0, 250);
                            if (strlen($movieForKids->results[2]->overview) > 250) {
                                echo '(...)';
                            } ?>
                        </p>
                        <?php echo "<a href='movie.php?id=" . $movieForKids->results[2]->id ."'>"; ?>
                        <button type="button" class="btn play"><i class="fa-solid fa-play" id="fa-play"></i>PLAY !</button>
                        </a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <!-- ======================================================================
                                    MOVIES
        //======================================================================-->

    <p class="title_slide">Movies selection · 1 </p>
    <div class="container">
        <div class="swiper-container">

            <div class="swiper-wrapper">

                <?php
                foreach ($movieForKids->results as $p) { // RECENT SF MOVIE
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
                            <a href='movie.php?id=" . $p->id ."'><img src='" . $imgurl_500 . $p->poster_path . "' id='videoTrailer'></a>
                        </div>";
                    }
                } ?>

            </div>
            <!-- Add Arrows -->

        </div>
    </div>

    <p class="title_slide">Movies selection · 2</p>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                $page += 1;
                include "api/age_rating.php";
                foreach ($movieForKids->results as $p) { // RECENT SF MOVIE
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
                                <a href='movie.php?id=" . $p->id ."'><img src='" . $imgurl_500 . $p->poster_path . "' id='videoTrailer'></a>
                            </div>";
                    }
                } ?>

            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <p class="title_slide">Movies selection · 3</p>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                $page += 1;
                include "api/age_rating.php";
                foreach ($movieForKids->results as $p) { // RECENT SF MOVIE
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
                                <a href='movie.php?id=" . $p->id ."'><img src='" . $imgurl_500 . $p->poster_path . "' id='videoTrailer'></a>
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

    <p class="title_slide">TV series selection · 1</p>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                $page = 1;
                include "api/age_rating.php";
                foreach ($serieForKids->results as $p) { // SF & FANTAST - SERIES
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
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

    <p class="title_slide">TV series selection · 2</p>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                $page += 1;
                include "api/age_rating.php";
                foreach ($serieForKids->results as $p) { // SF & FANTAST - SERIES
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
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

    <p class="title_slide">TV series selection · 3</p>
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                $page += 1;
                include "api/age_rating.php";
                foreach ($serieForKids->results as $p) { // SF & FANTAST - SERIES
                    if (!empty($p->poster_path && $p->backdrop_path)) {
                        echo  "<div class='swiper-slide'>
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

    <?php
    include "src/footer.php";
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>