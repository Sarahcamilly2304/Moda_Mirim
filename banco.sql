CREATE DATABASE IF NOT EXISTS moda_mirim DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE moda_mirim;

-- Elimina tabelas antigas  (para evitar conflitos)
DROP TABLE IF EXISTS contatos CASCADE;
DROP TABLE IF EXISTS produtos CASCADE;
DROP TABLE IF EXISTS usuarios CASCADE;

-- Tabela de Utilizadores
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    desconto VARCHAR(50) DEFAULT '15% Off'
);

-- Tabela de Contactos
CREATE TABLE contatos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    assunto VARCHAR(150) NOT NULL,
    mensagem TEXT NOT NULL
);

-- Inserção de Produtos Iniciais (Moda Mirim)
INSERT INTO produtos (nome, preco, categoria, imagem, desconto) VALUES 
('Maiô Infantil Sereia Proteção UV50+', 89.90, 'maio', 'limao.jpg', '15% Off'),
('Maiô Floral Babados Moda Praia', 79.90, 'maio', '6ansmasc.fem.jpg', '10% Off'),
('Biquíni Infantil Estampa Limão Siciliano', 69.90, 'biquini', '2anosmasc.jpg', '12% Off'),
('Sunga Infantil Masculina 2 Anos', 49.90, 'sunga', 'meninoskit.jpg', '18% Off'),
('Conjunto Camisa UV Infantil Especial', 89.90, 'Protecaouv', 'limao.jpg', '20% Off');