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
-- Table structure for table `nivelareaobjetivo`
--

DROP TABLE IF EXISTS `nivelareaobjetivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivelareaobjetivo` (
  `idNivelAreaObjetivo` int(11) NOT NULL AUTO_INCREMENT,
  `idAreaObjetivo` int(11) DEFAULT NULL,
  `nombreNivelAreaObjetivo` varchar(45) DEFAULT NULL,
  `descripcionNivelAreaObjetivo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idNivelAreaObjetivo`),
  KEY `idArea_idx` (`idAreaObjetivo`),
  CONSTRAINT `idArea` FOREIGN KEY (`idAreaObjetivo`) REFERENCES `areasobjetivos` (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelareaobjetivo`
--

LOCK TABLES `nivelareaobjetivo` WRITE;
/*!40000 ALTER TABLE `nivelareaobjetivo` DISABLE KEYS */;
INSERT INTO `nivelareaobjetivo` VALUES (118,73,'01. OPERANTES VERBALES VOCALES (se debe regis','<p>Emparejamiento Estímulo- Estímulo “los son','1'),(119,73,'02. SEGMENTOS FINOS','<p>Centrado en el desarrollo de la fuerza, pr','1'),(120,73,'03. SEGMENTOS GRUESOS','<p>Abarca principalmente brazos, antebrazos y','1'),(121,73,'04. HABILIDADES DESARROLLADAS EN EL CUADERNO','<p>Este apartado incluye tareas como recorte,','1'),(122,73,'05. AUTONOMÍA','<p>Ejecutar acciones </p>','1'),(123,73,'06. HABILIDADES SOCIALES','<p>Para fomentar etapas evolutivas del juego ','1'),(124,74,'00. PRIMERA INFANCIA','<p>Abarca desde el año 0&nbsp;</p>','1'),(125,74,'01. PRIMERA INFANCIA','<p>Abarca el años 1</p>','1'),(126,75,'01. HABILIDADES DE RECIPROCIDAD','<p>Implica un intercambio satisfactorio en do','1');
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

-- Dump completed on 2025-06-12  8:50:09
