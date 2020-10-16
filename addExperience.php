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
    <style>
        .popup{
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }
    </style>
</head>
<body class="">
<h1 class="h1 text-center"> Ajouter Vos Experiences</h1>
<form action="" method="post" class="form-group ml-4" >
    <div class="experience">
    DATE Debut:<input type="date" name="debutExpereince[]" class="form-control temps"><br>
    DATE Fin:<input type="date" name="finExperience[]" class="form-control temps"><br>
    NOM D'entreprise:<input type="text" name="entrepriseExperience[]" class="form-control conte1"><br>
    D'escription :<input type="text" name="descpriptionExperience[]" class="form-control conte1"> <br>
        <div class="popup text-center">
            <p>Voulez vous ajouter votre photo</p>
            <button class="btn-success">Oui</button>
            <button class="btn-danger">Non</button>
        </div>
    </div>
    <div id="rooter"></div>
    <button class="btn btn-danger outline " id="addExp" >Ajouter</button><br>
    <input type="submit" value="suivant" name="envoyer" class="btn btn-success outline" id="sending">
</form>
<?php
if (isset($_POST['envoyer'])){
    addExperience();
    header('location: connexion.php');

}

?>
<script>

    $(document).ready(function () {
        let compteur=10;
        let numCompteur=1;
        $('#addExp').click(function (e) {
            e.preventDefault();
            if (numCompteur < compteur){
                numCompteur++;
                $('#rooter').append(' <div class="experience">\n' +
                    '    DATE Debut:<input type="date" name="debutExpereince[]" class="form-control temps"><br>\n' +
                    '    DATE Fin:<input type="date" name="finExperience[]" class="form-control temps"><br>\n' +
                    '    NOM D\'entreprise:<input type="text" name="entrepriseExperience[]" class="form-control conte1"><br>\n' +
                    '    D\'escription :<input type="text" name="descpriptionExperience[]" class="form-control conte1"><br>\n' +
                    '    </div>');
            }

        })

    })
</script>
</body>
</html>