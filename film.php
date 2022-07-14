<?php

// Si pas d'ID, retour à l'accueil
if (empty($_GET['id'])) {
    header("location: index.php");
}
// Sinon, ID dans une variable
$id = $_GET['id'];
include "api/info.php"; // Info db


// On affiche les films les mieux notés.
include "api/movie_info.php"; // On va chercher les infos
echo "<h1>".$infoMovie->title."</h1>";


echo    '<img src="https://image.tmdb.org/t/p/original/'.$infoMovie->belongs_to_collection->backdrop_path.'"><br>';
echo    '<p><b>Original name: </b>'.$infoMovie->original_title.'</p>';
echo    '<p><b>Genre: </b>';
        foreach($infoMovie->genres as $i){
            echo $i->name.', ';
        }
echo    '</p><p><b>Release date: </b>'.$infoMovie->release_date.' | <b>Rating: </b>'.$infoMovie->vote_average.'</p>';
echo    '<b>Abstract: </b>'.$infoMovie->overview.'</p>';
echo    '<a href="https://www.youtube.com/watch?v='.$infoMovie->videos->results[0]->key.'">Watch trailer</a>';


// PARTIE RECOMMANDATION

include "api/recommandations.php";
if (!empty($recommandations)) {
    echo    "<h2>You are going to like :</h2>
            <div style='display: flex;'>";
    foreach($recommandations->results as $p){
        echo '<div class="column" style="width:200px; margin:5px;">
        <div class="row">
                    <a href="film.php?id='.$p->id.'"style="text-align:center;"><img src="'.$imgurl_1.''. $p->poster_path . '" width="200px"  ></a>
                    <p style="padding:10px;"><b>'. $p->title ."</b><br>"
                    ."<b>Rate : </b>" . $p->vote_average . "/10</p>
                
            </div></div>";
               
    }
    echo    "</div>";
}