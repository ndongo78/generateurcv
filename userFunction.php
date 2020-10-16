<?php
include_once('databaseFunction.php');

// get all users

function getAllUsers(){
  $link = connect_database();
  if ($link) {
    $req = 'select * from user';
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
// var_dump(getAllUsers());

// getUserBy password and email

function getUserConnection($email,$pwd){
  $link = connect_database();
  $tab=[];
  if ($link) {
    $req = "select * from user where emailUser='$email' and passwordUser='$pwd'";
    $res = mysqli_query($link,$req);
    if ($res) {
      while ($row=$res->fetch_assoc()) {
        $tab[]= $row;
      }
    }
  } else {
    return false;
  }
  return $tab;
}

 ?>
