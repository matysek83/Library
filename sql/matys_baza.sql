-- phpMyAdmin SQL Dump
-- version 4.3.8deb0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 26 Wrz 2015, 10:50
-- Wersja serwera: 5.5.44-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.29-1+deb.sury.org~trusty+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `matys_baza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `borrowed_books`
--

CREATE TABLE IF NOT EXISTS `borrowed_books` (
  `borrowed_id` int(10) unsigned NOT NULL,
  `book_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_borrowed_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ht';

--
-- Zrzut danych tabeli `borrowed_books`
--

INSERT INTO `borrowed_books` (`borrowed_id`, `book_id`, `user_id`, `date_borrowed_book`) VALUES
(17, 10, 4, '2015-09-24 15:10:12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `book_id` int(10) unsigned NOT NULL,
  `date_of_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `book_id`, `date_of_order`) VALUES
(48, 4, 37, '2015-09-23 16:14:04'),
(49, 4, 5, '2015-09-24 15:11:58'),
(50, 4, 3, '2015-09-25 13:23:45'),
(51, 14, 6, '2015-09-26 08:49:04'),
(52, 14, 6, '2015-09-26 08:49:06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `returned_books`
--

CREATE TABLE IF NOT EXISTS `returned_books` (
  `returned_id` int(10) unsigned NOT NULL,
  `borrowed_id` int(10) unsigned NOT NULL,
  `book_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_borrowed_book` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_return` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `returned_books`
--

INSERT INTO `returned_books` (`returned_id`, `borrowed_id`, `book_id`, `user_id`, `date_borrowed_book`, `date_of_return`) VALUES
(1, 0, 4, 1, '0000-00-00 00:00:00', '2015-09-12 13:35:52'),
(2, 0, 2, 1, '0000-00-00 00:00:00', '2015-09-12 13:35:56'),
(3, 0, 5, 1, '0000-00-00 00:00:00', '2015-09-12 13:36:47'),
(4, 0, 7, 1, '2015-09-12 15:39:30', '2015-09-12 13:39:33'),
(5, 0, 7, 1, '', '2015-09-12 18:31:30'),
(6, 0, 7, 1, '', '2015-09-12 18:31:33'),
(7, 0, 7, 1, '', '2015-09-12 18:33:12'),
(8, 0, 7, 1, '', '2015-09-12 18:33:51'),
(9, 0, 7, 1, '', '2015-09-12 18:34:18'),
(10, 0, 2, 1, '', '2015-09-13 08:20:22'),
(11, 0, 5, 1, '', '2015-09-13 08:25:53'),
(12, 0, 5, 1, '', '2015-09-13 08:26:11'),
(13, 0, 4, 1, '2015-09-13 10:58:55', '2015-09-13 09:18:27'),
(14, 9, 2, 1, '2015-09-13 11:48:52', '2015-09-23 15:45:16'),
(15, 12, 9, 4, '2015-09-23 17:45:37', '2015-09-23 16:04:10'),
(16, 13, 22, 4, '2015-09-23 18:01:38', '2015-09-23 16:07:49'),
(17, 14, 11, 4, '2015-09-23 18:07:43', '2015-09-23 16:07:50'),
(18, 15, 6, 4, '2015-09-23 18:15:10', '2015-09-23 16:17:11'),
(19, 11, 7, 1, '2015-09-23 17:08:48', '2015-09-24 14:53:02'),
(20, 10, 5, 1, '2015-09-13 11:48:54', '2015-09-24 14:53:03'),
(21, 16, 39, 4, '2015-09-23 18:15:11', '2015-09-24 15:10:16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `table_books`
--

CREATE TABLE IF NOT EXISTS `table_books` (
  `book_id` int(10) unsigned NOT NULL,
  `book_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publishing_house` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `year_of_publication` smallint(6) NOT NULL,
  `binding` tinyint(4) NOT NULL,
  `availability` tinyint(4) unsigned NOT NULL DEFAULT '2',
  `date_added_book` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `table_books`
--

INSERT INTO `table_books` (`book_id`, `book_name`, `author`, `publishing_house`, `year_of_publication`, `binding`, `availability`, `date_added_book`) VALUES
(2, 'Harry Potter1', 'J.K. Roling', 'New York', 2012, 0, 0, '2015-08-02 11:08:27'),
(3, 'Pan Tadeusz', 'Adam Mickiewicz', 'Wydawnictwo Katowice', 2001, 0, 1, '2015-08-02 11:08:27'),
(4, 'Nazwa1', 'Autor', 'Wydawnictwo', 1220, 0, 0, '2015-08-02 11:08:27'),
(5, 'Nazwa', 'Autor', 'Wydawnictwo', 1000, 0, 1, '2015-08-02 11:08:27'),
(6, 'fds', 'fds', 'fd', 1212, 1, 1, '2015-08-19 09:05:22'),
(7, 'gfd', 'hgdf', 'hgfh', 1212, 0, 2, '2015-08-19 09:05:41'),
(8, 'tgrfd', 'htey5hb', 'hbntrhr', 1212, 1, 0, '2015-08-19 09:05:57'),
(9, 'fds4t34', 'gh54hg', '5h35h', 1241, 1, 0, '2015-08-19 09:06:15'),
(10, 'f34t34', 'gr433yh3', 'gh53yh54', 1111, 1, 0, '2015-08-19 09:06:39'),
(11, '6htrn', 'ghfhrty', 'jhjty', 1241, 1, 0, '2015-08-19 09:06:51'),
(12, 'gfge', 'autor', 'wydawnictwo', 1241, 1, 2, '2015-08-19 09:07:07'),
(13, 'hgfhgf', 'hgfhgf', 'hgf', 1212, 1, 2, '2015-08-19 09:07:20'),
(14, 'gfdddddddddddddddddddddddddddddddddddddddddddddddd', 'gfdddddddddddddddddddddddddddddddddddddddddddddddd', 'grderggggggggggggggggggggggggggggggggggggggggggggg', 1211, 1, 2, '2015-08-19 09:08:16'),
(15, 'asdflalalalalalalalalalalalalalalalalalalalala', 'asdflalalalalalalalalalalalalalalalalalalalala', 'asdflalalalalalalalalalalalalalalalalalalalala', 1211, 1, 2, '2015-08-19 09:08:59'),
(16, 'Dziady', 'Mickiewicz', 'wyd', 1999, 1, 2, '2015-08-25 12:01:01'),
(17, 'Potop', 'Sienkiewicz', 'wyd', 1999, 0, 2, '2015-08-25 12:01:29'),
(18, 'Krzyżacy', 'Sienkiewicz', 'Łódź', 2012, 0, 2, '2015-08-25 12:02:03'),
(19, 'Odyseja', 'Lem', 'Radom', 2000, 1, 2, '2015-08-25 12:04:50'),
(20, 'Władca Pierścieni', 'Tolkien', 'Warszawa', 2006, 1, 2, '2015-08-25 12:05:25'),
(21, 'Hobbit', 'Tolkien', 'Sandomierz', 2009, 1, 2, '2015-08-25 12:05:50'),
(22, 'Alien', 'Predator', 'Lublin', 2009, 0, 2, '2015-08-25 12:06:29'),
(23, '﻿Pan Wołodyjowski', 'Sienkiewicz', 'Polska', 2012, 0, 2, '2015-08-31 17:05:31'),
(24, 'gthr', 'htrhrt', 'htrhr', 2121, 0, 2, '2015-08-31 18:34:40'),
(25, '34', '545', '666', 2121, 1, 2, '2015-08-31 19:03:38'),
(26, 'Odyseja kosmiczna', 'Lem', 'Puławy', 2015, 0, 2, '2015-08-31 19:15:06'),
(29, 'Puławy1', 'Puławy1', 'Puławy1', 2015, 1, 2, '2015-08-31 20:10:29'),
(30, 'Puławy2', 'Puławy2', 'Puławy2', 2012, 0, 2, '2015-08-31 20:10:29'),
(31, '1', '1', '1', 1111, 0, 2, '2015-09-01 14:26:13'),
(32, '22', '22', '22', 2222, 1, 2, '2015-09-01 14:28:48'),
(33, '33333', '333', '333', 3333, 0, 2, '2015-09-01 14:29:23'),
(34, '4444', '4444', '4444', 4444, 1, 2, '2015-09-01 14:29:23'),
(35, '﻿Pan Wołodyjowski', 'Sienkiewicz', 'Polska', 2012, 0, 1, '2015-09-11 11:32:50'),
(36, 'ostatnia', 'mochikanimn', 'dsad', 2121, 1, 2, '2015-09-22 13:23:34'),
(37, '1111', '1111', '1111', 1111, 0, 1, '2015-09-23 13:08:54');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` smallint(5) unsigned NOT NULL,
  `activation_code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date_added_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `email`, `permissions`, `activation_code`, `date_added_entry`) VALUES
(1, 'matys', '3e2b76a7500a105b5e0b63e860785ce02ffdc325f03207b05da225ce8c8bbda8f1550112348b39f37b87dffc1ab4ed1732b878538cf4f32f1eb4ab3308e0a95e', 'mateuszsikora2@wp.pl', 3, 'abc', '2015-08-27 12:45:13'),
(4, 'matysek', '3e2b76a7500a105b5e0b63e860785ce02ffdc325f03207b05da225ce8c8bbda8f1550112348b39f37b87dffc1ab4ed1732b878538cf4f32f1eb4ab3308e0a95e', 'ismatys@onet.pl', 2, '0ed09d0eeea29645a3421c16b0173b6933ee771d31d63650f800ba2a8be88ee157f66971f962bb21267fbf9aa977ad2bce771590671f581221a2443e37cb5f83', '2015-09-17 19:08:56'),
(14, 'matysek83', '3e2b76a7500a105b5e0b63e860785ce02ffdc325f03207b05da225ce8c8bbda8f1550112348b39f37b87dffc1ab4ed1732b878538cf4f32f1eb4ab3308e0a95e', 'mateuszsikora2@gmail.com', 2, '1', '2015-09-26 08:12:09');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD UNIQUE KEY `borrowed_id` (`borrowed_id`), ADD KEY `book_id` (`book_id`), ADD KEY `user_id` (`user_id`), ADD KEY `date_borrowed_book` (`date_borrowed_book`), ADD KEY `book_id_2` (`book_id`,`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`), ADD KEY `user_id` (`user_id`,`book_id`), ADD KEY `user_id_2` (`user_id`,`book_id`), ADD KEY `user_id_3` (`user_id`,`book_id`), ADD KEY `book_id` (`book_id`), ADD KEY `user_id_4` (`user_id`), ADD KEY `date_of_order` (`date_of_order`), ADD KEY `user_id_5` (`user_id`), ADD KEY `user_id_6` (`user_id`,`book_id`);

--
-- Indexes for table `returned_books`
--
ALTER TABLE `returned_books`
  ADD PRIMARY KEY (`returned_id`), ADD KEY `book_id` (`book_id`,`user_id`,`date_of_return`), ADD KEY `user_id` (`user_id`), ADD KEY `borrowed_id` (`borrowed_id`);

--
-- Indexes for table `table_books`
--
ALTER TABLE `table_books`
  ADD PRIMARY KEY (`book_id`), ADD KEY `availability` (`availability`), ADD KEY `availability_2` (`availability`), ADD KEY `book_name` (`book_name`), ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `login` (`login`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `email_2` (`email`,`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `borrowed_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT dla tabeli `returned_books`
--
ALTER TABLE `returned_books`
  MODIFY `returned_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT dla tabeli `table_books`
--
ALTER TABLE `table_books`
  MODIFY `book_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `borrowed_books`
--
ALTER TABLE `borrowed_books`
ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `table_books` (`book_id`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `table_books` (`book_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
