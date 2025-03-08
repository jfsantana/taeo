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
-- Table structure for table `objetivo_header`
--

DROP TABLE IF EXISTS `objetivo_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetivo_header` (
  `idObjetivoHeader` int(11) NOT NULL AUTO_INCREMENT,
  `nombreObjetivo` varchar(250) DEFAULT NULL,
  `observacionObjetivo` text DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `nivelObjetivo` int(11) DEFAULT NULL,
  `idAreaObjetivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idObjetivoHeader`),
  KEY `idArea_idx` (`idAreaObjetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_header`
--

LOCK TABLES `objetivo_header` WRITE;
/*!40000 ALTER TABLE `objetivo_header` DISABLE KEYS */;
INSERT INTO `objetivo_header` VALUES (27,'FUNCIONES EJECUTIVAS  ','<p>Descripcion del objetivo de Area cognitiva (FUNCIONES EJECTUVOAS )</p>','2024-09-12 00:00:00','jsantana','1',2,1),(28,'MATERNAL (Sala Cuna)','<p>Descipcion de programa de Area cognitiva (01 MATERNAL (Sala Cuna))</p>','2024-09-12 00:00:00','jsantana','1',3,1),(29,'NIVEL -  MEDIO MENOR','<p>descripcion del programa de area cognitiva 02 NIVEL -  MEDIO MENOR</p>','2024-09-12 00:00:00','jsantana','1',4,1),(30,'NIVEL -  MEDIO MAYOR','<p>03 NIVEL -  MEDIO MAYOR<br></p>','2024-09-12 00:00:00','jsantana','1',5,1),(31,'NIVEL- KINDER','<p>04 NIVEL- KINDER<br></p>','2024-09-12 00:00:00','jsantana','1',6,1),(32,'01 BASICO (1er grado)','<p>05 01BASICO (1er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',7,1),(33,'02 BASICO (2er grado)','<p>06 02BASICO (2er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',8,1),(34,'03 BASICO (3er grado)','<p>07 03BASICO (3er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',9,1),(35,'04 BASICO (4er grado)','<p>08 04BASICO (4er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',10,1),(36,'05 BASICO (5er grado)','<p>09 05BASICO (5er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',11,1),(37,'06 BASICO (6er grado)','<p>10 06BASICO (6er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',12,1),(38,'07 BASICO (7mo grado)','<p>11 07BASICO (7mo grado)<br></p>','2024-09-12 00:00:00','jsantana','1',13,1),(39,'08 BASICO (8vo grado)','<p>12 08BASICO (8vo grado)<br></p>','2024-09-12 00:00:00','jsantana','1',14,1),(40,'SIN NOMBRE','BORRAR','2024-11-01 00:00:00','jsantana','1',0,0),(43,'DEMO N0','<p>SDFSDFDS</p>','2024-12-13 00:00:00','jsantana','1',100,66),(44,'prueba','<p>prueba</p>','2024-12-13 00:00:00','jsantana','1',101,66),(45,'NIVEL INICIAL','<p><span id=\"docs-internal-guid-976cb72b-7fff-0beb-7390-1b057cf2e2f5\"><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">CONSIDERACIONES: </span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">en cada sesión se debe procurar la respuesta social del aprendiz, fomentar la iniciación de interacciones espontáneas y ofrecer oportunidades de elección. Asimismo, evitar la rigidez, robotización, alternar entre las distintas habilidades que le puedan generar mayor esfuerzo con las que no, generando un ambiente lúdico que aumente la implicación.</span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"> </span></span><br></p>','2024-12-13 00:00:00','jsantana','1',15,2),(46,'NIVEL INTERMEDIO','<p><span id=\"docs-internal-guid-64402756-7fff-be69-2056-71a4a856865c\"><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">CONSIDERACIONES: </span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">en cada sesión se debe procurar la respuesta social del aprendiz, fomentar la iniciación de interacciones espontáneas y ofrecer oportunidades de elección. Asimismo, evitar la rigidez, robotización, alternar entre las distintas habilidades que le puedan generar mayor esfuerzo con las que no, generando un ambiente lúdico que aumente la implicación.</span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"> </span></span><br></p>','2024-12-20 00:00:00','AnaG','1',16,2),(47,'NIVEL AVANZADO','<p><span id=\"docs-internal-guid-fc8bcd81-7fff-322c-6d31-fd0947749df6\"><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">CONSIDERACIONES: </span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\">en cada sesión se debe procurar la respuesta social del aprendiz, fomentar la iniciación de interacciones espontáneas y ofrecer oportunidades de elección. Asimismo, evitar la rigidez, robotización, alternar entre las distintas habilidades que le puedan generar mayor esfuerzo con las que no, generando un ambiente lúdico que aumente la implicación.</span><span style=\"font-size: 9pt; font-family: Calibri, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;\"> </span></span><br></p>','2024-12-13 00:00:00','jsantana','1',17,2);
/*!40000 ALTER TABLE `objetivo_header` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-08 10:23:21
