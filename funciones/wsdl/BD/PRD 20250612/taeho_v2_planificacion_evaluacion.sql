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
-- Table structure for table `planificacion_evaluacion`
--

DROP TABLE IF EXISTS `planificacion_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planificacion_evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idItems` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT 'Puede ser Inicial o Planificada',
  `idValorEvaluacion` varchar(30) DEFAULT NULL,
  `observacionEvaluacion` text DEFAULT NULL,
  `evaluadoPor` varchar(45) DEFAULT NULL,
  `fechaEvaluacion` date DEFAULT NULL,
  `aprobadoPor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEvaluacion`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_evaluacion`
--

LOCK TABLES `planificacion_evaluacion` WRITE;
/*!40000 ALTER TABLE `planificacion_evaluacion` DISABLE KEYS */;
INSERT INTO `planificacion_evaluacion` VALUES (38,447,'Planificada','AP','<p>df;klsdjf ;sdlfkj ;sdlafgj ds;gjk sdfgl;hksdf gl; kdsfjgl;kfdjgl; sdkfjgl;kej5r tl;kjgl;dfkjdl;fkgjsdl;fkgjsdl;fkgdsfklg jsdl;fgk jsdl;fkgj dfldjflkgdsfgsdfg sdfg&nbsp; gsdfgs dfg sdf</p>','jsantana','2025-04-10',''),(37,447,'Seleccione','AT','<p>dia 4</p>','jsantana','2025-04-10',''),(36,447,'Planificada','AP','<p>dia 3</p>','jsantana','2025-04-10',''),(35,583,'Inicial','AP','<p>Solo</p>','AnaG','2024-12-20',''),(34,447,'Planificada','AT','<p>sdas</p>','jsantana','2024-12-13',''),(31,506,'Inicial','AT','','jsantana','2024-12-12',''),(32,507,'Inicial','AP','','jsantana','2024-12-12',''),(33,447,'Inicial','AT','<p>sdfsadfs</p>','jsantana','2024-12-13',''),(30,500,'Inicial','AP','','jsantana','2024-12-12',''),(29,498,'Inicial','AT','','jsantana','2024-12-12',''),(28,454,'Inicial','AP','<p>Balbla&nbsp;</p>','jsantana','2024-11-15','');
/*!40000 ALTER TABLE `planificacion_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:49:56
