<?php 
///////////////////////////////////////connexion DB\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
include('../src/connect.php');
/////////////////////////////////////////////code\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if(!empty($_POST['comment']))
{
    $commentaire =htmlspecialchars($_POST['comment']);
    $pseudo = htmlspecialchars($_GET['pseudo']);
    $id_film = $_GET['id'];

    $push = $db ->prepare("INSERT INTO comments(id_film, pseudo, commentaires VALUES (?, ?, ?)");
    $push-> execute(array($id_film, $pseudo, $_POST['comment']));
}

$request = $db ->query('SELECT * FROM comments /*WHERE id_film = ?*/');
$request ->execute();
$comment = $request->fetchAll();
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
        <input type="text" placeholder="votre commentaire"><br/> 
        <button type="submit">envoyer</button>
    </form>
</div>