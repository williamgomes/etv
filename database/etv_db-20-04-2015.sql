-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 12:01 AM
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
  PRIMARY KEY (`character_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE IF NOT EXISTS `episodes` (
  `episode_id` int(13) NOT NULL,
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
  `original_data_supersede` enum('active','inactive') NOT NULL,
  `episode_essential_count_total` double DEFAULT NULL,
  `episode_not_essential_count_total` double DEFAULT NULL,
  `episode_status` enum('active','inactive') NOT NULL,
  `episode_create_by` int(13) DEFAULT NULL,
  `episode_created_on` datetime DEFAULT NULL,
  `episode_updated_by` int(13) DEFAULT NULL,
  `episode_updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`episode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`ER_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ER = Episode Ratings' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_content` text NOT NULL COMMENT 'content can be anything. it can be a link, it can be comma separated values of multiple images or it can be an html layout',
  `post_type` enum('text','link','video','photo') NOT NULL,
  `post_show_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_episode_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_character_ids` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_tags` text NOT NULL COMMENT 'serilized array of multiple IDs will be stored in here',
  `post_status` enum('active','inactive') NOT NULL,
  `post_created_on` datetime NOT NULL,
  `post_created_by` int(11) NOT NULL,
  `post_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`quote_id`)
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
  PRIMARY KEY (`quote_feedback_id`)
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
  PRIMARY KEY (`reaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE IF NOT EXISTS `seasons` (
  `season_id` int(11) NOT NULL AUTO_INCREMENT,
  `season_tms_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `season_api_id` int(11) NOT NULL,
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
  PRIMARY KEY (`season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `show_banner_image` int(11) NOT NULL,
  `show_status` enum('active','inactive') NOT NULL,
  `show_original_data_supersede` enum('active','inactive') NOT NULL,
  `show_auto_data_refresh` enum('active','inactive') NOT NULL,
  `shows_created_on` datetime NOT NULL,
  `shows_created_by` int(11) NOT NULL,
  `shows_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `shows_updated_by` int(11) NOT NULL,
  PRIMARY KEY (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`spoiler_id`)
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
  PRIMARY KEY (`spoiler_feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
