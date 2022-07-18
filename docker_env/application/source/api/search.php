<?php
include("api/info.php");
    // FORMULAIRE - Prise d'informations
    @$keywords=$_GET["keywords"];
    @$submit=$_GET["submit"];
    @$type=$_GET["type"];
    if(isset($submit) && !empty(trim($keywords))){
        
        include("api/search.php");

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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="./styles/styles.css" rel="stylesheet">
    </head>
    <body>
        <form name="fo" method="get" action="" >
            <p>
                <input type="text" name="keywords" pattern=".{3,}"   oninvalid="this.setCustomValidity('Field must contain min. 3 characters')" value="<?php echo $keywords?>" placeholder="Mots-clés" />
                <input type="submit" name="submit" />
            </p>
            <p> 
                <input type="radio" name="type" value="movie" required> Movie 
                <input type="radio" name="type" value="serie"> Serie 
            </p>
        </form>
        <?php if(@$searchResult==true) { ?>
            <div id="resultats">
                <div id ="nbr"><?=@$count." ".($count > 1 ? "résultats trouvés":"résultat trouvé") ?></div>
                <ol>
                    <?php 
                        if($type == "movie"){
                            foreach($searchKeywordsMovie->results as $p){
                                echo    " <li style='margin: 10px;'><a href='mmovie.php?id=".$p->id."'><img src='".$imgurl_300 . $p->poster_path . "' width='100' style='margin-right: 10px;'></a>";
                                echo    "<a href='movie.php?id=".$p->id."'>" .$p->title. "</a></li>";   
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
                            foreach($searchKeywordsSerie->results as $p){
                                echo    " <li style='margin: 10px;'><a href='serie.php?id=".$p->id."'><img src='".$imgurl_300 . $p->poster_path . "' width='100' style='margin-right: 10px;'></a>";
                                echo    "<a href='serie.php?id=".$p->id."'>" .$p->name. "</a></li>";  
                                
                            }
                            if($searchKeywordsSerie->page < $searchKeywordsSerie->total_pages) {
                                echo "see more";
                            }
                        }

  
                    ?>
                </ol>
            </div> 
        <?php }?>
            


    </body>
</html>



