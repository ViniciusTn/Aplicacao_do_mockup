<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../public/login.php");
    exit();
}
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
        $error = "Preencha todos os campos.";
    } else {
        $senha_hash = MD5($senha);
        $stmt = $conn->prepare("INSERT INTO Usuario (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $tipo);
        if ($stmt->execute()) {
            header("Location: ../public/menuInicial.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="../styles/Style.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
</head>
<body>
    <header class="header_login">
        <button onclick="window.location.href='../public/menuInicial.php'" class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Voltar">
        </button>
        <h1>Adicionar Usuário</h1>
    </header>
    <main>
        <div class="perfil-container">
            <h2>Adicionar Novo Usuário</h2>
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="addUsuario.php" class="perfil-form">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo" required>
                        <option value="funcionario">Funcionário</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="botoes">
                    <button type="submit" class="perfil-button">Adicionar</button>
                    <button type="button" onclick="window.location.href='../public/menuInicial.php'" class="perfil-button cancel">Cancelar</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="direitos">
            <h4>© 2025 VAITREM. All rights reserved.</h4>
        </div>
    </footer>
</body>
</html>
