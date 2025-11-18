<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id_usuario, nome, tipo FROM Usuario WHERE LOWER(nome) = LOWER(?) AND senha = MD5(?)");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['user_type'] = $user['tipo'];
        header("Location: menuInicial.php");
        exit();
    } else {
        $error = "Usuário ou senha inválidos.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAITREM - Login</title>
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #102b46);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
        }

        /* Header */
        .header_login {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            justify-content: center;
        }

        .header_login img {
            width: 55px;
            height: 55px;
        }

        .header_login h3 {
            font-size: 26px;
            letter-spacing: 2px;
            color: #ffd236;
            text-shadow: 0 0 8px rgba(255, 210, 54, 0.6);
        }

        /* Card Login */
        .login {
            width: 90%;
            max-width: 380px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            margin: auto;
            animation: fadeIn 0.6s ease-in-out;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #logincor {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
            color: #ffd236;
            text-shadow: 0 0 8px rgba(255, 210, 54, 0.4);
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px #ffd236;
        }

        ::placeholder {
            color: #d7d7d7;
        }

        .error {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 5px;
        }

        .checkbox {
            color: #f1f1f1;
        }

        /* Botão amarelo */
        button {
            width: 100%;
            padding: 13px;
            margin-top: 18px;
            border: none;
            border-radius: 12px;
            background: #ffd236;
            color: #2e2e2e;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(255, 210, 54, 0.4);
        }

        button:hover {
            background: #ffe372;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(255, 210, 54, 0.5);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            color: #fff;
            font-size: 14px;
            opacity: 0.8;
        }

    </style>
</head>
<body>

<header class="header_login">
    <img class="foto" src="../assets/icons/iconeVaitrem.png" alt="icone da empresa">
    <h3>VAITREM</h3>
</header>

<main>
    <div class="login">
        <h2 id="logincor">LOGIN</h2>

        <form id="loginFormulario" method="POST" action="login.php">

            <input type="text" id="usuario" name="usuario" required placeholder="Usuário">
            <div class="error" id="erroUsuario"></div>

            <input type="password" id="senha" name="senha" required placeholder="Senha">
            <div class="error" id="erroSenha"><?php echo isset($error) ? $error : ''; ?></div>

            <br>

            <input type="checkbox" id="lembre">
            <label for="lembre" class="checkbox">Lembre de mim</label>

            <button type="submit">Entrar</button>
        </form>
    </div>
</main>

<footer>
    © 2025 VAITREM. All rights reserved.
</footer>

</body>
</html>