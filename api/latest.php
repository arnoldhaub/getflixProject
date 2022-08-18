<?php

// API - Dernier film
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/now_playing?api_key=$key&language=en-US&with_genres=878"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$latestMovie = json_decode($response);

// API - Dernière série
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/latest?api_key=$key"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$latestSerie = json_decode($response);
