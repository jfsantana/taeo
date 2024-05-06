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
-- Table structure for table `usuario_token`
--

DROP TABLE IF EXISTS `usuario_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_token` (
  `idusuaio_token` int NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `sede` int DEFAULT NULL,
  PRIMARY KEY (`idusuaio_token`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_token`
--

LOCK TABLES `usuario_token` WRITE;
/*!40000 ALTER TABLE `usuario_token` DISABLE KEYS */;
INSERT INTO `usuario_token` VALUES (46,'admin','527b0bdfdb0096a328ced4ecc53685d4','1','2024-05-06 00:29:00',1),(47,'admin','16b2de2640f347ee223169b80e2ff70b','1','2024-05-06 00:29:00',1),(44,'admin','2e221cae7a461556232314ee13d3ac0e','1','2024-05-06 00:26:00',3),(45,'admin','016e127e47e860c780eeb7f92d8f404e','1','2024-05-06 00:29:00',1),(42,'jsantana','ad676f94a96b5e047ad50f815564dae6','1','2024-05-06 00:25:00',1),(43,'jsantana','314222371c4abaf4fed50a50899503ba','1','2024-05-06 00:26:00',1),(72,'admin','977708813cb54cf3137360ba0ea22589','1','2024-05-06 21:18:00',1),(41,'jsantana','4d2dbd81b1eeeadcecdee6458c535c0f','1','2024-05-06 00:24:00',1),(40,'admin','da514e6e9204c7d68861622eb2ba3ad9','1','2024-05-06 00:24:00',1),(39,'coordinador','dde9d4ab44327df9f49e6b9708117580','1','2024-05-06 00:24:00',1),(38,'zxcvb','d2a30bff1dbc55f17eb526ebbe8584de','1','2024-05-06 00:23:00',1),(37,'zxcvb','d554476c89db8c1188d14c7b138c2175','1','2024-05-06 00:23:00',1),(36,'jsantana','5bbc4b1e892253b9dc1a65fe1a0d65a9','1','2024-05-06 00:23:00',1),(35,'jsantana','247f947ed6445c2ea03162e08961435e','1','2024-05-05 22:18:00',1),(71,'jsantana','ab73771ec85295b40abd36e05cb62349','1','2024-05-06 20:47:00',1),(48,'admin','ffb421e1dc471026b3663d28d80f6fcd','1','2024-05-06 00:30:00',1),(49,'admin','fe11a9f7e5e3f5a6f0a315c4aac5625d','1','2024-05-06 00:30:00',1),(50,'admin','feebcbec88e9fe64848580ad671953df','1','2024-05-06 00:31:00',1),(51,'admin','519c240d169936ebf04aecb497162d2c','1','2024-05-06 00:31:00',1),(52,'admin','7b1fbf4b6c9ef2debb4b96ab23828b0e','1','2024-05-06 00:31:00',1),(53,'admin','d548bb1138dda586c1ad2c406172547e','1','2024-05-06 00:32:00',1),(54,'admin','9ca73f2246263d67530921df0927c7a5','1','2024-05-06 00:32:00',1),(55,'admin','5cf3ff3daf344ced06466e81b631e2c1','1','2024-05-06 00:32:00',1),(56,'admin','45098002f3ee0983260a209d543d646a','1','2024-05-06 00:33:00',1),(57,'admin','173422052b526dfeaf1ac15d1a3f23d7','1','2024-05-06 00:33:00',1),(58,'admin','06f84261a4e7b040ba02be4853853018','1','2024-05-06 00:33:00',1),(59,'admin','e2230ff408c94ebda5acf8a65fca21c2','1','2024-05-06 00:36:00',1),(60,'admin','084a5cb7a388490e035943072fba9dd4','1','2024-05-06 00:36:00',1),(61,'admin','f27b6734739797ba1fc27e5a781f71a8','1','2024-05-06 00:36:00',1),(62,'admin','3d9c94caf82a67b252fb619d30e2f6ff','1','2024-05-06 00:36:00',3),(63,'admin','033d408076314c5b0beb896ec74e6a5d','1','2024-05-06 00:41:00',2),(64,'admin','e257b362a870d5dd884e72e0074d9505','1','2024-05-06 00:41:00',1),(65,'admin','b8e373717eefd5b4bf4bc0b6a3ff908f','1','2024-05-06 00:42:00',1),(66,'admin','6249590a25dda0c0214f296f0b5cc888','1','2024-05-06 00:42:00',1),(67,'admin','09b144cf44e3e3134bfc05f696e97dda','1','2024-05-06 00:42:00',1),(68,'admin','1d8c81fb9431e1ee90fa00983f483330','1','2024-05-06 00:43:00',3),(69,'jsantana','901a1f0dd14214aa8448660d04cf3498','1','2024-05-06 00:43:00',1),(70,'jsantana','e5c8c092aabfab38c840b5f4a7955b3a','1','2024-05-06 00:44:00',1);
/*!40000 ALTER TABLE `usuario_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-06 17:39:47
