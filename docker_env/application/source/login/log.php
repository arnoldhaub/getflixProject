<?php

///on vérifie si un cookie existe
if (isset($_COOKIE['auth']) && !isset($_SESSION['connect']))
{
    $secret = htmlspecialchars($_COOKIE['auth']);

    /// on verifie si ce cookie est lié à un compte
    require('../src/connect.php');

    // 1er requete pour verifier que l'utilisateur existe :
    $req = $db->prepare("SELECT count(*) as numberAccount FROM user WHERE secret = ?");
    $req->execute(array($secret));

    while($user = $req->fetch()){

        if ($user['numberAccount'] == 1)
        {
    // 2em requete pour récupérer le code secret de la bdd et le confronter au cookie créé -> si identique, session ON
            $reqUser = $db->prepare("SELECT * FROM user WHERE secret = ?");
            $reqUser->execute(array($secret));

            while($userAccount == $reqUser->fetch())
            {
                $_SESSION['connect'] 	= 1;
				$_SESSION['email']		= $userAccount['email'];
            }
        }
    }
}
?>