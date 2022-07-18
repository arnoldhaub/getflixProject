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
$season = $_GET['season'];
$ep = $_GET['ep'];
include "api/info.php";
include "api/episodeInfo.php";


//-----------------------------------------------------
// DISPLAY MOVIE'S INFORMATIONS
//-----------------------------------------------------

echo    "<h1>".$episodeDetails->name."</h1>";
if(isset($episodeDetails->videos->results[0]->key)){
    echo    '<iframe id="ytplayer" type="text/html" width="100%" height="500px" src="https://www.youtube.com/embed/' 
            .$episodeDetails->videos->results[0]->key. '"?autoplay=1&loop=1&modestbranding=1" frameborder="0" allowfullscreen></iframe>';
}
else if(isset($episodeDetails->still_path)){
    echo "<div  style='overflow: hidden; height:500px; '><img src='".$imgurl . $episodeDetails->still_path ."' width='100%'  ></div><br>";
}
// echo    '<img src="https://image.tmdb.org/t/p/original/'.$episodeDetails->belongs_to_collection->backdrop_path.'"><br>';
echo    '<p><b>Abstract: </b>'.$episodeDetails->overview.'</p>';
echo    '<p><b>Release date: </b>'.$episodeDetails->air_date.' | <b>Rating: </b>'.$episodeDetails->vote_average.'</p>';
echo    '<p><b>Crew: </b>';
        foreach($episodeDetails->crew as $i){
            echo $i->name.' | '. $i->job. ' | '. $i->department. '<br>';
        }





//-----------------------------------------------------
// OTHER EPISODES
//-----------------------------------------------------

if (!empty($infoSerie->seasons)) {
    foreach($infoSerie->seasons as $p){
        $season = $p->season_number;
        echo    "<h2>".$p->name.":</h2>
                <div style='display: flex;'>";
         
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
    echo    "</div>";
    }
}