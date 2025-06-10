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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
(25,'elpaco','3205504020','2025-05-17','elpaco@gmail.com','Holaaa',1,'$2y$12$WymwD2nZ6jTZEM16x89Pqey4.9GDpH1b0TNxcUKaiK3UtNlnacvwa'),
(26,'olo','1234567898','2025-05-17','olo@gmail.com','aaioajiaioa',1,'$2y$12$VFNASF3Sd1mGQ327cxx4AO2kql2j7SMrpmxeHiyEr9oRLXl0TFPei'),
(27,'admin','1234567898','2025-05-17','admin@gmail.com','direccion',1,'$2y$12$OAOyCzqs.8a24xxwuCyi2uxZNV9C7/t8sZD4WkyjEnOkjrlz1Rgx2'),
(28,'user','1234567','2025-05-21','user@gmail.com','Calle 400',1,'$2y$12$7eUfBYLQE9NsstTeFCT3BeT5kTrVOE8QRKIJL.vr3mK4izjxJqqci'),
(29,'facu','1234567898','2025-05-23','facu@gmail.com','Direccion random',0,'$2y$12$ZAbbe/IrbVi76ahxiaZl8OqT0oZ6MJNzFwE9Fw3e287K9aX2fRRI2'),
(30,'eliminado','eliminado','2025-05-23','eliminado','eliminado',0,'$2y$12$DJ4/ke5VBgUfuK/kkrusFehOdvQs8Nt2ZBM/BmsiiyvXU0zHnvv5W'),
(31,'nose','1234567897','2025-05-25','ahiuahiu@gmail.com','cll 20 5 20 ',0,'$2y$12$uzzX2oX6/bahsBTPggM9dOu21L3WfiRPW.8Pw6D/0oF9boobrxBWS'),
(32,'basik','1234567898','2025-05-25','basik@gmail.com','calle 20 #5 - 30 emaus',1,'$2y$12$xoO1bynwZMvvcWA8iKLo4ejaDfSAtj9/Q476FwLFrHBjc70tJErsq'),
(33,'eliminado','eliminado','2025-05-29','eliminado_20250529010749@example.com','eliminado',0,'$2y$12$8sU0G4XBdhKLutlTjVLuYuNhUbb6tTFRY86t/BkpBbD68lh9mvmKS'),
(34,'santi','3205504030','2025-05-29','santiruizhurt@gmail.com','Direccion #20 - 40 barrio el espiritu',1,'$2y$12$0CyS4cQzDFkpmRJfNE0BUe4oBpjocFwxC0vEBCqkDpdPZFu3uVGZu'),
(35,'sopas','1234567892','2025-06-10','sopas@gmail.com','Carrera 20 40 - 30',1,'$2y$12$ZqmXPgW8qHtloBEkvUsUreGfOgXPgNdDcNSpCwDwGJrIevo1aH1NC');
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
(25,1),
(26,2),
(27,1),
(28,1),
(29,2),
(30,2),
(31,2),
(32,1),
(33,2),
(34,2),
(35,2);
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
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `fk_cliente_has_comentarios` (`id_cliente`),
  KEY `fk_productos_has_comentarios` (`id_producto`),
  CONSTRAINT `fk_cliente_has_comentarios` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_productos_has_comentarios` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES
(18,35,73,'Holaaaaa',5,1,'2025-06-10');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `descuentos` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `fecha_fin` datetime NOT NULL,
  PRIMARY KEY (`id_descuento`),
  KEY `fk_descuento_producto` (`id_producto`),
  CONSTRAINT `fk_descuento_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES
(65,38,73,2,75000);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `domicilio` (
  `id_domicilio` int(11) NOT NULL AUTO_INCREMENT,
  `monto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_domicilio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domicilio`
--

LOCK TABLES `domicilio` WRITE;
/*!40000 ALTER TABLE `domicilio` DISABLE KEYS */;
INSERT INTO `domicilio` VALUES
(1,5000);
/*!40000 ALTER TABLE `domicilio` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_prod`
--

LOCK TABLES `imagenes_prod` WRITE;
/*!40000 ALTER TABLE `imagenes_prod` DISABLE KEYS */;
INSERT INTO `imagenes_prod` VALUES
(63,'assets/fotos/imagen_20250610_053612000.webp',72),
(64,'assets/fotos/imagen_20250610_054100000.jpg',73);
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
  `fecha_pedido` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedidos_clientes` (`id_cliente`),
  CONSTRAINT `fk_pedidos_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES
(38,'2025-06-10 02:40:43',35,150000,'pendiente');
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
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_productos_categorias` (`id_categoria`),
  CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
(72,'Aretes de oro','Aretes bañados en oro de 24k',50000,5,1,2),
(73,'Anillo de acero','Anillo de acero bañado en oro',75000,6,1,2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocion`
--

DROP TABLE IF EXISTS `promocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_promocion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocion`
--

LOCK TABLES `promocion` WRITE;
/*!40000 ALTER TABLE `promocion` DISABLE KEYS */;
INSERT INTO `promocion` VALUES
(1,'Revisa nuestras nuevas ofertas','Contamos con los mejores precios en joyerias.','assets/fotos/imagen_20250530_203115000.jpg'),
(2,'Nueva promocion','Revisa nuestras promociones','assets/fotos/imagen_20250610_062717000.jpg');
/*!40000 ALTER TABLE `promocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recuperacion`
--

DROP TABLE IF EXISTS `recuperacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `recuperacion` (
  `id_recuperacion` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(45) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_recuperacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recuperacion`
--

LOCK TABLES `recuperacion` WRITE;
/*!40000 ALTER TABLE `recuperacion` DISABLE KEYS */;
INSERT INTO `recuperacion` VALUES
(1,'santiruizhurt@gmail.com','f8da1bfe6c1a2594f831','2025-05-29 02:55:47'),
(2,'santiruizhurt@gmail.com','073a1a211bfefaff4479','2025-05-29 02:56:31'),
(3,'santiruizhurt@gmail.com','a07767f93409d4470172','2025-05-29 02:58:22'),
(4,'santiruizhurt@gmail.com','49cdb2889647ef96bd87','2025-05-29 03:03:45'),
(5,'santiruizhurt@gmail.com','6b0dd28932c89e1d77d9','2025-05-29 03:04:25'),
(6,'santiruizhurt@gmail.com','507213ced94f830a674e','2025-05-29 03:08:48'),
(7,'santiruizhurt@gmail.com','43b947492e799e321ece','2025-05-29 03:10:02'),
(8,'santiruizhurt@gmail.com','e80e1b3d0e0772d1b5a8','2025-05-29 03:11:22'),
(9,'santiruizhurt@gmail.com','1bfb13dd6d5418dc4fd5','2025-05-29 03:13:52'),
(10,'santiruizhurt@gmail.com','25a23f2b62ca65ce7e9e','2025-05-29 03:14:13'),
(11,'santiruizhurt@gmail.com','959e99e39770c1e0a50d','2025-05-29 03:15:26'),
(12,'santiruizhurt@gmail.com','56b63b55b9bf9adb5b6a','2025-05-29 03:21:01'),
(13,'santiruizhurt@gmail.com','bf24f9027b5665107323','2025-05-29 03:24:11'),
(14,'santiruizhurt@gmail.com','2aee4718a37c6f05fa78','2025-05-29 03:27:19'),
(15,'santiruizhurt@gmail.com','3b8f9e30208fb3d9eadd','2025-05-29 04:16:22'),
(16,'santiruizhurt@gmail.com','15779307469aef09bcb5','2025-05-30 17:22:48');
/*!40000 ALTER TABLE `recuperacion` ENABLE KEYS */;
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

--
-- Dumping events for database 'gleams'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `eliminar_descuentos_vencidos` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8mb3 */ ;;
/*!50003 SET character_set_results = utf8mb3 */ ;;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`root`@`localhost`*/ /*!50106 EVENT `eliminar_descuentos_vencidos` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-05-28 15:55:31' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM descuentos
  WHERE fecha_fin < NOW() */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-10  3:00:46
