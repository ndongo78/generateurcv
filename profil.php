<?php

require_once "function.php";


if(!$_SESSION) {
    session_start();
}
$user= $_SESSION['userInfo'][0];
$userCompetence= $_SESSION['userCompetences'];

$userExperience= $_SESSION['userExperiences'];

$userEtude=$_SESSION['userEtudes'];


$myIdUser= $user['idUser'];
    if (isset($_POST["update"])) {
        $link= connect_database();
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["changerFil"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $futureTargetFile = $target_dir . uniqid(rand(), true) . "." . $imageFileType;
// Check if image file is a actual image or fake image
        var_dump($futureTargetFile);
        $check = getimagesize($_FILES["changerFil"]["tmp_name"]);
        if ($check !== false) {

            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["changerFil"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["changerFil"]["tmp_name"], $futureTargetFile)) {
                echo " The file " . basename($_FILES["changerFil"]["name"]) . " has been uploaded.";
                //update database to add file path dans $futureTargetFile
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $req = "UPDATE  user set 	IMAGE_PATH='$futureTargetFile' where idUser='$myIdUser'";
        $reponse = mysqli_query($link, $req);
        if ($reponse) {
            echo "insertion reussi";
            $user['IMAGE_PATH']=$futureTargetFile;
        } else {
            echo mysqli_error($link);
        }

    }



?>



<!doctype html>
<html lang="en">
  <head>
    <title>Profil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="functions/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 infos">
            <img src='<?echo $user['IMAGE_PATH'] ?>' style="width: 300px" class="mt-2">
            <button type="button" data-toggle="modal" data-target="#infos" class="btn btn-primary btn-outline-warning mt-2 text-dark">Modifier photo de profil</button>
            <div class="modal" id="infos">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <legend style="text-align: center;">Selectionner votre photo de profil</legend>
                        <div class="modal-body">
                            <form action=""  method="post" enctype="multipart/form-data">
                            <input type="file" name="changerFil"><br>
                            <input type="submit" name="update" value="sauvegarder" class="btn btn-success">
                            <input type="reset" name="reset" value="Annuler" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="mt-2">Mes Cordonnées</h1>
            <hr>
            <div class="contain">
                <p>Nom Prenom:<? echo $user['nomUser']." ".$user['prenomUser']?></p>
                <p>Date de Naissance:<? echo $user['naissanceUser']?></p>
                <p>Email:<? echo $user['emailUser']?></p>
                <p>Telephone:<? echo $user['telUser']?></p>
                <p>Adresse:<? echo $user['nomRueUser']." ".$user['villeUser']." ".$user['cpUser']." ".$user['paysUser']?></p>
        </div>
        </div>
        <div class="col-md-9 bg-light mt-2">
            <div class="competence ">
              <h2 class="text-center">Mes COMPETENCES</h2>
                <?php
                for ($i=0;$i<sizeof($userCompetence);$i++){
                ?>
                <p class="ml-3">=><? echo $userCompetence[$i]['libCompetence']?></p>

            <?php
                }

                ?>
            </div>
            <div class="competence mt-4 ">
                <h2 class="text-center">Mes EXPERIENCES</h2>
                <?php
                for ($i=0;$i<sizeof($userExperience);$i++){
                ?>
                <p class="ml-3">=><? echo $userExperience[$i]['debutExpereince']." /".$userExperience[$i]['finExperience']." ".$userExperience[$i]['descpriptionExperience']." ".$userExperience[$i]['entrepriseExperience']?></p>

            <?php
                }
                ?>
            </div>
            <div class="competence mt-4 ">
                <h2 class="text-center">Mes ETUDES</h2>
                <?php
                for($i=0;$i<sizeof($userEtude);$i++){
                ?>
                <p class="ml-3">=><? echo $userEtude[$i]['anneeEtude']." ".$userEtude[$i]['diplomeEtude']." ".$userEtude[$i]['ecoleEtude']?></p>

                <?php

                }
                ?>
            </div>
        </div>

    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
