<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch estacoes or linhas
$result = $conn->query("SELECT * FROM Estacao");
$estacoes = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realatórios</title>
    <link rel="stylesheet" href="../styles/relatório.css">
        <script src="../scripts/ButtonValidators.js"></script>

</head>
<div class="Botao">
    <button onclick= "window.location.href='menuInicial.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
            </button>
<body>

    <main>

        <br>
        <h1 id="analises">Relatórios e Análises</h1>

        <section class="secao1">
            <div class="buttonsamarelo">
                <a href="errolinha.php?linha=1">
         <button class="btn1"><h1>Linha1</h1></button>
    </a>
            </div>
            <div class="buttonsamarelo">
               <a href="errolinha.php?linha=2">
         <button class="btn1"><h1>Linha2</h1></button>
            </div>
        </section>

        <br>

        <section class="secao2">
            <div class="buttonsamarelo">
                  <a href="errolinha.php?linha=3">
         <button class="btn1"><h1>Linha3</h1></button>
            </div>
            <div class="buttonsamarelo">
                        <a href="errolinha.php?linha=4">
         <button class="btn1"><h1>Linha4</h1></button>
            </div>
        </section>

        <section class="secao3">
              <a href="errolinha.php?linha=5">
           <div class="buttonsamarelo">
    </a>

            <a href="errolinha.php?linha=5">
         <button class="btn1"><h1>Linha5</h1></button>
            </div>
        </section>
    </main>

</body>
</html>
