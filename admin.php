<?php
// On prolonge la session
session_start();
$userEmail = $_SESSION['email'];

if ($_GET['id_pseudo']) {
    $_SESSION['pseudo'] = $_GET['id_pseudo'];
}

// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['email'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: index.php');
    exit();
}
else{
    // FECTH data from DATABASE
    require('src/connect.php');
    $profilesDB = $db->query('SELECT * FROM profile  order by email asc');
    $usersDB = $db->query('SELECT * FROM user');
    $commentsDB = $db->query('SELECT * FROM comments');

    // SI ENFANT => Go to home_kids.php
    // if($KidOrNot["categorie"] == "enfant"){
    //     header('Location: home_kids.php');
    //     exit();
    // }

}
include "api/info.php";
?>

<!DOCTYPE html>
<head>
    <title>NOVA · Administration</title>
    <?php include "src/head_meta_tags.php"; ?>
    <link href="styles/styles_home.css" rel="stylesheet">
</head>
<body>

    <!-----------------------------------------------------------------------
                     HEADER + MENU
------------------------------------------------------------------------->
    <?php
    include('src/header.php');
    ?>

    <!-----------------------------------------------------------------------
                     WEBSITE
------------------------------------------------------------------------->
    <div class="container_page">
        <h1>WEBSITE - Administration</h1>
    


<!-- ======================================================================
                                    Users - Administration
        //======================================================================-->
    <div id="usersAdmin">
        <h2>Users' administration</h2>
        <table class="table table-striped my-3 text-center align-items-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Éditer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody">
                    <?php while($user = $usersDB->fetch()) {?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?></th>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <i class="fa fa-edit fa-2x" 
                            data-toggle="modal" 
                            data-target="#edit<?php echo $user['id']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="edit<?php echo $user['id']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <form role="form" method="POST" action="admin/edit.php">
                                                    <div class="form-group">
                                                        <label for="userID" class="col-form-label">User ID</label>
                                                        <input type="number" class="form-control text-center" name="userID" id="userID" value="<?php echo $user['id'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userMail" class="col-form-label">User Mail</label>
                                                        <input data-error="Address not correct" data-success="Perfect!"type="email" class="form-control validate text-center" name="userMail" id="userMail" value="<?php echo $user['email']; ?>">
                                                    </div>
                                                    <input type="hidden" id="dbName" name="dbName" value="user">
                                                    <input type="hidden" id="userOriginalID" name="userOriginalID" value="<?php echo $user['id'];?>">
                                                
                                                    <div class="modal-footer justify-content-center ">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            
                        </td>
                        <td>
                            <i class="fa fa-trash fa-2x text-danger" 
                            data-toggle="modal" 
                            data-target="#exampleModal<?php echo $user['id']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="exampleModal<?php echo $user['id']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <p>Êtes-vous sûr de vouloir supprimer l'<strong>ID <?php echo $user['id'];?></strong> ? </p>
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <a href="admin/delete.php?id=<?php echo $user['id']; ?>&db=user">
                                                    <button class="btn btn-danger" type="button">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
                <tfoot>
                    <th class="text-center" colspan="100%">Add an user</th>
                </tfoot>
            </table>
    </div>

<!-- ======================================================================
                                    Profiles - Administration
        //======================================================================-->
        <div id="profilesAdmin">
        <h2>Profiles' administration</h2>
        <table class="table table-striped my-3 text-center align-items-center">
                <thead>
                    <tr>
                        <th>ID profil</th>
                        <th>Pseudo</th>
                        <th>Catégorie</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Éditer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody">
                    <?php while($profile = $profilesDB->fetch()) {?>
                    <tr>
                        <th scope="row"><?php echo $profile['id_pseudo']; ?></th>
                        <td><?php echo $profile['pseudo']; ?></td>
                        <td><?php echo $profile['categorie']; ?></td>
                        <td><?php echo $profile['email']; ?></td>
                        <td><?php echo $profile['image']; ?></td>
                        <td>
                            <i class="fa fa-edit fa-2x" 
                            data-toggle="modal" 
                            data-target="#edit<?php echo $profile['id_pseudo']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="edit<?php echo $profile['id_pseudo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <form role="form" method="POST" action="admin/edit.php">
                                                    <div class="form-group">
                                                        <label for="profileID" class="col-form-label">Profile ID</label>
                                                        <input type="number" class="form-control text-center" name="profileID" id="profileID" value="<?php echo $profile['id_pseudo'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="profilePseudo" class="col-form-label">Pseudo</label>
                                                        <input type="text" class="form-control text-center" name="profilePseudo" id="profilePseudo" value="<?php echo $profile['pseudo'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userMail" class="col-form-label">User Mail</label>
                                                        <input data-error="Address not correct" data-success="Perfect!"type="email" class="form-control validate text-center" name="userMail" id="userMail" value="<?php echo $profile['email']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="profileImage" class="col-form-label">Profile Image</label>
                                                        <input type="text" class="form-control text-center" name="profileImage" id="profileImage" value="<?php echo $profile['image'];?>">
                                                    </div>
                                                    <p>Catégorie</p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="categorie" id="categorie1" value="enfant" <?php if($profile['categorie'] == "enfant") echo "checked";?>>
                                                        <label class="form-check-label" for="categorie1">Enfant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="categorie" id="categorie2" value="adulte" <?php if($profile['categorie'] == "adulte") echo "checked";?>>
                                                        <label class="form-check-label" for="categorie2">Adulte</label>
                                                    </div>

                                                    <input type="hidden" id="dbName" name="dbName" value="profile">
                                                    <input type="hidden" id="profileOriginalID" name="profileOriginalID" value="<?php echo $profile['id_pseudo'];?>">
                                                    <input type="hidden" id="profileOriginalEmail" name="profileOriginalEmail" value="<?php echo $profile['email'];?>">

                                                
                                                    <div class="modal-footer justify-content-center ">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            
                        </td>
                        <td>
                            <i class="fa fa-trash fa-2x text-danger" 
                            data-toggle="modal" 
                            data-target="#exampleModal<?php echo $profile['id_pseudo']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="exampleModal<?php echo $profile['id_pseudo']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <p>Êtes-vous sûr de vouloir supprimer l'<strong>ID <?php echo $profile['id_pseudo'];?></strong> ? </p>
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <a href="admin/delete.php?id=<?php echo $profile['id_pseudo']; ?>&db=profile">
                                                    <button class="btn btn-danger" type="button">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
                <tfoot>
                    <th class="text-center" colspan="100%">Add a profile</th>
                </tfoot>
            </table>
    </div>

    <!-- ======================================================================
                                    MOVIES
        //======================================================================-->



        </div>
    <!-----------------------------------------------------------------------
                     FOOTER
------------------------------------------------------------------------->    
    <?php
    include "src/footer.php";
    ?>



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>