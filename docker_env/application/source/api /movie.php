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
else if(isset($infoMovie->poster_path)){
    echo "<div  style='overflow: hidden; height:500px; '><img src='".$imgurl . $infoMovie->poster_path ."' width='100%'  ></div><br>";
}
else if(isset($infoMovie->backdrop_path)){
    echo "<div  style='overflow: hidden; height:500px; '><img src='".$imgurl . $infoMovie->backdrop_path ."' width='100%'  ></div><br>";
}
else{
    echo "/ ! \ Movie not available for the moment, please come back later. / ! \ ";
}
echo    '<p><b>Original name: </b>'.$infoMovie->original_title.'</p>';
echo    '<b>Abstract: </b>'.$infoMovie->overview.'</p>';
echo    '</p><p><b>Release date: </b>'.$infoMovie->release_date.' | <b>Rating: </b>'.$infoMovie->vote_average.'</p>';
echo    '<p><b>Genre: </b><ul>';
        foreach($infoMovie->genres as $i){
            echo '<li>'. $i->name.' </li>';
        }
echo    '</ul>';


//-----------------------------------------------------
// MOVIES RECOMMANDATIONS
//-----------------------------------------------------

if (!empty($moviesRecommandations)) {
    echo    "<h2>You are going to like :</h2>
            <div style='display: flex;'>";
            
    foreach($moviesRecommandations->results as $p){
        echo '<div class="column" style="width:200px; margin:5px;">
                <div class="row">
                    <a href="movie.php?id='.$p->id.'"style="text-align:center;"><img src="'.$imgurl_500.''. $p->poster_path . '" width="200px height="300px"  ></a>
                </div>
            </div>';
               
    }
    echo    "</div>";
}

