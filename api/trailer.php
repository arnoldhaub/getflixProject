<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id/videos?api_key=$key&language=en-US"); // URL reprenant les trailers
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response5 = curl_exec($ct);
curl_close($ct);
$trailer = json_decode($response5);