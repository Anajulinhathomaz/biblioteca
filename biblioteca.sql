-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/09/2025 às 12:41
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
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `periodo` enum('manhã','tarde','noite') DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `serie`, `periodo`, `email`) VALUES
(9, 'Karoline Giovana Salvador Zanardi', '3ºA', NULL, 'karol@gmail.com'),
(10, 'Lara Geovanna', '3ºD', NULL, 'larageovanna@gmail.com'),
(11, 'Lorena Ramos', '3ºA', NULL, 'lorena@gmail.com'),
(12, 'Adriana Souza', '3ºB', NULL, 'adriana@gmail.com'),
(15, 'Grasiella Cirilo', '3ºD', NULL, 'cirilao@gmail.com'),
(16, 'João Ferreira', '2ºG', NULL, 'jaocarlos@gmail.com'),
(17, 'Laura Avelar', '3ºD', NULL, 'laurao@gmail.com'),
(18, 'Henry Gabriel', '3ºD', NULL, 'henry@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `bimestre` tinyint(4) DEFAULT NULL CHECK (`bimestre` between 1 and 4),
  `status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `aluno_id`, `professor_id`, `livro_id`, `data_emprestimo`, `data_devolucao`, `bimestre`, `status`) VALUES
(13, 10, 13, 5, '2025-06-26', '2025-07-03', NULL, 2),
(14, 11, 13, 8, '2025-06-26', '2025-07-04', NULL, 2),
(17, 9, 9, 5, '2025-07-31', '2025-08-07', NULL, 2),
(18, 9, 9, 5, '2025-07-31', '2025-08-07', NULL, 0),
(19, 9, 9, 5, '2025-07-31', '2025-08-08', NULL, 0),
(20, 9, 9, 5, '2025-08-05', '2025-08-12', NULL, 0),
(21, 11, 13, 8, '2025-08-05', '2025-08-05', NULL, 0),
(26, 9, 9, 5, '2025-08-05', '2025-08-12', NULL, 0),
(27, 9, 9, 5, '2025-08-05', '2025-08-12', NULL, 0),
(28, 10, 13, 7, '2025-08-06', '2025-08-14', NULL, 2),
(29, 16, 13, 15, '2025-08-20', '2025-09-05', NULL, 0),
(30, 17, 13, 17, '2025-09-03', '2025-09-10', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `isbn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `isbn`) VALUES
(5, 'O que o Sol faz com as flores', 'Rupi Kaur', '9788542212334'),
(7, 'Os dois morrem no final', 'Adam Silvera', '9786555603033'),
(8, 'Para todos os garotos que já amei', 'Jenny Han', '9788580577273'),
(10, 'Harry Potter e a Câmara Secreta', 'J.K. Rowling', '9781781103692'),
(11, 'A Biblioteca da Meia-Noite', 'Matt Haig', '9786558380634'),
(13, 'O homem que calculava', 'Malba Tahan', '9786555878387'),
(14, 'O Deus que destrói sonhos', 'Rodrigo Bibo', '9786556891866'),
(15, 'Harry Potter e o prisioneiro de Azkaban', 'J.K. Rowling', '9781781103708'),
(16, 'Hábitos Atômicos', 'James Clear', '9788550807577'),
(17, 'O verão que mudou minha vida', 'Jenny Han', '9788551004456'),
(18, 'Até o verão terminar', 'Colleen Hoover', '9786559810628'),
(19, 'É assim que acaba', 'Colleen Hoover', '9788501113498');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `cpf`, `senha`, `email`) VALUES
(9, 'Ana', '12345678999', '$2y$10$LZEZ7LKpwNweb1zRBgS4..g0CKqDvhMTLH.FJuS9zD3EOvE.A.EUa', 'ana@gmail.com'),
(13, 'Fernando', '11122233344', '$2y$10$aWOs2tHXFP08CLuTkAi6d.RgtjIRFePfLbWY0m9PkWqz2vdEdp4ka', 'fernandao@gmail.com'),
(14, 'Daniela Lima', '68495788314', '$2y$10$3Enz8grgvRbsrO6t6dIT9uFlXIZoLvI8shDmXSNgPQ0JsYtJ5KeTu', 'daniela.lima586@teste.com'),
(15, 'Daniela Ferreira', '43155112612', '$2y$10$1axHndIJuGDPmsc8lDnSyOZWXeNQBh2F.2niA4QD4lmBktmVZ2bqG', 'daniela.ferreira200@teste.com'),
(16, 'Juliana Almeida', '34562331433', '$2y$10$3vtRswMqUdnlLg79Xqzi9..ipA6Rxra61tBv.97VtQLBhweL/9TQ6', 'juliana.almeida673@teste.com'),
(17, 'Sofia Souza', '33520224113', '$2y$10$l0b8AfPj8AW7uW7OX.RUCudkKjUzBKYFVHL/xcV.xtrIGmBEHOCD6', 'sofia.souza163@teste.com'),
(18, 'Rafael Lima', '93609261689', '$2y$10$PoU9GKEv3AnwHrkZOqSth.d9LU6U8AvMc3XOhCQ6e2hUyaSMp2216', 'rafael.lima629@teste.com'),
(19, 'Paula Souza', '81739165148', '$2y$10$p4S88MKHNV/FJGH98AX6MOOW5yBDro8enASmklHbVWbJ3J9n6sEOe', 'paula.souza681@teste.com'),
(20, 'Wagner Rodrigues', '67478393494', '$2y$10$K7zqqwV/IT0Ob/6FaZQPg.n.nB5G7eP8iraOtjdXWJ37rSqUo03Je', 'wagner.rodrigues697@teste.com'),
(21, 'Otávio Lima', '74281815230', '$2y$10$bsWM9OXtC611uBVSTavoDOYMi.G5GEhklmKU7nSmbH1KZvQxEI/R2', 'otávio.lima909@teste.com'),
(22, 'Marcos Santos', '54368080836', '$2y$10$XWkocgI78nl0ySg17rDp0.iO3jwsJYgjGkpyNdKv67nFMJec0kkZO', 'marcos.santos229@teste.com'),
(23, 'Zuleide Santos', '69699208775', '$2y$10$R57TnRsnn8ivTwFNt9jLy.T0H.RVYGY6vkfpU4aiS8h21oxuBIQHa', 'zuleide.santos557@teste.com'),
(24, 'Gabriel Almeida', '53336793159', '$2y$10$/o64LBXAoN0nQR3Y.KpSmeFpdmAgA85BaN//lBjDeKbPQDJE2YEK2', 'gabriel.almeida798@teste.com'),
(25, 'Ursula Ferreira', '88681880990', '$2y$10$LbTLBcG9YTkPBhsv.RjM4.GYCxKjSfXhRdyRnFaJ1MUCov2JAFCBq', 'ursula.ferreira136@teste.com'),
(26, 'Gabriel Lima', '97229040776', '$2y$10$YQr/Bu3fhKlT5EA45xvrqenP2TWFQ655poziIR6D2ekJSpZ7gjrxC', 'gabriel.lima707@teste.com'),
(27, 'Larissa Lima', '79881741313', '$2y$10$uDXtpUUPiTGBeMlAFg3Zley1vjdKvY/frTtk.OeWUpk1UY377J/8G', 'larissa.lima468@teste.com'),
(28, 'Otávio Almeida', '29840058984', '$2y$10$AdC6WVugkPyiK61jOPES6ex6a0oYVGxy0Ktyj/MeU7/Zr88kkDayK', 'otávio.almeida300@teste.com'),
(29, 'Eduardo Souza', '63132912969', '$2y$10$fQsjL8uVqXADS1LMe99ulOP3jXmDSKbhgGn397Hfy.IMBUzmSf.9q', 'eduardo.souza720@teste.com'),
(30, 'Daniela Oliveira', '62928824507', '$2y$10$8mtLUCVakPMHBcIvdli.UOLnIwPjjBFk1G2Bga9Exs9rlsAED3AMG', 'daniela.oliveira670@teste.com'),
(31, 'Helena Oliveira', '58516194573', '$2y$10$JUyIIggCbBfxrH/sBAmVmucH2nlZ9Fg3RL8Iv5yGgUyeABdM.dwgG', 'helena.oliveira111@teste.com'),
(32, 'Quésia Ferreira', '53792073847', '$2y$10$D6lr4TDhz4OBnp8WGDT4u.gAvaLPb6gRhA2fKi2xj5pUWbYxwgiV.', 'quésia.ferreira154@teste.com'),
(33, 'Marcos Gomes', '34317190884', '$2y$10$szTevJhmLIBxg.AKAcplIea141XEOmNMmXQ8RaIjqoNmXmxfSfCD.', 'marcos.gomes375@teste.com'),
(34, 'Igor Santos', '72177725753', '$2y$10$vEb8On/kI.E0/u1ZcXOb0.ndCABMydtlfqoZUWrVXoPrTa17.Zq5K', 'igor.santos391@teste.com'),
(35, 'Nina Rodrigues', '13306152171', '$2y$10$FQ4Yd8wx4DTlOoGWPsoSJuxht7XsXf4YU4TrzbHZ2STIbvbTYznsy', 'nina.rodrigues643@teste.com'),
(36, 'Nina Oliveira', '92295930307', '$2y$10$1qcznDrqYZWi1.gCD5me6ePDdWt9vxtUkq7GJTVPfaBY5G21PToXy', 'nina.oliveira141@teste.com'),
(37, 'Gabriel Oliveira', '51857693257', '$2y$10$miS2AOQnWUoDNHkAy85wXuTK9k6OPaKr6iZt08kp2LfhCzzl73jVS', 'gabriel.oliveira648@teste.com'),
(38, 'Xuxa Santos', '83522831369', '$2y$10$RuXKwKHUmaajiQZtz.nUpO9D.pGbnzmQPxwc5GWjeNa.X35zJluB2', 'xuxa.santos844@teste.com'),
(39, 'Xuxa Ferreira', '84795807787', '$2y$10$VkjhdluAXUNr6RGzLAGKSeCJJN6NLYVhBMXT.E7Z5Lu648tyQvrBa', 'xuxa.ferreira730@teste.com'),
(40, 'Eduardo Oliveira', '36793232691', '$2y$10$Vknl5sXkir3O7ByFamH8OejGK1H3SWMm2vUKNXAD0yBDLAO4v0RdW', 'eduardo.oliveira534@teste.com'),
(41, 'Fernanda Rodrigues', '30318408740', '$2y$10$1QudV19TcU9AjN8BnxOOhOLyUUdCw9h8C39Gcpa8zEBuFj7AcE8VC', 'fernanda.rodrigues792@teste.com'),
(42, 'Marcos Souza', '75946821464', '$2y$10$FRsbzlXkEKsGyWkn9P02b.xzHfh6QEH3mtJsCaxEwFdkMRVne/D2y', 'marcos.souza80@teste.com'),
(43, 'Zuleide Lima', '42452110470', '$2y$10$7NU15DXUG9gZTT6WPHMiT.6an11h1YZ2tvS0lbt7CBNXiKubknMcO', 'zuleide.lima454@teste.com'),
(44, 'Kaio Ferreira', '11967314204', '$2y$10$8EtJjxIAaW3i8dNCqmZi8.1NaefkV1H4shxwpDyTp47E/Z4A23iIi', 'kaio.ferreira479@teste.com'),
(45, 'Wagner Santos', '95240062647', '$2y$10$sYUP9X0tBqDwEx1FEgVWfORRO68iQYfGDuRyGb1Jk51vJ71PYCfI2', 'wagner.santos871@teste.com'),
(46, 'Tiago Ferreira', '90799560910', '$2y$10$KurHaAk2H2TQxqrEFvZyf.zxyxNhs9EALegGfl/TGGaW2kO2FD7Wi', 'tiago.ferreira369@teste.com'),
(47, 'Zuleide Oliveira', '32981506512', '$2y$10$JsJVTCj2jNtUNeFPUb0sdey10pg8llSUa9owb341bFxmOrE1TkhIm', 'zuleide.oliveira170@teste.com'),
(48, 'Carlos Ferreira', '97476793558', '$2y$10$/GEh0PW995VUZsioADu4Ge8VwWbKhiihar9iktFgyh/LNKAVSIILe', 'carlos.ferreira553@teste.com'),
(49, 'Igor Souza', '17480464087', '$2y$10$336R4L6rkcvgW3wBqtKd8ustkSb65rpIochmfRLorPSJ2z4WzntHW', 'igor.souza227@teste.com'),
(50, 'Kaio Lima', '32204866660', '$2y$10$pPBscSdW5hyPJgXN1un/feFxXkmVYa7iMz0SLDynpxBM6Tlje2wJS', 'kaio.lima580@teste.com'),
(51, 'Juliana Silva', '65593467483', '$2y$10$ohO1Qdru/jnR6DLA7ncvcu2IPlCZ0RWPD8jj47Tk4jIkn2g7wNkXS', 'juliana.silva769@teste.com'),
(52, 'Helena Souza', '73737583916', '$2y$10$tYuhawIFY7hO9zcY0JHI8eq8xw7fezn6Xc6LX2JPndTy/c5ZcKCam', 'helena.souza670@teste.com'),
(53, 'Wagner Oliveira', '55854673183', '$2y$10$1Wid1oxoPkpE.6UiG5NpteJPO4ggUIgFOwDuCs1vRSQc1sxqXTuza', 'wagner.oliveira835@teste.com'),
(54, 'Zuleide Oliveira', '68120428000', '$2y$10$u83NEJcQ8ejoFHBpFlKqV.1u/Tx5RBPTS7r8h8bbM24Sk7DscJRDW', 'zuleide.oliveira651@teste.com'),
(55, 'Rafael Lima', '58103262483', '$2y$10$O.4J9gS5.JdHgLn6jzD7I.t7IpNT1tnYH9ge.361iNpiZKScwY6t2', 'rafael.lima433@teste.com'),
(56, 'Quésia Souza', '44768571071', '$2y$10$1sllfraoazzcff/IvBZ.Q.CSyM4nFkEwxQ.gvW2M2D3m51MM9kgeC', 'quésia.souza672@teste.com'),
(57, 'Daniela Ferreira', '41300155748', '$2y$10$aoWb/OORHIjeT6DBiN4ZtOyOqdn68q1LG/ZbUD3HHaJUfPj3nXfe2', 'daniela.ferreira698@teste.com'),
(58, 'Ana Barbosa', '66310523173', '$2y$10$G6FdQhIDe8dv4vgqvT1z3eAVQlc3NuDAEte9z3J5yavY9gfBFbwCK', 'ana.barbosa688@teste.com'),
(59, 'Paula Almeida', '27784831778', '$2y$10$FrcA/HASVqgdpdNC0JWfYunIjuLyo.Mc0gbNYl2EdRy6PwKO/H3aO', 'paula.almeida542@teste.com'),
(60, 'Wagner Ferreira', '55837252858', '$2y$10$ruoGSxzQhD5MvOgiHcZfSeSmNKqptZKku4g0rwVm7oUh.9HENguMy', 'wagner.ferreira423@teste.com'),
(61, 'Yuri Almeida', '39768435391', '$2y$10$NMVzxL2FRPvZ3OeyakikfOdHoi4rNGGhEkkJZm4xORgHJBZlPC41W', 'yuri.almeida974@teste.com'),
(62, 'Marcos Gomes', '73291102681', '$2y$10$owPkNgv6zT5.cdbI4rEbmuxeU85H9dDzZGZsNJLrAaSrd/FyUJ6nm', 'marcos.gomes870@teste.com'),
(63, 'Igor Rodrigues', '45618465345', '$2y$10$81xsqIMtq/1WAmqIrYbawePHg/0Z1m.L5rFnrmbhB/X90it4EVK3C', 'igor.rodrigues922@teste.com'),
(64, 'Vanilda', '00000000000', '$2y$10$IAUU3AUN6xTi3YUFQh3KYu725p09hwqDZqynEc8IueCly8vLEFmBm', 'vanilda@gmail.com'),
(65, 'Vitor', '00099988877', '$2y$10$v30tVDIweGcdfjO7lLkdGe3HIoTy58w92xA8qO/r6wPnkAdCjnI1K', 'vitor@gmail.com'),
(66, 'Fernando', '11111111111', '$2y$10$i88MrxsPt2u80jv7BjbpSe4AVokVEp/ch0eGdFPsor2839GHzbTvy', 'fernandao@gmail.com'),
(67, 'Gabriel', '99900099900', '$2y$10$jW4kB18DWQ54HrNKvtP5FecR302L3b/B8mut/4f1sDJfS/G37ooV.', 'gabriel@gmail.com'),
(68, 'Antonio Souza', '34567888654', '$2y$10$6Pi8Ir3q9q/zBucIMJ6FWOgD3WNZoy/ayFulrhKFxF8B0bfJCy/56', 'vanild00000a@gmail.com'),
(69, 'sauce roster', '75898764372', '$2y$10$adAx0JPFqToi2Lbw/40ubOpxXbsTgyigzV8UWDo0DAqPfK8q8WUKy', 'roster@gmail.com'),
(70, 'Carlos', '55555555555', '$2y$10$/p75uyD8xBK58JHueZQFSONv3.wFCYC6lqYyc6YLCLGGlhZ3LsS0.', 'carlinhos@gmail.com'),
(71, 'Paulo Souza', '77777777777', '$2y$10$xMNYkoxrIA8TGO8CBNCiDOLeq7mkhi6b0HM4m8AQ6XwQnEd1Inm8W', 'paulo@gmail.com'),
(72, 'Amanda', '66666666666', '$2y$10$ywciwN4eMJE9uHVAyLsG8efOsa7faZ66LNXumN6b53UdwCT6GVs/m', 'manda@gmaill.com'),
(73, 'Igor Rafael', '44444444444', '$2y$10$qzs.EHhpHQA2hiCAVVg3Aeh7X0T6T1hPpOdajHE9izPOD/ux3oTuG', 'igao@gmail.com'),
(74, 'Matheus', '11122211122', '$2y$10$ooqMjqRCWFXPe7oimCiiiu72WTGXisVr8LZXrctbvkyk48OLfLapC', 'matheus@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `livro_id` (`livro_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`),
  ADD CONSTRAINT `emprestimos_ibfk_3` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
