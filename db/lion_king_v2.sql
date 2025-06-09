-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 00:06
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
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `dataCompra` date DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `compracarro`
--

CREATE TABLE `compracarro` (
  `idCompra` int(11) NOT NULL,
  `idCarro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao`
--

CREATE TABLE `permissao` (
  `idPermissao` int(11) NOT NULL,
  `nomePermissao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`idCarro`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `compracarro`
--
ALTER TABLE `compracarro`
  ADD PRIMARY KEY (`idCompra`,`idCarro`),
  ADD KEY `idCarro` (`idCarro`);

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
  MODIFY `idCarro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `log_usuario`
--
ALTER TABLE `log_usuario`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `compracarro`
--
ALTER TABLE `compracarro`
  ADD CONSTRAINT `compracarro_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`),
  ADD CONSTRAINT `compracarro_ibfk_2` FOREIGN KEY (`idCarro`) REFERENCES `carro` (`idCarro`);

--
-- Restrições para tabelas `log_usuario`
--
ALTER TABLE `log_usuario`
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
