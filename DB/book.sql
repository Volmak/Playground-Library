-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 яну 2017 в 14:18
-- Версия на сървъра: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Структура на таблица `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `author` varchar(20) NOT NULL,
  `cover` varchar(50) NOT NULL,
  `published` date NOT NULL,
  `format` char(2) NOT NULL,
  `pages` int(4) NOT NULL,
  `isbn` bigint(13) NOT NULL,
  `resume` text NOT NULL,
  `posted_by` int(11) NOT NULL,
  `last_edit_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `cover`, `published`, `format`, `pages`, `isbn`, `resume`, `posted_by`, `last_edit_by`) VALUES
(1, 'Ghost King', 'David Gemmell', 'cover447858907e145c4014.97679106.jpg', '1995-11-29', 'A3', 304, 9780099565505, 'Chaos and terror stalked the realm. The king had been slain by traitors, and the sword of power had been lost beyond the Circle of Mist. Armies of Saxons, Angles, Jutes, and Brigantes cut a gory swath across the land, led by puppets of the ruthless Witch Queen--whose minions included dark, bloodthirsty creatures and a savage, undead warrior.\r\nAll hope lay with young Thuro--in whose veins flowed the blood of kings. He would have to defeat the Witch Queen''s monsters and travel to the land of the Mist, there to seek a ghostly army. And the only one who could prepare Thuro to achieve his birthright was the mountain warrior Culain, the one man who knew the queen''s deadly secret . . .\r\nThe legend of the mystic Stones of Power begins with a tale of blood and glory, of love and betrayal, as a boy must come of age amidst the seemingly impossible quest to become the High King.', 0, 1),
(2, 'Guards! Guards!', 'Terry Pratchett', 'cover24851588fa57a477757.93904482.jpg', '1989-08-08', 'A5', 376, 9783492285834, 'Guards! Guards! is the eighth Discworld novel by Terry Pratchett, first published in 1989. It is the first novel about the Ankh-Morpork City Watch. The first Discworld computer game borrowed heavily from Guards! Guards! in terms of plot.', 1, 1),
(3, 'Legacy of Blood', 'Richard A. Knaak', 'cover18737588fb29e9e7961.98593652.jpg', '2001-05-01', 'A5', 368, 9780671041557, 'Since the beginning of time, the angelic hosts of the High Heavens and the demonic hordes of the Burning Hells have been locked in a struggle for the fate of all Creation. That struggle has now come to the mortal realm... and neither Man nor Demon nor Angel will be left unscathed...\r\n\r\nNorrec Vizharan has become a living nightmare. While on a quest to find magical treasure, the soldier of fortune discovers an artifact beyond his wildest dreams: the ancient armor of Bartuc, the legendary Warlord of Blood. Now, pursued by demons who covet the dark armor for their own devices, Norrec must overcome a bloodlust he can scarcely control and learn the truth about his terrifying curse before he is lost to darkness forever...\r\n\r\nAn original tale of swords, sorcery, and timeless struggle based on the best-selling, award-winning M-rated electronic game from Blizzard Entertainment. Intended for mature readers. ', 1, 1),
(4, 'Witch world (Jaelithe, Jelita)', 'Andre Norton', 'cover77958907c1797cfb5.95990741.jpg', '1963-01-01', 'A5', 222, 9780441897087, 'The first in the Witch World fantasy series! Follow the adventures of Ex-colonel Simon Tregarth as he makes the crossing from Earth to the Witch World with the aid of a stone of power, Siege Perilous.', 1, 1),
(12, 'testBook1', 'testAuthor1', 'cover15568588d797f05c172.29805251.png', '2017-01-28', 'A5', 512, 1234567890124, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrresume100', 1, 1),
(21, 'bkkrkrrkkkkkkkkkkkkkkkkkkrkrkrrrrrrrkkkk', 'auth', 'cover472588de628a80251.36286883.png', '2017-01-29', 'A4', 256, 1234567898741, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 1, 1),
(22, 'ttl', 'auth', 'cover26980588de6d51346f8.83256346.jpg', '2017-01-29', 'A5', 512, 1236547896321, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrreeeeeeeeeeeeeeeeeeeeeeeeeesssssssssssssssssssssssssssssmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmeeeeeeeeeeeeeeeeeeeeeeeeeee', 1, 1),
(24, 'tut', 'kamon', 'cover5326588b6f2c7621b7.75379853.jpg', '1955-12-16', 'A4', 666, 1231231598519, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrresume', 1, 1),
(33, 'book', 'author', 'cover30358588d799a186110.95497674.jpg', '1990-01-19', 'A4', 27365, 1234567890987, 'testrrrrrrrrrrrrrrrrrrrrrrrrrrrreeeeeeeeeeeeeeeeeeeeeeeeesssssssssssssssssssssssssssmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmeeeeeeeeeeeeeeeeeeeeeeeee', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
