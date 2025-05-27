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
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelareaobjetivo`
--

LOCK TABLES `nivelareaobjetivo` WRITE;
/*!40000 ALTER TABLE `nivelareaobjetivo` DISABLE KEYS */;
INSERT INTO `nivelareaobjetivo` VALUES (2,1,'0. FUNCIONES EJECUTIVAS','','1'),(3,1,'0. MATERNAL / MEDIO MENOR','','1'),(4,1,'0.I NIVEL / MEDIO MAYOR','','1'),(5,1,'0.II NIVEL/ PREKINDER','','1'),(6,1,'0.III NIVEL/KINDER',NULL,'1'),(7,1,'1. GRADO/ 1. BÁSICO',NULL,'1'),(8,1,'2. GRADO/ 2. BÁSICO',NULL,'1'),(9,1,'3. GRADO/ 3. BÁSICO',NULL,'1'),(10,1,'4. GRADO/ 4. BÁSICO ',NULL,'1'),(11,1,'5. GRADO/ 5. BÁSICO',NULL,'1'),(12,1,'6. GRADO/ 6. BÁSICO',NULL,'1'),(13,1,'7. GRADO/ 7. BÁSICO',NULL,'1'),(14,1,'8. GRADO/ 8. BÁSICO',NULL,'1'),(15,2,'NIVEL INICIAL',NULL,'1'),(16,2,'NIVEL INTERMEDIO',NULL,'1'),(17,2,'NIVEL AVANZADO',NULL,'1'),(100,66,'Nivel 0','<p>laskdfsda</p>','1'),(101,66,'Nivel 1','<p>lskhdflksdjf;sldf;sledfj</p>','1'),(102,67,'Etapa Presilábica Nivel Inicial','','1'),(103,67,'Etapa Presilábica Niveles Avanzados','','1'),(104,68,'Etapa Presilábica ','<p class=\"MsoNormal\" style=\"margin-right:2.45','1'),(105,68,'Etapa Silábica','<p><b><span lang=\"ES\" style=\"font-size:11.0pt','1'),(106,68,'Etapa Sílabica','','1'),(107,68,'ENTRENAMIENTO COMPLEMENTARIO ','<p class=\"MsoNormal\" style=\"text-align:justif','1'),(108,66,'ENTRENAMIENTO COMPLEMENTARIO','<p><b>PARA POTENCIAR PROCESOS QUE, DE ESTAR A','1'),(109,68,'Etapa Alfabetica','<p>khgjhjhv.kgkjkhjhjhhj</p>','1'),(110,2,'HABILIDADES SOCIALES Y ETAPAS DEL JUEGO','','1'),(111,2,'OPERANTES VERBALES VOCALES','','1'),(112,70,'Habilidades de Reciprocidad','<span id=\"docs-internal-guid-390d8fd7-7fff-49','1'),(113,70,'Emparejamiento Estímulo - Estímulo','<p><b><span lang=\"ES-VE\" style=\"font-size:11.','1'),(114,70,'Igualación a la muestra','','1'),(115,70,'Entrenamiento para desarrollar Ecoicas','<p><span id=\"docs-internal-guid-05dc83ec-7fff','1'),(116,70,'Entrenamiento para desarrollar mandos','<p><span id=\"docs-internal-guid-80b64abe-7fff','1'),(117,70,'Discriminación auditiva','<p>jffffgkkhklh</p>','1');
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

-- Dump completed on 2025-05-27  7:31:55
