<?php
// API - INFORMATION/DETAILS DES EPISODES DES SERIES EN FONCTION DE L'ID 

if(isset($id, $season)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/$id/season/$season?api_key=$key&language=en-US"); 
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $episodeInfo = json_decode($response);
}

if(isset($id, $season, $ep)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/$id/season/$season/episode/$ep?api_key=$key&language=en-US&append_to_response=videos"); 
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $episodeDetails = json_decode($response);
}
