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
    $imagem = $_POST['imagem'] ?: '../assets/imgs/Homem1.png';
    $email = $_POST['email'];
    $senha = $_POST['senha'];

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
    <link rel="stylesheet" href="../styles/Style.css">
    <script src="../scripts/gerenciadorFuncionarios.js"></script>
    <script src="../scripts/ButtonValidators.js"></script>
</head>
<body>
    <header>
     <button onclick= "window.location.href='gerenciadorFuncionarios.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
        </button>
        <br>
    <h1>Lista de Funcionários</h1>
    </header>
    <div id="Adicionar">
        <button type="button" id="botaoAddFuncionario" onclick="window.location.href='addFuncionarioTela.php'">
            <div class="conteudoBotao">
                <img src="../assets/imgs/Mais.png" alt="ícone de adicionar" class="iconeMais" />
                <p>Adicionar novo funcionário</p>
            </div>
        </button>
    </div>

     <form id="formFuncionario" method="POST" action="addFuncionarioTela.php">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required />
      <br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />
      <br>
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required />
      <br>
      <label for="funcao">Função:</label>
      <input type="text" id="funcao" name="funcao" required />
      <br>
      <label for="imagem">URL da imagem (opcional):</label>
      <input type="text" id="imagem" name="imagem" placeholder="../assets/imgs/Homem5.png" />
      <br>
      <div class="botoes">
    <button type="submit">Adicionar</button>
        <button type="button" onclick="window.location.href='gerenciadorFuncionarios.php'">Cancelar</button>
      </div>
    </form>
  </div>

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
