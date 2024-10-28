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
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evento` (
  `idEvento` int NOT NULL AUTO_INCREMENT,
  `nombreEvento` varchar(45) DEFAULT NULL,
  `idSede` int DEFAULT NULL,
  `descripcionEvento` text,
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,'Curso Padres',3,'Este es una prueba de un evenrto','Teatro 1','2024-07-15 00:00:00','si','2024-06-18','1','admin','Ana','Leidert',NULL,NULL,NULL,NULL),(2,'Curso para hermanos',1,'demo','Sala 4','2024-10-01 00:00:00','Si','2024-09-27','1','admin','Jesus','Francisco',NULL,NULL,NULL,NULL),(7,'123123',1,'23123</p>','23123123123</p>','0000-00-00 00:00:00','1','1900-01-01','1','','1231231231','123123</p>','','',NULL,NULL),(8,'222222222222222222222',1,'23123</p>','23123123123</p>','2024-09-11 22:09:00','SI','1900-01-01','1','','1231231231','123123</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 165429.png','Captura de pantalla 2023-03-11 165429.png','image/png','Sede'),(10,'111111',2,'<p>11111111</p>','<p>111111</p>','2024-09-02 01:36:00','1','1900-01-01','1','','1111','<p>111</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 163349.png','Captura de pantalla 2023-03-11 163349.png','image/png','Facilitadores'),(11,'333333333333333',1,'<p>2222</p>','<p>2222222</p>','2024-09-12 22:12:00','SI','1900-01-01','1','','22','<p>22</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 165355.png','Captura de pantalla 2023-03-11 165355.png','image/png','Administrativo'),(12,'zzzzzzzzzzzzz',1,'23123</p>','23123123123</p>','2024-09-18 21:50:00','1','1900-01-01','1','','1231231231','123123</p>','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjgffBcZuaVB2DoyH7Z8vI8tJ2sR_s-ySFthFBweR6Dz4T2WZmsVgqm_fjb0caTWqjXME&usqp=CAU','Captura de pantalla 2023-03-11 163330.png','image/png',NULL),(13,'new',1,'sadd</p>','asdasda</p>','1900-01-01 00:00:00','SI','1900-01-01','1','jsantana','wer','asdasd</p>','http://taeo/funciones/wsdl/uploads/Captura de pantalla 2023-03-11 165355.png','Captura de pantalla 2023-03-11 165355.png','image/png',NULL),(14,'Evento de Iniciacion de envio de correos para',15,'<p><b><u>Evento de Iniciacion de envio de correos para eventos&nbsp;</u></b></p><p>Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;Evento de Iniciacion de envio de correos para eventos&nbsp;</p><ul><li>Evento de Iniciacion de envio de correos para eventos</li><li>Evento de Iniciacion de envio de correos para eventos</li><li>Evento de Iniciacion de envio de correos para eventos</li></ul><p><br></p><p><br></p>','<p>Urb El Recreo, Salon de usos multiples</p>','2024-10-02 14:00:00','SI','1900-01-01','1','','Jesus Santana','<p>Los ponentes son :</p><ol><li>Ana Gutierre','https://www.fundacionquerer.org/wp-content/uploads/2019/04/nuevas-tecnologias.jpg','Captura de pantalla 2023-03-11 165855.png','image/png',NULL),(15,'demo',1,'<p>assdasdasdas</p>','<p>demo facilitadores</p>','2024-10-29 08:04:00','SI','1900-01-01','1','','demo','<p>dasdasdasdas</p>','http://taeo/funciones/wsdl/uploads/the-simpsons-beatles-2337-1920x1200.jpg','the-simpsons-beatles-2337-1920x1200.jpg','image/jpeg','Facilitadores');
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

-- Dump completed on 2024-10-28 12:06:06
