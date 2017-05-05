<?php
session_start();
require_once('config.php');
$ret = $PDO->prepare('select * FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY date');
$ret->execute();
$datas = $ret->fetchall();
foreach ($datas as $data)
    echo "<b>$data->firstname $data->lastname $data->date</b> - $data->content <br>";

?>