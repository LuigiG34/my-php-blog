-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : dim. 21 mai 2023 à 16:28
-- Version du serveur : 8.0.33
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_blog_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `chapo` text NOT NULL,
  `contenu` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `id_categorie` int NOT NULL,
  `id_utilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `titre`, `chapo`, `contenu`, `created_at`, `updated_at`, `img`, `slug`, `id_categorie`, `id_utilisateur`) VALUES
(2, 'L\'avenir du développement back-end ', 'Le développement back-end a connu une croissance considérable au fil des ans et est devenu une partie essentielle de la création d\'applications Web. Cependant, avec les progrès de l\'intelligence artificielle et de l\'automatisation, l\'avenir du développement back-end est prometteur et pourrait être révolutionné par ces technologies.', 'L\'automatisation est l\'un des aspects les plus importants de l\'avenir du développement back-end. Les développeurs peuvent désormais utiliser des outils d\'automatisation pour effectuer des tâches répétitives telles que la configuration de l\'infrastructure de l\'application, l\'intégration continue et la livraison continue. Cela permet aux développeurs de gagner du temps et de se concentrer sur des tâches plus importantes, telles que la conception de l\'architecture de l\'application. L\'intelligence artificielle (IA) est un autre domaine qui pourrait révolutionner le développement back-end. Les développeurs pourraient utiliser l\'IA pour analyser les données et générer des modèles pour aider à la prise de décision. Les algorithmes d\'apprentissage automatique pourraient être utilisés pour améliorer l\'efficacité des systèmes, la sécurité et la fiabilité des applications. L\'IA pourrait également aider à automatiser les tests et à identifier les problèmes de sécurité avant qu\'ils ne deviennent critiques. Le développement basé sur les conteneurs est une autre tendance émergente dans le développement back-end. Les conteneurs sont des environnements isolés qui permettent aux développeurs de travailler sur des applications dans des environnements cohérents. Cela permet de réduire les erreurs et les conflits dans le développement, tout en permettant aux développeurs de travailler plus rapidement et de manière plus efficace. L\'avenir du développement back-end est prometteur,. avec une automatisation accrue, l\'utilisation de l\'IA et le développement basé sur les conteneurs. Les développeurs pourront travailler plus rapidement et de manière plus efficace, tout en réduisant les erreurs et en améliorant la sécurité et la fiabilité des applications. Ces avancées technologiques permettront également de répondre plus rapidement aux besoins des utilisateurs et de fournir des applications plus performantes.', '2023-05-04 11:35:35', '2023-05-13 14:28:09', 'back_end.png', 'l-avenir-du-dveloppement-back-end', 1, 6),
(3, 'L\'importance du développement front-end', 'Le développement front-end est la partie visible d\'un site Web ou d\'une application, celle avec laquelle les utilisateurs interagissent directement. Cela inclut la création de l\'interface utilisateur, de l\'expérience utilisateur et de l\'interaction avec les utilisateurs. Voici les points les plus importants du développement front-end que vous devez connaître pour créer des sites Web et des applications performants et efficaces.', 'HTML (Hypertext Markup Language) et CSS (Cascading Style Sheets) sont les deux langages de base du développement front-end. HTML est utilisé pour créer la structure de la page, tandis que CSS est utilisé pour définir le style et la présentation de la page. Il est important de comprendre ces deux langages de programmation pour créer une page Web bien structurée et bien présentée. JavaScript est un langage de programmation essentiel pour le développement front-end. Il est utilisé pour créer des pages Web interactives, des animations et des effets visuels. Les développeurs front-end peuvent également utiliser des frameworks JavaScript populaires tels que React, Angular et Vue.js pour faciliter leur travail. Le responsive design est une technique de développement front-end qui permet à une page Web de s\'adapter à différents appareils et tailles d\'écran. Les développeurs front-end doivent concevoir des pages Web qui s\'adaptent à la taille de l\'écran de l\'utilisateur, que ce soit un ordinateur de bureau, une tablette ou un téléphone portable. L\'accessibilité est un aspect important du développement front-end qui consiste à rendre les pages Web accessibles à tous les utilisateurs, y compris ceux qui ont des besoins spécifiques en matière d\'accessibilité. Les développeurs front-end doivent concevoir des pages Web qui sont facilement navigables avec les technologies d\'assistance telles que les lecteurs d\'écran. La performance est un autre aspect important du développement front-end. Les développeurs front-end doivent créer des pages Web qui se chargent rapidement et sont réactives pour offrir une expérience utilisateur optimale. Ils peuvent optimiser la vitesse de chargement de la page en utilisant des techniques telles que la mise en cache et la compression des images. Le développement front-end est un élément essentiel de la création d\'un site Web ou d\'une application. Il est important de comprendre les bases du HTML, du CSS et du JavaScript, ainsi que d\'autres aspects tels que le responsive design, l\'accessibilité et la performance. En maîtrisant ces points importants, les développeurs front-end peuvent créer des pages Web efficaces et performantes qui offrent une expérience utilisateur optimale.', '2023-05-04 11:39:08', '2023-05-04 11:39:08', 'front_end.png', 'les-points-les-plus-importants-du-developpement-front-end', 2, 6),
(4, 'L\'importance de l\'UI/UX au sein d\'une application web ou mobile', 'L\'UI (interface utilisateur) et l\'UX (expérience utilisateur) sont deux aspects essentiels de la conception d\'une application web ou mobile. Une bonne UI/UX peut faire la différence entre une application réussie et une application qui échoue. Voici pourquoi l\'UI/UX est si importante et comment elle peut contribuer au succès de votre produit.', 'L\'objectif principal de l\'UI/UX est de fournir une expérience utilisateur optimale. Une bonne conception UI/UX peut rendre l\'application plus facile à utiliser, plus intuitive et plus agréable pour l\'utilisateur. Cela peut se traduire par une meilleure rétention des utilisateurs, une augmentation du nombre de téléchargements et une meilleure perception de votre marque. Une bonne conception UI/UX peut également contribuer à augmenter les conversions, que ce soit pour un achat, une inscription ou une action spécifique. Une UI/UX bien pensée peut rendre le processus de conversion plus facile et plus fluide pour l\'utilisateur, ce qui peut se traduire par une augmentation des ventes ou des conversions. La conception UI/UX d\'une application peut également renforcer la marque de l\'entreprise. Une UI/UX bien conçue peut aider à transmettre l\'identité visuelle de l\'entreprise et à renforcer la perception de la marque par les utilisateurs. Une conception cohérente et bien pensée peut également contribuer à créer une image de marque positive et mémorable. Une bonne conception UI/UX peut également réduire les coûts de développement et de maintenance de l\'application. Une application bien conçue nécessite moins de support utilisateur et d\'assistance, ce qui peut réduire les coûts pour l\'entreprise à long terme. Enfin, une bonne conception UI/UX peut aider une application à se démarquer de la concurrence. Avec un grand nombre d\'applications disponibles sur le marché, une conception bien pensée peut aider à attirer l\'attention des utilisateurs et à les inciter à choisir votre application plutôt que celle de la concurrence. L\'UI/UX est essentielle pour la réussite d\'une application web ou mobile. Elle peut améliorer l\'expérience utilisateur, augmenter les conversions, renforcer la marque, réduire les coûts et se démarquer de la concurrence. En investissant dans une conception UI/UX bien pensée, les entreprises peuvent créer des applications réussies et efficaces qui répondent aux besoins des utilisateurs et qui contribuent à la croissance de leur entreprise.', '2023-05-04 11:44:42', '2023-05-04 11:44:42', 'ui_ux.png', 'l-importance-de-l-ui-ux-au-sein-d-une-application-web-ou-mobile', 3, 6),
(5, 'L\'importance du SEO', 'Le SEO (Search Engine Optimization) est l\'ensemble des techniques qui permettent d\'optimiser un site web pour les moteurs de recherche tels que Google, Bing ou Yahoo. Le SEO est aujourd\'hui devenu un élément clé du marketing en ligne pour toutes les entreprises qui souhaitent être visibles sur le web. Voici pourquoi le SEO est si important et comment il peut aider votre entreprise à réussir en ligne.', 'Le premier objectif du SEO est d\'augmenter la visibilité de votre site web sur les moteurs de recherche. En optimisant votre site pour les mots clés pertinents, vous pouvez vous assurer que votre site apparaît en haut des résultats de recherche pour les requêtes correspondantes. Cela peut attirer davantage de trafic vers votre site et augmenter la visibilité de votre entreprise en ligne. Les sites web qui apparaissent en haut des résultats de recherche ont tendance à être considérés comme plus crédibles et plus fiables par les utilisateurs. En optimisant votre site pour les moteurs de recherche, vous pouvez renforcer la crédibilité de votre entreprise et augmenter la confiance des utilisateurs envers votre marque. Le trafic provenant des résultats de recherche est considéré comme du trafic qualifié, car les utilisateurs ont recherché activement les informations liées à votre entreprise. Le SEO peut vous aider à attirer du trafic qualifié vers votre site web, ce qui peut augmenter les chances de convertir ces visiteurs en clients. Les résultats de recherche organiques sont gratuits, contrairement aux résultats payants qui nécessitent un investissement en publicité. En optimisant votre site pour les moteurs de recherche, vous pouvez réduire les coûts publicitaires et obtenir un retour sur investissement plus élevé pour votre entreprise. Le SEO est une stratégie à long terme qui peut vous aider à maintenir une visibilité élevée sur les moteurs de recherche pendant une période prolongée. En investissant dans une optimisation continue de votre site pour les moteurs de recherche, vous pouvez maintenir votre positionnement sur les résultats de recherche et maintenir votre trafic organique. Le SEO est essentiel pour toute entreprise qui souhaite être visible en ligne et atteindre ses objectifs de marketing. En optimisant votre site web pour les moteurs de recherche, vous pouvez augmenter votre visibilité, renforcer votre crédibilité, attirer du trafic qualifié, réduire les coûts publicitaires et maintenir une visibilité à long terme sur les moteurs de recherche. En investissant dans le SEO, vous pouvez aider votre entreprise à réussir en ligne et à atteindre ses objectifs de croissance.', '2023-05-04 11:47:46', '2023-05-04 11:47:46', 'seo.png', 'l-importance-du-seo', 4, 6),
(6, 'L\'avenir de l\'intelligence artificielle', 'L\'intelligence artificielle (IA) est en train de transformer de nombreux aspects de notre vie, de la manière dont nous communiquons et travaillons, à la manière dont nous interagissons avec les technologies. Alors que l\'IA continue de se développer et de s\'améliorer, voici quelques-unes des tendances qui pourraient façonner l\'avenir de l\'IA.', 'De plus en plus d\'applications, de gadgets et de services que nous utilisons au quotidien sont équipés d\'IA. Les assistants virtuels, les chatbots et les algorithmes de recommandation ne sont que quelques exemples de la façon dont l\'IA est déjà présente dans notre vie quotidienne. À mesure que l\'IA continue de se développer et de s\'améliorer, il est probable qu\'elle deviendra de plus en plus intégrée dans nos maisons, nos voitures et même nos vêtements. Alors que l\'IA continue de se développer, il est probable qu\'elle deviendra de plus en plus spécialisée dans des domaines spécifiques. Par exemple, l\'IA pourra être utilisée dans le domaine médical pour aider à diagnostiquer les maladies ou pour aider à concevoir de nouveaux médicaments. De même, l\'IA pourra être utilisée dans les domaines de la finance, du commerce et de la sécurité pour automatiser les processus et améliorer l\'efficacité. Une autre tendance dans l\'IA est l\'augmentation de son autonomie. Les systèmes d\'IA pourront prendre des décisions complexes sans intervention humaine et apprendre de nouvelles tâches en fonction de leur expérience. Cela peut conduire à des développements tels que des voitures autonomes, des drones et des robots qui peuvent travailler de manière autonome dans des environnements dangereux ou difficiles. Alors que l\'IA continue de se développer et d\'interagir avec les humains, il est de plus en plus important que l\'IA soit conçue et utilisée de manière éthique. Les questions telles que la transparence de l\'IA, la responsabilité des algorithmes et la protection de la vie privée sont des considérations clés pour les développeurs d\'IA et les décideurs politiques. Enfin, il est probable que l\'IA sera de plus en plus intégrée avec d\'autres technologies telles que l\'Internet des Objets (IoT) et la blockchain. Par exemple, l\'IA pourra être utilisée pour analyser les données collectées par des objets connectés tels que des capteurs pour améliorer la prise de décision en temps réel. De même, la blockchain peut être utilisée pour assurer la transparence et la sécurité des transactions effectuées par des systèmes d\'IA. L\'IA est une technologie en constante évolution qui continue de changer notre façon de vivre et de travailler. Les tendances clés pour l\'avenir de l\'IA incluent une augmentation de sa présence dans notre', '2023-05-04 11:50:40', '2023-05-04 11:50:40', 'ai.png', 'l-avenir-de-l-intelligence-artificielle', 5, 6),
(7, 'le DevOps et son rôle au sein du secteur du numérique', 'Le développement et l\'exploitation d\'applications sont deux domaines souvent considérés comme distincts. Le développement est généralement effectué par des équipes de développeurs, tandis que l\'exploitation est gérée par des équipes d\'opérations. Cependant, ces deux domaines sont de plus en plus intégrés grâce à la pratique DevOps.', 'DevOps est une approche qui vise à intégrer le développement et l\'exploitation d\'applications. Elle repose sur la collaboration étroite entre les équipes de développement et d\'opérations, ainsi que sur l\'automatisation des processus de développement, de test et de déploiement. L\'objectif principal de DevOps est d\'augmenter la rapidité et la qualité des déploiements d\'applications en automatisant le plus possible de processus et en assurant une communication efficace entre les différentes équipes impliquées. Dans le monde numérique en constante évolution, les entreprises doivent être en mesure de mettre à jour rapidement leurs applications pour rester compétitives. La pratique DevOps permet de déployer des mises à jour en continu et de manière fiable, sans interruption de service pour les utilisateurs. Avec des millions d\'utilisateurs en ligne, la qualité des applications est plus importante que jamais. Les processus d\'automatisation de DevOps permettent de tester les applications à chaque étape du développement, ce qui permet de détecter les erreurs dès le début et de les corriger rapidement. La sécurité est une préoccupation majeure pour les entreprises numériques. Les processus d\'automatisation de DevOps permettent de détecter et de résoudre rapidement les vulnérabilités de sécurité, ce qui contribue à renforcer la sécurité des applications. Les utilisateurs attendent des applications rapides, fiables et faciles à utiliser. Les processus d\'automatisation de DevOps permettent de détecter rapidement les problèmes de performance et de les résoudre, ce qui permet d\'offrir une expérience utilisateur de qualité supérieure. Le DevOps est une pratique qui continue de gagner en popularité dans le monde numérique. En intégrant le développement et l\'exploitation d\'applications, elle permet aux entreprises de mettre à jour rapidement leurs applications, de garantir leur qualité, de renforcer leur sécurité et d\'offrir une expérience utilisateur de qualité supérieure. En outre, en automatisant les processus de développement, de test et de déploiement, DevOps permet aux équipes de se concentrer sur des tâches à plus forte valeur ajoutée et de gagner en efficacité.', '2023-05-04 11:53:29', '2023-05-04 11:53:29', 'dev_ops.png', 'le-devops-et-son-rle-au-sein-du-secteur-du-numrique', 6, 6),
(8, 'L\'importance et l\'avenir de la cybersécurité', 'Avec l\'augmentation de la dépendance aux technologies numériques, la cybersécurité est devenue un enjeu crucial pour les entreprises, les gouvernements et les particuliers. En effet, les cyberattaques peuvent causer des dommages importants, tels que la perte de données, la violation de la vie privée et les pertes financières. Voici pourquoi la cybersécurité est si importante et quels sont les défis à venir.', 'Les données sensibles, telles que les informations financières et les données personnelles, doivent être protégées contre les cyberattaques. Les entreprises et les gouvernements ont l\'obligation de protéger ces données et de garantir la vie privée de leurs clients et citoyens. Les cyberattaques peuvent perturber les services en ligne, comme les services bancaires en ligne, les services de santé et les services publics. Ces perturbations peuvent avoir des conséquences graves sur la vie quotidienne des gens. Les cyberattaques peuvent causer des pertes financières importantes pour les entreprises et les particuliers. Par exemple, les ransomwares peuvent bloquer l\'accès aux données et exiger une rançon pour les débloquer. Les cyberattaques deviennent de plus en plus sophistiquées, rendant la détection et la prévention plus difficiles. Les attaques peuvent être menées par des cybercriminels professionnels, des États-nations ou même des groupes terroristes. Les réseaux informatiques deviennent de plus en plus complexes, avec des systèmes interconnectés, des infrastructures cloud et des appareils connectés à Internet. Cela crée des vulnérabilités supplémentaires qui peuvent être exploitées par des cyberattaques. Il y a une pénurie de personnel qualifié en cybersécurité, ce qui rend difficile pour les entreprises de protéger leurs systèmes contre les cyberattaques. Les experts en cybersécurité sont en forte demande, mais il y a peu de personnes formées pour répondre à cette demande. L\'intelligence artificielle peut être utilisée pour détecter les menaces de manière plus rapide et efficace, ainsi que pour automatiser certaines tâches de cybersécurité. La blockchain peut être utilisée pour sécuriser les données en les stockant de manière décentralisée et cryptée.', '2023-05-04 11:56:20', '2023-05-04 11:56:20', 'cyber_security.png', 'l-importance-et-l-avenir-de-la-cyberscurit', 7, 6);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `type`, `description`, `slug`) VALUES
(1, 'Back-End', 'Cette catégorie représente tout ce qui concerne la programmation serveur et les technologies du côté serveur telles que PHP, Ruby, Python, Node.js, les bases de données, la gestion des serveurs, etc.', 'back-end'),
(2, 'Front-End', 'Cette catégorie représente tout ce qui concerne la création d\'interfaces utilisateur telles que HTML, CSS, JavaScript, React, Vue.js, Angular, etc.', 'front-end'),
(3, 'UI/UX', 'Cette catégorie représente tout ce qui concerne l\'expérience utilisateur et l\'interface utilisateur, tel que la conception d\'interface utilisateur, l\'ergonomie, la typographie, l\'utilisation de la couleur, etc.', 'ui-ux'),
(4, 'SEO', 'Cette catégorie représente tout ce qui concerne l\'optimisation pour les moteurs de recherche, tels que les bonnes pratiques pour améliorer le référencement naturel, les balises meta, la structure du site web, etc.', 'seo'),
(5, 'IA', 'Cette catégorie représente tout ce qui concerne l\'intelligence artificielle, tels que le machine learning, la reconnaissance d\'image, la reconnaissance de la parole, etc', 'ia'),
(6, 'DevOps', 'Cette catégorie représente tout ce qui concerne la gestion des opérations de développement, tels que les tests, la gestion de versions, les déploiements automatisés, les workflows, etc.', 'dev-ops'),
(7, 'Sécurité', 'Cette catégorie représente tout ce qui concerne la sécurité des applications et des sites web, tels que les techniques de cryptographie, les attaques et les défenses possibles, la prévention des attaques XSS, etc.', 'securite');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int NOT NULL,
  `contenu` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_statut_commentaire` int NOT NULL DEFAULT '2',
  `id_utilisateur` int NOT NULL,
  `id_article` int NOT NULL,
  `id_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `contenu`, `created_at`, `id_statut_commentaire`, `id_utilisateur`, `id_article`, `id_admin`) VALUES
(1, 'Ceci est un test', '2023-05-07 10:33:31', 1, 6, 2, 6),
(20, 'Incroyable', '2023-05-07 15:00:13', 1, 6, 2, 6),
(21, 'Incroyable', '2023-05-07 15:00:16', 1, 6, 3, 6),
(22, 'Incroyable', '2023-05-07 15:00:19', 1, 6, 4, 6),
(23, 'Incroyable', '2023-05-07 15:00:22', 1, 6, 5, 6),
(24, 'Incroyable', '2023-05-07 15:00:24', 1, 6, 6, 6),
(25, 'Incroyable', '2023-05-07 15:00:28', 1, 6, 7, 6),
(26, 'Incroyable', '2023-05-07 15:00:31', 1, 6, 8, 6),
(27, 'Commentaire désagréable', '2023-05-07 15:02:41', 2, 6, 2, NULL),
(28, 'Commentaire', '2023-05-07 15:06:18', 1, 11, 2, 6),
(29, 'Commentaire', '2023-05-07 15:06:20', 1, 11, 3, 6),
(30, 'Commentaire', '2023-05-07 15:06:23', 1, 11, 4, 6),
(31, 'Commentaire', '2023-05-07 15:06:26', 1, 11, 5, 6),
(32, 'Commentaire', '2023-05-07 15:06:29', 1, 11, 6, 6),
(33, 'Commentaire', '2023-05-07 15:06:33', 1, 11, 7, 6),
(34, 'Commentaire', '2023-05-07 15:06:35', 1, 11, 8, 6),
(35, 'J\'adore ce blog', '2023-05-07 15:07:48', 1, 13, 2, 6),
(36, 'J\'adore ce blog', '2023-05-07 15:07:57', 1, 13, 3, 6),
(37, 'J\'adore ce blog', '2023-05-07 15:08:00', 1, 13, 4, 6),
(38, 'J\'adore ce blog', '2023-05-07 15:08:02', 1, 13, 5, 6),
(39, 'J\'adore ce blog', '2023-05-07 15:08:06', 1, 13, 6, 6),
(40, 'J\'adore ce blog', '2023-05-07 15:08:08', 1, 13, 7, 6),
(41, 'J\'adore ce blog', '2023-05-07 15:08:10', 1, 13, 8, 6);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Structure de la table `statut_commentaire`
--

CREATE TABLE `statut_commentaire` (
  `id_statut_commentaire` int NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statut_commentaire`
--

INSERT INTO `statut_commentaire` (`id_statut_commentaire`, `type`) VALUES
(1, 'VALID'),
(2, 'NOVALID');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rgpd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_role` int NOT NULL DEFAULT '2',
  `token_reset` varchar(255) DEFAULT NULL,
  `is_actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `email`, `mot_de_passe`, `created_at`, `rgpd_date`, `id_role`, `token_reset`, `is_actif`) VALUES
(6, 'Admin', 'admin@admin.com', '$argon2i$v=19$m=65536,t=4,p=1$OS5GL0V0OThOazQ1NTl3cw$vBKXTX3nGvL1bX0boCzp9WEXGU5ii0vq7zxgHWfwwrg', '2023-04-29 13:08:35', '2023-04-29 13:08:35', 1, NULL, 1),
(9, 'Jean', 'jean@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UGd5cERCYjBxc1R5RndlaA$YbbmmRroIUi0e2+hAMmcWPzFCBfabgOiE+t4JdpAxyg', '2023-05-01 11:17:01', '2023-05-01 11:17:01', 2, NULL, 1),
(11, 'Francesco', 'luigi@test.com', '$argon2i$v=19$m=65536,t=4,p=1$NnpZMEpJVU56Lmo2c0x1Wg$ZPl3+cXhNu37kNktfy4CTLLeWMikxHc7PHAleVe3Ygk', '2023-05-01 12:48:47', '2023-05-01 12:48:47', 2, 'NULL', 1),
(12, 'Nicolas', 'luigiuser@test.com', '$argon2i$v=19$m=65536,t=4,p=1$TnhsRy5sZ01MZmdLSnhFWQ$rGGMTaNywEksDbNuE9RCee4cOEzEj1VpiGivfpghWMg', '2023-05-07 12:58:11', '2023-05-07 12:58:11', 2, NULL, 1),
(13, 'John', 'john@doe.com', '$argon2i$v=19$m=65536,t=4,p=1$ZHVVQnJSeGpMdlFSZ0lkMQ$eD63cy4c+tO0eKWD9p5/SnLgSOMonAFbwWA0aojcEao', '2023-05-07 15:07:11', '2023-05-07 15:07:11', 2, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_article_categorie` (`id_categorie`),
  ADD KEY `fk_article_user` (`id_utilisateur`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `fk_comments_user` (`id_admin`),
  ADD KEY `fk_comments_article` (`id_article`),
  ADD KEY `fk_comments_status` (`id_statut_commentaire`),
  ADD KEY `fk_comments_admin` (`id_utilisateur`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `statut_commentaire`
--
ALTER TABLE `statut_commentaire`
  ADD PRIMARY KEY (`id_statut_commentaire`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `statut_commentaire`
--
ALTER TABLE `statut_commentaire`
  MODIFY `id_statut_commentaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_article_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_comments_admin` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_status` FOREIGN KEY (`id_statut_commentaire`) REFERENCES `statut_commentaire` (`id_statut_commentaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_user` FOREIGN KEY (`id_admin`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
