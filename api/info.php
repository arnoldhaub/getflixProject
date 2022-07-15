<?php

$key = "01a554c3e281298e66a0ccb62492152f"; // Key unique  du compte TMDB

$imgurl = "http://image.tmdb.org/t/p/";         // Image des films - taille original.
$imgurl_500 = "http://image.tmdb.org/t/p/w500/"; // Image des films 500px
$imgurl_300 = "http://image.tmdb.org/t/p/w300/"; // Image des films 300px



include "api/movies.php"; // On va chercher les infos
include "api/series.php"; // On va chercher les infos
include "api/topMovies.php"; // On va chercher les infos
include "api/topSeries.php"; // On va chercher les infos
include "api/recommandations.php"; // On va chercher les infos

include "api/movie_info.php"; 