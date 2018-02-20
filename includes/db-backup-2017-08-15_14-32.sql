

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
INSERT INTO me_destino_exp VALUES("9","Área de Registro");
INSERT INTO me_destino_exp VALUES("10","Área de Archivo");
INSERT INTO me_destino_exp VALUES("11","Conscesiones");
INSERT INTO me_destino_exp VALUES("12","Operaciones");
INSERT INTO me_destino_exp VALUES("13","Comercial");
INSERT INTO me_destino_exp VALUES("14","Técnica");
INSERT INTO me_destino_exp VALUES("15","Ambiente y Desarrollo Sostenible");
INSERT INTO me_destino_exp VALUES("16","Protección Portuaria ");





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
  `Ingreso` date NOT NULL,
  `Orden` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `Alcance` tinyint(4) NOT NULL,
  `Cuerpo` tinyint(4) NOT NULL,
  `Archivo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Solicitante` smallint(6) NOT NULL,
  `Caratula` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Destino` smallint(6) NOT NULL,
  `Notas` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Orden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_expedientes VALUES("2017-08-08","20150001","0","0","caja 10","6","urteaga del hoyo\n","2","");





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
) ENGINE=InnoDB AUTO_INCREMENT=439 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

INSERT INTO me_ruta_exp VALUES("1","20170003","10","2016-12-13 12:19:33","2","Es este");
INSERT INTO me_ruta_exp VALUES("2","20406","5","2016-12-19 10:47:56","5","");
INSERT INTO me_ruta_exp VALUES("3","20420","5","2016-12-19 10:55:31","5","");
INSERT INTO me_ruta_exp VALUES("4","20242","5","2016-12-19 10:57:35","1","");
INSERT INTO me_ruta_exp VALUES("5","20429","5","2016-12-19 13:31:42","5","");
INSERT INTO me_ruta_exp VALUES("6","20436","5","2016-12-19 13:38:45","5","");
INSERT INTO me_ruta_exp VALUES("7","20393","5","2016-12-21 09:49:44","100","");
INSERT INTO me_ruta_exp VALUES("8","20447","5","2016-12-21 09:54:03","100","");
INSERT INTO me_ruta_exp VALUES("9","20340","5","2016-12-21 11:01:43","6","");
INSERT INTO me_ruta_exp VALUES("10","20213","5","2016-12-22 09:40:56","100","");
INSERT INTO me_ruta_exp VALUES("11","20379","5","2016-12-22 09:44:37","100","");
INSERT INTO me_ruta_exp VALUES("12","20372","5","2016-12-22 09:52:45","100","");
INSERT INTO me_ruta_exp VALUES("13","20332","5","2016-12-22 10:02:07","6","");
INSERT INTO me_ruta_exp VALUES("14","20341","5","2016-12-22 10:11:51","6","");
INSERT INTO me_ruta_exp VALUES("15","20423","5","2016-12-22 10:50:05","3","");
INSERT INTO me_ruta_exp VALUES("16","18355","5","2016-12-22 11:06:56","3","");
INSERT INTO me_ruta_exp VALUES("17","20471","5","2016-12-26 10:17:04","2","");
INSERT INTO me_ruta_exp VALUES("18","20472","5","2016-12-26 11:24:55","100","");
INSERT INTO me_ruta_exp VALUES("19","20472","5","2016-12-26 11:25:41","100","");
INSERT INTO me_ruta_exp VALUES("20","20472","5","2016-12-26 11:26:42","100","");
INSERT INTO me_ruta_exp VALUES("21","20472","5","2016-12-26 11:37:32","101","");
INSERT INTO me_ruta_exp VALUES("22","19606","5","2016-12-26 12:15:41","103","A Secretaría Privada");
INSERT INTO me_ruta_exp VALUES("23","20473","5","2016-12-26 13:44:07","3","");
INSERT INTO me_ruta_exp VALUES("24","19906","5","2016-12-27 10:05:42","6","");
INSERT INTO me_ruta_exp VALUES("25","20475","5","2016-12-27 10:54:20","100","");
INSERT INTO me_ruta_exp VALUES("26","20474","5","2016-12-27 12:10:56","2","");
INSERT INTO me_ruta_exp VALUES("27","20389","5","2016-12-27 13:12:05","5","");
INSERT INTO me_ruta_exp VALUES("28","20265","5","2016-12-27 13:29:05","7","");
INSERT INTO me_ruta_exp VALUES("29","20383","5","2016-12-27 13:53:05","100","");
INSERT INTO me_ruta_exp VALUES("30","20381","5","2016-12-27 13:56:11","100","");
INSERT INTO me_ruta_exp VALUES("31","20213","5","2016-12-27 13:58:48","100","");
INSERT INTO me_ruta_exp VALUES("32","20379","5","2016-12-27 14:02:00","100","");
INSERT INTO me_ruta_exp VALUES("33","19160","5","2016-12-27 14:58:36","3","");
INSERT INTO me_ruta_exp VALUES("34","20464","5","2016-12-27 15:05:56","3","");
INSERT INTO me_ruta_exp VALUES("35","19805","5","2016-12-27 15:10:55","3","");
INSERT INTO me_ruta_exp VALUES("36","20476","5","2016-12-28 09:44:49","100","");
INSERT INTO me_ruta_exp VALUES("37","20477","5","2016-12-28 09:50:39","100","");
INSERT INTO me_ruta_exp VALUES("38","20478","5","2016-12-28 09:57:59","100","");
INSERT INTO me_ruta_exp VALUES("39","20479","5","2016-12-28 10:01:06","100","");
INSERT INTO me_ruta_exp VALUES("40","20480","5","2016-12-28 10:09:36","100","");
INSERT INTO me_ruta_exp VALUES("41","20481","5","2016-12-28 10:12:56","100","");
INSERT INTO me_ruta_exp VALUES("42","20482","5","2016-12-28 10:17:10","100","");
INSERT INTO me_ruta_exp VALUES("43","20483","5","2016-12-28 10:21:01","100","");
INSERT INTO me_ruta_exp VALUES("44","20484","5","2016-12-28 10:24:15","100","");
INSERT INTO me_ruta_exp VALUES("45","20485","5","2016-12-28 10:44:04","100","");
INSERT INTO me_ruta_exp VALUES("46","18213","5","2016-12-28 11:23:37","6","");
INSERT INTO me_ruta_exp VALUES("47","20427","5","2016-12-28 11:34:49","3","");
INSERT INTO me_ruta_exp VALUES("48","20486","5","2016-12-28 12:12:51","2","");
INSERT INTO me_ruta_exp VALUES("49","20487","5","2016-12-29 09:54:33","5","");
INSERT INTO me_ruta_exp VALUES("50","20379","5","2016-12-30 09:36:57","100","");
INSERT INTO me_ruta_exp VALUES("51","20351","5","2016-12-30 09:52:41","100","");
INSERT INTO me_ruta_exp VALUES("52","19861","5","2016-12-30 09:58:17","100","");
INSERT INTO me_ruta_exp VALUES("53","20488","5","2016-12-30 10:45:44","100","");
INSERT INTO me_ruta_exp VALUES("54","20489","5","2016-12-30 10:52:07","100","");
INSERT INTO me_ruta_exp VALUES("55","20490","5","2016-12-30 10:56:19","100","");
INSERT INTO me_ruta_exp VALUES("56","20491","5","2016-12-30 11:38:42","3","");
INSERT INTO me_ruta_exp VALUES("57","20492","5","2016-12-30 11:53:59","3","");
INSERT INTO me_ruta_exp VALUES("58","20493","5","2017-01-02 10:19:57","3","");
INSERT INTO me_ruta_exp VALUES("59","20494","5","2017-01-02 12:00:49","101","");
INSERT INTO me_ruta_exp VALUES("60","20492","5","2017-01-02 12:32:26","102","");
INSERT INTO me_ruta_exp VALUES("61","19805","5","2017-01-02 12:33:08","102","");
INSERT INTO me_ruta_exp VALUES("62","20495","5","2017-01-02 13:53:37","3","");
INSERT INTO me_ruta_exp VALUES("63","20496","5","2017-01-03 10:28:08","3","");
INSERT INTO me_ruta_exp VALUES("64","20497","5","2017-01-03 10:33:55","3","");
INSERT INTO me_ruta_exp VALUES("65","20498","5","2017-01-03 10:41:05","1","");
INSERT INTO me_ruta_exp VALUES("66","20499","5","2017-01-03 10:44:32","3","");
INSERT INTO me_ruta_exp VALUES("67","15270","5","2017-01-03 11:18:39","2","");
INSERT INTO me_ruta_exp VALUES("68","20454","5","2017-01-03 11:44:10","3","");
INSERT INTO me_ruta_exp VALUES("69","20413","5","2017-01-03 11:54:38","11","");
INSERT INTO me_ruta_exp VALUES("70","20233","5","2017-01-04 10:15:03","100","");
INSERT INTO me_ruta_exp VALUES("71","20054","5","2017-01-04 10:17:13","100","");
INSERT INTO me_ruta_exp VALUES("72","19861","5","2017-01-04 10:18:55","100","");
INSERT INTO me_ruta_exp VALUES("73","20275","5","2017-01-04 10:22:15","100","");
INSERT INTO me_ruta_exp VALUES("74","20240","5","2017-01-04 10:24:55","100","");
INSERT INTO me_ruta_exp VALUES("75","20214","5","2017-01-04 10:34:47","100","");
INSERT INTO me_ruta_exp VALUES("76","20271","5","2017-01-04 10:37:16","100","");
INSERT INTO me_ruta_exp VALUES("77","20054","5","2017-01-04 10:40:45","2","");
INSERT INTO me_ruta_exp VALUES("78","20393","5","2017-01-05 09:20:13","100","");
INSERT INTO me_ruta_exp VALUES("79","20500","5","2017-01-05 09:33:14","5","");
INSERT INTO me_ruta_exp VALUES("80","20501","5","2017-01-05 10:15:39","100","");
INSERT INTO me_ruta_exp VALUES("81","20502","5","2017-01-05 10:25:25","5","");
INSERT INTO me_ruta_exp VALUES("82","20503","5","2017-01-05 10:25:56","5","");
INSERT INTO me_ruta_exp VALUES("83","20437","5","2017-01-05 12:26:57","2","");
INSERT INTO me_ruta_exp VALUES("84","20504","5","2017-01-06 10:37:09","100","");
INSERT INTO me_ruta_exp VALUES("85","20505","5","2017-01-06 10:45:45","100","");
INSERT INTO me_ruta_exp VALUES("86","20506","5","2017-01-06 12:58:49","2","");
INSERT INTO me_ruta_exp VALUES("87","20507","5","2017-01-06 13:10:10","2","");
INSERT INTO me_ruta_exp VALUES("88","20508","5","2017-01-09 11:57:36","100","");
INSERT INTO me_ruta_exp VALUES("89","20509","5","2017-01-09 12:03:43","100","");
INSERT INTO me_ruta_exp VALUES("90","20510","5","2017-01-09 12:19:04","5","");
INSERT INTO me_ruta_exp VALUES("91","20351","5","2017-01-10 12:15:54","100","");
INSERT INTO me_ruta_exp VALUES("92","20511","5","2017-01-10 12:37:08","2","");
INSERT INTO me_ruta_exp VALUES("93","20512","5","2017-01-11 09:19:15","2","");
INSERT INTO me_ruta_exp VALUES("94","20513","5","2017-01-11 10:23:15","6","");
INSERT INTO me_ruta_exp VALUES("95","20514","5","2017-01-11 10:34:14","3","");
INSERT INTO me_ruta_exp VALUES("96","20515","5","2017-01-11 10:51:32","3","");
INSERT INTO me_ruta_exp VALUES("97","20516","5","2017-01-11 10:57:43","11","");
INSERT INTO me_ruta_exp VALUES("98","20517","5","2017-01-11 11:07:49","5","");
INSERT INTO me_ruta_exp VALUES("99","20405","5","2017-01-12 09:35:50","100","");
INSERT INTO me_ruta_exp VALUES("100","20502","5","2017-01-12 09:49:16","5","");
INSERT INTO me_ruta_exp VALUES("101","20518","5","2017-01-12 10:12:42","100","");
INSERT INTO me_ruta_exp VALUES("102","20519","5","2017-01-17 09:29:38","3","");
INSERT INTO me_ruta_exp VALUES("103","20520","5","2017-01-17 09:31:41","2","");
INSERT INTO me_ruta_exp VALUES("104","20521","5","2017-01-17 09:33:07","3","");
INSERT INTO me_ruta_exp VALUES("105","20522","5","2017-01-17 10:28:37","7","");
INSERT INTO me_ruta_exp VALUES("106","20523","5","2017-01-17 10:41:49","3","");
INSERT INTO me_ruta_exp VALUES("107","20524","5","2017-01-17 10:51:27","5","");
INSERT INTO me_ruta_exp VALUES("108","20304","5","2017-01-17 11:29:35","100","");
INSERT INTO me_ruta_exp VALUES("109","20508","5","2017-01-17 11:33:42","100","");
INSERT INTO me_ruta_exp VALUES("110","20525","5","2017-01-17 11:46:41","3","");
INSERT INTO me_ruta_exp VALUES("111","19803","5","2017-01-17 13:36:05","3","");
INSERT INTO me_ruta_exp VALUES("112","20405","5","2017-01-18 11:05:08","103","A Dirección de Personal");
INSERT INTO me_ruta_exp VALUES("113","20526","5","2017-01-18 11:56:45","3","");
INSERT INTO me_ruta_exp VALUES("114","20527","5","2017-01-18 12:27:06","2","");
INSERT INTO me_ruta_exp VALUES("115","20528","5","2017-01-18 12:39:06","3","");
INSERT INTO me_ruta_exp VALUES("116","20529","5","2017-01-18 13:10:28","3","");
INSERT INTO me_ruta_exp VALUES("117","20530","5","2017-01-18 14:14:50","5","");
INSERT INTO me_ruta_exp VALUES("118","20457","5","2017-01-18 14:26:01","2","");
INSERT INTO me_ruta_exp VALUES("119","20372","5","2017-01-19 09:40:51","100","");
INSERT INTO me_ruta_exp VALUES("120","20531","5","2017-01-19 10:34:17","5","");
INSERT INTO me_ruta_exp VALUES("121","18428","5","2017-01-20 09:22:10","3","");
INSERT INTO me_ruta_exp VALUES("122","20449","5","2017-01-20 09:31:13","3","");
INSERT INTO me_ruta_exp VALUES("123","19398","5","2017-01-23 10:23:44","103","A Dirección de Concesiones");
INSERT INTO me_ruta_exp VALUES("124","20532","5","2017-01-23 11:45:58","3","");
INSERT INTO me_ruta_exp VALUES("125","20533","5","2017-01-23 11:58:49","6","");
INSERT INTO me_ruta_exp VALUES("126","20534","5","2017-01-23 12:23:13","1","");
INSERT INTO me_ruta_exp VALUES("127","20383","5","2017-01-23 12:55:21","2","");
INSERT INTO me_ruta_exp VALUES("128","20381","5","2017-01-23 13:06:25","2","");
INSERT INTO me_ruta_exp VALUES("129","20535","5","2017-01-23 13:20:14","2","");
INSERT INTO me_ruta_exp VALUES("130","20495","5","2017-01-24 09:21:50","103","A Dirección de Gestión Ambiental");
INSERT INTO me_ruta_exp VALUES("131","20510","5","2017-01-24 09:58:08","5","");
INSERT INTO me_ruta_exp VALUES("132","20536","5","2017-01-24 10:11:31","100","");
INSERT INTO me_ruta_exp VALUES("133","20537","5","2017-01-24 10:22:03","2","");
INSERT INTO me_ruta_exp VALUES("134","20495","5","2017-01-24 11:09:08","3","");
INSERT INTO me_ruta_exp VALUES("135","20538","5","2017-01-24 11:30:21","100","");
INSERT INTO me_ruta_exp VALUES("136","20539","5","2017-01-24 13:55:15","2","");
INSERT INTO me_ruta_exp VALUES("137","20540","5","2017-01-25 09:33:45","2","");
INSERT INTO me_ruta_exp VALUES("138","20536","5","2017-01-25 10:54:40","103","A Dirección de Presupuesto");
INSERT INTO me_ruta_exp VALUES("139","20541","5","2017-01-25 12:31:50","3","");
INSERT INTO me_ruta_exp VALUES("140","20509","5","2017-01-25 12:41:01","100","");
INSERT INTO me_ruta_exp VALUES("141","20504","5","2017-01-25 13:10:07","100","");
INSERT INTO me_ruta_exp VALUES("142","20505","5","2017-01-25 13:10:53","100","");
INSERT INTO me_ruta_exp VALUES("143","20536","5","2017-01-25 13:56:28","100","");
INSERT INTO me_ruta_exp VALUES("144","20542","5","2017-01-26 10:04:47","2","");
INSERT INTO me_ruta_exp VALUES("145","20463","5","2017-01-26 10:15:17","100","");
INSERT INTO me_ruta_exp VALUES("146","20543","5","2017-01-26 11:22:48","100","");
INSERT INTO me_ruta_exp VALUES("147","20543","5","2017-01-26 11:33:19","103","A Dirección de Personal");
INSERT INTO me_ruta_exp VALUES("148","20544","5","2017-01-26 12:17:08","100","");
INSERT INTO me_ruta_exp VALUES("149","20327","5","2017-01-26 12:56:13","6","");
INSERT INTO me_ruta_exp VALUES("150","12266","5","2017-01-27 10:03:58","3","");
INSERT INTO me_ruta_exp VALUES("151","11134","5","2017-01-27 10:15:56","3","");
INSERT INTO me_ruta_exp VALUES("152","20545","5","2017-01-27 11:45:31","100","");
INSERT INTO me_ruta_exp VALUES("153","20546","5","2017-01-27 11:57:21","100","");
INSERT INTO me_ruta_exp VALUES("154","20547","5","2017-01-27 12:05:00","100","");
INSERT INTO me_ruta_exp VALUES("155","20361","5","2017-01-27 13:52:55","1","");
INSERT INTO me_ruta_exp VALUES("156","20421","5","2017-01-27 14:17:25","1","");
INSERT INTO me_ruta_exp VALUES("157","20548","5","2017-01-30 09:42:41","100","");
INSERT INTO me_ruta_exp VALUES("158","20549","5","2017-01-30 09:43:14","100","");
INSERT INTO me_ruta_exp VALUES("159","20351","5","2017-01-30 10:13:22","100","");
INSERT INTO me_ruta_exp VALUES("160","20351","5","2017-01-30 10:15:58","2","");
INSERT INTO me_ruta_exp VALUES("161","20550","5","2017-01-30 11:35:34","100","");
INSERT INTO me_ruta_exp VALUES("162","19814","5","2017-01-30 12:17:41","2","");
INSERT INTO me_ruta_exp VALUES("163","20404","5","2017-01-30 12:32:48","2","");
INSERT INTO me_ruta_exp VALUES("164","20405","5","2017-01-31 09:16:33","100","");
INSERT INTO me_ruta_exp VALUES("165","12061","5","2017-01-31 10:58:45","10","");
INSERT INTO me_ruta_exp VALUES("166","19872","5","2017-01-31 11:04:33","3","");
INSERT INTO me_ruta_exp VALUES("167","20551","5","2017-01-31 11:43:12","2","");
INSERT INTO me_ruta_exp VALUES("168","20415","5","2017-01-31 12:02:23","2","");
INSERT INTO me_ruta_exp VALUES("169","20552","5","2017-01-31 12:33:21","2","");
INSERT INTO me_ruta_exp VALUES("170","20265","5","2017-01-31 13:26:35","103","A Secretaría Privada");
INSERT INTO me_ruta_exp VALUES("171","20536","5","2017-02-01 09:34:31","100","");
INSERT INTO me_ruta_exp VALUES("172","20553","5","2017-02-01 10:51:07","100","");
INSERT INTO me_ruta_exp VALUES("173","20554","5","2017-02-01 10:58:31","103","");
INSERT INTO me_ruta_exp VALUES("174","20543","5","2017-02-01 11:42:20","100","");
INSERT INTO me_ruta_exp VALUES("175","20555","5","2017-02-01 12:37:47","3","");
INSERT INTO me_ruta_exp VALUES("176","20556","5","2017-02-02 12:43:31","2","");
INSERT INTO me_ruta_exp VALUES("177","20504","5","2017-02-03 09:53:33","100","");
INSERT INTO me_ruta_exp VALUES("178","20505","5","2017-02-03 09:57:11","100","");
INSERT INTO me_ruta_exp VALUES("179","20557","5","2017-02-03 10:14:28","7","");
INSERT INTO me_ruta_exp VALUES("180","20558","5","2017-02-03 10:22:23","100","");
INSERT INTO me_ruta_exp VALUES("181","20432","5","2017-02-03 12:17:28","5","");
INSERT INTO me_ruta_exp VALUES("182","20548","5","2017-02-03 13:05:52","100","");
INSERT INTO me_ruta_exp VALUES("183","20494","5","2017-02-03 13:06:12","100","");
INSERT INTO me_ruta_exp VALUES("184","20559","5","2017-02-03 13:17:57","100","");
INSERT INTO me_ruta_exp VALUES("185","20560","5","2017-02-06 10:07:55","100","");
INSERT INTO me_ruta_exp VALUES("186","20560","5","2017-02-06 10:31:05","103","A Dirección de Personal");
INSERT INTO me_ruta_exp VALUES("187","20183","5","2017-02-06 10:52:44","2","");
INSERT INTO me_ruta_exp VALUES("188","20538","5","2017-02-06 10:59:02","100","");
INSERT INTO me_ruta_exp VALUES("189","20518","5","2017-02-06 10:59:20","100","");
INSERT INTO me_ruta_exp VALUES("190","20545","5","2017-02-06 10:59:40","100","");
INSERT INTO me_ruta_exp VALUES("191","12968","5","2017-02-06 11:08:33","3","");
INSERT INTO me_ruta_exp VALUES("192","12945","5","2017-02-06 11:16:02","3","");
INSERT INTO me_ruta_exp VALUES("193","12773","5","2017-02-06 11:23:29","3","");
INSERT INTO me_ruta_exp VALUES("194","20559","5","2017-02-06 12:11:17","103","A Secretaría Política Económica y Finanzas Públicas");
INSERT INTO me_ruta_exp VALUES("195","20372","5","2017-02-06 13:28:35","2","");
INSERT INTO me_ruta_exp VALUES("196","20535","5","2017-02-07 09:41:56","2","");
INSERT INTO me_ruta_exp VALUES("197","18434","5","2017-02-07 13:29:23","5","");
INSERT INTO me_ruta_exp VALUES("198","20046","5","2017-02-08 10:07:28","2","");
INSERT INTO me_ruta_exp VALUES("199","20561","5","2017-02-08 10:55:10","5","");
INSERT INTO me_ruta_exp VALUES("200","20562","5","2017-02-09 10:04:16","3","");
INSERT INTO me_ruta_exp VALUES("201","20563","5","2017-02-09 10:09:00","3","");
INSERT INTO me_ruta_exp VALUES("202","20512","5","2017-02-09 12:28:07","100","");
INSERT INTO me_ruta_exp VALUES("203","20502","5","2017-02-09 12:54:02","5","");
INSERT INTO me_ruta_exp VALUES("204","20517","5","2017-02-09 12:57:08","5","");
INSERT INTO me_ruta_exp VALUES("205","20487","5","2017-02-09 12:59:48","5","");
INSERT INTO me_ruta_exp VALUES("206","20549","5","2017-02-09 13:03:05","5","");
INSERT INTO me_ruta_exp VALUES("207","20455","5","2017-02-09 13:07:25","5","");
INSERT INTO me_ruta_exp VALUES("208","14460","5","2017-02-09 13:56:42","2","");
INSERT INTO me_ruta_exp VALUES("209","20564","5","2017-02-10 09:28:46","3","");
INSERT INTO me_ruta_exp VALUES("210","20405","5","2017-02-10 11:05:56","100","");
INSERT INTO me_ruta_exp VALUES("211","19670","5","2017-02-10 11:10:41","100","");
INSERT INTO me_ruta_exp VALUES("212","20494","5","2017-02-10 12:21:46","100","");
INSERT INTO me_ruta_exp VALUES("213","20542","5","2017-02-13 11:20:54","2","");
INSERT INTO me_ruta_exp VALUES("214","14090","5","2017-02-13 13:11:52","3","");
INSERT INTO me_ruta_exp VALUES("215","20565","5","2017-02-13 13:32:51","2","");
INSERT INTO me_ruta_exp VALUES("216","20566","5","2017-02-13 13:45:38","10","");
INSERT INTO me_ruta_exp VALUES("217","20560","5","2017-02-14 11:07:34","100","");
INSERT INTO me_ruta_exp VALUES("218","17414","5","2017-02-14 12:21:58","3","");
INSERT INTO me_ruta_exp VALUES("219","17414","5","2017-02-14 12:23:10","103","A Dirección de Gestión Ambiental");
INSERT INTO me_ruta_exp VALUES("220","20567","5","2017-02-15 09:31:05","10","");
INSERT INTO me_ruta_exp VALUES("221","20568","5","2017-02-15 09:47:18","10","");
INSERT INTO me_ruta_exp VALUES("222","20569","5","2017-02-15 10:06:02","10","");
INSERT INTO me_ruta_exp VALUES("223","14507","5","2017-02-15 12:42:27","2","");
INSERT INTO me_ruta_exp VALUES("224","20570","5","2017-02-16 10:06:33","6","");
INSERT INTO me_ruta_exp VALUES("225","20571","5","2017-02-16 10:18:57","1","");
INSERT INTO me_ruta_exp VALUES("226","20572","5","2017-02-16 10:47:26","100","");
INSERT INTO me_ruta_exp VALUES("227","20573","5","2017-02-16 14:05:09","2","");
INSERT INTO me_ruta_exp VALUES("228","20574","5","2017-02-17 09:24:06","3","");
INSERT INTO me_ruta_exp VALUES("229","20575","5","2017-02-17 09:31:25","3","");
INSERT INTO me_ruta_exp VALUES("230","20466","5","2017-02-17 10:19:03","101","");
INSERT INTO me_ruta_exp VALUES("231","20576","5","2017-02-17 11:50:54","5","");
INSERT INTO me_ruta_exp VALUES("232","20501","5","2017-02-17 12:10:09","100","");
INSERT INTO me_ruta_exp VALUES("233","20492","5","2017-02-17 12:15:49","3","");
INSERT INTO me_ruta_exp VALUES("234","17414","5","2017-02-17 12:40:31","3","");
INSERT INTO me_ruta_exp VALUES("235","20577","5","2017-02-17 12:57:47","2","");
INSERT INTO me_ruta_exp VALUES("236","20545","5","2017-02-20 10:08:19","100","");
INSERT INTO me_ruta_exp VALUES("237","20518","5","2017-02-20 10:09:04","100","");
INSERT INTO me_ruta_exp VALUES("238","20538","5","2017-02-20 10:10:20","100","");
INSERT INTO me_ruta_exp VALUES("239","20578","5","2017-02-20 10:39:50","3","");
INSERT INTO me_ruta_exp VALUES("240","20524","5","2017-02-20 11:01:51","5","");
INSERT INTO me_ruta_exp VALUES("241","20530","5","2017-02-20 11:09:34","5","");
INSERT INTO me_ruta_exp VALUES("242","20579","5","2017-02-20 11:25:09","100","");
INSERT INTO me_ruta_exp VALUES("243","20290","5","2017-02-21 09:47:14","2","");
INSERT INTO me_ruta_exp VALUES("244","20290","5","2017-02-21 09:47:44","103","A Dirección de Personal");
INSERT INTO me_ruta_exp VALUES("245","20580","5","2017-02-21 10:37:05","1","");
INSERT INTO me_ruta_exp VALUES("246","20536","5","2017-02-21 10:52:03","2","");
INSERT INTO me_ruta_exp VALUES("247","20581","5","2017-02-21 11:04:24","2","");
INSERT INTO me_ruta_exp VALUES("248","20582","5","2017-02-21 11:11:11","2","");
INSERT INTO me_ruta_exp VALUES("249","20583","5","2017-02-21 11:20:44","2","");
INSERT INTO me_ruta_exp VALUES("250","20584","5","2017-02-21 11:29:48","2","");
INSERT INTO me_ruta_exp VALUES("251","20585","5","2017-02-21 11:49:13","2","");
INSERT INTO me_ruta_exp VALUES("252","20586","5","2017-02-21 12:05:53","2","");
INSERT INTO me_ruta_exp VALUES("253","20587","5","2017-02-21 12:20:37","2","");
INSERT INTO me_ruta_exp VALUES("254","17188","5","2017-02-21 12:41:45","3","");
INSERT INTO me_ruta_exp VALUES("255","16449","5","2017-02-21 12:56:52","3","");
INSERT INTO me_ruta_exp VALUES("256","15913","5","2017-02-21 13:04:07","3","");
INSERT INTO me_ruta_exp VALUES("257","17363","5","2017-02-21 13:12:30","3","");
INSERT INTO me_ruta_exp VALUES("258","18969","5","2017-02-21 13:22:00","3","");
INSERT INTO me_ruta_exp VALUES("259","20588","5","2017-02-22 10:18:54","5","");
INSERT INTO me_ruta_exp VALUES("260","20589","5","2017-02-22 10:59:32","2","");
INSERT INTO me_ruta_exp VALUES("261","20590","5","2017-02-22 11:01:10","10","");
INSERT INTO me_ruta_exp VALUES("262","13249","5","2017-02-22 11:02:31","3","");
INSERT INTO me_ruta_exp VALUES("263","20591","5","2017-02-22 12:09:45","1","");
INSERT INTO me_ruta_exp VALUES("264","16011","3","2017-02-22 17:10:26","11","Porque se me canta");
INSERT INTO me_ruta_exp VALUES("265","16011","3","2017-02-22 17:11:45","4","Aca esta");
INSERT INTO me_ruta_exp VALUES("266","16011","3","2017-02-22 17:13:57","102","");
INSERT INTO me_ruta_exp VALUES("267","20393","5","2017-02-23 09:11:58","100","");
INSERT INTO me_ruta_exp VALUES("268","20592","5","2017-02-23 09:46:21","6","");
INSERT INTO me_ruta_exp VALUES("269","20593","5","2017-02-23 11:08:08","5","");
INSERT INTO me_ruta_exp VALUES("270","20594","5","2017-02-23 11:33:36","6","");
INSERT INTO me_ruta_exp VALUES("271","20595","5","2017-02-24 10:45:56","1","");
INSERT INTO me_ruta_exp VALUES("272","13383","5","2017-02-24 11:23:56","3","");
INSERT INTO me_ruta_exp VALUES("273","20596","5","2017-03-01 12:43:36","6","");
INSERT INTO me_ruta_exp VALUES("274","20597","5","2017-03-01 12:52:59","3","");
INSERT INTO me_ruta_exp VALUES("275","20598","5","2017-03-01 13:06:00","6","");
INSERT INTO me_ruta_exp VALUES("276","20599","5","2017-03-01 14:28:05","2","");
INSERT INTO me_ruta_exp VALUES("277","20600","5","2017-03-02 11:25:07","1","");
INSERT INTO me_ruta_exp VALUES("278","20424","5","2017-03-03 10:50:22","3","");
INSERT INTO me_ruta_exp VALUES("279","20295","5","2017-03-07 09:23:55","10","");
INSERT INTO me_ruta_exp VALUES("280","20472","5","2017-03-07 09:40:35","100","");
INSERT INTO me_ruta_exp VALUES("281","20447","5","2017-03-07 10:12:26","100","");
INSERT INTO me_ruta_exp VALUES("282","19884","5","2017-03-07 11:39:04","1","");
INSERT INTO me_ruta_exp VALUES("283","20601","5","2017-03-07 11:48:51","1","");
INSERT INTO me_ruta_exp VALUES("284","20556","5","2017-03-07 13:31:58","2","");
INSERT INTO me_ruta_exp VALUES("285","20602","5","2017-03-07 14:16:11","10","");
INSERT INTO me_ruta_exp VALUES("286","20593","5","2017-03-08 11:30:51","5","");
INSERT INTO me_ruta_exp VALUES("287","20457","5","2017-03-08 12:09:29","103","A Subsecretaría de Política Económica y Finanzas Públicas");
INSERT INTO me_ruta_exp VALUES("288","20603","5","2017-03-09 09:44:20","3","");
INSERT INTO me_ruta_exp VALUES("289","20573","5","2017-03-09 13:39:00","2","");
INSERT INTO me_ruta_exp VALUES("290","20604","5","2017-03-09 13:49:54","3","");
INSERT INTO me_ruta_exp VALUES("291","20605","5","2017-03-10 10:29:47","3","");
INSERT INTO me_ruta_exp VALUES("292","18245","5","2017-03-10 12:55:58","1","");
INSERT INTO me_ruta_exp VALUES("293","20573","5","2017-03-10 13:10:24","103","A Secretaría General");
INSERT INTO me_ruta_exp VALUES("294","17631","5","2017-03-10 14:03:31","3","");
INSERT INTO me_ruta_exp VALUES("295","20606","5","2017-03-10 14:31:21","3","");
INSERT INTO me_ruta_exp VALUES("296","20607","5","2017-03-10 14:39:48","100","");
INSERT INTO me_ruta_exp VALUES("297","20608","5","2017-03-13 10:13:31","3","");
INSERT INTO me_ruta_exp VALUES("298","20609","5","2017-03-14 11:51:01","2","");
INSERT INTO me_ruta_exp VALUES("299","20610","5","2017-03-14 11:56:19","10","");
INSERT INTO me_ruta_exp VALUES("300","20611","5","2017-03-14 12:05:59","3","");
INSERT INTO me_ruta_exp VALUES("301","20612","5","2017-03-14 12:11:58","3","");
INSERT INTO me_ruta_exp VALUES("302","20613","5","2017-03-14 12:19:00","10","");
INSERT INTO me_ruta_exp VALUES("303","20447","5","2017-03-14 12:52:05","2","");
INSERT INTO me_ruta_exp VALUES("304","20381","5","2017-03-14 12:53:50","2","");
INSERT INTO me_ruta_exp VALUES("305","20614","5","2017-03-14 13:29:52","2","");
INSERT INTO me_ruta_exp VALUES("306","20615","5","2017-03-15 09:36:36","7","");
INSERT INTO me_ruta_exp VALUES("307","20616","5","2017-03-15 11:10:30","3","");
INSERT INTO me_ruta_exp VALUES("308","20501","5","2017-03-15 11:41:26","100","");
INSERT INTO me_ruta_exp VALUES("309","20610","5","2017-03-15 11:45:29","10","");
INSERT INTO me_ruta_exp VALUES("310","20617","5","2017-03-15 12:10:23","3","");
INSERT INTO me_ruta_exp VALUES("311","20405","5","2017-03-15 13:55:18","100","");
INSERT INTO me_ruta_exp VALUES("312","20618","5","2017-03-20 10:21:53","3","");
INSERT INTO me_ruta_exp VALUES("313","20619","5","2017-03-20 10:37:38","2","");
INSERT INTO me_ruta_exp VALUES("314","20620","5","2017-03-20 12:42:56","100","");
INSERT INTO me_ruta_exp VALUES("315","20405","5","2017-03-20 13:06:46","100","");
INSERT INTO me_ruta_exp VALUES("316","20621","5","2017-03-21 10:23:28","3","");
INSERT INTO me_ruta_exp VALUES("317","20622","5","2017-03-21 11:14:17","102","");
INSERT INTO me_ruta_exp VALUES("318","20576","5","2017-03-21 13:09:06","5","");
INSERT INTO me_ruta_exp VALUES("319","20494","5","2017-03-21 13:15:42","100","");
INSERT INTO me_ruta_exp VALUES("320","20393","5","2017-03-21 13:19:46","2","");
INSERT INTO me_ruta_exp VALUES("321","20623","5","2017-03-21 13:54:47","9","");
INSERT INTO me_ruta_exp VALUES("322","20548","5","2017-03-22 09:29:32","100","");
INSERT INTO me_ruta_exp VALUES("323","20579","5","2017-03-22 09:29:51","100","");
INSERT INTO me_ruta_exp VALUES("324","20624","5","2017-03-23 10:16:01","5","");
INSERT INTO me_ruta_exp VALUES("325","20573","5","2017-03-23 13:50:25","2","");
INSERT INTO me_ruta_exp VALUES("326","20625","5","2017-03-27 11:11:47","3","");
INSERT INTO me_ruta_exp VALUES("327","20305","5","2017-03-28 09:29:49","2","");
INSERT INTO me_ruta_exp VALUES("328","20626","5","2017-03-29 09:41:21","2","");
INSERT INTO me_ruta_exp VALUES("329","20627","5","2017-03-29 09:54:34","2","");
INSERT INTO me_ruta_exp VALUES("330","20628","5","2017-03-29 10:29:38","3","");
INSERT INTO me_ruta_exp VALUES("331","20629","5","2017-03-29 11:53:31","6","");
INSERT INTO me_ruta_exp VALUES("332","20630","5","2017-03-29 13:15:33","3","");
INSERT INTO me_ruta_exp VALUES("333","20631","5","2017-03-29 13:20:54","5","");
INSERT INTO me_ruta_exp VALUES("334","20632","5","2017-03-30 10:18:59","5","");
INSERT INTO me_ruta_exp VALUES("335","20633","5","2017-03-30 11:57:31","3","");
INSERT INTO me_ruta_exp VALUES("336","20634","5","2017-03-31 09:55:46","2","");
INSERT INTO me_ruta_exp VALUES("337","20635","5","2017-03-31 10:05:58","2","");
INSERT INTO me_ruta_exp VALUES("338","20636","5","2017-03-31 10:18:08","2","");
INSERT INTO me_ruta_exp VALUES("339","20637","5","2017-03-31 10:34:55","2","");
INSERT INTO me_ruta_exp VALUES("340","20494","5","2017-04-03 09:43:58","100","");
INSERT INTO me_ruta_exp VALUES("341","20638","5","2017-04-03 10:10:02","6","");
INSERT INTO me_ruta_exp VALUES("342","20639","5","2017-04-03 10:35:17","2","");
INSERT INTO me_ruta_exp VALUES("343","20640","5","2017-04-03 10:48:00","2","");
INSERT INTO me_ruta_exp VALUES("344","20641","5","2017-04-03 14:03:41","3","");
INSERT INTO me_ruta_exp VALUES("345","20642","5","2017-04-04 10:04:05","2","");
INSERT INTO me_ruta_exp VALUES("346","20558","5","2017-04-04 12:36:34","100","");
INSERT INTO me_ruta_exp VALUES("347","20405","5","2017-04-05 11:23:45","2","");
INSERT INTO me_ruta_exp VALUES("348","20631","5","2017-04-05 11:30:08","5","");
INSERT INTO me_ruta_exp VALUES("349","20624","5","2017-04-05 11:37:46","5","");
INSERT INTO me_ruta_exp VALUES("350","20643","5","2017-04-05 12:03:27","10","");
INSERT INTO me_ruta_exp VALUES("351","20572","5","2017-04-05 12:27:20","100","");
INSERT INTO me_ruta_exp VALUES("352","20644","5","2017-04-06 09:37:55","3","");
INSERT INTO me_ruta_exp VALUES("353","20645","5","2017-04-06 10:11:38","100","");
INSERT INTO me_ruta_exp VALUES("354","20383","5","2017-04-07 09:21:28","2","");
INSERT INTO me_ruta_exp VALUES("355","20245","5","2017-04-07 10:52:22","10","");
INSERT INTO me_ruta_exp VALUES("356","20552","5","2017-04-07 11:20:00","103","A Secretaría de Política Económica y Finanzas Públicas");
INSERT INTO me_ruta_exp VALUES("357","20457","5","2017-04-07 13:25:18","2","");
INSERT INTO me_ruta_exp VALUES("358","14460","5","2017-04-10 10:16:34","2","");
INSERT INTO me_ruta_exp VALUES("359","20518","5","2017-04-10 10:30:11","100","");
INSERT INTO me_ruta_exp VALUES("360","20646","5","2017-04-10 10:59:56","100","");
INSERT INTO me_ruta_exp VALUES("361","20647","5","2017-04-10 12:53:25","2","");
INSERT INTO me_ruta_exp VALUES("362","20648","5","2017-04-10 13:12:44","2","");
INSERT INTO me_ruta_exp VALUES("363","20552","5","2017-04-10 13:27:06","2","");
INSERT INTO me_ruta_exp VALUES("364","20649","5","2017-04-11 09:32:23","2","");
INSERT INTO me_ruta_exp VALUES("365","20650","5","2017-04-11 09:49:57","2","");
INSERT INTO me_ruta_exp VALUES("366","20651","5","2017-04-11 10:02:55","2","");
INSERT INTO me_ruta_exp VALUES("367","20652","5","2017-04-11 11:08:53","2","");
INSERT INTO me_ruta_exp VALUES("368","20653","5","2017-04-11 11:18:11","2","");
INSERT INTO me_ruta_exp VALUES("369","20654","5","2017-04-11 11:31:29","2","");
INSERT INTO me_ruta_exp VALUES("370","20655","5","2017-04-11 12:31:43","1","");
INSERT INTO me_ruta_exp VALUES("371","20656","5","2017-04-11 13:47:54","2","");
INSERT INTO me_ruta_exp VALUES("372","20657","5","2017-04-12 09:43:06","2","");
INSERT INTO me_ruta_exp VALUES("373","20658","5","2017-04-12 09:54:06","2","");
INSERT INTO me_ruta_exp VALUES("374","20658","5","2017-04-12 09:54:08","2","");
INSERT INTO me_ruta_exp VALUES("375","20658","5","2017-04-12 09:54:12","2","");
INSERT INTO me_ruta_exp VALUES("376","20659","5","2017-04-12 10:03:11","2","");
INSERT INTO me_ruta_exp VALUES("377","20660","5","2017-04-12 12:36:10","2","");
INSERT INTO me_ruta_exp VALUES("378","20661","5","2017-04-18 10:54:05","6","");
INSERT INTO me_ruta_exp VALUES("379","20662","5","2017-04-18 11:06:40","6","");
INSERT INTO me_ruta_exp VALUES("380","20663","5","2017-04-18 11:20:04","6","");
INSERT INTO me_ruta_exp VALUES("381","20664","5","2017-04-18 11:28:34","100","");
INSERT INTO me_ruta_exp VALUES("382","20665","5","2017-04-18 11:36:26","100","");
INSERT INTO me_ruta_exp VALUES("383","20666","5","2017-04-18 12:13:30","2","");
INSERT INTO me_ruta_exp VALUES("384","20667","5","2017-04-18 12:32:41","2","");
INSERT INTO me_ruta_exp VALUES("385","20601","5","2017-04-18 12:53:04","1","");
INSERT INTO me_ruta_exp VALUES("386","20304","5","2017-04-18 12:57:11","100","");
INSERT INTO me_ruta_exp VALUES("387","19493","5","2017-04-18 13:01:30","2","");
INSERT INTO me_ruta_exp VALUES("388","19803","5","2017-04-18 13:07:58","3","");
INSERT INTO me_ruta_exp VALUES("389","20668","5","2017-04-19 13:48:40","2","");
INSERT INTO me_ruta_exp VALUES("390","19404","5","2017-04-20 09:27:31","103","A Dirección de Transporte");
INSERT INTO me_ruta_exp VALUES("391","19937","5","2017-04-20 10:11:24","103","A Dirección de Obras Privadas");
INSERT INTO me_ruta_exp VALUES("392","20669","5","2017-04-20 11:58:13","2","");
INSERT INTO me_ruta_exp VALUES("393","20670","5","2017-04-20 12:12:34","2","");
INSERT INTO me_ruta_exp VALUES("394","20671","5","2017-04-20 13:00:32","2","");
INSERT INTO me_ruta_exp VALUES("395","20672","5","2017-04-20 13:23:57","100","");
INSERT INTO me_ruta_exp VALUES("396","20673","5","2017-04-20 13:27:26","2","");
INSERT INTO me_ruta_exp VALUES("397","20674","5","2017-04-20 13:58:13","2","");
INSERT INTO me_ruta_exp VALUES("398","20675","5","2017-04-20 14:09:30","2","");
INSERT INTO me_ruta_exp VALUES("399","20676","5","2017-04-20 14:17:06","2","");
INSERT INTO me_ruta_exp VALUES("400","20505","5","2017-04-21 09:40:17","2","");
INSERT INTO me_ruta_exp VALUES("401","20623","5","2017-04-21 09:47:42","9","");
INSERT INTO me_ruta_exp VALUES("402","20574","5","2017-04-21 09:53:26","3","");
INSERT INTO me_ruta_exp VALUES("403","20677","5","2017-04-21 10:24:41","4","");
INSERT INTO me_ruta_exp VALUES("404","19662","5","2017-04-21 10:52:48","103","A Secretaría Privada");
INSERT INTO me_ruta_exp VALUES("405","20678","5","2017-04-21 11:41:08","100","");
INSERT INTO me_ruta_exp VALUES("406","20679","5","2017-04-21 11:45:12","100","");
INSERT INTO me_ruta_exp VALUES("407","20680","5","2017-04-21 14:07:25","5","");
INSERT INTO me_ruta_exp VALUES("408","18190","5","2017-04-21 14:27:34","8","");
INSERT INTO me_ruta_exp VALUES("409","20343","5","2017-04-21 14:34:45","10","");
INSERT INTO me_ruta_exp VALUES("410","20501","5","2017-04-24 09:32:25","100","");
INSERT INTO me_ruta_exp VALUES("411","20472","5","2017-04-24 09:32:49","100","");
INSERT INTO me_ruta_exp VALUES("412","20681","5","2017-04-24 09:44:23","10","");
INSERT INTO me_ruta_exp VALUES("413","20626","5","2017-04-24 09:54:44","103","A Secretaría de Política Económica y Finanzas Públicas");
INSERT INTO me_ruta_exp VALUES("414","20682","5","2017-04-24 11:06:01","2","");
INSERT INTO me_ruta_exp VALUES("415","20683","5","2017-04-24 11:37:28","6","");
INSERT INTO me_ruta_exp VALUES("416","20684","5","2017-04-24 13:32:19","5","");
INSERT INTO me_ruta_exp VALUES("417","20685","5","2017-04-25 10:25:42","3","");
INSERT INTO me_ruta_exp VALUES("418","20686","5","2017-04-25 11:47:10","100","");
INSERT INTO me_ruta_exp VALUES("419","20687","5","2017-04-25 13:07:31","100","");
INSERT INTO me_ruta_exp VALUES("420","20602","5","2017-04-26 13:52:57","10","");
INSERT INTO me_ruta_exp VALUES("421","20688","5","2017-04-27 09:57:55","6","");
INSERT INTO me_ruta_exp VALUES("422","20554","5","2017-04-27 10:09:16","2","");
INSERT INTO me_ruta_exp VALUES("423","20689","5","2017-04-27 10:54:16","3","");
INSERT INTO me_ruta_exp VALUES("424","20472","5","2017-04-27 12:40:57","2","");
INSERT INTO me_ruta_exp VALUES("425","20503","5","2017-04-27 15:12:40","100","");
INSERT INTO me_ruta_exp VALUES("426","20690","5","2017-04-28 10:02:57","100","");
INSERT INTO me_ruta_exp VALUES("427","20691","5","2017-04-28 10:04:31","100","");
INSERT INTO me_ruta_exp VALUES("428","18276","5","2017-05-02 09:37:22","6","");
INSERT INTO me_ruta_exp VALUES("429","20692","5","2017-05-02 09:55:44","10","");
INSERT INTO me_ruta_exp VALUES("430","20693","5","2017-05-02 10:10:35","4","");
INSERT INTO me_ruta_exp VALUES("431","20694","5","2017-05-02 10:10:57","4","");
INSERT INTO me_ruta_exp VALUES("432","20494","5","2017-05-02 12:36:27","2","");
INSERT INTO me_ruta_exp VALUES("433","20518","5","2017-05-02 12:36:52","2","");
INSERT INTO me_ruta_exp VALUES("434","20170003","3","2017-08-03 21:01:18","4","Para que lo vea Pablo");
INSERT INTO me_ruta_exp VALUES("436","20170005","3","2017-08-03 21:03:27","10","Se termino");
INSERT INTO me_ruta_exp VALUES("437","20150045","3","2017-08-04 12:18:23","5","ahi va");
INSERT INTO me_ruta_exp VALUES("438","20150001","18","2017-08-15 11:16:51","10","Por mi mismo");





CREATE TABLE `me_solicitantes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Tipo` smallint(6) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cuit` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO me_solicitantes VALUES("1","0","Favre Gorriti Benjamin","23-40851789-5","1555-1282","","");
INSERT INTO me_solicitantes VALUES("2","1","Favre Juan Cruz","","022714343","63 871","jcfavre@gmail.com");
INSERT INTO me_solicitantes VALUES("6","0","Gorriti Romina Itati","2327039664","02262551756","59 1610 dpto 2","rominagorriti@gmail.com");
INSERT INTO me_solicitantes VALUES("11","0","Chano Carpintier","","No lo da...","","");
INSERT INTO me_solicitantes VALUES("13","0","Jhon Doe Rules","27-29462664-4","45454545454","","");
INSERT INTO me_solicitantes VALUES("15","0","Kiko Man","","","","");





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
  `user_img` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_validate` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usuarios VALUES("3","Kave","luisfavre@gmail.com","$2y$10$jXUtS0lVjslXD.Liuh/ipewoRctHYZrEXspMmaBi.21YWgCXSt2Eu","1","avatar-zm.jpg","1");
INSERT INTO usuarios VALUES("12","Diego Ponce","diego@gmail.com","$2y$10$eRJ2EjjobH0RVdQb5yarvuH7vfiplt87PfN0p80u8.iFfx62mSL1O","2","","1");
INSERT INTO usuarios VALUES("18","Diego","dmpglobal@gmail.com","$2y$10$LjePr0kxTlCdBCVwIVHKK.xsyEe1byd46v9xcTqabaJj2vStIjzPq","2","","1");
INSERT INTO usuarios VALUES("17","Marcela","marcelagan02@gmail.com","$2y$10$1vihPacFN46KlH5rVVIJ/emmwTrUIsDccqs.MTr.LnIcHGkj0WAsC","2","","1");



