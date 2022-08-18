<?php

// API - LISTE DES SERIES DE SCIENCE-FICTION - GENRE = 10765
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "http://api.themoviedb.org/3/tv/on_the_air?api_key=$key&language=en-US&with_genre=10765"); // URL reprenant séries Sci-Fi & Fantasy
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$series = json_decode($response);

// DERNIER FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/discover/tv?api_key=$key&language=en-US&sort_by=first_air_date.desc&with_genres=10765&with_original_language=en&watch_region=us"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$seriesLatest = json_decode($response);

// TOP-RATED FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/top_rated?api_key=$key&with_genres=10765"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$seriesTopRated = json_decode($response);

// POPULAR FILMS SCIENCE-FICTION
$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/popular?api_key=$key&with_genre=10765"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$seriesPopular = json_decode($response);

