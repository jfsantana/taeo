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
-- Table structure for table `planificacion_evaluacion`
--

DROP TABLE IF EXISTS `planificacion_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planificacion_evaluacion` (
  `idEvaluacion` int NOT NULL AUTO_INCREMENT,
  `idItems` int DEFAULT NULL,
  `tipo` varchar(45) DEFAULT 'Puede ser Inicial o Planificada',
  `idValorEvaluacion` varchar(30) DEFAULT NULL,
  `observacionEvaluacion` text,
  `evaluadoPor` varchar(45) DEFAULT NULL,
  `fechaEvaluacion` date DEFAULT NULL,
  `aprobadoPor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEvaluacion`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_evaluacion`
--

LOCK TABLES `planificacion_evaluacion` WRITE;
/*!40000 ALTER TABLE `planificacion_evaluacion` DISABLE KEYS */;
INSERT INTO `planificacion_evaluacion` VALUES (1,316,'Inicial','AT','creado manual','jsantana','2024-10-28','admin'),(2,316,'Planificada','AP','creado manualmente.','facilitadorEjemplo','2024-10-30',''),(21,336,'Planificada','AP','<p>dfgsdfgsdfg</p>','facilitadorEjemplo','2024-10-30',''),(22,336,'Planificada','AP','<p>sdfgsdfgsdfgsdfgsdrfg</p>','facilitadorEjemplo','2024-10-30',''),(23,336,'Planificada','AP','<p>gsdfgsdfghsdfgh</p>','facilitadorEjemplo','2024-10-30',''),(19,317,'Inicial','AT','update  ','facilitadorEjemplo','2024-10-30',''),(24,336,'Planificada','SA','<p>dtfgdfgdfgdf</p>','facilitadorEjemplo','2024-10-30',''),(20,336,'Inicial','AT','<p>xczxcvzcvzxcv</p><p>zxcv</p><ul><li>zxcv</li><li>zxc</li><li>vzx</li></ul><p>cv</p><p>zxcv</p>','facilitadorEjemplo','2024-10-30',''),(25,316,'Planificada','SA','<p>aasdasdadasdasdasd</p>','jsantana','2024-10-30','');
/*!40000 ALTER TABLE `planificacion_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-04 15:13:43
