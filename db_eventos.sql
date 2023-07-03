-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/07/2023 às 16:49
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_eventos`
--
CREATE DATABASE IF NOT EXISTS `db_eventos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_eventos`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `categories`:
--

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `descricao`) VALUES
(1, 'Festa'),
(2, 'Feira'),
(3, 'Curso');

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` int(100) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `data_evento` date NOT NULL,
  `hora` time NOT NULL,
  `local_evento` varchar(50) NOT NULL,
  `categoria` int(11) NOT NULL,
  `preco` float NOT NULL,
  `nome_imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `events`:
--   `categoria`
--       `categories` -> `id`
--

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `titulo`, `descricao`, `data_evento`, `hora`, `local_evento`, `categoria`, `preco`, `nome_imagem`) VALUES
(1, 'Celebração da Força', 'Festa', '2023-07-15', '20:00:00', 'Rio Paranaíba UFV', 1, 20, 'imagem_eventos/festa.jpg'),
(2, 'Feira Intergaláctica', 'Uma feira com produtos de todas as partes da galáxia', '2023-07-20', '14:30:00', 'Centro de Convenções Coruscant', 2, 0, 'imagem_eventos/feira.jpg'),
(3, 'Curso de Sabre de Luz', 'Aprenda a manejar um sabre de luz como um verdadeiro Jedi', '2023-07-25', '18:00:00', 'Templo Jedi', 3, 50, 'imagem_eventos/curso.jpg'),
(4, 'Convenção dos Sith', 'Um encontro sombrio para os seguidores do Lado Negro da Força', '2023-08-05', '21:00:00', 'Estrela da Morte', 1, 15.99, 'imagem_eventos/festa.jpg'),
(5, 'Torneio de Podracing', 'Desafie seus adversários em uma corrida de alta velocidade', '2023-08-10', '16:30:00', 'Planeta Tatooine', 2, 5, 'imagem_eventos/feira.jpg'),
(6, 'Aula de Piloto de X-Wing', 'Torne-se um piloto habilidoso com treinamento especializado', '2023-08-15', '09:00:00', 'Base da Resistência', 3, 75, 'imagem_eventos/curso.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registrations`
--

CREATE TABLE `registrations` (
  `id` int(100) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `registrations`:
--

--
-- Despejando dados para a tabela `registrations`
--

INSERT INTO `registrations` (`id`, `status`, `id_user`, `id_event`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 2),
(4, 1, 4, 3),
(5, 1, 5, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `reviews`:
--

--
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`id`, `pontuacao`, `comentario`, `id_user`, `id_event`) VALUES
(1, 4, 'Uma festa incrível! Senti-me como um verdadeiro Han Solo.', 1, 1),
(2, 5, 'A feira foi espetacular. Pude encontrar um droide R2-D2 funcional!', 2, 2),
(3, 3, 'O curso de sabre de luz me transformou em um Jedi de verdade. Que a Força esteja com todos!', 3, 3),
(4, 4, 'A convenção dos Sith foi assustadora e emocionante. O Lado Negro é poderoso!', 4, 4),
(5, 5, 'O torneio de podracing foi uma corrida cheia de adrenalina. Venci em grande estilo!', 5, 5),
(8, 3, 'Comentario do Luke', 0, 1),
(9, 4, 'Teste do Luke 2', 0, 1),
(10, 1, 'dsdsdds', 0, 1),
(11, 2, 'teste do lukao', 0, 1),
(12, 4, 'sjdhsiadhiusadhisaudd dsa', 0, 1),
(13, 1, 'dsdsakldsauhddhfsdhf', 0, 1),
(14, 1, 'dskadslklkdklsad', 0, 1),
(15, 4, 'teste teste stef', 0, 1),
(16, 4, 'stef', 0, 1),
(17, 4, 'fhhhhhjjjjj', 0, 1),
(18, 1, 'kkkkkkkkkkkkk', 0, 1),
(19, 1, 'kkkkkjjjjjjjjjjjjjjjj', 0, 1),
(20, 1, 'ascsdfafsdafsdfsdafads', 0, 1),
(21, 1, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 0, 1),
(22, 1, 'ghkkkkkkkkkkkkkk', 0, 2),
(23, 1, 'bnkkkkkkkkkkk', 0, 1),
(24, 1, 'username teste', 0, 1),
(25, 1, 'nhjjjjjjjjjj', 0, 1),
(26, 1, 'nao tem endereco q eu conheco', 0, 3),
(27, 5, 'testecoringuei', 0, 2),
(28, 1, 'sdasd', 0, 1),
(29, 1, 'qqqqqqqqqqqqqqqqqqqqqq', 0, 1),
(30, 1, 'sssssssssssssssssss', 0, 1),
(31, 1, 'ssssssssssssssssssssssddddddddddddddd', 0, 1),
(32, 1, 'sdklasdklsadlksad', 0, 1),
(33, 1, 'ddddddddddd', 0, 1),
(34, 1, 'ddddddassdasdsadsadsadlkkkkkkkkkkk', 0, 1),
(35, 1, 'dsagggggggggggggggg', 0, 1),
(36, 1, 'ddddddddddddd', 0, 1),
(37, 1, 'ddddddddddddddddddddddddssssssssssss', 0, 1),
(38, 1, 'ddddddddddddd', 1, 1),
(39, 5, 'kkkkkkkkkkkkkkkkkkkkkkkk', 1, 3),
(40, 1, 'lllllllllllllll', 4, 1),
(41, 5, 'Teste de comentario', 7, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `cep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `users`:
--   `tipo_usuario`
--       `user_type` -> `id`
--

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `username`, `senha`, `tipo_usuario`, `email`, `data_nascimento`, `endereco`, `country`, `cep`) VALUES
(1, 'Luke Skywalker', 'luke_skywalker', 'senha123', 1, 'luke@example.com', '1993-12-29', 'Tatooine, Rua do Deserto, Número 123', 'Mos Eisley', '12345-678'),
(2, 'Leia Organa', 'leia_organa', 'senha456', 2, 'leia@example.com', '1991-04-12', 'Alderaan, Rua da Liberdade, Número 456', 'Aldera', '98765-432'),
(3, 'Han Solo', 'han_solo', 'senha789', 3, 'han@example.com', '1999-12-12', 'Millennium Falcon, Hangar 77', 'Espaço Sideral', '00000-000'),
(4, 'Darth Vader', 'darth_vader', 'senha987', 1, 'vader@example.com', '1971-08-04', 'Death Star, Torre 3, Sala 456', 'Estrela da Morte', '11111-111'),
(5, 'Padmé Amidala', 'padme_amidala', 'senha654', 3, 'padme@example.com', '1997-12-01', 'Naboo, Palácio Real, Apartamento 789', 'Theed', '54321-987'),
(6, 'dsadsad', 'asdsad_Dasdsad', 'senhateste', 3, 'dasdsa_dsodjisdj@gmail.com', '2002-12-03', 'rua i, numero 3, jardim', 'brasil', '38810000'),
(7, 'Stefani Kaline', 'stefani_kaline', 'senhakaline', 3, 'stefani_kaline@gmail.com', '1997-12-01', 'rua i, numero 359, jardim primavera', 'Brasil', '38810000'),
(8, 'Ana Borges', 'ana_borges', 'senhaborges', 1, 'ana_borges@gmail.com', '1998-06-10', 'Rua Teste, número 01, Bairro Testado', 'Brasil', '32832193');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONAMENTOS PARA TABELAS `user_type`:
--

--
-- Despejando dados para a tabela `user_type`
--

INSERT INTO `user_type` (`id`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Organizador'),
(3, 'Participante');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_categories` (`categoria`);

--
-- Índices de tabela `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_user_type` (`tipo_usuario`);

--
-- Índices de tabela `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_categories` FOREIGN KEY (`categoria`) REFERENCES `categories` (`id`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_type` FOREIGN KEY (`tipo_usuario`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
