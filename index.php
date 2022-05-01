<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dm;charset=utf8;','root','');
if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
}
?>

<!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <title>Tous les utilisateurs</title>
    </head>
    <body>
    <?php
        $recupUser= $bdd->query('SELECT * FROM users ');
        while($user = $recupUser->fetch()){
            ?>
            <a href="message.php?id=<?php echo $user['id']; ?> ">
                <p><?php echo $user['pseudo'];?></p>
            </a>
            <?php

        }
      
    ?>
    </body>
    </html>