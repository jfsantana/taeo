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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_token`
--

LOCK TABLES `usuario_token` WRITE;
/*!40000 ALTER TABLE `usuario_token` DISABLE KEYS */;
INSERT INTO `usuario_token` VALUES (131,'jsantana','4e1ff5ad12ccf37b97e5c7d4473a9d15','1','2024-10-28 20:38:00',1),(132,'jsantana','88b2fbe6ec655160f349746d82675dcf','1','2024-10-29 14:00:00',1),(133,'jsantana','2b39f210f200f35b89a19bcb77b4351c','1','2024-10-29 19:41:00',1),(134,'jsantana','a04144fe40c2ca60f3c77a96fe11d4d2','1','2024-10-30 11:47:00',3),(135,'facilitador','0616b5c21061e42e1595a55a610ea9a6','1','2024-10-30 11:48:00',2),(136,'jsantana','84760bb18abfc8e1e1e2f94f5de83245','1','2024-10-30 11:56:00',3),(137,'facilitador','92cf26a14e0c72518538e829bf16de86','1','2024-10-30 12:07:00',3),(138,'facilitador','8a695eb6957c844eec0b5130da321d8d','1','2024-10-30 12:14:00',15),(139,'jsantana','da749790b94b4cbfac7d0cb69918d846','1','2024-10-30 12:28:00',3),(140,'jsantana','f3b1223c72a17f3938a6bf9697bca528','1','2024-10-30 12:29:00',3),(141,'facilitadorEjemplo','eb8c2ecedf844b69cf7eb2ca76cf1ba3','1','2024-10-30 12:29:00',3),(142,'jsantana','76af4a5398678bdd2d88255e6c6e64a9','1','2024-10-30 12:43:00',3),(143,'facilitadorEjemplo','098a70f1dfcefdbf74cf8d0c07cdfc93','1','2024-10-30 17:59:00',3),(144,'jsantana','a2273a263712410b7d8a8c51b8b0fecb','1','2024-10-30 17:01:00',3),(145,'facilitadorEjemplo','8622be22e0d025346526a8532b43c86b','1','2024-10-30 17:52:00',2),(146,'jsantana','f35f4437cf7c5d07cd05a2920393a0ce','1','2024-10-30 18:08:00',3),(147,'jsantana','3809c1c5dcb85097a94a3ac0eb122de0','1','2024-10-30 18:09:00',3),(148,'jsantana','e2c2c009fac9651765038dc8d976820e','1','2024-10-30 18:12:00',3),(149,'jsantana','7d14b987d6e2d51009faebedf8b67c54','1','2024-10-30 18:12:00',3),(150,'jsantana','868ff10c3e250e28fbd839b8f941a488','1','2024-10-30 18:12:00',3),(151,'jsantana','13a337f4d9ffd38ddac592fee01fd92e','1','2024-10-30 18:12:00',3),(152,'jsantana','2dace5baf84ea07479525ffc7a438c62','1','2024-10-30 18:13:00',3),(153,'facilitador','219b297d23b21cf93936c6690fdd5de8','1','2024-10-30 18:14:00',3),(154,'jsantana','e955e167bbdb7349c5b5f250cc50130b','1','2024-10-30 18:20:00',3),(155,'jsantana','c9f3543043abf3c06e988220e5c24db8','1','2024-10-30 18:21:00',3),(156,'coordinador','d2b51729bea67dc6e61da31fef1543d8','1','2024-10-30 18:22:00',3),(157,'jsantana','7bdb1142934383d7aa2551e487dfbc83','1','2024-10-30 18:22:00',3),(158,'facilitador','bcb3ca4cf9d799811fd1d2607c2f9480','1','2024-10-30 18:36:00',3),(159,'coordinador','c3d15b14a8783da3e7e497c243159ea2','1','2024-10-30 18:36:00',3),(160,'jsantana','a4d20bde7b94bdd2c1311856cdd0b1df','1','2024-10-30 18:37:00',3),(161,'coordinador','3cc37bdb05387154e7c52fa213a48370','1','2024-10-30 18:37:00',3),(162,'facilitador','43a776e282dbcd640defc7d31a6b7027','1','2024-10-30 18:58:00',3),(163,'jsantana','755a3c6d326b3e304b0e19703b413605','1','2024-10-30 19:01:00',3),(164,'coordinador','3aac79bae8cd2b521a41849e84800797','1','2024-10-30 19:04:00',3),(165,'jsantana','18a1ec5ca667c65e8f38eabc7bfa7afb','1','2024-10-30 19:06:00',3),(166,'coordinador','514713dee0bed4628c97a04d097ed5f1','1','2024-10-30 19:07:00',3),(167,'jsantana','8246c917dba470bfa365eadea468dfc0','1','2024-10-30 19:08:00',3),(168,'facilitador','8a1db3b9a3be2afc23b585b2c63f86b2','1','2024-10-30 19:14:00',3),(169,'jsantana','c0d5c861af0b6de6fc96576cd7e425d5','1','2024-10-30 19:27:00',3),(170,'facilitador','8c97557366b27d743c5e73296f71db86','1','2024-10-30 19:39:00',3);
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

-- Dump completed on 2024-10-30 15:47:13
