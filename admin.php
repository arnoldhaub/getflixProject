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
    // FECTH data || from DATABASE
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
    <link href="styles/styles_admin.css" rel="stylesheet">
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
    
<!-- ======================================================================
                                    MENU - Administration
        //======================================================================-->

        <div id="admin_menu" class="row  d-flex justify-content-around my-4">
            <div class="col text-center">
                <button type="button" class="play video-btn" id="usersAdminInterface"><i class="fa-solid fa-users fa-admin "></i><br>Users' administration</button>
            </div>
            <div class="col text-center">
                <button type="button" class="play video-btn" id="profilesAdminInterface"><i class="fa-solid fa-people-group fa-admin"></i><br>Profiles' administration</button>
            </div>
            <div class="col text-center">
                <button type="button" class="play video-btn" id="commentsAdminInterface"><i class="fa-solid fa-comments fa-admin"></i><br>Comments' administration</button>
            </div>
        </div>

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
                            <i class="fa fa-edit fa-xl text-warning" 
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
                            <i class="fa fa-trash fa-xl text-danger" 
                            data-toggle="modal" 
                            data-target="#deleteUser<?php echo $user['id']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="deleteUser<?php echo $user['id']; ?>" role="dialog">
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
                    <th class="text-center" colspan="100%">
                        <button type="button" class="add" id="addUserButton" data-toggle="modal"  data-target="#addUser"><i class="fa-solid fa-user-plus"></i> Add an user</button>
                            <div class="modal fade" id="addUser" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body bg-dark">
                                            <form role="form" method="POST" action="admin/add.php">
                                                <div class="form-group">
                                                    <label for="password" class="col-form-label">User Mail</label>
                                                    <input data-error="Address not correct" data-success="Perfect!"type="email" class="form-control validate text-center" name="userMail" id="userMail" placeholder="type an email here...">
                                                </div>
                                                <div class="form-group">
                                                    <label for="userMail" class="col-form-label">User Password</label>
                                                    <input type="password" class="form-control validate text-center" name="password" id="password" placeholder="type a password here...">
                                                </div>
                                                <input type="hidden" id="dbName" name="dbName" value="user">
                                                
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
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
                            <i class="fa fa-edit fa-xl text-warning" 
                            data-toggle="modal" 
                            data-target="#editProfile<?php echo $profile['id_pseudo']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="editProfile<?php echo $profile['id_pseudo']; ?>" role="dialog">
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
                            <i class="fa fa-trash fa-xl text-danger" 
                            data-toggle="modal" 
                            data-target="#deleteProfile<?php echo $profile['id_pseudo']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="deleteProfile<?php echo $profile['id_pseudo']; ?>" role="dialog">
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
                    <th class="text-center" colspan="100%">
                        <button type="button" class="add" id="addProfileButton" data-toggle="modal"  data-target="#addProfile"><i class="fa-solid fa-user-group"></i> Add a profile</button>
                            <div class="modal fade" id="addProfile" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body bg-dark">
                                            <form role="form" method="POST" action="admin/add.php">
                                                <div class="form-group">
                                                    <?php $takeUsersMail = $db->query('SELECT email FROM user');?>
                                                        <label for="mail" class="col-form-label">User Mail</label><br>
                                                        <select class="form-control validate text-center" id="mail" name="mail">
                                                            <option value="" disabled selected>Select an user email...</option>
                                                            <?php foreach ($takeUsersMail as $takeUserMail) :?>
                                                            <option  value="<?php echo $takeUserMail['email'] ?>"><?php echo $takeUserMail['email'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="profilePseudo" class="col-form-label">Pseudo</label>
                                                        <input type="text" class="form-control text-center" name="profilePseudo" id="profilePseudo" placeholder="type a pseudo here...">
                                                    </div>
                                                <div class="form-group">
                                                        <label for="profileImage" class="col-form-label">Profile Image</label>
                                                        <input type="text" class="form-control text-center" name="profileImage" id="profileImage" value="../images/user_pic/4.png">
                                                </div>
                                                <p>Catégorie</p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="categorie" id="categorie1" value="enfant">
                                                    <label class="form-check-label" for="categorie1">Enfant</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="categorie" id="categorie2" value="adulte">
                                                    <label class="form-check-label" for="categorie2">Adulte</label>
                                                </div>
                                                <input type="hidden" id="dbName" name="dbName" value="profile">
                                                
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                </tfoot>
            </table>
    </div>

    <!-- ======================================================================
                                    Comments - Administration
        //======================================================================-->
        <div id="commentAdmin">
        <h2>Comments' administration</h2>
        <table class="table table-striped my-3 text-center align-items-center">
                <thead>
                    <tr>
                        <th>ID comment</th>
                        <th>ID Film/Serie</th>
                        <th>Pseudo</th>
                        <th colspan="50%">Commentaire</th>
                        <th>Date</th>
                        <th>Éditer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody">
                    <?php while($comment = $commentsDB->fetch()) {?>
                    <tr>
                        <th scope="row"><?php echo $comment['id']; ?></th>
                        <td><?php echo $comment['id_film']; ?></td>
                        <td><?php echo $comment['pseudo']; ?></td>
                        <td colspan="50%"><?php echo $comment['commentaires']; ?></td>
                        <td><?php echo $comment['date']; ?></td>
                        <td>
                            <i class="fa fa-edit fa-xl text-warning" 
                            data-toggle="modal" 
                            data-target="#editComment<?php echo $comment['id']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="editComment<?php echo $comment['id']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <form role="form" method="POST" action="admin/edit.php">
                                                    <div class="form-group">
                                                        <label for="commentID" class="col-form-label">Comment ID</label>
                                                        <input type="number" class="form-control text-center" name="commentID" id="commentID" value="<?php echo $comment['id'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="filmID" class="col-form-label">Film/Serie ID</label>
                                                        <input type="number" class="form-control text-center" name="filmID" id="filmID" value="<?php echo $comment['id_film'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pseudo" class="col-form-label">Pseudo</label>
                                                        <input type="text" class="form-control text-center" name="pseudo" id="pseudo" value="<?php echo $comment['pseudo'];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment" class="col-form-label">Comment</label>
                                                        <textarea type="text" class="form-control text-center" name="comment" id="comment"><?php echo $comment['commentaires']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date" class="col-form-label">Date</label>
                                                        <input type="date" class="form-control text-center" name="date" id="date" value="<?php echo $comment['date'];?>">
                                                    </div>

                                                    <input type="hidden" id="dbName" name="dbName" value="comments">
                                                    <input type="hidden" id="originalID" name="originalID" value="<?php echo $comment['id'];?>">

                                                
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
                            <i class="fa fa-trash fa-xl text-danger" 
                            data-toggle="modal" 
                            data-target="#deleteComment<?php echo $comment['id']; ?>"> 
                            </i>
                            
                                <div class="modal fade" id="deleteComment<?php echo $comment['id']; ?>" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body bg-dark">
                                                <p>Êtes-vous sûr de vouloir supprimer l'<strong>ID <?php echo $comment['id'];?></strong> ? </p>
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <a href="admin/delete.php?id=<?php echo $comment['id']; ?>&db=comments">
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
                    <th class="text-center" colspan="100%">
                        <button type="button" class="add" id="addCommentButton" data-toggle="modal"  data-target="#addComment"><i class="fa-solid fa-comment"></i> Add a comment</button>
                            <div class="modal fade" id="addComment" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body bg-dark">
                                            <form role="form" method="POST" action="admin/add.php">
                                                <div class="form-group">
                                                    <label for="filmID" class="col-form-label">Film/Serie ID</label>
                                                    <input type="number" class="form-control text-center" name="filmID" id="filmID" value="<?php echo $comment['id_film'];?>">
                                                </div>
                                                <div class="form-group">
                                                        <?php $takeProfilesPseudo = $db->query('SELECT pseudo, email, id_pseudo FROM profile');?>
                                                        <label for="pseudo" class="col-form-label">Profile Pseudo</label><br>
                                                        <select class="form-control validate text-center" id="pseudo" name="pseudo">
                                                            <option value="" disabled selected>Select a profile pseudo...</option>
                                                            <?php foreach ($takeProfilesPseudo as $takeProfilePseudo) :?>
                                                            <option  value="<?php echo $takeProfilePseudo['pseudo'] ?>"><?php echo $takeProfilePseudo['pseudo']." || from ". $takeProfilePseudo['email'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment" class="col-form-label">Comment</label>
                                                    <textarea type="text" class="form-control text-center" name="comment" id="comment" placeholder="type a message here..."></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date" class="col-form-label">Date</label>
                                                    <input type="date" class="form-control text-center" name="date" id="date" value="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d'); ?>">
                                                </div>
                                                <input type="hidden" id="dbName" name="dbName" value="comments">
                                                
                                                <div class="modal-footer justify-content-center ">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Valider</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
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
    <script src="js/admin.js"></script>
</body>

</html>