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
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

    <!-- ===== CSS INTEGRADO ===== -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #102b46);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }

        header h1 {
            font-size: 26px;
            color: #ffd236;
        }

        .buttonVoltar {
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .buttonVoltar img {
            width: 40px;
            transition: 0.3s;
        }

        .buttonVoltar img:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 8px #ffd236);
        }

        /* CONTAINER PRINCIPAL */
        .perfil-container {
            width: 90%;
            max-width: 550px;
            margin: 40px auto;
            padding: 30px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 0 18px rgba(255,210,54,0.25);
            text-align: center;
        }

        .perfil-container h2 {
            color: #ffd236;
            margin-bottom: 15px;
        }

        /* FORM */
        .perfil-form {
            width: 100%;
            margin-top: 15px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        label {
            font-weight: 600;
            font-size: 15px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 15px;
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        input::placeholder {
            color: #ddd;
        }

        /* BOTÕES */
        .botoes {
            margin-top: 15px;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .perfil-button {
            padding: 12px 25px;
            background: #ffd236;
            color: #0a1a2f;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .perfil-button:hover {
            background: #ffe371;
            box-shadow: 0 0 12px #ffd236;
            transform: translateY(-3px);
        }

        .cancel {
            background: #d9534f;
            color: white;
        }

        .cancel:hover {
            background: #ff6f6a;
            box-shadow: 0 0 12px #ff4444;
        }

        /* MENSAGENS */
        .error-message {
            color: #ff5d5d;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* FOOTER */
        footer {
            margin-top: auto;
            padding: 15px;
            text-align: center;
            opacity: 0.8;
        }

        footer h4 {
            font-size: 14px;
        }
    </style>
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
