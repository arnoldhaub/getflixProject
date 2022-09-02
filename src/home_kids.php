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
                        <button type="button" class="btn_play">WATCH NOW</button>
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
                        <button type="button" class="btn_play">WATCH NOW</button>
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
                        <button type="button" class="btn_play">WATCH NOW</button>
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

    <p id="ancre_film" class="title_slide">Movies selection · 1 </p>
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

    <p id="ancre_serie" class="title_slide">TV series selection · 1</p>
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