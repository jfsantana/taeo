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
-- Table structure for table `planificacion_header`
--

DROP TABLE IF EXISTS `planificacion_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planificacion_header` (
  `idPlanificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idArea` int(11) DEFAULT NULL,
  `idSede` int(11) DEFAULT NULL,
  `idFacilitador` int(11) DEFAULT NULL,
  `idAprendiz` int(11) DEFAULT NULL,
  `periodoEvaluacion` varchar(45) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPlanificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_header`
--

LOCK TABLES `planificacion_header` WRITE;
/*!40000 ALTER TABLE `planificacion_header` DISABLE KEYS */;
INSERT INTO `planificacion_header` VALUES (25,1,15,20,18,'4','<p>Este es una prueba de la creacion de una planificaicon para la sede la Granja con Santiago</p>','2024-11-14','jsantana','1'),(26,1,2,23,19,'4','','2024-11-14','yuslopez','1'),(27,1,2,22,20,'4','<p>Prueba</p>','2024-11-19','yuslopez','1'),(28,1,3,20,22,'4','<p>Planificación inferior al nivel por xxxxxx</p>','2024-11-26','jsantana','1'),(29,1,2,23,1,'4','<p>Vvvvvvv</p>','2024-11-26','jsantana','1'),(30,1,1,20,18,'4','','2024-12-12','jsantana','1'),(31,66,2,3,14,'4','<p>DEMO DEMO DEMO DEMO</p>','2024-12-13','jsantana','1'),(32,1,1,20,1,'4','<p>DEMO DEMO</p>','2024-12-13','jsantana','1'),(33,66,1,20,18,'4','<p>SDFSDFS</p>','2024-12-13','jsantana','1'),(34,66,2,3,1,'4','<p>sdsdsds</p>','2024-12-13','jsantana','1'),(35,66,3,20,22,'4','','2024-12-13','jsantana','1'),(36,2,2,23,1,'4','','2024-12-13','jsantana','1'),(37,1,3,20,23,'4','<p>Prueba Ana</p>','2024-12-13','AnaG','1'),(38,2,3,20,24,'4','<p>sjsjddd</p>','2024-12-20','AnaG','1'),(39,1,2,22,18,'4','','2025-04-24','AnaG','1'),(40,70,3,20,22,'4','','2025-05-07','MariaMercedes','1'),(41,2,2,22,18,'4','','2025-05-08','AnaG','1'),(42,2,2,22,19,'4','','2025-05-23','MariaMercedes','1'),(43,2,2,23,21,'4','','2025-05-23','MariaMercedes','1'),(44,2,2,23,24,'4','','2025-05-23','MariaMercedes','1');
/*!40000 ALTER TABLE `planificacion_header` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:44
