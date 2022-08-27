<?php
    $id_pseudo = htmlspecialchars($_GET['id_pseudo']);
    $id_film = htmlspecialchars($_GET['id_film']);
    $type = htmlspecialchars($_GET['type']);
    $action = htmlspecialchars($_GET['action']);
    


    if (isset($_GET['type'])) {
        include('connect.php');

        // POUR LES FILMS 
        if($_GET['type'] == "movie"){

            // AJOUTER UN FILM DANS LA LISTE
            if($_GET['action'] == "add"){

                $req = $db->prepare("INSERT INTO `listing` ( id_pseudo, id_film, type) VALUES (?,?,?)");
                $req->execute(array($id_pseudo, $id_film, $type));

                if ($req) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    echo "Failed to add the movie to your listing.";
                }
            }

            // SUPPRIMER UN FILM DE LA LISTE
            if($_GET['action'] == "remove"){

                $removeFromListing = $db->query("DELETE FROM `listing` WHERE id_pseudo=$id_pseudo AND id_film=$id_film");

                if ($removeFromListing) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    echo "Failed to remove the movie to your listing.";
                }
            }

        }
    }


    // POUR LES S E R I E S 
    if($_GET['type'] == "serie"){

        // AJOUTER UNE SERIE DANS LA LISTE
        if($_GET['action'] == "add"){

            $req = $db->prepare("INSERT INTO `listing` ( id_pseudo, id_film, type) VALUES (?,?,?)");
            $req->execute(array($id_pseudo, $id_film, $type));

            if ($req) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Failed to add the serie to your listing.";
            }
        }

        // SUPPRIMER UNE SERIE DE LA LISTE
        if($_GET['action'] == "remove"){

            $removeFromListing = $db->query("DELETE FROM `listing` WHERE id_pseudo=$id_pseudo AND id_film=$id_film");

            if ($removeFromListing) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Failed to remove the serie to your listing.";
            }
        }

    }


    ?>