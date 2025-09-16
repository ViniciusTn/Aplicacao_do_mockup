-- Criação do Banco de Dados
CREATE DATABASE vaitrem_db;
USE vaitrem_db;

-- Usuário
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('passageiro', 'funcionario', 'admin') DEFAULT 'passageiro'
);

-- Estação
CREATE TABLE Estacao (
    id_estacao INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(50) NOT NULL
);

-- Trem
CREATE TABLE Trem (
    id_trem INT AUTO_INCREMENT PRIMARY KEY,
    codigo_trem VARCHAR(50) UNIQUE NOT NULL,
    capacidade INT NOT NULL
);

-- Viagem
CREATE TABLE Viagem (
    id_viagem INT AUTO_INCREMENT PRIMARY KEY,
    id_trem INT NOT NULL,
    id_estacao_origem INT NOT NULL,
    id_estacao_destino INT NOT NULL,
    data_partida DATETIME NOT NULL,
    data_chegada DATETIME NOT NULL,
    FOREIGN KEY (id_trem) REFERENCES Trem(id_trem),
    FOREIGN KEY (id_estacao_origem) REFERENCES Estacao(id_estacao),
    FOREIGN KEY (id_estacao_destino) REFERENCES Estacao(id_estacao)
);

-- Notificação
CREATE TABLE Notificacao (
    id_notificacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);
