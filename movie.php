<?php

//======================================================================
// SECURITY - ID VERIFICATION // BACK TO INDEX.PHP
//======================================================================

if (empty($_GET['id'])) {
    header("location: index.php");
}


//======================================================================
// FETCH ALL INFORMATION FROM THE API && PUT ID IN VARIABLE
//======================================================================

$id = $_GET['id'];
include "api/info.php";


//-----------------------------------------------------
// DISPLAY MOVIE'S INFORMATIONS
//-----------------------------------------------------

echo    "<h1>".$infoMovie->title."</h1>";
if(isset($infoMovie->videos->results[0]->key)){
    echo    '<iframe id="ytplayer" type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/' 
            .$infoMovie->videos->results[0]->key. '"?autoplay=1&loop=1&modestbranding=1" frameborder="0" allowfullscreen></iframe>';
}
else{
    echo "/ ! \ Movie not available for the moment, please come back later. / ! \ ";
}
// echo    '<img src="https://image.tmdb.org/t/p/original/'.$infoMovie->belongs_to_collection->backdrop_path.'"><br>';
echo    '<p><b>Original name: </b>'.$infoMovie->original_title.'</p>';
echo    '<p><b>Genre: </b>';
        foreach($infoMovie->genres as $i){
            echo $i->name.', ';
        }
echo    '</p><p><b>Release date: </b>'.$infoMovie->release_date.' | <b>Rating: </b>'.$infoMovie->vote_average.'</p>';
echo    '<b>Abstract: </b>'.$infoMovie->overview.'</p>';



//-----------------------------------------------------
// MOVIES RECOMMANDATIONS
//-----------------------------------------------------

if (!empty($recommandations)) {
    echo    "<h2>You are going to like :</h2>
            <div style='display: flex;'>";
            
    foreach($recommandations->results as $p){
        echo '<div class="column" style="width:200px; margin:5px;">
                <div class="row">
                    <a href="movie.php?id='.$p->id.'"style="text-align:center;"><img src="'.$imgurl_500.''. $p->poster_path . '" width="200px"  ></a>
                    <p style="padding:10px;"><b>'. $p->title ."</b><br>"
                    ."<b>Rate : </b>" . $p->vote_average . "/10</p>
                </div>
            </div>";
               
    }
    echo    "</div>";
}

