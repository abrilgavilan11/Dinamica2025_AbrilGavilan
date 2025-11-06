-- Create database and tables
-- Database: login_system
CREATE DATABASE IF NOT EXISTS login_system;
USE login_system;

-- Table: rol
CREATE TABLE IF NOT EXISTS rol (
    idrol BIGINT AUTO_INCREMENT PRIMARY KEY,
    roldescripcion VARCHAR(50) NOT NULL
);

-- Table: usuario
CREATE TABLE IF NOT EXISTS usuario (
    idusuario BIGINT AUTO_INCREMENT PRIMARY KEY,
    idrol BIGINT NOT NULL,
    usnombre VARCHAR(50) NOT NULL UNIQUE,
    uspass VARCHAR(255) NOT NULL,
    usmail VARCHAR(100) NOT NULL,
    usdeshabilitado VARCHAR(250) NOT NULL,
    FOREIGN KEY (idrol) REFERENCES rol(idrol) ON DELETE CASCADE
);

-- Insert default roles
INSERT INTO rol (roldescripcion) VALUES
('Administrador'),
('Usuario');

-- Insert test user (password: admin123 - MD5 hashed)
INSERT INTO usuario (usnombre, idrol, uspass, usmail, usdeshabilitado) VALUES 
('admin', 1, 'admin123', 'admin@example.com', 'Habilitado'),
('usuario1', 2, 'usuario123', 'usuario1@example.com', 'Habilitado');
