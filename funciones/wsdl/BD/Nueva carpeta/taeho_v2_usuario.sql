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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(45) DEFAULT NULL,
  `passUsuario` varchar(45) DEFAULT NULL,
  `rolUsuario` int DEFAULT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `apellidoUsuario` varchar(45) DEFAULT NULL,
  `cargoUsuario` varchar(45) DEFAULT NULL,
  `cedulaUsuario` varchar(45) DEFAULT NULL,
  `emailUsuario` varchar(145) DEFAULT NULL,
  `telefonoUsuario` varchar(45) DEFAULT NULL,
  `TelefonoEmergencia` varchar(45) DEFAULT NULL,
  `activoUsuario` varchar(45) DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `id` (`idUsuario`),
  UNIQUE KEY `user` (`loginUsuario`),
  UNIQUE KEY `emailUsuario_UNIQUE` (`emailUsuario`),
  UNIQUE KEY `cedulaUsuario_UNIQUE` (`cedulaUsuario`),
  KEY `idRol_idx` (`rolUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'jsantana','12345',1,'Jesus F','Santana S','3','13336768','jfsantana77@gmail.com','04244380137','04122852923','1','jsantana','2024-06-07 00:00:00','1977-06-08'),(2,'admin','admin',1,'Administrador.','Principal','3','16965218','','','04122852922','1','admin','2024-05-06 00:00:00',NULL),(3,'facilitador','12345',3,'Facilitador','A','2','123456','asd@gmail.com','654','654','1','jsantana','2024-05-05 00:00:00',NULL),(4,'coordinador','12345',2,'Coordinador','A','3','125','sdf@gmail.com','852','658','1','jsantana','2024-05-05 00:00:00',NULL),(20,'facilitadorEjemplo','12345',3,'usuario ','ejemplo','5','6549846546','asdasdas','85662','236552','1','admin','2024-05-07 00:00:00',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-15  8:52:02
