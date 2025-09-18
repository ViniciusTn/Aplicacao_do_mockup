<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$result = $conn->query("SELECT * FROM Estacao");
if (!$result) {
    die("Erro ao buscar estações: " . $conn->error);
}
$estacoes = $result->fetch_all(MYSQLI_ASSOC);

$linhas = [];
foreach ($estacoes as $estacao) {
    $linhas[$estacao['linha']][] = $estacao;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../styles/relatório.css">
    <script src="../scripts/ButtonValidators.js"></script>
</head>
<body>

    <div class="Botao">
        <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
        </button>
    </div>

    <main>
        <br>
        <h1 id="analises">Relatórios e Análises</h1>

        <?php foreach ($linhas as $numeroLinha => $estacoesLinha): ?>
            <section class="secao">
                <?php foreach ($estacoesLinha as $estacao): ?>
                    <div class="buttonsamarelo">
                        <a href="errolinha.php?linha=<?= $numeroLinha ?>">
                            <button class="btn1"><h1>Linha<?= $numeroLinha ?></h1></button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endforeach; ?>

    </main>

</body>
</html>
