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
        <h2>Guia de transparência e dados coletados</h2>
        <div class="central-message">
            Na Listify, a segurança dos seus dados e dispositivos é muito importante.<br>
            Por isso, queremos que você tenha um bom entendimento sobre o que fazemos depois que você clica em <span
                class="bold">Autorizar</span>, logado com a sua conta do Spotify.

            <hr>

            <h2>Quais autorizações nós pedimos?</h2>
            <h3>Na hora de autorizar, você vai perceber que nós pedimos essas permissões aqui:</h3>
            <br><span class="bold">Ver o seu email</span> — A gente só usa pra você ver se a conta é realmente sua, ou
            se você logou na do seu amigo!
            <br><span class="bold">Ver o tipo de sua assinatura</span> — É só pra mostrar se você é premium ou não, lá
            na página inicial ou na imagem que você gera pra postar nos stories e fazer inveja no crush.
            <br><span class="bold">O seu nome de usuário, foto de perfil e suas playlists</span> — Esse aqui é pra
            mostrar o seu nome e foto lá no início e nas imagem de compartilhamento, mas você pode tirar se quiser. E as
            playlists é só pra mostrar quantas você tem.
            <br>
            <br>
            <h3>Essas aqui também podem parecer um pouco estranhas, mas fica tranquilo:</h3>
            <br><span class="bold">Conteúdo que você escuta e informações dos dispositivos</span> — Esse é só pra
            mostrar se você ta escutando alguma coisa e em qual dispositivo é. Aparece lá em cima do site!
            <br><span class="bold">O conteúdo salvo na Sua Biblioteca</span> — É só pra ver quantas playlists você tem e
            quais músicas você ta escutando bastante.
            <br><span class="bold">Os artistas e o conteúdo que você mais escuta</span> — Esse é óbvio, é pra listar os
            artistas e conteúdos que você mais escuta! 🤯
            <br><span class="bold">Os usuários que você segue no Spotify</span> — É só pra ver se você é de verdade e
            segue o meu pai no Spotify. <br>brincadeira heheheh é só pra ver se você segue o seu artista mais ouvido (é
            o mínimo, né??)
            <br>
            <br>
            <h3>EU SEI, PARECE QUE EU QUERO HACKEAR O SEU PC MAS EU JURO QUE DA PRA EXPLICAR:</h3>
            <br><span class="bold">Controlar o Spotify nos seus dispositivos</span> — Não vou tocar Galinha Pintadinha
            pra você na madrugada, ta????? Esse aqui serve só pra tocar as músicas quando você passar o mouse em cima ou
            clicar com o dedo da imagem da música lá no top de músicas!
            <br>
            <br>
            <hr>
            <br>Espero que você tenha entendido o que ta acontecendo depois de você me conceder todos os privilégios,
            que parecem meio estranhos.
            <br>Ah e, obrigado por escolher o Listify. Meu pai fica muito feliz :)
            <br>
            <div class="button">
                <div class="home-button" id="home-button">
                    <i class="fa fa-home" aria-hidden="true"></i> Voltar ao Início
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="urlShortcut">
            <a href="../">Início</a>
            |
            <a href="./">Transparência</a>
            |
            <a href="./privacy_policy/">Política de Privacidade</a>
        </p>

        Desenvolvido por Gustavo Antonio<br>
        <a href="https://www.instagram.com/ogustavo.a/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://twitter.com/ogustavo_a"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://github.com/SrPattif"><i class="fa fa-github" aria-hidden="true"></i></a>
        <br>
        <span>manda uma coisinha lá :)</span>
    </div>

    <script>
    var home = document.getElementById('home-button');

    home.addEventListener('click', () => {
        window.location.href = "../"
    })
    </script>
</body>

</html>