-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 28/08/2018 às 17:52
-- Versão do servidor: 5.6.39
-- Versão do PHP: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `fichacatalog`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `registros`
--

CREATE TABLE IF NOT EXISTS `registros` (
`id` int(5) NOT NULL,
  `unidade` varchar(20) NOT NULL,
  `data_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `registros`
--

INSERT INTO `registros` (`id`, `unidade`, `data_registro`, `titulo`) VALUES
(1, 'ICB', '2018-08-23 16:46:52', 'ASAS'),
(2, 'ICB', '2018-08-27 03:00:00', 'ALEATORIO'),
(3, 'IT', '2017-12-21 03:00:00', 'ASSDASD'),
(5, 'IT', '2018-07-12 03:00:00', NULL),
(6, 'IT', '2018-06-12 03:00:00', NULL),
(4, 'ICB', '2018-05-16 03:00:00', NULL),
(7, 'IT', '2018-06-15 03:00:00', NULL),
(9, 'ICB', '2018-01-13 03:00:00', NULL),
(10, 'IG', '2018-02-15 03:00:00', NULL),
(11, 'IG', '2018-02-18 03:00:00', NULL),
(12, 'IG', '2018-12-12 03:00:00', NULL),
(13, 'IT', '2018-12-12 03:00:00', NULL),
(14, 'IT', '2018-02-12 03:00:00', NULL),
(15, 'IG', '2018-05-19 03:00:00', NULL),
(16, 'IT', '2018-04-27 03:00:00', NULL),
(17, 'IT', '2018-03-17 03:00:00', NULL),
(18, 'ICB', '2017-10-19 03:00:00', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `registros`
--
ALTER TABLE `registros`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
