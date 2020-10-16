<?php

include_once('databaseFunction.php');

// get experiences by userid

function getEtudeByUser($idUser){
  $link = connect_database();
  $tab=[];
  if ($link) {
    $req = "select * from etude where idEtude in (select idEtude from userEtude where idUser='$idUser')";
    $res = mysqli_query($link,$req);
    if ($res) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $tab[] = $row;
      }
    }
  } else {
    return false;
  }
  return $tab;
}

 ?>
