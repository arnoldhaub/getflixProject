<!-- API - LISTE DES SERIES LES MIEUX NOTÉS DE SCIENCE-FICTION -->

<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "http://api.themoviedb.org/3/tv/top_rated?api_key=$key&language=en-US&with_genres=10765"); 
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response = curl_exec($ct);
curl_close($ct);
$topSeries = json_decode($response);

