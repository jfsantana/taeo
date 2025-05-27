-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 132.148.180.197    Database: taeho_v2
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.21-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `evaluacion_item`
--

DROP TABLE IF EXISTS `evaluacion_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluacion_item` (
  `idItemEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idHeaderEvaluacion` int(11) DEFAULT NULL,
  `edadCronologica` int(11) DEFAULT NULL,
  `idNivelEvaluacion` int(11) DEFAULT NULL,
  `idAreaEvaluacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idItemEvaluacion`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion_item`
--

LOCK TABLES `evaluacion_item` WRITE;
/*!40000 ALTER TABLE `evaluacion_item` DISABLE KEYS */;
INSERT INTO `evaluacion_item` VALUES (1,1,0,1,1),(12,1,0,1,6),(11,1,0,1,5),(10,1,0,1,4),(9,1,0,1,3),(8,1,0,1,2),(13,1,1,1,5),(14,1,2,2,1),(15,1,6,1,2),(16,1,2,1,5),(17,1,5,1,6),(18,1,9,1,7),(19,7,0,1,5),(20,7,0,1,2),(21,7,0,1,7),(22,7,0,1,6),(23,7,1,1,2),(24,1,2,1,1);
/*!40000 ALTER TABLE `evaluacion_item` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-27  7:32:34
