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
-- Table structure for table `planificacion_items`
--

DROP TABLE IF EXISTS `planificacion_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planificacion_items` (
  `idItems` int NOT NULL AUTO_INCREMENT,
  `idPlanificacionHeader` int DEFAULT NULL,
  `idNivel` varchar(45) DEFAULT NULL,
  `jerarquia` varchar(100) DEFAULT NULL,
  `idPadre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL COMMENT 'es para saber si es una actividad personalizada o es una actividad cargada desde los objetivos',
  `fechaCreacion` date DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idItems`),
  KEY `idPlanificacionHeader_idx` (`idPlanificacionHeader`),
  CONSTRAINT `idPlanificacionHeader` FOREIGN KEY (`idPlanificacionHeader`) REFERENCES `planificacion_header` (`idPlanificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_items`
--

LOCK TABLES `planificacion_items` WRITE;
/*!40000 ALTER TABLE `planificacion_items` DISABLE KEYS */;
INSERT INTO `planificacion_items` VALUES (208,8,'2','01','','PLANIFICACIÓN (Nota: se seleccionan 2 tareas ','auto','2024-09-12','jsantana'),(209,8,'2','01.17','','ORDENAR NÚMEROS EN ORDEN ASCENDENTE Y DESCEND','auto','2024-09-12','jsantana'),(210,8,'2','01.17.01','','ASCENDENTE','auto','2024-09-12','jsantana'),(211,8,'2','01.17.01.01','','SERIACIONES DEL ____ AL _____','auto','2024-09-12','jsantana'),(212,8,'2','01.17.01.01.01','','De 3 a 5 cifras a ordenar','auto','2024-09-12','jsantana'),(213,8,'2','01.17.01.01.02','','De 6 a 9 cifras a ordenar','auto','2024-09-12','jsantana'),(214,8,'2','01.17.01.01.03','','10 o más cifras a ordenar','auto','2024-09-12','jsantana'),(215,8,'3','01','','CONTENIDOS FIJOS','auto','2024-09-12','jsantana'),(216,8,'3','01.17','','GARABATEO (DIBUJAR LIBREMENTE) E IDENTIFICAR ','auto','2024-09-12','jsantana'),(217,8,'3','01.17.01','','Dibujar libremente','auto','2024-09-12','jsantana'),(218,8,'3','01.17.02','','Identificar oralmente las producciones','auto','2024-09-12','jsantana');
/*!40000 ALTER TABLE `planificacion_items` ENABLE KEYS */;
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
