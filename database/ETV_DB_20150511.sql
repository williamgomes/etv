-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2015 at 09:15 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `etv`
--
CREATE DATABASE IF NOT EXISTS `etv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `etv`;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE IF NOT EXISTS `characters` (
  `character_id` int(15) NOT NULL,
  `character_tms_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `character_api_id` int(11) NOT NULL,
  `character_show_id` int(13) DEFAULT NULL,
  `character_title` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `character_api_summary` text CHARACTER SET utf8 NOT NULL,
  `character_original_summary` text CHARACTER SET utf8 NOT NULL,
  `character_api_images` text CHARACTER SET utf8 NOT NULL,
  `character_original_images` text CHARACTER SET utf8 NOT NULL,
  `character_banner_image` text CHARACTER SET utf8 NOT NULL,
  `character_alias_one` varchar(100) CHARACTER SET utf8 NOT NULL,
  `character_alias_two` varchar(100) CHARACTER SET utf8 NOT NULL,
  `character_alias_three` varchar(100) CHARACTER SET utf8 NOT NULL,
  `character_alias_four` varchar(100) CHARACTER SET utf32 NOT NULL,
  `character_bio` text CHARACTER SET utf8 NOT NULL,
  `character_actors` text CHARACTER SET utf8 NOT NULL,
  `character_original_data_supersede` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `character_status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `character_created_on` datetime NOT NULL,
  `character_created_by` int(11) NOT NULL,
  `character_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `character_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`character_id`),
  KEY `character_show_id` (`character_show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE IF NOT EXISTS `episodes` (
  `episode_id` int(13) NOT NULL AUTO_INCREMENT,
  `episode_tms_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `episode_api_id` int(11) NOT NULL,
  `episode_show_id` int(13) DEFAULT NULL,
  `episode_season_id` int(11) NOT NULL,
  `episode_number` int(6) DEFAULT NULL,
  `episode_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `episode_original_summary` text CHARACTER SET utf8,
  `episode_api_summary` text CHARACTER SET utf8 NOT NULL,
  `episode_original_images` text CHARACTER SET utf8 NOT NULL,
  `episode_api_images` text CHARACTER SET utf8 NOT NULL,
  `episode_banner_image` text CHARACTER SET utf8 NOT NULL,
  `episode_screening_date` datetime DEFAULT NULL,
  `original_data_supersede` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `episode_essential_count_total` double DEFAULT NULL,
  `episode_not_essential_count_total` double DEFAULT NULL,
  `episode_status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `episode_create_by` int(13) DEFAULT NULL,
  `episode_created_on` datetime DEFAULT NULL,
  `episode_updated_by` int(13) DEFAULT NULL,
  `episode_updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`episode_id`),
  KEY `episode_show_id` (`episode_show_id`),
  KEY `episode_season_id` (`episode_season_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=214 ;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`episode_id`, `episode_tms_id`, `episode_api_id`, `episode_show_id`, `episode_season_id`, `episode_number`, `episode_title`, `episode_original_summary`, `episode_api_summary`, `episode_original_images`, `episode_api_images`, `episode_banner_image`, `episode_screening_date`, `original_data_supersede`, `episode_essential_count_total`, `episode_not_essential_count_total`, `episode_status`, `episode_create_by`, `episode_created_on`, `episode_updated_by`, `episode_updated_on`) VALUES
(53, 'EP013898090001', 8553064, 9, 1, 1, 'Winter Is Coming', '', 'A Night''s Watch deserter is tracked down; Lord Eddard "Ned" Stark learns that his mentor has died; Viserys Targaryen plots to win back the throne; Robert arrives at Winterfell with his family; Ned prepares to leave for King''s Landing.', '', 'assets/p8553063_b_v5_ac.jpg', 'assets/images/episode/large/episode01.jpg', '2011-04-17 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(54, 'EP013898090002', 8553065, 9, 1, 2, 'The Kingsroad', '', 'Bran''s fate remains in doubt; Ned leaves Westeros with his daughters; Jon Snow heads north to join the Night''s Watch; Daenerys tries to learn how to please her new husband.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-04-24 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(55, 'EP013898090003', 8598866, 9, 1, 3, 'Lord Snow', '', 'Ned learns of the Crown''s profligacy; Jon Snow impresses Tyrion; Catelyn follows her husband to King''s Landing; Arya studies swordsmanship.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-05-01 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(56, 'EP013898090004', 8598867, 9, 1, 4, 'Cripples, Bastards and Broken Things', '', 'Ned looks for clues; Robert and his guests witness a tournament; Viserys clashes with Daenerys; Sansa imagines her future as queen.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-05-08 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(57, 'EP013898090005', 8598868, 9, 1, 5, 'The Wolf and the Lion', '', 'Robert orders a preemptive strike on the Targaryens; Tyrion helps Catelyn; Sansa is charmed by Ser Loras Tyrell; Arya overhears a plot against her father.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-05-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(58, 'EP013898090006', 8598869, 9, 1, 6, 'A Golden Crown', '', 'Ned sits for the king; Tyrion confesses and demands a trial by combat; Joffrey apologizes; Viserys receives his final payment.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-05-22 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(59, 'EP013898090007', 8598870, 9, 1, 7, 'You Win or You Die', '', 'Tywin and Jaime prepare for battle; Ned confronts Cersei; Jon takes his Night''s Watch vows; Drogo vows to lead the Dothraki.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-05-29 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(60, 'EP013898090008', 8644163, 9, 1, 8, 'The Pointy End', '', 'The Lannisters press their advantage over the Starks; Robb rallies his father''s allies.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-06-05 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(61, 'EP013898090009', 8644166, 9, 1, 9, 'Baelor', '', 'Ned makes a decision; Robb captures a prized prisoner; Daenerys finds her reign in jeopardy.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-06-12 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(62, 'EP013898090010', 8644169, 9, 1, 10, 'Fire and Blood', '', 'A new king rises in the north; a Khaleesi finds new hope in the season finale.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2011-06-19 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(63, 'EP013898090011', 9020469, 9, 2, 1, 'The North Remembers', '', 'Tyrion arrives in King''s Landing to counsel Joffrey; Stannis Baratheon plots an invasion to claim his late brother''s throne; Daenerys and her three dragons search for allies and water; Bran presides over a threadbare Winterfell.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-04-01 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(64, 'EP013898090012', 9113632, 9, 2, 2, 'The Night Lands', '', 'Tyrion chastens Cersei for alienating the king''s subjects; Arya shares a secret with Gendry; one of Dany''s scouts returns with news; Theon Greyjoy reunites with his father; Davos enlists a pirate to join forces with Stannis and Melisandre.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-04-08 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(65, 'EP013898090013', 9113633, 9, 2, 3, 'What Is Dead May Never Die', '', 'Tyrion plots to gain alliances through the promise of marriage; Catelyn arrives in the Stormlands; Luwin tries to decipher Bran''s dreams.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-04-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:15', 0, '2015-04-30 07:40:15'),
(66, 'EP013898090014', 9113635, 9, 2, 4, 'Garden of Bones', '', 'Joffrey punishes Sansa; Catelyn tries to get Stannis and Renly to unite against the Lannisters; Dany arrives at the gates of Qarth; Arya and Gendry are taken to Harrenhal; Davos must smuggle Melisandre into a secret cove.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-04-22 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(67, 'EP013898090015', 9113637, 9, 2, 5, 'The Ghost of Harrenhal', '', 'The end of the Baratheon rivalry drives Catelyn to flee; Tyrion is alerted to Joffrey''s flawed defense plan; Arya receives a promise; the Night''s Watch arrive at an ancient fortress.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-04-29 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(68, 'EP013898090016', 9165237, 9, 2, 6, 'The Old Gods and the New', '', 'The Lannisters send Myrcella away from harm; Arya has a surprise visitor; Dany makes a vow; Robb and Catelyn receive crucial news; Jon gets a chance to prove himself.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-05-06 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(69, 'EP013898090017', 9165239, 9, 2, 7, 'A Man Without Honor', '', 'Jaime meets a relative; Dany receives an invitation to the House of the Undying; Theon leads a search party; Jon gets lost in the wilderness; Cersei counsels Sansa.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-05-13 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(70, 'EP013898090018', 9165240, 9, 2, 8, 'The Prince of Winterfell', '', 'Theon holds down the fort; Arya calls in a debt; Robb is betrayed; Dany ignores Jorah''s advice; Stannis and Davos approach their destination.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-05-20 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(71, 'EP013898090019', 9165241, 9, 2, 9, 'Blackwater', '', 'Tyrion and the Lannisters fight for their lives as Stannis'' fleet attacks King''s Landing.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-05-27 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(72, 'EP013898090020', 9181981, 9, 2, 10, 'Valar Morghulis', '', 'Theon incites his men to action; Luwin offers advice; Brienne silences Jaime; Arya receives a gift; Dany goes to a strange place; Jon proves himself.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2012-06-03 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(73, 'EP013898090021', 9398360, 9, 3, 1, 'Valar Dohaeris', '', 'Jon is brought before the King Beyond the Wall; Tyrion asks for his reward; Littlefinger offers Sansa a way out; Cersei hosts a dinner for the royal family; Daenerys sails into Slaver''s Bay.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-03-31 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(74, 'EP013898090022', 9785889, 9, 3, 2, 'Dark Wings, Dark Words', '', 'Sansa says too much; Shae asks Tyrion for a favor; Jaime finds a way to pass the time; Arya encounters the Brotherhood Without Banners.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-04-07 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(75, 'EP013898090023', 9785890, 9, 3, 3, 'Walk of Punishment', '', 'Tyrion gains new responsibilities; Jon is taken to the Fist of the First Men; Daenerys meets with the slavers; Jaime strikes a deal with his captors.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-04-14 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(76, 'EP013898090024', 9785891, 9, 3, 4, 'And Now His Watch Is Ended', '', 'The Night''s Watch takes stock; Varys meets his better; Arya is taken to the commander of the Brotherhood; Daenerys makes an exchange.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-04-21 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(77, 'EP013898090025', 9785892, 9, 3, 5, 'Kissed by Fire', '', 'The Hound is judged by the gods; Jaime is judged; Jon proves himself; Robb is betrayed; Tyrion learns the cost of weddings.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-04-28 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(78, 'EP013898090026', 9867108, 9, 3, 6, 'The Climb', '', 'Tywin plans unions for the Lannisters; Melisandre visits the Riverlands; Robb wants to repair his alliance with House Frey; Roose Bolton makes a decision about Jaime Lannister; Jon, Ygritte and the Wildlings face a formidable climb.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-05-05 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(79, 'EP013898090027', 9867113, 9, 3, 7, 'The Bear and the Maiden Fair', '', 'Dany exchanges gifts with a slave lord; Sansa worries about her prospects; Shae is irritated with Tyrion''s new situation; Tywin counsels the king; Melisandre reveals a secret; Brienne faces a formidable foe.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-05-12 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(80, 'EP013898090028', 9867121, 9, 3, 8, 'Second Sons', '', 'A wedding is held at King''s Landing; Tyrion and Sansa spend the night together; Dany meets the Titan''s Bastard; Davos demands proof; Sam and Gilly meet an older gentleman.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-05-19 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(81, 'EP013898090030', 9936074, 9, 3, 9, 'The Rains of Castamere', '', 'Robb presents himself to Walder Frey; Edmure meets his bride; Jon faces a harsh test; Bran discovers a new gift; Daario and Jorah debate; House Frey joins with House Tully.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-06-02 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(82, 'EP013898090031', 9936075, 9, 3, 10, 'Mhysa', '', 'Joffrey challenges Tywin; Bran tells a ghost story; Daenerys waits to see if she is a conqueror or a liberator.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2013-06-09 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(83, 'EP013898090029', 9897372, 9, 4, 1, 'Two Swords', '', 'Tyrion welcomes a guest; Jon Snow is not welcome at Castle Black; Dany is directed to the mother of all slave cities; Arya encounters an old friend.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-04-06 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(84, 'EP013898090032', 10580556, 9, 4, 2, 'The Lion and the Rose', '', 'Tyrion helps Jaime; Joffrey and Margaery host a breakfast; Stannis loses patience with Davos; Ramsey finds a purpose for his pet.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-04-13 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(85, 'EP013898090033', 10580557, 9, 4, 3, 'Breaker of Chains', '', 'Tyrion considers his options; Tywin extends an olive branch; Sam questions the safety of Castle Black; Jon proposes a plan; the Hound teaches Arya; Dany chooses her champion.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-04-20 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(86, 'EP013898090034', 10580558, 9, 4, 4, 'Oathkeeper', '', 'Dany balances justice and mercy; Brienne is tasked with Jaime''s honor; Jon secures volunteers; Bran, Jojen, Meera and Hodor find shelter.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-04-27 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(87, 'EP013898090036', 10648606, 9, 4, 5, 'First of His Name', '', 'Cersei and Tywin plan the Crown''s next move; Dany discusses future plans; Jon Snow begins a new mission.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-05-04 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(88, 'EP013898090037', 10648608, 9, 4, 6, 'The Laws of Gods and Men', '', 'Stannis and Davos set sail; Dany meets with supplicants; Tyrion faces down his father.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-05-11 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(89, 'EP013898090038', 10648611, 9, 4, 7, 'Mockingbird', '', 'Tyrion gains an unlikely ally; Daario asks Dany to allow him to do what he does best; Jon''s warnings about the vulnerability of the Wall are ignored; Brienne follows a new lead.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-05-18 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:16', 0, '2015-04-30 07:40:16'),
(90, 'EP013898090040', 10733253, 9, 4, 8, 'The Mountain and the Viper', '', 'Unexpected visitors arrive in Mole''s Town; Littlefinger''s motives are questioned; Ramsay tries to prove himself to his father; Tyrion''s fate is decided.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-06-01 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(91, 'EP013898090041', 10733254, 9, 4, 9, 'The Watchers on the Wall', '', 'Jon Snow and the Night''s Watch face a big challenge.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-06-08 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(92, 'EP013898090035', 10647687, 9, 4, 10, 'The Children', '', 'Circumstances change after an unexpected arrival from north of the Wall; Dany must face harsh realities; Bran learns more about his destiny; Tyrion sees the truth about his situation.', '', 'assets/p8553063_b_v5_ac.jpg', '/images/uploads/episodes/episode01.jpg', '2014-06-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(93, 'EP013898090042', 11418132, 9, 5, 1, 'The Wars to Come', '', 'Cersei and Jaime adjust to a world without Tywin; Varys reveals a conspiracy to Tyrion; Dany faces a new threat; Jon is caught between two kings.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-04-12 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(94, 'EP013898090043', 11540199, 9, 5, 2, 'The House of Black and White', '', 'Arya arrives in Braavos; Brienne runs into trouble on the road; Cersei fears for her daughter''s safety in Dorne; Ellaria Sand seeks revenge; Stannis tempts Jon.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-04-19 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(95, 'EP013898090044', 11540202, 9, 5, 3, 'High Sparrow', '', 'In King''s Landing, Queen Margaery enjoys her new husband; Tyrion and Varys walk the Long Bridge of Volantis.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-04-26 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(96, 'EP013898090045', 11601870, 9, 5, 4, 'The Sons of the Harpy', '', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-05-03 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(97, 'EP013898090046', 11601874, 9, 5, 5, 'Kill the Boy', '', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-05-10 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(98, 'EP013898090047', 11601877, 9, 5, 6, 'Unbowed, Unbent, Unbroken', '', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-05-17 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(99, 'EP013898090048', 11601879, 9, 5, 7, 'The Gift', '', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', '', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/episodes/episode01.jpg', '2015-05-24 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 13:40:17', 0, '2015-04-30 07:40:17'),
(164, 'EP015693720073', 11726344, 7, 0, 0, 'The Wrong Man', '', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '0000-00-00 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(165, 'EP015693720001', 9263612, 7, 1, 1, 'Pilot', '', 'Five years after a shipwreck left him stranded on a remote island, Oliver Queen is discovered and returned home to those closest to him; Oliver tries to right the wrongs of society and his family by creating a secret vigilante persona known as Arrow.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-10-10 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(166, 'EP015693720002', 9498202, 7, 1, 2, 'Honor Thy Father', '', 'Oliver runs into Laurel at the courthouse and learns she is prosecuting a man associated with his father; the Chinese Triad sends a mercenary to deal with Laurel; Moira and Walter ask Oliver to take over the company.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-10-17 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(167, 'EP015693720003', 9508783, 7, 1, 3, 'Lone Gunmen', '', 'When someone kills one of Oliver''s targets, he searches for the person responsible; Tommy and Laurel are caught in an awkward situation.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-10-24 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(168, 'EP015693720004', 9522844, 7, 1, 4, 'An Innocent Man', '', 'While looking into a suspicious murder case, Oliver realizes that one of his targets framed an innocent man; Walter asks an employee to investigate a large withdrawal that Moira made without his knowledge.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-10-31 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(169, 'EP015693720005', 9536083, 7, 1, 5, 'Damaged', '', 'When Oliver is arrested for murder, he wants no one but Laurel to be his lawyer; during a lie detector test, Detective Lance asks Oliver about his time on the island.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-11-07 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(170, 'EP015693720006', 9547504, 7, 1, 6, 'Legacies', '', 'A gang of bank robbers threatens the city; Diggle encourages Oliver to look past his father''s list and help other people in need.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-11-14 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(171, 'EP015693720008', 9578920, 7, 1, 7, 'Muse of Fire', '', 'Oliver meets a mysterious woman with dangerous secrets; following an unfortunate turn of events, Tommy seeks Laurel''s support.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-11-28 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(172, 'EP015693720009', 9593362, 7, 1, 8, 'Vendetta', '', 'As Oliver trains Helena to be his ally, the two grow closer; Diggle worries that Helena can''t be trusted.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-12-05 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(173, 'EP015693720007', 9576121, 7, 1, 9, 'Year''s End', '', 'When Oliver learns his mother and sister stopped celebrating Christmas after his disappearance, he decides to throw a Christmas party; Tommy asks Laurel to spend Christmas with him.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2012-12-12 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(174, 'EP015693720010', 9667296, 7, 1, 10, 'Burned', '', 'Oliver takes a break from being Arrow; Tommy hosts a benefit for the firefighters; Thea tries to lift Moira''s spirits.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-01-16 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(175, 'EP015693720011', 9681324, 7, 1, 11, 'Trust but Verify', '', 'Diggle and Oliver are at odds when Oliver goes after Diggle''s mentor and commanding officer from Afghanistan; Thea thinks Moira is having an affair.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-01-23 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(176, 'EP015693720012', 9694574, 7, 1, 12, 'Vertigo', '', 'When Thea gets caught using a drug called vertigo, Oliver decides to find the dealer; Laurel defends Thea; Felicity shares disturbing news about Moira.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-01-30 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(177, 'EP015693720013', 9710934, 7, 1, 13, 'Betrayal', '', 'When Cyrus Vanch, an evil criminal, is released from prison, he plans to take down Arrow and resume his position as leader of the underworld; Oliver questions Moira about names in his father''s notebook.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-02-06 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(178, 'EP015693720014', 9724940, 7, 1, 14, 'The Odyssey', '', 'Oliver turns to Felicity for help after he gets shot; Oliver remembers a significant event from the island.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-02-13 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(179, 'EP015693720015', 9740221, 7, 1, 15, 'Dodger', '', 'Oliver asks Detective McKenna on a date; a jewel thief targets someone close to Oliver; Thea''s purse is stolen.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-02-20 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:12', 0, '2015-04-30 11:23:12'),
(180, 'EP015693720016', 9755098, 7, 1, 16, 'Dead to Rights', '', 'Oliver and Diggle learn that Deadshot is alive and targeting Malcom; Tommy refuses to attend a benefit honoring Malcom; Oliver tries to balance his relationship with McKenna and his duties at Arrow.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-02-27 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(181, 'EP015693720018', 9797943, 7, 1, 17, 'The Huntress Returns', '', 'Oliver''s ex, the Huntress, threatens to destroy everything and everyone he cares about; Dinah Lance returns and claims she has proof that Laurel''s sister is still alive; Thea gets Roy a job at Oliver''s nightclub.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-03-20 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(182, 'EP015693720020', 9821094, 7, 1, 18, 'Salvation', '', 'An angry resident of The Glades embarks on a killing and kidnapping spree and announces that the Arrow''s vigilantism was his inspiration; Malcolm asks Moira to find the person responsible for his attempted murder.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-03-27 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(183, 'EP015693720021', 9835172, 7, 1, 19, 'Unfinished Business', '', 'After partying and taking a drug, a woman dies violently; the count escapes from the mental institution; Oliver remembers lessons taught to him by Slade and Shado.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-04-03 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(184, 'EP015693720022', 9900960, 7, 1, 20, 'Home Invasion', '', 'When Deadshot returns to Starling City, Diggle intends to kill him -- with or without Oliver''s help; Laurel''s attempts to protect a young witness increase friction between Oliver and Tommy.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-04-24 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(185, 'EP015693720023', 9911733, 7, 1, 21, 'The Undertaking', '', 'Having a hard time making amends with Diggle and Tommy, Oliver decides to focus his energy on crossing another name off the list; Tommy reveals a shocking truth to Laurel.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-05-01 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(186, 'EP015693720024', 9925251, 7, 1, 22, 'Darkness on the Edge of Town', '', 'Malcolm tries to end his dealings with Dr. Brion Markov and his team; Moira and Oliver receive a number of unwelcome visitors; Laurel makes a decision.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-05-08 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(187, 'EP015693720019', 9807387, 7, 1, 23, 'Sacrifice', '', 'Oliver and Diggle must stop the Dark Archer from unleashing vengeance on the Glades; as Thea searches for Roy, she accidentally puts herself in the line of fire.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-05-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(188, 'EP015693720025', 10152756, 7, 0, 0, 'Year One', '', 'A recap of the first season includes Oliver''s return to Starling City; a sneak peek of season two.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-10-02 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(189, 'EP015693720017', 9767103, 7, 2, 1, 'City of Heroes', '', 'Felicity and Diggle head to Lian Yu to look for Oliver; Isabel Rochev (Summer Glau) prepares a hostile takeover of Queen Consolidated; Roy tries to fill the Arrow''s absence.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-10-09 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(190, 'EP015693720026', 10246536, 7, 2, 2, 'Identity', '', 'Oliver discovers that thieves are hijacking medicine being sent to Glades Memorial; Roy is arrested after attempting to stop the thieves; Laurel plans to catch the Arrow.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-10-16 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(191, 'EP015693720027', 10263478, 7, 2, 3, 'Broken Dolls', '', 'A criminal once put away by Lance breaks out of prison and returns to his old ways of torturing and killing women; the district attorney seeks the death penalty for Moira.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-10-23 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(192, 'EP015693720028', 10274492, 7, 2, 4, 'Crucible', '', 'Oliver learns that a man is transporting illegal guns into the Glades; Felicity shares stunning information with Oliver; Donner asks Laurel out.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-10-30 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(193, 'EP015693720029', 10293451, 7, 2, 5, 'League of Assassins', '', 'After Oliver and the Canary are attacked by a trained killer at the Queen Mansion, the Canary confesses where she''s from; Moria must choose whether to plead guilty to murder and conspiracy or take her chances in court.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-11-06 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(194, 'EP015693720030', 10305840, 7, 2, 6, 'Keep Your Enemies Closer', '', 'Amanda Waller tells Diggle that Lyla went missing after pursuing a lead on Deadshot in Russia; Moira''s lawyer thinks Thea''s relationship with Roy, a known criminal, is hurting Moira''s case.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-11-13 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(195, 'EP015693720031', 10318517, 7, 2, 7, 'State v. Queen', '', 'A mysterious illness impacts hundreds of people in the city, including Diggle; Oliver realizes The Count (Seth Gabel) has escaped from prison.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-11-20 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(196, 'EP015693720032', 10350879, 7, 2, 8, 'The Scientist', '', 'Central City police scientist Barry Allan investigates a seemingly impossible robbery; Sin turns to Roy for help when a friend goes missing.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-12-04 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(197, 'EP015693720033', 10366371, 7, 2, 9, 'Three Ghosts', '', 'Oliver is drugged and left for dead after a fight with Cyrus Gold; Felicity and Barry grow closer; Brother Blood captures Roy.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2013-12-11 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(198, 'EP015693720034', 10427757, 7, 2, 10, 'Blast Radius', '', 'Arrow tries to stop a man from setting off a bomb at a rally but gets trapped in the process; Thea witnesses Roy''s superstrength and demands answers.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-01-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(199, 'EP015693720035', 10454708, 7, 2, 11, 'Blind Spot', '', 'Oliver feels conflicted when Laurel asks the Arrow for help investigating Sebastian Blood; Sin wants Roy to test his new super-strength.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-01-22 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(200, 'EP015693720036', 10469747, 7, 2, 12, 'Tremors', '', 'Arrow offers to train Roy, but Roy refuses unless Arrow reveals his true identity; Malcolm''s earthquake machine is stolen by the Bronze Tiger; Laurel spins out of control after she is disbarred.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-01-29 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:13', 0, '2015-04-30 11:23:13'),
(201, 'EP015693720038', 10537034, 7, 2, 14, 'Time of Death', '', 'Felicity feels left out when Oliver makes Sara a part of the team; a brilliant thief known as The Clock King arms himself with technology that can open bank vaults; Laurel refuses to attend a party for Sara.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-02-26 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(202, 'EP015693720039', 10554135, 7, 2, 15, 'The Promise', '', 'Oliver is stunned when he discovers that Slade is in Starling City; back on the island, Sara and Oliver form a plan to deal with Slade''s growing Mirakuru-induced rage.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-03-05 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(203, 'EP015693720042', 10593346, 7, 2, 16, 'Suicide Squad', '', 'Oliver prepares for battle with his former friend Slade; Amanda recruits Diggle to stop a warlord, but he is surprised when he meets the rest of the team she has assembled.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-03-19 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(204, 'EP015693720044', 10614480, 7, 2, 17, 'Birds of Prey', '', 'Oliver expects the Huntress (Jessica De Gouw) to return once her father (Jeffrey Nordling) is arrested; Laurel is involved in a hostage situation at the courthouse; Roy tries to keep Thea safe.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-03-26 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(205, 'EP015693720045', 10632666, 7, 2, 18, 'Deathstroke', '', 'The repercussions are massive when Slade makes a move against Oliver; a key player in Oliver''s team starts to question his decisions.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-04-02 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(206, 'EP015693720046', 10670328, 7, 2, 19, 'The Man Under the Hood', '', 'An epic battle ensues when the team find Slade waiting for them in the lair; Thea reaches her breaking point; Laurel struggles with a secret.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-04-16 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(207, 'EP015693720047', 10686817, 7, 2, 20, 'Seeing Red', '', 'When the mirakuru sends Roy into a blind rage, Oliver must find a way to stop him; Thea tries to lure Roy in by going on camera at Moira''s campaign.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-04-23 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(208, 'EP015693720048', 10699091, 7, 2, 21, 'City of Blood', '', 'Diggle and Felicity go to extremes to keep Oliver from surrendering to Slade; Thea thinks about leaving town; Laurel goes after Sebastian Blood again.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-04-30 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(209, 'EP015693720049', 10718077, 7, 2, 22, 'Streets of Fire', '', 'As Slade''s soldiers target the city, Oliver rallies his team; Felicity receives game-changing news from S.T.A.R. Labs; Thea and her father come face to face.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-05-07 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(210, 'EP015693720041', 10592601, 7, 2, 23, 'Unthinkable', '', 'Oliver is forced to reconsider what he is willing to do to stop Slade from killing someone else close to him; Diggle goes after Amanda.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-05-14 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(211, 'EP015693720037', 10480157, 7, 2, 13, 'Heir to the Demon', '', 'Lance and Oliver try to talk Sara into reuniting with Laurel, who continues to unravel; Dinah is kidnapped.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-07-10 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(212, 'EP015693720040', 10558249, 7, 3, 1, 'The Calm', '', 'With crime at an all-time low, Oliver lets his guard down and is taken by surprise by a new villain; Oliver and Roy take on the Count; Diggle becomes a father; Lance gets a promotion; Laurel joins the inner circle.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-10-08 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14'),
(213, 'EP015693720051', 11112879, 7, 3, 2, 'Sara', '', 'Another archer comes to town and targets businessmen; Roy is forced to tell Oliver why Thea left town; Laurel considers sharing a secret with Lance.', '', 'assets/p9263605_b_v5_ab.jpg', 'assets/images/episode/large/episode01.jpg', '2014-10-15 00:00:00', 'inactive', 0, 0, 'inactive', 0, '2015-04-30 17:23:14', 0, '2015-04-30 11:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `episode_ratings`
--

CREATE TABLE IF NOT EXISTS `episode_ratings` (
  `ER_id` int(11) NOT NULL AUTO_INCREMENT,
  `ER_show_id` int(11) NOT NULL,
  `ER_episode_id` int(11) NOT NULL,
  `ER_user_id` int(11) NOT NULL,
  `ER_rating_value` enum('yes','no') NOT NULL,
  `ER_created_on` datetime NOT NULL,
  `ER_created_by` int(11) NOT NULL,
  `ER_updated_on` timestamp NULL DEFAULT NULL,
  `ER_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ER_id`),
  KEY `ER_show_id` (`ER_show_id`),
  KEY `ER_episode_id` (`ER_episode_id`),
  KEY `ER_user_id` (`ER_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ER = Episode Ratings' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `episode_ratings`
--

INSERT INTO `episode_ratings` (`ER_id`, `ER_show_id`, `ER_episode_id`, `ER_user_id`, `ER_rating_value`, `ER_created_on`, `ER_created_by`, `ER_updated_on`, `ER_updated_by`) VALUES
(1, 7, 164, 1, 'yes', '2015-05-06 20:36:59', 1, '2015-05-06 14:36:59', 1),
(2, 7, 164, 1, 'yes', '2015-05-06 20:38:40', 1, '2015-05-06 14:38:40', 1),
(7, 7, 168, 1, 'yes', '2015-05-06 20:58:13', 1, '2015-05-06 14:58:13', 1),
(8, 7, 165, 1, 'yes', '2015-05-07 03:04:49', 1, '2015-05-06 21:04:49', 1),
(9, 7, 167, 1, 'yes', '2015-05-07 03:05:45', 1, '2015-05-06 21:05:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_cover_image` text NOT NULL,
  `post_content` text NOT NULL COMMENT 'content can be anything. it can be a link, it can be comma separated values of multiple images or it can be an html layout',
  `post_about` text NOT NULL,
  `post_type` enum('text','link','video','photo') NOT NULL,
  `post_show_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_episode_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_character_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_tags` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_primary_type` varchar(255) NOT NULL,
  `post_secondary_type` varchar(255) NOT NULL,
  `post_popularity` int(11) NOT NULL,
  `post_status` enum('active','inactive') NOT NULL,
  `post_created_on` datetime NOT NULL,
  `post_created_by` int(11) NOT NULL,
  `post_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_created_by` (`post_created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_cover_image`, `post_content`, `post_about`, `post_type`, `post_show_ids`, `post_episode_ids`, `post_character_ids`, `post_tags`, `post_primary_type`, `post_secondary_type`, `post_popularity`, `post_status`, `post_created_on`, `post_created_by`, `post_updated_on`, `post_updated_by`) VALUES
(8, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', '', '', 0, '', '2015-04-30 00:00:00', 1, '2015-05-01 19:56:11', 1),
(10, 'Game Of Thrones Parody', 'images/uploads/shows/got21.jpg', '', 'Robb and Catelyn arrive at the Twins for the wedding. Jon is put to the test to see where his loyalties truly lie. Bran''s group decides to split up. Daenerys plans an invasion of Yunkai.', 'text', '22', '158', '1', 'Arrow', 'Review', 'Screencap', 20, '', '2015-04-30 00:00:00', 1, '2015-05-01 19:56:25', 1),
(11, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', '', '', 15, '', '2015-04-30 00:00:00', 1, '2015-05-01 19:56:25', 1),
(13, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', '', '', 14, '', '2015-04-30 00:00:00', 1, '2015-05-01 19:56:25', 1),
(14, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 'Arrow is Missing Target', 'images/uploads/shows/got21.jpg', '', 'Arrow is Missing Target.Arrow is Missing Target.Arrow is Missing Target.', 'text', '22', '158', '1', 'Arrow', 'Parody', 'News', 10, 'active', '2015-05-01 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `quote_id` int(15) NOT NULL,
  `quote_user_id` int(11) NOT NULL,
  `quote_character_id` int(11) NOT NULL,
  `quote_episode_id` int(11) DEFAULT NULL,
  `quote_text` text,
  `quote_created_on` datetime DEFAULT NULL,
  `quote_created_by` int(11) NOT NULL,
  `quote_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quote_update_by` int(11) NOT NULL,
  `quote_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `quote_user_id` (`quote_user_id`),
  KEY `quote_character_id` (`quote_character_id`),
  KEY `quote_episode_id` (`quote_episode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quote_feedbacks`
--

CREATE TABLE IF NOT EXISTS `quote_feedbacks` (
  `quote_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `quote_feedback_user_id` int(11) NOT NULL,
  `quote_feedback_spoiler_id` int(11) NOT NULL,
  `quote_feedback_feedback` enum('approve','dispute') NOT NULL,
  `quote_feedback_created_on` datetime NOT NULL,
  `quote_feedback_created_by` int(11) NOT NULL,
  `quote_feedback_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quote_feedback_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`quote_feedback_id`),
  KEY `quote_feedback_user_id` (`quote_feedback_user_id`),
  KEY `quote_feedback_spoiler_id` (`quote_feedback_spoiler_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE IF NOT EXISTS `reactions` (
  `reaction_id` int(15) NOT NULL,
  `reaction_episode_id` int(11) DEFAULT NULL,
  `reaction_user_id` int(11) DEFAULT NULL,
  `reaction_parent_id` int(15) DEFAULT NULL,
  `reaction_text` text CHARACTER SET utf8 NOT NULL,
  `reaction_created_on` datetime DEFAULT NULL,
  `reaction_created_by` int(11) NOT NULL,
  `reaction_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reaction_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`reaction_id`),
  KEY `reaction_episode_id` (`reaction_episode_id`),
  KEY `reaction_user_id` (`reaction_user_id`),
  KEY `reaction_parent_id` (`reaction_parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE IF NOT EXISTS `seasons` (
  `season_id` int(11) NOT NULL AUTO_INCREMENT,
  `season_tms_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `season_api_id` int(11) NOT NULL,
  `season_show_id` int(11) NOT NULL,
  `season_episode_total` int(11) NOT NULL,
  `season_title` text CHARACTER SET utf8 NOT NULL,
  `season_original_summary` text CHARACTER SET utf8 NOT NULL,
  `season_api_summary` text CHARACTER SET utf8 NOT NULL,
  `season_original_images` text CHARACTER SET utf8 NOT NULL,
  `season_api_images` text CHARACTER SET utf8 NOT NULL,
  `season_banner_image` text CHARACTER SET utf8 NOT NULL,
  `season_status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `season_original_data_supersede` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `season_created_on` datetime NOT NULL,
  `season_created_by` int(11) NOT NULL,
  `season_updated_on` datetime NOT NULL,
  `season_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`season_id`),
  KEY `season_show_id` (`season_show_id`),
  KEY `season_show_id_2` (`season_show_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`season_id`, `season_tms_id`, `season_api_id`, `season_show_id`, `season_episode_total`, `season_title`, `season_original_summary`, `season_api_summary`, `season_original_images`, `season_api_images`, `season_banner_image`, `season_status`, `season_original_data_supersede`, `season_created_on`, `season_created_by`, `season_updated_on`, `season_updated_by`) VALUES
(1, 'SE013898090000', 18204456, 4, 10, 'Game of Thrones Season 1', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'active', 'inactive', '2015-04-28 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'SE013898090001', 18204457, 4, 13, 'Game of Thrones Season 2', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'active', 'inactive', '2015-04-28 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'SE013898090003', 18204458, 4, 9, 'Game of Thrones Season 3', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'active', 'inactive', '2015-04-28 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'SE013898090003', 18204459, 4, 15, 'Game of Thrones Season 4', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', 'active', 'inactive', '2015-04-29 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE IF NOT EXISTS `shows` (
  `show_id` int(11) NOT NULL AUTO_INCREMENT,
  `show_tms_id` varchar(255) NOT NULL,
  `show_api_id` int(11) NOT NULL,
  `show_season_total` int(11) NOT NULL,
  `show_episode_total` int(11) NOT NULL,
  `show_genres` text NOT NULL,
  `show_theme` text NOT NULL,
  `show_title` text NOT NULL,
  `show_original_summary` text NOT NULL,
  `show_api_summary` text NOT NULL,
  `show_original_images` text NOT NULL,
  `show_api_images` text NOT NULL,
  `show_banner_image` text NOT NULL,
  `show_alias_one` varchar(255) NOT NULL,
  `show_alias_two` varchar(255) NOT NULL,
  `show_status` enum('active','inactive') NOT NULL,
  `show_original_data_supersede` enum('active','inactive') NOT NULL,
  `show_auto_data_refresh` enum('active','inactive') NOT NULL,
  `show_popularity` decimal(8,2) NOT NULL,
  `shows_created_on` datetime NOT NULL,
  `shows_created_by` int(11) NOT NULL,
  `shows_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shows_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`show_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `show_tms_id`, `show_api_id`, `show_season_total`, `show_episode_total`, `show_genres`, `show_theme`, `show_title`, `show_original_summary`, `show_api_summary`, `show_original_images`, `show_api_images`, `show_banner_image`, `show_alias_one`, `show_alias_two`, `show_status`, `show_original_data_supersede`, `show_auto_data_refresh`, `show_popularity`, `shows_created_on`, `shows_created_by`, `shows_updated_on`, `shows_updated_by`) VALUES
(4, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'images/uploads/shows/Bangladesh_Grunge_Flag_by_think0.jpg', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', 'GOT', 'GOT', 'active', 'active', '', '10.50', '2015-04-27 18:12:06', 0, '2015-05-03 13:03:24', 0),
(5, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', '', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '20.00', '2015-04-27 18:14:07', 0, '2015-05-03 13:03:24', 0),
(6, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', '["images\\/uploads\\/shows\\/got21.jpg","images\\/uploads\\/shows\\/got21.jpg","images\\/uploads\\/shows\\/91zikkqy7ol-_sl1500_-arrow-the-complete-second-season-blu-ray-review-jpeg-142123.jpg","images\\/uploads\\/shows\\/episode05.jpg","images\\/uploads\\/shows\\/episode09.jpg"]', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', 'ERTs', 'Game Of Thrones', 'active', 'active', 'active', '30.00', '2015-04-27 18:14:54', 0, '2015-05-06 21:23:41', 0),
(7, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', '', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-27 18:16:02', 0, '2015-05-03 13:03:24', 0),
(8, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', '', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-27 18:37:34', 0, '2015-05-03 13:03:24', 0),
(9, 'SH013898090000', 8553063, 5, 50, 'Fantasy,Drama', 'Noble families in the seven kingdoms of Westeros vie for control of the Iron Throne.', 'Game of Thrones', '', 'George R.R. Martin''s best-selling book series "A Song of Ice and Fire" is brought to the screen as HBO sinks its considerable storytelling teeth into the medieval fantasy epic. It''s the depiction of two powerful families -- kings and queens, knights and renegades, liars and honest men -- playing a deadly game for control of the Seven Kingdoms of Westeros, and to sit atop the Iron Throne. Martin is credited as a co-executive producer and one of the writers for the series, which was filmed in Northern Ireland and Malta.', 'assets/p8553063_b_v5_ad.jpg', 'assets/p8553063_b_v5_ad.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 13:40:07', 0, '2015-05-03 13:03:24', 0),
(10, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:02:00', 0, '2015-05-03 13:03:24', 0),
(11, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '40.00', '2015-04-30 15:07:26', 0, '2015-05-03 13:03:24', 0),
(12, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:08:52', 0, '2015-05-03 13:03:24', 0),
(13, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:10:07', 0, '2015-05-03 13:03:24', 0),
(14, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:13:21', 0, '2015-05-03 13:03:24', 0),
(15, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:14:06', 0, '2015-05-03 13:03:24', 0),
(16, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:16:16', 0, '2015-05-03 13:03:24', 0),
(17, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 15:22:52', 0, '2015-05-03 13:03:24', 0),
(18, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 16:14:57', 0, '2015-05-03 13:03:24', 0),
(19, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 16:24:27', 0, '2015-05-03 13:03:24', 0),
(20, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 16:44:24', 0, '2015-05-03 13:03:24', 0),
(21, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 16:44:49', 0, '2015-05-03 13:03:24', 0),
(22, 'SH015693720000', 9263605, 3, 71, 'Fantasy,Adventure,Action,Drama', 'Changed by a shipwreck, billionaire Oliver Queen becomes Arrow to right the wrongs of his family.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the ways the experience has changed him. As he reconnects with those closest to him, including his sister, Thea, Oliver appears to be the same wealthy, carefree bachelor they''ve always known. At night, flanked by his devoted friend, Diggle, Oliver uses his secret persona -- that of a vigilante -- to right societal wrongs and transform the city to its former glory.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'active', 'active', 'active', '0.00', '2015-04-30 17:22:34', 0, '2015-05-04 12:40:51', 0),
(23, 'SH016880860000', 9223014, 1, 2, 'Drama,Miniseries', '', 'The Arrow', '', 'Highly acclaimed mini-series of how Canada built and destroyed one of the world''s most advanced fighter plane in the 1950s. Starring Dan Aykroyd. Directed by Don Mcbrearty (1997).', 'assets/p9223014_st_v5_aa.jpg', 'assets/p9223014_st_v5_aa.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 17:22:58', 0, '2015-05-03 13:03:24', 0),
(24, 'SH016300950000', 9263605, 3, 69, 'Fantasy,Adventure,Action,Drama', 'A former playboy returns to his hometown and uses his skills to right wrongs as a masked vigilante.', 'Arrow', '', 'When presumed-dead billionaire playboy Oliver Queen returns home to Starling City after five years stranded on a remote island in the Pacific, he hides the changes the experience had on him, while secretly seeking reconciliation with his ex, Laurel. By day he picks up where he left off, playing the carefree philanderer he used to be, but at night he dons the alter ego of Arrow and works to right the wrongs of his family and restore the city to its former glory. Complicating his mission is Laurel''s father, Detective Quentin Lance, who is determined to put the vigilante behind bars.', 'assets/p9263605_b_v5_ab.jpg', 'assets/p9263605_b_v5_ab.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 17:23:01', 0, '2015-05-03 13:03:24', 0),
(25, 'SH020662540000', 11298710, 1, 1, 'Biography,Documentary,Darts,Special', '1979 film following rising darts star Eric Bristow as he travels around pubs and clubs.', 'Arrows', '', 'This film from the archives depicts Eric Bristow between major competitions as he travels around the pubs and working men''s clubs of Britain, challenging the local heroes and playing exhibition matches.', 'assets/p11298710_st_v5_aa.jpg', 'assets/p11298710_st_v5_aa.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 17:23:14', 0, '2015-05-03 13:03:24', 0),
(26, 'SH015608340000', 9223014, 1, 2, 'Drama,Miniseries', 'Cost overruns and government pressure dash plans to build a state-of-the-art fighter jet in Canada.', 'The Arrow', '', 'Cost overruns and governmental pressures dash plans to produce a state-of-the-art fighter jet in Cold War Canada.', 'assets/p9223014_st_v5_aa.jpg', 'assets/p9223014_st_v5_aa.jpg', '/images/uploads/shows/got21.jpg', '', '', 'inactive', 'inactive', 'inactive', '0.00', '2015-04-30 17:23:15', 0, '2015-05-03 13:03:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `spoilers`
--

CREATE TABLE IF NOT EXISTS `spoilers` (
  `spoiler_id` int(15) NOT NULL,
  `spoiler_episode_id` int(11) DEFAULT NULL,
  `spoiler_user_id` int(11) DEFAULT NULL,
  `spoiler_text` text CHARACTER SET utf8 NOT NULL,
  `spoiler_created_on` datetime DEFAULT NULL,
  `spoiler_created_by` int(11) NOT NULL,
  `spoiler_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `spoiler_updated_by` int(11) NOT NULL,
  `spoiler_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`spoiler_id`),
  KEY `spoiler_episode_id` (`spoiler_episode_id`),
  KEY `spoiler_user_id` (`spoiler_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoiler_feedbacks`
--

CREATE TABLE IF NOT EXISTS `spoiler_feedbacks` (
  `spoiler_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `spoiler_feedback_user_id` int(11) NOT NULL,
  `spoiler_feedback_spoiler_id` int(11) NOT NULL,
  `spoiler_feedback_feedback` enum('approve','dispute') NOT NULL,
  `spoiler_feedback_created_on` datetime NOT NULL,
  `spoiler_feedback_created_by` int(11) NOT NULL,
  `spoiler_feedback_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `spoiler_feedback_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`spoiler_feedback_id`),
  KEY `spoiler_feedback_user_id` (`spoiler_feedback_user_id`),
  KEY `spoiler_feedback_spoiler_id` (`spoiler_feedback_spoiler_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagged_appearance`
--

CREATE TABLE IF NOT EXISTS `tagged_appearance` (
  `TA_id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_show_id` int(11) NOT NULL,
  `TA_character_id` int(11) NOT NULL,
  `TA_episode_id` int(11) NOT NULL,
  `TA_apperance_count` int(11) NOT NULL,
  PRIMARY KEY (`TA_id`),
  KEY `TA_character_id` (`TA_character_id`,`TA_episode_id`),
  KEY `TA_episode_id` (`TA_episode_id`),
  KEY `TA_show_id` (`TA_show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='TA = tagged_appearance' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `google_user_id` int(100) NOT NULL,
  `user_hash` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `user_verification` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `user_first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_middle_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_DOB` date NOT NULL COMMENT 'date of birth',
  `user_gender` enum('Male','Female','Not defined') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not defined',
  `user_aboutme` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `user_street_address` text COLLATE utf8_unicode_ci NOT NULL,
  `user_country` int(11) NOT NULL,
  `user_city` int(11) NOT NULL,
  `user_zip` int(10) NOT NULL,
  `user_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `google_user_id`, `user_hash`, `user_status`, `user_verification`, `user_first_name`, `user_middle_name`, `user_last_name`, `user_DOB`, `user_gender`, `user_aboutme`, `user_street_address`, `user_country`, `user_city`, `user_zip`, `user_phone`, `user_last_login`) VALUES
(1, 'matinu@gmail.com', '123456', 123456, 'asdasd asd qw qwe qweqe qwe', 'active', 'yes', 'Matin', 'Ur', 'Rahman', '1986-10-13', 'Male', 'Asd a dasdasd', 'asdasdasd asda sd', 12, 32, 22111, '123331234', '2015-05-06 14:18:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
