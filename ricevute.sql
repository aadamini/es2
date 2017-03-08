-- MySQL dump 10.13  Distrib 5.5.46, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: ricevute
-- ------------------------------------------------------
-- Server version	5.5.46

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
-- Current Database: `ricevute`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ricevute` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ricevute`;

--
-- Table structure for table `clienti`
--

DROP TABLE IF EXISTS `clienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clienti` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellulare` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clienti`
--

LOCK TABLES `clienti` WRITE;
/*!40000 ALTER TABLE `clienti` DISABLE KEYS */;
INSERT INTO `clienti` VALUES (1,'Adamini','alessio.adamini@villaggio.org','','345562605'),(2,'Pasquali','pasqualienri@yahoo.com','018549563','');
/*!40000 ALTER TABLE `clienti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filtri`
--

DROP TABLE IF EXISTS `filtri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filtri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `fromfil` date DEFAULT NULL,
  `tofil` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filtri`
--

LOCK TABLES `filtri` WRITE;
/*!40000 ALTER TABLE `filtri` DISABLE KEYS */;
INSERT INTO `filtri` VALUES (4,NULL,NULL,NULL);
/*!40000 ALTER TABLE `filtri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ricecli`
--

DROP TABLE IF EXISTS `ricecli`;
/*!50001 DROP VIEW IF EXISTS `ricecli`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricecli` (
  `id` tinyint NOT NULL,
  `dataemissione` tinyint NOT NULL,
  `clienti_id` tinyint NOT NULL,
  `descrizione` tinyint NOT NULL,
  `importo` tinyint NOT NULL,
  `numero` tinyint NOT NULL,
  `clid` tinyint NOT NULL,
  `nome` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `telefono` tinyint NOT NULL,
  `cellulare` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ricevute`
--

DROP TABLE IF EXISTS `ricevute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricevute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dataemissione` date DEFAULT NULL,
  `clienti_id` int(11) unsigned DEFAULT NULL,
  `descrizione` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `importo` int(11) unsigned DEFAULT NULL,
  `numero` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_ricevute_clienti` (`clienti_id`),
  CONSTRAINT `c_fk_ricevute_clienti_id` FOREIGN KEY (`clienti_id`) REFERENCES `clienti` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ricevute`
--

LOCK TABLES `ricevute` WRITE;
/*!40000 ALTER TABLE `ricevute` DISABLE KEYS */;
INSERT INTO `ricevute` VALUES (1,'1970-01-01',1,'3L di latte+',50,234567),(14,'1970-01-01',1,'12 Mazze da Cricket',80,25),(15,'1580-08-30',2,'Uova',100000,666),(17,'2017-03-02',1,'Scarpe da tennis',40,23453);
/*!40000 ALTER TABLE `ricevute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `ricevute`
--

USE `ricevute`;

--
-- Final view structure for view `ricecli`
--

/*!50001 DROP TABLE IF EXISTS `ricecli`*/;
/*!50001 DROP VIEW IF EXISTS `ricecli`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `ricecli` AS select `ricevute`.`id` AS `id`,`ricevute`.`dataemissione` AS `dataemissione`,`ricevute`.`clienti_id` AS `clienti_id`,`ricevute`.`descrizione` AS `descrizione`,`ricevute`.`importo` AS `importo`,`ricevute`.`numero` AS `numero`,`clienti`.`id` AS `clid`,`clienti`.`nome` AS `nome`,`clienti`.`email` AS `email`,`clienti`.`telefono` AS `telefono`,`clienti`.`cellulare` AS `cellulare` from (`ricevute` left join `clienti` on((`ricevute`.`clienti_id` = `clienti`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-08 21:16:55
