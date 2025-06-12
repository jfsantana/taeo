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
-- Table structure for table `evaluacion_header`
--

DROP TABLE IF EXISTS `evaluacion_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluacion_header` (
  `idHeaderEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idAprendiz` int(11) DEFAULT NULL,
  `idSede` int(11) DEFAULT NULL,
  `idEvaluadoPor` varchar(200) DEFAULT NULL,
  `fechaUltimaEvaluacion` date DEFAULT NULL,
  `fechaEvaluacion` date DEFAULT NULL,
  `conclucionesRecomendaciones` text DEFAULT NULL,
  `idHeaderEvaluacionAnterior` int(11) DEFAULT NULL,
  `activo` varchar(45) DEFAULT '0= inactiva 1= activo 2= cerrada',
  `observacion` text DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHeaderEvaluacion`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion_header`
--

LOCK TABLES `evaluacion_header` WRITE;
/*!40000 ALTER TABLE `evaluacion_header` DISABLE KEYS */;
INSERT INTO `evaluacion_header` VALUES (1,1,2,'4','0000-00-00','2022-03-15','<div>Considerando la segunda aplicación de la Escala de Estimación Evolutiva TAEO 8.0 (E.E.E), Emiliano Santana, aprendiz de 6 a. 11 m. de edad cronológica, quien asistió a la Organización Psicoeducativa TAEO para llevar a cabo, por un lapso de 14 meses, un abordaje temprano Integral Grupal, donde se recrea una dinámica escolar en pequeños grupos de 3 niños, además, en ese contexto escolar de desarrollan planificaciones de los programas psicoeducativos TAEO: P- Conducta Verbal, P- Autonomía, P- Motricidad Fina y Gruesa, P- Activación Cognitiva; adicionalmente, el grupo realiza diariamente un circuito sensorial liderado por una fisioterapeuta, todo desplegado en actividades grupales. Arrojó los siguientes resultados: tras la aplicación del plan psicoeducativo/terapéutico, exhibe un promedio de desarrollo global hasta sus 5 años de 40 %, el cual tuvo una variación del 4 % frente al 36 % obtenido previo al abordaje; por lo que su promedio global de habilidades ausentes o descendidas se tornó en un 60 % (ver COMPARACIÓN A). Por tanto, se evidencia una mejoría moderada hasta este rango de edad. Ahora bien, el aprendiz cuenta con un año más de vida; en consecuencia, nuevas habilidades son esperadas; de modo que, considerando ahora sus 6 años, su promedio de desarrollo global es de 34 %, por lo que su promedio global de habilidades ausentes o descendidas actual es de 66 % (ver COMPARACIÓN B); observándose una variación negativa de un 2 %. Por consiguiente, es determinante cambiar aun abordaje intensivo, con las actualizaciones apropiadas que describiremos en apartados posteriores, ya que la brecha existente entre lo que sabe- hace Emiliano y lo que debería saber- hacer, al cumplir un año más de edad, se tornó significativa; por tanto, resulta imperativo continuar desarrollando e incrementado sus habilidades para no permitir que se torne más amplia conforme crece, sino reducirla y así seguir potenciando sus oportunidades de participación y aprendizaje (ver recomendaciones).</div><div><br></div><div>Por otro lado, es importante resaltar habilidades que anteriormente Emiliano no lograba, por ejemplo: es un niño que al llegar a las sesiones puede sacar la silla de la mesa para sentarse, puede subir su pantalón e interior con un mínimo apoyo del adulto, asimismo los zapatos. Adicionalmente, incrementó el tiempo en que puede sujetar el color y colorear, realizar prensión con pinza fina, realiza trazos en la pizarra de manera vertical, introduce monedas en la alcancía. Avanzó en los sonidos de discriminación auditiva, realiza igualaciones de manera gráfica con ejemplares múltiples, se le han disminuido los apoyos físicos para el seguimiento de instrucciones y las imitaciones de 1 acción. En cuanto a la comunicación, se continúa entrenando que Emiliano puede realizar solicitudes por medio de la Tablet con una aplicación llamada Pictotea, simultáneamente que se ejercita el incrementar sonidos vocales. </div><div><br></div><div>Se recomienda:</div><div><br></div><ol><li>1.- En relación con la rutina es indispensable propiciar situaciones donde Emiliano pueda desarrollar habilidades de autonomía y autodeterminación que se encuentran descendidas, desplegando procedimientos de encadenamiento conductual (desglosando la habilidad en los distintos pasos que la componen para enseñar cada uno), algunas de estas habilidades son: colocarse los zapatos, recoger sus juguetes, cepillar sus dientes, controlar esfínter, utilizar cucharilla y tenedor correctamente, lavar sus manos y cara, vestirse sin apoyo, entre otras habilidades de mayor complejidad. Adicionalmente, es importante ejercitar diariamente dichas tareas y generar la necesidad de que el aprendiz exhiba tales habilidades para así ayudar a que pueda consolidarlas y se instauren como hábitos; también, continuar ejercitando las ya alcanzadas para que no se disipen. </li><li>Entrenamiento familiar a través de capacitaciones y asesorías para padres/cuidadores (seleccionar pack de 4 sesiones). Al respecto, es importante resaltar lo fundamental que resulta que los padres y cuidadores se apropien del conocimiento y de las herramientas adecuadas para convertirse en mediadores efectivos del desarrollo y del aprendizaje de su hijo. Por consiguiente, algunos de los tópicos necesarios son:</li><li><span style=\"font-size: 1rem;\">- Análisis y estructuración del ambiente familiar. Plan de estructuración de las rutinas y los ambientes a través de enseñanza estructurada, proponiendo el uso de apoyos visuales, agendas y sistemas de trabajo.</span></li></ol><div>-Inventario de comportamientos excesivos y/o problemáticos mediados como: llorar, gritar o golpearse para escapar de las actividades que requieren de gran esfuerzo para Emiliano o autoestimulatorios. Priorización e intervención.</div><div>- Incremento de conductas ausentes o descendidas asociadas a los distintos aspectos del desarrollo. Establecer planes de acción para ser puestos en marcha en el contexto familiar, a través de procedimientos conductuales.</div><div>- Desarrollo e incremento de habilidades asociadas a la autonomía del aprendiz, por medio de encadenamientos conductuales. Análisis de tareas con establecimiento de planes de reforzamiento.</div><div>- Asimismo, de las habilidades sociales de interacción, así como las del juego: uso funcional de juguetes, realizando una acción, luego 2 acciones y así hasta llegar a realizar un juego simbólico.</div><div>- Entrenamiento en control de esfínteres.</div><div><br></div><div>3.- Mantener el Abordaje Integran Grupal, para que pueda desenvolverse exitosamente en contextos grupales con más niños; asimismo mantener e incrementar la cantidad de sesiones del Abordaje Individualizado para lograr la consolidación de las habilidades que se encuentran descendidas. </div>',NULL,'1','llenar con algo<p></p>',NULL),(7,14,3,'20,2,1','0000-00-00','2024-11-01','<p>demo</p>',0,'1','<p>asdasd</p>','jsantana'),(8,1,2,'','0000-00-00','2024-11-06','',0,'1','','yuslopez'),(9,19,2,'','0000-00-00','2024-11-12','',0,'1','','jsantana'),(10,18,15,'4','0000-00-00','2024-11-21','<p>esto es una prueba para el informe integral</p>',0,'1','','jsantana');
/*!40000 ALTER TABLE `evaluacion_header` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:18
