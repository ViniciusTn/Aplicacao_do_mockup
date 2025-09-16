<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch last accessed train, for example, the first trem
$result = $conn->query("SELECT * FROM Trem LIMIT 1");
$trem = $result->fetch_assoc();

// Fetch some manutencao for integrity
$manutencao = $conn->query("SELECT * FROM Manutencao WHERE id_trem = " . $trem['id_trem'] . " LIMIT 1");
$man = $manutencao->fetch_assoc();

// Fake data if no
$integrity = $man ? 70 : 100; // example
$quantity = 70; // fake
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/menu.css">
        <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

        <title>Carregamento</title>

    </head>
    <body>

        <header>
            <button onclick= "window.location.href='menuInicial.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
            </button>
        </header>


        <main>

            <div class="divCorpo">

                 <p id="fontAmarelo"><strong> <  Ultimo Trem Acessado</strong></p>
                <div class="flex">
                    <img id="tremV" src="../assets/imgs/TremVcinza.png" alt="Trem  Vermelho" />

                </div>

                <p id="fontAmarelo">Integridade dos trilhos</p>
                <label for="file">Integridade dos trilhos:</label><br>
                <progress id="file" max="100" value="<?php echo $integrity; ?>"><?php echo $integrity; ?>%</progress> <?php echo $integrity; ?>%

                <p id="fontAmarelo">Quantidade dos trilhos</p>
                <label for="file">Quantidade de Combustivel:</label>
                <progress id="file" max="100" value="<?php echo $quantity; ?>"><?php echo $quantity; ?>%</progress> <?php echo $quantity; ?>%

                <p id="fontAmarelo"><strong>Funcionario sobre o comando</strong></p>

                <p>-----------------------------------</p>

                <p id="fontAmarelo"><strong>Maquinista</strong></p>
                <p> . Sr Antenor</p>




            </div>



        </main>


        <footer>
            <br>
        <div class="direitos">
        <h3> © 2025 VAITREM. All rights reserved.</h3>
        </div>

        </footer>


    </body>
</html>
