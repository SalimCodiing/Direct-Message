<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=dm;charset=utf8;','root','');
if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
}
if(isset($_GET['id']) AND !empty($_GET['id'])){

    $getid= $_GET['id'];
    $recupUser= $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() >0){
        if(isset($_POST['envoyer'])){
            $message = htmlspecialchars($_POST['message']);
            $insererMessage= $bdd->prepare('INSERT INTO message (message, id_destinataire, id_auteur) VALUES(?, ?, ?)');
            $insererMessage->execute(array($message,$getid, $_SESSION['id']));
        }

    }else{
        echo "Aucun utilisateur trouvé";
    }
    

}else{
    echo  "Aucun identifiant trouvé";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Messagse Privés</title>
</head>
<body>
    <form method="POST" action="">
        <textarea name="message" placeholder="Texte" ></textarea>
        <br><br>
        <input type="submit" name="envoyer" value="Envoyer le message">
    </form>
    

    <section id="messages"> 
        
    <?php  
    $recupMessages = $bdd->prepare('SELECT * FROM message WHERE id_auteur = ? AND id_destinataire = ? OR id_auteur = ? AND id_destinataire = ?');
    $recupMessages->execute(array($_SESSION['id'], $getid, $getid, $_SESSION['id']));
    while($message = $recupMessages->fetch()){
        if($message ['id_destinataire'] ==$_SESSION['id']){
            ?>
            <p style="color:red"><?= $message['message'];?></p>
            <?php
        }elseif ($message ['id_destinataire'] ==$getid){
            ?>
            <p style="color:blue"><?= $message['message'];?></p>
            <?php
            
        }
    }
    

    ?>

    </section>
</body>
</html>