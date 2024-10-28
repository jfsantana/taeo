-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: taeho_v2
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `nivelareaobjetivo`
--

DROP TABLE IF EXISTS `nivelareaobjetivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivelareaobjetivo` (
  `idNivelAreaObjetivo` int NOT NULL AUTO_INCREMENT,
  `idAreaObjetivo` int DEFAULT NULL,
  `nombreNivelAreaObjetivo` varchar(45) DEFAULT NULL,
  `descripcionNivelAreaObjetivo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idNivelAreaObjetivo`),
  KEY `idArea_idx` (`idAreaObjetivo`),
  CONSTRAINT `idArea` FOREIGN KEY (`idAreaObjetivo`) REFERENCES `areasobjetivos` (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelareaobjetivo`
--

LOCK TABLES `nivelareaobjetivo` WRITE;
/*!40000 ALTER TABLE `nivelareaobjetivo` DISABLE KEYS */;
INSERT INTO `nivelareaobjetivo` VALUES (2,1,'0. FUNCIONES EJECUTIVAS','','1'),(3,1,'0. MATERNAL / CUNA',NULL,'1'),(4,1,'0.I NIVEL / MEDIO MENOR ',NULL,'1'),(5,1,'0.II NIVEL/ MEDIO MAYOR',NULL,'1'),(6,1,'0.III NIVEL/KINDER',NULL,'1'),(7,1,'1. GRADO/ 1. BÁSICO',NULL,'1'),(8,1,'2. GRADO/ 2. BÁSICO',NULL,'1'),(9,1,'3. GRADO/ 3. BÁSICO',NULL,'1'),(10,1,'4. GRADO/ 4. BÁSICO ',NULL,'1'),(11,1,'5. GRADO/ 5. BÁSICO',NULL,'1'),(12,1,'6. GRADO/ 6. BÁSICO',NULL,'1'),(13,1,'7. GRADO/ 7. BÁSICO',NULL,'1'),(14,1,'8. GRADO/ 8. BÁSICO',NULL,'1'),(15,2,'NIVEL INICIAL',NULL,'1'),(16,2,'NIVEL INTERMEDIO',NULL,'1'),(17,2,'NIVEL AVANZADO',NULL,'1');
/*!40000 ALTER TABLE `nivelareaobjetivo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-28 12:06:06
