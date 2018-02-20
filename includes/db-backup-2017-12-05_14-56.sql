

CREATE TABLE `me_destino_exp` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_destino_exp VALUES("1","Asesor Legal");
INSERT INTO me_destino_exp VALUES("2","Presidencia");
INSERT INTO me_destino_exp VALUES("3","Gerente General");
INSERT INTO me_destino_exp VALUES("4","Recursos Humanos");
INSERT INTO me_destino_exp VALUES("5","Contable");
INSERT INTO me_destino_exp VALUES("6","Legales");
INSERT INTO me_destino_exp VALUES("7","Control de Gestión");
INSERT INTO me_destino_exp VALUES("8","Mesa de Entradas");
INSERT INTO me_destino_exp VALUES("9","Secretaría de Coordinación");
INSERT INTO me_destino_exp VALUES("10","Registro y Archivo");
INSERT INTO me_destino_exp VALUES("11","Concesiones");
INSERT INTO me_destino_exp VALUES("12","Operaciones");
INSERT INTO me_destino_exp VALUES("13","Comercial");
INSERT INTO me_destino_exp VALUES("14","Técnica");
INSERT INTO me_destino_exp VALUES("15","Ambiente y Desarrollo Sostenible");
INSERT INTO me_destino_exp VALUES("16","Protección Portuaria ");
INSERT INTO me_destino_exp VALUES("100","Sistemas");





CREATE TABLE `me_destino_nt` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_destino_nt VALUES("1","Legislación e Interpretación y Reglamento");
INSERT INTO me_destino_nt VALUES("2","Política Económica y Finanzas Publicas");
INSERT INTO me_destino_nt VALUES("3","Infraestructura");
INSERT INTO me_destino_nt VALUES("4","Medio Ambiente");
INSERT INTO me_destino_nt VALUES("5","Turismo y Deportes");
INSERT INTO me_destino_nt VALUES("6","Cultura y Educación");
INSERT INTO me_destino_nt VALUES("7","Derechos Humanos");
INSERT INTO me_destino_nt VALUES("8","Trabajo, Prom. Económ. y Desarrollo Local");
INSERT INTO me_destino_nt VALUES("9","Políticas de Genero");
INSERT INTO me_destino_nt VALUES("10","Salud y Desarrollo Social");
INSERT INTO me_destino_nt VALUES("11","Seguridad");
INSERT INTO me_destino_nt VALUES("12","Asuntos Agrarios y Pesca");
INSERT INTO me_destino_nt VALUES("50","Cambiemos - Fe");
INSERT INTO me_destino_nt VALUES("51","Frente Renovador - UNA");
INSERT INTO me_destino_nt VALUES("52","Frente Para la Victoria");
INSERT INTO me_destino_nt VALUES("53","Frente Para la Victoria - PJ");
INSERT INTO me_destino_nt VALUES("54","Partido Socialista");
INSERT INTO me_destino_nt VALUES("55","Unión Cívica Radical");
INSERT INTO me_destino_nt VALUES("56","Cambiemos - Pro");
INSERT INTO me_destino_nt VALUES("57","Confianza Necochea");
INSERT INTO me_destino_nt VALUES("58","PRO");
INSERT INTO me_destino_nt VALUES("99","No Definido");
INSERT INTO me_destino_nt VALUES("100","Secretaría Legislativa");
INSERT INTO me_destino_nt VALUES("101","Presidencia");
INSERT INTO me_destino_nt VALUES("102","Digesto");
INSERT INTO me_destino_nt VALUES("103","Departamento Ejecutivo");
INSERT INTO me_destino_nt VALUES("104","Mesa de Entrada Depto. Ejecutivo");





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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_expedientes VALUES("1","2014-02-13","20140024","0","1","","21","Desarrollo Software \" Transporte de Cargas\"","9","");
INSERT INTO me_expedientes VALUES("2","2017-08-08","20160001","0","0","caja 10","13","Aca anduvo gente\n","2","Otras");
INSERT INTO me_expedientes VALUES("3","2016-04-01","20160063","0","1","","19","Desarrollo Software Registro de Empresas Inscripcion","9","");
INSERT INTO me_expedientes VALUES("4","2016-10-19","20160098","0","2","","19","Excel Consulting S.A.  Disponibilidad de Tierras","16","Para Emitir informe 220 fojas.-");
INSERT INTO me_expedientes VALUES("5","2016-12-23","20160106","0","6","","17","Licitación Publica N° 01/2016 \"Tendido Oleoducto y Obras Complementarias desde Sitio 3 a Sitio 6 de Puerto Quequen\" ","10","Para archivo con 1013 fojas.-");
INSERT INTO me_expedientes VALUES("6","2016-03-15","20161923","0","0","","20","Sol. Gestión p/ Tenencia Franja Ribereña Quequén P/ Construcción de un Astillero, s/ Croquis Adj. ","9","");
INSERT INTO me_expedientes VALUES("7","2017-01-04","20170002","0","2","","17","Licitación Publica N° 02/2016 Contratación de Empresa de Prestación de Servicios \"PLANACON\"","9","");
INSERT INTO me_expedientes VALUES("8","2017-05-23","20170082","0","1","","17","Proyecto Ampliación de Capacidad de Almacenamiento Terminal Quequén S.A.","9","");
INSERT INTO me_expedientes VALUES("9","2017-06-08","20170087","0","1","","17","Tribunal de Cuestas Ejercicio 2015","9","");
INSERT INTO me_expedientes VALUES("10","2017-07-17","20170091","0","3","","18","Pier Doce S.A","9","22/08/2017 fojas 452");
INSERT INTO me_expedientes VALUES("11","2017-07-22","20170093","0","1","","17","Donación Hospital Irurzun","9","");
INSERT INTO me_expedientes VALUES("12","2017-07-28","20170094","0","1","","17","Licitación Publica 01/2017 Ampliación de Potencia Sitio 10 de Puerto Quequen","9","178 fojas y a la espera de resolución sobre la emp");
INSERT INTO me_expedientes VALUES("13","2017-08-10","20170097","0","1","","18","Proyecto Puerto Ciudadano","9","");
INSERT INTO me_expedientes VALUES("14","2017-08-30","20170104","0","1","","17","Asociación Cooperadora del Hospital Municipal Dr. Nestor Fermin Cattoni \nJuan N. Fernandez","9","");
INSERT INTO me_expedientes VALUES("15","2016-08-18","20170105","0","1","","22","Designación del auditor Externo del Consorcio de Gestión De Puerto Quequén","2","");





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
) ENGINE=InnoDB AUTO_INCREMENT=445 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

INSERT INTO me_ruta_exp VALUES("439","20160098","17","2017-08-31 14:28:47","16","");
INSERT INTO me_ruta_exp VALUES("440","20160098","17","2017-09-05 11:53:51","9","");
INSERT INTO me_ruta_exp VALUES("441","20170105","19","2017-12-05 09:58:10","12","Ingreso al Area");





CREATE TABLE `me_solicitantes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Tipo` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cuit` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_solicitantes VALUES("17","1","Secretaria de Coordinación","","","","");
INSERT INTO me_solicitantes VALUES("18","0","Presidencia","","","","");
INSERT INTO me_solicitantes VALUES("19","1","Función Administrativa","","","","");
INSERT INTO me_solicitantes VALUES("20","1","Ejecutivo Municipalidad de Necochea","","","","");
INSERT INTO me_solicitantes VALUES("21","1","Seguridad","","","","");
INSERT INTO me_solicitantes VALUES("22","1","Ministerio de la Produccion, Ciencia y Tecnologia","","","","");





CREATE TABLE `me_tema_exp` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_tema_exp VALUES("1","Asesor Legal");
INSERT INTO me_tema_exp VALUES("2","Presidencia");
INSERT INTO me_tema_exp VALUES("3","Gerente General");
INSERT INTO me_tema_exp VALUES("4","Recursos Humanos");
INSERT INTO me_tema_exp VALUES("5","Contable");
INSERT INTO me_tema_exp VALUES("6","Legales");
INSERT INTO me_tema_exp VALUES("7","Control de Gestión");
INSERT INTO me_tema_exp VALUES("8","Mesa de Entradas");
INSERT INTO me_tema_exp VALUES("9","Área de Registro");
INSERT INTO me_tema_exp VALUES("10","Área de Archivo");
INSERT INTO me_tema_exp VALUES("11","Conscesiones");
INSERT INTO me_tema_exp VALUES("12","Operaciones");
INSERT INTO me_tema_exp VALUES("13","Comercial");
INSERT INTO me_tema_exp VALUES("14","Técnica");
INSERT INTO me_tema_exp VALUES("15","Ambiente y Desarrollo Sostenible");
INSERT INTO me_tema_exp VALUES("16","Protección Portuaria ");





CREATE TABLE `me_tema_nt` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `opciones` (
  `Id` tinyint(4) NOT NULL,
  `Gasoil` decimal(6,2) NOT NULL,
  `Nafta` decimal(6,2) NOT NULL,
  `Orden` mediumint(9) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO opciones VALUES("1","14.60","19.23","126");





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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usuarios VALUES("3","Kave","luisfavre@gmail.com","$2y$10$jXUtS0lVjslXD.Liuh/ipewoRctHYZrEXspMmaBi.21YWgCXSt2Eu","1","100","avatar5.png","1");
INSERT INTO usuarios VALUES("18","Diego","dmpglobal@gmail.com","$2y$10$LjePr0kxTlCdBCVwIVHKK.xsyEe1byd46v9xcTqabaJj2vStIjzPq","2","100","","1");
INSERT INTO usuarios VALUES("17","Marcela","marcelagan02@gmail.com","$2y$10$1vihPacFN46KlH5rVVIJ/emmwTrUIsDccqs.MTr.LnIcHGkj0WAsC","2","10","","1");
INSERT INTO usuarios VALUES("19","Operaciones","operaciones@puertoquequen.com","$2y$10$MVz11.F1oB7Y/2BFvhGVZeBp2a35VyewdHYgyfsQO84vFj0fVfbIK","3","12","","1");
INSERT INTO usuarios VALUES("20","Vasco","juanearcuri@gmail.com","$2y$10$t.cOK7o03l2Jav5DTIpCTOD1C6Vq3rhmI81zYux46PUum6waiN0fq","2","10","","1");
INSERT INTO usuarios VALUES("21","Registro","registro@puertoquequen.com","$2y$10$MmO9sBX.swi/CD5NlSf.8eYrENC.TL0Pb5xGrli/IQ/ZKmv9l8d62","2","8","","0");



