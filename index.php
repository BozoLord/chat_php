<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Chat-erton !</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <script>
        $(function(){
            $.ajax({
                method : "GET",
                url : 'session.php',
                success : function(resultat){
                    $('#nick').html(resultat)
                }
            })
            $("#signup").on('submit', function(e){
                e.preventDefault()
                data = {
                    lastname : $("#lastname").val(),
                    firstname : $("#firstname").val(),
                    nickname : $("#nickname").val(),
                }
                $.ajax({
                    method : "POST",
                    url : "signup.php",
                    data : data,
                    success : function(resultat){
                        if (resultat == "Utilisateur ajouté"){
                            $.ajax({
                                method : "POST",
                                url : "login.php",
                                data : data,
                                success : function(resultat){
                                    $('#signin_info').html(resultat)
                                    if (resultat == "connecté"){
                                        window.location.href = "chat.php";
                                    }else{
                                        $('#signin_info').html("Erreur de connexion")
                                    }
                                }
                            })
                        }
                        $('#signup_info').html(resultat)
                    }
                })
            })
            $('#login').on('submit', function(e){
                e.preventDefault()
                data = {
                    nickname : $("#username").val(),
                }

                $.ajax({
                    method : "POST",
                    url : "login.php",
                    data : data,
                    success : function(resultat){
                        $('#signin_info').html(resultat)
                        if (resultat == "connecté"){
                            window.location.href = "chat.php";
                        }else{
                            $('#signin_info').html("Erreur de connexion")
                        }
                    }
                })
            })
            $('#logout').on('click', function(e){
                e.preventDefault()
                $.ajax({
                    method : "GET",
                    url : "logout.php",
                    success : function(resultat){
                        $('#signin_info').html(resultat)
                        window.location.href = "index.php";
                    }
                })
            })
            $('#goToChat').on('click', function(){
                window.location.href = "chat.php";
            })
        })
    </script>

    <body>
        <div class="container">
            <div class="row" id="block">
                <p class="title">Chat-<span>Erton</span></p>

                <div class="col-xs-12 col-lg-6" id="section1">
                    <h2>Inscrivez-vous</h2>
                    <form id="signup">
                        <input type="text" id="lastname" name="lastname" maxlength="32" placeholder="Nom"><br>
                        <input type="text" id="firstname" name="firstname" maxlength="32" placeholder="Prénom"><br>
                        <input type="text" id="nickname" name="nickname" maxlength="32" placeholder="Pseudo"><br>
                        <input class="btn btn-default signup" type="submit" name="submit">
                    </form>
                    <div id="signup_info"></div>
                </div>

                <div class="col-xs-12 col-lg-6" id="section2">
                    <?php
                    if (isset($_SESSION['user']))
                    {
                    ?>
                    <div id="nick"></div>
                    <button class="btn btn-default" type="button" id="logout">Déconnexion</button>
                    <button class="btn btn-default" type="button" id="goToChat">Chat Erton !</button>
                    <?php
                    }else{
                    ?>
                    <h2>Connectez-vous</h2>
                    <form class="col-lg-6" action="" id="login">
                        <input type="text" id="username" placeholder="Pseudo"><br>
                        <input class="btn btn-default" type="submit" name="submit">
                    </form>
                    <?php } ?>
                    <div id="signin_info"></div>
                </div>
            </div>
        </div>
        <!--<footer class="navbar-default navbar-bottom">
<div class="container-fluid">
<p>Site développé par Dylan D. et Sophie-L. P.</p>
</div>
</footer>-->
    </body>
</html>
