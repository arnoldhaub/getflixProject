<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/top_rated?api_key=$key&language=en-US&page=1&with_genres=878");
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response5 = curl_exec($ct);
curl_close($ct);
$toprated = json_decode($response5);

