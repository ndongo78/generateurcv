<?php
require_once "function.php";
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
    NOM:<input type="text" name="nom" class="form-control conte1"><br>
    PRENOM:<input type="text" name="prenom" class="form-control conte"><br>
    DATE NAISSANCE:<input type="date" name="naissance" class="form-control temps"><br>
    EMAIL: <input type="email"  name="email" class="form-control mail" ><br>
    <p class="text-danger mailerror"></p>
    PASSWORD: <input type="password"  name="password" class="form-control mdp"><br>
    TELEPHONE: <input type="text"  name="tel" class="form-control telephone"><br>
    NUMERO RUE: <input type="number"  name="numero" class="form-control conte3"><br>
    NOM DE RUE: <input type="text"  name="rue" class="form-control conte"><br>
    VILLE: <input type="text"  name="ville" class="form-control conte" ><br>
    CODE POSTAL: <input type="text"  name="postal" class="form-control"><br>
    PAYS: <select name="pays" id="" class="form-control">
        <option value="france">FRANCE</option>
        <option value="belgique">BELGIQUE</option>
        <option value="senegal">SENEGAL</option>
        <option value="allemagne">ALLEMAGNE</option>
    </select><br>
    PHOTO PROFIL:<input type="file" class="btn-primary" name="fileToUpload"><br>
    <input type="submit" value="suivant" name="envoyer" class="btn btn-success outline" id="sending">
    <?php
    if (isset($_POST['envoyer'])){
        insert_user();

        header("location: etude.php");
    }
    ?>

</form>
<!--<script src="functions/inscription.js"></script>-->
</body>
</html>
