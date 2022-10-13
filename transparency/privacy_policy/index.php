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
        <h2>Política de Privacidade</h2>
        <div class="central-message">
            <div class="privacyContainer">
                A Listify utiliza dados de Spotify ("Spotify AB") do usuário e interpreta-os, gerando uma imagem
                compartilhável com o ranking de artistas e músicas do usuário. Em tal imagem, a imagem de perfil, nome
                de usuário e o tipo de assinatura também podem ser mostradas. A opção de compartilhamento é inteiramente
                opicional, sendo à escolha do usuário.
                <br>
                <br>
                Nenhum dado usado por Listify é salva ou coletada e não é compartilhada com outras empresas,
                coorporações ou indivíduos diretamente. A opção de compartilhamento é opicional e é dada por conta do
                usuário, através da geração de uma imagem de compartilhamento.
                <br>
                <br>
                É possível verificar o <a href="../">Guia de Transparência</a> para verificar como os dados dos usuários
                são utilizados. Se um usuário acreditar que o uso dos dados é malicioso, é possível desconectar a
                aplicação através <a href="https://support.spotify.com/us/article/spotify-on-other-apps/">deste
                    guia</a>.
            </div>

            <div class="button">
                <div class="home-button" id="home-button">
                    <i class="fa fa-home" aria-hidden="true"></i> Voltar ao Início
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
    var home = document.getElementById('home-button');

    home.addEventListener('click', () => {
        window.location.href = "../../"
    })
    </script>
</body>

</html>