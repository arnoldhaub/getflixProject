<?php

// Si pas d'ID, retour à l'accueil
if (empty($_GET['id'])) {
    header("location: index.php");
}
$id = $_GET['id'];
include "api/info.php"; // Info db
include "api/movie_info.php"; // On va chercher les infos
echo '<iframe id="video" src="www.youtube.com/embed/' .$infoMovie->videos->results[0]->key. '?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>';
