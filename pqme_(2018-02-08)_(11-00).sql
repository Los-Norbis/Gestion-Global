-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: pqme
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `me_destino_exp`
--

DROP TABLE IF EXISTS `me_destino_exp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_destino_exp` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_destino_exp`
--

LOCK TABLES `me_destino_exp` WRITE;
/*!40000 ALTER TABLE `me_destino_exp` DISABLE KEYS */;
INSERT INTO `me_destino_exp` VALUES (1,'Asesor Legal'),(2,'Presidencia'),(3,'Gerente General'),(4,'Recursos Humanos'),(5,'Contable'),(6,'Legales'),(7,'Control de Gestión'),(8,'Mesa de Entradas'),(9,'Secretaría de Coordinación'),(10,'Registro y Archivo'),(11,'Concesiones'),(12,'Operaciones'),(13,'Comercial'),(14,'Técnica'),(15,'Ambiente y Desarrollo Sostenible'),(16,'Protección Portuaria '),(17,'Registro de Empresas'),(100,'Sistemas');
/*!40000 ALTER TABLE `me_destino_exp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_destino_nt`
--

DROP TABLE IF EXISTS `me_destino_nt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_destino_nt` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_destino_nt`
--

LOCK TABLES `me_destino_nt` WRITE;
/*!40000 ALTER TABLE `me_destino_nt` DISABLE KEYS */;
INSERT INTO `me_destino_nt` VALUES (1,'Legislación e Interpretación y Reglamento'),(2,'Política Económica y Finanzas Publicas'),(3,'Infraestructura'),(4,'Medio Ambiente'),(5,'Turismo y Deportes'),(6,'Cultura y Educación'),(7,'Derechos Humanos'),(8,'Trabajo, Prom. Económ. y Desarrollo Local'),(9,'Políticas de Genero'),(10,'Salud y Desarrollo Social'),(11,'Seguridad'),(12,'Asuntos Agrarios y Pesca'),(50,'Cambiemos - Fe'),(51,'Frente Renovador - UNA'),(52,'Frente Para la Victoria'),(53,'Frente Para la Victoria - PJ'),(54,'Partido Socialista'),(55,'Unión Cívica Radical'),(56,'Cambiemos - Pro'),(57,'Confianza Necochea'),(58,'PRO'),(99,'No Definido'),(100,'Secretaría Legislativa'),(101,'Presidencia'),(102,'Digesto'),(103,'Departamento Ejecutivo'),(104,'Mesa de Entrada Depto. Ejecutivo');
/*!40000 ALTER TABLE `me_destino_nt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_expedientes`
--

DROP TABLE IF EXISTS `me_expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_expedientes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Ingreso` date NOT NULL,
  `Orden` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `Alcance` tinyint(4) NOT NULL,
  `Cuerpo` tinyint(4) NOT NULL,
  `Archivo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Solicitante` smallint(6) NOT NULL,
  `Caratula` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Destino` smallint(6) NOT NULL,
  `Notas` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Orden`),
  KEY `Idx` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_expedientes`
--

LOCK TABLES `me_expedientes` WRITE;
/*!40000 ALTER TABLE `me_expedientes` DISABLE KEYS */;
INSERT INTO `me_expedientes` VALUES (1,'2014-02-13','20140024',0,1,'',21,'Desarrollo Software \" Transporte de Cargas\"',9,''),(19,'2017-12-13','20150033',0,1,'2015-1',23,'CDLE ELECTROMECANICA\r\nINSCRIPCION',10,'En el dia de la fecha, 13/12/2017 se registra expt'),(2,'2017-08-08','20160001',0,0,'caja 10',13,'Aca anduvo gente\r\n',2,'Otras'),(3,'2016-04-01','20160063',0,1,'',19,'Desarrollo Software Registro de Empresas Inscripcion',9,''),(4,'2016-10-19','20160098',0,2,'',19,'Excel Consulting S.A.  Disponibilidad de Tierras',16,'Para Emitir informe 220 fojas.-'),(5,'2016-12-23','20160106',0,6,'',17,'Licitación Publica N° 01/2016 \"Tendido Oleoducto y Obras Complementarias desde Sitio 3 a Sitio 6 de Puerto Quequen\" ',10,'Para archivo con 1013 fojas.-'),(6,'2016-03-15','20161923',0,0,'',20,'Sol. Gestión p/ Tenencia Franja Ribereña Quequén P/ Construcción de un Astillero, s/ Croquis Adj. ',9,''),(7,'2017-01-04','20170002',0,2,'',17,'Licitación Publica N° 02/2016 Contratación de Empresa de Prestación de Servicios \"PLANACON\"',9,''),(8,'2017-05-23','20170082',0,1,'',17,'Proyecto Ampliación de Capacidad de Almacenamiento Terminal Quequén S.A.',9,''),(9,'2017-06-08','20170087',0,1,'',17,'Tribunal de Cuestas Ejercicio 2015',9,''),(10,'2017-07-17','20170091',0,3,'',18,'Pier Doce S.A',9,'22/08/2017 fojas 452'),(11,'2017-07-22','20170093',0,1,'',17,'Donación Hospital Irurzun',9,''),(12,'2017-07-28','20170094',0,1,'',17,'Licitación Publica 01/2017 Ampliación de Potencia Sitio 10 de Puerto Quequen',9,'178 fojas y a la espera de resolución sobre la emp'),(13,'2017-08-10','20170097',0,1,'',18,'Proyecto Puerto Ciudadano',9,''),(14,'2017-08-30','20170104',0,1,'',17,'Asociación Cooperadora del Hospital Municipal Dr. Nestor Fermin Cattoni \r\nJuan N. Fernandez',9,''),(15,'2016-08-18','20170105',0,1,'',22,'Designación del auditor Externo del Consorcio de Gestión De Puerto Quequén',2,''),(21,'2018-02-02','20180034',0,1,'',18,'LAMAR ELECTROMECÁNICA - INSCRIPCIÓN',17,'Con 20 Fojas'),(22,'2018-02-06','20180035',0,1,'',25,'Ottonello - Bupa S.R.L - Reinscripción',17,''),(23,'2018-02-06','20180036',0,1,'',26,'Tecnophos Services S.A - Reinscripción',17,''),(20,'2018-02-08','20180038',0,1,'',24,'Morales Agustín Iván - Inscripción',8,'');
/*!40000 ALTER TABLE `me_expedientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_notas`
--

DROP TABLE IF EXISTS `me_notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_notas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ingreso` date NOT NULL,
  `Prioridad` tinyint(4) NOT NULL,
  `Remitente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Tema` smallint(6) NOT NULL,
  `Motivo` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Destino` smallint(6) NOT NULL,
  `Notas` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_notas`
--

LOCK TABLES `me_notas` WRITE;
/*!40000 ALTER TABLE `me_notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_ruta_exp`
--

DROP TABLE IF EXISTS `me_ruta_exp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_ruta_exp` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Orden` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario` smallint(6) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Destino` smallint(6) NOT NULL,
  `Notas` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Numero` (`Orden`),
  KEY `Numero_2` (`Orden`)
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_ruta_exp`
--

LOCK TABLES `me_ruta_exp` WRITE;
/*!40000 ALTER TABLE `me_ruta_exp` DISABLE KEYS */;
INSERT INTO `me_ruta_exp` VALUES (439,'20160098',17,'2017-08-31 14:28:47',16,''),(440,'20160098',17,'2017-09-05 11:53:51',9,''),(441,'20170105',19,'2017-12-05 09:58:10',12,'Ingreso al Area'),(445,'20170087',3,'2017-12-06 10:49:01',100,'Ingreso al Area'),(446,'20150033',20,'2017-12-13 09:59:43',10,'Alta de Expediente'),(447,'20180038',21,'2018-02-08 09:12:24',8,'Alta de Expediente'),(448,'20180034',21,'2018-02-08 10:39:17',8,'Alta de Expediente'),(449,'20180034',21,'2018-02-08 10:46:17',17,''),(450,'20180035',21,'2018-02-08 10:52:48',8,'Alta de Expediente'),(451,'20180035',21,'2018-02-08 10:53:06',17,''),(452,'20180036',21,'2018-02-08 10:58:52',8,'Alta de Expediente'),(453,'20180036',21,'2018-02-08 10:59:45',17,'');
/*!40000 ALTER TABLE `me_ruta_exp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_solicitantes`
--

DROP TABLE IF EXISTS `me_solicitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_solicitantes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Tipo` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cuit` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_solicitantes`
--

LOCK TABLES `me_solicitantes` WRITE;
/*!40000 ALTER TABLE `me_solicitantes` DISABLE KEYS */;
INSERT INTO `me_solicitantes` VALUES (17,1,'Secretaria de Coordinación','','','',''),(18,0,'Presidencia','','','',''),(19,1,'Función Administrativa','','','',''),(20,1,'Ejecutivo Municipalidad de Necochea','','','',''),(21,1,'Seguridad','','','',''),(22,1,'Ministerio de la Produccion, Ciencia y Tecnologia','','','',''),(23,0,'CDLE ELECTROMECANICA','20-08364327-8','02346-425233/428532','MIGUEL CALDERON 528 CHIVILCOY','cdle-obras@speedy.com.ar'),(24,0,'Morales Agustín Iván','20-35412556-1','(02262) 15665101','30 N°3746 - Necochea',''),(25,1,'Bupa S.R.L','30-70786754-6','02262 42-5798','67 N 3025','verina@bupaottonello.com.ar'),(26,1,'Tecnophos Services S.A - Marcelo Arias','30-71119408-4','0291-4570821','Av San Martin 3444 | Ingeniero White','info@tecnophos.com.ar');
/*!40000 ALTER TABLE `me_solicitantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_tema_exp`
--

DROP TABLE IF EXISTS `me_tema_exp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_tema_exp` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_tema_exp`
--

LOCK TABLES `me_tema_exp` WRITE;
/*!40000 ALTER TABLE `me_tema_exp` DISABLE KEYS */;
INSERT INTO `me_tema_exp` VALUES (1,'Asesor Legal'),(2,'Presidencia'),(3,'Gerente General'),(4,'Recursos Humanos'),(5,'Contable'),(6,'Legales'),(7,'Control de Gestión'),(8,'Mesa de Entradas'),(9,'Área de Registro'),(10,'Área de Archivo'),(11,'Conscesiones'),(12,'Operaciones'),(13,'Comercial'),(14,'Técnica'),(15,'Ambiente y Desarrollo Sostenible'),(16,'Protección Portuaria ');
/*!40000 ALTER TABLE `me_tema_exp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `me_tema_nt`
--

DROP TABLE IF EXISTS `me_tema_nt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `me_tema_nt` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `me_tema_nt`
--

LOCK TABLES `me_tema_nt` WRITE;
/*!40000 ALTER TABLE `me_tema_nt` DISABLE KEYS */;
/*!40000 ALTER TABLE `me_tema_nt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opciones`
--

DROP TABLE IF EXISTS `opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opciones` (
  `Id` tinyint(4) NOT NULL,
  `Gasoil` decimal(6,2) NOT NULL,
  `Nafta` decimal(6,2) NOT NULL,
  `Orden` mediumint(9) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones`
--

LOCK TABLES `opciones` WRITE;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` VALUES (1,14.60,19.23,126);
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` tinyint(4) NOT NULL,
  `user_area` smallint(6) NOT NULL,
  `user_img` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,'Kave','luisfavre@gmail.com','$2y$10$jXUtS0lVjslXD.Liuh/ipewoRctHYZrEXspMmaBi.21YWgCXSt2Eu',1,100,'avatar5.png',1),(18,'Diego','dmpglobal@gmail.com','$2y$10$LjePr0kxTlCdBCVwIVHKK.xsyEe1byd46v9xcTqabaJj2vStIjzPq',1,100,'',1),(17,'Marcela','marcelagan02@gmail.com','$2y$10$1vihPacFN46KlH5rVVIJ/emmwTrUIsDccqs.MTr.LnIcHGkj0WAsC',2,10,'',1),(19,'Favio','operaciones@puertoquequen.com','$2y$10$fQpG9.wf6va8hg4MCwjGeunVagjftT.FdQXU/UzHUQa2MlNMPsU6S',3,12,'',1),(20,'Juan','juanearcuri@gmail.com','$2y$10$t.cOK7o03l2Jav5DTIpCTOD1C6Vq3rhmI81zYux46PUum6waiN0fq',2,10,'',1),(21,'Mesa','registro@puertoquequen.com','$2y$10$pQdA2KZc4v44tRNlY0VDV.mYirxmYDLAZgls62gXIYsszKdgZfbgi',2,8,'',1),(22,'German','germandelrey@puertoquequen.com','$2y$10$mFMjoTBQdJhLVjIlLy3AoO1FkPaFXfvfQhvkcWVz6kFA7vQLGJTXq',3,17,'',1),(23,'Lia','liquidaciones@puertoquequen.com','$2y$10$YAuwzPrqKworH4y//izZuuQTRQK/ci/gXRA25tJTy6gCP9RjRAnXS',3,5,'',1),(24,'Prueba','prueba@puertoquequen.com','$2y$10$G4cE4hyh2pPa6adIdTwX.OPg2Upt20jFRAggVNnf/yjnQL1NU0uJe',3,100,'',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-08 11:00:00
