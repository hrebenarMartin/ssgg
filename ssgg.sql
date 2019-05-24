-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 24.Máj 2019, 16:01
-- Verzia serveru: 10.1.37-MariaDB
-- Verzia PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `ssgg`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `applications`
--

CREATE TABLE `applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `conference_id` int(10) NOT NULL,
  `day1_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day1_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day1_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day2_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day2_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day2_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day3_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day3_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day3_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day4_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day4_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day4_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day5_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day5_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day5_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `special_1` tinyint(1) NOT NULL DEFAULT '0',
  `special_2` tinyint(1) NOT NULL DEFAULT '0',
  `special_3` tinyint(1) NOT NULL DEFAULT '0',
  `accom_1` tinyint(1) NOT NULL DEFAULT '0',
  `accom_2` tinyint(1) NOT NULL DEFAULT '0',
  `accom_3` tinyint(1) NOT NULL DEFAULT '0',
  `accom_4` tinyint(1) NOT NULL DEFAULT '0',
  `accom_5` tinyint(1) NOT NULL DEFAULT '0',
  `extra` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accom_98` int(11) DEFAULT NULL,
  `accom_99` int(11) DEFAULT NULL,
  `pay_option` int(11) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `conference_id`, `day1_breakfast`, `day1_lunch`, `day1_dinner`, `day2_breakfast`, `day2_lunch`, `day2_dinner`, `day3_breakfast`, `day3_lunch`, `day3_dinner`, `day4_breakfast`, `day4_lunch`, `day4_dinner`, `day5_breakfast`, `day5_lunch`, `day5_dinner`, `special_1`, `special_2`, `special_3`, `accom_1`, `accom_2`, `accom_3`, `accom_4`, `accom_5`, `extra`, `status`, `created_at`, `updated_at`, `accom_98`, `accom_99`, `pay_option`, `paid`) VALUES
(6, 1, 8, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 3, '2019-03-09 10:29:24', '2019-05-05 13:11:47', 0, 1, 1, 1),
(8, 9999, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 3, '2019-05-23 08:23:55', '2019-05-23 08:24:53', 0, 1, NULL, 0),
(9, 8, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 3, '2019-05-23 08:49:28', '2019-05-23 10:12:58', 0, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `conference`
--

CREATE TABLE `conference` (
  `id` int(10) NOT NULL,
  `title_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `address_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_start` date NOT NULL,
  `registration_end` date NOT NULL,
  `conference_start` date NOT NULL,
  `conference_end` date NOT NULL,
  `proceedings_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `schedule_sk` text COLLATE utf8mb4_unicode_ci,
  `schedule_en` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `conference`
--

INSERT INTO `conference` (`id`, `title_sk`, `title_en`, `status`, `address_city`, `address_place`, `address_country`, `registration_start`, `registration_end`, `conference_start`, `conference_end`, `proceedings_file`, `created_at`, `updated_at`, `year`, `volume`, `lat`, `lng`, `schedule_sk`, `schedule_en`) VALUES
(8, 'Česko-Slovenská konferencia pre geometriu a grafiku', 'SLOVAK-CZECH CONFERENCE ON GEOMETRY AND GRAPHICS', 1, 'Trenčianske Teplice', 'Park Hotel', '1', '2019-02-01', '2019-09-01', '2019-09-09', '2019-09-12', NULL, '2019-02-17 13:09:27', '2019-05-16 16:55:36', 2019, 28, 48.90513989651779, 18.1863534450531, 'WIP', 'WIP'),
(9, 'Česko-Slovenská konferencia pre geometriu a grafiku', 'SLOVAK-CZECH CONFERENCE ON GEOMETRY AND GRAPHICS', 3, 'Vrtašské podhradie', 'Vrtašské podhradie', '1', '2017-05-01', '2017-09-01', '2017-09-11', '2017-09-14', 'conference_2017.pdf', '2019-04-04 11:06:05', '2019-04-04 12:15:33', 2017, 26, 49.064608652659466, 18.152535868907762, 'MONDAY, 11.9.2017\r\n1200	Registration of participants\r\n1300	Lunch\r\nChairpersons: Velichová, Lávička\r\n\r\n1700\r\n\r\nSymposium Opening\r\n\r\n1710\r\n\r\nInvited lecture\r\nVajsáblová Margita\r\n\r\nGeometric Tools in a Precision of Image Elements on Maps\r\n\r\n1800	Dinner\r\n1900\r\n\r\nWelcome evening\r\n\r\n     \r\nTUESDAY, 12.9.2017\r\n800	Breakfast	 \r\n 	Chairman: Lávička\r\n900	Invited lecture \r\nOdehnal Boris \r\nHermite-Interpolation of Ruled Surfaces and Canal Surfaces\r\n1000	Coffee break\r\n1030	Stachel Hellmuth	Two Particular Quadratic Cones\r\n1050	Weiss Gunter	Proofs by Visualisations Instead of Words\r\n1110	Molnár Emil\r\nSzirmai Jenő	Non-Euclidean Polyhedral Manifolds, Models and Visualization\r\n1130	Notowidigdo Gennady	The Importance of Linear Algebra in Trigonometry\r\n1200	Lunch\r\n \r\n 	Chaiworman: Richtáriková\r\n1410	\r\nLávička Miroslav\r\nBizzarri Michal\r\nVršek Ján\r\n\r\nRational Approximation of Square-Root Parametrizable Curves\r\n1430	Bizzarri Michal\r\nLávička Miroslav \r\nŠír Zbyněk\r\nVršek Ján	Linear Approach to Interpolations with Polynomial PN Surfaces\r\n1450\r\n\r\nBlažková Eva \r\nŠír Zdeněk\r\nMultivalued Support Function at Inflection Points of Planar Curves\r\n\r\n1510	Chalmovianský Pavel	Local Intersection of Curves\r\n1530	Coffee break\r\n 	Chaiworman: Tomiczková\r\n1600	Sroka-Bizon Monika \r\nPolinceusz Piotr	Tensegrity Structures - the Idea and Realization\r\n1620	Tytkowski Krzysztof\r\nThe Addition of Two Imaging Parallel Projection\r\n1640	Zamboj Michal	On Methods of Synthetic Projective Geometry\r\n1700	Vršek Jan \r\nLávička Miroslav\r\nAlcázar J.G.	Hledání symetrií algebraických křivek\r\n1720	Posters:\r\n 	Kmeťová Marika	Visualisation in Problem Solving\r\n 	Kolomazník Ivan\r\nČervenka František	Modelování ploch v technické praxi a jejich 3D tisk\r\n1800	Dinner\r\n2000	Valné zhromaždenie Slovenskej spoločnosti pre Geometriu \r\na Grafiku a Českej spoločnosti pre Geometriu a Grafiku\r\nWEDNESDAY, 13.9.2017\r\n800	Breakfast\r\n 	Chairman: Chalmovianský\r\n900	Invited lecture \r\nPech Pavel	Investigation of Loci in Dynamic Geometric Environment\r\n1000	Coffee break\r\n1030	Tomiczková Světlana	Geometrický software a výuka (nejen diferenciální) geometrie\r\n1050	Kolcun Alexej\r\nRaunigr Petr \r\nParametrická hladkosť pri plánovaní pohybu robota\r\n1110	Bátorová Martina\r\nKudličková Soňa	Softvérová podpora výučby deskriptívnej geometrie a geometrického modelovania na FMFI UK\r\n1130	Kudličková Soňa\r\nMackovová Alžbeta\r\nMartina Bátorová \r\nKonštrukcie elipsy v interakcii s GeoGebrou\r\n1200	Lunch\r\n1300	Trip to local pictoresque places -	Slovak glass museum in Lednické Rovne (with glass shop) Lednica Castle\r\n1900\r\n\r\nConference Dinner\r\n\r\n \r\nTHURSDAY, 14.9.2075\r\n800	Breakfast	 \r\n 	Chairwoman: Vajsáblová\r\n900	Králová Alice\r\nZajímavé vlastnosti elipsy a hyperboly nad rámec běžného učivas\r\n920	Ferdiánová Věra	Mascheroniho konstrukce\r\n940	Šafařík Jan Slaběňáková Jana Sivčák Jozef	Výuka deskriptivni geometrie na Stavební fakultě VUT a nové studijní materiály vytvářené v dynamickém systému GeoGebra\r\n1000	Coffee break\r\n1030	Holešová Michaela	Ovals in Technical Practice\r\n1050	Plenary discussion	 \r\n \r\n1110	SLOVAK-CZECH  GEOGEBRA WORKSHOP opening\r\n1120	Hašek Roman	Dynamická geometrie online\r\n1140	Maťašovský Alexander, \r\nVisnyai Tomáš	Možnosti zásuvného modulu GeoGebra systému Moodle\r\n1200	Lunch\r\n1300	SLOVAK-CZECH  GEOGEBRA WORKSHOP\r\n1310	Volná Jana\r\nVolný Petr	CAS v GeoGebře\r\n1330	Gergelitsová Šárka\r\nHolan Tomáš	Jak rozpohybovat GeoGebru?\r\n1350	Schreiberová Petra	Grafické znázornění dat v GeoGebře\r\n1410	Morávková Zuzana	Základy skriptování v GeoGebře\r\n1430	Paláček Radomír	Diferenciální a integrální počet v GeoGebře\r\n1450	Čmelková Viera	GeoGebra a výučba zobrazovacích metód', 'MONDAY, 11.9.2017\r\n1200	Registration of participants\r\n1300	Lunch\r\nChairpersons: Velichová, Lávička\r\n\r\n1700\r\n\r\nSymposium Opening\r\n\r\n1710\r\n\r\nInvited lecture\r\nVajsáblová Margita\r\n\r\nGeometric Tools in a Precision of Image Elements on Maps\r\n\r\n1800	Dinner\r\n1900\r\n\r\nWelcome evening\r\n\r\n     \r\nTUESDAY, 12.9.2017\r\n800	Breakfast	 \r\n 	Chairman: Lávička\r\n900	Invited lecture \r\nOdehnal Boris \r\nHermite-Interpolation of Ruled Surfaces and Canal Surfaces\r\n1000	Coffee break\r\n1030	Stachel Hellmuth	Two Particular Quadratic Cones\r\n1050	Weiss Gunter	Proofs by Visualisations Instead of Words\r\n1110	Molnár Emil\r\nSzirmai Jenő	Non-Euclidean Polyhedral Manifolds, Models and Visualization\r\n1130	Notowidigdo Gennady	The Importance of Linear Algebra in Trigonometry\r\n1200	Lunch\r\n \r\n 	Chaiworman: Richtáriková\r\n1410	\r\nLávička Miroslav\r\nBizzarri Michal\r\nVršek Ján\r\n\r\nRational Approximation of Square-Root Parametrizable Curves\r\n1430	Bizzarri Michal\r\nLávička Miroslav \r\nŠír Zbyněk\r\nVršek Ján	Linear Approach to Interpolations with Polynomial PN Surfaces\r\n1450\r\n\r\nBlažková Eva \r\nŠír Zdeněk\r\nMultivalued Support Function at Inflection Points of Planar Curves\r\n\r\n1510	Chalmovianský Pavel	Local Intersection of Curves\r\n1530	Coffee break\r\n 	Chaiworman: Tomiczková\r\n1600	Sroka-Bizon Monika \r\nPolinceusz Piotr	Tensegrity Structures - the Idea and Realization\r\n1620	Tytkowski Krzysztof\r\nThe Addition of Two Imaging Parallel Projection\r\n1640	Zamboj Michal	On Methods of Synthetic Projective Geometry\r\n1700	Vršek Jan \r\nLávička Miroslav\r\nAlcázar J.G.	Hledání symetrií algebraických křivek\r\n1720	Posters:\r\n 	Kmeťová Marika	Visualisation in Problem Solving\r\n 	Kolomazník Ivan\r\nČervenka František	Modelování ploch v technické praxi a jejich 3D tisk\r\n1800	Dinner\r\n2000	Valné zhromaždenie Slovenskej spoločnosti pre Geometriu \r\na Grafiku a Českej spoločnosti pre Geometriu a Grafiku\r\nWEDNESDAY, 13.9.2017\r\n800	Breakfast\r\n 	Chairman: Chalmovianský\r\n900	Invited lecture \r\nPech Pavel	Investigation of Loci in Dynamic Geometric Environment\r\n1000	Coffee break\r\n1030	Tomiczková Světlana	Geometrický software a výuka (nejen diferenciální) geometrie\r\n1050	Kolcun Alexej\r\nRaunigr Petr \r\nParametrická hladkosť pri plánovaní pohybu robota\r\n1110	Bátorová Martina\r\nKudličková Soňa	Softvérová podpora výučby deskriptívnej geometrie a geometrického modelovania na FMFI UK\r\n1130	Kudličková Soňa\r\nMackovová Alžbeta\r\nMartina Bátorová \r\nKonštrukcie elipsy v interakcii s GeoGebrou\r\n1200	Lunch\r\n1300	Trip to local pictoresque places -	Slovak glass museum in Lednické Rovne (with glass shop) Lednica Castle\r\n1900\r\n\r\nConference Dinner\r\n\r\n \r\nTHURSDAY, 14.9.2075\r\n800	Breakfast	 \r\n 	Chairwoman: Vajsáblová\r\n900	Králová Alice\r\nZajímavé vlastnosti elipsy a hyperboly nad rámec běžného učivas\r\n920	Ferdiánová Věra	Mascheroniho konstrukce\r\n940	Šafařík Jan Slaběňáková Jana Sivčák Jozef	Výuka deskriptivni geometrie na Stavební fakultě VUT a nové studijní materiály vytvářené v dynamickém systému GeoGebra\r\n1000	Coffee break\r\n1030	Holešová Michaela	Ovals in Technical Practice\r\n1050	Plenary discussion	 \r\n \r\n1110	SLOVAK-CZECH  GEOGEBRA WORKSHOP opening\r\n1120	Hašek Roman	Dynamická geometrie online\r\n1140	Maťašovský Alexander, \r\nVisnyai Tomáš	Možnosti zásuvného modulu GeoGebra systému Moodle\r\n1200	Lunch\r\n1300	SLOVAK-CZECH  GEOGEBRA WORKSHOP\r\n1310	Volná Jana\r\nVolný Petr	CAS v GeoGebře\r\n1330	Gergelitsová Šárka\r\nHolan Tomáš	Jak rozpohybovat GeoGebru?\r\n1350	Schreiberová Petra	Grafické znázornění dat v GeoGebře\r\n1410	Morávková Zuzana	Základy skriptování v GeoGebře\r\n1430	Paláček Radomír	Diferenciální a integrální počet v GeoGebře\r\n1450	Čmelková Viera	GeoGebra a výučba zobrazovacích metód'),
(10, 'Česko-Slovenská konferencia pre geometriu a grafiku', 'CZECH-SLOVAK CONFERENCE ON GEOMETRY AND GRAPHICS', 3, 'Rožnov pod Radhoštěm', 'Rožnov pod Radhoštěm', '2', '2016-05-01', '2016-09-01', '2016-09-12', '2016-09-15', 'conference_2016.pdf', '2019-04-04 11:09:43', '2019-04-04 11:19:58', 2016, 25, 49.4660411, 18.0862098, '---', '---'),
(11, 'Česko-Slovenská konferencia pre geometriu a grafiku', 'SLOVAK-CZECH CONFERENCE ON GEOMETRY AND GRAPHICS', 3, 'Terchová', 'Terchová', '1', '2015-05-01', '2015-09-01', '2015-09-14', '2015-09-18', 'conference_2015.pdf', '2019-04-04 11:12:57', '2019-04-04 11:20:11', 2015, 24, 49.252464, 18.9869713, '---', '---');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `conference_config`
--

CREATE TABLE `conference_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `conference_id` int(10) NOT NULL,
  `day1_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day1_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day1_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day2_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day2_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day2_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day3_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day3_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day3_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day4_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day4_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day4_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `day5_breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `day5_lunch` tinyint(1) NOT NULL DEFAULT '0',
  `day5_dinner` tinyint(1) NOT NULL DEFAULT '0',
  `special_1` tinyint(1) NOT NULL DEFAULT '0',
  `special_1_sk` text COLLATE utf8mb4_unicode_ci,
  `special_1_en` text COLLATE utf8mb4_unicode_ci,
  `special_2` tinyint(1) NOT NULL DEFAULT '0',
  `special_2_sk` text COLLATE utf8mb4_unicode_ci,
  `special_2_en` text COLLATE utf8mb4_unicode_ci,
  `special_3` tinyint(1) NOT NULL DEFAULT '0',
  `special_3_sk` text COLLATE utf8mb4_unicode_ci,
  `special_3_en` text COLLATE utf8mb4_unicode_ci,
  `accom_1` tinyint(1) NOT NULL DEFAULT '0',
  `accom_1_price` int(11) NOT NULL DEFAULT '0',
  `accom_2` tinyint(1) NOT NULL DEFAULT '0',
  `accom_2_price` int(11) NOT NULL DEFAULT '0',
  `accom_3` tinyint(1) NOT NULL DEFAULT '0',
  `accom_3_price` int(11) NOT NULL DEFAULT '0',
  `accom_4` tinyint(1) NOT NULL DEFAULT '0',
  `accom_4_price` int(11) NOT NULL DEFAULT '0',
  `accom_5` tinyint(1) NOT NULL DEFAULT '0',
  `accom_5_price` int(11) NOT NULL DEFAULT '0',
  `extra_info_sk` text COLLATE utf8mb4_unicode_ci,
  `extra_info_en` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `conference_config`
--

INSERT INTO `conference_config` (`id`, `conference_id`, `day1_breakfast`, `day1_lunch`, `day1_dinner`, `day2_breakfast`, `day2_lunch`, `day2_dinner`, `day3_breakfast`, `day3_lunch`, `day3_dinner`, `day4_breakfast`, `day4_lunch`, `day4_dinner`, `day5_breakfast`, `day5_lunch`, `day5_dinner`, `special_1`, `special_1_sk`, `special_1_en`, `special_2`, `special_2_sk`, `special_2_en`, `special_3`, `special_3_sk`, `special_3_en`, `accom_1`, `accom_1_price`, `accom_2`, `accom_2_price`, `accom_3`, `accom_3_price`, `accom_4`, `accom_4_price`, `accom_5`, `accom_5_price`, `extra_info_sk`, `extra_info_en`, `created_at`, `updated_at`) VALUES
(6, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 1, 81, 0, 0, 1, 63, 0, 0, 0, 0, '---', '---', '2019-05-16 16:55:36', '2019-05-16 16:55:36'),
(7, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2019-04-04 11:36:27', '2019-04-04 11:36:27'),
(8, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2019-04-04 11:19:58', '2019-04-04 11:19:58'),
(9, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2019-04-04 11:20:11', '2019-04-04 11:20:11');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `conference_images`
--

CREATE TABLE `conference_images` (
  `id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `alt_name` varchar(255) DEFAULT NULL,
  `mime` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `conference_images`
--

INSERT INTO `conference_images` (`id`, `item_id`, `image`, `ext`, `created_at`, `alt_name`, `mime`) VALUES
(1, 8, 'conference-2019-802733712.jpg', '.jpg', '2019-03-07 15:27:45', '', 'image/jpeg'),
(2, 9, 'conference-2017-283472866.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(3, 9, 'conference-2017-65827349.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(4, 9, 'conference-2017-1267076076.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(5, 9, 'conference-2017-578955899.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(6, 9, 'conference-2017-1562471563.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(7, 9, 'conference-2017-279858314.jpg', '.jpg', '2019-04-04 13:34:42', '', 'image/jpeg'),
(8, 9, 'conference-2017-1205230460.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(9, 9, 'conference-2017-1187147281.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(10, 9, 'conference-2017-723678252.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(11, 9, 'conference-2017-195694302.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(12, 9, 'conference-2017-464605465.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(13, 9, 'conference-2017-1185807023.jpg', '.jpg', '2019-04-04 13:34:44', '', 'image/jpeg'),
(14, 9, 'conference-2017-2134046732.jpg', '.jpg', '2019-04-04 13:34:45', '', 'image/jpeg'),
(15, 9, 'conference-2017-652071843.jpg', '.jpg', '2019-04-04 13:34:45', '', 'image/jpeg'),
(16, 9, 'conference-2017-1960297195.jpg', '.jpg', '2019-04-04 13:34:45', '', 'image/jpeg'),
(17, 9, 'conference-2017-629303386.jpg', '.jpg', '2019-04-04 13:34:46', '', 'image/jpeg'),
(18, 9, 'conference-2017-1888548245.jpg', '.jpg', '2019-04-04 13:34:46', '', 'image/jpeg'),
(19, 9, 'conference-2017-1247947473.jpg', '.jpg', '2019-04-04 13:34:46', '', 'image/jpeg'),
(20, 9, 'conference-2017-1744089345.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(21, 9, 'conference-2017-1056254017.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(22, 9, 'conference-2017-1187782425.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(23, 9, 'conference-2017-90117772.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(24, 9, 'conference-2017-1460192428.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(25, 9, 'conference-2017-1871395906.jpg', '.jpg', '2019-04-04 13:34:47', '', 'image/jpeg'),
(26, 9, 'conference-2017-2125155736.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(27, 9, 'conference-2017-2027826312.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(28, 9, 'conference-2017-575305155.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(29, 9, 'conference-2017-1257378373.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(30, 9, 'conference-2017-2136655398.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(31, 9, 'conference-2017-558424996.jpg', '.jpg', '2019-04-04 13:34:49', '', 'image/jpeg'),
(32, 9, 'conference-2017-323307585.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(33, 9, 'conference-2017-1916908853.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(34, 9, 'conference-2017-559321531.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(35, 9, 'conference-2017-414538619.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(36, 9, 'conference-2017-1108512462.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(37, 9, 'conference-2017-1690069641.jpg', '.jpg', '2019-04-04 13:34:51', '', 'image/jpeg'),
(38, 9, 'conference-2017-1528491295.jpg', '.jpg', '2019-04-04 13:34:52', '', 'image/jpeg'),
(39, 9, 'conference-2017-1510094267.jpg', '.jpg', '2019-04-04 13:34:52', '', 'image/jpeg'),
(40, 9, 'conference-2017-677173431.jpg', '.jpg', '2019-04-04 13:34:53', '', 'image/jpeg'),
(41, 9, 'conference-2017-369679890.jpg', '.jpg', '2019-04-04 13:34:53', '', 'image/jpeg'),
(42, 9, 'conference-2017-281093088.jpg', '.jpg', '2019-04-04 13:34:53', '', 'image/jpeg'),
(43, 9, 'conference-2017-402634945.jpg', '.jpg', '2019-04-04 13:34:53', '', 'image/jpeg'),
(44, 9, 'conference-2017-1123138095.jpg', '.jpg', '2019-04-04 13:34:54', '', 'image/jpeg'),
(45, 9, 'conference-2017-1997767838.jpg', '.jpg', '2019-04-04 13:34:54', '', 'image/jpeg'),
(46, 9, 'conference-2017-1601979637.jpg', '.jpg', '2019-04-04 13:34:54', '', 'image/jpeg'),
(47, 9, 'conference-2017-320280396.jpg', '.jpg', '2019-04-04 13:34:55', '', 'image/jpeg'),
(48, 9, 'conference-2017-1149030451.jpg', '.jpg', '2019-04-04 13:34:55', '', 'image/jpeg'),
(49, 9, 'conference-2017-1155621563.jpg', '.jpg', '2019-04-04 13:34:55', '', 'image/jpeg'),
(50, 9, 'conference-2017-823516946.jpg', '.jpg', '2019-04-04 13:34:56', '', 'image/jpeg'),
(51, 9, 'conference-2017-559744590.jpg', '.jpg', '2019-04-04 13:34:56', '', 'image/jpeg'),
(52, 9, 'conference-2017-425027030.jpg', '.jpg', '2019-04-04 13:34:56', '', 'image/jpeg'),
(53, 9, 'conference-2017-641964955.jpg', '.jpg', '2019-04-04 13:34:56', '', 'image/jpeg'),
(54, 9, 'conference-2017-1776378470.jpg', '.jpg', '2019-04-04 13:34:57', '', 'image/jpeg'),
(55, 9, 'conference-2017-1927990529.jpg', '.jpg', '2019-04-04 13:34:57', '', 'image/jpeg'),
(56, 9, 'conference-2017-1405302691.jpg', '.jpg', '2019-04-04 13:34:58', '', 'image/jpeg'),
(57, 9, 'conference-2017-586228379.jpg', '.jpg', '2019-04-04 13:34:58', '', 'image/jpeg'),
(58, 9, 'conference-2017-544051467.jpg', '.jpg', '2019-04-04 13:34:58', '', 'image/jpeg'),
(59, 9, 'conference-2017-504843578.jpg', '.jpg', '2019-04-04 13:34:58', '', 'image/jpeg'),
(60, 9, 'conference-2017-1531857527.jpg', '.jpg', '2019-04-04 13:34:58', '', 'image/jpeg'),
(61, 9, 'conference-2017-310443285.jpg', '.jpg', '2019-04-04 13:34:59', '', 'image/jpeg'),
(62, 9, 'conference-2017-1597252334.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(63, 9, 'conference-2017-1688760059.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(64, 9, 'conference-2017-1203039369.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(65, 9, 'conference-2017-555644245.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(66, 9, 'conference-2017-989987137.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(67, 9, 'conference-2017-1768179602.jpg', '.jpg', '2019-04-04 13:35:00', '', 'image/jpeg'),
(68, 9, 'conference-2017-1942125273.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(69, 9, 'conference-2017-2062666276.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(70, 9, 'conference-2017-1164641211.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(71, 9, 'conference-2017-245748176.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(72, 9, 'conference-2017-2040803450.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(73, 9, 'conference-2017-1655582489.jpg', '.jpg', '2019-04-04 13:35:02', '', 'image/jpeg'),
(74, 9, 'conference-2017-613578478.jpg', '.jpg', '2019-04-04 13:35:03', '', 'image/jpeg'),
(75, 9, 'conference-2017-1607351628.jpg', '.jpg', '2019-04-04 13:35:03', '', 'image/jpeg'),
(76, 9, 'conference-2017-1603210810.jpg', '.jpg', '2019-04-04 13:35:04', '', 'image/jpeg'),
(77, 9, 'conference-2017-122694894.jpg', '.jpg', '2019-04-04 13:35:04', '', 'image/jpeg'),
(78, 9, 'conference-2017-1256811019.jpg', '.jpg', '2019-04-04 13:35:04', '', 'image/jpeg'),
(79, 9, 'conference-2017-212105935.jpg', '.jpg', '2019-04-04 13:35:04', '', 'image/jpeg'),
(80, 9, 'conference-2017-387644570.jpg', '.jpg', '2019-04-04 13:35:05', '', 'image/jpeg'),
(81, 9, 'conference-2017-1658496108.jpg', '.jpg', '2019-04-04 13:35:05', '', 'image/jpeg'),
(82, 9, 'conference-2017-1392208043.jpg', '.jpg', '2019-04-04 13:35:05', '', 'image/jpeg'),
(83, 9, 'conference-2017-1671448281.jpg', '.jpg', '2019-04-04 13:35:05', '', 'image/jpeg'),
(84, 9, 'conference-2017-1578751212.jpg', '.jpg', '2019-04-04 13:35:06', '', 'image/jpeg'),
(85, 9, 'conference-2017-613139602.jpg', '.jpg', '2019-04-04 13:35:06', '', 'image/jpeg'),
(86, 9, 'conference-2017-1343175120.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(87, 9, 'conference-2017-85599655.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(88, 9, 'conference-2017-1864130702.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(89, 9, 'conference-2017-1633004690.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(90, 9, 'conference-2017-803420842.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(91, 9, 'conference-2017-1870724072.jpg', '.jpg', '2019-04-04 13:35:07', '', 'image/jpeg'),
(92, 9, 'conference-2017-2026599596.jpg', '.jpg', '2019-04-04 13:35:09', '', 'image/jpeg'),
(93, 9, 'conference-2017-849797799.jpg', '.jpg', '2019-04-04 13:35:09', '', 'image/jpeg'),
(94, 9, 'conference-2017-1638622818.jpg', '.jpg', '2019-04-04 13:35:09', '', 'image/jpeg'),
(95, 9, 'conference-2017-442211130.jpg', '.jpg', '2019-04-04 13:35:09', '', 'image/jpeg'),
(96, 8, 'conference-2019-1898002459.jpg', '.jpg', '2019-05-23 12:10:51', '', 'image/jpeg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `contributions`
--

CREATE TABLE `contributions` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '9999',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_authors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conference_id` int(10) DEFAULT NULL,
  `old_data` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `contributions`
--

INSERT INTO `contributions` (`id`, `user_id`, `title`, `type`, `abstract`, `file`, `co_authors`, `created_at`, `updated_at`, `conference_id`, `old_data`) VALUES
(1, 1, 'Cupcake ipsum dolor sit amet cheesecake. Macaroon tart caramels bonbon sugar plum\r\n                                    marshmallow', 2, 'Cheesecake cake toffee. Chocolate cake carrot cake sugar plum. Halvah tart powder\r\n                                    gingerbread liquorice dessert topping. Caramels jujubes oat cake cupcake chocolate\r\n                                    cake.\r\n\r\n                                    Caramels cake tiramisu lollipop cupcake donut lemon drops jelly. Lemon drops\r\n                                    tiramisu candy gingerbread dessert liquorice. Ice cream sugar plum muffin.\r\n\r\n                                    Apple pie sweet roll cake. Fruitcake halvah soufflé bear claw cotton candy apple pie\r\n                                    dessert chocolate marzipan. Powder dessert cookie jujubes gummies candy canes.', 'contribution_1.pdf', NULL, '2019-03-09 10:36:28', '2019-03-09 10:36:28', 8, 0),
(3, 9999, 'Softvérová podpora výučby deskriptívnej geometrie a geometrického modelovania na FMFI UK', 1, 'Príspevok informuje o možnostiach technického zabezpečenia výučby počítačovej a deskriptívnej geometrie a geometrického modelovania na FMFI UK. Zameriava sa na prehľad dostupných softvérových riešení a nástrojov a možnosti modernizácie výučby, spolu s prezentáciou vytvorených študijných materiálov a softvérových výstupov kvalifikačných prác študentov zodpovedajúcich študijných programov.', '---', 'BÁTOROVÁ Martina, KUDLIČKOVÁ Soňa', '2019-04-04 11:43:21', '2019-04-04 11:43:21', 9, 1),
(4, 9999, 'Linear Approach to Interpolations with Polynomial PN Surfaces. ', 1, 'We study polynomial surfaces which possess a polynomial area element which are equivalent to the PN surfaces. We show that for a rational surface the Gram determinant of its tangent space is a perfect square if and only if the Gram determinant of its normal space is a perfect square. Consequently the polynomial surfaces of a given degree with polynomial area element can be constructed from the prescribed normal fields solving a system of linear equations. The degree of the constructed surface depending on the degree and the properties of the prescribed normal field is investigated. We use the presented approach to interpolate a network of points and associated normals with piecewise polynomial surfaces with polynomial area element.', '---', 'BIZZARRI Michal, LÁVIČKA Miroslav, ŠÍR Zbyněk, VRŠEK Jan', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(5, 9999, 'Multivalued Support Function at Inflection Points of Planar Curves', 1, 'We study the behavior of the support function (see e.g. [1, 2]) in the neighborhood of a curve inflection. The gauss map at the inflection point is not regular and in the neighborhood is typically not injective. The support function is thus not regular and typically multivalued. We describe this function using an implicit algebraic equation and the rational Puiseux series of its branches. We show the correspondence between the degree of the approximation of the primary curve (using Taylor series) and the degree of the approximation of the support function (using Puiseux series). Based on this results we are able to approximate curve with inflections by curves with a simple support function which consequently possess rational offsets. We also analyze the approximation degree of this kind of dual approximation. In particular, we explain why the approximation order of the C^1 Hermite interpolation drops from 4 to 3 when an inflection occurs. Such a phenomenon was experienced e.g. when using segments of hypocycloids or epicycloids, see [3]. We propose an alternative adaptive subdivision scheme, which ensures the approximation degree 4 both for the inflection–free segments and the segments with inflections.\r\n\r\nReferences\r\n[1] Gruber, P.M., Wills, J.M.: Handbook of convex geometry. North–Holland, Amsterdam (1993).\r\n[2] Šír, Z., Gravesen, J., Jüttler, B.: Curves and surfaces represented by polynomial support functions. Theoretical Computer Science 392, 141–157 (2008).\r\n[3] Šír, Z., Bastl, B., Lávička, M.: Hermite interpolation by hypocycloids and epicycloids with rational offsets. Computer Aided Geometric Design 27, 405–417 (2010).', '---', 'BLAŽKOVÁ Eva, ŠÍR Zbyněk ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(6, 9999, 'Local Intersection of Curves', 1, 'We review some approaches for computation of intersection multiplicity of algebraic curves over complex number field. There are examples showing that the multiplicity of the intersection can be easily composed out of the intersection multiplicity of the corresponding curve and there are others where it is not so direct. The known algebraic description lacks geometric intuition or interpretation behind. We suggest certain explanations.', '---', 'CHALMOVIANSKÝ Pavel', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(7, 9999, 'GeoGebra a výučba zobrazovacích metód', 1, 'V príspevku si priblížime možnosti použitia GeoGebry pri výučbe zobrazovacích metód a geometrie.', '---', 'ČMELKOVÁ Viera', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(8, 9999, 'Mascheroniho konstrukce', 1, 'Příspěvek představí vybrané Mascheroniho konstrukce, při kterých se využívá pouze kružítko, jedná se o konstrukce s omezenými prostředky. Italský matematik Lorenzo Mascheroni (1750-1800) popsal tyto konstrukce ve své knize Geometria del compasso (1797).', '---', 'FERDIÁNOVÁ Věra', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(9, 9999, 'Jak rozpohybovat GeoGebru?', 1, 'V příspěvku předvedeme applety vytvořené pro podporu prostorové představivosti, jejichž tvorba vyžaduje méně intuitivní nástroje.\r\nUkážeme a okomentujeme tři vybrané postupy:\r\n1) Přímé využití objektů GeoGebry a jejich vazby při využití tzv. seznamů,\r\n2) Užití GeoGebra Scriptu (a jeho nevýhody)\r\n3) Užití JavaScriptu', '---', 'GERGELITSOVÁ Šárka, Tomáš HOLAN', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(10, 9999, 'Dynamická geometrie online', 1, 'Příspěvek je určen pro workshop programu GeoGebra, který je pořádán v rámci konference. Pojednává o nástrojích tohoto programu vhodných pro výuku geometrie. Zvláštní zřetel je při tom kladen na využití služeb webového prostředí, které je každému uživateli bezplatně k dispozici na portálu geogebra.org. Jedná se například o tvorbu a využití dynamických materiálů, strukturovaných online publikací, formování skupin uživatelů a online testování.', '---', 'HAŠEK Roman', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(11, 9999, 'Ovals in Technical Practice', 1, 'From the beginnings of architecture, we encounter elements and shapes that have a base in a circle or an ellipse. Very often, in technical practice, we meet the concept of oval. This term denotes a curve composed of circular arcs, but many times also the ellipse itself. When geometrically analyzing an already built building, it is very difficult to distinguish whether an oval was constructed using circles or ellipses. The quality of approximate constructions may be the reason. In the contribution, we will focus on some interesting constructions used by architects, theorists such as Sebastiano Serlio and Guarino Guarini.', '---', 'HOLEŠOVÁ Michaela', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(12, 9999, 'Visualisation in Problem Solving', 1, 'The contribution deals with various possibilities of visualisation of mathematical relationships in problem solving. A new viewpoint can give us new ideas and concepts that lead to a simplified solution of the mathematical problem.', '---', 'KMEŤOVÁ Mária', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(13, 9999, 'Parametrická hladkosť pri plánovaní pohybu robota', 1, 'V príspevku demonštrujeme ovládanie robota SPHERO nástrojami NURBS. Na jednoduchom príklade je prakticky ukázaná závislosť kvality výslednej trajektórie na zvolenej hladkosti použitých kriviek.', '---', 'KOLCUN Alexej, RAUNIGR Peter', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(14, 9999, 'Modelování ploch v technické praxi a jejich 3D tisk', 1, 'Modelování těles v programech OpenScad a OnShape a jejich tisk na 3D tiskárně.', '---', 'KOLOMAZNÍK Ivan, ČERVENKA František', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(15, 9999, 'Zajímavé vlastnosti elipsy a hyperboly nad rámec běžného učiva', 1, 'Konstrukce elipsy a hyperboly s využitím poměrové definice, odvození parametrických rovnic kuželoseček s osami v pootočené poloze vzhledem k osám x a y, využití těchto param. rovnic elipsy pro její konstrukci při zadaných bodech A,C,M.', '---', 'KRÁLOVÁ Alice', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(16, 9999, 'Konštrukcie elipsy v interakcii s GeoGebrou', 1, 'V príspevku sa zameriame na doplnenie klasických konštrukcií elipsy pomocou rysovacích potrieb o konštrukcie elipsy realizované v softvéri GeoGebra. Riešené úlohy využívajú interakciu s GeoGebrou, ide o vykreslenie elíps pri meniacich sa hodnotách vstupných dát. Príspevok je zameraný na inovatívne vyučovanie s využitím digitálnych technológií.', '---', 'KUDLIČKOVÁ Soňa, MACKOVOVÁ Alžbeta, BÁTOROVÁ Martina ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(17, 9999, 'Rational Approximation of Square-Root Parameterizable Curves', 1, 'We study situations when non-rational parameterizations of planar or space curves as results of certain geometric operations or constructions are obtained. We focus especially on such cases in which one can identify a~rational mapping which is a double cover of a rational curve. Hence, we deal with rational, elliptic or hyperelliptic curves that are birational to plane curves in the Weierstrass form and thus they are square-root parameterizable. We design a simple algorithm for computing an approximate (piecewise) rational parametrization using topological graphs of the Weierstrass curves. Predictable shapes reflecting a number of real roots of a univariate polynomial and a possibility to approximate easily the branches separately play a crucial role in the approximation algorithm.', '---', 'LÁVIČKA Miroslav, BIZZARI Michal, VRŠEK Jan ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(18, 9999, 'Možnosti zásuvného modulu GeoGebra systému Moodle', 1, 'V tomto článku si ukážeme niekoľko možností využitia zásuvného modulu GeoGebra systému na riadenie výučby Moodle vo vyučovacom procese.', '---', 'MAŤAŠOVSKÝ Alexander, Tomáš VISNYAI', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(19, 9999, 'Non-Euclidean Polyhedral Manifolds, Models and Visualization', 1, 'As a byproduct of our recent papers [1], [2], and the previous initiative of the first author, we have recently found an infinite sequence of hyperbolic polyhedra Cw(2z, 2z, 2z) (6 =< 2z, 3 =< z odd integer) which can be equipped with a fixed point free face pairing, as a gluing procedure, so that the polyhedron become a compact hyperbolic manifold. That means each point has a ball-like neighbourhood. The visualization of such “finite Worlds” seems to be a timely task, and we try to involve our students as well. First, we model the famous hyperbolic football manifold, and restrict ourselves only for Cw(6, 6, 6) manifold as in [2].', '---', 'MOLNÁR Emil, SZIRMAI Jenő', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(20, 9999, 'Základy skriptování v GeoGebře', 1, 'Seznámíme se se základy skriptování a ukážeme si, jak se skriptování dá využít při tvorbě studijního materiálu nebo ke zpestření přednášek.', '---', 'MORÁVKOVÁ Zuzana', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(21, 9999, 'The Importance of Linear Algebra in Trigonometry', 1, 'In this talk, I present the tools used in linear algebra that are applicable in the study of trigonometry, specifically Wildberger´s framework of Rational trigonometry. Starting with a re-formulation of metrical quantities in n-dimensional (affine) space using linear algebraic tools, we can then talk about visualising geometric objects in n-dimensional space. Marrying these two concepts together with the concept of a symmetric bilinear form, we can make significant progress with regards to the understanding of trigonometry in higher dimensions over a general metrical framework. We will pay specific attention to the three-dimensional space and the most important object in it: the tetrahedron.', '---', 'NOTOWIDIGDO Gennady', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(22, 9999, 'Hermite Interpolation with Ruled and Canal Surfaces', 1, 'We show an algebraic way to interpolate Hermite data of ruled or canal surfaces. For that we construct rational (indeed polynomial) curves within Plücker’s quadric M42 and within Lie’s quadric L42 which are point models for the geometries of lines and spheres. The technique we use applies to both types of surfaces, because they can be represented as curves within the afore mentioned quadrics. The Bézier ansatz for a curve in either quadric involves some design parameters guiding the shape of the ruled or canal surfaces. These parameters are to be determined by solving a system of algebraic equations. The degrees of the equations admit a prediction of the number of possible solutions. Together with geometric criteria, useful solutions, i.e., solutions that meet practical requirements can be selected. Our main goal is the interpolation of Gk data at the boundaries of ruled surfaces and canal surfaces. Depending on k, the degree n of the curve in the Bézier ansatz has to be chosen: the higher k, the higher the degree of the ansatz. Nevertheless, we aim at low degree interpolants, and therefore, we choose the lowest possible n in any case.', '---', 'ODEHNAL Boris', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(23, 9999, 'Diferenciální a integrální počet v GeoGebře', 1, 'V tomto příspěvku si ukážeme několik appletů vytvořených v programu GeoGebra, které lze využít ve výuce diferenciálního a integrálního počtu. Zaměříme se hlavně na derivace, Taylorův polynom a Riemannův integrál.', '---', 'PALÁČEK Radomír', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(24, 9999, 'Investigation of Loci in Dynamic Geometric Environment', 1, 'A classical problem in plane geometry consists of searching for the path of a point, that is subject to given constraints. Except for the most simple loci such as lines, circles or possibly conics, this topic is not contained in most geometry texts. The reason might be difficulties when visualizing various objects with different movements.\r\nThe use of dynamic geometry software (Cabri, GeoGebra, Sketchpad,...) considerably facilitates the loci investigation. Whereas in the past the study of loci by DGS was based on numerical methods, now we are facing the introduction of symbolic methods based on the theory of automated theorem proving into DGS. The result is the implicit equation of the locus.\r\nIn the talk a few concrete examples, including drawbacks which can occur in some cases, are given.\r\n\r\n\r\n\"Vyšetrovanie množín bodov v dynamickom geometrickom prostredí\"\r\n\r\nKlasický problém rovinnej geometrie je úloha nájsť dráhu pohybu bodu, ktorý je viazaný danou podmienkou. Okrem určovania najjednoduchších takýchto množín bodov, ako sú priamky, kružnice, či prípadne kužeľosečky, väčšina učebníc geometrie uvedenú tému neobsahuje. Príčinou môžu byť ťažkosti s vizualizáciou rozličných objektov podrobených rôznym pohybom.\r\nPoužitie dynamických geometrických softvérov (Cabri, GeoGebra, Sketchpad,...) výrazne napomáha vyšetrovaniu spomínaných množín bodov. Kým v minulosti bolo štúdium takýchto množín bodov pomocou DGS postavené na numerických metódach, dnes sa stretávame s uvádzaním symbolických metód teórie automatického dokazovania tvrdení do DGS. Výsledkom je implicitná rovnica hľadanej množiny bodov.\r\nV prednáške bude uvedených niekoľko konkrétnych príkladov, včítane problémov, ktoré môžu vzniknúť v niektorých prípadoch.', '---', 'PECH Pavel', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(25, 9999, 'Vyuka deskriptivni geometrie na Stavební fakultě VUT a nové studijní materiály vytvářené v dynamickém systému GeoGebra', 1, 'Příspěvek má za cíl seznámit s historií a současností výuky deskriptivní geometrie na Stavební fakultě VUT v Brně a nové směry při vytváření vyukových materiálů, především za pomoci dynamického systému GeoGebra.', '---', 'ŠAFAŘÍK Jan, SLABĚŇÁKOVÁ Jana, SIVČÁK Jozef ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(26, 9999, 'Grafické zobrazení dat v GeoGebře', 1, 'Ukážeme si možnosti využití GeoGebry ve výuce statistiky. Seznámíme se nejen s nástroji a funkcemi pro tvorbu grafů potřebných pro přehledné zobrazení dat, ale i s hotovými pomůckami.', '---', 'SCHREIBEROVÁ Petra ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(27, 9999, 'Tensegrity structures - the idea and realization', 1, 'The idea of tensigrity structures are very intersting. And the history of developing this idea is interesting either. Who is the original author of the concept? Master or pupil? The first tensegrity structure was constructed in 1948 by Kenneth Snelson, the young student of art. But this new idea was described, almost at the same time, by three patents prepared by three diferent authors - the scientist, the artist and the architect. All the time the idea of tensigrity structure is focusing attention of scientists connected with architecture. Nowadays new groups of scientists are looking for the best and precisly definition for tensigrity and they are trying to defined true or false tensigrity structures. Authors want to present the basic concepts of tensigrity structures which are described in the original patents and on the base of this present the realization of tensigrity structures which were realized in architecture.', '---', 'SROKA-BIZON Monika, Piotr POLINCEUSZ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(28, 9999, 'Two Particular Quadratic Cones', 1, 'The Euclidean geometry of quadratic cones is equivalent to the study of spherical conics. The normal or orthogonal quadratic cones have circular sections being orthogonal to vertex generators. These cones can be generated by congruent pencils of planes with intersecting axes. The corresponding conics are the spherical analogues of Thales circles.\r\n\r\nEquilateral quadratic cones are characterized by a vanishing trace.\r\nThe associated equilateral spherical conics have the property that the three vertices of a regular right-angled spherical triangle can simultaneously move along. Dualization yields cones which are the envelopes of triples of mutually orthogonal planes. If cones of this type are tangent to a regular quadric then their apices are located on a sphere. This reveals that in general ellipsoids are still movable within a fixed circumscribed box.\r\n\r\nLiterature:\r\nG. Glaeser, H. Stachel, B. Odehnal: The Universe of Conics. Springer Spektrum, Heidelberg 2016\r\nG. Glaeser, H. Stachel, B. Odehnal: The Universe of Quadrics. Springer Spektrum, in preparation', '---', 'STACHEL Hellmuth ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(29, 9999, 'Geometrický software a výuka (nejen diferenciální) geometrie', 1, 'Možnosti využití geometrického software ve výuce geometrie a úskalí s tím spojená.\r\n', '---', 'TOMICZKOVÁ Světlana ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(30, 9999, 'The Addition of Two Imaging Parallel Projection', 1, 'In article „Dwuobrazowy rzut równoległy” (Two image parallel projection) A. Zawadzki, K. Bolek have submitted a new projection method. The given method is based on imaging of Euclidean space on a plane. A projection plane and two projection directions, not parallel to the plane, are at first assumed. Each point of space has two points assigned, that come from projections of the given point in the defined directions. The method does not enable restitution of the given point basing on its imaging neither application of metrical constructions.\r\nAddition of possibility to save the directions of projection broadens way of using the imaging. The satellite picture of the same object taken from two different directions may be treated as two-image parallel projection. Thank to the addition, basing on the image, it will be possible to figure out geometrical features of the photographed object.\r\n', '---', 'TYTKOWSKI Krzysztof', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(31, 9999, 'Geometric Tools in a Precision of Image Elements on Maps ', 1, 'Maps in analog and digital form affect every area of life. An actual problem affected by the precision of positioning geodetic points using new GNSS technologies in coordinate systems is the precision of the map projection. Map projections are coming out of geometric expression of properties of reference surfaces of Earth using methods of differential geometry, as well as of relation between two linear manifolds - reference ellipsoid and map plane. Choice of cartographic projection is determined by the geometrical characteristics of the territory and choice criteria for distortion of map elements. The aim of this paper is to show the role of geometry and mathematics in the cartography and different options for access to the distortions of the territory, such as optimization of extreme value of distortion, summing and integral criterion on area territory, in some case using criterion with the requirement of a minimum mean value of scale distortion in a given area.\r\n\r\n\r\n\"Nástroje geometrie v spresňovaní obrazu prvkov na mapách\":\r\n\r\nMapy v analógovej a digitálnej forme zasahujú do každej oblasti života. Spresňovanie určenia bodov pomocou nových GNSS technológií je motiváciou k spresňovaniu zobrazenia mapových prvkov. Kartografické zobrazenia vychádzajú z geometrického vyjadrenia vlastností referenčnej plochy Zeme metódami diferenciálnej geometrie a zo vzťahu medzi dvomi lineárnymi varietami - referenčným elipsoidom a rovinou zobrazenia. Výber kartografického zobrazenia je determinovaný geometrickými vlastnosťami územia a voľbou kritéria na skreslenie mapových prvkov. Cieľom príspevku je ukázať úlohu geometrie a matematiky v kartografickom zobrazovaní, a tiež rôzne varianty prístupu k skresleniam na ploche územia, ako optimalizácia krajných hodnôt skreslenia, súčtové a integrálne kritérium na ploche územia, príp. kritérium s požiadavkou na minimalizáciu strednej kvadratickej hodnoty skreslenia na zobrazovanej ploche.', '---', 'VAJSÁBLOVÁ Margita', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(32, 9999, '3D Data Reconstruction', 1, 'Information about results achieved in the project\r\nGEOCRIM - Reconstruction of real 3D dimensions and position of selected objects from the criminalistically relevant records taken by stable camera systems.', '---', 'VELICHOVÁ Daniela ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(33, 9999, 'CAS v GeoGebře', 1, 'Ukážeme si použití modulu symbolických manipulací CAS v GeoGebře.', '---', 'VOLNÁ Jana, VOLNÝ Petr ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(34, 9999, 'Hledání symetrií algebraických křivek', 1, 'Symetrií křivky rozumíme izometrii Eukleidovské roviny, jež tuto křivku zobrazuje na sebe samu. Snadno se nahlédne, že grupa symetrií algebraické křivky je podgrupou symetrií nějakého mnohoúhelníku ( pokud křivka není tvořena rovnoběžnými přímkami, nebo soustřednými kružnicemi). Postačí nám tedy nalézt střed a směry os tohoto mnohoúhelníku. Problém vyřešíme nalezením nové, tzv. harmonické, křivky jejíž grupa symetrií bude snadno nalezitelná a úzce svázána s grupou symetrií křivky původní.', '---', 'VRŠEK Jan, LÁVIČKA Miroslav, ALCÁZAR J. G.', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(35, 9999, 'Proofs by Visualisations Instead of Words', 1, 'Some more or less well-known geometric theorems can be visualised such that their proofs are obvious. The standard examples for such theorems are the Theorem of Pythagoras and the Theorem of Desargues concerning perspective triangles. But there are many others, too. For example, the Apollonius definition of say an ellipse allows the construction of its tangents as angle bisectors of the “focal segments”. This construction is based on a mechanical interpretation of the Apollonius definition an E.W. v. Tschirnhaus used this idea for constructing tangents of curves defined by a (finite) set of focal points and constant weighted sum of distances from these focal points. But even the figures in his famous book “medicina mentis” from 1695 are quite clear to a geometer, the mathematician, who made the explaining footnotes to the German edition from 1963, did not understand them. Therefore, the question arises, what are the conditions which a figure should fulfil to visualise what an author aims at. As an answer it has to be stated that a proper visualisation is only one part, the other, more important, is the addressee. He/she must understand the problem, be creative enough to guess the idea of proof, have imagination, and have some experience in problem solving, too. Shortly said, he/she must be educated. Therefore, the lecture takes up the cudgels on behalf of a solid education in Geometry, including Descriptive Geometry.', '---', 'WEISS Gunter ', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(36, 9999, 'On Methods of Synthetic Projective Geometry', 1, 'In the contribution, we talk about synthetic methods in the projective extension of the real plane or three-dimensional space for solving problems of projective incidence and affine geometry. We use the concept of von Staudt´s \"Wurf\", defined in his Beiträge zur Geometrie der Lage, and derived property that cross-ratios are invariant under projective transformations. The concept of choosing an infinite hyperplane is used for making hypothesis in an affine space to solve projective problems and vice-versa. Their mixtures with the analytic use of homogenous coordinates is applied on projective theorems. An insight into the von Staudt´s constructions on the projective scale is given. The methods are shown on some examples in elementary planimetry and stereometry, on proofs of Menelaus´ and Ceva´s theorems and on applications of Pappus´s theorem.', '---', 'ZAMBOJ Michal', '2019-04-04 12:03:39', '2019-04-04 12:03:39', 9, 1),
(37, 9999, 'Môj prvý príspevok :)', 1, 'Toto je moj prvi prýspevok', 'contribution_7.pdf', 'Tato', '2019-05-23 08:11:56', '2019-05-23 08:11:56', 8, 0),
(38, 9999, 'dsadsad', 1, 'dsadasdasdasda', 'contribution_9.pdf', 'dsadasdasd', '2019-05-23 08:24:40', '2019-05-23 08:24:53', 8, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `contribution_comments`
--

CREATE TABLE `contribution_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `contribution_id` int(10) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `contribution_comments`
--

INSERT INTO `contribution_comments` (`id`, `user_id`, `contribution_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Candy powder carrot cake marshmallow cheesecake cotton candy oat cake pudding. Bonbon jelly-o tart jelly-o jelly beans carrot cake chocolate. Tootsie roll lemon drops sweet roll jelly cake pudding lollipop marzipan gummi bears. Chocolate cake cupcake tootsie roll chocolate bar cheesecake tart tiramisu.', '2019-03-09 20:27:14', '2019-03-09 20:27:14'),
(2, 1, 1, 'Ahoj dsajdiasd \n daskdpo kasd\n asdas\nd \nad jdiojasjdpoaksd', '2019-03-09 20:51:02', '2019-03-09 20:51:02'),
(3, 1, 1, 'kjsajdokasodkaoskdpokasodkoaskdpkasopd kpaosk dopakd\noakdok\nasdksaok dokoskdaposdpokaspd \nasdopak smad\ns das\ndasdasdasd', '2019-03-09 20:51:39', '2019-03-09 20:51:39');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `countries`
--

INSERT INTO `countries` (`id`, `name_sk`, `name_en`, `abbr`) VALUES
(1, 'Slovensko', '', 'SK'),
(2, 'Česká republika', '', 'CZ'),
(3, 'Hungary', '', 'HU'),
(16, 'Australia', '', 'AU'),
(17, 'Austria', '', 'AT'),
(24, 'Belgium', '', 'BE'),
(30, 'Bosnia and Herzegovina', '', 'BA'),
(36, 'Bulgaria', '', 'BG'),
(41, 'Canada', '', 'CA'),
(57, 'Croatia', '', 'HR'),
(59, 'Cyprus', '', 'CY'),
(60, 'Denmark', '', 'DK'),
(69, 'Estonia', '', 'EE'),
(74, 'Finland', '', 'FI'),
(75, 'France', '', 'FR'),
(82, 'Germany', '', 'DE'),
(84, 'Gibraltar', '', 'GI'),
(85, 'Greece', '', 'GR'),
(99, 'Iceland', '', 'IS'),
(104, 'Ireland', '', 'IE'),
(105, 'Israel', '', 'IL'),
(106, 'Italy', '', 'IT'),
(108, 'Japan', '', 'JP'),
(118, 'Latvia', '', 'LV'),
(125, 'Luxembourg', '', 'LU'),
(133, 'Malta', '', 'MT'),
(139, 'Mexico', '', 'MX'),
(142, 'Monaco', '', 'MC'),
(151, 'Netherlands', '', 'NL'),
(161, 'Norway', '', 'NO'),
(172, 'Poland', '', 'PL'),
(173, 'Portugal', '', 'PT'),
(177, 'Romania', '', 'RO'),
(178, 'Russian Federation', '', 'RU'),
(190, 'Serbia and Montenegro', '', 'CS'),
(194, 'Slovenia', '', 'SI'),
(205, 'Sweden', '', 'SE'),
(206, 'Switzerland', '', 'CH'),
(211, 'Thailand', '', 'TH'),
(218, 'Turkey', '', 'TR'),
(223, 'Ukraine', '', 'UA'),
(225, 'United Kingdom', '', 'GB'),
(226, 'United States', '', 'US'),
(999, 'Undefined', 'Undefined', 'UNK');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `email_messages`
--

CREATE TABLE `email_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `recipients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `email_messages`
--

INSERT INTO `email_messages` (`id`, `recipients`, `subject`, `status`, `module`, `data`, `send_time`, `created_at`, `updated_at`) VALUES
(3, '[\"hrebenar.martin1@gmail.com\"]', 'Test MAIL', 1, 'Test', NULL, '2019-04-28 09:19:12', '2019-04-28 07:09:27', '2019-04-28 07:19:12'),
(4, '[\"hrebenar.martin1@gmail.com\"]', 'Test MAIL', 1, 'Test', NULL, '2019-04-28 09:19:16', '2019-04-28 07:09:48', '2019-04-28 07:19:16'),
(5, '[\"hrebenar.martin1@gmail.com\"]', 'Test MAIL', 1, 'Test', NULL, '2019-04-28 09:19:19', '2019-04-28 07:10:59', '2019-04-28 07:19:19'),
(6, '[\"hrebenar.martin1@gmail.com\"]', 'Test MAIL', 1, 'Test', NULL, '2019-04-28 09:19:22', '2019-04-28 07:18:22', '2019-04-28 07:19:22'),
(7, '[\"hrebenar.martin1@gmail.com\"]', 'Test MAIL', 1, 'Test', NULL, '2019-04-28 09:19:25', '2019-04-28 07:19:05', '2019-04-28 07:19:25'),
(8, '[\"hrebenar.martin1@gmail.com\"]', 'Test subject', 1, 'Test', '{\"Data\":\"test data\"}', '2019-04-28 09:26:55', '2019-04-28 07:26:52', '2019-04-28 07:26:55'),
(9, '[\"hrebenar.martin1@gmail.com\",\"m.hrebenar365@gmail.com\"]', 'Test subject', 1, 'Test', '{\"Data\":\"test data\"}', '2019-04-28 09:32:08', '2019-04-28 07:32:04', '2019-04-28 07:32:08'),
(10, '[\"hrebenar.martin1@gmail.com\"]', '', 1, 'Review-assign', '[]', '2019-04-28 13:16:32', '2019-04-28 07:49:05', '2019-04-28 11:16:32'),
(11, '[\"hrebenar.martin1@gmail.com\"]', '', 1, 'Review-assign', '[]', '2019-04-28 15:11:09', '2019-04-28 07:50:40', '2019-04-28 13:07:26'),
(12, '[\"hrebenar.martin1@gmail.com\",\"m.hrebenar365@gmail.com\"]', 'Test subject', 1, 'Test', '{\"Data\":\"test data\"}', '2019-04-28 13:16:38', '2019-04-28 11:13:27', '2019-04-28 11:16:38'),
(13, '[\"hrebenar.martin1@gmail.com\",\"m.hrebenar365@gmail.com\"]', 'Test subject', 1, 'Test', '{\"Data\":\"test data\"}', '2019-04-28 16:10:22', '2019-04-28 11:13:29', '2019-04-28 14:02:42'),
(15, '[\"hrebenar.martin1@gmail.com\"]', '', 1, 'Review-assign', '{\"reviewer\":\"1\"}', '2019-04-28 16:10:22', '2019-04-28 13:16:47', '2019-04-28 14:02:44'),
(16, '[\"hrebenar.martin1@gmail.com\"]', '', 1, 'Review-accepted', '{\"contribution_author\":1}', '2019-04-28 15:44:40', '2019-04-28 13:28:53', '2019-04-28 13:44:02'),
(17, '[\"hrebenar.martin1@gmail.com\"]', '', 1, 'Review-rejected', '{\"review_assigned_by\":1,\"reviewer\":1}', '2019-04-28 16:10:22', '2019-04-28 13:43:31', '2019-04-28 14:02:46'),
(18, '[\"hrebenar.martin1@gmail.com\"]', 'Recenzia k Vašemu príspevku | SSGG', 0, 'Review-updated', '{\"contribution_author\":1}', '2019-05-05 08:04:12', '2019-04-28 14:10:01', '2019-05-05 06:04:12'),
(19, '[\"hrebenar.martin1@gmail.com\"]', 'Príspevok na recenzovanie | SSGG', 0, 'Review-assign', '{\"reviewer\":\"1\"}', '2019-05-05 08:04:16', '2019-05-04 10:40:55', '2019-05-05 06:04:16');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `front_menu`
--

CREATE TABLE `front_menu` (
  `id` int(10) NOT NULL,
  `name_sk` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `name_en` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `route` varchar(55) COLLATE utf8_slovak_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `module` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  `conference_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `front_menu`
--

INSERT INTO `front_menu` (`id`, `name_sk`, `name_en`, `route`, `rank`, `module`, `created_at`, `updated_at`, `active`, `conference_id`) VALUES
(1, 'Domov', 'Home', '/', 1, 1, '2019-02-16 09:32:30', '2019-02-16 14:02:18', 1, NULL),
(5, 'Hlavná stránka', 'Home', '/konferencia', 1, 2, '2019-02-17 13:09:27', '2019-05-16 16:55:36', 1, 8),
(6, 'Miesto konania', 'Venue', '/konferencia/miesto-konania', 3, 2, '2019-02-20 11:51:18', '2019-05-16 16:55:36', 1, 8),
(7, 'Účastníci a príspevky', 'Participants and Contributions', '/konferencia/ucastnici-prispevky', 4, 2, '2019-03-09 10:48:03', '2019-05-16 16:55:36', 1, 8),
(8, 'Hlavná stránka', 'Main page', '/konferencia', 0, 2, '2019-04-04 11:06:05', '2019-04-04 12:15:33', 0, 9),
(9, 'Hlavná stránka', 'Main page', '/konferencia', 0, 2, '2019-04-04 11:09:43', '2019-04-04 11:19:58', 0, 10),
(10, 'Hlavná stránka', 'Main page', '/konferencia', 0, 2, '2019-04-04 11:12:57', '2019-04-04 11:20:11', 0, 11),
(11, 'Archív SCG', 'Archive SCG', '/archiv', 2, 1, '2019-04-06 10:34:13', '2019-04-06 10:34:13', 1, NULL),
(12, 'Galéria', 'Gallery', '/konferencia/galeria', 4, 2, '2019-05-06 06:40:08', '2019-05-16 16:55:36', 1, 8);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_13_142609_add_roles_and_user_roles_table', 1),
(4, '2018_11_13_144200_add_profiles_table', 2),
(5, '2018_11_13_144839_add_admin_oprion_to_users', 2),
(6, '2018_11_13_145106_add_image_row_to_profiles_table', 3),
(7, '2018_11_20_205739_create_admin_menu_table', 4),
(8, '2018_12_03_160716_add_pages_table', 5),
(9, '2018_12_03_160924_add_page_content_table', 5),
(10, '2019_02_16_182114_create_confrence_config_table', 6),
(11, '2019_02_24_081238_create_applications_table', 7),
(12, '2019_03_09_205501_create_contribution_comments_table', 8),
(13, '2019_03_21_140543_create_email_queue_table', 9),
(14, '2019_03_31_075733_create_reviews_table', 10),
(15, '2019_04_11_113518_create_review_forms_table', 11),
(16, '2019_04_11_113545_create_review_form_fields_table', 11),
(17, '2019_04_11_113600_create_review_form_fills_table', 11),
(18, '2019_04_11_114420_create_review_form_acceptance_levels_table', 11),
(25, '2019_04_14_102443_create_conference_review_forms_table', 12),
(26, '2019_04_14_103032_create_conference_review_form_fills_table', 12);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pages`
--

CREATE TABLE `pages` (
  `id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_second` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `module` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `conference_id` int(10) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `pages`
--

INSERT INTO `pages` (`id`, `title`, `title_second`, `alias`, `created_at`, `updated_at`, `module`, `description`, `conference_id`, `active`) VALUES
(1, 'Domov', 'Home', 'home', '2018-12-03 15:13:38', '2018-12-03 15:13:38', 1, '', NULL, NULL),
(10, '2019', '2019', '2019', '2019-02-17 13:09:27', '2019-05-16 16:55:36', 2, 'Česko-Slovenská konferencia pre geometriu a grafiku', 8, 1),
(11, 'Miesto konania', 'Venue', 'miesto-konania', '2019-02-20 11:52:05', '2019-05-16 16:55:36', 2, 'detaily k termínom a miestu konania', 8, 1),
(12, 'Účastníci a príspevky', 'Participants and Contributions', 'ucastnici-prispevky', '2019-03-09 10:48:56', '2019-05-16 16:55:36', 2, 'Zoznam účastníkov a ich príspevkov', 8, 1),
(13, 'Galéria', 'Gallery', 'galeria', '2019-05-06 06:40:52', '2019-05-06 06:40:52', 2, 'GALÉRIA OBRÁZKOV', NULL, 1),
(14, 'Archív SCG', 'Archive SCG', 'archiv', '2019-05-06 06:53:24', '2019-05-06 06:53:24', 1, 'Archiv scg', NULL, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `page_content`
--

CREATE TABLE `page_content` (
  `id` int(10) NOT NULL,
  `page_id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `rank` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content_en` text COLLATE utf8mb4_unicode_ci,
  `conference_id` int(10) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `fixed_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `page_content`
--

INSERT INTO `page_content` (`id`, `page_id`, `title`, `type`, `content`, `rank`, `created_at`, `updated_at`, `content_en`, `conference_id`, `active`, `fixed_id`) VALUES
(1, 1, 'Úvodný blok', 3, '<section class=\"section section-lg section-shaped pb-200\">\r\n        <div class=\"shape shape-style-3 shape-default\">\r\n        <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n        </div>\r\n        <div class=\"container py-lg-md d-flex text-center\">\r\n          <div class=\"col px-0\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-12\">\r\n                <h1 class=\"display-3 text-white\">Slovenská spoločnosť\r\n                  <span>pre geometriu a grafiku</span>\r\n                </h1>\r\n                <p class=\"lead  text-white\">Lorem ipsum dolor sit amet.</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <!-- SVG separator -->\r\n        <div class=\"separator separator-bottom separator-skew\">\r\n          <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n          </svg>\r\n        </div>\r\n      </section>\r\n      <!-- 1st Hero Variation -->', 1, '2018-12-03 15:14:44', '2019-02-20 10:34:40', '<section class=\"section section-lg section-shaped pb-200\">\r\n        <div class=\"shape shape-style-3 shape-default\">\r\n        <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n        </div>\r\n        <div class=\"container py-lg-md d-flex text-center\">\r\n          <div class=\"col px-0\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-12\">\r\n                <h1 class=\"display-3 text-white\">Slovak society\r\n                  <span>for geometry and graphics</span>\r\n                </h1>\r\n                <p class=\"lead  text-white\">Lorem ipsum dolor sit amet.</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <!-- SVG separator -->\r\n        <div class=\"separator separator-bottom separator-skew\">\r\n          <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n          </svg>\r\n        </div>\r\n      </section>\r\n      <!-- 1st Hero Variation -->', NULL, 1, NULL),
(2, 1, 'Karty', 3, '<section class=\"section section-lg pt-lg-0 mt--200\" id=\'novinky\'>\r\n      <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n          <div class=\"col-lg-12\">\r\n            <div class=\"row row-grid\">\r\n             \r\n              <div class=\"col-lg-6 offset-3\">\r\n                <div class=\"card card-lift--hover shadow border-0\">\r\n                  <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-success text-uppercase\">Konferencia 2019</h3>\r\n                                    <p class=\"description mt-3\">Česko - Slovenská konferencia o geometrii a grafike 2019</p>\r\n                                    <a href=\"/konferencia\" class=\"btn btn-success mt-4\">Dozvedieť sa viac</a>\r\n                                </div>\r\n                </div>\r\n              </div>\r\n             \r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section>', 2, '2018-12-03 15:14:44', '2019-02-20 10:35:02', '<section class=\"section section-lg pt-lg-0 mt--200\" id=\'novinky\'>\r\n      <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n          <div class=\"col-lg-12\">\r\n            <div class=\"row row-grid\">\r\n             \r\n              <div class=\"col-lg-6 offset-3\">\r\n                <div class=\"card card-lift--hover shadow border-0\">\r\n                  <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-success text-uppercase\">Conference 2019</h3>\r\n                                    <p class=\"description mt-3\">Czech - Slovak conference on geometry and graphics 2019</p>\r\n                                    <a href=\"/konferencia\" class=\"btn btn-success mt-4\">Go there</a>\r\n                                </div>\r\n                </div>\r\n              </div>\r\n             \r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section>', NULL, 1, NULL),
(3, 1, 'Sekcia3', 3, '<section class=\"section bg-secondary\" id=\"o-nas\">\r\n        <div class=\"container\">\r\n            <div class=\"row row-grid align-items-center\">\r\n                <div class=\"col-md-6\">\r\n                    <div class=\"card bg-gray shadow border-0\">\r\n                        <img src=\"http://ssgg.development.env/public/images/global/isgg_banner.png\" class=\"card-img-top\">\r\n                        <blockquote class=\"card-blockquote\">\r\n                            <h4 class=\"display-3 font-weight-bold text-white\">ISGG</h4>\r\n                            <p class=\"lead text-italic text-white\">Sme hrdými členmi medzinárodnej spoločnosti pre Geometriu a Grafiku ISGG</p>\r\n                        </blockquote>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md-6\">\r\n                    <div class=\"pl-md-5\">\r\n                        <div class=\"icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5\">\r\n                            <i class=\"fa fa-group\"></i>\r\n                        </div>\r\n                        <h3>Už XX rokov.</h3>\r\n                        <p class=\"lead\">Už XX rokov oragnizujeme konferencie a zastrešujeme iné aktivity, súvisiace s geometriou a grafikou na slovensku.</p>\r\n                        <p>Cieľom spoločnosti pre geometriu a grafiku je presadzovať medzinárodnú spoluprácu a stimulovať vedecký výskum, pedagogickú prácu a metodiku vyučovania v oblasti geometrie a počítačovej grafiky.</p>\r\n                        <a href=\"#\" class=\"font-weight-bold text-primary mt-5\">V rámci spoločnosti SSGG aktívne pracuje aj skupina Slovenské ženy v matematike, \r\nktorá združuje členky EWM - European Women in Mathematics.</a>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>', 3, '2019-02-16 08:44:51', '2019-02-20 11:06:44', '<section class=\"section bg-secondary\" id=\"o-nas\">\r\n        <div class=\"container\">\r\n            <div class=\"row row-grid align-items-center\">\r\n                <div class=\"col-md-6\">\r\n                    <div class=\"card bg-gray shadow border-0\">\r\n                        <img src=\"http://ssgg.development.env/public/images/global/isgg_banner.png\" class=\"card-img-top\">\r\n                        <blockquote class=\"card-blockquote\">\r\n                            <h4 class=\"display-3 font-weight-bold text-white\">ISGG</h4>\r\n                            <p class=\"lead text-italic text-white\">We are proud members of the Internations society of Geometry and Graphics - ISGG</p>\r\n                        </blockquote>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md-6\">\r\n                    <div class=\"pl-md-5\">\r\n                        <div class=\"icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5\">\r\n                            <i class=\"fa fa-group\"></i>\r\n                        </div>\r\n                        <h3>XX years.</h3>\r\n                        <p class=\"lead\">We are organising and covering othe activities about geometry and graphics in Slovakia already XX year.</p>\r\n                        <p>Goal of our society is to promote international co-operation and to stimulate scientific research, pedagogical work and teaching methodology in the\r\n                        field of geometry and computer graphics.</p>\r\n                        <a href=\"#\" class=\"font-weight-bold text-primary mt-5\">Group of Slovak Women in Mathematics, members of the EWM - European Women in Mathematics, is actively working within the scope of SSGG.</a>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>', NULL, 1, NULL),
(6, 10, '2019 Home', 4, NULL, 0, '2019-02-17 13:09:27', '2019-02-17 13:09:27', NULL, 8, 1, 99),
(7, 10, 'Uvod 1', 3, '<section class=\"section section-lg\" id=\"viac\">\r\n    <div class=\"container shape-container d-flex align-items-center py-md\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center pb-3\">\r\n                    <h3 class=\"display-4\">Slovenská spoločnosť pre Geometriu a grafiku<br>a<br>Česká společnost pro geometrii a grafiku</h3>\r\n                </div>\r\n                <div class=\"row aling-items-center py-3\">\r\n                    <p>Vás srdečne pozývajú na už piaty ročník súbežne organizovaných konferencií v Českej a Slovenskej republike: </p>\r\n                </div>\r\n                <div class=\"col-lg-10 text-center pt-3\">\r\n                    <h2 class=\"display-3\">39. konferencia o geometrii a grafike<br>28. Sympózium o počítačovej geometrii SCG´2019</h2>\r\n                </div>\r\n                <div class=\"col-lg-10 text-center pt-3\">\r\n                    <a href=\"#dalej\"><h2 class=\"display-3 animated infinite heartBeat\"><i class=\"fa fa-chevron-down\"></i></h2></a>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>', 2, '2019-02-17 14:04:20', '2019-02-20 11:23:23', '<section class=\"section section-lg\" id=\"viac\">\r\n    <div class=\"container shape-container d-flex align-items-center py-md\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center pb-3\">\r\n                    <h3 class=\"display-4\">Slovenská spoločnosť pre Geometriu a grafiku<br>a<br>Česká společnost pro geometrii a grafiku</h3>\r\n                </div>\r\n                <div class=\"row aling-items-center py-3\">\r\n                    <p>Vás srdečne pozývajú na už piaty ročník súbežne organizovaných konferencií v Českej a Slovenskej republike: </p>\r\n                </div>\r\n                <div class=\"col-lg-10 text-center pt-3\">\r\n                    <h2 class=\"display-3\">39. konferencia o geometrii a grafike<br>28. Sympózium o počítačovej geometrii SCG´2019</h2>\r\n                </div>\r\n                <div class=\"col-lg-10 text-center pt-3\">\r\n                    <a href=\"#dalej\"><h2 class=\"display-3 animated infinite heartBeat\"><i class=\"fa fa-chevron-down\"></i></h2></a>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>', NULL, 1, NULL),
(8, 10, 'Karty', 3, '<section class=\"section section-lg pt-lg-0 mt--200\">\r\n        <div class=\"container\">\r\n            <div class=\"row justify-content-center\">\r\n                <div class=\"col-lg-12\">\r\n                    <div class=\"row row-grid\">\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-primary text-uppercase\">Viac info</h3>\r\n                                    <a href=\"#viac\" class=\"btn btn-primary mt-4\">Klik</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-success text-uppercase\">Účastníci a príspevky</h3>\r\n                                    <a href=\"/konferencia/ucastnici-prispevky\" class=\"btn btn-success mt-4\">Tu</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-danger text-uppercase\">Galéria</h3>\r\n                                    <a href=\"/konferencia/galeria\" class=\"btn btn-danger mt-4\">Sem</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>', 1, '2019-02-17 14:17:11', '2019-05-06 07:13:35', '<section class=\"section section-lg pt-lg-0 mt--200\">\r\n        <div class=\"container\">\r\n            <div class=\"row justify-content-center\">\r\n                <div class=\"col-lg-12\">\r\n                    <div class=\"row row-grid\">\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-primary text-uppercase\">More info</h3>\r\n                                    <a href=\"#viac\" class=\"btn btn-primary mt-4\">Click</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-success text-uppercase\">Participants and contributions</h3>\r\n                                    <a href=\"/konferencia/ucastnici-prispevky\" class=\"btn btn-success mt-4\">Here</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-lg-4\">\r\n                            <div class=\"card card-lift--hover shadow border-0\">\r\n                                <div class=\"card-body py-5 text-center\">\r\n                                    <h3 class=\"text-danger text-uppercase\">Gallery</h3>\r\n                                    <a href=\"/konferencia/galeria\" class=\"btn btn-danger mt-4\">On me</a>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>', NULL, 1, NULL),
(9, 10, 'Programové zameranie a výbor', 3, '<div class=\"section section-sm\" id=\"dalej\">\r\n    <div class=\"container shape-container d-flex\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-sm-10\">\r\n                    <h3 class=\"py-2\">Programové zameranie</h3>\r\n                    <ul>\r\n                        <li>nové technológie a stratégie vo výučbe geometrie</li>\r\n                        <li>geometria a jej aplikácie vo vede, technike a umení</li>\r\n                        <li>geometrické modelovanie</li>\r\n                    </ul>\r\n                    <br>\r\n                    <p>Vítané sú všetky príspevky týkajúce sa metodiky výučby \r\n                    geometrie, referáty a prednášky zo všetkých oblastí geometrie a \r\n                    jej aplikácií v technických a vedných disciplínach. \r\n                    Svoje príspevky môžu účastníci sympózia prezentovať \r\n                    aj formou posterov, na výstavke modelov, prípadne ukážkami \r\n                    didaktických materiálov alebo predvádzaním počítačových programov \r\n                    počas celého trvania sympózia.</p>\r\n                    <br>\r\n                    <br>\r\n                    <h3 class=\"py-2\">Programový výbor</h3>\r\n                    <ul>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Štát</li>\r\n                        <li>...</li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', 4, '2019-02-20 11:28:57', '2019-02-20 11:33:57', '<div class=\"section section-sm\" id=\"dalej\">\r\n    <div class=\"container shape-container d-flex\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-sm-10\">\r\n                    <h3 class=\"py-2\">Programové zameranie</h3>\r\n                    <ul>\r\n                        <li>nové technológie a stratégie vo výučbe geometrie</li>\r\n                        <li>geometria a jej aplikácie vo vede, technike a umení</li>\r\n                        <li>geometrické modelovanie</li>\r\n                    </ul>\r\n                    <br>\r\n                    <p>Vítané sú všetky príspevky týkajúce sa metodiky výučby \r\n                    geometrie, referáty a prednášky zo všetkých oblastí geometrie a \r\n                    jej aplikácií v technických a vedných disciplínach. \r\n                    Svoje príspevky môžu účastníci sympózia prezentovať \r\n                    aj formou posterov, na výstavke modelov, prípadne ukážkami \r\n                    didaktických materiálov alebo predvádzaním počítačových programov \r\n                    počas celého trvania sympózia.</p>\r\n                    <br>\r\n                    <br>\r\n                    <h3 class=\"py-2\">Programový výbor</h3>\r\n                    <ul>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Šťát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Šťát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Šťát</li>\r\n                        <li>Priezvisko Meno, Univerzita, Mesto, Šťát</li>\r\n                        <li>...</li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', NULL, 1, NULL),
(10, 10, 'Termín, miesto konania a poplatky', 3, '<div class=\"section section-sm\" id=\"dalej\">\r\n    <div class=\"container shape-container d-flex\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-sm-10\">\r\n                    <h3 class=\"py-2\">Termín a miesto konania</h3>\r\n                    <ul>\r\n                        <li>xx.xx.2019</li>\r\n                        <li>FMFI UK</li>\r\n                        <li>Batislava</li>\r\n                        <li><a href=\"/konferencia/miesto-konania\">Klikni pre viac informácií</a></li>\r\n                    </ul>\r\n                    <br>\r\n                    <br>\r\n                    <h3 class=\"py-2\">Prihlášky a registračný poplatok</h3>\r\n                    <ul>\r\n                        <li>Všetky potrebné údaje nádjete v sekcii [Názov sekcie] po prihlásení do systému</li>\r\n                        <li><a href=\"/dashboard\">Prihlásenie/Registrácia do systému</a></li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', 5, '2019-02-20 11:41:34', '2019-02-20 11:41:34', '<div class=\"section section-sm\" id=\"dalej\">\r\n    <div class=\"container shape-container d-flex\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-sm-10\">\r\n                    <h3 class=\"py-2\">Termín a miesto konania</h3>\r\n                    <ul>\r\n                        <li>xx.xx.2019</li>\r\n                        <li>FMFI UK</li>\r\n                        <li>Batislava</li>\r\n                        <li><a href=\"/konferencia/miesto-konania\">Klikni pre viac informácií</a></li>\r\n                    </ul>\r\n                    <br>\r\n                    <br>\r\n                    <h3 class=\"py-2\">Prihlášky a registračný poplatok</h3>\r\n                    <ul>\r\n                        <li>Všetky potrebné údaje nádjete v sekcii [Názov sekcie] po prihlásení do systému</li>\r\n                        <li><a href=\"/dashboard\">Prihlásenie/Registrácia do systému</a></li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', NULL, 1, NULL),
(11, 10, 'Program konferencie', 4, '', 6, '2019-02-20 11:42:33', '2019-02-20 11:42:33', '', NULL, 1, 98),
(12, 11, 'Header', 3, '<section class=\"section section-lg section-hero section-shaped pb-5\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Detaily ktoré musíš poznať</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', 1, '2019-02-20 14:00:59', '2019-02-21 19:42:51', '<section class=\"section section-lg section-hero section-shaped pb-100\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Details you must know</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', NULL, 1, NULL),
(13, 11, 'Lokácia', 4, '', 2, '2019-02-20 14:01:14', '2019-02-20 14:01:14', '', NULL, 1, 97),
(14, 11, 'Ubytovanie a Strava', 4, '', 3, '2019-02-21 17:04:00', '2019-02-21 17:04:00', '', NULL, 1, 96),
(15, 11, 'Špeciálne udalosti', 4, '', 4, '2019-02-21 18:41:45', '2019-02-21 18:41:45', '', NULL, 1, 95),
(16, 12, 'Prvý blok', 3, '<section class=\"section section-lg section-hero section-shaped pb-5\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Účastníci a príspevky</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', 1, '2019-03-09 10:53:23', '2019-03-09 10:53:23', '<section class=\"section section-lg section-hero section-shaped pb-5\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Participants and contributions</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', NULL, 1, NULL),
(17, 12, 'Zoznam účastníkov a príspevky', 4, '', 2, '2019-03-09 11:08:26', '2019-03-09 11:13:32', '', NULL, 1, 94),
(18, 13, 'Hlavicka', 3, '<section class=\"section section-lg section-hero section-shaped pb-5\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Galéria</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', 1, '2019-05-06 06:41:40', '2019-05-06 06:41:40', '<section class=\"section section-lg section-hero section-shaped pb-5\">\r\n    <!-- Background circles -->\r\n    <div class=\"shape shape-style-1 shape-primary\">\r\n        <span class=\"span-150 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-2s slower\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-4s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n        <span class=\"span-75 animated pulse infinite delay-1s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-2s slow\"></span>\r\n        <span class=\"span-50 animated pulse infinite delay-5s slow\"></span>\r\n        <span class=\"span-100 animated pulse infinite delay-3s slow\"></span>\r\n\r\n    </div>\r\n    <div class=\"container shape-container d-flex align-items-center py-lg\">\r\n        <div class=\"col px-0\">\r\n            <div class=\"row align-items-center justify-content-center\">\r\n                <div class=\"col-lg-10 text-center\">\r\n                    <h1 class=\"display-2 text-white\">Gallery</h1>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- SVG separator -->\r\n    <div class=\"separator separator-bottom separator-skew zindex-100\">\r\n        <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n        </svg>\r\n    </div>\r\n</section>', NULL, 1, NULL),
(19, 13, 'Galeria', 4, NULL, 2, '2019-05-06 06:43:55', '2019-05-06 06:43:55', '', NULL, 1, 93),
(20, 14, 'Hlavicka', 3, '<section class=\"section section-lg section-shaped pb-200\">\r\n        <div class=\"shape shape-style-3 shape-default\">\r\n        <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n        </div>\r\n        <div class=\"container py-lg-md d-flex text-center\">\r\n          <div class=\"col px-0\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-12\">\r\n                <h1 class=\"display-3 text-white\">Archív SCG\r\n                </h1>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <!-- SVG separator -->\r\n        <div class=\"separator separator-bottom separator-skew\">\r\n          <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n          </svg>\r\n        </div>\r\n      </section>\r\n      <!-- 1st Hero Variation -->', 1, '2019-05-06 06:54:24', '2019-05-06 06:54:24', '<section class=\"section section-lg section-shaped pb-200\">\r\n        <div class=\"shape shape-style-3 shape-default\">\r\n        <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n          <span></span>\r\n        </div>\r\n        <div class=\"container py-lg-md d-flex text-center\">\r\n          <div class=\"col px-0\">\r\n            <div class=\"row\">\r\n              <div class=\"col-lg-12\">\r\n                <h1 class=\"display-3 text-white\">Archive SCG\r\n                </h1>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <!-- SVG separator -->\r\n        <div class=\"separator separator-bottom separator-skew\">\r\n          <svg x=\"0\" y=\"0\" viewBox=\"0 0 2560 100\" preserveAspectRatio=\"none\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\r\n            <polygon class=\"fill-white\" points=\"2560 0 2560 100 0 100\"></polygon>\r\n          </svg>\r\n        </div>\r\n      </section>\r\n      <!-- 1st Hero Variation -->', NULL, 1, NULL),
(21, 14, 'Archív SCG - Zoznam', 4, NULL, 2, '2019-05-06 06:54:46', '2019-05-06 06:54:46', '', NULL, 1, 59);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hrebenar.martin1@gmail.com', '$2y$10$a7v/7QftFCoLUr.iwVjZaupOawNwrk22eSpziyHCnnjstCoFnHI12', '2019-05-21 17:46:38');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `contribution_id` int(10) NOT NULL,
  `accepted` tinyint(4) DEFAULT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `approved` tinyint(4) DEFAULT NULL,
  `form_fill_id` int(10) DEFAULT '-1',
  `assigned_by` int(10) DEFAULT '9999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `contribution_id`, `accepted`, `rating`, `review`, `approved`, `form_fill_id`, `assigned_by`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 1, 5, NULL, 1, 1, 1, '2019-04-28 13:16:47', '2019-04-28 14:10:01');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `review_forms`
--

CREATE TABLE `review_forms` (
  `id` int(10) NOT NULL,
  `conference_id` int(10) NOT NULL,
  `question_1_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_1_type` int(11) NOT NULL DEFAULT '1',
  `question_2_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_2_type` int(11) NOT NULL DEFAULT '1',
  `question_3_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_3_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_3_type` int(11) NOT NULL DEFAULT '1',
  `question_4_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_4_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_4_type` int(11) NOT NULL DEFAULT '1',
  `question_5_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_5_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_5_type` int(11) NOT NULL DEFAULT '1',
  `question_6_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_6_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_6_type` int(11) NOT NULL DEFAULT '1',
  `question_7_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_7_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_7_type` int(11) NOT NULL DEFAULT '1',
  `question_8_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_8_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_8_type` int(11) NOT NULL DEFAULT '1',
  `question_9_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_9_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_9_type` int(11) NOT NULL DEFAULT '1',
  `question_10_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_10_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_10_type` int(11) NOT NULL DEFAULT '1',
  `question_conclusion_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `question_conclusion_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `opened` tinyint(1) NOT NULL DEFAULT '0',
  `fill_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `review_forms`
--

INSERT INTO `review_forms` (`id`, `conference_id`, `question_1_sk`, `question_1_en`, `question_1_type`, `question_2_sk`, `question_2_en`, `question_2_type`, `question_3_sk`, `question_3_en`, `question_3_type`, `question_4_sk`, `question_4_en`, `question_4_type`, `question_5_sk`, `question_5_en`, `question_5_type`, `question_6_sk`, `question_6_en`, `question_6_type`, `question_7_sk`, `question_7_en`, `question_7_type`, `question_8_sk`, `question_8_en`, `question_8_type`, `question_9_sk`, `question_9_en`, `question_9_type`, `question_10_sk`, `question_10_en`, `question_10_type`, `question_conclusion_sk`, `question_conclusion_en`, `opened`, `fill_until`, `created_at`, `updated_at`) VALUES
(2, 8, 'Páčil sa Vám príspevok?', 'Did you liked the contribution?', 1, 'Spĺňa príspevok \"požiadavka\" ?', 'Does this contribution meet \"requirment\" ?', 2, 'Ešte jedna otázka, Koľko máte rokov?', 'One more question, How old are you?', 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, 'Zhodnoťte prosím príspevok celkovo', 'Please make assessment of the whole contribution', 1, '2019-05-05 12:24:10', '2019-04-14 10:03:54', '2019-05-05 12:24:10'),
(3, 12, 'Je to super ha?', 'Is it super ha ?', 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, 1, 'Celkovy dojem?', 'Final impression?', 1, '2019-05-04 10:40:45', '2019-05-04 10:40:30', '2019-05-04 10:40:45');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `review_form_fills`
--

CREATE TABLE `review_form_fills` (
  `id` int(10) NOT NULL,
  `form_id` int(10) NOT NULL,
  `review_id` int(10) NOT NULL,
  `answer_1` text COLLATE utf8mb4_unicode_ci,
  `answer_2` text COLLATE utf8mb4_unicode_ci,
  `answer_3` text COLLATE utf8mb4_unicode_ci,
  `answer_4` text COLLATE utf8mb4_unicode_ci,
  `answer_5` text COLLATE utf8mb4_unicode_ci,
  `answer_6` text COLLATE utf8mb4_unicode_ci,
  `answer_7` text COLLATE utf8mb4_unicode_ci,
  `answer_8` text COLLATE utf8mb4_unicode_ci,
  `answer_9` text COLLATE utf8mb4_unicode_ci,
  `answer_10` text COLLATE utf8mb4_unicode_ci,
  `conclusion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `review_form_fills`
--

INSERT INTO `review_form_fills` (`id`, `form_id`, `review_id`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `answer_5`, `answer_6`, `answer_7`, `answer_8`, `answer_9`, `answer_10`, `conclusion`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'Áno', '1', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11/10 topka', '2019-04-28 13:28:53', '2019-04-28 14:10:01');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'Super-Administrator', 'Super-Administrátor', '2018-11-14 10:51:57', '2018-11-14 10:51:57'),
(2, 'User', 'User', 'Používateľ', '2018-11-14 10:52:58', '2018-11-14 10:52:58'),
(3, 'Admin', 'Administrator', 'Administrátor', '2019-03-30 12:14:17', '2019-03-30 12:14:19'),
(4, 'Reviewer', 'Recenzent', 'Recenzent', '2019-03-30 12:13:38', '2019-03-30 12:13:40');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `access_level`) VALUES
(1, 'Martin', 'hrebenar.martin1@gmail.com', NULL, '$2y$10$2D./E9zWSLjfrPiFxigd3uflkPIndb7v.5.asDtWW3Thj8jMYAKIO', 'ePakOhmUXLshqPnSooxMeYV8h2p7ew2gN3Qe6XSplusfhu8dVP4PGlo2VoV8', '2018-11-13 11:07:07', '2019-05-24 12:00:16', 4),
(8, 'Admin 1', 'admin1@email.com', NULL, '$2y$10$LoMMzxdvbHjS74ai09yeAO6Ps6TAt/bYx6iQqCumJROUolQlkmjBW', 'zCaHwkJ3swhD6e5NrVffZgltLZXoQHAewbzQRcXRU6h6wRsXqnS3oXKbQjud', '2019-03-30 18:14:03', '2019-03-30 18:14:03', 1),
(9999, 'Wildcard', '*@*.*', NULL, '---', NULL, '2019-04-04 11:41:20', '2019-04-04 11:41:20', 4),
(10001, 'Daniela Bezáková', 'bezakova@fmph.uniba.sk', NULL, '$2y$10$q1aGcwT1ADdz66k751mun.xWsZZmIc3KVfNc/67/y4BEfhttBM2oy', 'tdIgpSNwhlqUZFXQHfUWGpDy8mGFxGBVziwelJaL5EJEjTzPZKII74zweVY7', '2019-05-24 11:58:28', '2019-05-24 11:58:28', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_images`
--

CREATE TABLE `user_images` (
  `id` int(10) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `alt_name` varchar(255) DEFAULT NULL,
  `mime` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_before` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_after` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `workplace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_psc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `title_before`, `title_after`, `gender`, `birthday`, `workplace`, `address_street`, `address_city`, `address_psc`, `address_country`, `ico`, `dic`, `phone`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Martin', NULL, 'Hrebeňár', NULL, '.php', 'M', '1997-06-09', 'Fakulta Matematiky Fyziky a Informatiky Univerzity Komenského v Bratislave', 'Vlčia dolina 1164', 'Dobšiná', '04925', '1', '6745864674578', '6758656757658', '+421904840102', 'profile_1.png', NULL, '2019-03-20 08:33:56'),
(4, 8, 'Admin', '', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2019-03-30 18:14:03', '2019-03-30 18:14:03'),
(9999, 9999, 'Wild', NULL, 'Card', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '999', NULL, NULL, NULL, NULL, '2019-04-04 12:10:03', '2019-04-04 12:10:03'),
(10001, 10001, 'Daniela', NULL, 'Bezáková', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '2019-05-24 11:58:28', '2019-05-24 11:58:28');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(5, 8, 3, '2019-03-30 18:15:42', '2019-03-30 18:15:44'),
(8, 1, 1, '2019-03-30 12:15:19', '2019-03-30 12:15:20'),
(11, 1, 4, NULL, NULL),
(12, 1, 3, NULL, NULL),
(13, 10001, 1, NULL, NULL),
(14, 10001, 3, NULL, NULL),
(15, 10001, 4, NULL, NULL);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_conference_id_fk` (`conference_id`),
  ADD KEY `applications_users_id_fk` (`user_id`);

--
-- Indexy pre tabuľku `conference`
--
ALTER TABLE `conference`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexy pre tabuľku `conference_config`
--
ALTER TABLE `conference_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_config_conference_id_fk` (`conference_id`);

--
-- Indexy pre tabuľku `conference_images`
--
ALTER TABLE `conference_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_images_conference_id_fk` (`item_id`);

--
-- Indexy pre tabuľku `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contributions_conference_id_fk` (`conference_id`),
  ADD KEY `contributions_users_id_fk` (`user_id`);

--
-- Indexy pre tabuľku `contribution_comments`
--
ALTER TABLE `contribution_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contribution_comments_contributions_id_fk` (`contribution_id`),
  ADD KEY `contribution_comments_users_id_fk` (`user_id`);

--
-- Indexy pre tabuľku `email_messages`
--
ALTER TABLE `email_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `front_menu`
--
ALTER TABLE `front_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `front_menu_conference_id_fk` (`conference_id`);

--
-- Indexy pre tabuľku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_conference_id_fk` (`conference_id`);

--
-- Indexy pre tabuľku `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_content_pages_id_fk` (`page_id`),
  ADD KEY `page_content_conference_id_fk` (`conference_id`);

--
-- Indexy pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_contributions_id_fk` (`contribution_id`),
  ADD KEY `reviews_users_id_fk` (`user_id`),
  ADD KEY `reviews_users_id_fk_2` (`assigned_by`),
  ADD KEY `reviews_review_form_fills_id_fk` (`form_fill_id`);

--
-- Indexy pre tabuľku `review_forms`
--
ALTER TABLE `review_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `review_form_fills`
--
ALTER TABLE `review_form_fills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_form_fills_review_forms_id_fk` (`form_id`),
  ADD KEY `review_form_fills_reviews_id_fk` (`review_id`);

--
-- Indexy pre tabuľku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_images_users_id_fk` (`item_id`);

--
-- Indexy pre tabuľku `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_profiles_users_id_fk` (`user_id`);

--
-- Indexy pre tabuľku `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_users_id_fk` (`user_id`),
  ADD KEY `user_roles_roles_id_fk` (`role_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pre tabuľku `conference`
--
ALTER TABLE `conference`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pre tabuľku `conference_config`
--
ALTER TABLE `conference_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pre tabuľku `conference_images`
--
ALTER TABLE `conference_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pre tabuľku `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pre tabuľku `contribution_comments`
--
ALTER TABLE `contribution_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `email_messages`
--
ALTER TABLE `email_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pre tabuľku `front_menu`
--
ALTER TABLE `front_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pre tabuľku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pre tabuľku `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pre tabuľku `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `review_forms`
--
ALTER TABLE `review_forms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `review_form_fills`
--
ALTER TABLE `review_form_fills`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;

--
-- AUTO_INCREMENT pre tabuľku `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;

--
-- AUTO_INCREMENT pre tabuľku `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `conference_config`
--
ALTER TABLE `conference_config`
  ADD CONSTRAINT `conference_config_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `conference_images`
--
ALTER TABLE `conference_images`
  ADD CONSTRAINT `conference_images_conference_id_fk` FOREIGN KEY (`item_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`);

--
-- Obmedzenie pre tabuľku `contribution_comments`
--
ALTER TABLE `contribution_comments`
  ADD CONSTRAINT `contribution_comments_contributions_id_fk` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contribution_comments_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `front_menu`
--
ALTER TABLE `front_menu`
  ADD CONSTRAINT `front_menu_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `page_content`
--
ALTER TABLE `page_content`
  ADD CONSTRAINT `page_content_conference_id_fk` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_content_pages_id_fk` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_contributions_id_fk` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_review_form_fills_id_fk` FOREIGN KEY (`form_fill_id`) REFERENCES `review_form_fills` (`id`),
  ADD CONSTRAINT `reviews_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_users_id_fk_2` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`);

--
-- Obmedzenie pre tabuľku `review_form_fills`
--
ALTER TABLE `review_form_fills`
  ADD CONSTRAINT `review_form_fills_review_forms_id_fk` FOREIGN KEY (`form_id`) REFERENCES `review_forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_form_fills_reviews_id_fk` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `user_images_users_id_fk` FOREIGN KEY (`item_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Obmedzenie pre tabuľku `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_roles_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
