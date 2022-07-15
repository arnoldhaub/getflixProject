<!-- API - LISTE DES FILMS DE SCIENCE-FICTION - GENRE = 878 -->

<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=$key&language=en-US&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$movies = json_decode($response);
