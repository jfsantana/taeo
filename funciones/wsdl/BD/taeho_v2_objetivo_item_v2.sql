-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: taeho_v2
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `objetivo_item_v2`
--

DROP TABLE IF EXISTS `objetivo_item_v2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetivo_item_v2` (
  `idItems` int NOT NULL AUTO_INCREMENT,
  `idHeader` int DEFAULT NULL,
  `idItemsPadre` int DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `jerarquia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idItems`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_item_v2`
--

LOCK TABLES `objetivo_item_v2` WRITE;
/*!40000 ALTER TABLE `objetivo_item_v2` DISABLE KEYS */;
INSERT INTO `objetivo_item_v2` VALUES (1,1,NULL,'NodoPadre',''),(2,1,1,'OPERANTES VERBALES VOCALES (se debe registrar','0'),(3,1,2,'EMPAREJAMIENTO ESTÍMULO-ESTÍMULO (APOYAR GENE','0.1'),(4,1,2,'ECOICAS (APOYAR GENERALIZACIÓN A OTROS CONTEX','0.2'),(5,1,2,'TACTOS (APOYAR GENERALIZACIÓN A OTROS CONTEXT','0.3'),(6,1,2,'AUTOCLÍTICOS (APOYAR GENERALIZACIÓN A OTROS C','0.4'),(7,1,2,'INTRAVERBALES (APOYAR GENERALIZACIÓN A OTROS ','0.5'),(8,1,2,'MANDOS (APOYAR GENERALIZACIÓN A OTROS CONTEXT','0.6'),(9,1,1,'SEGMENTOS FINOS','1'),(10,1,9,'AMASAR (DEBE INCLUIR EL PULGAR EN EL AMASADO)','1.1'),(11,1,10,'NIVEL INICIAL (ANTEBRAZO A NIVEL DE LA MESA)','1.1.1'),(12,1,11,'Amasar con mano derecha 5 veces','1.1.1.1'),(13,1,11,'Amasar con mano izquierda 5 veces','1.1.1.2'),(14,1,11,'Amasar con mano derecha 8 veces','1.1.1.3'),(15,1,11,'Amasar con mano izquierda 8 veces','1.1.1.4');
/*!40000 ALTER TABLE `objetivo_item_v2` ENABLE KEYS */;
UNLOCK TABLES;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  