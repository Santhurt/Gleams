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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
(16,'que paso mijo','123438839','2025-05-15','ccc@gmail.com','aajio',1,'$2y$12$YwbQ3W1xG/FeGcO68EOHiOj/LmpYcYizWvpQS84GEtEIeqOpeuILy');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_prod`
--

LOCK TABLES `imagenes_prod` WRITE;
/*!40000 ALTER TABLE `imagenes_prod` DISABLE KEYS */;
INSERT INTO `imagenes_prod` VALUES
(43,'assets/fotos/imagen_20250515_020407000.png',52);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
(52,'ediciooon','ya tengo demasiados productos',2000,20,1,0,2);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-15  1:48:11
