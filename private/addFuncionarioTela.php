<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../public/login.php");
    exit();
}
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Processa upload da imagem
    $imagem = '../assets/imgs/Homem1.png'; // padrão
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novo_nome = uniqid('funcionario_') . '.' . $ext;
        $destino = '../assets/imgs/' . $novo_nome;
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            $imagem = $destino;
        }
    }

    if (empty($nome) || empty($funcao) || empty($email) || empty($senha)) {
        $error = "Preencha todos os campos.";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO Usuario (nome, email, senha, tipo) VALUES (?, ?, ?, 'funcionario')");
        $stmt->bind_param("sss", $nome, $email, $senha_hash);
        if ($stmt->execute()) {
            $id_usuario = $conn->insert_id;
            $stmt2 = $conn->prepare("INSERT INTO Funcionario (id_usuario, funcao, imagem) VALUES (?, ?, ?)");
            $stmt2->bind_param("iss", $id_usuario, $funcao, $imagem);
            $stmt2->execute();
            $stmt2->close();
            header("Location: gerenciadorFuncionarios.php");
            exit();
        } else {
            $error = "Erro: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Funcionários</title>

    <!-- CSS integrado -->
    <style>
        :root {
            --amarelo: #FFD740;
            --amarelo-escuro: #e6c237;
            --cinza-claro: #f5f5f5;
            --cinza-medio: #dcdcdc;
            --cinza-escuro: #4a4a4a;
            --preto: #222;
            --radius: 14px;
            --shadow: 0px 4px 12px rgba(0, 0, 0, 0.12);
        }

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--cinza-claro);
            padding: 20px;
            color: var(--preto);
        }

        header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--preto);
        }

        .buttonVoltar img {
            width: 42px;
        }

        #Adicionar {
            margin-bottom: 30px;
            display: flex;
            justify-content: flex-start;
        }

        #botaoAddFuncionario {
            background: var(--amarelo);
            border: none;
            border-radius: var(--radius);
            padding: 14px 22px;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: 0.25s ease;
        }

        #botaoAddFuncionario:hover {
            background: var(--amarelo-escuro);
            transform: translateY(-2px);
        }

        #botaoAddFuncionario .conteudoBotao {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 600;
            color: var(--preto);
        }

        #botaoAddFuncionario img {
            width: 28px;
        }

        #formFuncionario {
            background: white;
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            max-width: 540px;
        }

        #formFuncionario label {
            font-weight: 600;
            color: var(--preto);
            display: block;
            margin-bottom: 6px;
            margin-top: 12px;
        }

        #formFuncionario input {
            width: 100%;
            padding: 12px;
            border-radius: var(--radius);
            border: 1px solid var(--cinza-medio);
            outline: none;
            transition: 0.2s;
            background: #fff;
        }

        #formFuncionario input:focus {
            border-color: var(--amarelo);
            box-shadow: 0 0 0 2px rgba(255, 215, 64, 0.3);
        }

        .botoes {
            display: flex;
            justify-content: space-between;
            margin-top: 18px;
        }

        .botoes button {
            flex: 1;
            margin: 5px;
            padding: 12px 10px;
            border: none;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .botoes button[type="submit"] {
            background: var(--amarelo);
            color: var(--preto);
            box-shadow: var(--shadow);
        }

        .botoes button[type="submit"]:hover {
            background: var(--amarelo-escuro);
            transform: translateY(-2px);
        }

        .botoes button[type="button"] {
            background: var(--cinza-escuro);
            color: white;
        }

        .botoes button[type="button"]:hover {
            background: #333;
            transform: translateY(-2px);
        }

        #listaFuncionarios {
            margin-top: 40px;
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            max-width: 700px;
        }

        #listaFuncionarios p {
            font-size: 17px;
            padding: 12px 0;
            border-bottom: 1px solid var(--cinza-medio);
            font-weight: 500;
        }

        #listaFuncionarios p:last-child {
            border-bottom: none;
        }
    </style>

    <!-- scripts originais -->
    <script src="../scripts/gerenciadorFuncionarios.js"></script>
    <script src="../scripts/ButtonValidators.js"></script>
</head>

<body>
    <header>
        <button onclick="window.location.href='gerenciadorFuncionarios.php'" class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Botão voltar" />
        </button>
        <h1>Lista de Funcionários</h1>
    </header>

    <div id="Adicionar">
        <button type="button" id="botaoAddFuncionario" onclick="window.location.href='addFuncionarioTela.php'">
            <div class="conteudoBotao">
                <img src="../assets/imgs/Mais.png" class="iconeMais" />
                <p>Adicionar novo funcionário</p>
            </div>
        </button>
    </div>

    <form id="formFuncionario" method="POST" action="addFuncionarioTela.php" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required />

        <label for="funcao">Função:</label>
        <input type="text" id="funcao" name="funcao" required />

        <label for="imagem">Foto de perfil:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" />

        <div class="botoes">
            <button type="submit">Adicionar</button>
            <button type="button" onclick="window.location.href='gerenciadorFuncionarios.php'">Cancelar</button>
        </div>
    </form>

    <div id="listaFuncionarios">
        <?php
        $result = $conn->query("SELECT f.*, u.nome FROM Funcionario f JOIN Usuario u ON f.id_usuario = u.id_usuario");
        while ($func = $result->fetch_assoc()) {
            echo "<p>" . $func['nome'] . " - " . $func['funcao'] . "</p>";
        }
        ?>
    </div>

</body>
</html>
