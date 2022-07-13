<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "http://api.themoviedb.org/3/tv/top_rated?api_key=$key&language=en-US&with_genres=10765"); // TOP séries Sci-Fi & Fantasy
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response5 = curl_exec($ct);
curl_close($ct);
$topseries = json_decode($response5);

