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
    <title>Connexion</title>
</head>
<body class="">
<h1 class="h1 text-center">Connexion</h1>
<form action="" method="post" class="form-group ml-4">
    EMAIL:<input type="email" name="userEmail" class="form-control"><br>
    PASSWORD:<input type="password" name="userPassword" class="form-control">
    <input type="submit" value="Envoyer" name="send" class="btn btn-success outline">
</form>
<?php
if(isset($_POST['send'])){

    if(connexion()==200){

        header('Location: profil.php');
    }
    else if(connexion()==404){
        echo "<p>Vous n'avez de compte</p>"."<br>";
        echo "<p>Cliquez ici pour vous inscrire". "<a href='inscription.php' class='btn btn-success'>Creer un compte</a></p>";

    }
}
?>
</body>
</html>
