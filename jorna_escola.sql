-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2025 às 02:19
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
-- Banco de dados: `jorna_escola`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `news`
--

INSERT INTO `news` (`id`, `title`, `summary`, `content`, `category`, `image`, `autor_id`, `published_at`, `user_id`) VALUES
(25, '🏆 Interclasses 2025', 'Primeira edição do evento esportivo acontece nos dias 4 e 5 de dezembro', 'A Escola Social Marista realizará, nos dias 4 e 5 de dezembro, a primeira edição do Interclasses 2025, reunindo turmas do Ensino Fundamental e Médio em dois dias de competições cheios de energia, integração e espírito esportivo.\r\n\r\nAs modalidades desta edição incluem basquete, vôlei, futsal e queimada, proporcionando variedade de jogos e oportunidades para que todos os estudantes participem e representem suas turmas nas quadras da escola. As equipes já estão em preparação, criando estratégias e treinando para alcançar um bom desempenho.\r\n\r\nO evento tem como objetivo fortalecer o trabalho em equipe, incentivar hábitos saudáveis e promover a convivência entre os alunos por meio do esporte. As partidas ocorrerão no ginásio principal, com entrada liberada para toda a comunidade escolar, que poderá torcer, vibrar e acompanhar de perto cada confronto.\r\n\r\nA expectativa é de dias marcados por animação, espírito de união e muita torcida, inaugurando uma tradição esportiva que promete crescer nos próximos anos dentro da Escola Social Marista.', 'Eventos', 'uploads/1764109027_1763481084_Projeto Interclasse 2012 __ Educação Fisica Escolar.jpg', NULL, '2025-11-25 22:17:07', 4),
(26, '🌎 Projeto “Vozes Maristas Pelo Clima”, do Marista Escola Social Cascavel, é publicado em livro lançado na COP30', 'Belém (PA), 2025 – O Marista Escola Social Cascavel ganhou destaque nacional ao ter o projeto “Vozes Maristas Pelo Clima” publicado no livro oficial da Conferência Nacional do Observatório Marista do Clima, durante a COP30.', 'Belém (PA), 2025 – O Marista Escola Social Cascavel conquistou destaque nacional ao ter o projeto “Vozes Maristas Pelo Clima” incluído no livro oficial do Observatório Marista do Clima, lançado durante a programação educativa da COP30, em Belém. A publicação reúne experiências e ações ambientais desenvolvidas por estudantes da Rede Marista de todo o Brasil, reforçando o compromisso institucional com a sustentabilidade e a formação cidadã.\r\n\r\nRepresentando a escola, os estudantes Alison e Vitória, ambos do 2º ano do Ensino Médio, foram selecionados para apresentar o projeto durante a conferência. A iniciativa, desenvolvida ao longo do ano letivo, tem como objetivo promover conscientização ambiental por meio de estudos, debates, observações climáticas e práticas sustentáveis dentro da comunidade escolar — dando voz aos jovens e ampliando seu protagonismo nas discussões sobre o futuro do planeta.\r\n\r\nDurante a apresentação, Alison e Vitória detalharam o processo de construção do projeto, que incluiu rodas de diálogo, produção de materiais educativos, registro de fenômenos climáticos locais e ações de mobilização comunitária. O eixo central da proposta é incentivar os estudantes a compreenderem os desafios ambientais contemporâneos e a se engajarem na defesa da Casa Comum, conceito inspirado na Encíclica Laudato Si’.\r\n\r\nA inclusão do “Vozes Maristas Pelo Clima” no livro lançado oficialmente na COP30 representa um reconhecimento importante do impacto do trabalho desenvolvido pelos alunos. Para os estudantes, ver o projeto registrado em uma publicação nacional foi motivo de grande orgulho e motivação para continuar atuando em favor da sustentabilidade.\r\n\r\nAlém da apresentação, Alison e Vitória participaram de oficinas, debates e encontros com jovens de diversas regiões do país, dialogando sobre temas como mudanças climáticas, justiça socioambiental e responsabilidade coletiva. A experiência ampliou a visão dos estudantes sobre o papel da juventude na construção de soluções concretas para os desafios climáticos.\r\n\r\nCom a publicação do projeto e sua participação ativa na COP30, o Marista Escola Social Cascavel reafirma seu compromisso com a formação integral de jovens conscientes, críticos e engajados, capazes de atuar como protagonistas da transformação social e ambiental.', 'Avisos', 'uploads/1764109133_1763481211_cop30.jpeg', NULL, '2025-11-25 22:18:53', 4),
(27, '📰 Estreia do Jornal Jovem Marista (JJM)', 'Primeira edição do novo jornal estudantil é lançada em evento especial no Marista Escola Social Cascavel', 'Nessa quarta-feira, 19 de novembro de 2025, a comunidade escolar do Marista Escola Social Cascavel celebrou com entusiasmo a aguardada estreia do Jornal Jovem Marista (JJM). O lançamento oficial ocorreu durante uma cerimônia no anfiteatro da escola, reunindo estudantes, professores, famílias e a colegiada em um momento marcado por alegria, expectativa e muito orgulho.\r\n\r\nO JJM nasce como um veículo de comunicação produzido integralmente pelos estudantes, com o propósito de se tornar um espaço vibrante, crítico e expressivo para a voz da juventude marista. A iniciativa partiu de um grupo de alunos da 3ª série do Ensino Médio, que idealizaram o projeto como uma forma de exercitar escrita, pesquisa, criatividade e protagonismo juvenil, além de discutir temas relevantes para a escola e para a sociedade.\r\n\r\nDurante o evento, professores destacaram a importância do jornal como ferramenta de expressão e formação integral. A professora de Web Design e Artes, Louize Fernanda dos Santos, celebrou a iniciativa:\r\n“Acho um projeto muito importante, pois mostra a visão do aluno sobre o desenvolvimento da escola, com as atividades do cotidiano sendo divulgadas para a comunidade.”\r\n\r\nO jornal contará com seções variadas, incluindo:\r\n\r\nAvisos e comunicados da escola\r\n\r\nCobertura de eventos e projetos\r\n\r\nArtigos de opinião e produções estudantis\r\n\r\nEspaço de criatividade, cultura e expressão juvenil\r\n\r\nOs estudantes responsáveis também compartilharam suas impressões sobre a jornada até o lançamento. Um dos membros da equipe editorial relatou:\r\n“Foi uma jornada muito desafiadora, mas durante todo o processo, e principalmente agora com a entrega desse projeto, é uma realização muito importante para nós.”\r\n\r\nA primeira edição do Jornal Jovem Marista já está disponível para leitura e promete inaugurar uma nova etapa na comunicação escolar, fortalecendo o protagonismo estudantil e ampliando a participação dos jovens nos espaços de diálogo e construção coletiva da escola.', 'Avisos', 'uploads/1764111472_1763479836_Captura de tela 2025-11-05 102735.png', NULL, '2025-11-25 22:57:52', 4),
(29, 'Colégio abre período de matrículas para o ano letivo', 'Vagas estão disponíveis para Educação Infantil, Ensino Fundamental e Ensino Médio, com prioridade para famílias já vinculadas à instituição.', 'O Colégio Marista iniciou oficialmente o período de matrículas para o próximo ano letivo. As vagas contemplam todas as etapas da educação — da Educação Infantil ao Ensino Médio — e podem ser realizadas presencialmente na secretaria da escola ou por meio da plataforma digital disponibilizada pela instituição.\r\n\r\nSegundo a direção, as famílias que já fazem parte da comunidade escolar têm prioridade no processo de renovação até a data estipulada. Após esse período, as vagas remanescentes serão abertas ao público geral. Além disso, o colégio reforça a importância de realizar a matrícula dentro do prazo para garantir a continuidade no mesmo turno e turma desejada.\r\n\r\nA equipe pedagógica ressalta que o Marista segue comprometido com uma educação integral, que une formação acadêmica, valores humanos, incentivo à criatividade e acompanhamento individualizado. Durante o período de matrículas, a escola também oferecerá visitas guiadas para novos estudantes e responsáveis que desejarem conhecer a estrutura e os projetos pedagógicos.\r\n\r\nAs orientações completas, incluindo prazos, documentação necessária e informações sobre bolsas, estão disponíveis no site oficial do Colégio Marista e nos canais de atendimento da instituição.', 'Avisos', 'uploads/1764205342_transferir (11).jpeg', NULL, '2025-11-27 01:02:22', 4),
(30, 'iniciodo período de provas desta semana', 'Avaliações envolvem turmas do Ensino Fundamental e Ensino Médio e seguem calendário divulgado pela coordenação.', 'O Colégio Marista deu início, nesta semana, ao período de provas que envolve alunos do Ensino Fundamental II e do Ensino Médio. As avaliações seguem o calendário previamente comunicado às famílias e aos estudantes, contemplando disciplinas como Língua Portuguesa, Matemática, Ciências, História e Inglês.\r\n\r\nA coordenação pedagógica destacou que o período de provas é uma oportunidade para que os alunos revisem conteúdos, reforcem aprendizagens e desenvolvam organização e autonomia. Durante toda a semana, a equipe de professores estará disponível para tirar dúvidas e orientar os estudantes sobre pontos específicos de cada matéria.\r\n\r\nOs responsáveis também receberam orientações para apoiar os alunos em casa, com foco em descanso adequado, rotina de estudos equilibrada e alimentação saudável. A direção reforça que o objetivo das avaliações é acompanhar o desenvolvimento de cada estudante, contribuindo para um processo educativo mais completo e consciente.\r\n\r\nAs provas seguem até sexta-feira, e os resultados serão divulgados conforme o cronograma interno da escola. A comunidade escolar tem se mobilizado para garantir um clima de tranquilidade e foco ao longo de toda a semana avaliativa.', 'Avisos', 'uploads/1764205549_transferir (12).jpeg', NULL, '2025-11-27 01:05:49', 4),
(31, 'Colégio anuncia Semana de Recuperação e Recuperação Final', 'Atividades e avaliações começam na próxima semana e envolverão todos os estudantes que necessitam reforçar conteúdos essenciais do ano letivo, incluindo revisões orientadas, exercícios específicos, acompanhamento com os professores e provas de recuperação elaboradas para avaliar a consolidação das aprendizagens ao longo do ano.', 'O Colégio Marista informou que a Semana de Recuperação e Recuperação Final terá início na próxima semana, envolvendo alunos do Ensino Fundamental II e do Ensino Médio. O objetivo é oferecer uma nova oportunidade para revisar conteúdos, fortalecer aprendizagens e garantir que todos os estudantes finalizem o ano letivo com domínio adequado das competências estudadas.\r\n\r\nDurante o período, cada disciplina terá um cronograma específico de revisões, atividades orientadas e avaliações finais de recuperação. Os professores estarão disponíveis para atender dúvidas e oferecer orientações adicionais, reforçando o compromisso com um acompanhamento pedagógico próximo e cuidadoso.\r\n\r\nA coordenação destaca que a participação dos alunos é essencial, já que esse momento representa não apenas uma segunda chance de melhorar resultados, mas também um processo importante de responsabilização, organização e retomada de conteúdos fundamentais.\r\nAs famílias receberam as orientações por meio dos canais oficiais da escola, incluindo horários, locais de aplicação das provas e materiais necessários.\r\n\r\nA Semana de Recuperação se estenderá até o final da semana que vem, com resultados divulgados conforme o calendário acadêmico. A escola reforça que todo o processo ocorre em clima de apoio e incentivo ao aprendizado contínuo.', 'Avisos', 'uploads/1764205749_transferir (13).jpeg', NULL, '2025-11-27 01:09:09', 4),
(32, 'Colégio realiza emocionante Cantata de Natal com participação dos alunos', 'Apresentação reuniu famílias, professores e estudantes em um momento de celebração, música e espírito solidário.', 'O Colégio Marista promoveu, nesta semana, sua tradicional Cantata de Natal, reunindo alunos da Educação Infantil ao Ensino Fundamental em uma apresentação emocionante que encantou toda a comunidade escolar. O evento, realizado no pátio central da escola, trouxe canções natalinas clássicas e outras especialmente preparadas pelos professores de música.\r\n\r\nAs famílias lotaram o espaço para prestigiar o trabalho dos estudantes, que se apresentaram com grande dedicação. O espetáculo contou com arranjos musicais, coreografias simples e mensagens sobre solidariedade, esperança e união — valores celebrados pela escola durante todo o ano letivo.\r\n\r\nA equipe pedagógica destacou que a cantata é mais do que uma apresentação artística: é um momento de integração entre escola e famílias, fortalecendo vínculos e celebrando o encerramento de mais um ciclo letivo.\r\nAlém das apresentações musicais, alguns alunos participaram de leituras especiais e reflexões sobre o significado do Natal, reforçando a espiritualidade e o cuidado com o próximo.\r\n\r\nAo final do evento, a direção agradeceu a presença das famílias e parabenizou os estudantes pelo empenho. A Cantata de Natal permanece como uma das atividades mais aguardadas do calendário marista, marcando o fechamento do ano com alegria e afeto.', 'Eventos', 'uploads/1764205951_transferir (14).jpeg', NULL, '2025-11-27 01:12:31', 4),
(33, 'Colégio celebra último dia de aula no dia 5 de dezembro', 'Encerramento do ano letivo marca despedidas, atividades especiais e agradecimentos entre alunos e professores.', 'O Colégio Marista encerrou oficialmente o ano letivo no dia 5 de dezembro, em um clima de alegria, celebração e agradecimento. O último dia de aula contou com atividades especiais organizadas pelas equipes pedagógica e pastoral, oferecendo aos estudantes momentos de convivência, integração e reflexão sobre o ano que passou.\r\n\r\nAo longo do dia, as turmas participaram de dinâmicas de encerramento, entrega simbólica de mensagens, rodas de conversa, brincadeiras e revisões das conquistas alcançadas durante 2024. Para muitos alunos, o momento foi marcado por abraços, despedidas emocionadas e expectativa para o próximo ano escolar.\r\n\r\nOs professores destacaram a importância de celebrar o percurso de cada estudante, reconhecendo o esforço, o crescimento e o desenvolvimento ao longo dos meses. Já a direção reforçou o agradecimento às famílias pela parceria constante, fundamental para o sucesso do trabalho pedagógico.\r\n\r\nO colégio também lembrou aos responsáveis que as informações sobre matrículas, recuperação e datas de retorno para 2025 já estão disponibilizadas nos canais oficiais. O dia 5 marcou não apenas o fim de mais um ciclo, mas também o início da preparação para novas aprendizagens, desafios e conquistas no próximo ano.', 'Avisos', 'uploads/1764206069_ThinkstockPhotos-92284145.webp', NULL, '2025-11-27 01:14:29', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(3, 'bruno', 'bruno@email.com', '$2y$10$NW3NIgJEaAbRVHdUCKZ6L.neqv4c/r5vnQDmEVmrKPFpCkhQHVIyG', 'user', '2025-09-26 17:30:19'),
(4, 'Administrador', 'admin@site.com', '$2y$10$eVBrW6I7MB4xNaGO/g28AegfBmMVWX6w7ktVWGIi0jNUo2wBkiaBy', 'admin', '2025-09-26 17:35:06'),
(6, 'rafael', 'rafael@email.com', '$2y$10$rNfvonXXHeYb6xJrncOxTu0mLtIGrT4NSY6ppjUDrVoVkC6STVGMG', 'user', '2025-10-01 13:36:31'),
(7, 'cardapio', 'cardapio@email.com', '$2y$10$jwX559IoITXXurXgFGvAie5JKIn3LC1Q1E0l7nAuhROuumLZita4e', 'user', '2025-10-06 13:14:15');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_news_user` (`autor_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_user` FOREIGN KEY (`autor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
