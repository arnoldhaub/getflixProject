<?php

session_start(); //initialise la session
session_unset(); //désactive la session
session_destroy(); // détruit la session
setcookie('auth', '', time()-1, '/', null, false, true); // on supprime le cookie

header('location: ../index.php');
exit ();

?>