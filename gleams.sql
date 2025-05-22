/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gleams
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES
(1,'aretes'),
(2,'anillos'),
(3,'pulseras');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` text NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES
(1,'papu','3152504030','2025-05-15','papu@gmail.com','cll 40 #20-50 br mariscal',1,'1234'),
(2,'nuevo papu','32055903020','2025-05-15','nuevo@gmail.com','cll 40 #20-50 br mariscal',1,'$2y$12$90W8ymIFss6zaeHxH03uSewwKksvEjzcSJQBw.GOVzqKGeWchn57u'),
(3,'gaspacho','315504030','2025-05-15','gaspacho@gmail.com','cll 40 #20-50 br mariscal',1,'$2y$12$8E.iDwlkwQtVuCnOosjOAOT9EXa8t1HR.t40Pnsk0r9Sy0/ADrTjG'),
(4,'camello','3188092049','2025-05-15','camello@gmail.com','cll 30 4n-40 san pablo',1,'$2y$12$bqh7msGlFw2Q3SrTiAIRQOmb0bMQaZF41YTcJnjPBHsARxNk.NkcS'),
(5,'prueba','3188092040','2025-05-15','nose@gmail.com','cll 30 4n-40 san pablo',1,'$2y$12$Q0cv9P/5N0tlpj/g1IcSDumBKgFT.T8OdHldN1SYAhbnFNleToIfC'),
(7,'prueba','3188092040','2025-05-15','que@gmail.com','cll 30 4n-40 san pablo',1,'$2y$12$iRcWMhOrfuuo4jboEWPdGe6ZeSoOVcYoVow4I1m3XY9NAxd5a5N3e'),
(9,'otra prueba','3204492049','2025-05-15','ya@gmail.com','cll 30 4n-40 san pablo',1,'$2y$12$VsD/iFfsBPfNFeXZLujZQeXoqQQTkQ2B7exV6tbXOa561Wko/EooS'),
(10,'otra prueba','3204492049','2025-05-15','paro@gmail.com','cll 30 4n-40 san pablo',1,'$2y$12$X/SCByUBbkoHWt.0sQCEk.FJcWib8bWKkcftJQwPoL3Xg.43mCY06'),
(11,'ahora si','2020','2025-05-15','para@gmail.com','direccion',1,'$2y$12$cCiKaJWJhNYhjq0UH69RP.tAhxh/CpsfgBvahZcAJAlR2P9oXketi'),
(12,'ahora si','3505508899','2025-05-15','p@gmail.com','ajaajoiio',1,'$2y$12$RR2nWHRVf5b6zrwOerBDjOaQLUv3Dgyyr4jb5g35DvcQlVY.l/M0W'),
(13,'papua','1','2025-05-15','help@gmail.com','ahahio',1,'$2y$12$aUMfdvQ.WBXl6QjSP.EhH.jttSCbv0KsL0406C/.av6aYU/3QH5Na'),
(14,'por favor','3205504030','2025-05-15','me@gmail.com','aaijio',1,'$2y$12$Oh4b3xR.X10pioe9QHaUJOqxSv7mk1DT4dtpO.r/FxzCS01vFdVSO'),
(15,'ioajio','62688378','2025-05-15','ahora@gmail.com','nose',1,'$2y$12$nWmLAmxihNibP5qPkAasLONaf9uB/KYAua0XPVtGQ7VQYqhMnN4DS'),
(16,'que paso mijo','123438839','2025-05-15','ccc@gmail.com','aajio',1,'$2y$12$YwbQ3W1xG/FeGcO68EOHiOj/LmpYcYizWvpQS84GEtEIeqOpeuILy'),
(17,'otro usuario','3205502890','2025-05-15','usuario@gmail.com','ajaijiojiojioio',1,'$2y$12$MHBS07p7SwPI9vkyCtS0f.NLUpNRo/evR6MpWqywlr2nrq6BKYVSe'),
(18,'prueba de rol','3205503040','2025-05-15','rol@gmail.com','dir',0,'$2y$12$hx/u/6qTFATj8zfkHg3jxuVAXuykOD4E11zrMd8GdCRgBWeD6Jtdm'),
(19,'otro usuario','3205504030','2025-05-15','usuario@hotmail.com','direccion',0,'$2y$12$91xUXAqLUAO1l7qab8z7netGSIwSLnGr.1zuq58O0oe2Z2ZGc8Co.'),
(20,'pedro','3205052040','2025-05-15','pedro@gmail.com','direccion',0,'$2y$12$hVwCnSxNJnN/.4y0tohLGOdnhveGqtHafPiGfs58Zj86an1m730RS'),
(21,'caspacho','3205502030','2025-05-15','caspacho@gmail.com','direccion',0,'$2y$12$7M83mzERmXmBR0IhBs9RUOFBiWm/aa9edrVob9qasOfbkY4j92Im2'),
(22,'Jhon pecueco','1234567890','2025-05-16','doe@gmail.com','aijaio',0,'$2y$12$rXX2TkcBQq59Zu8l5yAQ9OX/kbcrMWfLfUbnIwSRg4xAxct/Ev/ZO'),
(23,'aver aver','1234567890','2025-05-22','hash@gmail.com','holaaaaaaaaaaaaaa',0,'$2y$12$aXZHEQyrPhC.cSTr26cMzOc1Om0Ir1AhQMoDg88Vyph6MjU.HmwJS'),
(24,'ahora si?','3115504030','2025-05-16','santiruizhurt@gmail.com','un segyguyguy',0,'$2y$12$/Bo2U80gza.qe5udTO1YseWnwHY9I26C6YiukAYyziOW/CM87u.kS'),
(25,'elpaco','3205504020','2025-05-17','elpaco@gmail.com','Holaaa',1,'$2y$12$WymwD2nZ6jTZEM16x89Pqey4.9GDpH1b0TNxcUKaiK3UtNlnacvwa'),
(26,'olo','1234567898','2025-05-17','olo@gmail.com','aaioajiaioa',1,'$2y$12$VFNASF3Sd1mGQ327cxx4AO2kql2j7SMrpmxeHiyEr9oRLXl0TFPei'),
(27,'admin','1234567898','2025-05-17','admin@gmail.com','direccion',1,'$2y$12$OAOyCzqs.8a24xxwuCyi2uxZNV9C7/t8sZD4WkyjEnOkjrlz1Rgx2'),
(28,'user','1234567890','2025-05-21','user@gmail.com','Nueva direccion',1,'$2y$12$9wNA2VlrKfWZGIj2lPRbkujrLQNnXQ/QpHp3o3qmKFbZPK3vxHr9u');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_rol`
--

DROP TABLE IF EXISTS `clientes_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes_rol` (
  `id_cliente` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`,`id_rol`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `clientes_rol_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `clientes_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_rol`
--

LOCK TABLES `clientes_rol` WRITE;
/*!40000 ALTER TABLE `clientes_rol` DISABLE KEYS */;
INSERT INTO `clientes_rol` VALUES
(18,2),
(19,2),
(20,2),
(21,2),
(22,1),
(23,1),
(24,2),
(25,1),
(26,2),
(27,1),
(28,2);
/*!40000 ALTER TABLE `clientes_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `estrellas` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `fk_cliente_has_comentarios` (`id_cliente`),
  KEY `fk_productos_has_comentarios` (`id_producto`),
  CONSTRAINT `fk_cliente_has_comentarios` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_productos_has_comentarios` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_pedidos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_detalle_has_pedido` (`id_pedido`),
  KEY `fk_detalle_producto` (`id_producto`),
  CONSTRAINT `fk_detalle_has_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES
(17,10,56,3,25000),
(18,11,56,3,25000),
(19,11,55,2,123456),
(20,12,56,4,25000),
(21,12,58,3,25000),
(22,13,56,4,25000),
(23,13,58,3,25000),
(24,13,55,2,123456),
(25,14,56,4,25000),
(26,14,58,3,25000),
(27,14,55,1,123456),
(28,15,56,4,25000),
(29,15,58,3,25000),
(30,15,55,2,123456),
(31,16,56,4,25000),
(32,16,58,3,25000),
(33,16,55,2,123456),
(34,17,56,4,25000),
(35,17,58,4,25000),
(36,17,55,2,123456),
(37,18,56,4,25000),
(38,18,58,4,25000),
(39,18,55,2,123456),
(40,18,57,2,10000),
(41,19,59,3,20000),
(42,20,59,1,20000),
(43,21,55,2,123456),
(44,21,56,1,25000),
(45,21,59,1,20000),
(46,22,59,2,20000),
(47,22,55,1,123456);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_prod`
--

DROP TABLE IF EXISTS `imagenes_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagenes_prod` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(100) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `fk_imagenes_productos` (`id_producto`),
  CONSTRAINT `fk_imagenes_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_prod`
--

LOCK TABLES `imagenes_prod` WRITE;
/*!40000 ALTER TABLE `imagenes_prod` DISABLE KEYS */;
INSERT INTO `imagenes_prod` VALUES
(46,'assets/fotos/imagen_20250517_034432000.jpg',55),
(47,'assets/fotos/imagen_20250518_043713000.png',56),
(48,'assets/fotos/imagen_20250519_235927000.png',57),
(49,'assets/fotos/imagen_20250520_003912000.jpg',58),
(50,'assets/fotos/imagen_20250521_232847000.jpg',59);
/*!40000 ALTER TABLE `imagenes_prod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` date NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedidos_clientes` (`id_cliente`),
  CONSTRAINT `fk_pedidos_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES
(10,'2025-05-21',28,75000,'entregado'),
(11,'2025-05-21',27,321912,'cancelado'),
(12,'2025-05-21',27,175000,'cancelado'),
(13,'2025-05-21',27,421912,'cancelado'),
(14,'2025-05-21',27,298456,'cancelado'),
(15,'2025-05-21',27,421912,'cancelado'),
(16,'2025-05-21',27,421912,'entregado'),
(17,'2025-05-21',27,446912,'entregado'),
(18,'2025-05-21',27,466912,'pendiente'),
(19,'2025-05-21',27,60000,'pendiente'),
(20,'2025-05-22',28,20000,'pendiente'),
(21,'2025-05-22',28,291912,'pendiente'),
(22,'2025-05-22',28,163456,'pendiente');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER pedidos_bu
BEFORE UPDATE ON pedidos
FOR EACH ROW
BEGIN
    DECLARE faltante INT;

    IF NEW.estado = 'entregado' AND OLD.estado <> 'entregado' THEN
        
        SELECT COUNT(*) INTO faltante
        FROM detalle_pedidos dp
        JOIN productos p ON dp.id_producto = p.id_producto
        WHERE dp.id_pedido = NEW.id_pedido
          AND dp.cantidad > p.stock;

        IF faltante > 0 THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'No hay suficiente stock para uno o más productos del pedido';
        END IF;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER pedidos_au AFTER UPDATE ON pedidos
FOR EACH ROW
BEGIN

    IF new.estado = 'entregado' AND old.estado <> 'entregado' THEN
        UPDATE productos
        JOIN detalle_pedidos ON detalle_pedidos.id_producto = productos.id_producto
        SET productos.stock = productos.stock - detalle_pedidos.cantidad
        WHERE detalle_pedidos.id_pedido = new.id_pedido;
    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(8) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `descuento` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_productos_categorias` (`id_categoria`),
  CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
(24,'manzana','ahiuahahui',85885,10,0,0,1),
(25,'manzana','ahiuahahui',85885,10,0,0,1),
(26,'cocacola','hola',10000,25,0,0,3),
(27,'arroz','arroz blando',28800,20,0,0,2),
(28,'esta es la prueba','definitiva',2829,20,0,0,1),
(29,'esta es la prueba','definitiva',2829,20,0,0,1),
(30,'papas fritas','papas de buen sabor',20,40,0,0,2),
(31,'papas fritas','papas de buen sabor',20,40,0,0,1),
(32,'papas fritas','papas de buen sabor',20,40,0,0,1),
(33,'todas van a ser pepsis','pepsi pa',840,20,0,0,2),
(34,'se editooooooooo','editadooooooooooooo',2000,20,0,0,2),
(35,'calabaza','calabaza naranja',3000,30,0,0,2),
(36,'no quiere editarse','ayudaaaaa',500,20,0,0,3),
(37,'ayuda a otra vez','demasiadas imagenes en la base de datos',12500,20,0,0,2),
(38,'prueba definitiva','no lo se',50000,10,0,0,1),
(39,'vamos a probar si hay problemas','ajajioajiojio',2993,8939,0,0,1),
(40,'que paso ahoraaaaa','ajajioajiojio',2993,8939,0,0,1),
(41,'esto es una pepsi','ajajioajiojio',1000,8939,0,0,1),
(42,'prueba desde el ajaz','ajajioajiojio',2993,8939,0,0,1),
(43,'ya deberia estar bien','ahuahiuhiua',20000,199,0,0,3),
(44,'neuva pepsi','nueva pepsi para probar',29000,23,0,0,1),
(45,'neuva cocacola','esta es una cocacola',19099,30,0,0,3),
(46,'primer producto','producto de prueba',20000,20,0,0,1),
(47,'otro producto','nose que crear',2000,82,0,0,1),
(48,'otro producto','nose que crear',2000,82,0,0,1),
(49,'ya se edito','ya tengo demasiados productos',20000,25,0,0,2),
(50,'creemos mas','holaaa',40555,15,0,0,3),
(51,'fanta','gaseosa',28773,30,0,0,3),
(52,'ediciooon','ya tengo demasiados productos',2000,20,0,0,1),
(53,'fanta','fanta de gaseosa',0,0,0,0,3),
(54,'despues pruebo','hsushiushui',2020,2,0,0,1),
(55,'producto de prueba','ahaoihaiohio',123456,10,1,0,2),
(56,'cocacola','Cocacola de buen sabor',25000,27,1,0,2),
(57,'papas con nuevo sabor','habia una vez',10000,15,1,0,3),
(58,'papue ginea','no se que es eso',25000,46,1,0,3),
(59,'salchichon','salchichon maduro',20000,2,1,0,2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin'),
(2,'cliente');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-22  3:22:58
