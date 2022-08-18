<?php

// API - LISTE DES RECOMMANDATIONS DE FILMS EN FONCTION DE $ID
if(isset($id)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/tv/$id/recommendations?api_key=$key&language=en-US&page=1");
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $seriesRecommandations = json_decode($response);
}

