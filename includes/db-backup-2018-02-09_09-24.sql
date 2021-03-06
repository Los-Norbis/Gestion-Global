

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
INSERT INTO me_destino_exp VALUES("7","Control de Gesti�n");
INSERT INTO me_destino_exp VALUES("8","Mesa de Entradas");
INSERT INTO me_destino_exp VALUES("9","Secretar�a de Coordinaci�n");
INSERT INTO me_destino_exp VALUES("10","Registro y Archivo");
INSERT INTO me_destino_exp VALUES("11","Concesiones");
INSERT INTO me_destino_exp VALUES("12","Operaciones");
INSERT INTO me_destino_exp VALUES("13","Comercial");
INSERT INTO me_destino_exp VALUES("14","T�cnica");
INSERT INTO me_destino_exp VALUES("15","Ambiente y Desarrollo Sostenible");
INSERT INTO me_destino_exp VALUES("16","Protecci�n Portuaria ");
INSERT INTO me_destino_exp VALUES("17","Registro de Empresas");
INSERT INTO me_destino_exp VALUES("100","Sistemas");





CREATE TABLE `me_destino_nt` (
  `Id` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_destino_nt VALUES("1","Legislaci�n e Interpretaci�n y Reglamento");
INSERT INTO me_destino_nt VALUES("2","Pol�tica Econ�mica y Finanzas Publicas");
INSERT INTO me_destino_nt VALUES("3","Infraestructura");
INSERT INTO me_destino_nt VALUES("4","Medio Ambiente");
INSERT INTO me_destino_nt VALUES("5","Turismo y Deportes");
INSERT INTO me_destino_nt VALUES("6","Cultura y Educaci�n");
INSERT INTO me_destino_nt VALUES("7","Derechos Humanos");
INSERT INTO me_destino_nt VALUES("8","Trabajo, Prom. Econ�m. y Desarrollo Local");
INSERT INTO me_destino_nt VALUES("9","Pol�ticas de Genero");
INSERT INTO me_destino_nt VALUES("10","Salud y Desarrollo Social");
INSERT INTO me_destino_nt VALUES("11","Seguridad");
INSERT INTO me_destino_nt VALUES("12","Asuntos Agrarios y Pesca");
INSERT INTO me_destino_nt VALUES("50","Cambiemos - Fe");
INSERT INTO me_destino_nt VALUES("51","Frente Renovador - UNA");
INSERT INTO me_destino_nt VALUES("52","Frente Para la Victoria");
INSERT INTO me_destino_nt VALUES("53","Frente Para la Victoria - PJ");
INSERT INTO me_destino_nt VALUES("54","Partido Socialista");
INSERT INTO me_destino_nt VALUES("55","Uni�n C�vica Radical");
INSERT INTO me_destino_nt VALUES("56","Cambiemos - Pro");
INSERT INTO me_destino_nt VALUES("57","Confianza Necochea");
INSERT INTO me_destino_nt VALUES("58","PRO");
INSERT INTO me_destino_nt VALUES("99","No Definido");
INSERT INTO me_destino_nt VALUES("100","Secretar�a Legislativa");
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
  PRIMARY KEY (`Id`),
  KEY `Idx` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_expedientes VALUES("1","2014-02-13","20140024","0","1","","21","Desarrollo Software \" Transporte de Cargas\"","9","");
INSERT INTO me_expedientes VALUES("2","2017-08-08","20160001","0","0","caja 10","13","Aca anduvo gente\n","2","Otras");
INSERT INTO me_expedientes VALUES("3","2016-04-01","20160063","0","1","","19","Desarrollo Software Registro de Empresas Inscripcion","9","");
INSERT INTO me_expedientes VALUES("4","2016-10-19","20160098","0","2","","19","Excel Consulting S.A.  Disponibilidad de Tierras","16","Para Emitir informe 220 fojas.-");
INSERT INTO me_expedientes VALUES("5","2016-12-23","20160106","0","6","","17","Licitaci�n Publica N� 01/2016 \"Tendido Oleoducto y Obras Complementarias desde Sitio 3 a Sitio 6 de Puerto Quequen\" ","10","Para archivo con 1013 fojas.-");
INSERT INTO me_expedientes VALUES("6","2016-03-15","20161923","0","0","","20","Sol. Gesti�n p/ Tenencia Franja Ribere�a Quequ�n P/ Construcci�n de un Astillero, s/ Croquis Adj. ","9","");
INSERT INTO me_expedientes VALUES("7","2017-01-04","20170002","0","2","","17","Licitaci�n Publica N� 02/2016 Contrataci�n de Empresa de Prestaci�n de Servicios \"PLANACON\"","9","");
INSERT INTO me_expedientes VALUES("8","2017-05-23","20170082","0","1","","17","Proyecto Ampliaci�n de Capacidad de Almacenamiento Terminal Quequ�n S.A.","9","");
INSERT INTO me_expedientes VALUES("9","2017-06-08","20170087","0","1","","17","Tribunal de Cuestas Ejercicio 2015","9","");
INSERT INTO me_expedientes VALUES("10","2017-07-17","20170091","0","3","","18","Pier Doce S.A","9","22/08/2017 fojas 452");
INSERT INTO me_expedientes VALUES("11","2017-07-22","20170093","0","1","","17","Donaci�n Hospital Irurzun","9","");
INSERT INTO me_expedientes VALUES("12","2017-07-28","20170094","0","1","","17","Licitaci�n Publica 01/2017 Ampliaci�n de Potencia Sitio 10 de Puerto Quequen","9","178 fojas y a la espera de resoluci�n sobre la emp");
INSERT INTO me_expedientes VALUES("13","2017-08-10","20170097","0","1","","18","Proyecto Puerto Ciudadano","9","");
INSERT INTO me_expedientes VALUES("14","2017-08-30","20170104","0","1","","17","Asociaci�n Cooperadora del Hospital Municipal Dr. Nestor Fermin Cattoni \nJuan N. Fernandez","9","");
INSERT INTO me_expedientes VALUES("15","2016-08-18","20170105","0","1","","22","Designaci�n del auditor Externo del Consorcio de Gesti�n De Puerto Quequ�n","2","");
INSERT INTO me_expedientes VALUES("19","2017-12-13","20150033","0","1","2015-1","23","CDLE ELECTROMECANICA\nINSCRIPCION","10","En el dia de la fecha, 13/12/2017 se registra expt");
INSERT INTO me_expedientes VALUES("20","2018-02-08","20180038","0","1","","24","Morales Agust�n Iv�n - Inscripci�n","17","");
INSERT INTO me_expedientes VALUES("21","2018-02-02","20180034","0","1","","18","LAMAR ELECTROMEC�NICA - INSCRIPCI�N","17","Con 20 Fojas");
INSERT INTO me_expedientes VALUES("22","2018-02-06","20180035","0","1","","25","Ottonello - Bupa S.R.L - Reinscripci�n","17","");
INSERT INTO me_expedientes VALUES("23","2018-02-06","20180036","0","1","","26","Tecnophos Services S.A - Reinscripci�n","17","");
INSERT INTO me_expedientes VALUES("24","2018-02-06","20180037","0","1","","27","Grilli Tom�s Andr�s","17","");





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
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

INSERT INTO me_ruta_exp VALUES("439","20160098","17","2017-08-31 14:28:47","16","");
INSERT INTO me_ruta_exp VALUES("440","20160098","17","2017-09-05 11:53:51","9","");
INSERT INTO me_ruta_exp VALUES("441","20170105","19","2017-12-05 09:58:10","12","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("445","20170087","3","2017-12-06 10:49:01","100","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("446","20150033","20","2017-12-13 09:59:43","10","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("447","20180038","21","2018-02-08 09:12:24","8","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("448","20180034","21","2018-02-08 10:39:17","8","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("449","20180034","21","2018-02-08 10:46:17","17","");
INSERT INTO me_ruta_exp VALUES("450","20180035","21","2018-02-08 10:52:48","8","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("451","20180035","21","2018-02-08 10:53:06","17","");
INSERT INTO me_ruta_exp VALUES("452","20180036","21","2018-02-08 10:58:52","8","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("453","20180036","21","2018-02-08 10:59:45","17","");
INSERT INTO me_ruta_exp VALUES("454","20180037","21","2018-02-08 11:03:58","8","Alta de Expediente");
INSERT INTO me_ruta_exp VALUES("455","20180037","21","2018-02-08 11:04:11","17","");
INSERT INTO me_ruta_exp VALUES("456","20180034","22","2018-02-08 11:10:36","17","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("457","20180035","22","2018-02-08 11:10:50","17","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("458","20180036","22","2018-02-08 11:11:06","17","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("459","20180037","22","2018-02-08 11:11:18","17","Ingreso al Area");
INSERT INTO me_ruta_exp VALUES("460","20180038","22","2018-02-08 11:11:31","17","Ingreso al Area");





CREATE TABLE `me_solicitantes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Tipo` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cuit` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_solicitantes VALUES("17","1","Secretaria de Coordinaci�n","","","","");
INSERT INTO me_solicitantes VALUES("18","0","Presidencia","","","","");
INSERT INTO me_solicitantes VALUES("19","1","Funci�n Administrativa","","","","");
INSERT INTO me_solicitantes VALUES("20","1","Ejecutivo Municipalidad de Necochea","","","","");
INSERT INTO me_solicitantes VALUES("21","1","Seguridad","","","","");
INSERT INTO me_solicitantes VALUES("22","1","Ministerio de la Produccion, Ciencia y Tecnologia","","","","");
INSERT INTO me_solicitantes VALUES("23","0","CDLE ELECTROMECANICA","20-08364327-8","02346-425233/428532","MIGUEL CALDERON 528 CHIVILCOY","cdle-obras@speedy.com.ar");
INSERT INTO me_solicitantes VALUES("24","0","Morales Agust�n Iv�n","20-35412556-1","(02262) 15665101","30 N�3746 - Necochea","");
INSERT INTO me_solicitantes VALUES("25","1","Bupa S.R.L","30-70786754-6","02262 42-5798","67 N 3025","verina@bupaottonello.com.ar");
INSERT INTO me_solicitantes VALUES("26","1","Tecnophos Services S.A - Marcelo Arias","30-71119408-4","0291-4570821","Av San Martin 3444 | Ingeniero White","info@tecnophos.com.ar");
INSERT INTO me_solicitantes VALUES("27","0","Grilli Tom�s Andr�s","20-24428239-4","02262 - 15 - 319197","81 bis 4665","");





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
INSERT INTO me_tema_exp VALUES("7","Control de Gesti�n");
INSERT INTO me_tema_exp VALUES("8","Mesa de Entradas");
INSERT INTO me_tema_exp VALUES("9","�rea de Registro");
INSERT INTO me_tema_exp VALUES("10","�rea de Archivo");
INSERT INTO me_tema_exp VALUES("11","Conscesiones");
INSERT INTO me_tema_exp VALUES("12","Operaciones");
INSERT INTO me_tema_exp VALUES("13","Comercial");
INSERT INTO me_tema_exp VALUES("14","T�cnica");
INSERT INTO me_tema_exp VALUES("15","Ambiente y Desarrollo Sostenible");
INSERT INTO me_tema_exp VALUES("16","Protecci�n Portuaria ");





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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usuarios VALUES("3","Kave","luisfavre@gmail.com","$2y$10$jXUtS0lVjslXD.Liuh/ipewoRctHYZrEXspMmaBi.21YWgCXSt2Eu","1","100","avatar5.png","1");
INSERT INTO usuarios VALUES("18","Diego","dmpglobal@gmail.com","$2y$10$LjePr0kxTlCdBCVwIVHKK.xsyEe1byd46v9xcTqabaJj2vStIjzPq","1","100","","1");
INSERT INTO usuarios VALUES("17","Marcela","marcelagan02@gmail.com","$2y$10$1vihPacFN46KlH5rVVIJ/emmwTrUIsDccqs.MTr.LnIcHGkj0WAsC","2","10","","1");
INSERT INTO usuarios VALUES("19","Favio","operaciones@puertoquequen.com","$2y$10$fQpG9.wf6va8hg4MCwjGeunVagjftT.FdQXU/UzHUQa2MlNMPsU6S","3","12","","1");
INSERT INTO usuarios VALUES("20","Juan","juanearcuri@gmail.com","$2y$10$t.cOK7o03l2Jav5DTIpCTOD1C6Vq3rhmI81zYux46PUum6waiN0fq","2","10","","1");
INSERT INTO usuarios VALUES("21","Mesa","registro@puertoquequen.com","$2y$10$pQdA2KZc4v44tRNlY0VDV.mYirxmYDLAZgls62gXIYsszKdgZfbgi","2","8","","1");
INSERT INTO usuarios VALUES("22","German","germandelrey@puertoquequen.com","$2y$10$mFMjoTBQdJhLVjIlLy3AoO1FkPaFXfvfQhvkcWVz6kFA7vQLGJTXq","3","17","","1");
INSERT INTO usuarios VALUES("23","Lia","liquidaciones@puertoquequen.com","$2y$10$YAuwzPrqKworH4y//izZuuQTRQK/ci/gXRA25tJTy6gCP9RjRAnXS","3","5","","1");
INSERT INTO usuarios VALUES("24","Prueba","prueba@puertoquequen.com","$2y$10$G4cE4hyh2pPa6adIdTwX.OPg2Upt20jFRAggVNnf/yjnQL1NU0uJe","3","100","","1");
INSERT INTO usuarios VALUES("25","Emiliano","seguridad@puertoquequen.com","$2y$10$nJiOpFdPGu..onUOlwXh8Odg6VcIcrSk2iR9FyzTzqXsp/eDg40pG","3","16","","1");



