<?php

// API - LISTE DES FILMS DE SCIENCE-FICTION - GENRE = 878
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=$key&language=en-US&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$movies = json_decode($response);

// DERNIER FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/now_playing?api_key=$key&language=en-US&region=US&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$moviesLatest = json_decode($response);

// TOP-RATED FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/top_rated?api_key=$key&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$moviesTopRated = json_decode($response);

// POPULAR FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/popular?api_key=$key&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$moviesPopular = json_decode($response);




