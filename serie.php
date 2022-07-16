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
// DISPLAY SERIE'S INFORMATIONS
//-----------------------------------------------------

echo    "<h1>".$infoSerie->name."</h1>";
if(isset($infoSerie->videos->results[0]->key)){
    echo    '<iframe id="ytplayer" type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/' 
            .$infoSerie->videos->results[0]->key. '"?autoplay=1&loop=1&modestbranding=1" frameborder="0" allowfullscreen></iframe>';
}
else if(isset($infoSerie->poster_path)){
    echo "<div  style='overflow: hidden; height:500px; '><img src='".$imgurl . $infoSerie->poster_path ."' width='100%'  ></div><br>";
}
else{
    echo "/ ! \ Movie not available for the moment, please come back later. / ! \ ";
}

echo    '<p><b>Original name: </b>'.$infoSerie->original_name.'</p>';
echo    '<b>Abstract: </b>'.$infoSerie->overview.'</p>';
echo    '</p><b>Rating: </b>'.$infoSerie->vote_average.' | <b>Release date: </b>'.$infoSerie->first_air_date;
echo    '</p><p><b>Release date: </b>'.$infoSerie->first_air_date.' | <b>Rating: </b>'.$infoSerie->vote_average.'</p>';
echo    '<p><b>Seasons:</b> '.$infoSerie->number_of_seasons. ' | <b>Episodes: </b>' .$infoSerie->number_of_episodes.'</p>';
echo    '<p><b>Genre: </b><ul>';
        foreach($infoSerie->genres as $i){
            echo '<li>'. $i->name.' </li>';
        }
echo    '</ul>';




//-----------------------------------------------------
// DISPLAY SEASONS + EPISODE
//-----------------------------------------------------

if (!empty($infoSerie->seasons)) {
    foreach($infoSerie->seasons as $p){
        $season = $p->season_number;
        echo    "<hr style='margin-top:40px;border-top: 1px dashed red;'><h2>".$p->name."</h2>
                <div style='display: flex;'>";
        include "api/episodeInfo.php"; 
        foreach($episodeInfo->episodes as $i){
            echo '<div class="column" style="width:200px; margin:5px;">
                    <div class="row">
                        <a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'"style="text-align:center;"><img src="';
            echo        $i->still_path == null ? "picturetocome.png" : $imgurl_500 . $i->still_path; 
            echo        '" width="200px" height="110px"></a>
                        <p><b>Episode '.$i->episode_number.' -</b> '. $i->name ."<br>";
            // echo        $i->vote_average == 0 ? "<b>Rate: </b>-" : "<b>Rate : </b>".$i->vote_average ."/10</p>";
                    
            echo    "</div>
                </div>";
                
        }
    echo    "</div><hr style='border-top: 1px dashed red;'>";
    }
}


//-----------------------------------------------------
// SERIES RECOMMANDATIONS
//-----------------------------------------------------

if (!empty($seriesRecommandations)) {
    echo    "<h2>You are going to like :</h2>
            <div style='display: flex;'>";
            
    foreach($seriesRecommandations->results as $p){
        echo '<div class="column" style="width:200px; margin:5px;">
                <div class="row">
                    <a href="serie.php?id='.$p->id.'"style="text-align:center;"><img src="'.$imgurl_500.''. $p->poster_path . '" width="200px"  ></a>
                   
                </div>
            </div>';
               
    }
    echo    "</div>";
}

