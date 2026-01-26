-- Crear la base de datos amarena_store con el schema correcto
DROP DATABASE IF EXISTS `amarena_store`;
CREATE DATABASE IF NOT EXISTS `amarena_store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `amarena_store`;

-- Tabla CATEGORIA
CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `catnombre` varchar(100) NOT NULL,
  `catdescripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categoria` (`catnombre`, `catdescripcion`) VALUES
('Remeras', 'Remeras de distintos materiales y cortes'),
('Pantalones', 'Pantalones de jean, gabardina y más'),
('Buzos', 'Buzos de frisa, hilo y más'),
('Shorts/Minis', 'Shorts y minifaldas para toda ocasión');

-- Tabla ROL
CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `rodescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- Tabla USUARIO
CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(255) NOT NULL,
  `usmail` varchar(50) NOT NULL UNIQUE,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usmail_unique` (`usmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla USUARIOROL
CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idusuario`, `idrol`),
  FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE,
  FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla PRODUCTO
CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `pronombre` varchar(100) NOT NULL,
  `prodetalle` varchar(512) NOT NULL,
  `procantstock` int(11) NOT NULL DEFAULT 0,
  `proprecio` decimal(10,2) NOT NULL,
  `proimagen` varchar(100) DEFAULT 'default.jpg',
  `idcategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`idproducto`),
  FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla MENU
CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL AUTO_INCREMENT,
  `menombre` varchar(50) NOT NULL,
  `medescripcion` varchar(124) NOT NULL,
  `meurl` varchar(255),
  `idpadre` bigint(20) DEFAULT NULL,
  `medeshabilitado` timestamp NULL DEFAULT NULL,
  `meorden` int(11) DEFAULT 0,
  PRIMARY KEY (`idmenu`),
  FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla MENUROL
CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idmenu`, `idrol`),
  FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE CASCADE,
  FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla COMPRAESTADOTIPO
CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL AUTO_INCREMENT,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL,
  PRIMARY KEY (`idcompraestadotipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'Cuando el usuario cliente inicia la compra de uno o más productos del carrito.'),
(2, 'aceptada', 'Cuando el usuario administrador acepta una compra en estado iniciada.'),
(3, 'enviada', 'Cuando el usuario administrador envía la compra.'),
(4, 'entregada', 'Cuando la compra ha sido entregada al cliente.'),
(5, 'cancelada', 'Cuando se cancela una compra (solo en estado iniciada para clientes, cualquier estado para admin).');

-- Tabla COMPRA
CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `cofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` bigint(20) NOT NULL,
  PRIMARY KEY (`idcompra`),
  FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla COMPRAESTADO
CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcompra` bigint(20) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcompraestado`),
  FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE,
  FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla COMPRAITEM
CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL,
  `ciprecio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idcompraitem`),
  FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- =================================================================
-- CREACIÓN DE USUARIO ADMINISTRADOR
-- Contraseña: admin123
-- =================================================================

-- 1. Insertamos el usuario en la tabla 'usuario'
-- La contraseña 'admin123' se guarda hasheada para mayor seguridad.
INSERT INTO `usuario` (`usnombre`, `usmail`, `uspass`, `usdeshabilitado`) 
VALUES 
('Administrador Principal', 'admin@amarenastore.com', 'admin123', NULL);

-- 2. Asignamos el rol de 'Administrador' (idrol = 1) al usuario que acabamos de crear.
-- Usamos LAST_INSERT_ID() para obtener el ID del administrador recién insertado.
INSERT INTO `usuariorol` (`idusuario`, `idrol`) 
VALUES 
(LAST_INSERT_ID(), 1);


-- =================================================================
-- CREACIÓN DE USUARIO CLIENTE
-- Contraseña: cliente123
-- =================================================================

-- 1. Insertamos el usuario en la tabla 'usuario'
-- La contraseña 'cliente123' se guarda hasheada.
INSERT INTO `usuario` (`usnombre`, `usmail`, `uspass`, `usdeshabilitado`) 
VALUES 
('Cliente de Prueba', 'cliente@ejemplo.com', 'cliente123', NULL);

-- 2. Asignamos el rol de 'Cliente' (idrol = 2) al nuevo usuario.
INSERT INTO `usuariorol` (`idusuario`, `idrol`) 
VALUES 
(LAST_INSERT_ID(), 2);
