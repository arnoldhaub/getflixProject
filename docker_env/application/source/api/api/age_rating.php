<?php
// API - INFORMATION SUR AGE MIN POUR FILM/SERIE

if(isset($id, $key)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id/release_dates?api_key=$key"); 
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $filmAgeRating = json_decode($response);
}

if(isset($id, $key)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/$id/content_ratings?api_key=$key"); 
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $serieAgeRating = json_decode($response, true);
}
