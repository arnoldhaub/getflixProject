<?php
//======================================================================
// FETCH ALL INFORMATION FROM THE API
//======================================================================

include "api/info.php";


//======================================================================
// DISPLAY // MOVIES
//======================================================================

echo  "<h1>M O V I E S </h1>";


//-----------------------------------------------------
// TOP-RATED - MOVIES
//-----------------------------------------------------

echo  "<h2>Top rated</h2>"; // Titre de la section
echo  "<div style='display: flex;'>"; // Div reprenant tous les fims

foreach($topMovies->results as $p){ // Affichage des 20 meilleurs films
    echo  "<div class='column' style='width:300px; margin:1px;'>
              <a href='movie.php?id=".$p->id."'><img src='".$imgurl_500 . $p->poster_path . "' width='300' height='450' ></a>
              <div class='row' style='text-align:center;'><h4>". $p->title . " (" . substr($p->release_date, 0, 4) .")</h4></div>"
              ."<div class='row' style='text-align:center;'><b>Rate : </b>" . $p->vote_average . "/10</div> 
          </div>";       
  }

echo "</div>";


//-----------------------------------------------------
// SCIENCE-FICTION MOVIES // REGARDLESS OF THE RATING (20 MOVIES)
//-----------------------------------------------------

echo  "<h2>SF movies</h2>"; // Titre de la section
echo  "<div style='display: flex;'>"; // Div reprenant tous les fims

foreach($movies->results as $p){ // Affichage de chacun des films
    echo  "<div class='column' style='width:200px; margin:0 50px;'>
              <a href='movie.php?id=".$p->id."'><img src='".$imgurl_500 . $p->poster_path . "' width='200' height='300' ></a>
              <div class='row' style='text-align:center;'><h4>". $p->title . " (" . substr($p->release_date, 0, 4) .")</h4></div>"
              ."<div class='row' style='text-align:center;'><b>Rate : </b>" . $p->vote_average . "/10</div> 
          </div>";       
  }

echo "</div>";


//======================================================================
// DISPLAY // SERIES
//======================================================================

echo "<h1>S E R I E S </h1>";

//-----------------------------------------------------
// TOP-RATED - SERIES
//-----------------------------------------------------

echo "<h2>Top rated</h2><div style='display: flex;'>";
foreach($topSeries->results as $p){
    echo "<div class='column' style='width:300px; margin:1px;'>
            <a href='serie.php?id=".$p->id."'><img src='".$imgurl_500 . $p->poster_path . "' width='300' height='450' ></a>
            <div class='row' style='text-align:center;'><h4>". $p->name . " (" . substr($p->first_air_date, 0, 4) .")</h4></div>"
            ."<div class='row' style='text-align:center;'><b>Rate : </b>" . $p->vote_average . "/10</div>
          </div>";      
  }

echo "</div>";


//-----------------------------------------------------
// SF & FANTASY MOVIES // REGARDLESS OF THE RATING (20 MOVIES)
//-----------------------------------------------------


echo "<h2>SF & Fantasy series</h2><div style='display: flex;'>";
foreach($series->results as $p){
    echo "<div class='column' style='width:200px; margin:5px;'>
            <a href='serie.php?id=".$p->id."'><img src='".$imgurl_500 . $p->poster_path . "' width='150' height='225' ></a>
            <div class='row' style='text-align:center;'><h4>". $p->name . " (" . substr($p->first_air_date, 0, 4) .")</h4></div>"
            ."<div class='row' style='text-align:center;'><b>Rate : </b>" . $p->vote_average . "/10</div>
          </div>";      
  }

echo "</div>";