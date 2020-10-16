<?php
require_once 'function.php';
function addImage()
{
    $link= connect_database();
    $message = 1;
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    var_dump($target_file);
//verifie extension du fichier
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $futureTargetFile = $target_dir . "jerome_03." . $imageFileType;
    var_dump($imageFileType);

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    var_dump($check);

    if ($check !== false) {

        echo "File is an image - " . $check["mime"] . ".";
        $message = 1;
    } else {
        echo "File is not an image.";
        $message = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $message = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $message = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $message = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($message == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $futureTargetFile)) {
            echo " The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            //update database to add file path dans $futureTargetFile
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
$req = "ALTER TABLE user set IMAGE_PATH=$futureTargetFile where idUser= 23";
    $reponse= mysqli_query($link,$req);
    if ($reponse){
        echo "insertion reussi";
    }else{
        echo "error insertion";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="">
<h1 class="h1 text-center">CREATION CV</h1>
<form action="" method="post" class="form-group ml-4" enctype="multipart/form-data">
    <input type="file" class="btn-primary" name="fileToUpload"><br>
    <input type="submit" value="suivant" name="envoyer" class="btn btn-success outline" id="sending">
    <?php
    if (isset($_SESSION['envoyer'])){
        addImage();
    }
    ?>

</form>
</body>
</html>