<?php
//======================================================================
//                  SEARCH INFORMATION
//======================================================================
include("../api/api/info.php");
    // FORMULAIRE - Prise d'informations
    @$keywords=str_replace(' ','%20',$_GET["keywords"]);
    @$submit=$_GET["submit"];
    @$type=$_GET["type"];
    if(isset($submit) && !empty(trim($keywords))){

        include("../api/api/search.php");

        if($type == "movie"){
            $count = $searchKeywordsMovie->total_results;
        }
        else if($type == "serie"){
            $count = $searchKeywordsSerie->total_results;
        } 

        $searchResult= true; // si true => Affichage des résultats

    }
?>
<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edege">
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"  media="screen">
        <link href="./styles/styles_search_page.css" rel="stylesheet">
        <link href="./styles/styles_nav_footer.css" rel="stylesheet">
    </head>
<!-----------------------------------------------------------------------
                     HEADER + MENU
------------------------------------------------------------------------->
<?php   
    include('header_search.php');
    ?>

<!-----------------------------------------------------------------------
                     WEBSITE
------------------------------------------------------------------------->
        <div class="container_page">
             <div class="container_menu">
                <p class="choix2"><img src="../images/select_circle.svg" id="circle_selector"><img src="../images/select_circle_selected.svg" id="circle_selected"> FILM </p>
                <p class="choix3"><img src="../images/select_circle.svg" id="circle_selector2"><img src="../images/select_circle_selected.svg" id="circle_selected2"> SERIES </p>
                <p class="choix4"><img src="../images/select_circle.svg" id="circle_selector3"><img src="../images/select_circle_selected.svg" id="circle_selected3"> SHORT </p>
            </div>

            <div class="container-content" id="container-content">
                <form name="fo" method="get" action="" id="searchBar">
                    <div class="wrapper_container_search">
                        <input type="text" name="keywords" pattern=".{3,}" id="input_Search"  oninvalid="this.setCustomValidity('Field must contain min. 3 characters')" value="<?php echo str_replace('%20',' ',$keywords)?>" placeholder="Write what you are you looking for...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="submit" name="submit" hidden/>
                    <input type="radio" class="btn-check" name="type" value="movie" id="movie" autocomplete="off" required <?php if(@$type == "movie"){echo "checked";} ?> >
                    <input type="radio" class="btn-check" name="type" value="serie" id="serie" autocomplete="off" <?php if(@$type == "serie"){echo "checked";} ?>>
                    <input type="radio" class="btn-check" name="type" value="short" id="short" autocomplete="off" <?php if(@$type == "short"){echo "checked";} ?>>
                </form>
            </div>
        </div>

<!-----------------------------------------------------------------------
                     AFFICHAGE RESULTATS DE RECHERCHE
------------------------------------------------------------------------->
        <?php if(@$searchResult==true) { ?>
            <div id="resultats">
                <p id="nbr"><?=@$count." ".($count > 1 ? "results found":"No result, try again.") ?></p>
<!--------------------------------------------------------
                            SI FILM :
---------------------------------------------------------->
                    <?php 
                        if($type == "movie"){
                            for($i = $searchKeywordsMovie->page; $i < $searchKeywordsMovie->total_pages;$i++){
                                 echo '<div class="container">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">';
                                                    $page = $i;
                                                    include("../api/api/search.php");
                                                    foreach($searchKeywordsMovie->results as $p){
                                                        if (!empty($p->poster_path)) {
                                                    
                                            echo    "<div class='swiper-slide' id='first-swiper'>
                                                        <a href='../MoviesPreview/movie_preview.php?id=".$p->id."'>
                                                            <img src='".$imgurl_300 . $p->poster_path . "'>
                                                        </a>
                                                    </div>";
                                                        }
                                                    // Pour afficher tutre des film à la ligne
                                                    // <br><a href='../MoviesPreview/movie_preview.php?id=".$p->id."'>" .$p->name. "</a>
                                                    }
                                            echo    '<div class="swiper-button-next"></div>
                                                     <div class="swiper-button-prev"></div>
                                                </div>
                                            </div>
                                        </div>';
                            }
                        }
//--------------------------------------------------------
//                            SI SERIE :
//----------------------------------------------------------                                 
                        else if($type == "serie"){
                            for($i = $searchKeywordsMovie->page; $i < $searchKeywordsMovie->total_pages;$i++){
                                echo '<div class="container">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">';
                                                    $page = $i;
                                                    include("../api/api/search.php");

                                                    foreach($searchKeywordsSerie->results as $p){
                                                        if (!empty($p->poster_path)) {
                                                echo    "<div class='swiper-slide' id='first-swiper' style='text-align: center;'>
                                                            <a href='../MoviesPreview/serie.php?id=".$p->id."'>
                                                                <img src='".$imgurl_300 . $p->poster_path . "'>
                                                            </a> 
                                                        </div>";  
                                                        }
                                                    // Pour afficher tutre des série à la ligne
                                                    // <br><a href='../MoviesPreview/serie.php?id=".$p->id."'>" .$p->name. "</a>
                                                    }
                                                echo    '<div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }?>
          
            </div> 
        <?php }?>

    </body> 
<!-----------------------------------------------------------------------
                     FOOTER
------------------------------------------------------------------------->
    <footer>
        <div class="footer_div">
            <img class="logo_bottom" src="/images/logo.svg" alt="logo"> 
        </div>
        <div>
            <img class="logo_resp_bottom" src="/images/logo_planete_resp.svg" alt="logo">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./search_page.js"></script>
<script src="./js_comment.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="https://malsup.github.io/jquery.form.js"></script> 
</html>
