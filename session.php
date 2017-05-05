<?php 
session_start();
require_once('config.php');
if (isset($_SESSION['user'])){
    echo '<h2>Connecté en tant que <b>' . $_SESSION['user'] . '</b></h2>';
}else{
    echo "Vous n'êtes pas connecté";
}
?>