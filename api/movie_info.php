<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id?api_key=$key&language=en-US&append_to_response=videos"); // URL reprenant séries Sci-Fi & Fantasy
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response5 = curl_exec($ct);
curl_close($ct);
$infoMovie = json_decode($response5);

// http://api.themoviedb.org/3/movie/157336?api_key=01a554c3e281298e66a0ccb62492152f&append_to_response=videos