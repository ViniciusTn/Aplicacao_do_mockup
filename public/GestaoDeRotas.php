<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch some viagem or estacao
$result = $conn->query("SELECT * FROM Estacao LIMIT 1");
$estacao = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Rotas - VAITREM</title>
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

    <link rel="stylesheet" href="../styles/GestaoDeRotas.css">
</head>

<body>

<header>
    <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar">
        <img src="../assets/icons/botaoVoltar.png" alt="Voltar" />
    </button>
</header>

<main>
    <div class="Teste">
        <h1>Gestão de Rotas</h1>

        <!-- CARD LINHA -->
        <div class="Container">
            <div class="LinhaChuva">
                <h1>Linha 3</h1>
                <img class="Alerta2" src="../assets/imgs/Alerta.png" alt="">
            </div>

            <div class="TelaLinha">
                <img class="imagemrotas" src="../assets/imgs/gestaoderotas.png" alt="">
            </div>

            <h1>Chuvoso</h1>
        </div>

        <!-- OPÇÕES -->

        <div class="Defeito">
            <div class="flex">
                <a href="#" class="botao-div">
                    <div class="conteudo-botao">
                        <strong><h1>Defeito no Trilho</h1></strong>
                    </div>
                </a>
                <img class="Alerta2" src="../assets/imgs/Alerta.png" alt="">
            </div>
        </div>

        <div class="ContatarMaquinista">
            <a onclick="abrirChat()" class="botao-div">
                <div class="conteudo-botao">
                    <strong><h1>Contatar Maquinista</h1></strong>
                </div>
            </a>
        </div>

        <div class="AlterarRota">
            <a href="#" class="botao-div">
                <div class="conteudo-botao">
                    <strong><h1>Alterar Rota</h1></strong>
                </div>
            </a>
        </div>
    </div>
</main>

<footer>
    <div class="direitos">
        <h3>© 2025 VAITREM. All rights reserved.</h3>
    </div>
</footer>

<!-- POPUP DE CHAT -->
<div id="popupChat" class="popup-chat">
    <div class="chat-container">
        <div class="chat-header">
            <h2>Comunicação com o Maquinista</h2>
            <button class="fecharChat" onclick="fecharChat()">X</button>
        </div>

        <div id="chatMensagens" class="chat-mensagens"></div>

        <div class="chat-input">
            <input type="text" id="mensagemInput" placeholder="Digite sua mensagem...">
            <button onclick="enviarMensagem()">Enviar</button>
        </div>
    </div>
</div>

<script>
function abrirChat() {
    document.getElementById("popupChat").style.display = "flex";
}

function fecharChat() {
    document.getElementById("popupChat").style.display = "none";
}

function enviarMensagem() {
    let campo = document.getElementById("mensagemInput");
    let texto = campo.value.trim();
    if (texto === "") return;

    let chat = document.getElementById("chatMensagens");

    // Mensagem do usuário
    let msgUser = document.createElement("div");
    msgUser.classList.add("msg", "msg-user");
    msgUser.textContent = texto;
    chat.appendChild(msgUser);

    campo.value = "";

    // Resposta automática (simulação)
    setTimeout(() => {
        let msgSistema = document.createElement("div");
        msgSistema.classList.add("msg", "msg-sistema");
        msgSistema.textContent = "Mensagem enviada ao maquinista!";
        chat.appendChild(msgSistema);
        chat.scrollTop = chat.scrollHeight;
    }, 500);

    chat.scrollTop = chat.scrollHeight;
}
</script>

</body>
</html>
