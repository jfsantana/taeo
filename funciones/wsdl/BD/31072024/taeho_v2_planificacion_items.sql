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
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_items`
--

LOCK TABLES `planificacion_items` WRITE;
/*!40000 ALTER TABLE `planificacion_items` DISABLE KEYS */;
INSERT INTO `planificacion_items` VALUES (150,7,'14','01','','SEGMENTOS FINOS','auto','2024-07-31','jsantana'),(151,7,'14','01.01','','AMASAR (DEBE INCLUIR EL PULGAR EN EL AMASADO)','auto','2024-07-31','jsantana'),(152,7,'14','01.01.01','','NIVEL INICIAL (ANTEBRAZO A NIVEL DE LA MESA)','auto','2024-07-31','jsantana'),(153,7,'14','01.01.01.01','','Amasar con mano derecha 05 veces','auto','2024-07-31','jsantana'),(154,7,'14','01.01.01.02','','Amasar con mano izquierda 05 veces','auto','2024-07-31','jsantana'),(155,7,'14','01.01.01.03','','Amasar con mano derecha 08 veces','auto','2024-07-31','jsantana'),(156,7,'14','01.01.01.04','','Amasar con mano izquierda 08 veces','auto','2024-07-31','jsantana'),(157,7,'14','02','','SEGMENTOS GRUESOS','auto','2024-07-31','jsantana'),(158,7,'14','02.01','','FUERZA Y PRENSIÓN FORTALECIMIENTO DE BRAZOS (','auto','2024-07-31','jsantana'),(159,7,'14','02.01.01','','NIVEL INICIAL','auto','2024-07-31','jsantana'),(160,7,'14','02.01.01.01','','HALAR LIGA GRUESA A NIVEL DE MUSLOS 05 VECES ','auto','2024-07-31','jsantana'),(161,7,'14','02.01.01.02','','HALAR LIGA GRUESA A NIVEL DEL OMBLIGO 05 VECE','auto','2024-07-31','jsantana'),(162,7,'14','02.01.01.03','','HALAR LIGA GRUESA A NIVEL DE HOMBROS 05 VECES','auto','2024-07-31','jsantana'),(163,7,'14','02.01.01.04','','HALAR DETRÁS DE LA CABEZA 05 VECES (brazos en','auto','2024-07-31','jsantana'),(164,7,'14','02.01.01.05','','HALAR ATRÁS A NIVEL DE GLÚTEOS 05 VECES (braz','auto','2024-07-31','jsantana'),(165,7,'14','02.01.01.06','','HALAR ENFRENTE DE CUERPO  05 VECES (brazo en ','auto','2024-07-31','jsantana'),(166,7,'14','02.01.01.07','','HALAR ENFRENTE DE CUERPO  05 VECES (brazo en ','auto','2024-07-31','jsantana'),(167,7,'14','02.01.01.08','','HALAR EN DIAGONAL 05 VECES (sostener la liga ','auto','2024-07-31','jsantana'),(168,7,'14','02.01.01.09','','HALAR EN DIAGONAL 05 VECES (sostener la liga ','auto','2024-07-31','jsantana'),(169,7,'14','02.01.01.10','','PISAR CON AMBOS PIES Y HALAR HACIA ARRIBA 05 ','auto','2024-07-31','jsantana'),(170,7,'14','01.02','','FUERZA Y PRENSIÓN CON PELOTA (DEBE INCLUIR EL','auto','2024-07-31','jsantana'),(171,7,'14','01.02.02','','NIVEL INTERMEDIO (FLEXIÓN DE CODO)','auto','2024-07-31','jsantana'),(172,7,'14','01.02.02.01','','Fuerza y prensión mano derecha 10 veces','auto','2024-07-31','jsantana'),(173,7,'14','01.02.02.02','','Fuerza y prensión mano izquierda 10 veces','auto','2024-07-31','jsantana'),(174,7,'14','01.02.02.03','','Fuerza y prensión mano derecha 15 veces','auto','2024-07-31','jsantana'),(175,7,'14','01.02.02.04','','Fuerza y prensión mano izquierda 15 veces','auto','2024-07-31','jsantana'),(176,7,'14','03','','HABILIDADES DESARROLLADAS EN EL CUADERNO','auto','2024-07-31','jsantana'),(177,7,'14','03.01','','PERFORAR','auto','2024-07-31','jsantana'),(178,7,'14','03.01.01','','NIVEL INICIAL','auto','2024-07-31','jsantana'),(179,7,'14','03.01.01.01','','Libremente sobre hoja','auto','2024-07-31','jsantana'),(180,7,'14','03.01.01.02','','Líneas rectas gruesas','auto','2024-07-31','jsantana'),(181,7,'14','03.01.01.03','','Líneas rectas medianas','auto','2024-07-31','jsantana'),(182,7,'14','03.01.01.04','','Líneas rectas delgadas','auto','2024-07-31','jsantana'),(183,7,'14','04','','AUTONOMÍA ','auto','2024-07-31','jsantana'),(184,7,'14','04.01','','NIVEL INICIAL','auto','2024-07-31','jsantana'),(185,7,'14','04.01.01','','Desabotonar','auto','2024-07-31','jsantana'),(186,7,'14','04.01.02','','Desabrochar','auto','2024-07-31','jsantana'),(187,7,'14','04.01.03','','Bajar cierre','auto','2024-07-31','jsantana'),(188,7,'14','04.01.04','','Quitar medias','auto','2024-07-31','jsantana'),(189,7,'14','04.01.05','','Quitar zapatos','auto','2024-07-31','jsantana'),(190,7,'14','04.01.06','','Desenrosca','auto','2024-07-31','jsantana');
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

-- Dump completed on 2024-07-31 21:48:07
