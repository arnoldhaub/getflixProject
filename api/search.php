<?php

// API - Recherche de film
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/search/movie?api_key=$key&query=$keywords&page=$page"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$searchKeywordsMovie = json_decode($response);

// API - Recherche de serie
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/search/tv?api_key=$key&query=$keywords&page=$page"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$searchKeywordsSerie = json_decode($response);


/*-----------------             FOR KIDS            -----------------*/


// movies
$ct = curl_init(); 
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/search/movie?api_key=$key&query=$keywords&page=$page"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$searchKeywordsMovieKids = json_decode($response);

// series
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/search/tv?api_key=$key&query=$keywords&page=$page"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$searchKeywordsSerieKids = json_decode($response);