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
 <div class="BackgroundImage">
                    <img src="../images/Only-Murders-In-The-Building-Star-Plus.jpeg" id="testImage" style="max-width: 100%;">
                    <div class="headerMovie">
   
                                       <div class="nameMovie">
                                           <h1>Movie's Name</h1>
                                       </div>


                                        <div class="infosMovie">
                                                          <button disabled>18+</button>
                                                          <button disabled>VO</button>
                                                          <button disabled>VOSTFR</button>
                                                          <p> 2019 - 2 Saisons
                                                          </p>
                                        </div>

                                        <div class="typeMovie">
                                            <p class="typeMovieDescription">Drames, Thriller, Distopie</p>
                                        </div>


                                         <div class="buttonsMovie">
                                             <button class="play" id="playButton"><i class="fa-solid fa-play" id="fa-play"></i>LECTURE</button>
                                         </div>


                                        <div class="descriptionMovie">
                                            <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid cumque suscipit animi, nihil tenetur quidem! Nihil eius optio quas ex assumenda voluptate, magnam quod. Eius quis illum architecto quisquam nihil.</p>
                                            <p class="empty"></p>
                                        </div>

    
                    </div>
</div> 


     
    
        <div class="container">
            <p class="title_slide">Vous aimerez peut-etre...</p>  
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php
                    include "./../api/api/info.php";
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