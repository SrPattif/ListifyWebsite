<?php
    require('../../../controllers/spotifyPlayer.php');
    require('../../../controllers/spotifyTop.php');
    require('../../../controllers/spotifyUser.php');
    require('../../../controllers/spotifyArtists.php');
    require('../../../controllers/settings.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
            <a href="../?access-token=<?php echo($accessToken); ?><?php if(isset($queryTime)) { ?>&time=<?php echo($queryTime); }?>"
                class="return"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a><br><br>

            <div class="imageGenerated greenGradient" id="imageGenerated">
                <?php
                    $topArtists = getUserTOPArtists($accessToken, $timeType);
                    $userInformation = getUserInformation($accessToken);
                    if(isset($userInformation->error)) {
                        header('Location: ../');
                        exit();
                    }
    
                    $userName = $userInformation->display_name;
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
                <img crossorigin="anonymous" class="mostListenedImage" src="<?php echo($artistImage); ?>" alt="<?php echo($artistName); ?>">
                <br>
                <h2><?php echo($artistName); ?></h2>
                <span>é o artista mais ouvido de <span class="userName"><?php echo($userName); ?></span><?php
            if($timeType == "long_term") {
                ?>!
                    <?php
            } else if($timeType == "medium_term") {
                ?>
                    <br>nos últimos <span class="bold">6 meses</span>!
                    <?php
            } else if($timeType == "short_term") {
                ?>
                    <br>no <span class="bold">último mês</span>!
                    <?php
            }
            ?></span>
                <?php
                    }
                ?>
                <hr>
                <br>

                <table class="artistsList">
                    <tr>
                        <th>Posição</th>
                        <th> </th>
                        <th>Artista</th>
                    </tr>
                    <?php
                        for($i = 0; $i < 10; $i++) {
                            $artistName = $topArtists->items[$i]->name;
                            $artistID = $topArtists->items[$i]->id;
                            $artistImage = $topArtists->items[$i]->images[0]->url;
                    ?>
                    <tr>
                        <td><?php echo($i+1); ?></td>
                        <td><img crossorigin="anonymous" src="<?php echo($artistImage); ?>" alt="<?php echo($artistName); ?>"></td>
                        <td><?php echo($artistName); ?></td>
                    </tr>

                    <?php
                        }
                    ?>
                </table>
                <br>
                <span class="listifyInfo">Crie e compartilhe o seu!</span>
                <br>
                <span class="listifyUrl">listify.payoo.com.br</span>
            </div>

            <button class="share-button" id="shareButton">
                <i class="fa fa-picture-o" aria-hidden="true"></i> Compartilhar Imagem
            </button>
        </div>

        <br>
        <br>
        <hr>

        <div class="centerContent">
            <h2>Você pode customizar a sua imagem!</h2>
            <br>
            <span class="bold">Como você quer que o tema do fundo seja?</span><br>

            <div class="customSelect" style="width:200px;">
                <ul>
                    <li id="greenGradient" class="selected">Verde</a></li>
                    <li id="vanusaGradient">Vanusa</a></li>
                    <li id="shiftyGradient">Shifty</a></li>
                    <li id="summerGradient">Summer</a></li>
                </ul>
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

        <img id="captured" src="" alt="">
    </div>

    <script src="../../../libs/changeTheme.js"></script>
    <script src="../../../libs/shareButton.js"></script>
    <script src="../../../libs/html2canvas.js"></script>
    <script src="../../../libs/canvas-to-blob.min.js"></script>
</body>

</html>