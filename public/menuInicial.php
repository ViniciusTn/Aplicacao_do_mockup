<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Inicial</title>
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
</head>
<body>
    <header>
        <div id="navbar">
            <div id="titulo">
                <div class="flex">
                    <h1>VAITREM.</h1>
                    <img id="logo" src="../assets/icons/vaiTremLogo.png" alt="Logo VAITREM">
                </div>
            </div>
            <div id="logout">
                <a href="../scripts/logout.php">Sair</a>
            </div>
        </div>
    </header>
    <main>
        <div id="corpo">
            <div class="flex">
                <div class="app">
                    <a href="dashboard.php">
                        <img class="icone" src="../assets/icons/D.png" alt="Dashboard">
                    </a>
                    <p><strong>Dashboard</strong></p>
                </div>
                <div id="rota">
                    <a href="GestaoDeRotas.php">
                        <img class="icone" src="../assets/icons/trem.png" alt="Gestão de Rotas">
                    </a>
                    <p><strong>G. de Rotas</strong></p>
                </div>
            </div>
            <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <div class="flex">
                <div id="addUsuario">
                    <a href="../private/addUsuario.php">
                        <img class="icone" src="../assets/icons/usuario.png" alt="Adicionar Usuário">
                    </a>
                    <p><strong>Adicionar Usuário</strong></p>
                </div>
            </div>
            <?php endif; ?>
            <div class="flex">
                <div id="usuarioCorpo">
                    <a id="usuarioCorpoText" href="../private/gerenciadorFuncionarios.php">
                        <img id="iconeGestaoFuncionario" src="../assets/icons/usuario.png" alt="Funcionários">
                    </a>
                    <p><strong>G. de <br>Funcionários</strong></p>
                </div>
                <div id="relatorioCorpo">
                    <a href="relatorios.php">
                        <img id="relatorio" src="../assets/icons/relatorio.png" alt="Relatórios">
                    </a>
                    <div id="relatoriotext"><p><strong>Relatórios</strong></p></div>
                </div>
            </div>
            <div class="notificacoes">
                <div id="notif">
                    <p><strong>Notificações</strong></p>
                </div>
                <img id="iconNotif" src="../assets/icons/Notificacao.png" alt="Notificações">
            </div>
        </div>
    </main>
    <footer>
        <div class="direitos">
            <h4>© 2025 VAITREM. All rights reserved.</h4>
        </div>
    </footer>
</body>
</html>
