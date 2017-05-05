<?php
session_start();
require_once('config.php');
if($_POST["nickname"] != "") {
    $ret = $PDO->prepare('select nickname FROM users WHERE nickname=:nickname');
    $ret->bindValue(':nickname', $_POST['nickname']);
    $ret->execute();
    $total = $ret->fetch();
    if (($total) && $total->nickname == $_POST['nickname']){
        $ret = $PDO->prepare('select id FROM users WHERE nickname=:nickname');
        $ret->bindValue(':nickname', $_POST['nickname']);
        $ret->execute();
        $total = $ret->fetch();
        foreach ($total as $data)
        $_SESSION['user'] = $_POST['nickname'];
        echo "connecté";
    }
    else{
        echo "Pseudo inconnu";
    }
}

?>