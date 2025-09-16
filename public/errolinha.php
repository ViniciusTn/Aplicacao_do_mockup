<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$linha = $_GET['linha'] ?? 1;
// Check if linha is available, for example, if there is viagem for that estacao
$result = $conn->query("SELECT COUNT(*) as count FROM Viagem v JOIN Estacao e ON v.id_estacao_origem = e.id_estacao WHERE e.nome LIKE '%Linha $linha%'");
$row = $result->fetch_assoc();
$available = $row['count'] > 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>erro</title>
    <link rel="stylesheet" href="../styles/relatório.css">
    <script src="../scripts/ButtonValidators.js"></script>


</head>
<div class="Botao">
    <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar" type="button">
        <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
    </button>

    <body>

        <main>
            <?php if (!$available): ?>
            <h1 id="erro">ERRO</h1>

            <div class="informacao">
                <h1 id="indisponivel">Linha indisponivel</h1>
                <h2 id="mensagem">*Assim que a linha estiver disponível você irá receber uma notificação em seu Email</h2>
            </div>
            <?php else: ?>
            <h1>Linha <?php echo $linha; ?> Disponível</h1>
            <p>Relatório da linha...</p>
            <?php endif; ?>
        </main>

    </body>

</html>
