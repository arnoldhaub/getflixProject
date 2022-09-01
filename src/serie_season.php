
<!-- DROPDOWN - SELECTION DE LA SAISON -->
<?php
            if (!empty($infoSerie->seasons)) { ?>
                <div class="dropdown" style="margin-left: 4vh;">
                    <button class="btn dropdown-toggle play" type="button" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                            Which season?
                    </button>
                    
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"><?php 
                foreach($infoSerie->seasons as $p){
                    if($p->episode_count > 0){
                        echo    '<li <?php if(@$type == "serie"){echo "checked";}><a class="dropdown-item" href="serie.php?id='. $id .'&page='.$p->season_number. '" value="'.$p->season_number.'">'.$p->name.'</a></li>';
                    }
                }
                echo        '</ul>
                        </div>';

                        // SI SAISON SELECTIONNÉ, AFFICHER LES ÉPISODES
                if(isset($page)){
                    if($page == 0){$season = 1;}
                    else{$season = $page;}
                    echo    '<div class="container_serie">
                                    <div class="container">
                                        <p class="title_slide">'.$infoSerie->seasons[$page-1]->name.'</p>
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">';
                                            include "api/episodeInfo.php"; 
                                            foreach($episodeInfo->episodes as $i){
                                                $ep = $i->episode_number;
                                                include "api/episodeInfo.php";
                                                echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                                                if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                                                    echo                '<a class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-target="#myModal">';
                                                }
                                                else{ // Sinon afficher celle de la série
                                                    echo                '<a class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-target="#myModal">';
                                                }
                                                // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                                                    echo                    '<img src="';if($i->still_path != null){ echo $imgurl_500 . $i->still_path;} else{echo "images/picturetocome.png";}
                                                    echo                        '" style="object-fit: cover;"></a>
                                                                        <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>
                        
                                                                    </div>';
                                            }
                                            echo                    '<div class="swiper-button-next"></div>
                                                                    <div class="swiper-button-prev"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                                    
                                    


                }
            }
        




                // foreach($infoSerie->seasons as $p){
                //     if($p->episode_count > 0){
                //         $season = $p->season_number;
                //         echo    '<div class="container_movie">
                //                     <div class="container">
                //                         <p class="title_slide">'.$p->name.'</p>
                //                         <div class="swiper-container">
                //                             <div class="swiper-wrapper">';
                        
                //         include "api/episodeInfo.php"; 
                //         foreach($episodeInfo->episodes as $i){
                //             $ep = $i->episode_number;
                //             include "api/episodeInfo.php";
                //             echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                //             if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                //                 echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-bs-target="#myModal">';
                //             }
                //             else{ // Sinon afficher celle de la série
                //                 echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-bs-target="#myModal">';
                //             }
                //             // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                //                 echo                    '<img src="' . $imgurl_500 . $i->still_path . '" style="object-fit: cover;"></a>
                //                                     <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>
    
                //                                 </div>';
                //         }
                //         echo                    '<div class="swiper-button-next"></div>
                //                                 <div class="swiper-button-prev"></div>
                //                             </div>
                //                         </div>
                //                     </div>
                //                 </div>';
                                
                //         }
                //     }
                
                // }
                
            ?>


        <!-- if (!empty($infoSerie->seasons)) {
            foreach($infoSerie->seasons as $p){
                if($p->episode_count > 0){
                    $season = $p->season_number;
                    echo    '<div class="container_movie">
                                <div class="container">
                                    <p class="title_slide">'.$p->name.'</p>
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">';
                    
                    include "api/episodeInfo.php"; 
                    foreach($episodeInfo->episodes as $i){
                        $ep = $i->episode_number;
                        include "api/episodeInfo.php";
                        echo                '<div class="swiper-slide" id="first-swiper" style="text-align:center;">';
                        if(!empty($episodeDetails->videos->results[0])){ // Si vidéo répertoriée, afficher
                            echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$episodeDetails->videos->results[0]->key.'" data-bs-target="#myModal">';
                        }
                        else{ // Sinon afficher celle de la série
                            echo                '<a class="video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/'.$infoSerie->videos->results[0]->key.'"  data-bs-target="#myModal">';
                        }
                        // '<a href="episode.php?id='.$id.'&season='.$i->season_number. '&ep='.$i->episode_number.'">
                            echo                    '<img src="' . $imgurl_500 . $i->still_path . '" style="object-fit: cover;"></a>
                                                <p><b>Episode '.$i->episode_number.' -</b> '. $i->name .'</p><hr><p>'.$episodeDetails->overview.'</p>

                                            </div>';
                    }
                    echo                    '<div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            
                    }
                }
            
            }
        ?> -->