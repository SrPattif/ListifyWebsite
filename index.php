<?php
    require('./controllers/settings.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify - Acompanhe e compartilhe o que você está ouvindo!</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="./index.css" />

    <!-- Bibliotecas Externas -->
    <script src="https://use.fontawesome.com/8aae9daeac.js"></script>
</head>

<body>
    <div class="header">
        Listify
    </div>

    <div class="page-content">
        <div class="central-message">
            <p>Olá, seja bem vindo(a)! &#128075<br>
                O <b>Listify</b> é uma ferramenta que te permite ver e compartilhar o quanto você escuta música!<br><br>
                Para continuarmos, é necessário que você se autentique com o Spotify!</p>

            <div class="button">
                <div class="spotify-login-button" id="spotify-login">
                    <i class="fa fa-spotify" aria-hidden="true"></i> Entrar com o <span>Spotify</span>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        Desenvolvido por Gustavo Antonio<br>
        <a href="https://www.instagram.com/ogustavo.a/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://twitter.com/ogustavo_a"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://github.com/SrPattif"><i class="fa fa-github" aria-hidden="true"></i></a>
        <br>
        <span>manda uma coisinha lá :)</span>
    </div>

    <script>
        var login = document.getElementById('spotify-login');

        login.addEventListener('click', () => {
            window.location.href = "https://accounts.spotify.com/pt-BR/authorize?client_id=00fe8a888303400293a36a1fb82ec145&scope=user-read-private%20user-read-email%20user-top-read%20user-follow-read%20user-read-recently-played%20user-library-read%20playlist-read-private%20user-read-playback-state%20user-modify-playback-state&response_type=code&redirect_uri=<?php echo($listifyRedirectURI); ?>"
        })
    </script>
</body>

</html>