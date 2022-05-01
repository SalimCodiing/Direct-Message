<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dm;charset=utf8;','root','');
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo'])){
        $recupUser= $bdd->prepare('SELECT * FROM users WHERE pseudo= ? ');
        $recupUser->execute(array($_POST['pseudo']));
        if($recupUser->rowCount()>0){
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: index.php');


        }else{
            echo "Vérifier votre nom d'utilisateur";
        }
    }else{
        echo "Veuillez remplir les champs";
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de connexion</title>
</head>
<body>
    <p>Bonjour, veillez vous connectez pour accéder à vos messages privés avec se pseudo (oui c'est pas sécurisé)</p>
    <form method="post" action="">
        <input type="text" name="pseudo" placeholder="Pseudo">
        <br> <br>
        <br><br>
        <input type="submit" name="valider">
    </form>
</body>
</html>