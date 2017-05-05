<?php
session_start();
require_once('config.php');
if($_POST["lastname"] != "" && $_POST["firstname"] != "" && $_POST["nickname"] != "") {
    $ret = $PDO->prepare('select count(nickname) as cnickname FROM users WHERE nickname=:nickname');
    $ret->bindValue(':nickname', $_POST['nickname']);
    $ret->execute();
    $total = $ret->fetch();
    if($total->cnickname > 0){
        echo "Pseudo déjà utilisé";
    }
    else{
        $req = $PDO->prepare('INSERT INTO users (lastname, firstname, nickname) VALUES (:lastname, :firstname, :nickname)');
        $req->bindValue(':lastname', $_POST['lastname'] );
        $req->bindValue(':firstname', $_POST['firstname'] );
        $req->bindValue(':nickname', $_POST['nickname'] );
        if($req->execute()){
            echo "Utilisateur ajouté";
        }else{
            echo "Impossible de crééer l'utilisateur";
        }
    }
}else
{
    echo "Remplissez tous les champs";
}

?>