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
-- Table structure for table `objetivo_item`
--

DROP TABLE IF EXISTS `objetivo_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetivo_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idHeader` int DEFAULT NULL,
  `jerarquia` varchar(255) DEFAULT NULL,
  `id_padre` int DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `padre_idObjetivo` (`id_padre`),
  KEY `idObjetivoHeader_idx` (`idHeader`),
  CONSTRAINT `idObjetivoHeader` FOREIGN KEY (`idHeader`) REFERENCES `objetivo_header` (`idObjetivoHeader`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_item`
--

LOCK TABLES `objetivo_item` WRITE;
/*!40000 ALTER TABLE `objetivo_item` DISABLE KEYS */;
INSERT INTO `objetivo_item` VALUES (13,1,'0',NULL,'OPERANTES VERBALES VOCALES (se debe registrar únicamente lo que logra en cada sesión) ','1'),(14,1,'0.1',13,'EMPAREJAMIENTO ESTÍMULO-ESTÍMULO (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS) ','1'),(15,1,'0.2',13,'ECOICAS (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS)','1'),(16,1,'0.3',13,'MANDOS (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS)','1'),(17,1,'0.4',13,'TACTOS (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS)','1'),(18,1,'0.5',13,'AUTOCLÍTICOS (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS)','1'),(19,1,'0.6',13,'INTRAVERBALES (APOYAR GENERALIZACIÓN A OTROS CONTEXTOS)','1'),(20,1,'1',NULL,'SEGMENTOS FINOS','1'),(21,1,'1.1',20,'AMASAR (DEBE INCLUIR EL PULGAR EN EL AMASADO)','1'),(22,1,'1.1.1',21,'NIVEL INICIAL (ANTEBRAZO A NIVEL DE LA MESA)','1'),(23,1,'1.1.1.1',22,'Amasar con mano derecha 5 veces','1'),(24,1,'1.1.1.2',22,'Amasar con mano izquierda 5 veces','1'),(25,1,'1.1.1.3',22,'Amasar con mano derecha 8 veces','1'),(26,1,'1.1.1.4',22,'Amasar con mano izquierda 8 veces','1'),(27,1,'1.1.2',21,'NIVEL INTERMEDIO (FLEXIÓN DE CODO)','1'),(28,1,'1.1.2.1',27,'Amasar con mano derecha 10 veces','1'),(29,1,'1.1.2.2',27,'Amasar con mano izquierda 10 veces','1'),(30,1,'1.1.2.3',27,'Amasar con mano derecha 15 veces','1'),(31,1,'1.1.2.4',27,'Amasar con mano izquierda 15 veces','1'),(32,1,'1.1.2.5',27,'Amasar con ambas manos (alternando) 15 veces','1'),(33,1,'1.1.3',21,'NIVEL AVANZADO (FLEXIÓN DE CODO)','1'),(34,1,'1.1.3.1',33,'Amasar con mano derecha 20 veces','1'),(35,1,'1.1.3.2',33,'Amasar con mano izquierda 20 veces','1'),(36,1,'1.1.3.3',33,'Amasar con ambas manos (alternando) 20 veces y al finalizar hacer una pelota','1'),(37,1,'1.1.1.5',22,'esto es una prueba de orden','1'),(38,1,'1.1.4',21,'Nivel Hoja','1'),(39,1,'2',NULL,'Prueba segundo Objetivo','1'),(40,1,'1.2',20,'nivel uno sin hijo','1'),(41,1,'1.1.3.3.1',36,'prueba quinto','1');
/*!40000 ALTER TABLE `objetivo_item` ENABLE KEYS */;
UNLOCK TABLES;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  