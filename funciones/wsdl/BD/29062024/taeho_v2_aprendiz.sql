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
-- Table structure for table `aprendiz`
--

DROP TABLE IF EXISTS `aprendiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aprendiz` (
  `idAprendiz` int NOT NULL AUTO_INCREMENT,
  `nombreAprendiz` varchar(45) DEFAULT NULL,
  `apellidoAprendiz` varchar(45) DEFAULT NULL,
  `cedulaAprendiz` varchar(45) DEFAULT NULL,
  `fechaNacimientoAprendiz` datetime DEFAULT NULL,
  `colegioAprendiz` varchar(50) DEFAULT NULL,
  `gradoAprendiz` varchar(45) DEFAULT NULL,
  `escolaridadAprendiz` tinyint(1) DEFAULT NULL,
  `direccionAprendiz` varchar(45) DEFAULT NULL,
  `paisAprendiz` varchar(45) DEFAULT NULL,
  `ciudadAprendiz` varchar(45) DEFAULT NULL,
  `coordinadoraAprendiz` varchar(45) DEFAULT NULL,
  `facilitadoraAprendiz` varchar(45) DEFAULT NULL,
  `activoAprendiz` varchar(45) DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `alergiaAprendiz` text,
  PRIMARY KEY (`idAprendiz`),
  KEY `creadoPor_idx` (`creadoPor`),
  CONSTRAINT `creadoPor` FOREIGN KEY (`creadoPor`) REFERENCES `usuario` (`loginUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprendiz`
--

LOCK TABLES `aprendiz` WRITE;
/*!40000 ALTER TABLE `aprendiz` DISABLE KEYS */;
INSERT INTO `aprendiz` VALUES (1,'Emliano','Santana',NULL,'2014-12-16 00:00:00','-','-',0,'-','Venezuela','Carabobo','w','w','1','jsantana','2024-06-15 00:00:00',''),(14,'Martin','Alonzo',NULL,'2005-11-20 00:00:00','-','-',1,'-','Chile','w','w','w','1','jsantana','2024-06-15 00:00:00','');
/*!40000 ALTER TABLE `aprendiz` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-29 18:22:00
