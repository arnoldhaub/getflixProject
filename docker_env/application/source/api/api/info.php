<?php

$key = "01a554c3e281298e66a0ccb62492152f"; // Key unique  du compte TMDB

$imgurl = "http://image.tmdb.org/t/p/original/";         // Image des films - taille original.
$imgurl_500 = "http://image.tmdb.org/t/p/w500/"; // Image des films 500px
$imgurl_300 = "http://image.tmdb.org/t/p/w300/"; // Image des films 300px



include "../api/api/movies.php"; 
include "../api/api/series.php"; 

include "../api/api/topMovies.php"; 
// include "../api/api/topSeries.php"; 

include "../api/api/moviesRecommandations.php"; 
include "../api/api/seriesRecommandations.php"; 

include "../api/api/movie_info.php"; 
include "../api/api/serie_info.php"; 

include "../api/api/latest.php"; 





// include "api/movies.php"; 
// include "api/series.php"; 

// include "api/topMovies.php"; 
// include "api/topSeries.php"; 

// include "api/moviesRecommandations.php"; 
// include "api/seriesRecommandations.php"; 

// include "api/movie_info.php"; 
// include "api/serie_info.php"; 


