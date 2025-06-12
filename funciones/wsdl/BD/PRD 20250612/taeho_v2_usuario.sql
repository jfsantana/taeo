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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(45) DEFAULT NULL,
  `passUsuario` varchar(45) DEFAULT NULL,
  `rolUsuario` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'jsantana','12345',1,'Jesus F','Santana S','3','13336768','jfsantana77@gmail.com','04244380137','04122852923','1','jsantana','2024-10-30 00:00:00','1977-06-08'),(2,'admin','admin',1,'Administrador.','Principal','3','16965218','','','04122852922','1','admin','2024-05-06 00:00:00',NULL),(3,'facilitador','12345',3,'Facilitador','La granja','2','123456','jesus.carabobo@gmail.com','654','654','1','facilitador','2024-10-30 00:00:00','0000-00-00'),(4,'coordinador','12345',2,'CoordinadorLa granja','A','1','125','sdf@gmail.com','852','658','1','yuslopez','2024-11-14 00:00:00','2000-02-02'),(20,'facilitadorEjemplo','12345',3,'usuario ','ejemplo','5','6549846546','jsantana.services@gmail.com','85662','236552','1','jsantana','2024-10-30 00:00:00','0000-00-00'),(21,'yuslopez','12345',2,'Yusleni','López','1','24293920','lopezyusleni@gmail.com','0424-4675844','','1','jsantana','2024-11-06 00:00:00','1994-03-11'),(22,'Deylis','12345',3,'Deylis','Espinoza','4','12431562','pedrodeymar271208@gmail.com','0412 849 73 82','0412 420 40 98','1','yuslopez','2024-11-07 00:00:00','1973-11-17'),(23,'Mariangel','12345',3,'Mariangel','Nieves ','4','12','nievesgrillo29@gmail.com','0424 423 62 34','0','1','yuslopez','2024-11-07 00:00:00','1985-02-05'),(24,'AnaG','TAEO00',1,'Ana Gabriela','Gutiérrez Torres','1','20029502','anagabrielagutierrez1@gmail.com','04147971529','02418786670','1','jsantana','2024-12-13 00:00:00','1990-11-16'),(25,'Mayluc','12345',2,'Mayluc ','Martínez','1','V-11','maylucmartinez@hotmail.com','+56972051878','+56973696465','1','AnaG','2024-12-13 00:00:00','2004-11-20'),(26,'MariaMercedes','12345',1,'María Mercedes','Ávila','3','28054408-6','mmavilasantiago@gmail.com','+56941637994','+56988288796','1','AnaG','2024-12-20 00:00:00','1994-12-29');
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

-- Dump completed on 2025-06-12  8:51:03
