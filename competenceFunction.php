<?php

include_once ('function.php');

// get competence by idUser

function getCompetenceByUserId($idUser)
{
  $link = connect_database();
    $tab=[];
  if ($link) {
    $req = "select * from competence where idCompetence in (select idCompetence from userCompetence where idUser='$idUser')";
    $res = mysqli_query($link, $req);

    if ($res) {
      while ($row = $res->fetch_assoc()) {
        $tab[]=$row;

      }

    }else{
        var_dump( mysqli_error($link));
    }
  } else {

   return false;
  }
 return $tab;
}



