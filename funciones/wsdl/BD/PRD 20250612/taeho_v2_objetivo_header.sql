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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_header`
--

LOCK TABLES `objetivo_header` WRITE;
/*!40000 ALTER TABLE `objetivo_header` DISABLE KEYS */;
INSERT INTO `objetivo_header` VALUES (48,'01. OPERANTES VERBALES VOCALES (se debe registrar únicamente lo que logra en cada sesión)','<p><b>Emparejamiento Estímulo- Estímulo </b>“los sonidos y palabras que el niño escucha se condicionan frecuentemente al correlacionarlos con reforzadores positivos de los padres. Así pues, que la subsecuente producción de esos sonidos por el niño, se ve fortalecida por el esfuerzo de su propia conducta en forma de estímulo auditivo. Cuanto más cercano esté el sonido al sonido que se ha condicionado como reforzador, más reforzante será este. En el entrenamiento psicoeducativo, se utiliza el procedimiento de emparejamiento estímulo- estímulo para desarrollar las primeras vocalizaciones. </p><p>Ecoicas: está compuesta por una respuesta vocal que guarda similitud morfológica con el estímulo discriminativo verbal (Ed).</p><p>Mandos: está bajo el control de lo que el hablante quiere obtener del oyente, es decir, de una “operación motivadora”, específicamente, un estado de deprivación u operación de establecimiento.</p><p>Tactos: está bajo el control de un estímulo discriminativo (Ed) no verbal, mantenida por reforzamiento social generalizado (atención social).</p><p>Intraverbales: están bajo el control de antecedentes verbales que no guardan similitud morfológica con la respuesta verbal y que son generalmente mantenidas por reforzamiento social generalizado o por alguna forma de respuesta verbal, que puede servir a su vez como estímulo discriminativo para otra intraverbal posterior.</p><p>Autoclíticos: están bajo el control de otros Ed verbales y especifican una operante verbal primaria, ya sea esta una ecoica, un mando, un tacto o una intraverbal. Por ejemplo, un hablante que dice “pelota grande”, está agregando un autoclítico descriptivo al tacto de la pelota. Así un hablante que dice “quiero un helado de chocolate”, está incorporando los autoclíticos “quiero un” y “de chocolate”, al mando que está motivado por las ganas de comer helado. Del mismo modo, ocurre con las Intraverbales con autoclíticos.</p>','2025-05-28 00:00:00','MariaMercedes','1',118,73),(50,'02. SEGMENTOS FINOS','<p>Centrado en el desarrollo de la fuerza, presión, precisión y coordinación de la mano, muñeca y dedos. Las actividades son presentadas de forma descontextualizada, utilizando materiales como plastidedos, ligas, clips, cuentas y papel. Esto incluye desde amasado hasta tareas de pinza fina (índice-pulgar o trípode), con distintos niveles de dificultad. El objetivo es que los aprendices puedan consolidar las habilidades necesarias para el uso de herramientas escolares (como lápices, tijeras, entre otros), la escritura y tareas cotidianas de precisión.</p>','2025-05-28 00:00:00','MariaMercedes','1',119,73),(51,'03. SEGMENTOS GRUESOS','<p>Abarca principalmente brazos, antebrazos y hombros, con foco en el fortalecimiento muscular, movilidad y control postural. Se incluyen ejercicios de brazos y muñecas, y ejercicios de rotación del antebrazo. Todo lo anterior busca que los aprendices puedan sostener y estabilizar el cuerpo para permitir el movimiento fino preciso, facilitando así tareas escolares y de autonomía.</p>','2025-05-28 00:00:00','MariaMercedes','1',120,73),(52,'04. HABILIDADES DESARROLLADAS EN EL CUADERNO','<p>Este apartado incluye tareas como recorte, rasgado, coloreado, trazado, dibujo, plegado, pintura, entre otras, con múltiples niveles de dificultad. Permite trabajar de manera integrada la motricidad fina, la coordinación visomotora y la precisión gráfica, fundamentales para el desempeño académico. El objetivo es facilitar el desarrollo de la escritura, expresión gráfica y el manejo autónomo del material escolar.&nbsp;</p>','2025-05-28 00:00:00','MariaMercedes','1',121,73),(53,'05. AUTONOMÍA ','<p>xxxx</p>','2025-05-28 00:00:00','MariaMercedes','1',122,73),(54,'06. HABILIDADES SOCIALES ','<p>Para fomentar etapas evolutivas del juego como: juego funcional, presimbólico, simbólico, reglado y cooperativo, tanto en interacción con adultos como con pares. Se integra la motivación, reciprocidad, imitación y habilidades comunicativas necesarias para la interacción social con el fin de desarrollar vínculos sociales, participación en actividades compartidas, y facilitar inclusión y cooperación en contextos educativos.&nbsp;</p>','2025-05-28 00:00:00','MariaMercedes','1',123,73),(55,'01. HABILIDADES DE RECIPROCIDAD','<p>Implica un intercambio satisfactorio en doble sentido (recibir y dar/ dar y recibir). Las siguientes habilidades se propiciarán a la par de los distintos entrenamientos para desarrollar e incrementar habilidades de hablante (operantes verbales vocales) y habilidades de oyente.</p>','2025-06-05 00:00:00','MariaMercedes','1',126,75);
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

-- Dump completed on 2025-06-12  8:49:58
