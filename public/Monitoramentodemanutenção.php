<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch manutencao for a trem
$result = $conn->query("SELECT m.*, t.codigo_trem FROM Manutencao m JOIN Trem t ON m.id_trem = t.id_trem LIMIT 1");
$man = $result->fetch_assoc();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Style.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <script src="../scripts/ValidarLogin.js"></script>
    <title>Carregamento</title>

</head>
<body>

    <header>
        <button class="buttonVoltar" type="button" onclick="window.location.href='menuInicial.php'">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
            </button>
        <div class="s">

        </div>
        <br>
        <div id="Navbar2">
        </div>
    </header>

    <main>
      <div class="Monitoramento">
        <h1>TREM <?php echo $man['codigo_trem'] ?? 'M2VF'; ?></h1>
    </div>

    <div class="Letrasmonitoramento"> <h2>Combine do maquinista
        <br>
        Ok</h2>
        <br>
        <br>
        <h1>Rodas</h1>
        <h1><?php echo $man['status'] ?? 'Manutenção necessaria'; ?></h1><h2><?php echo $man['descricao'] ?? 'rolamentos defeituosos'; ?></h2>


</div>
<div class="reportar"><h1>Reportar</h1></div>

<div class="Letrasmonitoramento">
    <h1>Motor</h1>
    <h1>Ok</h1>

    <br>

    <h1>Vagões
    </h1>
    <h1>Ok</h1>
</div>



    </main>


</body>
</html>
