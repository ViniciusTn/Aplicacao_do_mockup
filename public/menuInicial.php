<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Inicial</title>
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

    
    <style>
     
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #0f2238);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        
        #navbar {
            width: 100%;
            padding: 18px 25px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        #titulo h1 {
            font-size: 32px;
            color: #ffd236;
            letter-spacing: 2px;
            font-weight: 800;
            text-shadow: 0px 0px 10px rgba(255, 210, 54, 0.7);
        }

        #logo {
            width: 48px;
            height: 48px;
            margin-left: 12px;
            filter: drop-shadow(0 0 10px rgba(255, 210, 54, 0.7));
        }

        
        #logout a {
            text-decoration: none;
            padding: 10px 20px;
            background: #ffd236;
            color: #0a1a2f;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            transition: 0.25s;
        }

        #logout a:hover {
            background: #ffe372;
            box-shadow: 0 0 10px #ffd236;
        }


        main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 40px 0;
        }

        #corpo {
            width: 90%;
            max-width: 820px;
        }

        
        .flex {
            display: flex;
            justify-content: space-evenly;
            margin: 30px 0;
        }

       
        .app,
        #perfil,
        #rota,
        #addUsuario,
        #usuarioCorpo,
        #relatorioCorpo {
            width: 170px;
            padding: 28px 18px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 22px;
            text-align: center;
            transition: 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .app:hover,
        #perfil:hover,
        #rota:hover,
        #addUsuario:hover,
        #usuarioCorpo:hover,
        #relatorioCorpo:hover {
            background: rgba(255, 255, 255, 0.16);
            transform: translateY(-6px);
            box-shadow: 0 0 20px rgba(255, 210, 54, 0.45);
        }

        .icone,
        #iconePerfil,
        #iconeGestaoDeRotas,
        #iconeGestaoFuncionario,
        #relatorio {
            width: 75px;
            margin-bottom: 12px;
            filter: drop-shadow(0 0 14px rgba(255, 210, 54, 0.4));
        }

        #iconePerfil { width: 85px; }
        #iconeGestaoDeRotas { width: 90px; }

        p {
            margin-top: 10px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.4px;
        }

        .notificacoes {
            width: 100%;
            margin-top: 40px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.09);
            border-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        #notif p {
            font-size: 20px;
            color: #ffd236;
            text-shadow: 0 0 8px rgba(255, 210, 54, 0.5);
        }

        #weather-info {
            margin-top: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        #iconNotif {
            width: 65px;
            filter: drop-shadow(0 0 10px rgba(255, 210, 54, 0.35));
        }

       
        footer {
            text-align: center;
            padding: 20px;
            opacity: 0.85;
        }

        footer h4 {
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <header>
        <div id="navbar">
            <div id="titulo">
                <div class="flex">
                    <h1>VAITREM.</h1>
                    <img id="logo" src="../assets/icons/vaiTremLogo.png" alt="Logo VAITREM">
                </div>
            </div>
            <div id="logout">
                <a href="../scripts/logout.php">🚪 Sair</a>
            </div>
        </div>
    </header>

    <main>
        <div id="corpo">
            <div class="flex">
                <div class="app">
                    <a href="dashboard.php">
                        <img class="icone" src="../assets/icons/D.png" alt="Dashboard">
                    </a>
                    <p><strong>Dashboard</strong></p>
                </div>
                <div id="perfil">
                    <a href="perfil.php">
                        <img id="iconePerfil" src="../assets/icons/iconePessoa.png" alt="Perfil">
                    </a>
                    <p><strong>Perfil</strong></p>
                </div>
            </div>
       
            <div class="flex">
                <div id="rota">
                    <a href="GestaoDeRotas.php">
                        <img id="iconeGestaoDeRotas" src="../assets/icons/trem.png" alt="Gestão de Rotas">
                    </a>
                    <p><strong>G. de Rotas</strong></p>
                </div>

                <?php if ($_SESSION['user_type'] === 'admin'): ?>
                <div id="addUsuario">
                    <a href="../private/addUsuario.php">
                        <img class="icone" src="../assets/icons/usuario.png" alt="Adicionar Usuário">
                    </a>
                    <p><strong>Adicionar Usuário</strong></p>
                </div>
                <?php endif; ?>
            </div>

            <div class="flex">
                <div id="usuarioCorpo">
                    <a id="usuarioCorpoText" href="../private/gerenciadorFuncionarios.php">
                        <img id="iconeGestaoFuncionario" src="../assets/icons/usuario.png" alt="Funcionários">
                    </a>
                    <p><strong>G. de <br>Funcionários</strong></p>
                </div>

                <div id="relatorioCorpo">
                    <a href="relatorios.php">
                        <img id="relatorio" src="../assets/icons/relatorio.png" alt="Relatórios">
                    </a>
                    <div id="relatoriotext">
                        <p><strong>Relatórios</strong></p>
                    </div>
                </div>
            </div>

            <div class="notificacoes">
                <div id="notif">
                    <p><strong>Notificações</strong></p>
                    <div id="weather-info">
                        <span id="current-weather">Carregando tempo...</span><br>
                        <span id="forecast">Carregando previsão...</span>
                    </div>
                </div>
                <img id="iconNotif" src="../assets/icons/Notificacao.png" alt="Notificações">
            </div>
        </div>
    </main>

    <footer>
        <div class="direitos">
            <h4>© 2025 VAITREM. All rights reserved.</h4>
        </div>
    </footer>

    <script>
        async function fetchWeather() {
            const lat = -23.5505;
            const lon = -46.6333;
            const url =
                `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code&hourly=temperature_2m&timezone=America/Sao_Paulo&forecast_days=1`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                let currentDesc = '';
                switch (data.current.weather_code) {
                    case 0: currentDesc = 'Céu claro'; break;
                    case 1:
                    case 2:
                    case 3: currentDesc = 'Parcialmente nublado'; break;
                    case 45:
                    case 48: currentDesc = 'Neblina'; break;
                    case 51:
                    case 53:
                    case 55: currentDesc = 'Garoa'; break;
                    case 61:
                    case 63:
                    case 65: currentDesc = 'Chuva'; break;
                    case 71:
                    case 73:
                    case 75: currentDesc = 'Neve'; break;
                    case 95:
                    case 96:
                    case 99: currentDesc = 'Tempestade'; break;
                    default: currentDesc = 'Condições desconhecidas';
                }

                document.getElementById('current-weather').innerHTML =
                    Atual: ${data.current.temperature_2m}°C - ${currentDesc};

                let forecastHtml = 'Próximas 3 horas: ';
                for (let i = 1; i <= 3; i++) {
                    const time = new Date(data.hourly.time[i])
                        .toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
                    forecastHtml += ${time}: ${data.hourly.temperature_2m[i]}°C; ;
                }

                document.getElementById('forecast').innerHTML = forecastHtml;

            } catch (error) {
                document.getElementById('current-weather').innerHTML = 'Erro ao carregar tempo.';
                document.getElementById('forecast').innerHTML = 'Erro ao carregar previsão.';
            }
        }

        window.addEventListener('load', fetchWeather);
    </script>
</body>
</html>