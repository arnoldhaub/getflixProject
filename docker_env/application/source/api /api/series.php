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

