<?php
require_once('config.php');
$req = $PDO->prepare('select * FROM users');
$req->execute();

$datas = $req->fetchall();
foreach ($datas as $data)
    echo "<b> ID </b> : " . $data->id . " " . "<b>Pseudo</b> : " . $data->nickname . " " . '<b>Prénom</b> : ' . $data->firstname . " " . "<b>Nom</b> : " . $data->lastname . " " . "<br>";
?>