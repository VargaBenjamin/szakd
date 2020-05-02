-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 02. 10:31
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `framedb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Google` varchar(30) DEFAULT NULL,
  `Facebook` varchar(30) DEFAULT NULL,
  `Twitter` varchar(30) DEFAULT NULL,
  `activationcode` varchar(50) DEFAULT '',
  `coach` tinyint(1) NOT NULL DEFAULT 0,
  `gymid` int(4) DEFAULT NULL,
  `coachid` int(4) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `Google`, `Facebook`, `Twitter`, `activationcode`, `coach`, `gymid`, `coachid`, `telephone`) VALUES
(2, 'Benji', '$2y$10$Vj5YQAPAGClxpaDXIGKRGelOFPylARcGGIvRjJBErSwmuFNheYU4i', 'klim.bendzsi@t-online.hu', '102361726750354020992', '3428723143809610', '942796085310914562', 'activated', 1, 1, 2, '+36305489899'),
(4, 'dora', '$2y$10$YV.oGZcQsCUqRXcDOI2ZquBHwiuXQD7MvM2eUS0vv6nyKew8Eonjq', 'mate.dori15@gmail.com', NULL, NULL, NULL, 'activated', 0, 1, 2, NULL),
(98, 'cli', '$2y$10$HbSQqwQ6fkgBn.8Xs3A1WeA2BhlWH1ksumOvAP/5iUxbh3wRugRRK', 'klim.bendzsi@t-online.hu', NULL, NULL, NULL, '5ea732bee245b', 0, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `authorid` int(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `preview` varchar(300) NOT NULL,
  `maintext` varchar(2500) NOT NULL,
  `picture` varchar(150) NOT NULL DEFAULT 'https://www.gymchalo.com/wp-content/uploads/2015/12/pre-workout-meal-750x350.jpg',
  `publishtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `articles`
--

INSERT INTO `articles` (`id`, `authorid`, `title`, `preview`, `maintext`, `picture`, `publishtime`) VALUES
(2, 2, 'test', '2adsadsad', '3asddadad', 'https://www.gymchalo.com/wp-content/uploads/2015/12/pre-workout-meal-750x350.jpg', '2020-04-10 09:40:25'),
(3, 2, 'El vál', 'sdfdf', 'sdfsdf', 'https://www.gymchalo.com/wp-content/uploads/2015/12/pre-workout-meal-750x350.jpg', '2020-04-10 16:36:34'),
(5, 2, 'színes', 'ascsdífasdígsdfs', 'sdfsaívsígdrhgdxfcbyfycsdvvjkdhksjbsdjhbewazpifgspcísdjvbpisubawepf', 'https://www.gymchalo.com/wp-content/uploads/2015/12/pre-workout-meal-750x350.jpg', '2020-04-10 17:57:06'),
(6, 2, 'Edzés éhgyomorra? Pro és kontra!', 'Örök vita tárgya, hogy edzeni reggel éhgyomorra jobb-e, vagy pedig tápanyagokkal feltöltve, úgymond teli tankkal. Főleg súlyzós edzés esetében érdekes a kérdés. De mit mond a tudomány, és mit mond a tapasztalat?', 'Valamiért az új, \"tudományosan\" alátámasztott diéták és a bevált módszerek hatásosságának taglalása mindig vitákat gerjeszt. Érdekes módon ez itthon még hangsúlyosabb - jó pár külföldi oldalt is láttunk már, és ott nem jellemzőek az ilyen indulatok, mint amiket nálunk vált ki az ilyesmi. Az új, vagy kevesek által ismert módszerek támogatói és a régi, \"jól bevált\", vagy egyszerűen gondolkodás nélkül adaptált módszerek szemellenzős hívei dühödt netes szájkarate formájában ütköztetik érveiket.\r\nPróbáljuk meg hát tárgyilagosan nézni a dolgokat, anélkül, hogy túlságosan elmerülnénk az unalmas tudományos értekezésekben!\r\n\r\nTudomány?\r\nAlapszabály, hogy minden kutatásra kis kereséssel lehet találni egy olyan ellenpéldát, ami pont az adott kutatás ellenkezőjét bizonyítja. Elég nehéz kiszűrni a valós, számunkra releváns infókat a tudományos katyvaszból. Nehezíti a kérdést, hogy ha egy felkapott guru idéz egy akármilyen tanulmányból, azt úgyis mindenki készpénznek fogja venni. Akkor az a tanulmány kóser. Vegyünk egy példát, az éhgyomorra történő edzéssel kapcsolatosan!\r\n\r\nEzt a kutatást egy olyan cikkben találtuk, mely az éhgyomorra történő edzés előnyeit ecsetelte. A cikk elég meggyőző. A kutatás szerint az éhgyomorra történő edzés elősegíti a zsírvesztést, és javítja az inzulinérzékenységet is. Három csoportot vizsgáltak a kutatásban, az egyik evett reggel és nem edzett, a másik étkezés után edzett, a harmadik pedig éhgyomorra edzett. Minden mutató a harmadik csoport esetében volt a legjobb. Na, és akkor most jönnek a részletek, mert az ördög mindig a részletekben rejlik!\r\n\r\nHa beleolvasunk csak az \"abstract\"-ba, már ott láthatjuk, hogy egyrészt elég egészségtelen ételekkel tömték a résztvevőket a kutatás ideje alatt. Olyan étrendet alkalmaztak, ami már önmagában egyenes utat jelent az inzulinrezisztenciához hosszú távon. Emellett állóképességi edzést végeztek az alanyok, nem pedig súlyzós edzést. Ráadásul a reggel elfogyasztott ételeknél csak szénhidrátokról esik szó. Tehát adott egy kutatás, amiben nap közben zsírral, edzés előtt és közben (vagy ahelyett) szénhidrátokkal tömik az alanyokat, akik egyébként kardióznak reggel, a kontrollcsoportot leszámítva. Meglepő, hogy az a csoport mutatja a legjobb eredményeket, aki éhgyomorra edzett?\r\n\r\n', 'https://www.gymchalo.com/wp-content/uploads/2015/12/pre-workout-meal-750x350.jpg', '2020-04-16 06:56:24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `calendaroption`
--

CREATE TABLE `calendaroption` (
  `id` int(4) NOT NULL,
  `coachid` int(4) NOT NULL,
  `basicview` varchar(25) NOT NULL DEFAULT 'timeGridWeek',
  `views` varchar(100) NOT NULL DEFAULT 'dayGridMonth,timeGridWeek,timeGridDay,list',
  `hiddendays` varchar(40) NOT NULL DEFAULT '0,6',
  `mintime` varchar(10) NOT NULL DEFAULT '06:00',
  `maxtime` varchar(10) NOT NULL DEFAULT '18:00',
  `overlap` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `calendaroption`
--

INSERT INTO `calendaroption` (`id`, `coachid`, `basicview`, `views`, `hiddendays`, `mintime`, `maxtime`, `overlap`) VALUES
(1, 2, 'timeGridWeek', 'list,timeGridDay,timeGridWeek,dayGridMonth', '0,6', '05:00', '22:00', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `charts`
--

CREATE TABLE `charts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `selected` varchar(20) NOT NULL DEFAULT '0,1,8,10',
  `day` int(2) NOT NULL DEFAULT 14
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `charts`
--

INSERT INTO `charts` (`id`, `userid`, `selected`, `day`) VALUES
(1, 2, '0,1,2,3,4,5,6,8', 32),
(11, 98, '0,1,8,10', 14);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `commenttext` varchar(500) NOT NULL,
  `reply` int(4) DEFAULT 0,
  `articleid` int(11) NOT NULL,
  `commentdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`id`, `authorid`, `commenttext`, `reply`, `articleid`, `commentdate`) VALUES
(77, 2, 'haha', 0, 6, '2020-04-16 15:41:09'),
(78, 2, 'dgdgfddg', 0, 6, '2020-04-16 17:46:06'),
(80, 2, 'fgfddg', 78, 6, '2020-04-16 19:07:28'),
(81, 2, 'dgvdsfggd', 0, 6, '2020-04-16 19:09:54'),
(82, 2, 'dfgdbvcvnmj', 80, 6, '2020-04-16 19:09:59'),
(83, 2, 'naaaa', 0, 5, '2020-04-16 19:11:12'),
(84, 2, 'adderg', 83, 5, '2020-04-16 19:11:16'),
(86, 2, 'asfysdf', 0, 6, '2020-04-21 13:23:26'),
(87, 2, 'serse', 0, 6, '2020-04-21 13:26:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customevents`
--

CREATE TABLE `customevents` (
  `id` int(11) NOT NULL,
  `coachid` int(4) NOT NULL,
  `title` varchar(200) NOT NULL,
  `duration` varchar(5) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `customevents`
--

INSERT INTO `customevents` (`id`, `coachid`, `title`, `duration`, `color`) VALUES
(60, 2, 'alap', '04:00', '#3788d8'),
(63, 2, 'Két órás', '02:00', '#008000'),
(79, 2, 'test', '01:30', '#3788d8');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `customeventid` int(4) DEFAULT NULL,
  `coachid` int(4) DEFAULT NULL,
  `clientid` int(4) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `events`
--

INSERT INTO `events` (`id`, `customeventid`, `coachid`, `clientid`, `title`, `start_event`, `end_event`, `color`) VALUES
(219, 63, 2, 2, 'Két órás', '2020-04-22 13:30:00', '2020-04-22 15:30:00', '#008000'),
(221, 63, 2, 98, 'Két órás', '2020-04-28 05:00:00', '2020-04-28 07:00:00', '#008000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gym`
--

CREATE TABLE `gym` (
  `id` int(4) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `gym`
--

INSERT INTO `gym` (`id`, `name`) VALUES
(1, 'Pécsi edzőterem'),
(2, 'Budapesti edzőterem');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workoutdata`
--

CREATE TABLE `workoutdata` (
  `id` int(4) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `suly` int(4) DEFAULT NULL,
  `testzsirszazalek` int(4) DEFAULT NULL,
  `combboseg` int(4) DEFAULT NULL,
  `derekboseg` int(4) DEFAULT NULL,
  `csipoboseg` int(4) DEFAULT NULL,
  `mellboseg` int(4) DEFAULT NULL,
  `vallszelesseg` int(4) DEFAULT NULL,
  `karboseg` int(4) DEFAULT NULL,
  `adottido` int(4) DEFAULT NULL,
  `adottkm` int(4) DEFAULT NULL,
  `felhuzasmax` int(4) DEFAULT NULL,
  `fekvenyomasmax` int(4) DEFAULT NULL,
  `gugolasmax` int(4) DEFAULT NULL,
  `felhuzassajat` int(4) DEFAULT NULL,
  `fekvenyomassajat` int(4) DEFAULT NULL,
  `gugolassajat` int(4) DEFAULT NULL,
  `clientID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `workoutdata`
--

INSERT INTO `workoutdata` (`id`, `datum`, `suly`, `testzsirszazalek`, `combboseg`, `derekboseg`, `csipoboseg`, `mellboseg`, `vallszelesseg`, `karboseg`, `adottido`, `adottkm`, `felhuzasmax`, `fekvenyomasmax`, `gugolasmax`, `felhuzassajat`, `fekvenyomassajat`, `gugolassajat`, `clientID`) VALUES
(1, '2020-04-15', 87, 19, 40, 100, 80, 110, 120, 35, 1780, 17, 95, 100, 100, 20, 30, 50, 2),
(2, '2020-04-17', 86, 19, 41, 105, 83, 110, 121, 40, 1820, 17, 98, 103, 110, 22, 32, 55, 2),
(3, '2020-04-19', 87, 18, 41, 106, 84, 113, 123, NULL, 2050, 16, 99, 103, 120, 24, 35, 60, 2),
(4, '2020-04-20', 86, 18, 42, 105, 84, 114, 124, 42, 2120, 16, 101, 105, 124, 25, 35, 65, 2),
(5, '2020-04-22', 85, 18, 44, 107, 84, 115, 126, 42, 2200, 15, 100, 105, 125, 25, 40, 65, 2),
(16, '2020-04-18', 90, 50, 40, 100, 80, 110, 120, 35, NULL, 16, 95, 100, 100, 20, 30, 50, 2);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gymid` (`gymid`),
  ADD KEY `accounts_ibfk_2` (`coachid`);

--
-- A tábla indexei `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_ibfk_1` (`authorid`);

--
-- A tábla indexei `calendaroption`
--
ALTER TABLE `calendaroption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendaroption_ibfk_1` (`coachid`);

--
-- A tábla indexei `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charts_ibfk_1` (`userid`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`articleid`),
  ADD KEY `comments_ibfk_2` (`authorid`);

--
-- A tábla indexei `customevents`
--
ALTER TABLE `customevents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customevents_ibfk_1` (`coachid`);

--
-- A tábla indexei `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_ibfk_1` (`customeventid`),
  ADD KEY `events_ibfk_2` (`clientid`),
  ADD KEY `events_ibfk_3` (`coachid`);

--
-- A tábla indexei `gym`
--
ALTER TABLE `gym`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `workoutdata`
--
ALTER TABLE `workoutdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workoutdata_ibfk_1` (`clientID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT a táblához `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `calendaroption`
--
ALTER TABLE `calendaroption`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `charts`
--
ALTER TABLE `charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT a táblához `customevents`
--
ALTER TABLE `customevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT a táblához `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT a táblához `gym`
--
ALTER TABLE `gym`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `workoutdata`
--
ALTER TABLE `workoutdata`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`gymid`) REFERENCES `gym` (`id`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`coachid`) REFERENCES `accounts` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`authorid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `calendaroption`
--
ALTER TABLE `calendaroption`
  ADD CONSTRAINT `calendaroption_ibfk_1` FOREIGN KEY (`coachid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `charts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`articleid`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`authorid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `customevents`
--
ALTER TABLE `customevents`
  ADD CONSTRAINT `customevents_ibfk_1` FOREIGN KEY (`coachid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`customeventid`) REFERENCES `customevents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`clientid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`coachid`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `workoutdata`
--
ALTER TABLE `workoutdata`
  ADD CONSTRAINT `workoutdata_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
