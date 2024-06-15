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
-- Table structure for table `objetivo_header`
--

DROP TABLE IF EXISTS `objetivo_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetivo_header` (
  `idObjetivoHeader` int NOT NULL AUTO_INCREMENT,
  `nombreObjetivo` varchar(250) DEFAULT NULL,
  `observacionObjetivo` text,
  `fechaCreacion` datetime DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `nivelObjetivo` int DEFAULT NULL,
  `idAreaObjetivo` int DEFAULT NULL,
  PRIMARY KEY (`idObjetivoHeader`),
  KEY `idArea_idx` (`idAreaObjetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_header`
--

LOCK TABLES `objetivo_header` WRITE;
/*!40000 ALTER TABLE `objetivo_header` DISABLE KEYS */;
INSERT INTO `objetivo_header` VALUES (20,'PROGRAMA DE ACTIVACIÓN COGNITIVA','<p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">El Programa de Activación\r\nCognitiva, consiste en una ejercitación sistemática de los contenidos\r\nacadémicos propios del nivel o grado escolar que cursa el aprendiz, así como de\r\nlas habilidades previas necesarias para alcanzarlos. Por consiguiente, el P-AC\r\ntiene como objetivo desarrollar y fortalecer habilidades prerequisitas para\r\ngarantizar el éxito escolar, al mismo tiempo que ejercitar contenidos\r\npropiamente dichos. En este orden de ideas, el terapeuta en un mínimo de tres\r\nsesiones repetidas basadas en el programa, ha de alcanzar <b>aspectos pre- requisitos</b> tales como:<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\"> </span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">a.- Lograr el control\r\ninstruccional en el aprendiz.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">b.- Cuidar la postura corporal\r\ndurante la ejecución de las actividades.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">c.- Incrementar progresivamente\r\nla comprensión de los enunciados en las actividades propuestas.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">d.- Desvanecer los apoyos para\r\nfortalecer la independencia en la ejecución.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">e.- Lograr hábitos de trabajo\r\nescolar evidenciado por medio de los cuadernos y materiales.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">f.- Establecer planes de\r\nreforzamiento para incrementar el hábito de mantener los materiales de trabajo\r\nescolar excelentemente ordenados, con las actividades completas y los dibujos\r\ndebidamente coloreados. Tal práctica con el fin de conseguir la generalización\r\nal aula /en la sala de los aspectos logrados en terapia. Por tanto, se revisan\r\ncada sesión los cuadernos del colegio. Por lo cual, el terapeuta indicará al\r\nrepresentante /apoderado que SIEMPRE debe traerlos al centro.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">g.- Incrementar progresivamente\r\nperíodos de atención a través de relojes (manejo del tiempo) y de\r\nestructuración de la sesión (agenda de actividades), con el fin de favorecer el\r\ntrabajo independiente, cada vez con menos apoyos verbales.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\"> </span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">Ahora bien, en cuanto a los<b> contenidos académicos </b>deben diseñar\r\nactividades relacionadas con los contenidos FIJOS del programa según el nivel\r\n(ver cada una de las planificaciones) y a su vez, repetir cada tres sesiones\r\nasignaciones y planteamientos asociados a los contenidos seleccionados, los\r\ncuales deben estar directamente acorde con los trabajados en el contexto\r\nescolar (apoyo en coordinador de programa).<b><o:p></o:p></b></span></p>','2024-05-23 00:00:00','jsantana','1',1,1),(21,'PROGRAMA DE ACTIVACIÓN COGNITIVA','<p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">El Programa de Activación\r\nCognitiva, consiste en una ejercitación sistemática de los contenidos\r\nacadémicos propios del nivel o grado escolar que cursa el aprendiz, así como de\r\nlas habilidades previas necesarias para alcanzarlos. Por consiguiente, el P-AC\r\ntiene como objetivo desarrollar y fortalecer habilidades prerequisitas para\r\ngarantizar el éxito escolar, al mismo tiempo que ejercitar contenidos\r\npropiamente dichos. En este orden de ideas, el terapeuta en un mínimo de tres\r\nsesiones repetidas basadas en el programa, ha de alcanzar <b>aspectos pre- requisitos</b> tales como:<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\"> </span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">a.- Lograr el control\r\ninstruccional en el aprendiz.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">b.- Cuidar la postura corporal\r\ndurante la ejecución de las actividades.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">c.- Incrementar progresivamente\r\nla comprensión de los enunciados en las actividades propuestas.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">d.- Desvanecer los apoyos para\r\nfortalecer la independencia en la ejecución.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">e.- Lograr hábitos de trabajo\r\nescolar evidenciado por medio de los cuadernos y materiales.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">f.- Establecer planes de\r\nreforzamiento para incrementar el hábito de mantener los materiales de trabajo\r\nescolar excelentemente ordenados, con las actividades completas y los dibujos\r\ndebidamente coloreados. Tal práctica con el fin de conseguir la generalización\r\nal aula /en la sala de los aspectos logrados en terapia. Por tanto, se revisan\r\ncada sesión los cuadernos del colegio. Por lo cual, el terapeuta indicará al\r\nrepresentante /apoderado que SIEMPRE debe traerlos al centro.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">g.- Incrementar progresivamente\r\nperíodos de atención a través de relojes (manejo del tiempo) y de\r\nestructuración de la sesión (agenda de actividades), con el fin de favorecer el\r\ntrabajo independiente, cada vez con menos apoyos verbales.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\"> </span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-bottom:0in;text-align:justify;line-height:\r\nnormal\"><span lang=\"ES\">Ahora bien, en cuanto a los<b> contenidos académicos </b>deben diseñar\r\nactividades relacionadas con los contenidos FIJOS del programa según el nivel\r\n(ver cada una de las planificaciones) y a su vez, repetir cada tres sesiones\r\nasignaciones y planteamientos asociados a los contenidos seleccionados, los\r\ncuales deben estar directamente acorde con los trabajados en el contexto\r\nescolar (apoyo en coordinador de programa).<b><o:p></o:p></b></span></p>','2024-05-23 00:00:00','jsantana','1',2,1),(22,'PROGRAMA DE ACTIVACIÓN COGNITIVA','El Programa de Activación Cognitiva, consiste en una ejercitación sistemática de los contenidos académicos propios del nivel o grado escolar que cursa el aprendiz, así como de las habilidades previas necesarias para alcanzarlos. Por consiguiente, el P-AC tiene como objetivo desarrollar y fortalecer habilidades prerequisitas para garantizar el éxito escolar, al mismo tiempo que ejercitar contenidos propiamente dichos. En este orden de ideas, el terapeuta en un mínimo de tres sesiones repetidas basadas en el programa, ha de alcanzar aspectos','2024-06-07 00:00:00','jsantana','1',3,1),(23,'PROGRAMA DE MOTRICIDAD FINA VERSIÓN','<p>Se espera que, a través del Programa de Motricidad Infantil, los niños logren desarrollar y mejorar habilidades motoras básicas, como gatear, caminar, correr, saltar, trepar, lanzar y atrapar objetos, entre otras. Además, se espera que los participantes adquieran confianza y autoestima al explorar y experimentar con su cuerpo.</p><p><span style=\"font-size: 1rem;\">Se proyecta que el programa promoverá la socialización y el trabajo en equipo, ya que muchas de las actividades se llevarán a cabo de manera cooperativa. Asimismo, se espera que los participantes adquieran hábitos saludables relacionados con el movimiento y el ejercicio físico.</span></p>','2024-05-23 00:00:00','jsantana','1',14,2);
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

-- Dump completed on 2024-06-15  8:52:02
