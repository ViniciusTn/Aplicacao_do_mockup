<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../public/login.php");
    exit();
}
include '../db.php';

// Fetch funcionarios
$result = $conn->query("SELECT f.*, u.nome, u.email FROM Funcionario f JOIN Usuario u ON f.id_usuario = u.id_usuario");
$funcionarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Style.css">
    <link rel="stylesheet" href="../styles/style_menu.css">
    <script src="../scripts/ButtonValidators.js"></script>
    <script src="../scripts/gerenciadorFuncionarios.js"></script>
    <title>Gerenciador de funcionarios</title>
</head>
<body>

    <header id="gerDeFuncionarios">
        <button onclick= "window.location.href='../public/menuInicial.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
        </button>
        <br>


<div id="textBuscar">
    <h1 id="sizeTextBuscar">Buscar Funcionário</h1>
    <div class="pesquisar">

        <input type="text" id="inputBusca" placeholder="nome funcionário..." oninput="buscar()" />

        <img id="lupa" src="../assets/imgs/Pesquisar.png" alt="Pesquisar" />

    </div>
</div>
    </header>

<main id="alinhamentoDoBotao">
    <div id="Adicionar">
        <button type="button" id="botaoAddFuncionario" onclick="window.location.href='addFuncionarioTela.php'">
            <div class="conteudoBotao">
                <img src="../assets/imgs/Mais.png" alt="ícone de adicionar" class="iconeMais">
                <p>Editar ou Adicionar Funcionários</p>
            </div>
        </button>
    </div>


    <div class="scroll">
        <div>
        <div class="nav">
        <div class="gerenciador">
            <?php foreach ($funcionarios as $func): ?>
            <div class="nav">
                <div>
                <img src="<?php echo $func['imagem'] ?: '../assets/imgs/Homem1.png'; ?>" class="funcionariano" alt="<?php echo $func['nome']; ?>: <?php echo $func['funcao']; ?>">
                </div>
                <h1> <?php echo $func['nome']; ?>: <?php echo $func['funcao']; ?></h1>
                </div>
            <?php endforeach; ?>
         </div>
        </div>
        </div>
    </div>
</main>

    <footer>
        <br>
        <div class="direitos">
        <h3> © 2025 VAITREM. All rights reserved.</h3>
        </div>
    </footer>

</body>
</html>
