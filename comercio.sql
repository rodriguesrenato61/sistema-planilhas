-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 06/01/2020 às 14:23
-- Versão do servidor: 10.3.17-MariaDB-0+deb10u1
-- Versão do PHP: 7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `comercio`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_produto_excel` (IN `line` INT, IN `cod` INT, IN `name` VARCHAR(30), IN `category` INT, IN `price` DOUBLE)  BEGIN

	SET @codigo_existe = (SELECT COUNT(*) FROM produtos WHERE codigo = cod);
    
    IF(@codigo_existe > 0)THEN
    	CALL insert_relatorio(line, 2, "Erro, esse código já existe!");
    END IF;
    
    SET @nome_existe = (SELECT COUNT(*) FROM produtos WHERE nome = name);
    
    IF(@nome_existe > 0)THEN
    	CALL insert_relatorio(line, 2, "Erro esse nome já existe!");
    END IF;
    
    SET @categoria_existe = (SELECT COUNT(*) FROM categorias WHERE id = category);
    
    IF(@categoria_existe = 0)THEN
    	CALL insert_relatorio(line, 2, "Erro, categoria inválida!");
    END IF;
    
    IF(@codigo_existe = 0 AND @nome_existe = 0 AND @categoria_existe > 0)THEN
    	INSERT INTO produtos(codigo, nome, categoria_id, preco)
        	VALUES(cod, name, category, price);
        CALL insert_relatorio(line, 1, "Produto inserido com sucesso!");
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_relatorio` (IN `line` INT, IN `type` INT, IN `conteudo` VARCHAR(100))  BEGIN

	INSERT INTO relatorio(linha, tipo_id, valor)
    	VALUES(line, type, conteudo);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Alimentos'),
(2, 'Bebidas'),
(3, 'Higiene'),
(4, 'Limpeza');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `preco` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `nome`, `categoria_id`, `preco`) VALUES
(1, 'Margarina', 1, 4.5),
(2, 'Óleo', 1, 2),
(3, 'Creme de Leite', 1, 2.75),
(4, 'Maionese', 1, 4),
(5, 'Extrato de Tomate', 1, 1.75),
(6, 'Refrigerante', 2, 3.75),
(7, 'Água Mineral', 2, 2),
(8, 'Cerveja', 2, 5),
(9, 'Suco Pronto', 2, 4.5),
(10, 'Chá Pronto', 2, 3),
(11, 'Shampoo', 3, 4.75),
(12, 'Creme Dental', 3, 2),
(13, 'Desodorante', 3, 4.5),
(14, 'Sabonete', 3, 1.25),
(15, 'Papel Higiênico', 3, 1.5),
(16, 'Sabão em Pedra', 4, 1.55),
(17, 'Detergente Líquido', 4, 1.85),
(18, 'Amaciante', 4, 3.25),
(19, 'Água Sanitária', 4, 2.35),
(20, 'Esponja Sintética', 4, 1.25),
(25, 'Sardinha em Lata', 1, 2.75),
(26, 'Macarrão', 1, 1.75);

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL,
  `linha` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `relatorio`
--

INSERT INTO `relatorio` (`id`, `linha`, `tipo_id`, `valor`) VALUES
(570, 2, 1, 'Produto inserido com sucesso!'),
(571, 3, 1, 'Produto inserido com sucesso!'),
(572, 4, 1, 'Produto inserido com sucesso!'),
(573, 5, 1, 'Produto inserido com sucesso!'),
(574, 6, 1, 'Produto inserido com sucesso!'),
(575, 7, 1, 'Produto inserido com sucesso!'),
(576, 8, 1, 'Produto inserido com sucesso!'),
(577, 9, 1, 'Produto inserido com sucesso!'),
(578, 10, 1, 'Produto inserido com sucesso!'),
(579, 11, 1, 'Produto inserido com sucesso!'),
(580, 12, 1, 'Produto inserido com sucesso!'),
(581, 13, 1, 'Produto inserido com sucesso!'),
(582, 14, 1, 'Produto inserido com sucesso!'),
(583, 15, 1, 'Produto inserido com sucesso!'),
(584, 16, 1, 'Produto inserido com sucesso!'),
(585, 17, 1, 'Produto inserido com sucesso!'),
(586, 18, 1, 'Produto inserido com sucesso!'),
(587, 19, 1, 'Produto inserido com sucesso!'),
(588, 20, 1, 'Produto inserido com sucesso!'),
(589, 21, 1, 'Produto inserido com sucesso!'),
(590, 22, 2, 'Erro, esse código já existe!'),
(591, 22, 2, 'Erro, categoria inválida!'),
(592, 23, 1, 'Produto inserido com sucesso!'),
(593, 24, 1, 'Produto inserido com sucesso!'),
(594, 25, 2, 'Erro, categoria inválida!');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_linha`
--

CREATE TABLE `tipos_linha` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tipos_linha`
--

INSERT INTO `tipos_linha` (`id`, `descricao`) VALUES
(0, 'Inválido'),
(1, 'Inserido'),
(2, 'Rejeitado');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_produtos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_produtos` (
`codigo` int(11)
,`produto` varchar(30)
,`categoria_id` int(11)
,`categoria` varchar(30)
,`preco` double
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_relatorio`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_relatorio` (
`chave` int(11)
,`linha` int(11)
,`valor` varchar(100)
,`tipo_id` int(11)
,`tipo` varchar(30)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_relatorio2`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_relatorio2` (
`id` int(11)
,`linha` int(11)
,`valor` varchar(100)
,`tipo_id` int(11)
,`tipo_linha` varchar(30)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_produtos`
--
DROP TABLE IF EXISTS `vw_produtos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_produtos`  AS  select `produtos`.`codigo` AS `codigo`,`produtos`.`nome` AS `produto`,`produtos`.`categoria_id` AS `categoria_id`,`categorias`.`nome` AS `categoria`,`produtos`.`preco` AS `preco` from (`produtos` join `categorias` on(`produtos`.`categoria_id` = `categorias`.`id`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_relatorio`
--
DROP TABLE IF EXISTS `vw_relatorio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_relatorio`  AS  select `relatorio`.`id` AS `chave`,`relatorio`.`linha` AS `linha`,`relatorio`.`valor` AS `valor`,`relatorio`.`tipo_id` AS `tipo_id`,`tipos_linha`.`descricao` AS `tipo` from (`relatorio` join `tipos_linha` on(`relatorio`.`tipo_id` = `tipos_linha`.`id`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_relatorio2`
--
DROP TABLE IF EXISTS `vw_relatorio2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_relatorio2`  AS  select `relatorio`.`id` AS `id`,`relatorio`.`linha` AS `linha`,`relatorio`.`valor` AS `valor`,`relatorio`.`tipo_id` AS `tipo_id`,`tipos_linha`.`descricao` AS `tipo_linha` from (`relatorio` join `tipos_linha` on(`relatorio`.`tipo_id` = `tipos_linha`.`id`)) ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices de tabela `tipos_linha`
--
ALTER TABLE `tipos_linha`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de tabela `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;
--
-- AUTO_INCREMENT de tabela `tipos_linha`
--
ALTER TABLE `tipos_linha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `relatorio`
--
ALTER TABLE `relatorio`
  ADD CONSTRAINT `relatorio_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipos_linha` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
