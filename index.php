<?php

$key = "01a554c3e281298e66a0ccb62492152f"; // Key unique  du compte TMDB
// {"id":878,"name":"Science Fiction"} -> Pour séléctionner film SF

$json = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=$key&with_genres=878"); // URL reprenant film SF
$result = json_decode($json, true);

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=$key&with_genres=878"); // URL reprenant film SF
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE);
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$response5 = curl_exec($ct);
curl_close($ct);
$toprated = json_decode($response5);

$imgurl_1 = "http://image.tmdb.org/t/p/w500";
$imgurl_2 = "http://image.tmdb.org/t/p/w300";
foreach($toprated->results as $p){
    echo '<div class="column">
            <div class="row" style="text-align:center;">
            <a href="#"><img src="'.$imgurl_1.''. $p->poster_path . '" width="140" height="180" ></a><h4>' 
            . $p->original_title . " (" . substr($p->release_date, 0, 4) .")</h4>"
            ."<b>Rate : </b>" . $p->vote_average . "/10<br> 
            <b>Abstract : </b>" . $p->overview ." <br>"
            ."<b>Recommandation : </b>https://api.themoviedb.org/3/movie/$p->id/recommendations?api_key=01a554c3e281298e66a0ccb62492152f&language=en-US&page=1<br><br>
               </div>
            </div>";
           
  }



// Output:
// <img src="https://image.tmdb.org/t/p/w500/adw6Lq9FiC9zjYEpOqfq03ituwp.jpg">