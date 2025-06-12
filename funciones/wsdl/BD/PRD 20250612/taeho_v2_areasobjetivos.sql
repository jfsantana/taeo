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
-- Table structure for table `areasobjetivos`
--

DROP TABLE IF EXISTS `areasobjetivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areasobjetivos` (
  `idArea` int(11) NOT NULL AUTO_INCREMENT,
  `nombreArea` varchar(45) DEFAULT NULL,
  `descripcionArea` text DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areasobjetivos`
--

LOCK TABLES `areasobjetivos` WRITE;
/*!40000 ALTER TABLE `areasobjetivos` DISABLE KEYS */;
INSERT INTO `areasobjetivos` VALUES (73,'PROGRAMA DE MOTRICIDAD FINA','<p>Con el propósito de desarrollar fuerza, tonicidad y coordinación en segmentos gruesos del cuerpo que intervienen en las destrezas motoras finas, así como la precisión en habilidades asociadas al manejo de instrumentos, cuadernos, y actividades de autonomía, en distintos niveles de complejidad, desde lo más simple, hasta lo más preciso en cada tarea. Todo lo anterior, en un contexto de incremento de la ideación y planeación motora.&nbsp;</p>','1'),(74,'EEE','<p>EEE</p>','1'),(75,'PROGRAMA DE CONDUCTA VERBAL','<p>La conducta verbal, está representada por todos los comportamientos que implican la mediación de otras personas, es decir, por conductas que producen reforzadores mediados socialmente. En tal sentido, la conducta verbal puede analizarse en los mismos términos en los que se analiza cualquier conducta operante mantenida por consecuencias, que varían según la conducta. <b>Por ejemplo</b>, <b>1.- </b>María es una bebé de 4 meses que llora cada vez que tiene hambre y su mamá solo la alimenta cuando ésta llora. <b>Consecuencia:</b> el llanto está mantenido por el alimento, el confort y la atención que le brinda la madre de forma contingente al llanto. <b>2.-</b> José es un bebé de 11 meses que balbucea y puede vocalizar algunas vocales y sílabas, más aún no puede decir palabras. Su madre presta mucha atención a sus progresos y cada día le modela palabras sencillas como “ajo”- “mamá”, entre otras. Cada vez que José produce una aproximación cercana a la palabra que su mamá le presenta, ésta lo levanta y le hace cosquillas.<b> Consecuencia:</b> la alzada a upa por su madre y las cosquillas. <b>3.-</b> Pedro es un adulto de 40 años con diagnóstico de esquizofrenia, que vive en una clínica psiquiátrica. Sus habilidades sociales son escasas y dice que oye voces que le insultan. Pedro no se lleva bien con los otros pacientes, y aunque le gusta participar en los talleres de música, apenas llegan los otros pacientes, dice que está oyendo las voces y empieza a llorar. El encargado del taller musical, se le acerca y le pide que vaya a un lugar tranquilo para que esté calmado y así Pedro se va. <b>Consecuencia:</b> el escape de la situación que lo enfrenta a los pacientes que no le caen bien. Entonces, según lo antes descrito, las consecuencias que mantienen la conducta verbal pueden ser tan variadas como los comportamientos. Al igual que cualquier otra conducta operante, la conducta verbal le permite al individuo acceder a un sinfín de situaciones y puede estar mantenida tanto por reforzamiento positivo como negativo.</p><p>Asimismo, la conducta verbal puede ser <b>“verbal vocal” </b>siempre que esté de manifiesto una acción que involucre la participación del aparato fonador al menos de forma indiferenciada del aire expirado por la laringe y además, implique la mediación social. También, puede ser solo <b>“verbal”,</b> cuando no hay sonido audible y si está presente la mediación con otros de forma inherente a la función de la conducta. Finalmente, la conducta puede ser <b>“vocal”,</b> mas no verbal, en tanto se produce la acción que involucra el aparato fonador, mas no con la intención de generar cambios en el entorno, por ejemplo, toser o aclararse la garganta, solo para calmar una molestia, sin esperar mediación alguna.</p><p>Tal como se señaló al inicio, la conducta verbal a pesar de estar mediada socialmente, opera a través de los mismos principios que se han estudiado para cualquier otra conducta. Por tanto, se presenta la conducta verbal usando la misma unidad de análisis usada en modificación de conducta:<b> “la triple relación de contingencia”.</b> Cuando las contingencias están compuestas por respuestas verbales, se denominan <b>“operantes verbales”,</b> a fin de distinguirlas de otras conductas operantes no verbales. Las operantes verbales requieren de la interacción de un hablante y un oyente. La interacción de un hablante y un oyente, se denomina <b>“episodio verbal”</b> y si ambos participantes intercambian sus roles de hablante y oyente, se le llama <b>“unidad conversacional”,</b> y entonces solo así resultaría la comunicación efectiva, en la cual ambos participantes son hablantes, pero al mismo tiempo como oyentes, ya que sus respuestas verbales sirven como reforzador para la conducta del otro y al mismo tiempo, como estímulo discriminativo para que emerjan nuevas operantes verbales.</p><p>Por otra parte, Skinner (1957), identificó varios tipos de operantes verbales, tomando en cuenta los estímulos antecedentes, las respuestas verbales y los estímulos reforzantes implicados. Estas son:</p><p><b>-</b><span style=\"white-space:pre\">	</span><b>Ecoicas: </b>está compuesta por una respuesta vocal que guarda similitud morfológica con el estímulo discriminativo verbal (Ed).</p><p><b>-</b><span style=\"white-space:pre\">	</span><b>Mandos:</b> está bajo el control de lo que el hablante quiere obtener del oyente, es decir, de una “operación motivadora”, específicamente, un estado de deprivación u operación de establecimiento.</p><p><b>-</b><span style=\"white-space:pre\">	</span><b>Tactos:</b> está bajo el control de un estímulo discriminativo (Ed) no verbal, mantenida por reforzamiento social generalizado (atención social).&nbsp;</p><p><b>-</b><span style=\"white-space:pre\">	</span><b>Intraverbales:</b> están bajo el control de antecedentes verbales que no guardan similitud morfológica con la respuesta verbal y que son generalmente mantenidas por reforzamiento social generalizado o por alguna forma de respuesta verbal, que puede servir a su vez como Ed para otra intraverbal posterior.</p><p><b>-</b><span style=\"white-space:pre\">	</span><b>Autoclíticos: </b>están bajo el control de otros Ed verbales y especifican una operante verbal primaria, ya sea esta una ecoica, un mando, un tacto o una intraverbal. Por ejemplo, un hablante que dice “pelota grande”, está agregando un autoclítico descriptivo al tacto pelota. Así un hablante que dice “quiero un helado de chocolate”, está incorporando los autoclíticos “quiero un” y “de chocolate”, al mando que está motivado por las ganas de comer helado. Del mismo modo, ocurre con las Intraverbales con autoclíticos.</p><p>Ahora bien, entendiendo de este modo la conducta verbal según Skinner (1957), se evidencia claramente la posibilidad de incrementar la conducta verbal a través del establecimiento de contingencias planificadas para tal fin. Considerando, además, la significativa interferencia en la intención comunicativa que presentan los niños con trastornos en el desarrollo, surge la necesidad de crear un programa específico para mejorarla. En este orden de ideas, TAEO propone entrenamientos basados en Análisis Conductual Aplicado (ABA), con enfoque Verbal Behavior.&nbsp;</p><p>A continuación, se presenta el protocolo de abordaje de la Conducta Verbal:</p>','1');
/*!40000 ALTER TABLE `areasobjetivos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:16
