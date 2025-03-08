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
-- Table structure for table `sede`
--

DROP TABLE IF EXISTS `sede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sede` (
  `idSede` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSede` varchar(100) DEFAULT NULL,
  `paisSede` varchar(45) DEFAULT NULL,
  `ciudadSede` varchar(45) DEFAULT NULL,
  `direccionSede` varchar(150) DEFAULT NULL,
  `rifSede` varchar(45) DEFAULT NULL,
  `telefonoSede` varchar(45) DEFAULT NULL,
  `emailSede` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSede`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sede`
--

LOCK TABLES `sede` WRITE;
/*!40000 ALTER TABLE `sede` DISABLE KEYS */;
INSERT INTO `sede` VALUES (1,'VE - TAEO PREBO','Venezuela','Carabobo','C.C. PREBO, NIVEL MEZZANINA','13336768','02418995623','123@gmail.com','2025-01-06 00:00:00','1',''),(2,'VE - TAEO MATRIZ','Venezuela','Seleccione','CC Concepto la granja','5498','02415896321','prueba2@gmail.com','2024-11-06 00:00:00','1',''),(3,'CL - TAEO LAS CONDES','Chile','Santiago','Las Condes','852654','02415263254','prueba3@gmail.com','2024-06-07 00:00:00','1',''),(15,'VE - TAEO LA GRANJA','Venezuela','Carabobo','<p>C.C Concepto la Granja</p>','J-40284289-9','04244086461','taeomatriz@gmail.com','2024-06-07 00:00:00','1',NULL);
/*!40000 ALTER TABLE `sede` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-08 10:23:18
