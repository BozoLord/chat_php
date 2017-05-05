<?php
session_start();
require_once('config.php');
if($_POST["message"] != "") {
    $req = $PDO->prepare('INSERT INTO messages (content, user_id) VALUES (:message, :user_id)');
    $req->bindValue(':message', htmlspecialchars($_POST['message']) );
    $req->bindValue(':user_id', $_SESSION['user_id']); 
    if($req->execute()){
        echo "Message envoyé";
    }else{
        echo "Impossible d'envoyer le message";
    }
}
else
{
    echo "Remplissez tous les champs";
}

?>