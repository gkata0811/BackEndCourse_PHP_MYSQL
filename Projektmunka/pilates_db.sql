-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2026. Sze 09. 20:15
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pilates_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `idosavok`
--

CREATE TABLE `idosavok` (
  `id` int(11) NOT NULL,
  `idosav` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `idosavok`
--

INSERT INTO `idosavok` (`id`, `idosav`) VALUES
(3, '16:00 - 16:50'),
(4, '17:00 - 17:50'),
(5, '18:00 - 18:50'),
(6, '19:00 - 19:50'),
(1, '7:00 - 7:50'),
(2, '8:00 - 8:50');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jelentkezesek`
--

CREATE TABLE `jelentkezesek` (
  `id` int(11) NOT NULL,
  `nev` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `oratipus_id` int(11) NOT NULL,
  `nap_id` int(11) NOT NULL,
  `idosav_id` int(11) NOT NULL,
  `tapasztalat_id` int(11) NOT NULL,
  `letrehozva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `napok`
--

CREATE TABLE `napok` (
  `id` int(11) NOT NULL,
  `nev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `napok`
--

INSERT INTO `napok` (`id`, `nev`) VALUES
(4, 'Csütörtök'),
(1, 'Hétfő'),
(2, 'Kedd'),
(5, 'Péntek'),
(3, 'Szerda');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `oratipusok`
--

CREATE TABLE `oratipusok` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `oratipusok`
--

INSERT INTO `oratipusok` (`id`, `nev`) VALUES
(3, 'Hot Pilates'),
(1, 'Mat Pilates'),
(2, 'Reformer Pilates');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapasztalatok`
--

CREATE TABLE `tapasztalatok` (
  `id` int(11) NOT NULL,
  `valasz` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `tapasztalatok`
--

INSERT INTO `tapasztalatok` (`id`, `valasz`) VALUES
(1, 'Igen'),
(2, 'Nem');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `idosavok`
--
ALTER TABLE `idosavok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idosav` (`idosav`);

--
-- A tábla indexei `jelentkezesek`
--
ALTER TABLE `jelentkezesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_oratipus` (`oratipus_id`),
  ADD KEY `fk_nap` (`nap_id`),
  ADD KEY `fk_idosav` (`idosav_id`),
  ADD KEY `fk_tapasztalat` (`tapasztalat_id`);

--
-- A tábla indexei `napok`
--
ALTER TABLE `napok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`);

--
-- A tábla indexei `oratipusok`
--
ALTER TABLE `oratipusok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`);

--
-- A tábla indexei `tapasztalatok`
--
ALTER TABLE `tapasztalatok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valasz` (`valasz`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `idosavok`
--
ALTER TABLE `idosavok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `jelentkezesek`
--
ALTER TABLE `jelentkezesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `napok`
--
ALTER TABLE `napok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `oratipusok`
--
ALTER TABLE `oratipusok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `tapasztalatok`
--
ALTER TABLE `tapasztalatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `jelentkezesek`
--
ALTER TABLE `jelentkezesek`
  ADD CONSTRAINT `fk_idosav` FOREIGN KEY (`idosav_id`) REFERENCES `idosavok` (`id`),
  ADD CONSTRAINT `fk_nap` FOREIGN KEY (`nap_id`) REFERENCES `napok` (`id`),
  ADD CONSTRAINT `fk_oratipus` FOREIGN KEY (`oratipus_id`) REFERENCES `oratipusok` (`id`),
  ADD CONSTRAINT `fk_tapasztalat` FOREIGN KEY (`tapasztalat_id`) REFERENCES `tapasztalatok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
