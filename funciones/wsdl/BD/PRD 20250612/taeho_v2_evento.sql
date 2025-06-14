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
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEvento` varchar(45) DEFAULT NULL,
  `idSede` varchar(50) DEFAULT NULL,
  `descripcionEvento` text DEFAULT NULL,
  `lugarEvento` varchar(45) DEFAULT NULL,
  `fechaEvento` datetime DEFAULT NULL,
  `envioCorreo` varchar(45) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `organizadoPor` varchar(100) DEFAULT NULL,
  `ponentes` varchar(45) DEFAULT NULL,
  `flayerImg` varchar(255) DEFAULT NULL,
  `flayerName` varchar(60) DEFAULT NULL,
  `flayerTipo` varchar(20) DEFAULT NULL,
  `tipoEvento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (8,'222222222222222222222','1','23123</p>','23123123123</p>','2024-09-11 22:09:00','SI','1900-01-01','1','','1231231231','123123</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 165429.png','Captura de pantalla 2023-03-11 165429.png','image/png','Sede'),(10,'111111','2','<p>11111111</p>','<p>111111</p>','2024-09-02 01:36:00','1','1900-01-01','1','','1111','<p>111</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 163349.png','Captura de pantalla 2023-03-11 163349.png','image/png','Facilitadores'),(11,'333333333333333','1','<p>2222</p>','<p>2222222</p>','2024-09-12 22:12:00','SI','1900-01-01','1','','22','<p>22</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 165355.png','Captura de pantalla 2023-03-11 165355.png','image/png','Administrativo'),(15,'demo1','1','<p>assdasdasdas</p>','<p>demo facilitadores</p>','2024-10-29 08:04:00','SI','1900-01-01','1','','demo','<p>dasdasdasdas</p>','http://taeo/funciones/wsdl/uploads/WhatsApp Image 2024-04-02 at 09.49.43_87c818bd.jpg','WhatsApp Image 2024-04-02 at 09.49.43_87c818bd.jpg','image/jpeg','Facilitadores'),(16,'Evento Demo 1','1','<p>Demo de Evento registrado en el sistema</p>','<p>Direccion de ejemplo</p>','2024-10-31 09:52:00','SI','1900-01-01','1','','Administrador Sistema','<p>Sistemas</p>','http://taeo/funciones/wsdl/uploads/11.png','11.png','image/png','Administrativo'),(18,'Demo de Evento para Facilitadores','2','<p>Descripcion del Sistema</p>','<p>Direccion WEb</p>','2024-10-30 11:17:00','SI','1900-01-01','1','','Facilitador','<p>Sistema</p>','http://taeo/funciones/wsdl/uploads/OMI%20logo.png','OMI%20logo.png','image/png','Facilitadores'),(21,'Demo de Evento MultiSede','2,1,15','<p>Descripcion del evento multiSede</p>','<p>Direccion del Zoom o del google meet para ','2024-10-31 12:00:00','SI','1900-01-01','1','','Sistemas','<ul><li>MultiSede</li><li>Sistemas</li></ul>','http://taeo/funciones/wsdl/uploads/0.png','0.png','image/png','Sede'),(22,'Salida','2','<p>Capacitación</p>','<p>La playa</p>','2024-11-03 15:12:00','SI','1900-01-01','1','','Ana Gutiérrez','<p>Mayluc</p>','','','','Sede'),(23,'Prueba','2','<p>x</p>','<p>x</p>','2024-11-09 09:41:00','SI','1900-01-01','1','','Ana Gutiérrez','<p>x</p>','','','','Facilitadores'),(24,'Conversatorio diciembre','3','<p>Hdhshdjejenejebe</p>','<p>Vestdudiosbdbsbeb</p>','2024-11-30 11:37:00','SI','1900-01-01','1','','Mayluc','<p>Hdhdhdjdbev</p>','','','','Facilitadores'),(25,'TALLER TAEO - HHSS Y COGNICIÓN SOCIAL','3','<p>\"En el que tu hijo aprenderá estrategias para comprender, procesar, responder y retener información NO TAN OBVIA en las interacciones sociales\".<br></p>','<p>Cerro El Plomo 5931, Of. 1514, Las Condes<','2024-12-16 14:00:00','SI','1900-01-01','1','','SEDE TAEO CHILE','TAEO CHILE','https://gestion.organizaciontaeo.com/funciones/wsdl/uploads/TALLER.jpg','TALLER.jpg','image/jpeg','Sede'),(26,'TALLER TAEO - HHSS Y COGNICIÓN SOCIAL','3','<p>dueeuduerfbjrfnjrfnki</p>','','2024-12-24 13:52:00','SI','1900-01-01','1','','SEDE TAEO CHILE','<p>gggt</p>','https://gestion.organizaciontaeo.com/funciones/wsdl/uploads/TALLER.jpg','TALLER.jpg','image/jpeg','Sede'),(27,'III CAFÉ MÉDICO TERAPÉUTICO TAEO','15,2,1','3er. encuentro con especialistas del área del neurodesarrollo','<p>Hotel Executive Suites</p>','2025-05-24 08:34:00','SI','1900-01-01','1','','MAYLUC MARTÍNEZ','<p>Dra. Mayluc Martínez</p>','','','','Sede');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:57
