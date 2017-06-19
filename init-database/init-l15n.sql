-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author_bhl`
--

DROP TABLE IF EXISTS `author_bhl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author_bhl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `location` text,
  `dates` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default_author_name` varchar(200) DEFAULT NULL,
  `default_author_forename` varchar(100) DEFAULT NULL,
  `default_author_surname` varchar(100) DEFAULT NULL,
  `standard_form` varchar(50) DEFAULT NULL,
  `name_notes` text,
  `name_source` text,
  `dates` varchar(20) DEFAULT NULL,
  `alternate_abbreviations` varchar(200) DEFAULT NULL,
  `alternative_names` varchar(200) DEFAULT NULL,
  `taxon_groups` varchar(20) DEFAULT NULL,
  `example_of_name_published` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_of_species`
--

DROP TABLE IF EXISTS `list_of_species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_of_species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `family` varchar(30) DEFAULT NULL,
  `hybrid_genus` tinyint(1) DEFAULT '0',
  `genus` varchar(30) DEFAULT NULL,
  `hybrid` tinyint(1) DEFAULT '0',
  `species` varchar(50) DEFAULT NULL,
  `species_author` varchar(50) DEFAULT NULL,
  `infra_species` varchar(50) DEFAULT NULL,
  `rank` varchar(10) DEFAULT NULL,
  `authors` varchar(50) DEFAULT NULL,
  `basionym` varchar(50) DEFAULT NULL,
  `publishing_author` varchar(50) DEFAULT NULL,
  `reference` varchar(200) DEFAULT NULL,
  `publication` varchar(250) DEFAULT NULL,
  `publication_id_ipni` varchar(15) DEFAULT NULL,
  `collation` varchar(20) DEFAULT NULL,
  `publication_year` int(3) DEFAULT NULL,
  `publication_year_note` text,
  `name_status` varchar(200) DEFAULT NULL,
  `volume` varchar(10) DEFAULT NULL,
  `issue` varchar(10) DEFAULT NULL,
  `start_page` varchar(10) DEFAULT NULL,
  `end_page` varchar(10) DEFAULT NULL,
  `original_taxon_name` varchar(250) DEFAULT NULL,
  `original_taxon_name_author_team` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_of_species_authors`
--

DROP TABLE IF EXISTS `list_of_species_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_of_species_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_of_species_id` int(11) NOT NULL,
  `new_author_id` int(11) DEFAULT NULL,
  `inpi_author_id` varchar(10) DEFAULT NULL,
  `author_std_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `localities`
--

DROP TABLE IF EXISTS `localities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `lat_degrees` float DEFAULT NULL,
  `lat_minutes` float DEFAULT NULL,
  `lat_seconds` float DEFAULT NULL,
  `north_or_south` varchar(1) DEFAULT NULL,
  `lon_degrees` float DEFAULT NULL,
  `lon_minutes` float DEFAULT NULL,
  `lon_seconds` float DEFAULT NULL,
  `east_or_west` varchar(1) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(200) DEFAULT NULL,
  `title` text,
  `remarks` text,
  `BPH_number` varchar(20) DEFAULT NULL,
  `ISBN` varchar(25) DEFAULT NULL,
  `ISSN` varchar(14) DEFAULT NULL,
  `authors_role` text,
  `edition` varchar(50) DEFAULT NULL,
  `in_publication_facade` text,
  `date` varchar(20) DEFAULT NULL,
  `LC_number` varchar(50) DEFAULT NULL,
  `place` text,
  `publication_author_team` text,
  `preceded_by` text,
  `TL2_author` varchar(100) DEFAULT NULL,
  `TL2_number` varchar(50) DEFAULT NULL,
  `TDWG_abbreviation` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `record_names`
--

DROP TABLE IF EXISTS `record_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_name_id` int(11) DEFAULT NULL,
  `ipni_name_id` varchar(10) DEFAULT NULL,
  `name_std_form` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` varchar(15) DEFAULT NULL,
  `typification_ref_id` int(11) NOT NULL,
  `herbarium` varchar(250) DEFAULT NULL,
  `herbarium_link` text,
  `locality_id` int(11) DEFAULT NULL,
  `taxon_name_id` int(11) DEFAULT NULL,
  `unit_type` varchar(1) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  `barcode` varchar(15) DEFAULT NULL,
  `url_stable` varchar(200) DEFAULT NULL,
  `url_jstor` varchar(200) DEFAULT NULL,
  `collector` varchar(200) DEFAULT NULL,
  `collection_number` varchar(10) DEFAULT NULL,
  `collection_date1` varchar(10) DEFAULT NULL,
  `collection_date2` varchar(10) DEFAULT NULL,
  `illustration_publication` varchar(200) DEFAULT NULL,
  `page_of_typification` varchar(20) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `project` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registers`
--

DROP TABLE IF EXISTS `registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `inserted` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `typif_ref_authors`
--

DROP TABLE IF EXISTS `typif_ref_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typif_ref_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typif_ref_id` int(11) NOT NULL,
  `local_author_id` int(11) DEFAULT NULL,
  `remote_author_id` varchar(10) DEFAULT NULL,
  `author_std_form` varchar(50) DEFAULT NULL,
  `author_order` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `typification_references`
--

DROP TABLE IF EXISTS `typification_references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typification_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_type` int(2) NOT NULL,
  `title` text,
  `year` int(2) DEFAULT NULL,
  `volume` int(2) DEFAULT NULL,
  `issue` int(2) DEFAULT NULL,
  `start_page` varchar(8) DEFAULT NULL,
  `end_page` varchar(8) DEFAULT NULL,
  `publisher` text,
  `editors` text,
  `publication_id_new` int(11) DEFAULT NULL,
  `publication_id_ipni` varchar(15) DEFAULT NULL,
  `publication_std_form` text,
  `book` text,
  `pdf_link` text,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permission` int(2) NOT NULL DEFAULT '3',
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-19 13:22:09
