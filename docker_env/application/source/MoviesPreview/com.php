<?php 
///////////////////////////////////////connexion DB\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
include('../src/connect.php');
/////////////////////////////////////////////code\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$request = $db ->query('SELECT * FROM comments /*WHERE id_film = ?*/');
$request ->execute();
$comment = $request->fetchAll();

if(isset($_POST['commentaires'], $_POST['pseudo'], $_POST['id']))
{
    $commentaire =htmlspecialchars($_POST['commentaires']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $id_film = htmlspecialchars($_POST['id']);

    $push = $db ->prepare('INSERT INTO `comments` (`id`, `id_film`, `pseudo`, `commentaires`, `date`) VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)');
    $push->execute(array($id_film, $pseudo, $commentaire));
    header('location: com.php');
}

?>
<div name="com">
   <?php
   foreach($comment as $comment)
   {?>
    <p> <?= $comment['date'],' ', $comment['pseudo'], ' ' ,$comment['commentaires']; ?> </p>
    <?php
   }?>
</div>
<div name="form_com">
    <form method="POST">
        <input type="text" placeholder="pseudo" name="pseudo"><br/>
        <input type="text" placeholder="votre commentaire" name="commentaires"><br/> 
        <input type="text" placeholder="id_film" name="id"><br/>
        <button type="submit">envoyer</button>
    </form>
</div>