<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch some viagem or estacao
$result = $conn->query("SELECT * FROM Estacao LIMIT 1");
$estacao = $result->fetch_assoc();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <script src="../scripts/ValidarLogin.js"></script>
        <script src="../scripts/ButtonValidators.js"></script>

    <title>Gestão de Rotas</title>

</head>
<body>

    <header>
            <button onclick= "window.location.href='menuInicial.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
            </button>
        <div class="s">

        </div>
        <br>
        <div id="Navbar2">
        </div>
    </header>

    <main>
        <div class="Teste">
            <h1>Gestão de Rotas</h1>
            <div class="Container">
                <div class="LinhaChuva">
                    <h1>Linha 3</h1>
                    <img class="Alerta2" src="../assets/imgs/Alerta.png" alt="">
                    
                </div>
                <div class="TelaLinha">
                    <br>
                    <img class="imagemrotas" src="../assets/imgs/gestaoderotas.png" alt="">
                    <br>
                </div>
                <h1>Chuvoso</h1>
            </div>
            <br>
            <br>
            
                <div class="Defeito">
                    
                     <div class="flex">
                        <a href="#" class="botao-div">
                            <div class="conteudo-botao">
                              <strong><h1>Defeito no trilho</h1></strong>
                            </div>
                          </a>
                         <img class="Alerta2" src="../assets/imgs/Alerta.png" alt="">
                     </div>
                    
                </div>
            
            <br>
            <br>
            <div class="ContatarMaquinista">
                <br>
                <a href="#" class="botao-div">
                    <div class="conteudo-botao">
                      <strong><h1>Contatar Maquinista</h1></strong>
                    </div>
                  </a>
                <br>
            </div>
            <br>
            <br>
            <div class="AlterarRota">
                <br>
                
                <a href="#" class="botao-div">
                    <div class="conteudo-botao">
                      <strong><h1>Alterar Rota</h1></strong>
                    </div>
                  </a>
                <br>
            </div>






           















            <br>
            <br>
            <br>
        </div>
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
