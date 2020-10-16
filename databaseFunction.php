<?php
session_start();
function connect_database(){

    $host ="localhost";
    $username="root";
    $pwd="";
    $database="cv";
    $link=mysqli_connect($host,$username,$pwd,$database);
    if($link){

        return $link;
    }
    else{
        echo "connexion error";
    }
}

function disconnect_database($link){
    mysqli_close($link);
}


 ?>
