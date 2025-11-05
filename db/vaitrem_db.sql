DROP DATABASE IF EXISTS vaitrem_db;
CREATE DATABASE vaitrem_db;
USE vaitrem_db;

CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('funcionario', 'admin') NOT NULL
);

CREATE TABLE Funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    imagem VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Trem (
    id_trem INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    modelo VARCHAR(100),
    capacidade INT,
    combustivel INT,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

CREATE TABLE Estacao (
    id_estacao INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    linha INT NOT NULL
);

CREATE TABLE Notificacao (
    id_notificacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Viagem (
    id_viagem INT AUTO_INCREMENT PRIMARY KEY,
    id_trem INT NOT NULL,
    id_estacao_origem INT NOT NULL,
    id_estacao_destino INT NOT NULL,
    data_partida DATETIME NOT NULL,
    data_chegada DATETIME,
    FOREIGN KEY (id_trem) REFERENCES Trem(id_trem),
    FOREIGN KEY (id_estacao_origem) REFERENCES Estacao(id_estacao),
    FOREIGN KEY (id_estacao_destino) REFERENCES Estacao(id_estacao)
);

INSERT INTO Usuario (nome, email, senha, tipo) VALUES
('Administrador', 'admin@vaitrem.com', MD5('admin123'), 'admin'),
('Funcionário 1', 'func1@vaitrem.com', MD5('func123'), 'funcionario'),
('Funcionário 2', 'func2@vaitrem.com', MD5('func123'), 'funcionario');

INSERT INTO Funcionario (id_usuario, funcao, imagem) VALUES
(2, 'Motorista', '../assets/imgs/Homem1.png'),
(3, 'Manutenção', '../assets/imgs/Homem2.png');

INSERT INTO Estacao (nome, linha) VALUES
('Estação A', 1),
('Estação B', 1),
('Estação C', 2);
