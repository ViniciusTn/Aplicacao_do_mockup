# VaiTrem - Sistema de Gerenciamento de Trens

## Descrição do Projeto

Este projeto é a segunda etapa da atividade de mockup, onde implementamos visualmente o que foi planejado na prática. O aplicativo "VaiTrem" é um sistema web para gerenciamento de operações ferroviárias, incluindo controle de trens, funcionários, rotas, estações, notificações e viagens.

## Funcionalidades

- **Autenticação de Usuários**: Login para administradores e funcionários.
- **Dashboard**: Visualização de informações do último trem acessado, integridade dos trilhos, quantidade de combustível, funcionário responsável e previsão do tempo (integrada com API externa).
- **Gerenciamento de Rotas**: Criação e visualização de rotas associadas aos trens.
- **Gerenciamento de Funcionários**: Adição e administração de funcionários.
- **Relatórios**: Geração de relatórios sobre operações.
- **Notificações**: Sistema de notificações para usuários.
- **Monitoramento de Manutenção**: Controle de manutenção dos trens.

## Tecnologias Utilizadas

- **Backend**: PHP com MySQL (usando MySQLi para conexão).
- **Frontend**: HTML5, CSS3, JavaScript.
- **Banco de Dados**: MySQL.
- **APIs Externas**: Open-Meteo para previsão do tempo.
- **Sessões**: Gerenciamento de sessões PHP para autenticação.

## Instalação e Configuração

1. **Pré-requisitos**:
   - Servidor web (ex.: Apache) com suporte a PHP.
   - MySQL instalado e configurado.
   - XAMPP ou similar para desenvolvimento local.

2. **Configuração do Banco de Dados**:
   - Execute o script `db/vaitrem_db.sql` no MySQL para criar o banco de dados e inserir dados de exemplo.
   - Atualize as credenciais em `db.php` se necessário (padrão: host=localhost, user=root, password=root, db=vaitrem_db).

3. **Execução**:
   - Coloque os arquivos na pasta htdocs do XAMPP.
   - Inicie o Apache e MySQL no XAMPP.
   - Acesse via navegador: `http://localhost:3030/2025_atividades_gabriel/Aplicacao_do_mockup`. (Vai mudar dependendo o nome da sua pasta, no meu caso seria isso, como ainda é apenas um site estático).

## Uso

- Faça login com credenciais de exemplo (admin: admin@vaitrem.com / admin123, func: func1@vaitrem.com / func123).
- Navegue pelo dashboard, gerenciamento de rotas, etc.

## Esquema do Banco de Dados

- **Usuario**: id_usuario, nome, email, senha, tipo (funcionario/admin).
- **Funcionario**: id_funcionario, id_usuario, funcao, imagem.
- **Trem**: id_trem, nome, modelo, capacidade, combustivel, status.
- **Estacao**: id_estacao, nome, linha.
- **Notificacao**: id_notificacao, id_usuario, mensagem, data_envio.
- **Viagem**: id_viagem, id_trem, id_estacao_origem, id_estacao_destino, data_partida, data_chegada.

## Estrutura de Arquivos

- `db/`: Scripts SQL e conexão PHP.
- `api/`: Endpoints API (ex.: rotas.php).
- `assets/`: Imagens, ícones, GIFs.
- `private/`: Páginas privadas (ex.: gerenciamento de funcionários).
- `public/`: Páginas públicas (login, dashboard, etc.).
- `scripts/`: JavaScript para validação e navegação.
- `styles/`: Folhas de estilo CSS.

## Contribuidores

- Gabriel V. Alves, Thiago Thierry, Rafael Sonni, Vinicius Tavares.

## Licença

Este projeto é para fins educacionais. Ver LICENSE para detalhes.
