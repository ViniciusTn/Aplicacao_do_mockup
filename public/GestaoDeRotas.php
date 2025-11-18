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

    <!-- ========== CSS INTEGRADO (ESTILO VAITREM) ========== -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #0f243c);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        /* BOTÃO VOLTAR */
        .buttonVoltar {
            background: rgba(255,255,255,0.08);
            border: none;
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            margin: 20px;
            transition: .25s;
        }

        .buttonVoltar img {
            width: 28px;
        }

        .buttonVoltar:hover {
            background: rgba(255, 210, 54, 0.25);
            box-shadow: 0 0 15px rgba(255,210,54,0.4);
        }

        /* TÍTULO */
        h1 {
            text-align: center;
            margin-bottom: 15px;
        }

        .Teste h1 {
            color: #ffd236;
            font-size: 32px;
            letter-spacing: 1px;
        }

        /* CONTAINER PRINCIPAL */
        .Container {
            width: 90%;
            max-width: 500px;
            margin: 20px auto;
            background: rgba(255,255,255,0.07);
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 0 18px rgba(255, 210, 54, 0.15);
        }

        .LinhaChuva {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .LinhaChuva h1 {
            color: #ffd236;
            font-size: 26px;
        }

        .Alerta2 {
            width: 45px;
            filter: drop-shadow(0 0 6px rgba(255,210,54,0.6));
        }

        .TelaLinha img {
            width: 85%;
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.15));
        }

        /* CARDS DE AÇÃO */
        .botao-div {
            text-decoration: none;
            width: 100%;
            display: block;
            margin: 15px auto;
        }

        .conteudo-botao {
            width: 100%;
            padding: 18px;
            background: rgba(255,255,255,0.08);
            border-radius: 15px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.15);
            transition: 0.25s;
            backdrop-filter: blur(10px);
        }

        .conteudo-botao h1 {
            margin: 0;
            font-size: 22px;
        }

        .botao-div:hover .conteudo-botao {
            background: rgba(255,255,255,0.16);
            transform: translateY(-4px);
            box-shadow: 0 0 15px rgba(255,210,54,0.5);
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 25px;
            margin-top: auto;
            opacity: 0.8;
        }

        footer h3 {
            font-weight: 400;
        }

        /* SUAVE */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        main {
            animation: fadeIn .4s ease-in-out;
        }
    </style>
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
            <a href="#" class="botao-div">
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

</body>
</html>
