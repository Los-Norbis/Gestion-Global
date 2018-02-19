

CREATE TABLE `cargas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Precio` decimal(6,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO cargas VALUES("1","Soja Nueva","4000.00");
INSERT INTO cargas VALUES("2","Trigo","3200.00");
INSERT INTO cargas VALUES("4","Cebada Forrajera","1950.25");





CREATE TABLE `cartas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Numero` bigint(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Tr_Id` smallint(6) NOT NULL,
  `KgCarga` int(11) NOT NULL,
  `KgDescarga` int(11) NOT NULL,
  `KgDevolucion` int(11) NOT NULL,
  `Tarifa` decimal(6,2) NOT NULL,
  `Bonificacion` tinyint(4) NOT NULL,
  `TipoCarga` int(11) NOT NULL,
  `Origen` tinyint(4) NOT NULL,
  `Iva` tinyint(4) NOT NULL,
  `Fin` tinyint(4) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO cartas VALUES("13","7800001145","2016-10-02","8","31000","31000","0","90.00","15","2","100","1","1");
INSERT INTO cartas VALUES("15","963741","2016-10-19","8","36200","36120","0","88.00","10","1","80","1","0");
INSERT INTO cartas VALUES("16","74196322","2016-10-15","11","24500","24410","0","90.00","0","1","80","1","1");
INSERT INTO cartas VALUES("17","96325","2016-10-14","7","15000","15000","0","96.00","0","2","100","1","0");
INSERT INTO cartas VALUES("19","852963","2016-10-17","14","28000","27800","0","84.00","15","2","80","0","1");
INSERT INTO cartas VALUES("20","9998887771","2016-10-22","3","31500","31300","90","85.00","15","1","100","1","1");
INSERT INTO cartas VALUES("21","78945612388","2016-11-02","12","30000","29898","0","90.00","10","2","100","1","1");
INSERT INTO cartas VALUES("22","555555","2016-11-05","8","25000","25000","0","85.00","12","2","100","0","1");





CREATE TABLE `opciones` (
  `Id` tinyint(4) NOT NULL,
  `Gasoil` decimal(6,2) NOT NULL,
  `Nafta` decimal(6,2) NOT NULL,
  `Orden` mediumint(9) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO opciones VALUES("1","14.60","19.23","124");





CREATE TABLE `trans_cc` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Tipo` tinyint(4) NOT NULL,
  `CP_Id` mediumint(9) NOT NULL,
  `Tr_Id` smallint(6) NOT NULL,
  `Importe` decimal(10,2) NOT NULL,
  `Aux` smallint(6) NOT NULL,
  `Nota` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `Fin` tinyint(4) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO trans_cc VALUES("1","2016-09-21","4","22","8","450.00","0","","1");
INSERT INTO trans_cc VALUES("3","2016-09-17","2","13","8","1200.00","0","","1");
INSERT INTO trans_cc VALUES("10","2016-09-29","1","0","3","80.00","2","","0");
INSERT INTO trans_cc VALUES("11","2016-09-30","2","20","3","444.00","0","","1");
INSERT INTO trans_cc VALUES("12","2016-09-22","2","21","12","1566.00","0","","1");
INSERT INTO trans_cc VALUES("14","2016-09-21","3","0","12","560.00","0","","0");
INSERT INTO trans_cc VALUES("15","2016-10-12","1","13","8","20.00","1","","0");
INSERT INTO trans_cc VALUES("16","2016-10-11","1","22","8","18.00","2","2","1");
INSERT INTO trans_cc VALUES("17","2016-10-10","4","0","8","800.00","0","","0");
INSERT INTO trans_cc VALUES("18","2016-10-11","2","22","8","350.00","0","Seria lo que se lleva el tipo","1");
INSERT INTO trans_cc VALUES("19","2016-10-14","1","13","8","30.00","1","Le llene el tanque","0");
INSERT INTO trans_cc VALUES("21","2016-10-02","0","13","8","2869.51","0","# 7800001145 | Tarifa: $90,00 | Carga: Trigo 31000 kgs | Descarga: 31000 kgs | Bonif.: 15% | IVA: Si","1");
INSERT INTO trans_cc VALUES("23","2016-10-19","0","15","8","3141.45","0","# 963741 | Tarifa: $88,00 | Carga: Soja Nueva 36200 kgs | Descarga: 36120 kgs | Bonif.: 10% | IVA: Si","0");
INSERT INTO trans_cc VALUES("24","2016-10-12","2","16","11","1200.00","0","Estaba sin un mango","1");
INSERT INTO trans_cc VALUES("25","2016-10-13","1","0","11","50.00","1","","1");
INSERT INTO trans_cc VALUES("26","2016-10-15","0","16","11","2298.25","0","# 74196322 | Tarifa: $90,00 | Carga: 24500 kgs | Descarga: 24410 kgs | Bonif.: % | IVA: Si","1");
INSERT INTO trans_cc VALUES("27","2016-10-14","0","17","7","1742.40","0","# 96325 | Tarifa: $96,00 | Carga: Trigo 15000 kgs | Descarga: 15000 kgs | IVA: Si","0");
INSERT INTO trans_cc VALUES("29","2016-10-17","0","19","14","1344.92","0","# 852963 | Tarifa: $84,00 | Carga: Trigo 28000 kgs | Descarga: 27800 kgs | Bonif.: 15% | IVA: No","1");
INSERT INTO trans_cc VALUES("32","2016-10-22","2","17","7","450.00","0","Nada man","0");
INSERT INTO trans_cc VALUES("34","2016-10-27","3","19","14","855.00","0","","1");
INSERT INTO trans_cc VALUES("36","2016-10-22","5","16","11","1098.25","0","Carta de Porte #74196322","1");
INSERT INTO trans_cc VALUES("37","2016-10-22","0","20","3","2296.32","0","# 9998887771 | Tarifa: $85,00 | Carga: Soja 31500 kgs | Descarga: 31300 kgs | Bonif.: 15% | IVA: Si","1");
INSERT INTO trans_cc VALUES("38","2016-11-02","1","21","12","50.00","1","","1");
INSERT INTO trans_cc VALUES("39","2016-11-02","0","21","12","2603.90","0","# 78945612388 | Tarifa: $90,00 | Carga: Trigo 30000 kgs | Descarga: 29898 kgs | Bonif.: 10% | IVA: Si","1");
INSERT INTO trans_cc VALUES("40","2016-11-02","5","21","12","307.90","0","Carta de Porte #78945612388","1");
INSERT INTO trans_cc VALUES("41","2016-11-02","3","0","12","1000.00","0","a 60 dias","0");
INSERT INTO trans_cc VALUES("42","2016-11-03","5","20","3","1852.32","0","Carta de Porte #9998887771 | Cheque 12568 Banco Nacion","1");
INSERT INTO trans_cc VALUES("43","2016-11-03","5","13","8","1669.51","0","Carta de Porte #7800001145","1");
INSERT INTO trans_cc VALUES("44","2016-11-05","0","22","8","1870.00","0","# 555555 | Tarifa: $85,00 | Carga: Trigo 25000 kgs | Descarga: 25000 kgs | Bonif.: 12% | IVA: No","1");
INSERT INTO trans_cc VALUES("45","2016-11-01","2","0","13","1500.00","0","Para probar","0");
INSERT INTO trans_cc VALUES("46","2016-11-11","3","0","7","1100.00","0","","0");
INSERT INTO trans_cc VALUES("47","2016-11-11","5","22","8","723.86","0","Carta de Porte #555555","1");
INSERT INTO trans_cc VALUES("48","2016-11-13","5","19","14","489.92","0","Carta de Porte #852963 | Un cheque a 20 dias #456789","1");
INSERT INTO trans_cc VALUES("49","2016-11-13","2","0","8","1400.00","0","Algo de plata para el finde","0");
INSERT INTO trans_cc VALUES("50","2016-11-12","3","0","8","1500.00","0","Mas plata","0");
INSERT INTO trans_cc VALUES("58","2016-11-13","1","0","8","135.00","1","","0");
INSERT INTO trans_cc VALUES("59","2016-11-13","1","0","8","122.00","1","","0");
INSERT INTO trans_cc VALUES("61","2016-11-13","1","0","8","124.00","1","","0");
INSERT INTO trans_cc VALUES("64","2016-11-13","1","0","8","62.00","2","","0");
INSERT INTO trans_cc VALUES("65","2016-11-13","1","0","8","145.00","1","","0");
INSERT INTO trans_cc VALUES("66","2016-11-13","1","0","8","50.00","2","","0");
INSERT INTO trans_cc VALUES("67","2016-11-09","1","0","11","45.00","1","","0");
INSERT INTO trans_cc VALUES("68","2016-11-14","1","0","12","210.00","1","","0");





CREATE TABLE `transportes` (
  `Id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cuit` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Placa1` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `Placa2` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO transportes VALUES("1","Favre Gorriti Benjamin","23-40851789-5","1555-1282","","");
INSERT INTO transportes VALUES("2","Favre Juan Cruz","","022714343","","");
INSERT INTO transportes VALUES("3","Ricardo Ruete","","02262 4875","","");
INSERT INTO transportes VALUES("6","Gorriti Romina Itati","","(02262) 15551756","","");
INSERT INTO transportes VALUES("7","Perez Juan Manuel","","423232","","");
INSERT INTO transportes VALUES("8","Gorriti Miguel","","02271434303","","");
INSERT INTO transportes VALUES("11","Chano Carpintier","","No lo da...","","");
INSERT INTO transportes VALUES("12","Gaston Zarate","23177692999","155556699","","");
INSERT INTO transportes VALUES("13","Jhon Doe Rules","27-29462664-4","45454545454","TVV 108","25ASE15");
INSERT INTO transportes VALUES("14","Luis de La Horca","","522325","","AS156RT");
INSERT INTO transportes VALUES("15","Kiko Man","","","TVV108","FT123AC");





CREATE TABLE `usuarios` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` tinyint(4) NOT NULL,
  `user_img` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO usuarios VALUES("3","Kave","luisfavre@gmail.com","$2y$10$NJaITWOQvNYithMn.MaRweWzb14P2sP50JQVfRGNjqtEXCYXhouQS","1","avatar-zm.jpg");
INSERT INTO usuarios VALUES("12","Diego","diego@gmail.com","$2y$10$um8U5grzXBTYtLKrFaqxpeAv7YmRD2HDXnS5lJQB4U2N8xBOnolna","3","");
INSERT INTO usuarios VALUES("10","Benjamin","benja@gmail.com","$2y$10$bEZiz9Q2xmWkSPl91zs8AOsbw52x16xiGbVhQInMdjEf2ZEbmi.xO","2","");
INSERT INTO usuarios VALUES("11","Romina","rominagorriti@gmail.com","$2y$10$9pcpOgnvFJyQRjRDhQP2I.pPea2rdzRM5hqKQi4KykjjjpTbbVcKS","2","");



