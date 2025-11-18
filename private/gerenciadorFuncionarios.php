<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../public/login.php");
    exit();
}
include '../db.php';

$result = $conn->query("SELECT f.*, u.nome, u.email FROM Funcionario f JOIN Usuario u ON f.id_usuario = u.id_usuario");
$funcionarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Funcionários</title>

    <!-- CSS INTEGRADO -->
    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
            color: white;
        }

        header {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .buttonVoltar {
            background: transparent;
            border: none;
            cursor: pointer;
            margin-right: auto;
        }

        .buttonVoltar img {
            width: 45px;
            transition: 0.2s;
        }

        .buttonVoltar img:hover {
            transform: scale(1.1);
        }

        #textBuscar h1 {
            margin-bottom: 10px;
            font-size: 32px;
            color: #FFD60A;
            text-shadow: 0 0 10px #ffd60a88;
        }

        .pesquisar {
            position: relative;
            width: 330px;
        }

        .pesquisar input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border-radius: 12px;
            border: 1px solid #FFD60A;
            background: rgba(255, 214, 10, 0.06);
            backdrop-filter: blur(12px);
            color: white;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .pesquisar input:focus {
            box-shadow: 0 0 10px #FFD60A;
        }

        #lupa {
            position: absolute;
            right: 10px;
            top: 9px;
            width: 25px;
            opacity: 0.8;
        }

        /* Botão adicionar */
        #Adicionar {
            text-align: center;
            margin: 25px 0;
        }

        #botaoAddFuncionario {
            background: #FFD60A;
            border: none;
            padding: 14px 20px;
            border-radius: 14px;
            cursor: pointer;
            font-weight: bold;
            font-size: 17px;
            transition: 0.3s;
            box-shadow: 0 0 15px #ffd60a61;
        }

        #botaoAddFuncionario:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px #ffd60aa9;
        }

        .conteudoBotao {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .iconeMais {
            width: 25px;
        }

        /* LISTA DE FUNCIONÁRIOS */
        .scroll {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .gerenciador {
            margin-top: 15px;
            width: 90%;
            max-width: 700px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 214, 10, 0.4);
            border-radius: 16px;
            backdrop-filter: blur(18px);
            box-shadow: 0 0 15px #ffd60a44;
            transition: 0.3s;
        }

        .nav:hover {
            transform: scale(1.02);
            box-shadow: 0 0 25px #ffd60a77;
        }

        .funcionariano {
            width: 70px;
            height: 70px;
            border-radius: 14px;
            object-fit: cover;
            border: 2px solid #FFD60A;
        }

        .nav h1 {
            font-size: 19px;
            margin: 0;
        }

        footer {
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.04);
        }
    </style>

</head>
<body>

<header id="gerDeFuncionarios">
    <button onclick="window.location.href='../public/menuInicial.php'" class="buttonVoltar" type="button">
        <img src="../assets/icons/botaoVoltar.png" alt="Voltar">
    </button>

    <div id="textBuscar">
        <h1 id="sizeTextBuscar">Buscar Funcionário</h1>
        <div class="pesquisar">
            <input type="text" id="inputBusca" placeholder="nome funcionário..." oninput="buscar()">
            <img id="lupa" src="../assets/imgs/Pesquisar.png" alt="Pesquisar">
        </div>
    </div>
</header>


<main id="alinhamentoDoBotao">
    <div id="Adicionar">
        <button type="button" id="botaoAddFuncionario" onclick="window.location.href='addFuncionarioTela.php'">
            <div class="conteudoBotao">
                <img src="../assets/imgs/Mais.png" class="iconeMais">
                <p>Editar ou Adicionar Funcionários</p>
            </div>
        </button>
    </div>

    <div class="scroll">
        <div class="gerenciador">
            <?php foreach ($funcionarios as $func): ?>
                <div class="nav">
                    <img src="<?php echo $func['imagem'] ?: '../assets/imgs/Homem1.png'; ?>" class="funcionariano">
                    <h1><?php echo $func['nome']; ?> — <?php echo $func['funcao']; ?></h1>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</main>

<footer>
    <h3>© 2025 VAITREM. All rights reserved.</h3>
</footer>

</body>
</html>
