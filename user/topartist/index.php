<?php
    require('../../controllers/spotifyPlayer.php');
    require('../../controllers/spotifyTop.php');
    require('../../controllers/spotifyUser.php');
    require('../../controllers/spotifyArtists.php');
    require('../../controllers/settings.php');
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
        if(!isset($_GET['access-token'])) {
            header('Location: ../../');
            exit();
        }

        $accessToken = $_GET['access-token'];
        $playerJson = getUserPlayer($accessToken);

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
            <a href="<?php echo($listifyDomain); ?>/user/?access-token=<?php echo($accessToken); ?><?php if(isset($queryTime)) { ?>&time=<?php echo($queryTime); }?>"
                class="return"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a><br><br>
            <?php
                $topArtists = getUserTOPArtists($accessToken, $timeType);
                if(isset($topArtists)) {
                    if(isset($topArtists->error)) {
                        header('Location: ./');
                        exit();
                    }

                    $artistName = $topArtists->items[0]->name;
                    $artistID = $topArtists->items[0]->id;
                    $artistImage = $topArtists->items[0]->images[0]->url;
                    $artistURI = $topArtists->items[0]->uri;
            ?>
            <img class="artistImage" src="<?php echo($artistImage) ?>" alt="">
            <h2><?php echo($artistName) ?></h2>
            é o seu artista mais ouvido<?php
            if($timeType == "long_term") {
                ?>!
            <?php
            } else if($timeType == "medium_term") {
                ?>
            nos últimos <span>6 meses</span>!
            <?php
            } else if($timeType == "short_term") {
                ?>
            no <span>último mês</span>!
            <?php
            }
            ?>
            <?php
                } else {
                    header('Location: ./');
                    exit();
                }
            ?>
            <br> <br>
            <a href="<?php echo($artistURI); ?>"><button class="spotify-view-button" id="spotify-view-button">
                    <i class="fa fa-spotify" aria-hidden="true"></i> Ver no <span>Spotify</span>
                </button></a>
            <br>
            <a href="./share/?access-token=<?php echo($accessToken); ?><?php if(isset($queryTime)) { ?>&time=<?php echo($queryTime); }?>"><button class="share-button" id="share-button">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> Compartilhar
                </button></a>
        </div>
        <br>
        <hr>

        <div class="centerContent">
            <div class="artistsList">
                <?php
                    for($i = 0; $i < 10; $i++) {
                        $topName = $topArtists->items[$i]->name;
                        $topImage = $topArtists->items[$i]->images[0]->url;

                        ?>
                <div class="artistItem">
                    <div class="title">
                        <span class="position"><?php echo($i + 1); ?>º Lugar</span>
                    </div>
                    <br>
                    <img src="<?php echo($topImage); ?>" alt="<?php echo($i + 1); ?>º Lugar">
                    <br>
                    <p class="topArtistName"><?php echo($topName); ?><br></p>
                </div>
                <?php
                    }
                ?>
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
</body>

</html>