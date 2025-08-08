-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 08/08/2025 às 03:20
-- Versão do servidor: 5.7.44
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(10) UNSIGNED NOT NULL,
  `produto_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `custo_unitario` decimal(8,2) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `entradas`
--

INSERT INTO `entradas` (`id`, `produto_id`, `quantidade`, `custo_unitario`, `valor_unitario`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 0.85, 1.20, '2025-08-08 02:57:47', '2025-08-08 02:57:47'),
(2, 4, 10, 1.85, 2.99, '2025-08-08 02:57:47', '2025-08-08 02:57:47'),
(3, 3, 10, 3.90, 5.00, '2025-08-08 02:57:47', '2025-08-08 02:57:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_requisicoes`
--

CREATE TABLE `itens_requisicoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `requisicao_id` int(10) UNSIGNED NOT NULL,
  `produto_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `custo_unitario` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `itens_requisicoes`
--

INSERT INTO `itens_requisicoes` (`id`, `requisicao_id`, `produto_id`, `quantidade`, `valor_unitario`, `custo_unitario`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1.20, 0.85, '2025-08-08 03:11:25', '2025-08-08 03:11:25'),
(2, 1, 3, 2, 5.00, 3.90, '2025-08-08 03:11:26', '2025-08-08 03:11:26'),
(3, 2, 3, 2, 5.00, 3.90, '2025-08-08 03:12:25', '2025-08-08 03:12:25'),
(4, 2, 5, 1, 14.40, 10.20, '2025-08-08 03:12:25', '2025-08-08 03:12:25'),
(5, 2, 6, 1, 12.49, 8.75, '2025-08-08 03:12:25', '2025-08-08 03:12:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2025_08_05_010704_add_nivel_perfil_to_users_table', 1),
(4, '2025_08_05_010926_create_tipo_produto_table', 1),
(5, '2025_08_05_011052_create_produtos_table', 1),
(6, '2025_08_05_012934_create_requisicoes_table', 1),
(7, '2025_08_05_013225_create_requisicao_produto_table', 1),
(8, '2025_08_05_183621_create_produto_composicao_table', 1),
(9, '2025_08_05_190427_create_itens_requisicao_table', 1),
(10, '2025_08_08_020330_create_entrada_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `nome_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '0',
  `custo` decimal(8,2) NOT NULL DEFAULT '0.00',
  `valor` decimal(8,2) NOT NULL,
  `tipo_produto_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome_produto`, `quantidade`, `custo`, `valor`, `tipo_produto_id`, `created_at`, `updated_at`) VALUES
(1, 'REFRIGERANTE LATA 350ml', 95, 0.85, 1.20, 1, '2025-08-08 02:57:12', '2025-08-08 03:15:13'),
(2, 'CAFÉ PCT. 500gr', 14, 3.00, 4.50, 1, '2025-08-08 02:57:12', '2025-08-08 03:15:14'),
(3, 'ARROZ BRANCO TIPO 1 PCT. 5kg', 15, 3.90, 5.00, 1, '2025-08-08 02:57:12', '2025-08-08 03:15:13'),
(4, 'FEIJÃO PRETO TIPO 1 PCT. 1kg', 19, 1.85, 2.99, 1, '2025-08-08 02:57:12', '2025-08-08 03:15:14'),
(5, 'REFRIGERANTE LATA 350ml - FARDO 12 UND', 10, 10.20, 14.40, 2, '2025-08-08 02:57:12', '2025-08-08 02:57:12'),
(6, 'CESTA BÁSICA PADRÃO', 5, 8.75, 12.49, 2, '2025-08-08 02:57:12', '2025-08-08 02:57:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_composicao`
--

CREATE TABLE `produto_composicao` (
  `id` int(10) UNSIGNED NOT NULL,
  `produto_composto_id` int(10) UNSIGNED NOT NULL,
  `produto_simples_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produto_composicao`
--

INSERT INTO `produto_composicao` (`id`, `produto_composto_id`, `produto_simples_id`, `quantidade`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 12, NULL, NULL),
(2, 6, 3, 1, NULL, NULL),
(3, 6, 4, 1, NULL, NULL),
(4, 6, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `requisicao_produto`
--

CREATE TABLE `requisicao_produto` (
  `id_requisicao_produto` int(10) UNSIGNED NOT NULL,
  `requisicao_id` int(10) UNSIGNED NOT NULL,
  `produto_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `requisicoes`
--

CREATE TABLE `requisicoes` (
  `id_requisicao` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `entregador_id` int(10) UNSIGNED DEFAULT NULL,
  `data` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `requisicoes`
--

INSERT INTO `requisicoes` (`id_requisicao`, `usuario_id`, `entregador_id`, `data`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, '2025-08-08', 'entregue', '2025-08-08 03:11:25', '2025-08-08 03:14:09'),
(2, 1, 2, '2025-08-08', 'entregue', '2025-08-08 03:12:25', '2025-08-08 03:15:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `id_tipo_produto` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`id_tipo_produto`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Simples', NULL, NULL),
(2, 'Composto', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nivel_perfil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `nivel_perfil`) VALUES
(1, 'Cliente', 'cliente@teste.com', '$2y$10$z0uVqhKWShqCv6YrRqba7uLi4JdSvBnfEVIW9y6zAfXcSA79VUSVO', 'gRXeQlrnrFvWSdQBL7J39neNVatE8o7ccSAKKOfwn6dNfbU9JIpQjJTI35v2', NULL, NULL, 'cliente'),
(2, 'Funcionario Comum', 'funcionario-comum@teste.com', '$2y$10$t379VxUmD0ivkEJb/LuVgucuqP5eqF7rGRGyDIYeUeqmy8g6K218e', 'zRGrzH40WxrGvbid8riP0X2qL8PlmnwEBz0VKs8NhN1QI72mvXoZNRB7lNss', NULL, NULL, 'funcionario'),
(3, 'Gerente', 'gerente@teste.com', '$2y$10$W4QYeJXSlXuz/SQFkVU5u.XKgoPn85OB2kqNSC0yljZRo2mbh440G', 'v1dbAanShAEVVvva7X9uDwf7j7QZSyGhNRIMD0bdHMHa0Syov4RAREsVKra7', NULL, NULL, 'gerente'),
(4, 'Admin', 'admin@teste.com', '$2y$10$Hgk58KnR10r7CASnqcK4ROtvNauCkSB9zEbRj..lNhCXnrOlSdec6', NULL, NULL, NULL, 'admin'),
(5, 'Fulano da Silva', 'fulano@teste.com', '$2y$10$.aVWJ0QB3Jv11BvRBMmftuRyL9Dari5TqQE58oWkEWr.lnWWv/e1K', '8CgjQ1WPo90YE8cReeMWgIfvhjby2xEf96XS1PZcGt0q5TAlC8yEelqgY5uZ', '2025-08-08 03:10:56', '2025-08-08 03:10:56', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entradas_produto_id_foreign` (`produto_id`);

--
-- Índices de tabela `itens_requisicoes`
--
ALTER TABLE `itens_requisicoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itens_requisicoes_requisicao_id_foreign` (`requisicao_id`),
  ADD KEY `itens_requisicoes_produto_id_foreign` (`produto_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `produtos_tipo_produto_id_foreign` (`tipo_produto_id`);

--
-- Índices de tabela `produto_composicao`
--
ALTER TABLE `produto_composicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_composicao_produto_composto_id_foreign` (`produto_composto_id`),
  ADD KEY `produto_composicao_produto_simples_id_foreign` (`produto_simples_id`);

--
-- Índices de tabela `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  ADD PRIMARY KEY (`id_requisicao_produto`),
  ADD KEY `requisicao_produto_requisicao_id_foreign` (`requisicao_id`),
  ADD KEY `requisicao_produto_produto_id_foreign` (`produto_id`);

--
-- Índices de tabela `requisicoes`
--
ALTER TABLE `requisicoes`
  ADD PRIMARY KEY (`id_requisicao`),
  ADD KEY `requisicoes_usuario_id_foreign` (`usuario_id`),
  ADD KEY `requisicoes_entregador_id_foreign` (`entregador_id`);

--
-- Índices de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`id_tipo_produto`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `itens_requisicoes`
--
ALTER TABLE `itens_requisicoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produto_composicao`
--
ALTER TABLE `produto_composicao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  MODIFY `id_requisicao_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `requisicoes`
--
ALTER TABLE `requisicoes`
  MODIFY `id_requisicao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `id_tipo_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens_requisicoes`
--
ALTER TABLE `itens_requisicoes`
  ADD CONSTRAINT `itens_requisicoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `itens_requisicoes_requisicao_id_foreign` FOREIGN KEY (`requisicao_id`) REFERENCES `requisicoes` (`id_requisicao`) ON DELETE CASCADE;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_tipo_produto_id_foreign` FOREIGN KEY (`tipo_produto_id`) REFERENCES `tipo_produto` (`id_tipo_produto`);

--
-- Restrições para tabelas `produto_composicao`
--
ALTER TABLE `produto_composicao`
  ADD CONSTRAINT `produto_composicao_produto_composto_id_foreign` FOREIGN KEY (`produto_composto_id`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE,
  ADD CONSTRAINT `produto_composicao_produto_simples_id_foreign` FOREIGN KEY (`produto_simples_id`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE;

--
-- Restrições para tabelas `requisicao_produto`
--
ALTER TABLE `requisicao_produto`
  ADD CONSTRAINT `requisicao_produto_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `requisicao_produto_requisicao_id_foreign` FOREIGN KEY (`requisicao_id`) REFERENCES `requisicoes` (`id_requisicao`);

--
-- Restrições para tabelas `requisicoes`
--
ALTER TABLE `requisicoes`
  ADD CONSTRAINT `requisicoes_entregador_id_foreign` FOREIGN KEY (`entregador_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `requisicoes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
