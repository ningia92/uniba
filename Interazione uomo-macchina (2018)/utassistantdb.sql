-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 05:55 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utassistantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ass_studio_users`
--

CREATE TABLE `ass_studio_users` (
  `id_utente` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `flag_completato` tinyint(1) DEFAULT '0',
  `data_completamento` datetime DEFAULT NULL,
  `commento` text,
  `flag_valutato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ass_studio_users`
--

INSERT INTO `ass_studio_users` (`id_utente`, `id_studio`, `flag_completato`, `data_completamento`, `commento`, `flag_valutato`) VALUES
(39, 57, 0, NULL, NULL, NULL),
(40, 57, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ass_user_task`
--

CREATE TABLE `ass_user_task` (
  `id_studio` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url_raggiunta` text NOT NULL,
  `tempo_impiegato` decimal(10,0) NOT NULL,
  `esito` int(11) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file_audio`
--

CREATE TABLE `file_audio` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file_video`
--

CREATE TABLE `file_video` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'e'),
(2, 'p');

-- --------------------------------------------------------

--
-- Table structure for table `q_attrakdiff`
--

CREATE TABLE `q_attrakdiff` (
  `id_utente` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `r1` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r2` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r3` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r4` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r5` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r6` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r7` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r8` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r9` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r10` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r11` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r12` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r13` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r14` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r15` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r16` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r17` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r18` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r19` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r20` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r21` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r22` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r23` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r24` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r25` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r26` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r27` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `r28` enum('1','2','3','4','5','6','7') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `q_nasatlx`
--

CREATE TABLE `q_nasatlx` (
  `idStudio` int(11) NOT NULL,
  `idTask` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `mentalDemand` int(11) NOT NULL,
  `physicalDemand` int(11) NOT NULL,
  `temporalDemand` int(11) NOT NULL,
  `performance` int(11) NOT NULL,
  `effort` int(11) NOT NULL,
  `frustration` int(11) NOT NULL,
  `mean` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `q_nps`
--

CREATE TABLE `q_nps` (
  `id_utente` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `r` enum('1','2','3','4','5','6','7','8','9','10') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `q_sus`
--

CREATE TABLE `q_sus` (
  `id_utente` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `r1` enum('1','2','3','4','5') DEFAULT NULL,
  `r2` enum('1','2','3','4','5') DEFAULT NULL,
  `r3` enum('1','2','3','4','5') DEFAULT NULL,
  `r4` enum('1','2','3','4','5') DEFAULT NULL,
  `r5` enum('1','2','3','4','5') DEFAULT NULL,
  `r6` enum('1','2','3','4','5') DEFAULT NULL,
  `r7` enum('1','2','3','4','5') DEFAULT NULL,
  `r8` enum('1','2','3','4','5') DEFAULT NULL,
  `r9` enum('1','2','3','4','5') DEFAULT NULL,
  `r10` enum('1','2','3','4','5') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `q_umux`
--

CREATE TABLE `q_umux` (
  `id_utente` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `r1` int(11) NOT NULL,
  `r2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_ass_task_users_records`
--

CREATE TABLE `smt2_ass_task_users_records` (
  `id_user` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_records` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_browsers`
--

CREATE TABLE `smt2_browsers` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_browsers`
--

INSERT INTO `smt2_browsers` (`id`, `name`) VALUES
(1, 'Chrome');

-- --------------------------------------------------------

--
-- Table structure for table `smt2_cache`
--

CREATE TABLE `smt2_cache` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `layout` enum('left','center','right','liquid') NOT NULL DEFAULT 'liquid',
  `title` varchar(255) NOT NULL,
  `saved` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_cms`
--

CREATE TABLE `smt2_cms` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_cms`
--

INSERT INTO `smt2_cms` (`id`, `type`, `name`, `value`, `description`) VALUES
(1, 0, 'recordsPerTable', '20', 'Number of records to show on each tracking table. This will be the default value, and it can be overriden on the <em>Admin logs</em> section.'),
(2, 0, 'cacheDays', '60', 'Cache (in days) for HTML logs. If the requested page was not modified in this amount of time, the system will use a cached copy. Leaving it blank or setting it to <code>0</code> means that no logs will be cached: each visit will generate one HTML log.'),
(3, 0, 'maxSampleSize', '0', 'Number of logs to replay/analyze simultaneously (0 means no limit). If your database has a lot of records for the same URL, you can take into account only a small subset of logs.'),
(4, 1, 'mergeCacheUrl', '0', 'Merge all logs that have the same URL. Useful if cache is disabled and one wants to group records by page ID.'),
(5, 1, 'fetchOldUrl', '0', 'Tries to fetch a URL that could not be cached or that was deleted from cache.'),
(6, 1, 'refreshOnResize', '0', 'Reload visualization page on resizing the browser window.'),
(7, 1, 'displayWidgetInfo', '0', 'Display hover and click frequency for each interacted DOM element.'),
(8, 1, 'displayGoogleMap', '0', 'If you typed a valid Google Maps key on your <em>config.php</em> file, the client location will be shown on a map when analyzing the logs.'),
(9, 1, 'displayAvgTrack', '0', 'Display average mouse trail when visualizing simultaneous users.'),
(10, 1, 'enableDebugging', '0', 'Turn on PHP strict mode and work with JS source files instead of minimized ones.');

-- --------------------------------------------------------

--
-- Table structure for table `smt2_domains`
--

CREATE TABLE `smt2_domains` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `domain` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_exts`
--

CREATE TABLE `smt2_exts` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `dir` varchar(20) NOT NULL,
  `priority` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_exts`
--

INSERT INTO `smt2_exts` (`id`, `dir`, `priority`) VALUES
(1, 'admin-logs', 0),
(2, 'classify', 0),
(3, 'customize', 0),
(4, 'maintenance', 0),
(5, 'roles', 0),
(6, 'users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `smt2_hypernotes`
--

CREATE TABLE `smt2_hypernotes` (
  `record_id` bigint(20) UNSIGNED NOT NULL,
  `cuepoint` char(5) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `hypernote` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_jsopt`
--

CREATE TABLE `smt2_jsopt` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_jsopt`
--

INSERT INTO `smt2_jsopt` (`id`, `type`, `name`, `value`, `description`) VALUES
(1, 0, 'entryPt', '99FF66', 'Color for the mouse entry coordinate.'),
(2, 0, 'exitPt', 'FF6666', 'Color for the mouse exit coordinate.'),
(3, 0, 'regPt', 'FF00FF', 'Registration points color. Each registration point can give you a visual idea of the tracking accuracy.'),
(4, 0, 'regLn', '00CCCC', 'Registration lines color. Used to draw the mouse path.'),
(5, 0, 'click', 'FF0000', 'Mouse clicks color. One of the most relevant features to measure the implicit user interest in a page.'),
(6, 0, 'dDrop', 'AABBCC', 'Drag and drop color. Mouse clicks should be distinguished from drag and drop operations (such as selecting some text, for example).'),
(7, 0, 'varCir', 'FF9999', 'Time-depending circles color. Each circle represents the amount of time that there is no mouse movement (the user is not using the mouse).'),
(8, 0, 'cenPt', 'DDDDDD', 'Centroid color. The centroid is the geometric center of the mouse path.'),
(9, 0, 'clust', '0000FF', 'Clusters color. The k-means algorithm assigns each registration point to the cluster whose center is nearest.'),
(10, 0, 'bgColor', '000000', 'Background layer color. Self explanatory ;)'),
(11, 1, 'bgLayer', '1', 'Draw a semi-transparent background layer on bottom.'),
(12, 1, 'realTime', '1', 'You can replay the mouse path in real time or as a static overlayed image.'),
(13, 1, 'dirVect', '0', 'When replaying in <em>static</em> mode, it could be useful to display the path direction vector.'),
(14, 1, 'loadNextTrail', '0', 'Load more trails automatically (if available) for the current tracked user.');

-- --------------------------------------------------------

--
-- Table structure for table `smt2_os`
--

CREATE TABLE `smt2_os` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_os`
--

INSERT INTO `smt2_os` (`id`, `name`) VALUES
(1, 'Windows');

-- --------------------------------------------------------

--
-- Table structure for table `smt2_records`
--

CREATE TABLE `smt2_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `cache_id` bigint(20) UNSIGNED NOT NULL,
  `domain_id` smallint(5) UNSIGNED NOT NULL,
  `os_id` tinyint(3) UNSIGNED NOT NULL,
  `browser_id` tinyint(3) UNSIGNED NOT NULL,
  `browser_ver` float(3,1) UNSIGNED NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `ftu` tinyint(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `scr_width` smallint(5) UNSIGNED NOT NULL,
  `scr_height` smallint(5) UNSIGNED NOT NULL,
  `vp_width` smallint(5) UNSIGNED NOT NULL,
  `vp_height` smallint(5) UNSIGNED NOT NULL,
  `sess_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sess_time` float(7,2) UNSIGNED NOT NULL,
  `fps` tinyint(3) UNSIGNED NOT NULL,
  `coords_x` mediumtext NOT NULL,
  `coords_y` mediumtext NOT NULL,
  `clicks` mediumtext NOT NULL,
  `hovered` longtext NOT NULL,
  `clicked` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `smt2_roles`
--

CREATE TABLE `smt2_roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ext_allowed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_roles`
--

INSERT INTO `smt2_roles` (`id`, `name`, `description`, `ext_allowed`) VALUES
(1, 'admin', 'sysadmin users group', '');

-- --------------------------------------------------------

--
-- Table structure for table `smt2_users`
--

CREATE TABLE `smt2_users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `login` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `last_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smt2_users`
--

INSERT INTO `smt2_users` (`id`, `role_id`, `login`, `pass`, `name`, `email`, `website`, `registered`, `last_access`) VALUES
(1, 1, 'root', 'b33fe6a060ae2c293be4129f19fe9f98', 'System Administrator', 'root@root.com', NULL, '2016-07-02 14:39:48', '2017-07-04 11:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id_studio` int(11) NOT NULL,
  `obiettivo` varchar(256) NOT NULL,
  `descrizione` text,
  `url` text NOT NULL,
  `data_studio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_esperto` int(11) DEFAULT NULL,
  `flag_audio` tinyint(1) DEFAULT NULL,
  `flag_video` tinyint(1) DEFAULT NULL,
  `flag_comportamento` tinyint(1) DEFAULT NULL,
  `flag_q_aa` tinyint(1) DEFAULT NULL,
  `flag_q_sus` tinyint(1) DEFAULT NULL,
  `flag_q_nps` tinyint(1) DEFAULT NULL,
  `flag_q_umux` tinyint(1) DEFAULT NULL,
  `flag_q_nasatlx` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `obiettivo`, `descrizione`, `url`, `data_studio`, `id_esperto`, `flag_audio`, `flag_video`, `flag_comportamento`, `flag_q_aa`, `flag_q_sus`, `flag_q_nps`, `flag_q_umux`, `flag_q_nasatlx`) VALUES
(57, 'Valutazione portale MISE', 'lorem ipsum', 'http://www.sviluppoeconomico.gov.it/index.php/it/', '2017-07-21 14:29:13', 36, 0, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `id_studio` int(11) DEFAULT NULL,
  `obiettivo` text,
  `istruzioni` text,
  `durata_max` int(2) DEFAULT NULL,
  `url` text NOT NULL,
  `urlfinale` text NOT NULL,
  `tipologia` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `id_studio`, `obiettivo`, `istruzioni`, `durata_max`, `url`, `urlfinale`, `tipologia`) VALUES
(109, 57, 'Trovare info aziende in difficoltÃ ', 'Trovare info aziende in difficoltÃ ', 3, 'http://www.sviluppoeconomico.gov.it/index.php/it/', 'http://www.sviluppoeconomico.gov.it/index.php/it/impresa/imprese-in-difficolta', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) CHARACTER SET latin1 NOT NULL,
  `username_clean` varchar(150) CHARACTER SET latin1 NOT NULL,
  `password` varchar(225) CHARACTER SET latin1 NOT NULL,
  `email` varchar(150) CHARACTER SET latin1 NOT NULL,
  `activationtoken` varchar(225) CHARACTER SET latin1 NOT NULL,
  `last_activation_request` int(11) NOT NULL,
  `LostpasswordRequest` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sign_up_date` int(11) NOT NULL,
  `last_sign_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `username_clean`, `password`, `email`, `activationtoken`, `last_activation_request`, `LostpasswordRequest`, `active`, `group_id`, `sign_up_date`, `last_sign_in`) VALUES
(36, 'cdesolda', 'cdesolda', 'a3937f2110fafbaded19613849b7ba29ecd347b55c22610e685f66809babf746a', 'giusepperaspatelli@gmail.com', '2fdbbb11040f965b914f4c2e8ded3c62', 1477329770, 0, 1, 1, 1477329770, 1500647120),
(39, 'cdesolda1', 'cdesolda1', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giuse.pperaspatelli@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 1477330680, 1500890402),
(40, 'cdesolda2', 'cdesolda2', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giusepp.eraspatelli@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499274695),
(41, 'cdesolda3', 'cdesolda3', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giusepperaspat.elli@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499273470),
(42, 'cdesolda4', 'cdesolda4', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giusepperaspatel.li@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499274686),
(43, 'cdesolda5', 'cdesolda5', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'g.iusepperaspatelli@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499358405),
(44, 'cdesolda6', 'cdesolda6', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giusepperaspatell.i@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499362271),
(45, 'cdesolda7', 'cdesolda7', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'gius.epperaspatelli@gmail.com', '7fc03cd1b4a009222a4690edc6342c57', 0, 0, 1, 2, 0, 1499416496),
(53, 'admin', 'admin', '120e1a89c024b364a1fe6fabff55bd330c8bdc3339e4ddbbbb9ad2e6de49aeb4d', 'giusepperasp.atelli@gmail.com', '627ab9c8832feec0cd33e51ce9e6fb5b', 1481034778, 0, 1, 1, 1481034778, 1499416509);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ass_studio_users`
--
ALTER TABLE `ass_studio_users`
  ADD PRIMARY KEY (`id_utente`,`id_studio`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Indexes for table `ass_user_task`
--
ALTER TABLE `ass_user_task`
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `file_audio`
--
ALTER TABLE `file_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_audio_ibfk_1` (`task_id`),
  ADD KEY `file_audio_ibfk_2` (`user_id`);

--
-- Indexes for table `file_video`
--
ALTER TABLE `file_video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_video_ibfk_1` (`task_id`),
  ADD KEY `file_video_ibfk_2` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `q_attrakdiff`
--
ALTER TABLE `q_attrakdiff`
  ADD PRIMARY KEY (`id_utente`,`id_studio`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Indexes for table `q_nasatlx`
--
ALTER TABLE `q_nasatlx`
  ADD PRIMARY KEY (`idStudio`,`idTask`,`idUser`),
  ADD KEY `idTask` (`idTask`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `q_nps`
--
ALTER TABLE `q_nps`
  ADD PRIMARY KEY (`id_utente`,`id_studio`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Indexes for table `q_sus`
--
ALTER TABLE `q_sus`
  ADD PRIMARY KEY (`id_utente`,`id_studio`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Indexes for table `smt2_ass_task_users_records`
--
ALTER TABLE `smt2_ass_task_users_records`
  ADD PRIMARY KEY (`id_user`,`id_task`,`id_records`);

--
-- Indexes for table `smt2_browsers`
--
ALTER TABLE `smt2_browsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_cache`
--
ALTER TABLE `smt2_cache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_cms`
--
ALTER TABLE `smt2_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_domains`
--
ALTER TABLE `smt2_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_exts`
--
ALTER TABLE `smt2_exts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_hypernotes`
--
ALTER TABLE `smt2_hypernotes`
  ADD UNIQUE KEY `rcu` (`record_id`,`cuepoint`,`user_id`);

--
-- Indexes for table `smt2_jsopt`
--
ALTER TABLE `smt2_jsopt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_os`
--
ALTER TABLE `smt2_os`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_records`
--
ALTER TABLE `smt2_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_roles`
--
ALTER TABLE `smt2_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smt2_users`
--
ALTER TABLE `smt2_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`),
  ADD UNIQUE KEY `id_studio` (`id_task`,`id_studio`),
  ADD KEY `task_ibfk_1` (`id_studio`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_audio`
--
ALTER TABLE `file_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `file_video`
--
ALTER TABLE `file_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smt2_browsers`
--
ALTER TABLE `smt2_browsers`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smt2_cache`
--
ALTER TABLE `smt2_cache`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smt2_cms`
--
ALTER TABLE `smt2_cms`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `smt2_domains`
--
ALTER TABLE `smt2_domains`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smt2_exts`
--
ALTER TABLE `smt2_exts`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `smt2_jsopt`
--
ALTER TABLE `smt2_jsopt`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `smt2_os`
--
ALTER TABLE `smt2_os`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smt2_records`
--
ALTER TABLE `smt2_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smt2_roles`
--
ALTER TABLE `smt2_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smt2_users`
--
ALTER TABLE `smt2_users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ass_studio_users`
--
ALTER TABLE `ass_studio_users`
  ADD CONSTRAINT `ass_studio_users_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ass_studio_users_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Constraints for table `file_audio`
--
ALTER TABLE `file_audio`
  ADD CONSTRAINT `file_audio_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id_task`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `file_audio_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `file_video`
--
ALTER TABLE `file_video`
  ADD CONSTRAINT `file_video_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id_task`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `file_video_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `q_attrakdiff`
--
ALTER TABLE `q_attrakdiff`
  ADD CONSTRAINT `q_attrakdiff_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `q_attrakdiff_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Constraints for table `q_nasatlx`
--
ALTER TABLE `q_nasatlx`
  ADD CONSTRAINT `q_nasatlx_ibfk_1` FOREIGN KEY (`idStudio`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `q_nasatlx_ibfk_2` FOREIGN KEY (`idTask`) REFERENCES `task` (`id_task`),
  ADD CONSTRAINT `q_nasatlx_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `q_nps`
--
ALTER TABLE `q_nps`
  ADD CONSTRAINT `q_nps_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `q_nps_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Constraints for table `q_sus`
--
ALTER TABLE `q_sus`
  ADD CONSTRAINT `q_sus_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `q_sus_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
