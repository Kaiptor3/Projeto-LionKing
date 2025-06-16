-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/06/2025 às 05:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lion_king`
--
CREATE DATABASE IF NOT EXISTS `lion_king` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lion_king`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carro`
--

CREATE TABLE `carro` (
  `idCarro` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `preco` decimal(15,2) DEFAULT NULL,
  `velocidadeMaxima` int(11) NOT NULL,
  `potencia` int(11) NOT NULL,
  `numeroPortas` int(11) NOT NULL,
  `aceleracao` decimal(4,2) NOT NULL,
  `numeroAssentos` int(11) NOT NULL,
  `pesoTotal` int(11) NOT NULL,
  `consumoMedio` decimal(4,2) NOT NULL,
  `capacidadePortaMalas` int(100) NOT NULL,
  `imagem1` varchar(255) DEFAULT NULL,
  `imagem2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carro`
--

INSERT INTO `carro` (`idCarro`, `modelo`, `preco`, `velocidadeMaxima`, `potencia`, `numeroPortas`, `aceleracao`, `numeroAssentos`, `pesoTotal`, `consumoMedio`, `capacidadePortaMalas`, `imagem1`, `imagem2`) VALUES
(15, 'BMW IX M60', 1101950.00, 250, 456, 4, 3.80, 5, 2684, 2.10, 1750, 'uploads/68474f50363c3_bmw ix m60.jpg', 'uploads/68474f50369b3_saiba+bmwixm60.jpg'),
(17, 'BMW X7', 1199950.00, 250, 280, 4, 5.80, 6, 2415, 9.60, 2120, 'uploads/684755dddc6d4_bmw x7 m60i.png', 'uploads/684755dddc8cd_saiba+bmwx7.jpg'),
(18, 'BMW X6 M', 1190950.00, 250, 459, 4, 3.80, 5, 2295, 12.70, 1530, 'uploads/68475641f09d4_bmw x6m.jpg', 'uploads/68475641f0bb2_saiba+bmwx6m.webp'),
(19, 'BMW I7', 1321950.00, 205, 335, 4, 5.50, 5, 2520, 1.90, 500, 'uploads/684756948680d_bmw-i7-09.webp', 'uploads/6847569486a00_saiba+bmwi7.webp'),
(20, 'JAGUAR F-TYPER', 612950.00, 285, 330, 2, 4.60, 2, 1735, 10.50, 509, 'uploads/684756d3b953c_jaguarf-typer.webp', 'uploads/684756df241d3_saiba+jaguarf-typer.jpeg'),
(21, 'JAGUAR I-PACE', 638150.00, 180, 236, 4, 6.30, 5, 2133, 2.00, 1453, 'uploads/6847576de063e_jaguari-pace.webp', 'uploads/6847576de081a_saiba+jaguari-pace.jpg'),
(22, 'JAGUAR E-PACE', 444950.00, 215, 227, 4, 6.50, 5, 2098, 2.00, 1386, 'uploads/6847585f1a729_jaguare-pace.jpg', 'uploads/6847585f1b0d4_saiba+jaguare-pace.jpg'),
(23, 'JAGUAR F-PACE', 612950.00, 286, 404, 4, 4.00, 5, 2058, 12.20, 1842, 'uploads/684758b0da987_juagarf-pace.jpg', 'uploads/684758b0dad24_saiba+jaguarf-pace.jpg'),
(24, 'PORSCHE CAYENNE', 890000.00, 248, 260, 4, 5.70, 5, 2055, 10.80, 1708, 'uploads/684758fe4a8e2_porschecay.jpg', 'uploads/684758fe4ab00_saiba+cayane.jpg'),
(25, 'PORSCHE PANAMERA', 691000.00, 272, 260, 4, 5.30, 5, 1885, 9.60, 1328, 'uploads/68475966c7092_porschepanamera.avif', 'uploads/68475966c72aa_porschepanamera.avif'),
(26, 'PORSCHE TAYCAN', 629000.00, 230, 300, 4, 4.80, 5, 2090, 1.60, 491, 'uploads/684759c43734f_porschetaycan.jpg', 'uploads/684759c43756b_saiba+porschetaycan1.jpg'),
(27, 'PORSCHE 911 TURBO S', 1795000.00, 330, 478, 2, 2.70, 4, 2020, 12.30, 375, 'uploads/68475a1f9b974_Porsche-911_Turbo_S-2021-1024-02.jpg', 'uploads/68475a1f9bbce_saiba+Porsche-911 Turbo S.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_usuario`
--

CREATE TABLE `log_usuario` (
  `idLog` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataHora` datetime NOT NULL DEFAULT current_timestamp(),
  `acao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `log_usuario`
--

INSERT INTO `log_usuario` (`idLog`, `idUsuario`, `dataHora`, `acao`) VALUES
(1, 4, '2025-06-15 11:31:49', 'Logout realizado'),
(2, 4, '2025-06-15 11:35:46', 'Login realizado'),
(3, 4, '2025-06-15 12:14:05', 'Usuário atualizou seus dados'),
(4, 4, '2025-06-15 12:59:07', 'Logout realizado'),
(5, 4, '2025-06-15 13:22:52', 'Logout realizado'),
(6, 4, '2025-06-15 13:26:20', 'Login realizado'),
(7, 4, '2025-06-15 14:48:57', 'Logout realizado'),
(8, 3, '2025-06-15 14:49:30', 'Login realizado'),
(9, 3, '2025-06-15 14:49:33', 'Logout realizado'),
(10, 4, '2025-06-15 14:51:54', 'Login realizado'),
(11, 4, '2025-06-15 14:53:51', 'Logout realizado'),
(12, 4, '2025-06-15 14:54:17', 'Login realizado'),
(13, 4, '2025-06-15 14:54:19', 'Logout realizado'),
(14, 4, '2025-06-15 14:55:15', 'Login realizado'),
(15, 4, '2025-06-15 14:55:19', 'Logout realizado'),
(16, 3, '2025-06-15 14:56:26', 'Login realizado'),
(17, 3, '2025-06-15 14:56:28', 'Logout realizado'),
(18, 4, '2025-06-15 14:57:57', 'Login realizado'),
(19, 4, '2025-06-15 14:57:59', 'Logout realizado'),
(20, 3, '2025-06-15 14:58:50', 'Login realizado'),
(21, 3, '2025-06-15 14:58:51', 'Logout realizado'),
(22, 4, '2025-06-15 14:59:15', 'Login realizado'),
(23, 4, '2025-06-15 14:59:17', 'Logout realizado'),
(24, 3, '2025-06-15 15:00:14', 'Login realizado'),
(25, 3, '2025-06-15 15:02:05', 'Logout realizado'),
(26, 4, '2025-06-15 15:03:48', 'Login realizado'),
(27, 4, '2025-06-15 15:03:51', 'Logout realizado'),
(28, 3, '2025-06-15 15:05:05', 'Login realizado'),
(29, 3, '2025-06-15 15:05:06', 'Logout realizado'),
(30, 4, '2025-06-15 15:05:44', 'Login realizado'),
(31, 4, '2025-06-15 15:05:46', 'Logout realizado'),
(32, 3, '2025-06-15 15:17:11', 'Login realizado'),
(33, 3, '2025-06-15 15:17:13', 'Logout realizado'),
(34, 4, '2025-06-15 15:17:21', 'Login realizado'),
(35, 4, '2025-06-15 18:28:49', 'Logout realizado'),
(36, 4, '2025-06-15 18:42:41', 'Login realizado'),
(37, 4, '2025-06-15 18:43:41', 'Logout realizado'),
(38, 4, '2025-06-15 18:48:46', 'Login realizado'),
(39, 4, '2025-06-15 18:48:54', 'Logout realizado'),
(42, 4, '2025-06-15 18:50:14', 'Login realizado'),
(43, 4, '2025-06-15 19:06:03', 'Logout realizado'),
(44, 4, '2025-06-15 19:06:13', 'Login realizado'),
(45, 4, '2025-06-15 19:43:15', 'Logout realizado'),
(46, 4, '2025-06-15 19:57:25', 'Login realizado'),
(47, 4, '2025-06-15 19:58:53', 'Logout realizado'),
(48, 4, '2025-06-15 20:43:10', 'Login realizado'),
(49, 4, '2025-06-15 20:47:33', 'Logout realizado'),
(50, 4, '2025-06-15 20:48:04', 'Login realizado'),
(51, 4, '2025-06-15 21:22:28', 'Logout realizado'),
(52, 4, '2025-06-15 21:25:08', 'Login realizado'),
(53, 4, '2025-06-15 22:01:11', 'Logout realizado'),
(54, 4, '2025-06-15 22:33:37', 'Login realizado'),
(55, 4, '2025-06-15 22:35:04', 'Logout realizado'),
(56, 4, '2025-06-15 23:00:03', 'Login realizado'),
(57, 4, '2025-06-15 23:06:50', 'Login realizado'),
(58, 4, '2025-06-15 23:06:51', 'Logout realizado'),
(64, 4, '2025-06-15 23:21:02', 'Login realizado'),
(65, 4, '2025-06-15 23:21:46', 'Logout realizado'),
(66, 4, '2025-06-15 23:21:58', 'Login realizado'),
(67, 4, '2025-06-15 23:22:19', 'Logout realizado'),
(68, 4, '2025-06-15 23:22:28', 'Login realizado'),
(69, 4, '2025-06-15 23:39:25', 'Logout realizado'),
(70, 4, '2025-06-15 23:40:01', 'Login realizado'),
(71, 4, '2025-06-15 23:41:12', 'Logout realizado'),
(72, 4, '2025-06-15 23:44:02', 'Login realizado'),
(73, 4, '2025-06-15 23:44:08', 'Logout realizado'),
(74, 4, '2025-06-15 23:44:22', 'Login realizado'),
(75, 4, '2025-06-15 23:44:23', 'Logout realizado'),
(76, 4, '2025-06-15 23:45:12', 'Login realizado'),
(77, 4, '2025-06-15 23:49:21', 'Logout realizado'),
(80, 4, '2025-06-15 23:50:13', 'Login realizado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao`
--

CREATE TABLE `permissao` (
  `idPermissao` int(11) NOT NULL,
  `nomePermissao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `permissao`
--

INSERT INTO `permissao` (`idPermissao`, `nomePermissao`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cpf` char(11) NOT NULL,
  `nomeCompleto` varchar(150) NOT NULL,
  `dataNascimento` date NOT NULL,
  `nomeMae` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cep` int(100) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idPermissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cpf`, `nomeCompleto`, `dataNascimento`, `nomeMae`, `email`, `telefone`, `cep`, `estado`, `cidade`, `rua`, `numero`, `bairro`, `login`, `senha`, `idPermissao`) VALUES
(3, '14954160707', 'Jorge Ramos', '2006-04-06', 'Monica Dos Santos', 'JorgeRamos@gmail.com', '21973046386', 21250570, 'Rio de Janeiro', 'Rio de Janeiro', 'Rua Rio Apa', '791', 'Cordovil', 'Jorge', '$2y$10$207hQEUp0zK7JOhZjL0rNeN5yPUtI7GtZ0BMZPZIAijvANZksz.Ce', 2),
(4, '159509377', 'Renata Dias', '2005-11-19', 'GILCREIDE S B RIOS', 'RenataDias@gmail.com', '21996325009', 21250570, 'Rio de Janeiro', 'Rio de Janeiro', 'Rua Oliveira Fausto', '114', 'Jardim América', 'Renata', '$2y$10$HqOJch/xh8VYmLTdcY6PiOjzTG3J8XjKkDq1sU/gJ1ErgLxddo9Ne', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`idCarro`);

--
-- Índices de tabela `log_usuario`
--
ALTER TABLE `log_usuario`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`idPermissao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `idPermissao` (`idPermissao`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `idCarro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `log_usuario`
--
ALTER TABLE `log_usuario`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `log_usuario`
--
ALTER TABLE `log_usuario`
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_usuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idPermissao`) REFERENCES `permissao` (`idPermissao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
