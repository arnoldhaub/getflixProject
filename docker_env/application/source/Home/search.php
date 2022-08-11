<?php
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
        <link href="styles/styles_home.css" rel="stylesheet">
    </head>


    <body>
        
    <?php   
    include('header.php');
    ?>

        <div class="container_content">
            <div class="jumbotron"></div>
        </div>

        <!-- <div class="container_content2">
        <h4>Nouveau sur NovaFlix</h4>
            <ul class="ListBox">
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
                <li class="box1"></li>
            </ul>
        -->

        <!-- ======================================================================
                                    RECHERCHE
        //======================================================================-->
        <div class="container-content">
            <p>Search</p>
            <form name="fo" method="get" action="" style="width: 50%; text-align:center; margin: auto;" class="justify-content-center text-center" >
                <p>
                    <input type="text" name="keywords" pattern=".{3,}"   oninvalid="this.setCustomValidity('Field must contain min. 3 characters')" value="<?php echo str_replace('%20',' ',$keywords)?>" placeholder="What are you searching for ?" style="width: 100%; height: 40px; color:darkgrey; text-align:center;"/><br>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block mt-3" />
                </p>
                <p> 
                
                    
                    <input type="radio" class="btn-check" name="type" value="movie" id="movie" autocomplete="off" required <?php if(@$type == "movie"){echo "checked";} ?> >
                    <label class="btn btn-secondary" for="movie">Movie</label>

                    <input type="radio" class="btn-check" name="type" value="serie" id="serie" autocomplete="off" <?php if(@$type == "serie"){echo "checked";} ?>>
                    <label class="btn btn-secondary" for="serie">Serie</label>
                
                </p>
            </form>

            <?php if(@$searchResult==true) { ?>
                <div id="resultats">
                    <p id="nbr"><?=@$count." ".($count > 1 ? "results found":"No result, try again.") ?></p>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <?php 
                                    if($type == "movie"){
                                        for($i = $searchKeywordsMovie->page; $i < $searchKeywordsMovie->total_pages;$i++){
                                            $page = $i;
                                            include("../api/api/search.php");
                                            foreach($searchKeywordsMovie->results as $p){
                                                if (!empty($p->poster_path)) {
                                                    
                                                    echo    "<div class='swiper-slide' style='text-align: center;'>
                                                                <a href='movie.php?id=".$p->id."'>
                                                                    <img src='".$imgurl_300 . $p->poster_path . "'>
                                                                </a>";
                                                    echo    "   <br>
                                                                <a href='movie.php?id=".$p->id."'>" .$p->title. "</a>
                                                            </div>";
                                                }
                                                
                                            }
                                        }
                                        // Avec titre et description de 200 charactères.
                                        // foreach($searchKeywordsMovie->results as $p){
                                        //     echo    "<li><a href='movie.php?id=".$p->id."'>" .$p->title. "</a> | <br>".substr($p->overview, 0,200 );
                                        //     if(strlen($p->overview) > 200)
                                        //         { echo '(...)';}
                                        //     echo    "</li>";  
                                        // }
                                    }
                                    
                                    else if($type == "serie"){
                                        for($i = $searchKeywordsMovie->page; $i < $searchKeywordsMovie->total_pages;$i++){
                                            $page = $i;
                                            include("../api/api/search.php");
                                            foreach($searchKeywordsSerie->results as $p){
                                                if (!empty($p->poster_path)) {
                                                    echo    "<div class='swiper-slide' style='text-align: center;'>
                                                                <a href='serie.php?id=".$p->id."'>
                                                                    <img src='".$imgurl_300 . $p->poster_path . "'>
                                                                </a>";
                                                    echo    "   <br>
                                                                <a href='serie.php?id=".$p->id."'>" .$p->name. "</a>
                                                            </div>";  
                                                }
                                                
                                            }
                                    }
                                }

            
                                ?>
                            </div>
                        </div>
                </div> 
            <?php }?>
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
        <script src="./script.js"></script>
    </body>
</html>