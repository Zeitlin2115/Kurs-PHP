-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Kwi 2022, 11:47
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `osadnicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `dnipremium` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `dnipremium`) VALUES
(1, 'adam', '$2y$10$NRY2OBrIwZE/XbXQ4qCelOKTOL0kKxPGJ9.FwU.6Asy1yocnT3SKS', 'adam@gmail.com', 213, 5675, 342, '2017-01-15 09:30:15'),
(2, 'marek', 'asdfg', 'marek@gmail.com', 324, 1123, 4325, '0000-00-00 00:00:00'),
(3, 'anna', 'zxcvb', 'anna@gmail.com', 4536, 17, 120, '0000-00-00 00:00:00'),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com', 5465, 132, 189, '0000-00-00 00:00:00'),
(5, 'justyna', 'yuiop', 'justyna@gmail.com', 245, 890, 554, '0000-00-00 00:00:00'),
(6, 'kasia', 'hjkkl', 'kasia@gmail.com', 267, 980, 109, '0000-00-00 00:00:00'),
(7, 'beata', 'fgthj', 'beata@gmail.com', 565, 356, 447, '0000-00-00 00:00:00'),
(8, 'jakub', 'ertyu', 'jakub@gmail.com', 2467, 557, 876, '0000-00-00 00:00:00'),
(9, 'janusz', 'cvbnm', 'janusz@gmail.com', 65, 456, 2467, '2022-04-19 09:03:43'),
(10, 'roman', 'dfghj', 'roman@gmail.com', 97, 226, 245, '0000-00-00 00:00:00'),
(11, 'zeitlin', '$2y$10$Tc5lauWJnzLqIlxvJQ0R7.rFBSa4lmPNnE9eQFYpvUNKj.44ewroi', 'Staraptor09@gmail.com', 100, 100, 100, '0000-00-00 00:00:00'),
(12, 'benek', '$2y$10$PzIJM7ZU9LnZfSucHHhYNuvELcrndvQHXiYov/VwilrImjAOYlpge', 'benek@gmail.com', 100, 100, 100, '0000-00-00 00:00:00'),
(13, 'mirek', '$2y$10$rBeg3Y3UqdQoxJwHhXHQyOZlrk4QI0PnhMDO0UjCHa7kAN8DILrcW', 'mirek12@gmail.com', 100, 100, 100, '0000-00-00 00:00:00'),
(14, 'janek1', '$2y$10$LTz/e8LdYDEOd2hg5h.mkuNqXdv1KekZsSwOubJfOH7LJ7WkEuKhC', 'janek1@gmail.com', 100, 100, 100, '0000-00-00 00:00:00'),
(15, 'kamams', '$2y$10$mS7Tfjbo7.kxemnYcHbtT.eXIJbjXOqdfs.bdffB2fsX.XV3VLVH.', 'kamil@gmail.com', 100, 100, 100, '0000-00-00 00:00:00'),
(16, 'bambik', '$2y$10$ppi2CP8WIGNYiv8UdlB6GOjX0B226PSy/rUzSk07NObGxGFWuRuZS', 'bambik@gmal.com', 100, 100, 100, '2022-05-03 09:10:25');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
