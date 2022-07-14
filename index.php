<?php
include "api/info.php";
// {"id":878,"name":"Science Fiction"} -> Pour séléctionner film SF

$json = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=$key&with_genres=878"); // URL reprenant film SF
$result = json_decode($json, true);



function moviesRecommandation($id,$number) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id/recommendations?api_key=01a554c3e281298e66a0ccb62492152f&language=en-US&total_results=$number"); // URL reprenant film SF
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response5 = curl_exec($ct);
    curl_close($ct);
    $recommandation = json_decode($response5);

    foreach($recommandation->results as $p){
        echo $p->original_title . " (" . substr($p->release_date, 0, 4) ."), ";
               
      }

}

echo "<h1>M O V I E S </h1>";


// On affiche les films les mieux notés.
include "api/toprated.php"; // On va chercher les infos

echo "<h2>Top rated SF movies</h2><div style='display: flex;'>";
foreach($toprated->results as $p){
    echo '<div class="column" style="width:200px; margin:5px;">
            <a href="film.php?id='.$p->id.'"><img src="'.$imgurl_1.''. $p->poster_path . '" width="150" height="225"" ></a>
            <div class="row" style="text-align:center;"><h4>'. $p->title . " (" . substr($p->release_date, 0, 4) .")</h4></div>"
            ."<div class='row' style='text-align:center;'><b>Rate : </b>" . $p->vote_average . "/10<br></div>
               
            </div>";
           
  }
echo "</div>";

// On affiche la première page des films de SF (20 / pages)
include "api/sf.php";

echo "<h2>SF movies</h2><div style='display: flex;'>";
foreach($sf->results as $p){
    echo '<div class="column" style="width:200px; margin:5px;">
            <div class="row" style="text-align:center;">
            <a href="film.php?id='.$p->id.'"><img src="'.$imgurl_1.''. $p->poster_path . '" width="150" height="225"" ></a>
            <h4>'. $p->title . " (" . substr($p->release_date, 0, 4) .")</h4>"
            ."<b>Rate : </b>" . $p->vote_average . "/10<br>
               </div>
            </div>";
           
  }
echo "</div>";

echo "<h1>S E R I E S </h1>";

// TOPRATED SERIES
include "api/topseries.php"; 

echo "<h2>Top rated SF series</h2><div style='display: flex;'>";
foreach($topseries->results as $p){
    echo '<div class="column" style="width:200px; margin:5px;">
            <div class="row" style="text-align:center;">
            <a href="film.php?id='.$p->id.'"><img src="'.$imgurl_1.''. $p->poster_path . '" width="150" height="225" ></a>
            <h4>'. $p->name . " (" . substr($p->first_air_date, 0, 4) .")</h4>"
            ."<b>Rate : </b>" . $p->vote_average . "/10<br>
               </div>
            </div>";
           
  }
echo "</div>";

// FIRST PAGE (20 EL) - SF & FANTASY SERIES 
include "api/series.php";

echo "<h2>SF & Fantasy series</h2><div style='display: flex;'>";
foreach($series->results as $p){
    echo '<div class="column" style="width:200px; margin:5px;">
            <div class="row" style="text-align:center;">
            <a href="film.php?id='.$p->id.'"><img src="'.$imgurl_1.''. $p->poster_path . '" width="150" height="225" ></a>
            <h4>'. $p->name . " (" . substr($p->first_air_date, 0, 4) .")</h4>"
            ."<b>Rate : </b>" . $p->vote_average . "/10<br> 
               </div>
            </div>";
           
  }
echo "</div>";


// ."<b>Recommandation : </b>".moviesRecommandation($p->id, 3)." 

// Output:
// <img src="https://image.tmdb.org/t/p/w500/adw6Lq9FiC9zjYEpOqfq03ituwp.jpg">