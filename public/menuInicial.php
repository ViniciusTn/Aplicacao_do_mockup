<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Inicial</title>
    <link rel="stylesheet" href="../styles/menu.css">
</head>
<body>
    <header>
        <div id="navbar">
            <div id="titulo">
                <div class="flex">
                    <h1>VAITREM.</h1>
                    <img id="logo" src="../assets/icons/vaiTremLogo.png" alt="">
                </div>
            </div>
        </div>

    </header>

    <main>
        <div id="corpo">
            <div class="flex">
                <div class="app">

                    <a href="Dashboard.php">
                        <img class="icone" src="../assets/icons/D.png" alt="D" />
                    </a>

                    <p><strong>DashBoard</strong></p>
                </div>

                <div id="rota">

                    <a href="GestaoDeRotas.php">
                        <img class="icone" src="../assets/icons/trem.png" alt="TREM" />
                    </a>

                    <p><strong>G. de Rotas</strong></p>
                </div>
            </div>

            <div class="flex">
                <div id="usuarioCorpo">

                    <a href="../private/gerenciadorFuncionarios.php">
                        <img class="icone" src="../assets/icons/usuario.png" alt="USUARIO" />
                    </a>

                    <p><strong>G. de <br>Funcionarios</strong></p>
                </div>

                <div id="relatorioCorpo">

                    <a href="relatorios.php">
                        <img id="relatorio" src="../assets/icons/relatorio.png" alt="RELATORIO" />
                    </a>

                    <p><strong>Relatorio</strong></p>
                </div>
            </div>

            <div class="notificacoes">
                <div id="notif">
                    <p><strong>NOTIFICAÇÃO</strong></p>

                </div>
                <img id="iconNotif" src="../assets/icons/Notificacao.png" alt="" />
            </div>
        </div>
    </main>

    <footer>

    </footer>

</body>
</html>
