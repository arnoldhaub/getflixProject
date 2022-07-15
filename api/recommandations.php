<!-- API - LISTE DES RECOMMANDATIONS DE FILMS EN FONCTION DE $ID-->

<?php

// On vérifie qu'un ID est bien défini.
if(isset($id)) {
    $ct = curl_init();
    curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/movie/$id/recommendations?api_key=$key&language=en-US&page=1");
    curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ct, CURLOPT_HEADER, FALSE);
    curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    $response = curl_exec($ct);
    curl_close($ct);
    $recommandations = json_decode($response);
}

