<?php
    require('../controllers/spotifyPlayer.php');
    require('../controllers/spotifyTop.php');
    require('../controllers/spotifyUser.php');
    require('../controllers/settings.php');

    $queryTime = '';
    $timeType = 'long_term';

    if(isset($_GET['time'])) {
        $queryTime = $_GET['time'];
        if($queryTime == 'short') {
            $timeType = 'short_term';
        } else if($queryTime == 'medium') {
            $timeType = 'medium_term';
        } else if($queryTime == 'long') {
            $timeType = 'long_term';
        }
    }
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

    <?php
        if(isset($_GET['code'])) {
            $code = $_GET['code'];

            $url = "https://accounts.spotify.com/api/token";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
            "Authorization: Basic " . $spotifyAPIKey,
            "Content-Type: application/x-www-form-urlencoded",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = "code=" . $code . "&redirect_uri=" . $listifyRedirectURI . "&grant_type=authorization_code";

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            $respJson = json_decode($resp);
            curl_close($curl);
            
            if(isset($respJson->error)) {
                ?>

    <div class="errorNotification">
        Ocorreu um erro durante o carregamento das suas informações. <a href=""><b>Voltar para o login.</b></a>
        (<?php echo($respJson->error) ?>)
    </div>

    <?php
            } else {
                header('Location: ./?access-token=' . $respJson->access_token);
                exit();
            }
            return;
        } else if(!isset($_GET['access-token'])) {
            //echo('causa 1');
            header('Location: ../');
            exit();
        }

        $accessToken = $_GET['access-token'];
        $playerJson = getUserPlayer($accessToken);

        if(isset($playerJson->is_playing) && $playerJson->is_playing == true) {
            $deviceActive = $playerJson->device->is_active;
            $deviceName = "-";
            if($deviceActive == true) {
                $deviceName = $playerJson->device->name;
            }

            $songName = $playerJson->item->name;

            $songImageUrl = $playerJson->item->album->images[0]->url;

            $songAuthorName = $playerJson->item->album->artists[0]->name;
    ?>
    <div class="listeningNotification">
        <div class="top">
            <img class="song-image" src="<?php echo($songImageUrl) ?>" alt="">
            <div class="text">
                <span class="songName"><?php echo($songName) ?></span><br><span
                    class="songAuthor"><?php echo($songAuthorName) ?></span>
            </div>
        </div>
        <div class="bottom">
            <i class="fa fa-desktop" aria-hidden="true"></i> Em <span
                class="deviceName"><?php echo($deviceName) ?></span><br>
        </div>
    </div>

    <?php
        }
    ?>

    <div class="pageContent">
        <div class="top">
            <?php
                $userInformation = getUserInformation($accessToken);
                if(isset($userInformation->error)) {
                    header('Location: ../');
                    exit();
                }

                $userName = $userInformation->display_name;
                $userName = explode(" ", $userName)[0];
            ?>
            <h2><span id="randomGreeting">E aí</span>, <b><?php echo($userName); ?></b>! &#128075</h2>
            Você está conectado com <b>Spotify</b>. <span class="disconnect">Sair</span><br><br>

            <div class="timeSelector">
                <ul>
                    <li <?php if($timeType == 'short_term') {?> class="selected" <?php } ?>> <a
                            href="./?access-token=<?php echo($accessToken) ?>&time=short">1 mês</a></li>
                    <li <?php if($timeType == 'medium_term') {?> class="selected" <?php } ?>> <a
                            href="./?access-token=<?php echo($accessToken) ?>&time=medium">6 meses</a></li>
                    <li <?php if($timeType == 'long_term') {?> class="selected" <?php } ?>> <a
                            href="./?access-token=<?php echo($accessToken) ?>&time=long">Todo o Tempo</a></li>
                </ul>
            </div>

            Confira suas estatísticas
            abaixo! ;)

        </div>

        <hr>

        <div class="centerContent">
            <?php
                $topArtists = getUserTOPArtists($accessToken, $timeType);
                if(isset($topArtists)) {
                    if(isset($topArtists->error)) {
                        header('Location: ../');
                        exit();
                    }

                    $artistName = $topArtists->items[0]->name;
                    $artistImage = $topArtists->items[0]->images[0]->url;
            ?>

            <div class="listenedArtist">
                <img src="<?php echo($artistImage) ?>" alt="Most Listened Artist">
                <br><span class="artistName"><?php echo($artistName) ?></span>
                <br><span class="artistDescription">é o seu artista mais ouvido.</span>
                <br>
                <button id="topartist" class="viewAllButton">
                    Ver Mais <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>

            <?php
                } else {
            ?>
            <div class="listenedArtist">
                <img src="../images/unknown.jpg" alt="Most Listened Artist">
                <br><span class="artistName">desconhecido</span>
                <br><span class="artistDescription">não há informações sobre o seu artista mais ouvido.</span>
            </div>
            <?php

                }
            ?>

            <?php
                $topTracks = getUserTOPTracks($accessToken, $timeType);
                if(isset($topTracks)) {
                    if(isset($topTracks->error)) {
                        header('Location: ../');
                        exit();
                    }
                    $trackName = $topTracks->items[0]->name;
                    $trackImage = $topTracks->items[0]->album->images[0]->url;
                    $trackAuthor = $topTracks->items[0]->album->artists[0]->name;
            ?>
            <div class="listenedSong">
                <img class="songImage" src="<?php echo($trackImage) ?>" alt="Most Listened Song">
                <br><span class="songName"><?php echo($trackName) ?></span> de <span
                    class="songName"><?php echo($trackAuthor) ?></span>
                <br><span class="songDescription">é a sua música mais tocada.</span>
                <br>
                <button id="topsong" class="viewAllButton">
                    Ver Mais <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
            <?php
                } else {
            ?>

            <div class="listenedSong">
                <img class="songImage" src="../images/unknown.jpg" alt="Most Listened Artist">
                <br><span class="songName">desconhecido</span>
                <br><span class="songDescription">não há informações sobre a sua música mais tocada.</span>
            </div>

            <?php
                }
            ?>

            <?php
                $userPlaylists = getUserPlaylists($accessToken); ?> <br><br> <?php
                if(isset($userPlaylists->total) && $userPlaylists->total > 0) {
            ?>
            <div class="userPlaylists">
                <br><span class="playlistsAmount"><?php echo($userPlaylists->total); ?> playlists</span>
                <br><span class="playlistsDescription">suas ou seguindo.</span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="footer">
        Desenvolvido por <span class="footer-clarify">Gustavo Antonio</span><br>
        <a href="https://www.instagram.com/ogustavo.a/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://twitter.com/ogustavo_a"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://github.com/SrPattif"><i class="fa fa-github" aria-hidden="true"></i></a><br>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    var topArtist = document.getElementById('topartist');
    topArtist.addEventListener('click', () => {
        window.location.href =
            '<?php echo($listifyDomain); ?>/user/topartist/?access-token=<?php echo($accessToken); ?><?php if(isset($queryTime)) { ?>&time=<?php echo($queryTime); }?>';
    });

    var topSong = document.getElementById('topsong');
    topSong.addEventListener('click', () => {
        window.location.href =
            '<?php echo($listifyDomain); ?>/user/topsongs/?access-token=<?php echo($accessToken); ?><?php if(isset($queryTime)) { ?>&time=<?php echo($queryTime); }?>';
    });
    </script>

    <script>
    $(document).ready(function() {
        const random = ["E aí", "Salve", "Oi", "Olá", "day-time"]
        var greeting = random[Math.floor(Math.random() * random.length)];

        if (greeting == 'day-time') {
            var d = new Date();
            var hour = d.getHours();

            if (hour < 5) {
                greeting = "Boa noite";
            } else if (hour < 8) {
                greeting = "Bom dia";
            } else if (hour < 12) {
                greeting = "Bom dia";
            } else if (hour < 18) {
                greeting = "Boa tarde";
            } else {
                greeting = "Boa noite";
            }
        }

        $(randomGreeting).text(greeting);
    });
    </script>
</body>

</html>