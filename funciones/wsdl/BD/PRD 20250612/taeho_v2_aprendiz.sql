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
-- Table structure for table `aprendiz`
--

DROP TABLE IF EXISTS `aprendiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aprendiz` (
  `idAprendiz` int(11) NOT NULL AUTO_INCREMENT,
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
  `alergiaAprendiz` text DEFAULT NULL,
  PRIMARY KEY (`idAprendiz`),
  KEY `creadoPor_idx` (`creadoPor`),
  CONSTRAINT `creadoPor` FOREIGN KEY (`creadoPor`) REFERENCES `usuario` (`loginUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aprendiz`
--

LOCK TABLES `aprendiz` WRITE;
/*!40000 ALTER TABLE `aprendiz` DISABLE KEYS */;
INSERT INTO `aprendiz` VALUES (1,'Emliano','Santana',NULL,'2014-12-16 00:00:00','-','-',0,'-','Venezuela','Carabobo','w','w','1','jsantana','2024-11-13 00:00:00',''),(14,'Martin','Alonzo',NULL,'2018-11-20 00:00:00','-','-',1,'-','Chile','w','w','w','1','jsantana','2024-06-15 00:00:00',''),(18,'Santiago Andres','Santana Hernandez',NULL,'2009-01-16 00:00:00','Cabimbu','4to',1,'Trigal','Venezuela','Valencia','Ana ','Yuz','1','jsantana','2024-11-05 00:00:00','no'),(19,'Lucas Alejandro','Cayama Rodríguez',NULL,'2015-05-31 00:00:00','República','3er grado',1,'Puerto Cabello','Venezuela','Puerto Cabello','Yusleny López','Deylis Espinoza','1','yuslopez','2024-11-13 00:00:00','N/A'),(20,'Alejandra','Camero Alvarado',NULL,'2015-10-12 00:00:00','UEP Oral e Integral','2° do. grado',1,'Turmero, Edo. Aragua','Venezuela','Turmero','Yusleny López','Mariangel Nieves','1','yuslopez','2024-11-07 00:00:00','Ninguna'),(21,'Alessia Alejandra','Zambrano Castellanos',NULL,'2018-08-20 00:00:00','U. E. San Juan de los Morros','3° nivel',1,'Urb. Las Chimeneas','Venezuela','Valencia','Yusleny López','Deylis Espinoza','1','yuslopez','2024-11-07 00:00:00','Ninguna'),(22,'Ana ','Gutiérrez',NULL,'1990-11-16 00:00:00','NA','NA',0,'Santiago','Chile','Santiago','Yusleny','Migdelys','1','jsantana','2024-11-26 00:00:00','Gluten'),(23,'Maximiliano','Rodríguez',NULL,'2010-10-22 00:00:00','Las Condes','8vo grado',1,'Las Condes','Chile','Santiago de Chile','Mayluc','Dayana','1','AnaG','2024-12-13 00:00:00','N/A'),(24,'Sophia Valentina','Lorenzo Sánchez',NULL,'2018-06-01 00:00:00','Escuela Benjamín vicuña Mackenna','1er básico',1,'Las Violetas 2245, Departamento 604 Providenc','Chile','Santiago de Chile','Josselin Sánchez','María Mercedes','1','AnaG','2024-12-20 00:00:00','Piel atópica / Asmática '),(25,'Martín ','Velázquez',NULL,'2018-12-15 00:00:00','xxxx','xxxx',0,'Chicureo','Chile','Santiago','Josselin Sánchez','Indiana Vicuña','1','MariaMercedes','2024-12-20 00:00:00','Asmático');
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

-- Dump completed on 2025-06-12  8:50:07
