<?php 

require_once ('../src/connect.php');

  $id = $_GET['id']; 
  $table= $_GET['db'];

  // On supprimme la ligne de la bdd
  if($table == "user"){
    $userSuppression = $db->query("DELETE FROM `$table` WHERE id=$id");

    if ($userSuppression) {
        header("Location: ../admin.php");
      }else{
        echo "Failed to delete user";
      }
  }

  if($table == "profile"){
    $profileSuppression = $db->query("DELETE FROM `$table` WHERE id_pseudo=$id");

    if ($profileSuppression) {
        header("Location: ../admin.php");
      }else{
        echo "Failed to delete profile";
      }
  }

  if($table == "comments"){
    $commentsSuppression = $db->query("DELETE FROM `$table` WHERE id=$id");

    if ($commentsSuppression) {
        header("Location: ../admin.php");
      }else{
        echo "Failed to delete comment";
      }
  }
  
    

 ?>