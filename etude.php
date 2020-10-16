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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="">
<h1 class="h1 text-center">ajouter etudes</h1>
<form action="" method="post" class="form-group ml-4" id="form">

    <div class="diplome">
        DIPLOME:<input type="text" name="diplomeEtude[]" class="form-control champ" ><br>
        <p class="text-danger error"></p>
        ANNEE:<input type="date" name="anneeEtude[]" class="form-control"><br>
        ECOLE:<input type="text" name="ecoleEtude[]" class="form-control champ"><br>
    </div>
    <div id="contain"></div>
    <button class="btn btn-danger outline " id="buttons" >Ajouter</button><br>
    <input type="submit" value="Suivant" name="send" class="btn btn-success outline">
</form>

<?php
if (isset($_POST['send'])){
    addEtude();
 header("location: competence.php");
}
?>
<script>
    $(document).ready(function () {
        let compteur=10;
        let numCompteur=1;
        $('#buttons').click(function (e) {
           e.preventDefault();
            if (numCompteur < compteur){
                numCompteur++;
                $('#contain').append('<div class="diplome">\n' +
                    '        DIPLOME:<input type="text" name="diplomeEtude[]" class="form-control champ" ><br>\n' +
                    '        <p class="text-danger error"></p>\n' +
                    '        ANNEE:<input type="date" name="anneeEtude[]" class="form-control"><br>\n' +
                    '        ECOLE:<input type="text" name="ecoleEtude[]" class="form-control champ"><br>\n' +
                    '    </div>');
            }

        })



    })

</script>
</body>
</html>
