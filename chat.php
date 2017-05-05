<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
        <link rel="stylesheet" type="text/css" href="stylechat.css">
    </head>
    <script>
        $(function(){
            $.ajax({
                method : "GET",
                url : "getmessages.php",
                success : function(resultat){
                    $('#chat').html(resultat);
                }
            })
            $.ajax({
                method : "GET",
                url : 'session.php',
                success : function(resultat){
                    $('#nick').html(resultat)
                }
            })
            $('#messager').on('submit', function(e){
                e.preventDefault()
                data = {
                    message : $("#message").val(),
                }
                $.ajax({
                    method : "POST",
                    url : "sendmessage.php",
                    data : data,
                    success : function(resultat){
                        $('#chat').append(resultat);
                        $('#message').val("");
                    }
                })
                $('#chat').load('http://localhost/php_chat/getmessages.php');
            })
            setInterval(function(){
                $('#chat').load('http://localhost/php_chat/getmessages.php');
            }, 1000);
            $('#message').on('keypress', function(e){
                switch(e.which)
                        {
                    case 13:
                        $("#messager").submit();
                }
            })
        })
    </script>
    <body>
        <div class="container">
            <div class="row" id="block">
                <p class="title">Chat-<span>Erton</span></p>
                <div class="col-xs-12 col-lg-12" id="section1">
                    <div id="nick"></div>
                    <form action="index.php" method="POST" id="messager">
                        <div id="chat"></div>
                        <textarea id="message" class="message-area" name="message" maxlength="150" size="150px" placeholder='Votre message'></textarea>
                        <input class="button btn btn-block btn-default" type="submit" name="submit">
                    </form>
                    <a href="index.php"><button type="button" class="btn btn-default return">Accueil</button></a>
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
