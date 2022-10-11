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
    if (!isset($_GET['access-token'])) {
        header('Location: ../../');
        exit();
    }

    $accessToken = $_GET['access-token'];
    $playerJson = getUserPlayer($accessToken);

    $queryTime = '';
    $timeType = 'long_term';

    if (isset($_GET['time'])) {
        $queryTime = $_GET['time'];
        if ($queryTime == 'short') {
            $timeType = 'short_term';
        } else if ($queryTime == 'medium') {
            $timeType = 'medium_term';
        } else if ($queryTime == 'long') {
            $timeType = 'long_term';
        }
    }

    if (isset($playerJson->is_playing) && $playerJson->is_playing == true) {
        $deviceActive = $playerJson->device->is_active;
        $deviceName = "-";
        if ($deviceActive == true) {
            $deviceName = $playerJson->device->name;
        }

        $songName = $playerJson->item->name;

        $songImageUrl = $playerJson->item->album->images[0]->url;

        $songAuthorName = $playerJson->item->album->artists[0]->name;
    ?>
    <div class="listeningNotification">
        <div class="top">
            <img class="song-image" src="<?php echo ($songImageUrl) ?>" alt="" crossorigin="anonymous">
            <div class="text">
                <span class="songName"><?php echo ($songName) ?></span><br><span
                    class="songAuthor"><?php echo ($songAuthorName) ?></span>
            </div>
        </div>
        <div class="bottom">
            <i class="fa fa-desktop" aria-hidden="true"></i> Em <span
                class="deviceName"><?php echo ($deviceName) ?></span><br>
        </div>
    </div>

    <?php
    }
    ?>

    <div class="pageContent">
        <div class="top">
            <a href="<?php echo ($listifyDomain); ?>/user/?access-token=<?php echo ($accessToken); ?><?php if (isset($queryTime)) { ?>&time=<?php echo ($queryTime);
                                                                                                                                        } ?>"
                class="return"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a><br><br>

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

            <?php
            $topTracks = getUserTOPTracks($accessToken, $timeType);
            if (isset($topTracks)) {
                if (isset($topTracks->error)) {
                    header('Location: ./');
                    exit();
                }

                $songName = $topTracks->items[0]->name;
                $songAuthor = $topTracks->items[0]->album->artists[0]->name;
                //$artistID = $topTracks->items[0]->id;
                $songImage = $topTracks->items[0]->album->images[0]->url;
                $songUri = $topTracks->items[0]->uri;
            ?>
            <img class="artistImage" src="<?php echo ($songImage) ?>" alt="" crossorigin="anonymous">
            <h2><?php echo ($songName) ?> de <?php echo ($songAuthor) ?></h2>
            é a sua música mais ouvida<?php
                                            if ($timeType == "long_term") {
                                            ?>!
            <?php
                                            } else if ($timeType == "medium_term") {
            ?>
            nos últimos <span>6 meses</span>!
            <?php
                                            } else if ($timeType == "short_term") {
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
            <a href="<?php echo ($songUri); ?>">
                <button class="spotify-view-button" id="spotify-view-button">
                    <i class="fa fa-spotify" aria-hidden="true"></i> Ver no <span>Spotify</span>
                </button>
            </a>
            <br>
        </div>
        <br>

        <div class="centerContent">
            <div id="imageGenerated">
                <div class="imageContainer" id="imgContainer">
                    <div class="imgContent" id="imgContent">

                        <?php
                        $topTracks = getUsertopTracks($accessToken, $timeType);
                        $userInformation = getUserInformation($accessToken);
                        if (isset($userInformation->error)) {
                            header('Location: ../');
                            exit();
                        }

                        $userName = $userInformation->display_name;
                        $userName = explode(" ", $userName)[0];
                        if (isset($topTracks)) {
                            if (isset($topTracks->error)) {
                                header('Location: ./');
                                exit();
                            }

                            $songName = $topTracks->items[0]->name;
                            $songAuthor = $topTracks->items[0]->album->artists[0]->name;
                            //$artistID = $topTracks->items[0]->id;
                            $songImage = $topTracks->items[0]->album->images[0]->url;
                            $songUri = $topTracks->items[0]->uri;
                        ?>

                        <img class="mostListenedImage" src="<?php echo ($songImage); ?>"
                            alt="<?php echo ($songName); ?>" crossorigin="anonymous">

                        <br>
                        <h2 class="songName"><?php echo ($songName); ?></h2>
                        <h4 class="artistName">de <span class="bold"><?php echo ($songAuthor); ?></span></h1>
                            <span class="artistDescription">é a música mais ouvida de <span class="userName"
                                    id="usernameSpan"><?php echo ($userName); ?></span><?php
                                if ($timeType == "long_term") {
                            ?>!

                                <?php
                                } else if ($timeType == "medium_term") {
                            ?>

                                <br>nos últimos <span class="bold">6 meses</span>!

                                <?php
                                } else if ($timeType == "short_term") {
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
                                    <th>Música</th>
                                </tr>
                                <?php
                            for ($i = 0; $i < 10; $i++) {
                                $songName = $topTracks->items[$i]->name;
                                $songAuthor = $topTracks->items[$i]->album->artists[0]->name;
                                //$artistID = $topTracks->items[$i]->id;
                                $songImage = $topTracks->items[$i]->album->images[0]->url;
                                $songUri = $topTracks->items[$i]->uri;
                            ?>
                                <tr>
                                    <td class="bold"><?php echo ($i + 1); ?>º</td>
                                    <td>
                                        <div class="songImage">
                                            <img src="<?php echo ($songImage); ?>" alt="<?php echo ($songName); ?>"
                                                crossorigin="anonymous">
                                            <i class="fa fa-play" aria-hidden="true"
                                                onclick="changeTrack('<?php echo($songUri); ?>', '<?php echo($accessToken); ?>')"></i>
                                        </div>

                                    </td>

                                    <td><span class="bold"><?php echo ($songName); ?></span> de
                                        <?php echo ($songAuthor); ?>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>
                            </table>
                            <br>
                            <span class="listifyInfo">Crie e compartilhe o seu!</span>
                            <br>
                            <span class="listifyUrl"><b>listify.payoo.com.br</b></span>
                    </div>
                </div>
            </div>

            <br>

            <div class="centerContent">
                <a>
                    <button class="share-button" id="shareButton">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> Compartilhar Imagem
                    </button></a>

                <hr>

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
                <br>
                <span class="bold">Quer mudar o seu nome?</span><br>

                <input class="changeNameInput" id="nameInput" value="<?php echo ($userName); ?>" type="text">
            </div>
        </div>
    </div>

    <div class="footer">
        Desenvolvido por <span class="footer-clarify">Gustavo Antonio</span><br>
        <a href="https://www.instagram.com/ogustavo.a/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://twitter.com/ogustavo_a"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://github.com/SrPattif"><i class="fa fa-github" aria-hidden="true"></i></a><br>
    </div>

    <!--  SCRIPTS -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="../../libs/tatatoast/dist/tata.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"
        integrity="sha512-Qlv6VSKh1gDKGoJbnyA5RMXYcvnpIqhO++MhIM2fStMcGT9i2T//tSwYFlcyoRRDcDZ+TYHpH8azBBCyhpSeqw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    var nameInput = document.getElementById('nameInput');
    nameInput.addEventListener('input', () => {
        var value = nameInput.value;
        if (value.length < 20) {
            document.getElementById('usernameSpan').innerHTML = nameInput.value;
        }
    });
    </script>

    <script>
    document.getElementById("shareButton").addEventListener("click", downloadImage);

    function downloadImage() {

        domtoimage.toJpeg(document.getElementById('imgContent'))
            .then(function(dataUrl) {
                var link = document.createElement('a');
                link.download = 'seu-top-musicas.jpeg';
                link.href = dataUrl;
                link.click();
            }).catch((err) => {
                tata.error('Erro ao Salvar :(', 'Ocorreu um erro ao salvar a imagem.', {
                    duration: 6000
                });
            });;

        /*
        domtoimage.toBlob(document.getElementById('imgContent')).then(function(blob) {
            window.saveAs(blob, "seu-top-musicas.png");
        }).catch((err) => {
            tata.error('Erro ao Salvar :(', 'Ocorreu um erro ao salvar a imagem.', {
                duration: 6000
            });
        });*/
    }
    </script>

    <script>
    var imgContent = document.getElementById('imgContent');
    var greenGradient = document.getElementById('greenGradient');
    var vanusaGradient = document.getElementById('vanusaGradient');
    var shiftyGradient = document.getElementById('shiftyGradient');
    var summerGradient = document.getElementById('summerGradient');

    greenGradient.addEventListener('click', () => {
        imgContent.style.background = "rgb(20, 110, 51)";
        imgContent.style.background =
            "linear-gradient(145deg, rgba(20, 110, 51, 1) 0%, rgba(22, 129, 59, 1) 49%, rgba(29, 185, 84, 1) 100%)";

        greenGradient.classList.add("selected");
        vanusaGradient.classList.remove("selected");
        shiftyGradient.classList.remove("selected");
        summerGradient.classList.remove("selected");
    });

    vanusaGradient.addEventListener('click', () => {
        imgContent.style.background = "rgb(137, 33, 107)";
        imgContent.style.background =
            "linear-gradient(145deg, rgba(137, 33, 107, 1) 0%, rgba(218, 68, 83, 1) 100%)";

        greenGradient.classList.remove("selected");
        vanusaGradient.classList.add("selected");
        shiftyGradient.classList.remove("selected");
        summerGradient.classList.remove("selected");
    });

    shiftyGradient.addEventListener('click', () => {
        imgContent.style.background = "rgb(162, 171, 88)";
        imgContent.style.background =
            "linear-gradient(145deg, rgba(162, 171, 88, 1) 0%, rgba(99, 99, 99, 1) 100%)";

        greenGradient.classList.remove("selected");
        vanusaGradient.classList.remove("selected");
        shiftyGradient.classList.add("selected");
        summerGradient.classList.remove("selected");
    });

    summerGradient.addEventListener('click', () => {
        imgContent.style.background = "rgb(255,0,14)";
        imgContent.style.background = "linear-gradient(145deg, rgba(255,0,14,1) 0%, rgba(115,208,91,1) 100%)";

        greenGradient.classList.remove("selected");
        vanusaGradient.classList.remove("selected");
        shiftyGradient.classList.remove("selected");
        summerGradient.classList.add("selected");
    });
    </script>

    <script>
    function changeTrack(uri, accessToken) {
        console.log('Trying to change tracks...');

        var settings = {
            "url": "https://api.spotify.com/v1/me/player/play",
            "method": "PUT",
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer " + accessToken,
                "Content-Type": "application/json"
            },
            "data": JSON.stringify({
                "uris": [
                    uri
                ],
                "position_ms": 0
            }),
        };

        $.ajax(settings).done(function(response) {
            tata.success('Pronto!', 'A música já deve estar tocando. Aproveita :)', {
                duration: 6000
            });
        });
    }
    </script>
</body>

</html>