<?php
include_once("databaseFunction.php");
require_once("userFunction.php");
require_once("competenceFunction.php");
require_once("etudeFunction.php");
require_once("experienceFunction.php");



function connexion(){
    $email = $_POST['userEmail'];
    $pwd = $_POST['userPassword'];
    //check user connection_
    $user = getUserConnection($email,$pwd);
    if(!$user){
        return 404;
    }
    else{
        if(sizeof($user)>0){

            $_SESSION['userInfo'] =$user;
            $idUser = $user[0]['idUser'];
            $completed= $user[0]['completed'];
            if($completed==1){
                $competence = getCompetenceByUserId($idUser);

                // si competence not empty
                $_SESSION['userCompetences']=$competence;

                $experience = getExperienceByUser($idUser);
                // si experience not empty
                $_SESSION['userExperiences']=$experience;

                $etude = getEtudeByUser($idUser);
                $_SESSION['userEtudes']=$etude;
                //si etude not empty

                return 200;
            }
            else{

                // reprendre l'insertion des information la ou il s'est arreté
            }

        }
    }
}

function insert_user(){
    //connect to database
    $link= connect_database();
//if not connected
    if(!$link){
        echo "a problem was occured !!! ";
    }
// connextion ok
    else{
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        var_dump($target_file);
//verifie extension du fichier
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $futureTargetFile = $target_dir .uniqid(rand(),true).".". $imageFileType;

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

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
        // get all datas
        $nomUser = $_POST['nom'];
        $prenomUser = $_POST['prenom'];
        $emailUser = $_POST['email'];
        $passwordUser = $_POST['password'];
        $telUser = $_POST['tel'];
        $naissanceUser = $_POST['naissance'];
        $numRueUser = $_POST['numero'];
        $nomRueUser = $_POST['rue'];
        $cpUser = $_POST['postal'];
        $villeUser = $_POST['ville'];
        $paysUser = $_POST['pays'];
        // requette to verify the existance of a user
        $req = "select * from user where passwordUser='$passwordUser' and emailUser='$emailUser'";
        // execute verification query
        $res = mysqli_query($link,$req);
        // if no problem on verification
        if($res){
            // get user if exist
            $exist = mysqli_fetch_row($res);
            // if no user exist
            if(!$exist){
                // requette to insert new user
                $reqInsert = "insert into user values(null,
		'$nomUser',
		'$naissanceUser',
		'$prenomUser',
		'$emailUser',
		'$passwordUser',
		'$telUser',
		 $numRueUser,
		'$nomRueUser',
		'$villeUser',
		'$cpUser',
		'$paysUser',
		1,
		'$futureTargetFile'
		)";
                //execute  insertion requette
                $resInsert = mysqli_query($link,$reqInsert);
                // if execution well done
                if($resInsert){
                    echo "inscription reussite";
                    // get the last inserted id
                    $idUser = mysqli_insert_id($link);
                    $_SESSION['idUser'] = $idUser;


                }
                // execution failed
                else{
                    echo "problem d'inscription";
                    echo mysqli_error($link);
                    disconnect_database($link);
                }
            }
            // user exist already
            else{
                echo "user exist already";
                disconnect_database($link);
            }
        }
        // user verification failed
        else{
            echo "problem sur la requette";
            disconnect_database($link);
        }
    }
}

// fonction etude

function addEtude(){
    //connect to database
    $link= connect_database();
//if not connected
    if(!$link){
        echo "a problem was occured !!! ";
    }
// connextion ok
    else{

        // get all datas
        $diplomeEtude = $_POST['diplomeEtude'];
        $anneeEtude = $_POST['anneeEtude'];
        $ecoleEtude = $_POST['ecoleEtude'];
        for ($i=0;$i<sizeof($diplomeEtude);$i++) {
            echo ($i);
            try {
                $anneeEtude[$i] = intval(date_format(new DateTime($anneeEtude[$i]), 'Y'));
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // requette to verify the existance of a user
            $req = "select * from etude where diplomeEtude='$diplomeEtude[$i]' and anneeEtude='$anneeEtude[$i]' and ecoleEtude='$ecoleEtude[$i]'";
            // execute verification query
            $res = mysqli_query($link, $req);
            // if no problem on verification
            if ($res) {
                // get user if exist
                $exist = mysqli_fetch_row($res);
                // if no user exist
                if (!$exist) {
                    // requette to insert new user
                    $reqInsert = "insert into etude values(null,
		'$diplomeEtude[$i]',
		'$anneeEtude[$i]',
		'$ecoleEtude[$i]'
		)";
                    //execute  insertion requette
                    $resInsert = mysqli_query($link, $reqInsert);
                    // if execution well done
                    if ($resInsert) {

                        // get the last inserted id
                        $idEtude = mysqli_insert_id($link);
                        $_SESSION['idEtude'] = $idEtude;


                    } // execution failed
                    else {
                        echo "problem dajout";
                        echo mysqli_error($link);

                    }
                } // user exist already
                else {
                    $idEtude = $exist[0];

                    $_SESSION['idEtude'] = $idEtude;
                }

                $idEtude = $_SESSION['idEtude'];
                $idUser = $_SESSION['idUser'];
                $reqUserEtude = "insert into userEtude values (null,$idUser,$idEtude)";
                $resUserEtude = mysqli_query($link, $reqUserEtude);
                if ($resUserEtude) {

                    echo "insertion reussite";

                } else {

                    echo mysqli_error($link);
                }
            } // user verification failed
            else {
                echo "false";
            }
        }
    }


}

// add competence

function competence(){
		//connect to database
$link= connect_database();
//if not connected
if(!$link){
	echo "a problem was occured !!! ";
}
// connextion ok
else{

	// get all datas
	$libCompetence = $_POST['libCompetence'];
echo(sizeof($libCompetence));
    for ($i=0;$i<sizeof($libCompetence);$i++){
	// requette to verify the existance of a user
 	$req = "select * from competence where libCompetence='$libCompetence[$i]'";
	// execute verification query
	$res = mysqli_query($link,$req);
	// if no problem on verification
	if($res){
		// get user if exist
		$exist = mysqli_fetch_row($res);
		// if no user exist
		if(!$exist) {

            // requette to insert new user
            $reqInsert = "insert into competence values(null,
		'$libCompetence[$i]'
		)";
            //execute  insertion requette
            $resInsert = mysqli_query($link, $reqInsert);
            // if execution well done
            if ($resInsert) {

                // get the last inserted id
                $idCompetence = mysqli_insert_id($link);
                $_SESSION['idCompetence'] = $idCompetence;
                

            } // execution failed
            else {

                echo mysqli_error($link);
            }
		}

        else {
            $idCompetence = $exist[0];

            $_SESSION['idCompetence'] = $idCompetence;
        }

        }

	else{
    echo "problem dajout";
    echo mysqli_error($link);
	}

	$idCompetence= $_SESSION['idCompetence'];
	$idUser=$_SESSION['idUser'];
	$reqUserComptence = "insert into userCompetence values (null,'$idUser','$idCompetence')";
	$resUserCompetence = mysqli_query($link,$reqUserComptence);
	if($resUserCompetence){

		//return true;

	}
	else{

		echo mysqli_error($link);
	}

	}
}
	// user verification failed

}

// function experience
function addExperience(){
    //connect to database
    $link= connect_database();
//if not connected
    if(!$link){
        echo "a problem was occured !!! ";
    }
// connextion ok
    else {

        // get all datas
        $debutExpereince = $_POST['debutExpereince'];
        $finExperience = $_POST['finExperience'];
        $entrepriseExperience = $_POST['entrepriseExperience'];
        $descpriptionExperience = $_POST['descpriptionExperience'];
        for ($i = 0; $i < sizeof($debutExpereince); $i++){
            // requette to verify the existance of a user
            $req = "select * from experience where  debutExpereince='$debutExpereince[$i]' and finExperience='$finExperience[$i]' and entrepriseExperience='$entrepriseExperience[$i]' and descpriptionExperience='$descpriptionExperience[$i]'";
            // execute verification query
            $resp = mysqli_query($link, $req);
            // if no problem on verification
            if ($resp) {
                // get user if exist
                $exist = mysqli_fetch_row($resp);
                // if no user exist
                if (!$exist) {
                    $idUser = $_SESSION['idUser'];
                    if ($debutExpereince > $finExperience) {
                        echo "Veillez choisir une date valid";
                    } else {
                        // requette to insert new user
                        $reqInsert = "insert into experience values(null,
		'$debutExpereince[$i]',
		'$finExperience[$i]',
		'$entrepriseExperience[$i]',
		'$descpriptionExperience[$i]',
		'$idUser'
		
		)";

                        //execute  insertion requette
                        $resInsert = mysqli_query($link, $reqInsert);
                        // if execution well done
                        if ($resInsert) {

                            // get the last inserted id
                            $idExp = mysqli_insert_id($link);
                            $_SESSION['$idExp'] = $idExp;

                        } // execution failed
                        else {
                            echo "problem dajout";
                            echo mysqli_error($link);

                        }
                    }
                } // user exist already
                else {
                    $idExp = $exist[0];

                    $_SESSION['idExp'] = $idExp;
                }


            } // user verification failed
            else {
                echo "false";
            }
        }

    }
}


?>
