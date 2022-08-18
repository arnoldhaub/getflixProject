<?php

// API - INFORMATION/DETAILS DES FILMS EN FONCTION DE L'ID
if(isset($id)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id?api_key=$key&language=en-US&append_to_response=videos"); 
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $infoMovie = json_decode($response);
}