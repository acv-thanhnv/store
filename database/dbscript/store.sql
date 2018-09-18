-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: store
-- ------------------------------------------------------
-- Server version	8.0.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Position to start replication or point-in-time recovery from
--

-- CHANGE MASTER TO MASTER_LOG_FILE='binlog.000052', MASTER_LOG_POS=155;

--
-- Table structure for table `catelory`
--

DROP TABLE IF EXISTS `catelory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `catelory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=638 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catelory`
--

LOCK TABLES `catelory` WRITE;
/*!40000 ALTER TABLE `catelory` DISABLE KEYS */;
REPLACE INTO `catelory` VALUES (1,'Root',1,16,'https://root.com',NULL);
/*!40000 ALTER TABLE `catelory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2018_08_14_113908_import_sys_init_database',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
REPLACE INTO `oauth_access_tokens` VALUES ('ad3cb61abc0301d64243e3189ff7dd6d330cbbe6491e6cec238a525ffce68852f01bce4d39250512',48,1,'By Login from user:48','[]',0,'2018-09-07 04:06:18','2018-09-07 04:06:18','2019-09-07 11:06:18');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
REPLACE INTO `oauth_clients` VALUES (1,NULL,'Laravel common Personal Access Client','jc7DoxIZNcbNmaIgDXFOqjZhHiEYPRKUYXl6tIMx','http://localhost',1,0,0,'2018-09-07 04:06:12','2018-09-07 04:06:12'),(2,NULL,'Laravel common Password Grant Client','6lasC9cYRgozw9UFkFGn154gjErZ7UdC393RmWHF','http://localhost',0,1,0,'2018-09-07 04:06:12','2018-09-07 04:06:12'),(3,NULL,'Laravel common Personal Access Client','yoeKFmyqYkMljvDLFFN8FEET7PXtYBINa6TE9NfW','http://localhost',1,0,0,'2018-09-13 02:40:55','2018-09-13 02:40:55'),(4,NULL,'Laravel common Password Grant Client','zxW9q0q4u7S5ApkTN1VrVAcICul1rfO3cJQIR2AC','http://localhost',0,1,0,'2018-09-13 02:40:56','2018-09-13 02:40:56');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
REPLACE INTO `oauth_personal_access_clients` VALUES (1,1,'2018-09-07 04:06:12','2018-09-07 04:06:12'),(2,3,'2018-09-13 02:40:55','2018-09-13 02:40:55');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_delivery`
--

DROP TABLE IF EXISTS `store_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `phone` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_delivery`
--

LOCK TABLES `store_delivery` WRITE;
/*!40000 ALTER TABLE `store_delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_entities`
--

DROP TABLE IF EXISTS `store_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(12,4) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_entities`
--

LOCK TABLES `store_entities` WRITE;
/*!40000 ALTER TABLE `store_entities` DISABLE KEYS */;
REPLACE INTO `store_entities` VALUES (1,'item1','FoodImage/1/mIE9B1S7AE1IqdvjFsRlEfQnDtIDo5kYDpRBR9TO.jpeg',5000.0000,1,NULL,NULL),(2,'item2','FoodImage/1/DDtKC5pSWNUGXwE2LFTv1OfCUr8uJLdGh3hneU3n.jpeg',3.0000,1,NULL,NULL),(3,'item3','FoodImage/1/ijVZNaC9LqmMzrCsm25z6aAuKoLiYnVm2277YabY.jpeg',4.0000,1,NULL,NULL),(4,'Trứng Chiên','FoodImage/1/zLZHMUDgdGYUMv6XUNiZwLRiE102ErFOXxyl3UMn.jpeg',20.0000,10041,NULL,NULL),(16,'Cơm Chiên','FoodImage/1/yX9Y1wnS1bIESfpNelcKJV9w4ghaNDI31lEiRhRV.jpeg',30000.0000,10041,NULL,NULL),(17,'Bún Riêu','FoodImage/1/sbUyGcpOGHNoLbpMlGy1Ho7VUJEQMvl3o9ac3dFp.jpeg',30.0000,10040,NULL,NULL),(18,'Pho Bo','FoodImage/1/9eXF6bQZko9hw45cXZUZ6s86c6EsDPJq8tOFOG9N.jpeg',50.0000,10040,NULL,NULL),(19,'Bun Bo Hue','FoodImage/1/tWAQ0WdhNUoBWuwgz1l5aZ4ConrvbtwBsN00z3i6.jpeg',50.0000,10040,NULL,NULL);
/*!40000 ALTER TABLE `store_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_entity_properties`
--

DROP TABLE IF EXISTS `store_entity_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_entity_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_type_id` int(11) DEFAULT NULL,
  `property_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_type_code` int(11) DEFAULT NULL,
  `property_label` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_entity_properties`
--

LOCK TABLES `store_entity_properties` WRITE;
/*!40000 ALTER TABLE `store_entity_properties` DISABLE KEYS */;
REPLACE INTO `store_entity_properties` VALUES (1,1,'nguyen_lieu',1,'Nguyên liệu',0),(2,1,'con_het',2,'Còn/Hết',0),(3,1,'giam_gia',3,'Giảm giá',0),(9,25,'name',2,'Name',2),(10,25,'nguyen_lieu',1,'Nguyên liệu',1),(11,25,'price',1,'Price',2),(18,NULL,'nguyen_lieu',1,'Nguyên liệu',0),(19,NULL,'con_het',2,'Còn/Hết',0),(20,NULL,'giam_gia',3,'Giảm giá',0),(21,NULL,'nguyen_lieu',1,'Nguyên liệu',1),(22,NULL,'con_het',2,'Còn/Hết',2),(23,NULL,'giam_gia',3,'Giảm giá',3),(24,NULL,'discount',3,'Discount',1),(25,NULL,'thanh_phan',2,'Thành Phần',4),(27,NULL,'con_het',2,'Còn/Hết',0),(28,NULL,'sale',3,'Sale',0);
/*!40000 ALTER TABLE `store_entity_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_entity_property_values`
--

DROP TABLE IF EXISTS `store_entity_property_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_entity_property_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_entity_property_values`
--

LOCK TABLES `store_entity_property_values` WRITE;
/*!40000 ALTER TABLE `store_entity_property_values` DISABLE KEYS */;
REPLACE INTO `store_entity_property_values` VALUES (1,'1','2','Trứng rán'),(2,'1','1','35000'),(3,'1','3','50000'),(4,'2','2','Thịt kho'),(5,'2','1','40000'),(7,'16','18','20'),(8,'16','19','Còn'),(9,'16','20','0'),(10,'17','21','20'),(11,'17','22','Còn'),(12,'17','23',''),(13,'18','24','10'),(15,'3','27','Còn'),(16,'3','28','0');
/*!40000 ALTER TABLE `store_entity_property_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_entity_types`
--

DROP TABLE IF EXISTS `store_entity_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_entity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_entity_types`
--

LOCK TABLES `store_entity_types` WRITE;
/*!40000 ALTER TABLE `store_entity_types` DISABLE KEYS */;
REPLACE INTO `store_entity_types` VALUES (1,'Món cơ bản',1,'Những món ăn cơ bản, giá cả bình dân'),(2,'Món đặc biệt',1,'Các món ăn đặc biệt dành cho những khách hàng Vip'),(3,'Món Tráng Miệng',1,'Tổng hợp các món tráng miệng'),(4,'Món Khai Vị',1,'Các món ăn mở đầu của bữa ăn'),(5,'Súp 5',1,'Tổng hợp các món súp...'),(25,'Foods Salad',1,'Kind of food'),(33,'Test',1,'123');
/*!40000 ALTER TABLE `store_entity_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_floor`
--

DROP TABLE IF EXISTS `store_floor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_floor`
--

LOCK TABLES `store_floor` WRITE;
/*!40000 ALTER TABLE `store_floor` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_floor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_location`
--

DROP TABLE IF EXISTS `store_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_location_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_location`
--

LOCK TABLES `store_location` WRITE;
/*!40000 ALTER TABLE `store_location` DISABLE KEYS */;
REPLACE INTO `store_location` VALUES (1,'Bàn 1',NULL,NULL,NULL),(2,'Bàn 2',NULL,NULL,NULL),(3,'Bàn 3',NULL,NULL,NULL),(4,'Bàn 4',NULL,NULL,NULL),(5,'Bàn 5',NULL,NULL,NULL),(6,'Bàn 6',NULL,NULL,NULL),(7,'Bàn 7',NULL,NULL,NULL),(8,'Bàn 8',NULL,NULL,NULL),(9,'Bàn 9',NULL,NULL,NULL),(10,'Bàn 10',NULL,NULL,NULL),(11,'Bàn 11',NULL,NULL,NULL);
/*!40000 ALTER TABLE `store_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_menu`
--

DROP TABLE IF EXISTS `store_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10056 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_menu`
--

LOCK TABLES `store_menu` WRITE;
/*!40000 ALTER TABLE `store_menu` DISABLE KEYS */;
REPLACE INTO `store_menu` VALUES (1,1,'Thành Tạo',NULL),(10040,1,'Morning Menu','All of foods for breakfast'),(10041,1,'Afternoon Menu','Include food for afternoon'),(10042,1,'Buffet Menu','Lots of food for buffet'),(10055,1,'Buffet Nuong','All of buffet nuong');
/*!40000 ALTER TABLE `store_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_order`
--

DROP TABLE IF EXISTS `store_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `datetime_order` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_order`
--

LOCK TABLES `store_order` WRITE;
/*!40000 ALTER TABLE `store_order` DISABLE KEYS */;
REPLACE INTO `store_order` VALUES (2,1,0,'2018-09-10 16:21:54',2,1,NULL),(3,1,0,'2018-09-11 11:29:19',2,1,NULL),(4,1,0,'2018-09-11 14:11:59',2,1,NULL),(5,1,0,'2018-09-11 14:42:01',2,1,NULL),(6,1,0,'2018-09-11 15:09:20',2,1,NULL),(7,1,1,'2018-09-11 15:25:33',2,1,NULL),(8,1,1,'2018-09-11 15:49:04',2,1,NULL),(9,1,1,'2018-09-11 15:49:34',2,1,NULL),(10,1,1,'2018-09-11 15:55:18',2,1,NULL),(11,1,1,'2018-09-11 15:56:18',2,1,NULL),(12,1,1,'2018-09-11 15:58:16',2,1,NULL),(13,1,1,'2018-09-11 16:20:15',2,1,NULL),(14,1,1,'2018-09-11 16:20:22',2,1,NULL),(15,1,1,'2018-09-11 17:02:11',2,1,NULL),(16,1,1,'2018-09-11 17:03:07',2,1,NULL),(17,1,1,'2018-09-11 17:03:18',2,1,NULL),(18,1,1,'2018-09-11 17:04:16',2,1,NULL),(19,1,1,'2018-09-11 17:04:19',2,1,NULL),(20,1,1,'2018-09-11 17:05:24',2,1,NULL),(21,1,1,'2018-09-11 17:06:01',2,1,NULL),(22,1,1,'2018-09-11 17:06:03',2,1,NULL),(23,1,1,'2018-09-11 17:06:05',2,1,NULL),(24,1,1,'2018-09-11 17:12:34',2,1,NULL),(25,1,1,'2018-09-11 17:12:43',2,1,NULL),(26,1,1,'2018-09-11 17:13:27',2,1,NULL),(27,1,1,'2018-09-11 17:13:31',2,1,NULL),(28,1,1,'2018-09-11 17:14:49',2,1,NULL),(29,1,1,'2018-09-11 17:14:51',2,1,NULL),(30,1,1,'2018-09-11 17:16:11',2,1,NULL),(31,1,1,'2018-09-11 17:17:24',2,1,NULL),(32,1,1,'2018-09-11 17:17:27',2,1,NULL),(33,1,1,'2018-09-11 17:18:17',2,1,NULL),(34,1,1,'2018-09-11 17:22:22',2,1,NULL),(35,1,1,'2018-09-11 17:23:57',2,1,NULL),(36,1,1,'2018-09-11 17:24:26',2,1,NULL),(37,1,1,'2018-09-11 17:24:28',2,1,NULL),(38,1,1,'2018-09-11 17:24:41',2,1,NULL),(39,1,1,'2018-09-11 17:24:50',2,1,NULL),(40,1,1,'2018-09-11 17:24:52',2,1,NULL),(41,1,1,'2018-09-11 17:24:54',2,1,NULL),(42,1,1,'2018-09-11 17:24:56',2,1,NULL),(43,1,1,'2018-09-11 17:25:29',2,1,NULL),(44,1,1,'2018-09-12 11:30:04',2,1,NULL),(45,1,1,'2018-09-12 11:31:40',2,1,NULL),(46,1,1,'2018-09-12 11:32:56',2,1,NULL),(47,1,1,'2018-09-12 11:33:05',2,1,NULL),(48,1,1,'2018-09-12 11:33:12',2,1,NULL),(49,1,1,'2018-09-12 11:34:51',2,1,NULL),(50,1,1,'2018-09-12 11:35:35',2,1,NULL),(51,1,1,'2018-09-12 11:36:14',2,1,NULL),(52,1,1,'2018-09-12 11:37:45',2,1,NULL),(53,1,1,'2018-09-12 11:38:37',2,1,NULL),(55,1,1,'2018-09-12 11:44:31',2,1,NULL),(56,1,1,'2018-09-12 11:46:08',2,1,NULL),(57,1,1,'2018-09-12 11:50:43',2,1,NULL),(58,1,1,'2018-09-12 11:51:45',2,1,NULL),(59,1,1,'2018-09-12 11:58:14',2,1,NULL),(60,1,1,'2018-09-12 13:34:09',2,1,NULL),(61,1,1,'2018-09-12 13:34:57',2,1,NULL),(62,1,1,'2018-09-12 13:36:39',2,1,NULL),(63,1,1,'2018-09-12 13:38:23',2,1,NULL),(64,1,1,'2018-09-12 13:39:39',2,1,NULL),(65,1,1,'2018-09-12 13:40:33',2,1,NULL),(66,1,1,'2018-09-12 13:42:59',2,1,NULL),(67,1,1,'2018-09-12 13:47:31',2,1,NULL),(68,1,1,'2018-09-12 13:49:27',2,1,NULL),(69,1,1,'2018-09-12 13:50:29',2,1,NULL),(70,1,1,'2018-09-12 13:50:40',2,1,NULL),(71,1,1,'2018-09-12 13:52:16',2,1,NULL),(72,1,1,'2018-09-12 13:52:21',2,1,NULL),(73,1,1,'2018-09-12 13:54:59',2,1,NULL),(74,1,1,'2018-09-12 13:55:01',2,1,NULL),(75,1,1,'2018-09-12 13:55:08',2,1,NULL),(76,1,1,'2018-09-12 13:56:18',2,1,NULL),(77,1,1,'2018-09-12 13:57:07',2,1,NULL),(78,1,1,'2018-09-12 13:58:03',2,1,NULL),(79,1,1,'2018-09-12 13:58:40',2,1,NULL),(80,1,1,'2018-09-12 13:59:01',2,1,NULL),(81,1,1,'2018-09-12 13:59:03',2,1,NULL),(82,1,1,'2018-09-12 14:03:06',2,1,NULL),(83,1,1,'2018-09-12 14:03:10',2,1,NULL),(84,1,1,'2018-09-12 14:04:29',2,1,NULL),(85,1,1,'2018-09-12 14:06:10',2,1,NULL),(86,1,1,'2018-09-12 14:07:04',2,1,NULL),(87,1,1,'2018-09-12 14:07:31',2,1,NULL),(88,1,1,'2018-09-12 14:08:33',2,1,NULL),(89,1,1,'2018-09-12 14:12:15',2,1,NULL),(90,1,1,'2018-09-12 14:12:35',2,1,NULL),(91,1,1,'2018-09-12 14:12:43',2,1,NULL),(92,1,1,'2018-09-12 14:13:35',2,1,NULL),(93,1,1,'2018-09-12 14:17:21',2,1,NULL),(94,1,1,'2018-09-12 14:53:10',2,1,NULL),(95,1,1,'2018-09-12 14:53:38',2,1,NULL),(96,1,1,'2018-09-12 14:59:12',2,1,NULL),(97,1,1,'2018-09-12 15:00:36',2,1,NULL),(98,1,1,'2018-09-12 15:06:33',2,1,NULL),(99,1,1,'2018-09-12 15:08:31',2,1,NULL),(100,1,1,'2018-09-12 15:09:33',2,1,NULL),(101,1,1,'2018-09-12 15:10:08',2,1,NULL),(102,1,1,'2018-09-12 15:10:55',2,1,NULL),(103,1,1,'2018-09-12 15:11:17',2,1,NULL),(104,1,1,'2018-09-12 15:12:01',2,1,NULL),(105,1,1,'2018-09-12 15:23:41',2,1,NULL),(106,1,1,'2018-09-12 15:33:33',2,1,NULL),(107,1,1,'2018-09-12 15:34:06',2,1,NULL),(108,1,1,'2018-09-12 15:34:50',2,1,NULL),(109,1,1,'2018-09-12 15:35:15',2,1,NULL),(110,1,1,'2018-09-12 15:36:12',2,1,NULL),(111,1,1,'2018-09-12 15:38:40',2,1,NULL),(112,1,1,'2018-09-12 15:39:51',2,1,NULL),(113,1,1,'2018-09-12 15:40:56',2,1,NULL),(116,1,1,'2018-09-12 16:59:07',2,1,NULL),(128,1,1,'2018-09-12 17:27:24',2,1,NULL),(129,1,1,'2018-09-12 17:28:53',2,1,NULL),(130,1,1,'2018-09-12 17:30:03',2,1,NULL),(131,1,1,'2018-09-12 17:30:35',2,1,NULL),(132,1,1,'2018-09-12 17:31:49',2,1,NULL),(133,1,1,'2018-09-12 17:32:36',2,1,NULL),(142,1,1,'2018-09-12 17:38:03',2,1,NULL),(144,1,1,'2018-09-12 17:39:52',2,1,NULL),(148,1,1,'2018-09-12 17:48:10',2,1,NULL),(149,1,1,'2018-09-12 17:48:34',2,1,NULL),(150,1,1,'2018-09-12 17:54:16',2,1,NULL),(151,1,1,'2018-09-13 08:44:43',2,1,NULL),(152,1,1,'2018-09-13 08:50:17',2,1,NULL),(154,1,1,'2018-09-13 09:26:28',2,1,NULL),(155,1,1,'2018-09-13 09:28:02',2,1,NULL),(156,1,1,'2018-09-13 09:28:48',2,1,NULL),(157,1,1,'2018-09-13 09:30:18',2,1,NULL),(158,2,1,'2018-09-13 09:30:28',2,1,NULL),(159,2,1,'2018-09-13 09:54:09',2,1,NULL),(160,454355,1,'2018-09-13 09:54:22',2,1,NULL),(161,3,1,'2018-09-13 09:54:38',2,1,NULL),(165,2,1,'2018-09-13 09:59:46',2,1,NULL),(166,2,1,'2018-09-13 10:00:54',2,1,NULL),(167,1,1,'2018-09-13 11:19:41',2,1,NULL),(168,1,1,'2018-09-13 11:21:06',2,1,NULL),(169,1,1,'2018-09-13 11:26:54',2,1,NULL),(170,1,1,'2018-09-13 11:49:46',2,1,NULL),(171,1,1,'2018-09-13 13:44:12',2,1,NULL),(172,1,1,'2018-09-13 13:44:34',2,1,NULL),(173,1,1,'2018-09-13 14:14:15',2,1,NULL),(174,1,1,'2018-09-13 14:15:58',2,1,NULL),(175,1,1,'2018-09-13 14:17:38',2,1,NULL),(176,1,1,'2018-09-13 14:26:29',3,1,NULL),(177,1,1,'2018-09-13 14:29:19',3,1,NULL),(178,1,1,'2018-09-13 14:46:32',3,1,NULL),(179,1,1,'2018-09-13 14:49:05',3,1,NULL),(180,1,1,'2018-09-13 14:56:29',3,1,NULL),(181,1,1,'2018-09-13 14:57:15',3,1,NULL),(182,1,1,'2018-09-13 14:58:50',3,1,NULL),(183,1,1,'2018-09-13 15:09:24',4,1,NULL),(184,1,1,'2018-09-13 15:10:52',4,1,NULL),(185,1,1,'2018-09-13 15:12:48',4,1,NULL),(186,1,1,'2018-09-13 15:16:37',4,1,NULL),(187,1,1,'2018-09-13 15:17:39',4,1,NULL),(188,1,1,'2018-09-13 15:21:36',3,1,NULL),(189,1,1,'2018-09-13 15:24:18',4,1,NULL),(190,1,1,'2018-09-13 15:26:52',3,1,NULL),(191,1,1,'2018-09-13 15:28:47',4,1,NULL),(192,1,1,'2018-09-13 15:29:19',3,1,NULL),(193,1,1,'2018-09-13 16:06:45',3,1,NULL),(194,1,1,'2018-09-13 16:15:14',2,1,NULL),(195,1,1,'2018-09-13 17:02:44',3,1,NULL),(196,1,1,'2018-09-13 17:04:53',4,1,NULL),(197,1,1,'2018-09-13 17:07:49',4,1,NULL),(198,1,1,'2018-09-13 17:23:53',3,1,NULL),(199,1,1,'2018-09-13 17:24:20',4,1,NULL),(200,1,1,'2018-09-13 17:35:38',2,1,NULL),(201,1,1,'2018-09-14 08:41:26',3,1,NULL),(202,1,1,'2018-09-14 09:08:51',3,1,NULL),(203,1,1,'2018-09-14 09:09:57',3,1,NULL),(204,1,1,'2018-09-14 09:14:59',1,1,NULL),(205,1,1,'2018-09-14 09:15:02',3,1,NULL),(206,1,1,'2018-09-14 09:19:54',3,1,NULL),(207,1,1,'2018-09-14 09:57:38',2,1,NULL),(208,1,1,'2018-09-14 10:20:28',2,1,NULL),(209,1,1,'2018-09-14 15:53:47',1,1,'aaajl'),(210,1,1,'2018-09-14 15:53:48',2,1,'aaajl'),(211,1,1,'2018-09-14 15:54:05',2,1,'aaajl'),(212,1,1,'2018-09-14 16:47:20',2,1,NULL),(213,1,1,'2018-09-14 16:47:20',1,1,NULL),(214,1,0,'2018-09-14 16:47:49',1,1,NULL),(215,1,0,'2018-09-14 16:48:55',2,1,NULL),(216,1,1,'2018-09-14 17:05:40',2,1,'aaajl'),(217,1,0,'2018-09-14 17:21:27',1,1,NULL),(218,1,0,'2018-09-14 17:21:39',1,1,NULL),(219,1,0,'2018-09-14 17:22:10',1,1,NULL);
/*!40000 ALTER TABLE `store_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_order_detail`
--

DROP TABLE IF EXISTS `store_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `entities_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_order_detail`
--

LOCK TABLES `store_order_detail` WRITE;
/*!40000 ALTER TABLE `store_order_detail` DISABLE KEYS */;
REPLACE INTO `store_order_detail` VALUES (1,2,1,1),(2,2,2,2),(3,3,1,1),(4,3,2,2),(5,4,1,1),(6,4,2,2),(7,5,1,1),(8,5,2,2),(9,6,1,1),(10,6,2,2),(11,7,1,1),(12,7,2,2),(13,9,1,1),(14,9,2,2),(15,10,1,1),(16,10,2,2),(17,11,1,1),(18,11,2,2),(19,12,1,1),(20,12,2,2),(21,13,1,1),(22,13,2,2),(23,14,1,1),(24,14,2,2),(25,15,1,1),(26,15,2,2),(27,16,1,1),(28,16,2,2),(29,17,1,1),(30,17,2,2),(31,18,1,1),(32,18,2,2),(33,19,1,1),(34,19,2,2),(35,20,1,1),(36,20,2,2),(37,21,1,1),(38,21,2,2),(39,22,1,1),(40,22,2,2),(41,23,1,1),(42,23,2,2),(43,24,1,1),(44,24,2,2),(45,25,1,1),(46,25,2,2),(47,26,1,1),(48,26,2,2),(49,27,1,1),(50,27,2,2),(51,28,1,1),(52,28,2,2),(53,29,1,1),(54,29,2,2),(55,30,1,1),(56,30,2,2),(57,31,1,1),(58,31,2,2),(59,32,1,1),(60,32,2,2),(61,33,1,1),(62,33,2,2),(63,34,1,1),(64,34,2,2),(65,35,1,1),(66,35,2,2),(67,36,1,1),(68,36,2,2),(69,37,1,1),(70,37,2,2),(71,38,1,1),(72,38,2,2),(73,39,1,1),(74,39,2,2),(75,40,1,1),(76,40,2,2),(77,41,1,1),(78,41,2,2),(79,42,1,1),(80,42,2,2),(81,43,1,1),(82,43,2,2),(83,44,1,1),(84,44,2,2),(85,46,1,1),(86,46,2,2),(87,47,1,1),(88,47,2,2),(89,48,1,1),(90,48,2,2),(91,49,1,1),(92,49,2,2),(93,50,1,1),(94,50,2,2),(95,51,1,1),(96,51,2,2),(97,52,1,1),(98,52,2,2),(99,53,1,1),(100,53,2,2),(103,55,1,1),(104,55,2,2),(105,56,1,1),(106,56,2,2),(107,57,1,1),(108,57,2,2),(109,58,1,1),(110,58,2,2),(111,59,1,1),(112,59,2,2),(113,60,1,1),(114,60,2,2),(115,61,1,1),(116,61,2,2),(117,62,1,1),(118,62,2,2),(119,63,1,1),(120,63,2,2),(121,64,1,1),(122,64,2,2),(123,65,1,1),(124,65,2,2),(125,66,1,1),(126,66,2,2),(127,67,1,1),(128,67,2,2),(129,68,1,1),(130,68,2,2),(131,69,1,1),(132,69,2,2),(133,70,1,1),(134,70,2,2),(135,71,1,1),(136,71,2,2),(137,72,1,1),(138,72,2,2),(139,73,1,1),(140,73,2,2),(141,74,1,1),(142,74,2,2),(143,75,1,1),(144,75,2,2),(145,76,1,1),(146,76,2,2),(147,77,1,1),(148,77,2,2),(149,78,1,1),(150,78,2,2),(151,79,1,1),(152,79,2,2),(153,80,1,1),(154,80,2,2),(155,81,1,1),(156,81,2,2),(157,82,1,1),(158,82,2,2),(159,83,1,1),(160,83,2,2),(161,84,1,1),(162,84,2,2),(163,85,1,1),(164,85,2,2),(165,86,1,1),(166,86,2,2),(167,87,1,1),(168,87,2,2),(169,88,1,1),(170,88,2,2),(171,89,1,1),(172,89,2,2),(173,90,1,1),(174,90,2,2),(175,91,1,1),(176,91,2,2),(177,92,1,1),(178,92,2,2),(179,93,1,1),(180,93,2,2),(181,94,1,1),(182,94,2,2),(183,95,1,1),(184,95,2,2),(185,96,1,1),(186,96,2,2),(187,97,1,1),(188,97,2,2),(189,98,1,1),(190,98,2,2),(191,99,1,1),(192,99,2,2),(193,100,1,1),(194,100,2,2),(195,101,1,1),(196,101,2,2),(197,102,1,1),(198,102,2,2),(199,103,1,1),(200,103,2,2),(201,104,1,1),(202,104,2,2),(203,105,1,1),(204,105,2,2),(205,106,1,1),(206,106,2,2),(207,107,1,1),(208,107,2,2),(209,108,1,1),(210,108,2,2),(211,109,1,1),(212,109,2,2),(213,110,1,1),(214,110,2,2),(215,111,1,1),(216,111,2,2),(217,112,1,1),(218,112,2,2),(219,113,1,1),(220,113,2,2),(221,116,1,1),(222,116,2,2),(223,128,1,1),(224,128,1,1),(225,128,1,1),(226,128,1,1),(227,129,1,1),(228,129,1,1),(229,129,1,1),(230,129,1,1),(231,130,1,1),(232,130,1,1),(233,130,1,1),(234,130,1,1),(235,131,1,1),(236,131,1,1),(237,131,1,1),(238,131,1,1),(239,133,1,1),(240,133,1,1),(241,133,1,1),(242,133,1,1),(243,133,1,1),(244,133,1,1),(245,133,1,1),(246,133,1,1),(247,133,1,1),(248,133,1,1),(266,142,1,1),(267,142,1,1),(268,142,1,1),(269,142,1,1),(270,142,1,1),(271,142,1,1),(272,142,1,1),(273,142,1,1),(274,142,1,1),(275,142,1,1),(280,144,1,1),(281,144,1,1),(282,144,1,1),(283,144,1,1),(284,144,1,1),(285,144,1,1),(286,144,1,1),(287,144,1,1),(288,144,1,1),(289,144,1,1),(301,148,19,1),(302,148,19,1),(303,148,19,1),(304,149,19,1),(305,150,19,1),(306,150,19,1),(307,150,19,1),(308,151,1,1),(309,151,2,2),(310,152,1,1),(311,152,2,2),(314,154,1,1),(315,154,2,2),(316,155,1,1),(317,155,2,2),(318,156,1,1),(319,156,2,2),(320,157,1,1),(321,157,2,2),(322,158,1,1),(323,158,2,2),(324,159,1,1),(325,159,2,2),(326,160,1,1),(327,160,2,2),(328,161,1,1),(329,161,2,2),(336,165,1,1),(337,165,2,2),(338,166,1,1),(339,166,2,2),(340,167,19,1),(341,167,19,1),(342,167,19,1),(343,168,19,1),(344,168,19,1),(345,168,19,1),(346,168,19,1),(347,169,19,1),(348,169,19,1),(349,169,19,1),(350,169,19,1),(351,170,19,1),(352,171,19,1),(353,172,19,1),(354,173,19,1),(355,174,19,1),(356,175,19,1),(357,176,19,1),(358,177,19,1),(359,178,19,1),(360,179,19,1),(361,180,19,1),(362,181,19,1),(363,182,19,1),(364,183,19,1),(365,184,19,1),(366,185,19,1),(367,186,19,1),(368,187,19,1),(369,188,19,1),(370,189,19,1),(371,190,19,1),(372,191,19,1),(373,192,19,1),(374,193,19,1),(375,194,19,1),(376,194,19,1),(377,195,19,1),(378,196,19,1),(379,197,19,1),(380,198,19,1),(381,199,19,1),(382,200,19,1),(383,201,19,1),(384,201,19,1),(385,202,19,1),(386,202,19,1),(387,202,19,1),(388,203,19,1),(389,203,19,1),(390,203,19,1),(391,205,19,1),(392,206,19,1),(393,207,3,1),(394,208,19,1),(395,208,19,1),(396,210,19,1),(397,211,19,1),(398,212,19,1),(399,212,19,1),(400,212,19,1),(401,213,19,1),(402,213,19,1),(403,213,19,1),(404,214,19,1),(405,214,19,1),(406,214,19,1),(407,214,19,1),(408,214,19,1),(409,214,19,1),(410,215,19,1),(411,215,19,1),(412,215,19,1),(413,216,19,1),(414,217,19,1),(415,217,19,1),(416,217,19,1),(417,218,19,1),(418,218,19,1),(419,218,19,1),(420,219,19,1),(421,219,19,1),(422,219,19,1),(423,219,19,1);
/*!40000 ALTER TABLE `store_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_order_status`
--

DROP TABLE IF EXISTS `store_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_order_status`
--

LOCK TABLES `store_order_status` WRITE;
/*!40000 ALTER TABLE `store_order_status` DISABLE KEYS */;
REPLACE INTO `store_order_status` VALUES (1,1,'Mới đặt'),(2,2,'Đã xác nhận'),(3,3,'Đang mang cho khách');
/*!40000 ALTER TABLE `store_order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_prop_data_types`
--

DROP TABLE IF EXISTS `store_prop_data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_prop_data_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_value` int(11) DEFAULT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_prop_data_types`
--

LOCK TABLES `store_prop_data_types` WRITE;
/*!40000 ALTER TABLE `store_prop_data_types` DISABLE KEYS */;
REPLACE INTO `store_prop_data_types` VALUES (1,1,'int'),(2,2,'string'),(3,3,'decimal'),(4,4,'date');
/*!40000 ALTER TABLE `store_prop_data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_store`
--

DROP TABLE IF EXISTS `store_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_store` (
  `id` int(11) NOT NULL,
  `lat` decimal(18,6) DEFAULT NULL,
  `long` decimal(18,6) DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_store`
--

LOCK TABLES `store_store` WRITE;
/*!40000 ALTER TABLE `store_store` DISABLE KEYS */;
REPLACE INTO `store_store` VALUES (1,1.000000,1.000000,'1','Store1','1'),(2,20000.000000,4.000000,'1','Store2','1');
/*!40000 ALTER TABLE `store_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_type_location`
--

DROP TABLE IF EXISTS `store_type_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_type_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_type_location`
--

LOCK TABLES `store_type_location` WRITE;
/*!40000 ALTER TABLE `store_type_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_type_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_user_store`
--

DROP TABLE IF EXISTS `store_user_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `store_user_store` (
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`store_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_user_store`
--

LOCK TABLES `store_user_store` WRITE;
/*!40000 ALTER TABLE `store_user_store` DISABLE KEYS */;
REPLACE INTO `store_user_store` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `store_user_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_languages`
--

DROP TABLE IF EXISTS `sys_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_languages` (
  `id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_languages`
--

LOCK TABLES `sys_languages` WRITE;
/*!40000 ALTER TABLE `sys_languages` DISABLE KEYS */;
REPLACE INTO `sys_languages` VALUES (1,'jp','Japanese',NULL),(2,'en','English',NULL),(3,'fr','France',NULL);
/*!40000 ALTER TABLE `sys_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_modules`
--

DROP TABLE IF EXISTS `sys_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_code` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_value` int(11) DEFAULT NULL,
  `is_skip_acl` tinyint(4) DEFAULT NULL COMMENT 'skips show acl in form, but not affect to action check acl',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_modules`
--

LOCK TABLES `sys_modules` WRITE;
/*!40000 ALTER TABLE `sys_modules` DISABLE KEYS */;
REPLACE INTO `sys_modules` VALUES (1,'','',1,0),(2,'dev','dev',2,1),(3,'laravel','laravel',3,1),(4,'auth','auth',4,0),(5,'acl','acl',5,0),(6,'api','api',6,0),(7,'backend','backend',7,0),(8,'frontend','frontend',8,0);
/*!40000 ALTER TABLE `sys_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_role_map_screen`
--

DROP TABLE IF EXISTS `sys_role_map_screen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_role_map_screen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_value` int(11) DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2048 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_role_map_screen`
--

LOCK TABLES `sys_role_map_screen` WRITE;
/*!40000 ALTER TABLE `sys_role_map_screen` DISABLE KEYS */;
REPLACE INTO `sys_role_map_screen` VALUES (1,0,1,1),(2,0,2,1),(3,0,3,1),(4,0,4,1),(5,0,5,1),(6,0,12,1),(7,0,5,1),(8,0,12,1),(9,0,5,1),(10,0,12,1),(11,0,5,1),(12,0,12,1),(13,0,5,1),(14,0,12,1),(15,0,5,1),(16,0,12,1),(17,0,5,1),(18,0,12,1),(19,0,5,1),(20,0,12,1),(21,0,5,1),(22,0,12,1),(23,0,5,1),(24,0,12,1),(25,0,5,1),(26,0,12,1),(27,0,5,1),(28,0,12,1),(29,0,5,1),(30,0,12,1),(31,0,5,1),(32,0,12,1),(33,0,5,1),(34,0,12,1),(35,0,5,1),(36,0,12,1),(37,0,5,1),(38,0,12,1),(39,0,5,1),(40,0,12,1),(41,0,5,1),(42,0,12,1),(43,0,5,1),(44,0,12,1),(45,0,5,1),(46,0,12,1),(47,0,5,1),(48,0,12,1),(49,0,5,1),(50,0,12,1),(51,0,5,1),(52,0,12,1),(53,0,5,1),(54,0,12,1),(55,0,5,1),(56,0,12,1),(57,0,5,1),(58,0,12,1),(59,0,5,1),(60,0,12,1),(61,0,5,1),(62,0,12,1),(63,0,5,1),(64,0,12,1),(65,0,5,1),(66,0,12,1),(67,0,5,1),(68,0,12,1),(69,0,6,1),(70,0,7,1),(71,0,8,1),(72,0,9,1),(73,0,10,1),(74,0,11,1),(75,0,13,1),(76,0,14,1),(77,0,15,1),(78,0,16,1),(79,0,17,1),(80,0,18,1),(81,0,19,1),(82,0,20,1),(83,0,21,1),(84,0,22,1),(85,0,23,1),(86,0,24,1),(87,0,25,1),(88,0,26,1),(89,0,27,1),(90,0,28,1),(91,0,29,1),(92,0,30,1),(93,0,31,1),(94,0,32,1),(95,0,33,1),(96,0,34,1),(97,0,35,1),(98,0,36,1),(99,0,37,1),(100,0,38,1),(101,0,39,1),(102,0,40,1),(103,0,41,1),(104,0,42,1),(105,0,43,1),(106,0,44,1),(107,0,45,1),(108,0,46,1),(109,0,47,1),(110,0,48,1),(111,0,49,1),(112,0,50,1),(113,0,51,1),(114,0,52,1),(115,0,53,1),(116,0,54,1),(117,0,55,1),(118,0,56,1),(119,0,57,1),(120,0,58,1),(121,0,59,1),(122,0,60,1),(123,0,61,1),(124,0,62,1),(125,0,63,1),(126,0,64,1),(127,0,65,1),(128,0,66,1),(129,0,67,1),(130,0,69,1),(131,0,70,1),(132,0,71,1),(133,0,72,1),(134,0,73,1),(135,0,74,1),(136,0,75,1),(137,0,76,1),(138,0,77,1),(139,0,78,1),(140,0,79,1),(141,0,80,1),(142,0,81,1),(143,0,82,1),(144,0,83,1),(145,0,84,1),(146,0,85,1),(147,0,86,1),(148,0,87,1),(149,0,88,1),(150,0,89,1),(151,0,90,1),(152,0,91,1),(153,0,92,1),(154,0,93,1),(155,0,94,1),(156,0,95,1),(157,0,96,1),(158,0,97,1),(159,0,98,1),(160,0,99,1),(161,0,100,1),(162,0,101,1),(163,0,102,1),(164,0,103,1),(165,0,104,1),(166,0,105,1),(167,0,106,1),(168,0,107,1),(169,0,108,1),(170,0,109,1),(171,0,110,1),(172,0,111,1),(173,0,112,1),(174,0,113,1),(175,0,114,1),(176,0,115,1),(177,0,116,1),(178,0,117,1),(179,0,118,1),(180,0,119,1),(181,0,120,1),(182,0,121,1),(183,0,122,1),(184,0,123,1),(185,0,128,1),(186,0,129,1),(187,0,130,1),(188,0,131,1),(189,1,1,1),(190,1,2,1),(191,1,3,1),(192,1,4,1),(193,1,5,1),(194,1,12,1),(195,1,5,1),(196,1,12,1),(197,1,5,1),(198,1,12,1),(199,1,5,1),(200,1,12,1),(201,1,5,1),(202,1,12,1),(203,1,5,1),(204,1,12,1),(205,1,5,1),(206,1,12,1),(207,1,5,1),(208,1,12,1),(209,1,5,1),(210,1,12,1),(211,1,5,1),(212,1,12,1),(213,1,5,1),(214,1,12,1),(215,1,5,1),(216,1,12,1),(217,1,5,1),(218,1,12,1),(219,1,5,1),(220,1,12,1),(221,1,5,1),(222,1,12,1),(223,1,5,1),(224,1,12,1),(225,1,5,1),(226,1,12,1),(227,1,5,1),(228,1,12,1),(229,1,5,1),(230,1,12,1),(231,1,5,1),(232,1,12,1),(233,1,5,1),(234,1,12,1),(235,1,5,1),(236,1,12,1),(237,1,5,1),(238,1,12,1),(239,1,5,1),(240,1,12,1),(241,1,5,1),(242,1,12,1),(243,1,5,1),(244,1,12,1),(245,1,5,1),(246,1,12,1),(247,1,5,1),(248,1,12,1),(249,1,5,1),(250,1,12,1),(251,1,5,1),(252,1,12,1),(253,1,5,1),(254,1,12,1),(255,1,5,1),(256,1,12,1),(257,1,6,1),(258,1,7,1),(259,1,8,1),(260,1,9,1),(261,1,10,1),(262,1,11,1),(263,1,13,1),(264,1,14,1),(265,1,15,1),(266,1,16,1),(267,1,17,1),(268,1,18,1),(269,1,19,1),(270,1,20,1),(271,1,21,1),(272,1,22,1),(273,1,23,1),(274,1,24,1),(275,1,25,1),(276,1,26,1),(277,1,27,1),(278,1,28,1),(279,1,29,1),(280,1,30,1),(281,1,31,1),(282,1,32,1),(283,1,33,1),(284,1,34,1),(285,1,35,1),(286,1,36,1),(287,1,37,1),(288,1,38,1),(289,1,39,1),(290,1,40,1),(291,1,41,1),(292,1,42,1),(293,1,43,1),(294,1,44,1),(295,1,45,1),(296,1,46,1),(297,1,47,1),(298,1,48,1),(299,1,49,1),(300,1,50,1),(301,1,51,1),(302,1,52,1),(303,1,53,1),(304,1,54,1),(305,1,55,1),(306,1,56,1),(307,1,57,1),(308,1,58,1),(309,1,59,1),(310,1,60,1),(311,1,61,1),(312,1,62,1),(313,1,63,1),(314,1,64,1),(315,1,65,1),(316,1,66,1),(317,1,67,1),(318,1,69,1),(319,1,70,1),(320,1,71,1),(321,1,72,1),(322,1,73,1),(323,1,74,1),(324,1,75,1),(325,1,76,1),(326,1,77,1),(327,1,78,1),(328,1,79,1),(329,1,80,1),(330,1,81,1),(331,1,82,1),(332,1,83,1),(333,1,84,1),(334,1,85,1),(335,1,86,1),(336,1,87,1),(337,1,88,1),(338,1,89,1),(339,1,90,1),(340,1,91,1),(341,1,92,1),(342,1,93,1),(343,1,94,1),(344,1,95,1),(345,1,96,1),(346,1,97,1),(347,1,98,1),(348,1,99,1),(349,1,100,1),(350,1,101,1),(351,1,102,1),(352,1,103,1),(353,1,104,1),(354,1,105,1),(355,1,106,1),(356,1,107,1),(357,1,108,1),(358,1,109,1),(359,1,110,1),(360,1,111,1),(361,1,112,1),(362,1,113,1),(363,1,114,1),(364,1,115,1),(365,1,116,1),(366,1,117,1),(367,1,118,1),(368,1,119,1),(369,1,120,1),(370,1,121,1),(371,1,122,1),(372,1,123,1),(373,1,128,1),(374,1,129,1),(375,1,130,1),(376,1,131,1),(377,2,1,1),(378,2,2,1),(379,2,3,1),(380,2,4,1),(381,2,5,1),(382,2,12,1),(383,2,5,1),(384,2,12,1),(385,2,5,1),(386,2,12,1),(387,2,5,1),(388,2,12,1),(389,2,5,1),(390,2,12,1),(391,2,5,1),(392,2,12,1),(393,2,5,1),(394,2,12,1),(395,2,5,1),(396,2,12,1),(397,2,5,1),(398,2,12,1),(399,2,5,1),(400,2,12,1),(401,2,5,1),(402,2,12,1),(403,2,5,1),(404,2,12,1),(405,2,5,1),(406,2,12,1),(407,2,5,1),(408,2,12,1),(409,2,5,1),(410,2,12,1),(411,2,5,1),(412,2,12,1),(413,2,5,1),(414,2,12,1),(415,2,5,1),(416,2,12,1),(417,2,5,1),(418,2,12,1),(419,2,5,1),(420,2,12,1),(421,2,5,1),(422,2,12,1),(423,2,5,1),(424,2,12,1),(425,2,5,1),(426,2,12,1),(427,2,5,1),(428,2,12,1),(429,2,5,1),(430,2,12,1),(431,2,5,1),(432,2,12,1),(433,2,5,1),(434,2,12,1),(435,2,5,1),(436,2,12,1),(437,2,5,1),(438,2,12,1),(439,2,5,1),(440,2,12,1),(441,2,5,1),(442,2,12,1),(443,2,5,1),(444,2,12,1),(445,2,6,1),(446,2,7,1),(447,2,8,1),(448,2,9,1),(449,2,10,1),(450,2,11,1),(451,2,13,1),(452,2,14,1),(453,2,15,1),(454,2,16,1),(455,2,17,1),(456,2,18,1),(457,2,19,1),(458,2,20,1),(459,2,21,1),(460,2,22,1),(461,2,23,1),(462,2,24,1),(463,2,25,1),(464,2,26,1),(465,2,27,1),(466,2,28,1),(467,2,29,1),(468,2,30,1),(469,2,31,1),(470,2,32,1),(471,2,33,1),(472,2,34,1),(473,2,35,1),(474,2,36,1),(475,2,37,1),(476,2,38,1),(477,2,39,1),(478,2,40,1),(479,2,41,1),(480,2,42,1),(481,2,43,1),(482,2,44,1),(483,2,45,1),(484,2,46,1),(485,2,47,1),(486,2,48,1),(487,2,49,1),(488,2,50,1),(489,2,51,1),(490,2,52,1),(491,2,53,1),(492,2,54,1),(493,2,55,1),(494,2,56,1),(495,2,57,1),(496,2,58,1),(497,2,59,1),(498,2,60,1),(499,2,61,1),(500,2,62,1),(501,2,63,1),(502,2,64,1),(503,2,65,1),(504,2,66,1),(505,2,67,1),(506,2,69,1),(507,2,70,1),(508,2,71,1),(509,2,72,1),(510,2,73,1),(511,2,74,1),(512,2,75,1),(513,2,76,1),(514,2,77,1),(515,2,78,1),(516,2,79,1),(517,2,80,1),(518,2,81,1),(519,2,82,1),(520,2,83,1),(521,2,84,1),(522,2,85,1),(523,2,86,1),(524,2,87,1),(525,2,88,1),(526,2,89,1),(527,2,90,1),(528,2,91,1),(529,2,92,1),(530,2,93,1),(531,2,94,1),(532,2,95,1),(533,2,96,1),(534,2,97,1),(535,2,98,1),(536,2,99,1),(537,2,100,1),(538,2,101,1),(539,2,102,1),(540,2,103,1),(541,2,104,1),(542,2,105,1),(543,2,106,1),(544,2,107,1),(545,2,108,1),(546,2,109,1),(547,2,110,1),(548,2,111,1),(549,2,112,1),(550,2,113,1),(551,2,114,1),(552,2,115,1),(553,2,116,1),(554,2,117,1),(555,2,118,1),(556,2,119,1),(557,2,120,1),(558,2,121,1),(559,2,122,1),(560,2,123,1),(561,2,128,1),(562,2,129,1),(563,2,130,1),(564,2,131,1),(565,3,1,1),(566,3,2,1),(567,3,3,1),(568,3,4,1),(569,3,5,1),(570,3,12,1),(571,3,5,1),(572,3,12,1),(573,3,5,1),(574,3,12,1),(575,3,5,1),(576,3,12,1),(577,3,5,1),(578,3,12,1),(579,3,5,1),(580,3,12,1),(581,3,5,1),(582,3,12,1),(583,3,5,1),(584,3,12,1),(585,3,5,1),(586,3,12,1),(587,3,5,1),(588,3,12,1),(589,3,5,1),(590,3,12,1),(591,3,5,1),(592,3,12,1),(593,3,5,1),(594,3,12,1),(595,3,5,1),(596,3,12,1),(597,3,5,1),(598,3,12,1),(599,3,5,1),(600,3,12,1),(601,3,5,1),(602,3,12,1),(603,3,5,1),(604,3,12,1),(605,3,5,1),(606,3,12,1),(607,3,5,1),(608,3,12,1),(609,3,5,1),(610,3,12,1),(611,3,5,1),(612,3,12,1),(613,3,5,1),(614,3,12,1),(615,3,5,1),(616,3,12,1),(617,3,5,1),(618,3,12,1),(619,3,5,1),(620,3,12,1),(621,3,5,1),(622,3,12,1),(623,3,5,1),(624,3,12,1),(625,3,5,1),(626,3,12,1),(627,3,5,1),(628,3,12,1),(629,3,5,1),(630,3,12,1),(631,3,5,1),(632,3,12,1),(633,3,6,1),(634,3,7,1),(635,3,8,1),(636,3,9,1),(637,3,10,1),(638,3,11,1),(639,3,13,1),(640,3,14,1),(641,3,15,1),(642,3,16,1),(643,3,17,1),(644,3,18,1),(645,3,19,1),(646,3,20,1),(647,3,21,1),(648,3,22,1),(649,3,23,1),(650,3,24,1),(651,3,25,1),(652,3,26,1),(653,3,27,1),(654,3,28,1),(655,3,29,1),(656,3,30,1),(657,3,31,1),(658,3,32,1),(659,3,33,1),(660,3,34,1),(661,3,35,1),(662,3,36,1),(663,3,37,1),(664,3,38,1),(665,3,39,1),(666,3,40,1),(667,3,41,1),(668,3,42,1),(669,3,43,1),(670,3,44,1),(671,3,45,1),(672,3,46,1),(673,3,47,1),(674,3,48,1),(675,3,49,1),(676,3,50,1),(677,3,51,1),(678,3,52,1),(679,3,53,1),(680,3,54,1),(681,3,55,1),(682,3,56,1),(683,3,57,1),(684,3,58,1),(685,3,59,1),(686,3,60,1),(687,3,61,1),(688,3,62,1),(689,3,63,1),(690,3,64,1),(691,3,65,1),(692,3,66,1),(693,3,67,1),(694,3,69,1),(695,3,70,1),(696,3,71,1),(697,3,72,1),(698,3,73,1),(699,3,74,1),(700,3,75,1),(701,3,76,1),(702,3,77,1),(703,3,78,1),(704,3,79,1),(705,3,80,1),(706,3,81,1),(707,3,82,1),(708,3,83,1),(709,3,84,1),(710,3,85,1),(711,3,86,1),(712,3,87,1),(713,3,88,1),(714,3,89,1),(715,3,90,1),(716,3,91,1),(717,3,92,1),(718,3,93,1),(719,3,94,1),(720,3,95,1),(721,3,96,1),(722,3,97,1),(723,3,98,1),(724,3,99,1),(725,3,100,1),(726,3,101,1),(727,3,102,1),(728,3,103,1),(729,3,104,1),(730,3,105,1),(731,3,106,1),(732,3,107,1),(733,3,108,1),(734,3,109,1),(735,3,110,1),(736,3,111,1),(737,3,112,1),(738,3,113,1),(739,3,114,1),(740,3,115,1),(741,3,116,1),(742,3,117,1),(743,3,118,1),(744,3,119,1),(745,3,120,1),(746,3,121,1),(747,3,122,1),(748,3,123,1),(749,3,128,1),(750,3,129,1),(751,3,130,1),(752,3,131,1),(753,4,1,1),(754,4,2,1),(755,4,3,1),(756,4,4,1),(757,4,5,1),(758,4,12,1),(759,4,5,1),(760,4,12,1),(761,4,5,1),(762,4,12,1),(763,4,5,1),(764,4,12,1),(765,4,5,1),(766,4,12,1),(767,4,5,1),(768,4,12,1),(769,4,5,1),(770,4,12,1),(771,4,5,1),(772,4,12,1),(773,4,5,1),(774,4,12,1),(775,4,5,1),(776,4,12,1),(777,4,5,1),(778,4,12,1),(779,4,5,1),(780,4,12,1),(781,4,5,1),(782,4,12,1),(783,4,5,1),(784,4,12,1),(785,4,5,1),(786,4,12,1),(787,4,5,1),(788,4,12,1),(789,4,5,1),(790,4,12,1),(791,4,5,1),(792,4,12,1),(793,4,5,1),(794,4,12,1),(795,4,5,1),(796,4,12,1),(797,4,5,1),(798,4,12,1),(799,4,5,1),(800,4,12,1),(801,4,5,1),(802,4,12,1),(803,4,5,1),(804,4,12,1),(805,4,5,1),(806,4,12,1),(807,4,5,1),(808,4,12,1),(809,4,5,1),(810,4,12,1),(811,4,5,1),(812,4,12,1),(813,4,5,1),(814,4,12,1),(815,4,5,1),(816,4,12,1),(817,4,5,1),(818,4,12,1),(819,4,5,1),(820,4,12,1),(821,4,6,1),(822,4,7,1),(823,4,8,1),(824,4,9,1),(825,4,10,1),(826,4,11,1),(827,4,13,1),(828,4,14,1),(829,4,15,1),(830,4,16,1),(831,4,17,1),(832,4,18,1),(833,4,19,1),(834,4,20,1),(835,4,21,1),(836,4,22,1),(837,4,23,1),(838,4,24,1),(839,4,25,1),(840,4,26,1),(841,4,27,1),(842,4,28,1),(843,4,29,1),(844,4,30,1),(845,4,31,1),(846,4,32,1),(847,4,33,1),(848,4,34,1),(849,4,35,1),(850,4,36,1),(851,4,37,1),(852,4,38,1),(853,4,39,1),(854,4,40,1),(855,4,41,1),(856,4,42,1),(857,4,43,1),(858,4,44,1),(859,4,45,1),(860,4,46,1),(861,4,47,1),(862,4,48,1),(863,4,49,1),(864,4,50,1),(865,4,51,1),(866,4,52,1),(867,4,53,1),(868,4,54,1),(869,4,55,1),(870,4,56,1),(871,4,57,1),(872,4,58,1),(873,4,59,1),(874,4,60,1),(875,4,61,1),(876,4,62,1),(877,4,63,1),(878,4,64,1),(879,4,65,1),(880,4,66,1),(881,4,67,1),(882,4,69,1),(883,4,70,1),(884,4,71,1),(885,4,72,1),(886,4,73,1),(887,4,74,1),(888,4,75,1),(889,4,76,1),(890,4,77,1),(891,4,78,1),(892,4,79,1),(893,4,80,1),(894,4,81,1),(895,4,82,1),(896,4,83,1),(897,4,84,1),(898,4,85,1),(899,4,86,1),(900,4,87,1),(901,4,88,1),(902,4,89,1),(903,4,90,1),(904,4,91,1),(905,4,92,1),(906,4,93,1),(907,4,94,1),(908,4,95,1),(909,4,96,1),(910,4,97,1),(911,4,98,1),(912,4,99,1),(913,4,100,1),(914,4,101,1),(915,4,102,1),(916,4,103,1),(917,4,104,1),(918,4,105,1),(919,4,106,1),(920,4,107,1),(921,4,108,1),(922,4,109,1),(923,4,110,1),(924,4,111,1),(925,4,112,1),(926,4,113,1),(927,4,114,1),(928,4,115,1),(929,4,116,1),(930,4,117,1),(931,4,118,1),(932,4,119,1),(933,4,120,1),(934,4,121,1),(935,4,122,1),(936,4,123,1),(937,4,128,1),(938,4,129,1),(939,4,130,1),(940,4,131,1),(941,5,1,1),(942,5,2,1),(943,5,3,1),(944,5,4,1),(945,5,5,1),(946,5,12,1),(947,5,5,1),(948,5,12,1),(949,5,5,1),(950,5,12,1),(951,5,5,1),(952,5,12,1),(953,5,5,1),(954,5,12,1),(955,5,5,1),(956,5,12,1),(957,5,5,1),(958,5,12,1),(959,5,5,1),(960,5,12,1),(961,5,5,1),(962,5,12,1),(963,5,5,1),(964,5,12,1),(965,5,5,1),(966,5,12,1),(967,5,5,1),(968,5,12,1),(969,5,5,1),(970,5,12,1),(971,5,5,1),(972,5,12,1),(973,5,5,1),(974,5,12,1),(975,5,5,1),(976,5,12,1),(977,5,5,1),(978,5,12,1),(979,5,5,1),(980,5,12,1),(981,5,5,1),(982,5,12,1),(983,5,5,1),(984,5,12,1),(985,5,5,1),(986,5,12,1),(987,5,5,1),(988,5,12,1),(989,5,5,1),(990,5,12,1),(991,5,5,1),(992,5,12,1),(993,5,5,1),(994,5,12,1),(995,5,5,1),(996,5,12,1),(997,5,5,1),(998,5,12,1),(999,5,5,1),(1000,5,12,1),(1001,5,5,1),(1002,5,12,1),(1003,5,5,1),(1004,5,12,1),(1005,5,5,1),(1006,5,12,1),(1007,5,5,1),(1008,5,12,1),(1009,5,6,1),(1010,5,7,1),(1011,5,8,1),(1012,5,9,1),(1013,5,10,1),(1014,5,11,1),(1015,5,13,1),(1016,5,14,1),(1017,5,15,1),(1018,5,16,1),(1019,5,17,1),(1020,5,18,1),(1021,5,19,1),(1022,5,20,1),(1023,5,21,1),(1024,5,22,1),(1025,5,23,1),(1026,5,24,1),(1027,5,25,1),(1028,5,26,1),(1029,5,27,1),(1030,5,28,1),(1031,5,29,1),(1032,5,30,1),(1033,5,31,1),(1034,5,32,1),(1035,5,33,1),(1036,5,34,1),(1037,5,35,1),(1038,5,36,1),(1039,5,37,1),(1040,5,38,1),(1041,5,39,1),(1042,5,40,1),(1043,5,41,1),(1044,5,42,1),(1045,5,43,1),(1046,5,44,1),(1047,5,45,1),(1048,5,46,1),(1049,5,47,1),(1050,5,48,1),(1051,5,49,1),(1052,5,50,1),(1053,5,51,1),(1054,5,52,1),(1055,5,53,1),(1056,5,54,1),(1057,5,55,1),(1058,5,56,1),(1059,5,57,1),(1060,5,58,1),(1061,5,59,1),(1062,5,60,1),(1063,5,61,1),(1064,5,62,1),(1065,5,63,1),(1066,5,64,1),(1067,5,65,1),(1068,5,66,1),(1069,5,67,1),(1070,5,69,1),(1071,5,70,1),(1072,5,71,1),(1073,5,72,1),(1074,5,73,1),(1075,5,74,1),(1076,5,75,1),(1077,5,76,1),(1078,5,77,1),(1079,5,78,1),(1080,5,79,1),(1081,5,80,1),(1082,5,81,1),(1083,5,82,1),(1084,5,83,1),(1085,5,84,1),(1086,5,85,1),(1087,5,86,1),(1088,5,87,1),(1089,5,88,1),(1090,5,89,1),(1091,5,90,1),(1092,5,91,1),(1093,5,92,1),(1094,5,93,1),(1095,5,94,1),(1096,5,95,1),(1097,5,96,1),(1098,5,97,1),(1099,5,98,1),(1100,5,99,1),(1101,5,100,1),(1102,5,101,1),(1103,5,102,1),(1104,5,103,1),(1105,5,104,1),(1106,5,105,1),(1107,5,106,1),(1108,5,107,1),(1109,5,108,1),(1110,5,109,1),(1111,5,110,1),(1112,5,111,1),(1113,5,112,1),(1114,5,113,1),(1115,5,114,1),(1116,5,115,1),(1117,5,116,1),(1118,5,117,1),(1119,5,118,1),(1120,5,119,1),(1121,5,120,1),(1122,5,121,1),(1123,5,122,1),(1124,5,123,1),(1125,5,128,1),(1126,5,129,1),(1127,5,130,1),(1128,5,131,1),(1129,6,1,1),(1130,6,2,1),(1131,6,3,1),(1132,6,4,1),(1133,6,5,1),(1134,6,12,1),(1135,6,5,1),(1136,6,12,1),(1137,6,5,1),(1138,6,12,1),(1139,6,5,1),(1140,6,12,1),(1141,6,5,1),(1142,6,12,1),(1143,6,5,1),(1144,6,12,1),(1145,6,5,1),(1146,6,12,1),(1147,6,5,1),(1148,6,12,1),(1149,6,5,1),(1150,6,12,1),(1151,6,5,1),(1152,6,12,1),(1153,6,5,1),(1154,6,12,1),(1155,6,5,1),(1156,6,12,1),(1157,6,5,1),(1158,6,12,1),(1159,6,5,1),(1160,6,12,1),(1161,6,5,1),(1162,6,12,1),(1163,6,5,1),(1164,6,12,1),(1165,6,5,1),(1166,6,12,1),(1167,6,5,1),(1168,6,12,1),(1169,6,5,1),(1170,6,12,1),(1171,6,5,1),(1172,6,12,1),(1173,6,5,1),(1174,6,12,1),(1175,6,5,1),(1176,6,12,1),(1177,6,5,1),(1178,6,12,1),(1179,6,5,1),(1180,6,12,1),(1181,6,5,1),(1182,6,12,1),(1183,6,5,1),(1184,6,12,1),(1185,6,5,1),(1186,6,12,1),(1187,6,5,1),(1188,6,12,1),(1189,6,5,1),(1190,6,12,1),(1191,6,5,1),(1192,6,12,1),(1193,6,5,1),(1194,6,12,1),(1195,6,5,1),(1196,6,12,1),(1197,6,6,1),(1198,6,7,1),(1199,6,8,1),(1200,6,9,1),(1201,6,10,1),(1202,6,11,1),(1203,6,13,1),(1204,6,14,1),(1205,6,15,1),(1206,6,16,1),(1207,6,17,1),(1208,6,18,1),(1209,6,19,1),(1210,6,20,1),(1211,6,21,1),(1212,6,22,1),(1213,6,23,1),(1214,6,24,1),(1215,6,25,1),(1216,6,26,1),(1217,6,27,1),(1218,6,28,1),(1219,6,29,1),(1220,6,30,1),(1221,6,31,1),(1222,6,32,1),(1223,6,33,1),(1224,6,34,1),(1225,6,35,1),(1226,6,36,1),(1227,6,37,1),(1228,6,38,1),(1229,6,39,1),(1230,6,40,1),(1231,6,41,1),(1232,6,42,1),(1233,6,43,1),(1234,6,44,1),(1235,6,45,1),(1236,6,46,1),(1237,6,47,1),(1238,6,48,1),(1239,6,49,1),(1240,6,50,1),(1241,6,51,1),(1242,6,52,1),(1243,6,53,1),(1244,6,54,1),(1245,6,55,1),(1246,6,56,1),(1247,6,57,1),(1248,6,58,1),(1249,6,59,1),(1250,6,60,1),(1251,6,61,1),(1252,6,62,1),(1253,6,63,1),(1254,6,64,1),(1255,6,65,1),(1256,6,66,1),(1257,6,67,1),(1258,6,69,1),(1259,6,70,1),(1260,6,71,1),(1261,6,72,1),(1262,6,73,1),(1263,6,74,1),(1264,6,75,1),(1265,6,76,1),(1266,6,77,1),(1267,6,78,1),(1268,6,79,1),(1269,6,80,1),(1270,6,81,1),(1271,6,82,1),(1272,6,83,1),(1273,6,84,1),(1274,6,85,1),(1275,6,86,1),(1276,6,87,1),(1277,6,88,1),(1278,6,89,1),(1279,6,90,1),(1280,6,91,1),(1281,6,92,1),(1282,6,93,1),(1283,6,94,1),(1284,6,95,1),(1285,6,96,1),(1286,6,97,1),(1287,6,98,1),(1288,6,99,1),(1289,6,100,1),(1290,6,101,1),(1291,6,102,1),(1292,6,103,1),(1293,6,104,1),(1294,6,105,1),(1295,6,106,1),(1296,6,107,1),(1297,6,108,1),(1298,6,109,1),(1299,6,110,1),(1300,6,111,1),(1301,6,112,1),(1302,6,113,1),(1303,6,114,1),(1304,6,115,1),(1305,6,116,1),(1306,6,117,1),(1307,6,118,1),(1308,6,119,1),(1309,6,120,1),(1310,6,121,1),(1311,6,122,1),(1312,6,123,1),(1313,6,128,1),(1314,6,129,1),(1315,6,130,1),(1316,6,131,1),(1317,10,1,1),(1318,10,2,1),(1319,10,3,1),(1320,10,4,1),(1321,10,5,1),(1322,10,12,1),(1323,10,5,1),(1324,10,12,1),(1325,10,5,1),(1326,10,12,1),(1327,10,5,1),(1328,10,12,1),(1329,10,5,1),(1330,10,12,1),(1331,10,5,1),(1332,10,12,1),(1333,10,5,1),(1334,10,12,1),(1335,10,5,1),(1336,10,12,1),(1337,10,5,1),(1338,10,12,1),(1339,10,5,1),(1340,10,12,1),(1341,10,5,1),(1342,10,12,1),(1343,10,5,1),(1344,10,12,1),(1345,10,5,1),(1346,10,12,1),(1347,10,5,1),(1348,10,12,1),(1349,10,5,1),(1350,10,12,1),(1351,10,5,1),(1352,10,12,1),(1353,10,5,1),(1354,10,12,1),(1355,10,5,1),(1356,10,12,1),(1357,10,5,1),(1358,10,12,1),(1359,10,5,1),(1360,10,12,1),(1361,10,5,1),(1362,10,12,1),(1363,10,5,1),(1364,10,12,1),(1365,10,5,1),(1366,10,12,1),(1367,10,5,1),(1368,10,12,1),(1369,10,5,1),(1370,10,12,1),(1371,10,5,1),(1372,10,12,1),(1373,10,5,1),(1374,10,12,1),(1375,10,5,1),(1376,10,12,1),(1377,10,5,1),(1378,10,12,1),(1379,10,5,1),(1380,10,12,1),(1381,10,5,1),(1382,10,12,1),(1383,10,5,1),(1384,10,12,1),(1385,10,6,1),(1386,10,7,1),(1387,10,8,1),(1388,10,9,1),(1389,10,10,1),(1390,10,11,1),(1391,10,13,1),(1392,10,14,1),(1393,10,15,1),(1394,10,16,1),(1395,10,17,1),(1396,10,18,1),(1397,10,19,1),(1398,10,20,1),(1399,10,21,1),(1400,10,22,1),(1401,10,23,1),(1402,10,24,1),(1403,10,25,1),(1404,10,26,1),(1405,10,27,1),(1406,10,28,1),(1407,10,29,1),(1408,10,30,1),(1409,10,31,1),(1410,10,32,1),(1411,10,33,1),(1412,10,34,1),(1413,10,35,1),(1414,10,36,1),(1415,10,37,1),(1416,10,38,1),(1417,10,39,1),(1418,10,40,1),(1419,10,41,1),(1420,10,42,1),(1421,10,43,1),(1422,10,44,1),(1423,10,45,1),(1424,10,46,1),(1425,10,47,1),(1426,10,48,1),(1427,10,49,1),(1428,10,50,1),(1429,10,51,1),(1430,10,52,1),(1431,10,53,1),(1432,10,54,1),(1433,10,55,1),(1434,10,56,1),(1435,10,57,1),(1436,10,58,1),(1437,10,59,1),(1438,10,60,1),(1439,10,61,1),(1440,10,62,1),(1441,10,63,1),(1442,10,64,1),(1443,10,65,1),(1444,10,66,1),(1445,10,67,1),(1446,10,69,1),(1447,10,70,1),(1448,10,71,1),(1449,10,72,1),(1450,10,73,1),(1451,10,74,1),(1452,10,75,1),(1453,10,76,1),(1454,10,77,1),(1455,10,78,1),(1456,10,79,1),(1457,10,80,1),(1458,10,81,1),(1459,10,82,1),(1460,10,83,1),(1461,10,84,1),(1462,10,85,1),(1463,10,86,1),(1464,10,87,1),(1465,10,88,1),(1466,10,89,1),(1467,10,90,1),(1468,10,91,1),(1469,10,92,1),(1470,10,93,1),(1471,10,94,1),(1472,10,95,1),(1473,10,96,1),(1474,10,97,1),(1475,10,98,1),(1476,10,99,1),(1477,10,100,1),(1478,10,101,1),(1479,10,102,1),(1480,10,103,1),(1481,10,104,1),(1482,10,105,1),(1483,10,106,1),(1484,10,107,1),(1485,10,108,1),(1486,10,109,1),(1487,10,110,1),(1488,10,111,1),(1489,10,112,1),(1490,10,113,1),(1491,10,114,1),(1492,10,115,1),(1493,10,116,1),(1494,10,117,1),(1495,10,118,1),(1496,10,119,1),(1497,10,120,1),(1498,10,121,1),(1499,10,122,1),(1500,10,123,1),(1501,10,128,1),(1502,10,129,1),(1503,10,130,1),(1504,10,131,1),(1505,0,124,1),(1506,1,124,1),(1507,2,124,1),(1508,3,124,1),(1509,4,124,1),(1510,5,124,1),(1511,6,124,1),(1512,10,124,1),(1513,0,125,1),(1514,1,125,1),(1515,2,125,1),(1516,3,125,1),(1517,4,125,1),(1518,5,125,1),(1519,6,125,1),(1520,10,125,1),(1521,0,126,1),(1522,1,126,1),(1523,2,126,1),(1524,3,126,1),(1525,4,126,1),(1526,5,126,1),(1527,6,126,1),(1528,10,126,1),(1529,0,127,1),(1530,1,127,1),(1531,2,127,1),(1532,3,127,1),(1533,4,127,1),(1534,5,127,1),(1535,6,127,1),(1536,10,127,1),(1537,0,68,1),(1538,1,68,1),(1539,2,68,1),(1540,3,68,1),(1541,4,68,1),(1542,5,68,1),(1543,6,68,1),(1544,10,68,1);
/*!40000 ALTER TABLE `sys_role_map_screen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_roles`
--

DROP TABLE IF EXISTS `sys_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_value` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value_UNIQUE` (`role_value`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_roles`
--

LOCK TABLES `sys_roles` WRITE;
/*!40000 ALTER TABLE `sys_roles` DISABLE KEYS */;
REPLACE INTO `sys_roles` VALUES (1,'System Administrator',1,'Full access'),(2,'Mananger',2,NULL),(3,'User',3,NULL),(4,'Guess',0,NULL),(5,'OtherParty',10,NULL),(6,'Nhân viên approve',4,NULL),(7,'Nhân viên bếp',5,NULL),(8,'Nhân viên thu ngân',6,NULL);
/*!40000 ALTER TABLE `sys_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_screens`
--

DROP TABLE IF EXISTS `sys_screens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_screens` (
  `id` int(11) NOT NULL,
  `module` varchar(45) DEFAULT NULL,
  `controller` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `screen_code` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_screens`
--

LOCK TABLES `sys_screens` WRITE;
/*!40000 ALTER TABLE `sys_screens` DISABLE KEYS */;
REPLACE INTO `sys_screens` VALUES (1,'','broadcastcontroller','authenticate','\\broadcastcontroller\\authenticate','null'),(2,'dev','devcontroller','index','App\\Dev\\Http\\Controllers\\devcontroller\\index','App\\Dev\\Http\\Controllers'),(3,'dev','devcontroller','test','App\\Dev\\Http\\Controllers\\devcontroller\\test','App\\Dev\\Http\\Controllers'),(4,'dev','devcontroller','initproject','App\\Dev\\Http\\Controllers\\devcontroller\\initproject','App\\Dev\\Http\\Controllers'),(5,'dev','translationcontroller','translationmanagement','App\\Dev\\Http\\Controllers\\translationcontroller\\translationmanagement','App\\Dev\\Http\\Controllers'),(6,'dev','translationcontroller','deletetranslate','App\\Dev\\Http\\Controllers\\translationcontroller\\deletetranslate','App\\Dev\\Http\\Controllers'),(7,'dev','translationcontroller','updatetranslate','App\\Dev\\Http\\Controllers\\translationcontroller\\updatetranslate','App\\Dev\\Http\\Controllers'),(8,'dev','translationcontroller','generationlanguagefiles','App\\Dev\\Http\\Controllers\\translationcontroller\\generationlanguagefiles','App\\Dev\\Http\\Controllers'),(9,'dev','translationcontroller','importtranslatetodb','App\\Dev\\Http\\Controllers\\translationcontroller\\importtranslatetodb','App\\Dev\\Http\\Controllers'),(10,'dev','translationcontroller','newtexttrans','App\\Dev\\Http\\Controllers\\translationcontroller\\newtexttrans','App\\Dev\\Http\\Controllers'),(11,'dev','translationcontroller','createnewtranslationitem','App\\Dev\\Http\\Controllers\\translationcontroller\\createnewtranslationitem','App\\Dev\\Http\\Controllers'),(12,'dev','translationcontroller','translationmanagement','App\\Dev\\Http\\Controllers\\translationcontroller\\translationmanagement','App\\Dev\\Http\\Controllers'),(13,'dev','aclcontroller','readaclconfig','App\\Dev\\Http\\Controllers\\aclcontroller\\readaclconfig','App\\Dev\\Http\\Controllers'),(14,'dev','aclcontroller','generationaclconfigfiles','App\\Dev\\Http\\Controllers\\aclcontroller\\generationaclconfigfiles','App\\Dev\\Http\\Controllers'),(15,'dev','aclcontroller','updateaclactive','App\\Dev\\Http\\Controllers\\aclcontroller\\updateaclactive','App\\Dev\\Http\\Controllers'),(16,'dev','aclcontroller','updateaclactiveall','App\\Dev\\Http\\Controllers\\aclcontroller\\updateaclactiveall','App\\Dev\\Http\\Controllers'),(17,'dev','aclcontroller','generationaclfile','App\\Dev\\Http\\Controllers\\aclcontroller\\generationaclfile','App\\Dev\\Http\\Controllers'),(18,'dev','aclcontroller','refreshacldb','App\\Dev\\Http\\Controllers\\aclcontroller\\refreshacldb','App\\Dev\\Http\\Controllers'),(19,'dev','aclcontroller','importscreenslist','App\\Dev\\Http\\Controllers\\aclcontroller\\importscreenslist','App\\Dev\\Http\\Controllers'),(20,'dev','aclcontroller','aclmanangement','App\\Dev\\Http\\Controllers\\aclcontroller\\aclmanangement','App\\Dev\\Http\\Controllers'),(21,'dev','aclcontroller','userrole','App\\Dev\\Http\\Controllers\\aclcontroller\\userrole','App\\Dev\\Http\\Controllers'),(22,'dev','aclcontroller','updateuserrole','App\\Dev\\Http\\Controllers\\aclcontroller\\updateuserrole','App\\Dev\\Http\\Controllers'),(23,'dev','menucontroller','menu','App\\Dev\\Http\\Controllers\\menucontroller\\menu','App\\Dev\\Http\\Controllers'),(24,'dev','menucontroller','createmenu','App\\Dev\\Http\\Controllers\\menucontroller\\createmenu','App\\Dev\\Http\\Controllers'),(25,'dev','menucontroller','updatemenu','App\\Dev\\Http\\Controllers\\menucontroller\\updatemenu','App\\Dev\\Http\\Controllers'),(26,'dev','menucontroller','deletemenu','App\\Dev\\Http\\Controllers\\menucontroller\\deletemenu','App\\Dev\\Http\\Controllers'),(27,'dev','devcontroller','testcustomvalidate','App\\Dev\\Http\\Controllers\\devcontroller\\testcustomvalidate','App\\Dev\\Http\\Controllers'),(28,'dev','devcontroller','generateentity','App\\Dev\\Http\\Controllers\\devcontroller\\generateentity','App\\Dev\\Http\\Controllers'),(29,'dev','devcontroller','entitymanagement','App\\Dev\\Http\\Controllers\\devcontroller\\entitymanagement','App\\Dev\\Http\\Controllers'),(30,'dev','devcontroller','generateoneentity','App\\Dev\\Http\\Controllers\\devcontroller\\generateoneentity','App\\Dev\\Http\\Controllers'),(31,'dev','devcontroller','log','App\\Dev\\Http\\Controllers\\devcontroller\\log','App\\Dev\\Http\\Controllers'),(32,'dev','devcontroller','doc','App\\Dev\\Http\\Controllers\\devcontroller\\doc','App\\Dev\\Http\\Controllers'),(33,'laravel','authorizationcontroller','authorize','\\Laravel\\Passport\\Http\\Controllers\\authorizationcontroller\\authorize','\\Laravel\\Passport\\Http\\Controllers'),(34,'laravel','approveauthorizationcontroller','approve','\\Laravel\\Passport\\Http\\Controllers\\approveauthorizationcontroller\\approve','\\Laravel\\Passport\\Http\\Controllers'),(35,'laravel','denyauthorizationcontroller','deny','\\Laravel\\Passport\\Http\\Controllers\\denyauthorizationcontroller\\deny','\\Laravel\\Passport\\Http\\Controllers'),(36,'laravel','accesstokencontroller','issuetoken','\\Laravel\\Passport\\Http\\Controllers\\accesstokencontroller\\issuetoken','\\Laravel\\Passport\\Http\\Controllers'),(37,'laravel','authorizedaccesstokencontroller','foruser','\\Laravel\\Passport\\Http\\Controllers\\authorizedaccesstokencontroller\\foruser','\\Laravel\\Passport\\Http\\Controllers'),(38,'laravel','authorizedaccesstokencontroller','destroy','\\Laravel\\Passport\\Http\\Controllers\\authorizedaccesstokencontroller\\destroy','\\Laravel\\Passport\\Http\\Controllers'),(39,'laravel','transienttokencontroller','refresh','\\Laravel\\Passport\\Http\\Controllers\\transienttokencontroller\\refresh','\\Laravel\\Passport\\Http\\Controllers'),(40,'laravel','clientcontroller','foruser','\\Laravel\\Passport\\Http\\Controllers\\clientcontroller\\foruser','\\Laravel\\Passport\\Http\\Controllers'),(41,'laravel','clientcontroller','store','\\Laravel\\Passport\\Http\\Controllers\\clientcontroller\\store','\\Laravel\\Passport\\Http\\Controllers'),(42,'laravel','clientcontroller','update','\\Laravel\\Passport\\Http\\Controllers\\clientcontroller\\update','\\Laravel\\Passport\\Http\\Controllers'),(43,'laravel','clientcontroller','destroy','\\Laravel\\Passport\\Http\\Controllers\\clientcontroller\\destroy','\\Laravel\\Passport\\Http\\Controllers'),(44,'laravel','scopecontroller','all','\\Laravel\\Passport\\Http\\Controllers\\scopecontroller\\all','\\Laravel\\Passport\\Http\\Controllers'),(45,'laravel','personalaccesstokencontroller','foruser','\\Laravel\\Passport\\Http\\Controllers\\personalaccesstokencontroller\\foruser','\\Laravel\\Passport\\Http\\Controllers'),(46,'laravel','personalaccesstokencontroller','store','\\Laravel\\Passport\\Http\\Controllers\\personalaccesstokencontroller\\store','\\Laravel\\Passport\\Http\\Controllers'),(47,'laravel','personalaccesstokencontroller','destroy','\\Laravel\\Passport\\Http\\Controllers\\personalaccesstokencontroller\\destroy','\\Laravel\\Passport\\Http\\Controllers'),(48,'auth','logincontroller','showloginform','App\\Auth\\Http\\Controllers\\logincontroller\\showloginform','App\\Auth\\Http\\Controllers'),(49,'auth','logincontroller','login','App\\Auth\\Http\\Controllers\\logincontroller\\login','App\\Auth\\Http\\Controllers'),(50,'auth','logincontroller','logout','App\\Auth\\Http\\Controllers\\logincontroller\\logout','App\\Auth\\Http\\Controllers'),(51,'auth','forgotpasswordcontroller','showlinkrequestform','App\\Auth\\Http\\Controllers\\forgotpasswordcontroller\\showlinkrequestform','App\\Auth\\Http\\Controllers'),(52,'auth','forgotpasswordcontroller','sendresetlinkemail','App\\Auth\\Http\\Controllers\\forgotpasswordcontroller\\sendresetlinkemail','App\\Auth\\Http\\Controllers'),(53,'auth','resetpasswordcontroller','showresetform','App\\Auth\\Http\\Controllers\\resetpasswordcontroller\\showresetform','App\\Auth\\Http\\Controllers'),(54,'auth','resetpasswordcontroller','reset','App\\Auth\\Http\\Controllers\\resetpasswordcontroller\\reset','App\\Auth\\Http\\Controllers'),(55,'auth','registercontroller','showregistrationform','App\\Auth\\Http\\Controllers\\registercontroller\\showregistrationform','App\\Auth\\Http\\Controllers'),(56,'auth','registercontroller','register','App\\Auth\\Http\\Controllers\\registercontroller\\register','App\\Auth\\Http\\Controllers'),(57,'acl','aclcontroller','index','App\\Acl\\Http\\Controllers\\aclcontroller\\index','App\\Acl\\Http\\Controllers'),(58,'acl','aclcontroller','updateaclactive','App\\Acl\\Http\\Controllers\\aclcontroller\\updateaclactive','App\\Acl\\Http\\Controllers'),(59,'acl','aclcontroller','updateaclactiveall','App\\Acl\\Http\\Controllers\\aclcontroller\\updateaclactiveall','App\\Acl\\Http\\Controllers'),(60,'api','usercontroller','login','App\\Api\\V1\\Http\\Controllers\\usercontroller\\login','App\\Api\\V1\\Http\\Controllers'),(61,'api','foodcontroller','listbystore','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\listbystore','App\\Api\\V1\\Http\\Controllers'),(62,'api','foodcontroller','listbymenu','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\listbymenu','App\\Api\\V1\\Http\\Controllers'),(63,'api','foodcontroller','listmenu','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\listmenu','App\\Api\\V1\\Http\\Controllers'),(64,'api','usercontroller','logout','App\\Api\\V1\\Http\\Controllers\\usercontroller\\logout','App\\Api\\V1\\Http\\Controllers'),(65,'api','foodcontroller','order','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\order','App\\Api\\V1\\Http\\Controllers'),(66,'api','foodcontroller','ordertochef','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\ordertochef','App\\Api\\V1\\Http\\Controllers'),(67,'api','foodcontroller','closeorder','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\closeorder','App\\Api\\V1\\Http\\Controllers'),(68,'api','foodcontroller','orderwaiterlist','App\\Api\\V1\\Http\\Controllers\\foodcontroller\\orderwaiterlist','App\\Api\\V1\\Http\\Controllers'),(69,'backend','homecontroller','index','App\\Backend\\Http\\Controllers\\homecontroller\\index','App\\Backend\\Http\\Controllers'),(70,'backend','somecontroller','index','App\\Backend\\Http\\Controllers\\somecontroller\\index','App\\Backend\\Http\\Controllers'),(71,'backend','blogcontroller','index','App\\Backend\\Http\\Controllers\\blogcontroller\\index','App\\Backend\\Http\\Controllers'),(72,'backend','templatecontroller','executeschedule','App\\Backend\\Http\\Controllers\\templatecontroller\\executeschedule','App\\Backend\\Http\\Controllers'),(73,'backend','templatecontroller','index','App\\Backend\\Http\\Controllers\\templatecontroller\\index','App\\Backend\\Http\\Controllers'),(74,'backend','templatecontroller','form','App\\Backend\\Http\\Controllers\\templatecontroller\\form','App\\Backend\\Http\\Controllers'),(75,'backend','templatecontroller','components','App\\Backend\\Http\\Controllers\\templatecontroller\\components','App\\Backend\\Http\\Controllers'),(76,'backend','templatecontroller','buttons','App\\Backend\\Http\\Controllers\\templatecontroller\\buttons','App\\Backend\\Http\\Controllers'),(77,'backend','templatecontroller','upload','App\\Backend\\Http\\Controllers\\templatecontroller\\upload','App\\Backend\\Http\\Controllers'),(78,'backend','templatecontroller','getimagefroms3','App\\Backend\\Http\\Controllers\\templatecontroller\\getimagefroms3','App\\Backend\\Http\\Controllers'),(79,'backend','templatecontroller','getimagefromlocal','App\\Backend\\Http\\Controllers\\templatecontroller\\getimagefromlocal','App\\Backend\\Http\\Controllers'),(80,'backend','templatecontroller','doupload','App\\Backend\\Http\\Controllers\\templatecontroller\\doupload','App\\Backend\\Http\\Controllers'),(81,'backend','templatecontroller','douploads3','App\\Backend\\Http\\Controllers\\templatecontroller\\douploads3','App\\Backend\\Http\\Controllers'),(82,'backend','templatecontroller','dodeletefile','App\\Backend\\Http\\Controllers\\templatecontroller\\dodeletefile','App\\Backend\\Http\\Controllers'),(83,'backend','templatecontroller','dodeletefiles3','App\\Backend\\Http\\Controllers\\templatecontroller\\dodeletefiles3','App\\Backend\\Http\\Controllers'),(84,'backend','templatecontroller','generalelement','App\\Backend\\Http\\Controllers\\templatecontroller\\generalelement','App\\Backend\\Http\\Controllers'),(85,'backend','templatecontroller','icons','App\\Backend\\Http\\Controllers\\templatecontroller\\icons','App\\Backend\\Http\\Controllers'),(86,'backend','templatecontroller','glyphicons','App\\Backend\\Http\\Controllers\\templatecontroller\\glyphicons','App\\Backend\\Http\\Controllers'),(87,'backend','templatecontroller','calendar','App\\Backend\\Http\\Controllers\\templatecontroller\\calendar','App\\Backend\\Http\\Controllers'),(88,'backend','templatecontroller','tables','App\\Backend\\Http\\Controllers\\templatecontroller\\tables','App\\Backend\\Http\\Controllers'),(89,'backend','templatecontroller','exports','App\\Backend\\Http\\Controllers\\templatecontroller\\exports','App\\Backend\\Http\\Controllers'),(90,'backend','templatecontroller','doexports','App\\Backend\\Http\\Controllers\\templatecontroller\\doexports','App\\Backend\\Http\\Controllers'),(91,'backend','templatecontroller','doexportscommon','App\\Backend\\Http\\Controllers\\templatecontroller\\doexportscommon','App\\Backend\\Http\\Controllers'),(92,'backend','templatecontroller','doimport','App\\Backend\\Http\\Controllers\\templatecontroller\\doimport','App\\Backend\\Http\\Controllers'),(93,'backend','usercontroller','getlist','App\\Backend\\Http\\Controllers\\usercontroller\\getlist','App\\Backend\\Http\\Controllers'),(94,'backend','usercontroller','profile','App\\Backend\\Http\\Controllers\\usercontroller\\profile','App\\Backend\\Http\\Controllers'),(95,'backend','usercontroller','paginate','App\\Backend\\Http\\Controllers\\usercontroller\\paginate','App\\Backend\\Http\\Controllers'),(96,'backend','usercontroller','add','App\\Backend\\Http\\Controllers\\usercontroller\\add','App\\Backend\\Http\\Controllers'),(97,'backend','usercontroller','addpost','App\\Backend\\Http\\Controllers\\usercontroller\\addpost','App\\Backend\\Http\\Controllers'),(98,'backend','usercontroller','getbyid','App\\Backend\\Http\\Controllers\\usercontroller\\getbyid','App\\Backend\\Http\\Controllers'),(99,'backend','usercontroller','editpost','App\\Backend\\Http\\Controllers\\usercontroller\\editpost','App\\Backend\\Http\\Controllers'),(100,'backend','usercontroller','delete','App\\Backend\\Http\\Controllers\\usercontroller\\delete','App\\Backend\\Http\\Controllers'),(101,'backend','usercontroller','deleteall','App\\Backend\\Http\\Controllers\\usercontroller\\deleteall','App\\Backend\\Http\\Controllers'),(102,'backend','menucontroller','getmenu','App\\Backend\\Http\\Controllers\\menucontroller\\getmenu','App\\Backend\\Http\\Controllers'),(103,'backend','menucontroller','getaddmenu','App\\Backend\\Http\\Controllers\\menucontroller\\getaddmenu','App\\Backend\\Http\\Controllers'),(104,'backend','menucontroller','postaddmenu','App\\Backend\\Http\\Controllers\\menucontroller\\postaddmenu','App\\Backend\\Http\\Controllers'),(105,'backend','menucontroller','geteditmenu','App\\Backend\\Http\\Controllers\\menucontroller\\geteditmenu','App\\Backend\\Http\\Controllers'),(106,'backend','menucontroller','posteditmenu','App\\Backend\\Http\\Controllers\\menucontroller\\posteditmenu','App\\Backend\\Http\\Controllers'),(107,'backend','menucontroller','deletemenu','App\\Backend\\Http\\Controllers\\menucontroller\\deletemenu','App\\Backend\\Http\\Controllers'),(108,'backend','menucontroller','deleteallmenu','App\\Backend\\Http\\Controllers\\menucontroller\\deleteallmenu','App\\Backend\\Http\\Controllers'),(109,'backend','typecontroller','gettype','App\\Backend\\Http\\Controllers\\typecontroller\\gettype','App\\Backend\\Http\\Controllers'),(110,'backend','typecontroller','getaddtype','App\\Backend\\Http\\Controllers\\typecontroller\\getaddtype','App\\Backend\\Http\\Controllers'),(111,'backend','typecontroller','postaddtype','App\\Backend\\Http\\Controllers\\typecontroller\\postaddtype','App\\Backend\\Http\\Controllers'),(112,'backend','typecontroller','getedittype','App\\Backend\\Http\\Controllers\\typecontroller\\getedittype','App\\Backend\\Http\\Controllers'),(113,'backend','typecontroller','postedittype','App\\Backend\\Http\\Controllers\\typecontroller\\postedittype','App\\Backend\\Http\\Controllers'),(114,'backend','typecontroller','deletetype','App\\Backend\\Http\\Controllers\\typecontroller\\deletetype','App\\Backend\\Http\\Controllers'),(115,'backend','typecontroller','deletealltype','App\\Backend\\Http\\Controllers\\typecontroller\\deletealltype','App\\Backend\\Http\\Controllers'),(116,'backend','typecontroller','deleteprop','App\\Backend\\Http\\Controllers\\typecontroller\\deleteprop','App\\Backend\\Http\\Controllers'),(117,'backend','foodcontroller','getfood','App\\Backend\\Http\\Controllers\\foodcontroller\\getfood','App\\Backend\\Http\\Controllers'),(118,'backend','foodcontroller','getaddfood','App\\Backend\\Http\\Controllers\\foodcontroller\\getaddfood','App\\Backend\\Http\\Controllers'),(119,'backend','foodcontroller','postaddfood','App\\Backend\\Http\\Controllers\\foodcontroller\\postaddfood','App\\Backend\\Http\\Controllers'),(120,'backend','foodcontroller','geteditfood','App\\Backend\\Http\\Controllers\\foodcontroller\\geteditfood','App\\Backend\\Http\\Controllers'),(121,'backend','foodcontroller','posteditfood','App\\Backend\\Http\\Controllers\\foodcontroller\\posteditfood','App\\Backend\\Http\\Controllers'),(122,'backend','foodcontroller','deletefood','App\\Backend\\Http\\Controllers\\foodcontroller\\deletefood','App\\Backend\\Http\\Controllers'),(123,'backend','foodcontroller','deleteallfood','App\\Backend\\Http\\Controllers\\foodcontroller\\deleteallfood','App\\Backend\\Http\\Controllers'),(124,'backend','foodcontroller','deletefoodprop','App\\Backend\\Http\\Controllers\\foodcontroller\\deletefoodprop','App\\Backend\\Http\\Controllers'),(125,'backend','foodcontroller','getprop','App\\Backend\\Http\\Controllers\\foodcontroller\\getprop','App\\Backend\\Http\\Controllers'),(126,'backend','dashboardcontroller','dashboardwaiter','App\\Backend\\Http\\Controllers\\dashboardcontroller\\dashboardwaiter','App\\Backend\\Http\\Controllers'),(127,'backend','dashboardcontroller','dashboardchef','App\\Backend\\Http\\Controllers\\dashboardcontroller\\dashboardchef','App\\Backend\\Http\\Controllers'),(128,'frontend','homecontroller','index','App\\Frontend\\Http\\Controllers\\homecontroller\\index','App\\Frontend\\Http\\Controllers'),(129,'frontend','homecontroller','apilogin','App\\Frontend\\Http\\Controllers\\homecontroller\\apilogin','App\\Frontend\\Http\\Controllers'),(130,'frontend','homecontroller','test','App\\Frontend\\Http\\Controllers\\homecontroller\\test','App\\Frontend\\Http\\Controllers'),(131,'frontend','ordercontroller','index','App\\Frontend\\Http\\Controllers\\ordercontroller\\index','App\\Frontend\\Http\\Controllers');
/*!40000 ALTER TABLE `sys_screens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_translate_type`
--

DROP TABLE IF EXISTS `sys_translate_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_translate_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `comment` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `has_input_type` tinyint(4) DEFAULT NULL,
  `order_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_translate_type`
--

LOCK TABLES `sys_translate_type` WRITE;
/*!40000 ALTER TABLE `sys_translate_type` DISABLE KEYS */;
REPLACE INTO `sys_translate_type` VALUES (1,'validation','type of message validation',1,1),(2,'label',NULL,NULL,2),(3,'auth',NULL,NULL,3),(4,'passwords',NULL,NULL,4),(5,'pagination',NULL,NULL,5);
/*!40000 ALTER TABLE `sys_translate_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_translation`
--

DROP TABLE IF EXISTS `sys_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'en',
  `translate_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `code` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `text` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `input_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_translation`
--

LOCK TABLES `sys_translation` WRITE;
/*!40000 ALTER TABLE `sys_translation` DISABLE KEYS */;
REPLACE INTO `sys_translation` VALUES (1,'en','auth','not_active','Account must actived','','2018-09-12 17:25:16',NULL,0),(2,'en','auth','throttle','Too many login attempts. Please try again in :seconds seconds.','','2018-09-12 17:25:16',NULL,0),(3,'en','pagination','next','Next &raquo;','','2018-09-12 17:25:16',NULL,0),(4,'en','pagination','previous','&laquo; Previous','','2018-09-12 17:25:16',NULL,0),(5,'en','passwords','password','Passwords must be at least six characters and match the confirmation.','','2018-09-12 17:25:16',NULL,0),(6,'en','passwords','reset','Your password has been reset!','','2018-09-12 17:25:16',NULL,0),(7,'en','passwords','sent','We have e-mailed your password reset link!','','2018-09-12 17:25:16',NULL,0),(8,'en','passwords','token','This password reset token is invalid.','','2018-09-12 17:25:16',NULL,0),(9,'en','passwords','user','We can\'t find a user with that e-mail address.','','2018-09-12 17:25:16',NULL,0),(10,'en','validation','123','1321321','','2018-09-12 17:25:16',NULL,0),(11,'en','validation','accepted','The :attribute must be accepted.','','2018-09-12 17:25:16',NULL,0),(12,'en','validation','active_url','The :attribute is not a valid URL.','','2018-09-12 17:25:16',NULL,0),(13,'en','validation','after','The :attribute must be a date after :date.','','2018-09-12 17:25:16',NULL,0),(14,'en','validation','after_or_equal','The :attribute must be a date after or equal to :date.','','2018-09-12 17:25:16',NULL,0),(15,'en','validation','alpha','The :attribute may only contain letters.','','2018-09-12 17:25:16',NULL,0),(16,'en','validation','alpha_dash','The :attribute may only contain letters, numbers, dashes and underscores.','','2018-09-12 17:25:16',NULL,0),(17,'en','validation','alpha_num','The :attribute may only contain letters and numbers.','','2018-09-12 17:25:16',NULL,0),(18,'en','validation','array','The :attribute must be an array.','','2018-09-12 17:25:16',NULL,0),(19,'en','validation','before','The :attribute must be a date before :date.','','2018-09-12 17:25:16',NULL,0),(20,'en','validation','before_or_equal','The :attribute must be a date before or equal to :date.','','2018-09-12 17:25:16',NULL,0),(21,'en','validation','between','The :attribute must have between :min and :max items.','array','2018-09-12 17:25:16',NULL,0),(22,'en','validation','between','The :attribute must be between :min and :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(23,'en','validation','between','The :attribute must be between :min and :max.','numeric','2018-09-12 17:25:16',NULL,0),(24,'en','validation','between','The :attribute must be between :min and :max characters.','string','2018-09-12 17:25:16',NULL,0),(25,'en','validation','boolean','The :attribute field must be true or false.','','2018-09-12 17:25:16',NULL,0),(26,'en','validation','common_error','Common error','','2018-09-12 17:25:16',NULL,0),(27,'en','validation','confirmed','The :attribute confirmation does not match.','','2018-09-12 17:25:16',NULL,0),(28,'en','validation','date','The :attribute is not a valid date.','','2018-09-12 17:25:16',NULL,0),(29,'en','validation','date_format','The :attribute does not match the format :format.','','2018-09-12 17:25:16',NULL,0),(30,'en','validation','different','The :attribute and :other must be different.','','2018-09-12 17:25:16',NULL,0),(31,'en','validation','digits','The :attribute must be :digits digits.','','2018-09-12 17:25:16',NULL,0),(32,'en','validation','digits_between','The :attribute must be between :min and :max digits.','','2018-09-12 17:25:16',NULL,0),(33,'en','validation','dimensions','The :attribute has invalid image dimensions.','','2018-09-12 17:25:16',NULL,0),(34,'en','validation','distinct','The :attribute field has a duplicate value.','','2018-09-12 17:25:16',NULL,0),(35,'en','validation','email','The :attribute must be a valid email address.','','2018-09-12 17:25:16',NULL,0),(36,'en','validation','exists','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(37,'en','validation','f vg','red','','2018-09-12 17:25:16',NULL,0),(38,'en','validation','file','The :attribute must be a file.','','2018-09-12 17:25:16',NULL,0),(39,'en','validation','filled','The :attribute field must have a value.','','2018-09-12 17:25:16',NULL,0),(40,'en','validation','gt','The :attribute must have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(41,'en','validation','gt','The :attribute must be greater than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(42,'en','validation','gt','The :attribute must be greater than :value.','numeric','2018-09-12 17:25:16',NULL,0),(43,'en','validation','gt','The :attribute must be greater than :value characters.','string','2018-09-12 17:25:16',NULL,0),(44,'en','validation','gte','The :attribute must have :value items or more.','array','2018-09-12 17:25:16',NULL,0),(45,'en','validation','gte','The :attribute must be greater than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(46,'en','validation','gte','The :attribute must be greater than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(47,'en','validation','gte','The :attribute must be greater than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(48,'en','validation','image','The :attribute must be an image.','','2018-09-12 17:25:16',NULL,0),(49,'en','validation','in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(50,'en','validation','integer','The :attribute must be an integer.','','2018-09-12 17:25:16',NULL,0),(51,'en','validation','in_array','The :attribute field does not exist in :other.','','2018-09-12 17:25:16',NULL,0),(52,'en','validation','ip','The :attribute must be a valid IP address.','','2018-09-12 17:25:16',NULL,0),(53,'en','validation','ipv4','The :attribute must be a valid IPv4 address.','','2018-09-12 17:25:16',NULL,0),(54,'en','validation','ipv6','The :attribute must be a valid IPv6 address.','','2018-09-12 17:25:16',NULL,0),(55,'en','validation','json','The :attribute must be a valid JSON string.','','2018-09-12 17:25:16',NULL,0),(56,'en','validation','lt','The :attribute must have less than :value items.','array','2018-09-12 17:25:16',NULL,0),(57,'en','validation','lt','The :attribute must be less than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(58,'en','validation','lt','The :attribute must be less than :value.','numeric','2018-09-12 17:25:16',NULL,0),(59,'en','validation','lt','The :attribute must be less than :value characters.','string','2018-09-12 17:25:16',NULL,0),(60,'en','validation','lte','The :attribute must not have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(61,'en','validation','lte','The :attribute must be less than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(62,'en','validation','lte','The :attribute must be less than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(63,'en','validation','lte','The :attribute must be less than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(64,'en','validation','max','The :attribute may not have more than :max items.','array','2018-09-12 17:25:16',NULL,0),(65,'en','validation','max','The :attribute may not be greater than :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(66,'en','validation','max','The :attribute may not be greater than :max.','numeric','2018-09-12 17:25:16',NULL,0),(67,'en','validation','max','The :attribute may not be greater than :max characters.','string','2018-09-12 17:25:16',NULL,0),(68,'en','validation','mimes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(69,'en','validation','mimetypes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(70,'en','validation','min','The :attribute must have at least :min items.','array','2018-09-12 17:25:16',NULL,0),(71,'en','validation','min','The :attribute must be at least :min kilobytes.','file','2018-09-12 17:25:16',NULL,0),(72,'en','validation','min','The :attribute must be at least :min.','numeric','2018-09-12 17:25:16',NULL,0),(73,'en','validation','min','The :attribute must be at least :min characters.','string','2018-09-12 17:25:16',NULL,0),(74,'en','validation','not_in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(75,'en','validation','not_regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(76,'en','validation','numeric','The :attribute must be a number.','','2018-09-12 17:25:16',NULL,0),(77,'en','validation','present','The :attribute field must be present.','','2018-09-12 17:25:16',NULL,0),(78,'en','validation','regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(79,'en','validation','required','The :attribute field is required.','','2018-09-12 17:25:16',NULL,0),(80,'en','validation','required_if','The :attribute field is required when :other is :value.','','2018-09-12 17:25:16',NULL,0),(81,'en','validation','required_unless','The :attribute field is required unless :other is in :values.','','2018-09-12 17:25:16',NULL,0),(82,'en','validation','required_with','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(83,'en','validation','required_without','The :attribute field is required when :values is not present.','','2018-09-12 17:25:16',NULL,0),(84,'en','validation','required_without_all','The :attribute field is required when none of :values are present.','','2018-09-12 17:25:16',NULL,0),(85,'en','validation','required_with_all','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(86,'en','validation','same','The :attribute and :other must match.','','2018-09-12 17:25:16',NULL,0),(87,'en','validation','size','The :attribute must contain :size items.','array','2018-09-12 17:25:16',NULL,0),(88,'en','validation','size','The :attribute must be :size kilobytes.','file','2018-09-12 17:25:16',NULL,0),(89,'en','validation','size','The :attribute must be :size.','numeric','2018-09-12 17:25:16',NULL,0),(90,'en','validation','size','The :attribute must be :size characters.','string','2018-09-12 17:25:16',NULL,0),(91,'en','validation','string','The :attribute must be a string.','','2018-09-12 17:25:16',NULL,0),(92,'en','validation','test8','test0','file','2018-09-12 17:25:16',NULL,0),(93,'en','validation','test8','test0','numeric','2018-09-12 17:25:16',NULL,0),(94,'en','validation','timezone','The :attribute must be a valid zone.','','2018-09-12 17:25:16',NULL,0),(95,'en','validation','unique','The :attribute has already been taken.','','2018-09-12 17:25:16',NULL,0),(96,'en','validation','uploaded','The :attribute failed to upload.','','2018-09-12 17:25:16',NULL,0),(97,'en','validation','url','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(98,'fr','auth','not_active','Account mus actived','','2018-09-12 17:25:16',NULL,0),(99,'fr','auth','throttle','Too many login attempts. Please try again in :seconds seconds.','','2018-09-12 17:25:16',NULL,0),(100,'fr','pagination','next','Next &raquo;','','2018-09-12 17:25:16',NULL,0),(101,'fr','pagination','previous','&laquo; Previous','','2018-09-12 17:25:16',NULL,0),(102,'fr','passwords','password','Passwords must be at least six characters and match the confirmation.','','2018-09-12 17:25:16',NULL,0),(103,'fr','passwords','reset','Your password has been reset!','','2018-09-12 17:25:16',NULL,0),(104,'fr','passwords','sent','We have e-mailed your password reset link!','','2018-09-12 17:25:16',NULL,0),(105,'fr','passwords','token','This password reset token is invalid.','','2018-09-12 17:25:16',NULL,0),(106,'fr','passwords','user','We can\'t find a user with that e-mail address.','','2018-09-12 17:25:16',NULL,0),(107,'fr','validation','123','12321321321','','2018-09-12 17:25:16',NULL,0),(108,'fr','validation','accepted','The :attribute must be accepted.','','2018-09-12 17:25:16',NULL,0),(109,'fr','validation','active_url','The :attribute is not a valid URL.','','2018-09-12 17:25:16',NULL,0),(110,'fr','validation','after','The :attribute must be a date after :date.','','2018-09-12 17:25:16',NULL,0),(111,'fr','validation','after_or_equal','The :attribute must be a date after or equal to :date.','','2018-09-12 17:25:16',NULL,0),(112,'fr','validation','alpha','The :attribute may only contain letters.','','2018-09-12 17:25:16',NULL,0),(113,'fr','validation','alpha_dash','The :attribute may only contain letters, numbers, dashes and underscores.','','2018-09-12 17:25:16',NULL,0),(114,'fr','validation','alpha_num','The :attribute may only contain letters and numbers.','','2018-09-12 17:25:16',NULL,0),(115,'fr','validation','array','The :attribute must be an array.','','2018-09-12 17:25:16',NULL,0),(116,'fr','validation','before','The :attribute must be a date before :date.','','2018-09-12 17:25:16',NULL,0),(117,'fr','validation','before_or_equal','The :attribute must be a date before or equal to :date.','','2018-09-12 17:25:16',NULL,0),(118,'fr','validation','between','The :attribute must have between :min and :max items.','array','2018-09-12 17:25:16',NULL,0),(119,'fr','validation','between','The :attribute must be between :min and :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(120,'fr','validation','between','The :attribute must be between :min and :max.','numeric','2018-09-12 17:25:16',NULL,0),(121,'fr','validation','between','The :attribute must be between :min and :max characters.','string','2018-09-12 17:25:16',NULL,0),(122,'fr','validation','boolean','The :attribute field must be true or false.','','2018-09-12 17:25:16',NULL,0),(123,'fr','validation','common_error','Common error','','2018-09-12 17:25:16',NULL,0),(124,'fr','validation','confirmed','The :attribute confirmation does not match.','','2018-09-12 17:25:16',NULL,0),(125,'fr','validation','date','The :attribute is not a valid date.','','2018-09-12 17:25:16',NULL,0),(126,'fr','validation','date_format','The :attribute does not match the format :format.','','2018-09-12 17:25:16',NULL,0),(127,'fr','validation','different','The :attribute and :other must be different.','','2018-09-12 17:25:16',NULL,0),(128,'fr','validation','digits','The :attribute must be :digits digits.','','2018-09-12 17:25:16',NULL,0),(129,'fr','validation','digits_between','The :attribute must be between :min and :max digits.','','2018-09-12 17:25:16',NULL,0),(130,'fr','validation','dimensions','The :attribute has invalid image dimensions.','','2018-09-12 17:25:16',NULL,0),(131,'fr','validation','distinct','The :attribute field has a duplicate value.','','2018-09-12 17:25:16',NULL,0),(132,'fr','validation','email','The :attribute must be a valid email address.','','2018-09-12 17:25:16',NULL,0),(133,'fr','validation','exists','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(134,'fr','validation','f vg','red','','2018-09-12 17:25:16',NULL,0),(135,'fr','validation','file','The :attribute must be a file.','','2018-09-12 17:25:16',NULL,0),(136,'fr','validation','filled','The :attribute field must have a value.','','2018-09-12 17:25:16',NULL,0),(137,'fr','validation','gt','The :attribute must have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(138,'fr','validation','gt','The :attribute must be greater than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(139,'fr','validation','gt','The :attribute must be greater than :value.','numeric','2018-09-12 17:25:16',NULL,0),(140,'fr','validation','gt','The :attribute must be greater than :value characters.','string','2018-09-12 17:25:16',NULL,0),(141,'fr','validation','gte','The :attribute must have :value items or more.','array','2018-09-12 17:25:16',NULL,0),(142,'fr','validation','gte','The :attribute must be greater than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(143,'fr','validation','gte','The :attribute must be greater than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(144,'fr','validation','gte','The :attribute must be greater than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(145,'fr','validation','image','The :attribute must be an image.','','2018-09-12 17:25:16',NULL,0),(146,'fr','validation','in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(147,'fr','validation','integer','The :attribute must be an integer.','','2018-09-12 17:25:16',NULL,0),(148,'fr','validation','in_array','The :attribute field does not exist in :other.','','2018-09-12 17:25:16',NULL,0),(149,'fr','validation','ip','The :attribute must be a valid IP address.','','2018-09-12 17:25:16',NULL,0),(150,'fr','validation','ipv4','The :attribute must be a valid IPv4 address.','','2018-09-12 17:25:16',NULL,0),(151,'fr','validation','ipv6','The :attribute must be a valid IPv6 address.','','2018-09-12 17:25:16',NULL,0),(152,'fr','validation','json','The :attribute must be a valid JSON string.','','2018-09-12 17:25:16',NULL,0),(153,'fr','validation','lt','The :attribute must have less than :value items.','array','2018-09-12 17:25:16',NULL,0),(154,'fr','validation','lt','The :attribute must be less than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(155,'fr','validation','lt','The :attribute must be less than :value.','numeric','2018-09-12 17:25:16',NULL,0),(156,'fr','validation','lt','The :attribute must be less than :value characters.','string','2018-09-12 17:25:16',NULL,0),(157,'fr','validation','lte','The :attribute must not have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(158,'fr','validation','lte','The :attribute must be less than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(159,'fr','validation','lte','The :attribute must be less than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(160,'fr','validation','lte','The :attribute must be less than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(161,'fr','validation','max','The :attribute may not have more than :max items.','array','2018-09-12 17:25:16',NULL,0),(162,'fr','validation','max','The :attribute may not be greater than :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(163,'fr','validation','max','The :attribute may not be greater than :max.','numeric','2018-09-12 17:25:16',NULL,0),(164,'fr','validation','max','The :attribute may not be greater than :max characters.','string','2018-09-12 17:25:16',NULL,0),(165,'fr','validation','mimes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(166,'fr','validation','mimetypes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(167,'fr','validation','min','The :attribute must have at least :min items.','array','2018-09-12 17:25:16',NULL,0),(168,'fr','validation','min','The :attribute must be at least :min kilobytes.','file','2018-09-12 17:25:16',NULL,0),(169,'fr','validation','min','The :attribute must be at least :min.','numeric','2018-09-12 17:25:16',NULL,0),(170,'fr','validation','min','The :attribute must be at least :min characters.','string','2018-09-12 17:25:16',NULL,0),(171,'fr','validation','not_in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(172,'fr','validation','not_regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(173,'fr','validation','numeric','The :attribute must be a number.','','2018-09-12 17:25:16',NULL,0),(174,'fr','validation','present','The :attribute field must be present.','','2018-09-12 17:25:16',NULL,0),(175,'fr','validation','regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(176,'fr','validation','required','The :attribute field is required.','','2018-09-12 17:25:16',NULL,0),(177,'fr','validation','required_if','The :attribute field is required when :other is :value.','','2018-09-12 17:25:16',NULL,0),(178,'fr','validation','required_unless','The :attribute field is required unless :other is in :values.','','2018-09-12 17:25:16',NULL,0),(179,'fr','validation','required_with','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(180,'fr','validation','required_without','The :attribute field is required when :values is not present.','','2018-09-12 17:25:16',NULL,0),(181,'fr','validation','required_without_all','The :attribute field is required when none of :values are present.','','2018-09-12 17:25:16',NULL,0),(182,'fr','validation','required_with_all','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(183,'fr','validation','same','The :attribute and :other must match.','','2018-09-12 17:25:16',NULL,0),(184,'fr','validation','size','The :attribute must contain :size items.','array','2018-09-12 17:25:16',NULL,0),(185,'fr','validation','size','The :attribute must be :size kilobytes.','file','2018-09-12 17:25:16',NULL,0),(186,'fr','validation','size','The :attribute must be :size.','numeric','2018-09-12 17:25:16',NULL,0),(187,'fr','validation','size','The :attribute must be :size characters.','string','2018-09-12 17:25:16',NULL,0),(188,'fr','validation','string','The :attribute must be a string.','','2018-09-12 17:25:16',NULL,0),(189,'fr','validation','test8','test0','file','2018-09-12 17:25:16',NULL,0),(190,'fr','validation','test8','test0','numeric','2018-09-12 17:25:16',NULL,0),(191,'fr','validation','timezone','The :attribute must be a valid zone.','','2018-09-12 17:25:16',NULL,0),(192,'fr','validation','unique','The :attribute has already been taken.','','2018-09-12 17:25:16',NULL,0),(193,'fr','validation','uploaded','The :attribute failed to upload.','','2018-09-12 17:25:16',NULL,0),(194,'fr','validation','url','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(195,'jp','auth','not_active','Account mus actived','','2018-09-12 17:25:16',NULL,0),(196,'jp','auth','throttle','Too many login attempts. Please try again in :seconds seconds.','','2018-09-12 17:25:16',NULL,0),(197,'jp','pagination','next','Next &raquo;','','2018-09-12 17:25:16',NULL,0),(198,'jp','pagination','previous','&laquo; Previous','','2018-09-12 17:25:16',NULL,0),(199,'jp','passwords','password','Passwords must be at least six characters and match the confirmation.','','2018-09-12 17:25:16',NULL,0),(200,'jp','passwords','reset','Your password has been reset!','','2018-09-12 17:25:16',NULL,0),(201,'jp','passwords','sent','We have e-mailed your password reset link!','','2018-09-12 17:25:16',NULL,0),(202,'jp','passwords','token','This password reset token is invalid.','','2018-09-12 17:25:16',NULL,0),(203,'jp','passwords','user','We can\'t find a user with that e-mail address.','','2018-09-12 17:25:16',NULL,0),(204,'jp','validation','123','12321321','','2018-09-12 17:25:16',NULL,0),(205,'jp','validation','accepted','The :attribute must be accepted.','','2018-09-12 17:25:16',NULL,0),(206,'jp','validation','active_url','The :attribute is not a valid URL.','','2018-09-12 17:25:16',NULL,0),(207,'jp','validation','after','The :attribute must be a date after :date.','','2018-09-12 17:25:16',NULL,0),(208,'jp','validation','after_or_equal','The :attribute must be a date after or equal to :date.','','2018-09-12 17:25:16',NULL,0),(209,'jp','validation','alpha','The :attribute may only contain letters.','','2018-09-12 17:25:16',NULL,0),(210,'jp','validation','alpha_dash','The :attribute may only contain letters, numbers, dashes and underscores.','','2018-09-12 17:25:16',NULL,0),(211,'jp','validation','alpha_num','The :attribute may only contain letters and numbers.','','2018-09-12 17:25:16',NULL,0),(212,'jp','validation','array','The :attribute must be an array.','','2018-09-12 17:25:16',NULL,0),(213,'jp','validation','before','The :attribute must be a date before :date.','','2018-09-12 17:25:16',NULL,0),(214,'jp','validation','before_or_equal','The :attribute must be a date before or equal to :date.','','2018-09-12 17:25:16',NULL,0),(215,'jp','validation','between','The :attribute must have between :min and :max items.','array','2018-09-12 17:25:16',NULL,0),(216,'jp','validation','between','The :attribute must be between :min and :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(217,'jp','validation','between','The :attribute must be between :min and :max.','numeric','2018-09-12 17:25:16',NULL,0),(218,'jp','validation','between','The :attribute must be between :min and :max characters.','string','2018-09-12 17:25:16',NULL,0),(219,'jp','validation','boolean','The :attribute field must be true or false.','','2018-09-12 17:25:16',NULL,0),(220,'jp','validation','common_error','Common error','','2018-09-12 17:25:16',NULL,0),(221,'jp','validation','confirmed','The :attribute confirmation does not match.','','2018-09-12 17:25:16',NULL,0),(222,'jp','validation','date','The :attribute is not a valid date.','','2018-09-12 17:25:16',NULL,0),(223,'jp','validation','date_format','The :attribute does not match the format :format.','','2018-09-12 17:25:16',NULL,0),(224,'jp','validation','different','The :attribute and :other must be different.','','2018-09-12 17:25:16',NULL,0),(225,'jp','validation','digits','The :attribute must be :digits digits.','','2018-09-12 17:25:16',NULL,0),(226,'jp','validation','digits_between','The :attribute must be between :min and :max digits.','','2018-09-12 17:25:16',NULL,0),(227,'jp','validation','dimensions','The :attribute has invalid image dimensions.','','2018-09-12 17:25:16',NULL,0),(228,'jp','validation','distinct','The :attribute field has a duplicate value.','','2018-09-12 17:25:16',NULL,0),(229,'jp','validation','email','The :attribute must be a valid email address.','','2018-09-12 17:25:16',NULL,0),(230,'jp','validation','exists','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(231,'jp','validation','f vg','red','','2018-09-12 17:25:16',NULL,0),(232,'jp','validation','file','The :attribute must be a file.','','2018-09-12 17:25:16',NULL,0),(233,'jp','validation','filled','The :attribute field must have a value.','','2018-09-12 17:25:16',NULL,0),(234,'jp','validation','gt','The :attribute must have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(235,'jp','validation','gt','The :attribute must be greater than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(236,'jp','validation','gt','The :attribute must be greater than :value.','numeric','2018-09-12 17:25:16',NULL,0),(237,'jp','validation','gt','The :attribute must be greater than :value characters.','string','2018-09-12 17:25:16',NULL,0),(238,'jp','validation','gte','The :attribute must have :value items or more.','array','2018-09-12 17:25:16',NULL,0),(239,'jp','validation','gte','The :attribute must be greater than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(240,'jp','validation','gte','The :attribute must be greater than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(241,'jp','validation','gte','The :attribute must be greater than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(242,'jp','validation','image','The :attribute must be an image.','','2018-09-12 17:25:16',NULL,0),(243,'jp','validation','in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(244,'jp','validation','integer','The :attribute must be an integer.','','2018-09-12 17:25:16',NULL,0),(245,'jp','validation','in_array','The :attribute field does not exist in :other.','','2018-09-12 17:25:16',NULL,0),(246,'jp','validation','ip','The :attribute must be a valid IP address.','','2018-09-12 17:25:16',NULL,0),(247,'jp','validation','ipv4','The :attribute must be a valid IPv4 address.','','2018-09-12 17:25:16',NULL,0),(248,'jp','validation','ipv6','The :attribute must be a valid IPv6 address.','','2018-09-12 17:25:16',NULL,0),(249,'jp','validation','json','The :attribute must be a valid JSON string.','','2018-09-12 17:25:16',NULL,0),(250,'jp','validation','lt','The :attribute must have less than :value items.','array','2018-09-12 17:25:16',NULL,0),(251,'jp','validation','lt','The :attribute must be less than :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(252,'jp','validation','lt','The :attribute must be less than :value.','numeric','2018-09-12 17:25:16',NULL,0),(253,'jp','validation','lt','The :attribute must be less than :value characters.','string','2018-09-12 17:25:16',NULL,0),(254,'jp','validation','lte','The :attribute must not have more than :value items.','array','2018-09-12 17:25:16',NULL,0),(255,'jp','validation','lte','The :attribute must be less than or equal :value kilobytes.','file','2018-09-12 17:25:16',NULL,0),(256,'jp','validation','lte','The :attribute must be less than or equal :value.','numeric','2018-09-12 17:25:16',NULL,0),(257,'jp','validation','lte','The :attribute must be less than or equal :value characters.','string','2018-09-12 17:25:16',NULL,0),(258,'jp','validation','max','The :attribute may not have more than :max items.','array','2018-09-12 17:25:16',NULL,0),(259,'jp','validation','max','The :attribute may not be greater than :max kilobytes.','file','2018-09-12 17:25:16',NULL,0),(260,'jp','validation','max','The :attribute may not be greater than :max.','numeric','2018-09-12 17:25:16',NULL,0),(261,'jp','validation','max','The :attribute may not be greater than :max characters.','string','2018-09-12 17:25:16',NULL,0),(262,'jp','validation','mimes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(263,'jp','validation','mimetypes','The :attribute must be a file of type: :values.','','2018-09-12 17:25:16',NULL,0),(264,'jp','validation','min','The :attribute must have at least :min items.','array','2018-09-12 17:25:16',NULL,0),(265,'jp','validation','min','The :attribute must be at least :min kilobytes.','file','2018-09-12 17:25:16',NULL,0),(266,'jp','validation','min','The :attribute must be at least :min.','numeric','2018-09-12 17:25:16',NULL,0),(267,'jp','validation','min','The :attribute must be at least :min characters.','string','2018-09-12 17:25:16',NULL,0),(268,'jp','validation','not_in','The selected :attribute is invalid.','','2018-09-12 17:25:16',NULL,0),(269,'jp','validation','not_regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(270,'jp','validation','numeric','The :attribute must be a number.','','2018-09-12 17:25:16',NULL,0),(271,'jp','validation','present','The :attribute field must be present.','','2018-09-12 17:25:16',NULL,0),(272,'jp','validation','regex','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0),(273,'jp','validation','required','fffffff fffff','','2018-09-12 17:25:16',NULL,0),(274,'jp','validation','required_if','The :attribute field is required when :other is :value.','','2018-09-12 17:25:16',NULL,0),(275,'jp','validation','required_unless','The :attribute field is required unless :other is in :values.','','2018-09-12 17:25:16',NULL,0),(276,'jp','validation','required_with','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(277,'jp','validation','required_without','The :attribute field is required when :values is not present.','','2018-09-12 17:25:16',NULL,0),(278,'jp','validation','required_without_all','The :attribute field is required when none of :values are present.','','2018-09-12 17:25:16',NULL,0),(279,'jp','validation','required_with_all','The :attribute field is required when :values is present.','','2018-09-12 17:25:16',NULL,0),(280,'jp','validation','same','The :attribute and :other must match.','','2018-09-12 17:25:16',NULL,0),(281,'jp','validation','size','The :attribute must contain :size items.','array','2018-09-12 17:25:16',NULL,0),(282,'jp','validation','size','The :attribute must be :size kilobytes.','file','2018-09-12 17:25:16',NULL,0),(283,'jp','validation','size','The :attribute must be :size.','numeric','2018-09-12 17:25:16',NULL,0),(284,'jp','validation','size','The :attribute must be :size characters.','string','2018-09-12 17:25:16',NULL,0),(285,'jp','validation','string','The :attribute must be a string.','','2018-09-12 17:25:16',NULL,0),(286,'jp','validation','test8','test0','file','2018-09-12 17:25:16',NULL,0),(287,'jp','validation','test8','test0','numeric','2018-09-12 17:25:16',NULL,0),(288,'jp','validation','timezone','The :attribute must be a valid zone.','','2018-09-12 17:25:16',NULL,0),(289,'jp','validation','unique','The :attribute has already been taken.','','2018-09-12 17:25:16',NULL,0),(290,'jp','validation','uploaded','The :attribute failed to upload.','','2018-09-12 17:25:16',NULL,0),(291,'jp','validation','url','The :attribute format is invalid.','','2018-09-12 17:25:16',NULL,0);
/*!40000 ALTER TABLE `sys_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_validation_input_type`
--

DROP TABLE IF EXISTS `sys_validation_input_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_validation_input_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(45) DEFAULT NULL,
  `type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_code_UNIQUE` (`type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_validation_input_type`
--

LOCK TABLES `sys_validation_input_type` WRITE;
/*!40000 ALTER TABLE `sys_validation_input_type` DISABLE KEYS */;
REPLACE INTO `sys_validation_input_type` VALUES (1,'numeric','numeric'),(2,'file','file'),(3,'string','string'),(4,'array','array');
/*!40000 ALTER TABLE `sys_validation_input_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_value` int(11) DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` VALUES (48,'1@mail.com','$2y$10$4z9W9Pipke/Kx1YfoizKOeJgGipvHu4/dtwzmzyr5SgQywXt2feUe',2,'Thanh',NULL,'2018-09-06 11:54:08','2018-09-06 11:54:08',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_detail`
--

DROP TABLE IF EXISTS `users_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users_detail` (
  `user_id` int(11) NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_detail`
--

LOCK TABLES `users_detail` WRITE;
/*!40000 ALTER TABLE `users_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `view_category_item_level`
--

DROP TABLE IF EXISTS `view_category_item_level`;
/*!50001 DROP VIEW IF EXISTS `view_category_item_level`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_category_item_level` AS SELECT 
 1 AS `id`,
 1 AS `name`,
 1 AS `lft`,
 1 AS `rgt`,
 1 AS `url`,
 1 AS `order_value`,
 1 AS `level_value`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `view_entity_infor`
--

DROP TABLE IF EXISTS `view_entity_infor`;
/*!50001 DROP VIEW IF EXISTS `view_entity_infor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_entity_infor` AS SELECT 
 1 AS `id`,
 1 AS `name`,
 1 AS `menu_id`,
 1 AS `image`,
 1 AS `price`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `store_id`,
 1 AS `entity_prop_id`,
 1 AS `data_type_code`,
 1 AS `prop_data_type`,
 1 AS `property_label`,
 1 AS `property_name`,
 1 AS `value`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'store'
--

--
-- Dumping routines for database 'store'
--
/*!50003 DROP FUNCTION IF EXISTS `get_error_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `get_error_code`() RETURNS int(11)
BEGIN
	RETURN -1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `get_error_message` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `get_error_message`(code INT, message_code VARCHAR(255)) RETURNS varchar(255) CHARSET latin1
BEGIN
	RETURN '';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `get_success_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `get_success_code`() RETURNS int(11)
BEGIN
	RETURN 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STRING` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` FUNCTION `SPLIT_STRING`(
	str LONGTEXT CHARSET utf8,
	delim VARCHAR(10) ,
	pos INT
) RETURNS longtext CHARSET utf8
RETURN REPLACE(
	SUBSTRING(
		SUBSTRING_INDEX(str , delim , pos) ,
		CHAR_LENGTH(
			SUBSTRING_INDEX(str , delim , pos - 1)
		) + 1
	) ,
	delim ,
	''
) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ACL_GET_MODULES_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ACL_GET_MODULES_LST`()
BEGIN
	SELECT * FROM sys_modules ORDER BY order_value;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ACL_GET_ROLES_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ACL_GET_ROLES_LST`()
BEGIN
	SELECT * FROM sys_roles
    ORDER BY role_value;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ACL_GET_ROLES_MAP_ACTION_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ACL_GET_ROLES_MAP_ACTION_LST`()
BEGIN

	SELECT
		SR.id AS role_id
	,	SR.name AS role_name
    ,	SR.role_value AS role_value
    ,	SR.description AS role_description
    FROM sys_roles AS SR
    ORDER BY SR.role_value;

	SELECT
		SR.id AS role_id
	,	RMS.id AS role_map_id
	,	SR.name AS role_name
    ,	SR.role_value AS role_value
    ,	SR.description AS role_description
    ,	SS.module
    ,	SS.controller
    ,	SS.action
    ,	RMS.is_active AS is_active
    ,	SS.screen_code AS screen_code
    FROM sys_roles AS SR
    LEFT JOIN sys_role_map_screen AS RMS ON
			SR.role_value = RMS.role_value
	LEFT JOIN sys_screens AS SS ON
			RMS.screen_id = SS.id
	INNER JOIN sys_modules AS DM ON
			DM.module_code = SS.module
		AND DM.is_skip_acl <> 1
	ORDER BY
		SR.role_value
	,	RMS.screen_id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ACL_ROLE_UPDATE_ACTIVE_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ACL_ROLE_UPDATE_ACTIVE_ACT`(roleMapId INT,isActive INT)
BEGIN
	UPDATE sys_role_map_screen
    SET
		is_active = isActive
	WHERE
		id = roleMapId;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ACL_ROLE_UPDATE_ACTIVE_ALL_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ACL_ROLE_UPDATE_ACTIVE_ALL_ACT`(isActive INT)
BEGIN
	UPDATE sys_role_map_screen
    SET
		is_active = isActive;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_ADD_TRANSLATE_COMBO_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_ADD_TRANSLATE_COMBO_LST`()
BEGIN

    SELECT
		id
	,	type_code
    ,	type_name
	FROM sys_validation_input_type;

	SELECT
		id
	,	code
    ,	comment
    ,	has_input_type
    FROM sys_translate_type
    ORDER BY order_value;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_BACKUP_TRANSLATE_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_BACKUP_TRANSLATE_ACT`()
BEGIN

    TRUNCATE TABLE sys_translate_backup;
	INSERT INTO sys_translate_backup(
		id
	,	lang_code
    ,	translate_type
    ,	code
    ,	text
    ,	input_type
    ,	created_At
    ,	updated_at
    ,	is_deleted

    )
    SELECT
    	id
	,	lang_code
    ,	translate_type
    ,	code
    ,	text
    ,	input_type
    ,	created_At
    ,	updated_at
    ,	is_deleted
    FROM sys_translation;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_CATELORY_ADD_CHILD_IN_LEFT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_CATELORY_ADD_CHILD_IN_LEFT`(parentNodeId INT, newNodeName VARCHAR(100),newUrl VARCHAR(100))
BEGIN
	DECLARE lft_tmp INT default 0;
    DECLARE newId INT default 0;
    SET lft_tmp = (
		SELECT lft FROM catelory
		WHERE id = parentNodeId
        LIMIT 1
	);

    SET SQL_SAFE_UPDATES = 0;
    UPDATE catelory
	SET
		lft = lft+2
    WHERE
		lft > lft_tmp;

	UPDATE catelory
	SET
		rgt = rgt+2
    WHERE
		rgt > lft_tmp;

    INSERT INTO catelory(name, lft, rgt,url) VALUES(newNodeName, lft_tmp + 1, lft_tmp + 2,newUrl);
    SET newId = LAST_INSERT_ID();
    CALL sys_show_result(get_success_code(), CONCAT('{"message_code":"success_code","newid":',newId,'}'));

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_CATELORY_ADD_SIBLING` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_CATELORY_ADD_SIBLING`(currentNodeId INT, newNodeName VARCHAR(100),newUrl VARCHAR(100))
BEGIN
	DECLARE rgt_tmp INT default 0;
    DECLARE newId INT default 0;
    SET rgt_tmp = (
		SELECT  rgt FROM catelory
		WHERE id = currentNodeId
        LIMIT 1);

    UPDATE catelory
	SET
		lft = lft+2
    WHERE
		lft > rgt_tmp;
	 UPDATE catelory
	SET
		rgt = rgt+2
    WHERE
		rgt > rgt_tmp;

    INSERT INTO catelory(name, lft, rgt,url) VALUES(newNodeName, rgt_tmp + 1, rgt_tmp + 2,newUrl);
    SET newId = LAST_INSERT_ID();
    CALL sys_show_result(get_success_code(), CONCAT('{"message_code":"success_code","newid":',newId,'}'));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_CATELORY_DELETE_NODE_AND_CHILD` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_CATELORY_DELETE_NODE_AND_CHILD`(nodeId INT)
BEGIN
	DECLARE myLeft INT default 0;
    DECLARE myRight INT default 0;
	DECLARE myWidth INT default 0;

	SELECT lft, rgt,(rgt - lft + 1) INTO myLeft , myRight , myWidth
	FROM catelory
	WHERE id = nodeId;
	START TRANSACTION;
    /** Delete not root node only **/
    IF myLeft >1 THEN
		DELETE FROM catelory WHERE lft BETWEEN myLeft AND myRight;
		UPDATE catelory SET rgt = rgt - myWidth WHERE rgt > myRight;
		UPDATE catelory SET lft = lft - myWidth WHERE lft > myRight;
    END IF;
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_CATELORY_UPDATE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_CATELORY_UPDATE`(nodeId INT, pName VARCHAR(100),p_url VARCHAR(100) )
BEGIN
	UPDATE catelory SET name = pName , url = p_url WHERE id = nodeId;
    CALL sys_show_result(get_success_code(), CONCAT('{"message_code":"success_code"}'));

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_ALL_SP_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_ALL_SP_LST`()
BEGIN
	SHOW PROCEDURE STATUS
	WHERE Db = DATABASE() AND Type = 'PROCEDURE';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_ALL_TABLE_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_ALL_TABLE_LST`()
BEGIN
	select table_name As name from information_schema.tables WHERE TABLE_SCHEMA = DATABASE();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_CATEGORY_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_CATEGORY_LST`()
BEGIN

	SELECT BASE.id, BASE.name, BASE.level_value ,BASE.url, BASE.order_value, TMP.id AS parent
    FROM view_category_item_level AS BASE
	LEFT JOIN view_category_item_level AS TMP ON
			TMP.level_value = BASE.level_value -1
		AND  BASE.lft BETWEEN TMP.lft AND TMP.rgt
	ORDER BY BASE.id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_CATEGORY_WITH_LEVEL_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_CATEGORY_WITH_LEVEL_LIST`()
BEGIN
	SELECT BASE.id, BASE.name, BASE.level_value, BASE.lft, BASE.rgt,BASE.url, BASE.order_value
    FROM view_category_item_level AS BASE
	ORDER BY BASE.lft;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_LANGUAGE_CODE_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_LANGUAGE_CODE_LST`()
BEGIN
	SELECT
		id,
        code,
        name
	FROM sys_languages;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_MODULES_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_MODULES_LST`()
BEGIN
	SELECT * FROM sys_modules ORDER BY order_value;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_PARAM_OF_SPS_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_PARAM_OF_SPS_LST`(p_procedureName VARCHAR(250) charset utf8)
BEGIN

	SELECT *
	FROM information_schema.parameters
	WHERE SPECIFIC_NAME = p_procedureName
    AND SPECIFIC_SCHEMA = DATABASE()
    ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_ROLES_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_ROLES_LST`()
BEGIN
	SELECT * FROM sys_roles
    ORDER BY role_value;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_ROLES_MAP_ACTION_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_ROLES_MAP_ACTION_LST`()
BEGIN

	SELECT
		SR.id AS role_id
	,	SR.name AS role_name
    ,	SR.role_value AS role_value
    ,	SR.description AS role_description
    FROM sys_roles AS SR
    ORDER BY SR.role_value;

	SELECT
		SR.id AS role_id
	,	RMS.id AS role_map_id
	,	SR.name AS role_name
    ,	SR.role_value AS role_value
    ,	SR.description AS role_description
    ,	SS.module
    ,	SS.controller
    ,	SS.action
    ,	RMS.is_active AS is_active
    ,	SS.screen_code AS screen_code
    FROM sys_roles AS SR
    LEFT JOIN sys_role_map_screen AS RMS ON
			SR.role_value = RMS.role_value
	LEFT JOIN sys_screens AS SS ON
			RMS.screen_id = SS.id
	INNER JOIN sys_modules AS DM ON
			DM.module_code = SS.module
		AND DM.is_skip_acl <> 1
	ORDER BY
		SR.role_value
	,	RMS.screen_id;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_TRANSLATION_DATA_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_TRANSLATION_DATA_LST`( p_translate_type_code VARCHAR(50),p_lang VARCHAR(50) )
BEGIN
	SELECT
			V.id
		,	V.lang_code
        ,	VI.type_code
		,	V.code
		,	V.text
        ,	TT.code AS translate_type_code
		FROM sys_translation AS V
		LEFT JOIN sys_validation_input_type AS VI ON
			V.input_type = VI.type_code
		LEFT JOIN sys_translate_type TT ON
			V.translate_type= TT.code
		WHERE
				(V.is_deleted IS NULL OR  V.is_deleted<>1)
			AND (	p_translate_type_code IS NULL OR p_translate_type_code = '' OR TT.code= p_translate_type_code)
			AND (TT.code IS NOT NULL)
            AND (	p_lang IS NULL OR p_lang = '' OR V.lang_code= p_lang)
        ORDER BY
				V.lang_code
			,	V.code
			,	VI.type_name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_TRANSLATION_TYPE_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_TRANSLATION_TYPE_LST`()
BEGIN
	SELECT id,code,comment,has_input_type FROM sys_translate_type
    ORDER BY code;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_GET_VALIDATION_RULES_LST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_GET_VALIDATION_RULES_LST`()
BEGIN
	SELECT
		V.id
	,	V.lang_code
    ,	V.code
    ,	VI.type_name
    ,	V.text
	FROM sys_translation AS V
    LEFT JOIN sys_validation_input_type AS VI ON
		V.input_type = VI.id
	LEFT JOIN sys_translate_type TT ON
		V.translate_type= TT.id
	WHERE
			V.is_deleted IS NULL
		OR  V.is_deleted<>1
		AND TT.code= 'validation'
	ORDER BY
			V.lang_code
		,	V.code
        ,	VI.type_name;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_IMPORT_AND_MERGER_ROLE_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_IMPORT_AND_MERGER_ROLE_ACT`(p_listScreen JSON)
BEGIN


		DECLARE i,j INT DEFAULT 1;
		DECLARE countElement INT DEFAULT 0;
		DECLARE screen_json_arr JSON;
		DECLARE tmpRecord JSON;
		CREATE TEMPORARY TABLE IF NOT EXISTS SCREEN_INFO (
			id INT NOT NULL  AUTO_INCREMENT,
			module VARCHAR(50) NOT NULL,
			controller VARCHAR(50) NOT NULL,
			action_name VARCHAR(50) NOT NULL,
            screen_code VARCHAR(100) NOT NULL,
            description VARCHAR(100),
			PRIMARY KEY (id)
		);
		CREATE TEMPORARY TABLE IF NOT EXISTS SCREEN_MAP_ROLE (
			module VARCHAR(50) NOT NULL,
			controller VARCHAR(50) NOT NULL,
			action_name VARCHAR(50) NOT NULL,
			role_value INT,
			is_active TINYINT(4)
		);
        CREATE TEMPORARY TABLE IF NOT EXISTS SCREEN_MAP_ROLE_INSERT (
			module VARCHAR(50) NOT NULL,
			controller VARCHAR(50) NOT NULL,
			action_name VARCHAR(50) NOT NULL,
			role_value INT,
			is_active TINYINT(4)
		);
        START TRANSACTION;
		/**
		INIT INPUT DATA
		**/
		SET screen_json_arr = JSON_EXTRACT(p_listScreen,'$.*');
		SET countElement = JSON_LENGTH(screen_json_arr) ;
		WHILE i <= countElement DO
			SET j = i-1;
			SET tmpRecord = JSON_EXTRACT(screen_json_arr,CONCAT('$[',j,']'));
			INSERT INTO SCREEN_INFO(
				id
			,	module
			,	controller
			,	action_name
            ,	screen_code
            ,	description
			)
			SELECT
				i
			,	JSON_UNQUOTE(JSON_EXTRACT(tmpRecord,'$.module'))
			,	JSON_UNQUOTE(JSON_EXTRACT(tmpRecord,'$.controller'))
			,	JSON_UNQUOTE(JSON_EXTRACT(tmpRecord,'$.action'))
            ,	JSON_UNQUOTE(JSON_EXTRACT(tmpRecord,'$.screen_code'))
            ,	JSON_UNQUOTE(JSON_EXTRACT(tmpRecord,'$.description'))
			;
			SET i = i+1;
		END WHILE;

		/** BUSSINESS**/
		INSERT SCREEN_MAP_ROLE(
			module ,
			controller,
			action_name,
			role_value,
			is_active
		)
		SELECT
			S.module
		,	S.controller
		,	S.action
		,	RMS.role_value
		,	RMS.is_active
		FROM sys_role_map_screen AS RMS
		INNER JOIN sys_screens AS S ON
			RMS.screen_id = S.id;
		/** Remove all not exists in screen list**/

		DELETE FROM SCREEN_MAP_ROLE
        WHERE
			SCREEN_MAP_ROLE.module NOT IN (SELECT module FROM SCREEN_INFO);
		DELETE FROM SCREEN_MAP_ROLE
        WHERE
			 SCREEN_MAP_ROLE.controller NOT IN (SELECT controller FROM SCREEN_INFO);
		DELETE FROM SCREEN_MAP_ROLE
        WHERE
			SCREEN_MAP_ROLE.action_name NOT IN (SELECT action_name FROM SCREEN_INFO);


        INSERT INTO SCREEN_MAP_ROLE_INSERT(
			module ,
			controller,
			action_name,
			role_value,
			is_active
        )
        SELECT
			module ,
			controller,
			action_name,
			role_value,
			is_active
		FROM SCREEN_MAP_ROLE;


		INSERT INTO SCREEN_MAP_ROLE_INSERT(
			module ,
			controller,
			action_name,
			role_value,
			is_active
		)
		SELECT DISTINCT
			S.module
		,	S.controller
		,	S.action_name
		,	R.role_value
		,	0
		FROM SCREEN_INFO AS S
        LEFT JOIN SCREEN_MAP_ROLE AS RMS  ON
				S.module =  RMS.module
			AND	S.controller =  RMS.controller
			AND S.action_name = RMS.action_name
        CROSS JOIN sys_roles AS R
        WHERE RMS.module IS NULL;

		TRUNCATE TABLE sys_screens;
		INSERT INTO sys_screens(
			id
		,	module
		,	controller
		,	action
        ,	screen_code
		,	description
		)
		SELECT
			id
		,	module
		,	controller
		,	action_name
        ,	screen_code
		,	description
		FROM SCREEN_INFO;

		TRUNCATE TABLE sys_role_map_screen;
		INSERT INTO sys_role_map_screen(
			role_value
		,	screen_id
		,	is_active
		)
		SELECT
			RMS.role_value
		,	S.id
		,	RMS.is_active
		FROM SCREEN_MAP_ROLE_INSERT AS RMS
		INNER JOIN sys_screens AS S ON
				RMS.module =  S.module
			AND RMS.controller = S.controller
			AND RMS.action_name = S.action;

        COMMIT;

		DROP TABLE SCREEN_INFO;
		DROP TABLE SCREEN_MAP_ROLE;
        DROP TABLE SCREEN_MAP_ROLE_INSERT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_ROLE_UPDATE_ACTIVE_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_ROLE_UPDATE_ACTIVE_ACT`(roleMapId INT,isActive INT)
BEGIN
	UPDATE sys_role_map_screen
    SET
		is_active = isActive
	WHERE
		id = roleMapId;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_ROLE_UPDATE_ACTIVE_ALL_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_ROLE_UPDATE_ACTIVE_ALL_ACT`(isActive INT)
BEGIN
	UPDATE sys_role_map_screen
    SET
		is_active = isActive;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_TRANSLATE_DELETE_TEXT_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_TRANSLATE_DELETE_TEXT_ACT`(p_id INT)
BEGIN
	DELETE FROM sys_translation WHERE id= p_id;
	CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_TRANSLATE_INSERT_NEW_TEXT_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_TRANSLATE_INSERT_NEW_TEXT_ACT`(
	p_transType VARCHAR(20)
,	p_transInputType VARCHAR(20)
,	p_transTextCode VARCHAR(100)
,	p_textTrans JSON
)
BEGIN

    DECLARE isValidateType INT default 0;


    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
	BEGIN
		call sys_show_message_error('-9999','DB_exception_code');
	END;
	CREATE  temporary TABLE IF NOT EXISTS temp(
		id INT NOT NULL AUTO_INCREMENT
    ,	lang VARCHAR(20)
    ,	trans_text VARCHAR(255) ,
    PRIMARY KEY (id)
    ) engine Memory;

    IF NOT EXISTS(SELECT id FROM sys_translation
    WHERE 	(code=p_transTextCode AND COALESCE(input_type,'') = COALESCE(p_transInputType,'') )
        OR (code=p_transTextCode
				AND (
					(	COALESCE(input_type,'') = '' AND COALESCE(p_transInputType,'')<> '')
                OR (COALESCE(input_type,'') <> '' AND COALESCE(p_transInputType,'')= '')
                )
			)
	) THEN

        SET isValidateType =  (SELECT MAX(has_input_type) FROM sys_translate_type WHERE code= p_transInputType );

		INSERT INTO temp(
			lang
		,	trans_text
		)
		SELECT
			SL.code,
			JSON_UNQUOTE(JSON_EXTRACT(p_textTrans, CONCAT('$.',SL.code))) AS trans_text
		FROM  sys_languages AS SL;


		INSERT INTO sys_translation(
				lang_code
			,	translate_type
			,	code
			,	text
			,	input_type
			,	created_at
			,	updated_at
			,	is_deleted
		)
		SELECT
			TMP.lang
		,	p_transType
		,	p_transTextCode
		,	TMP.trans_text
		,	CASE
				WHEN isValidateType = 1 THEN p_transInputType
                ELSE ''
			END
		,	NOW()
		,	NULL
		,	0
		FROM temp AS TMP;
        CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
    ELSE
		call sys_show_result(get_error_code(),'{"text_code":"trans_exists_code"}');
    END IF;


    DROP TABLE temp;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_TRANSLATE_UPDATE_TEXT_ACT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_TRANSLATE_UPDATE_TEXT_ACT`(
	p_id INT
,	p_text TEXT  CHARACTER SET utf8 )
BEGIN
	UPDATE sys_translation
    SET
		text = p_text
	,	updated_at = NOW()
	WHERE
		id = p_id;

	CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_USER_ROLE_GET_LIST_USERS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_USER_ROLE_GET_LIST_USERS`()
BEGIN

	SELECT
	us.id AS user_id
	,	us.name AS user_name
    ,	us.email AS user_email
    ,	us.role_value AS user_role_value
    ,	us.is_active AS user_active
	,	sr.id AS role_id
	,	sr.name AS role_name
    ,	sr.role_value AS role_value
    ,	sr.description AS role_description
    ,   ud.birth_date AS user_birth_date
    ,   ud.gender AS user_gender

    FROM users AS us
    LEFT JOIN sys_roles AS sr ON
			us.role_value = sr.role_value
	LEFT JOIN users_detail AS ud ON
			us.id = ud.user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DEBUG_USER_ROLE_UPDATE_ROLES` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `DEBUG_USER_ROLE_UPDATE_ROLES`( current_id INT,current_role_value INT)
BEGIN
	UPDATE users
    SET
		role_value = current_role_value
	WHERE
		id = current_id;

    CALL sys_show_result(get_success_code(), '{"message_code":"success_code"}');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sys_show_message_error` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `sys_show_message_error`(code INT, dataError JSON)
BEGIN
	SELECT code AS code, dataError AS data_error;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sys_show_message_exception` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `sys_show_message_exception`(message_code varchar(500))
BEGIN
	SELECT -9999 AS code, message_code AS message_code;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sys_show_message_success` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `sys_show_message_success`()
BEGIN
	SELECT 0 AS code, 'success_message' AS message_code;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sys_show_result` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `sys_show_result`(code INT, dataError JSON)
BEGIN
	SELECT code AS code, dataError AS data;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `view_category_item_level`
--

/*!50001 DROP VIEW IF EXISTS `view_category_item_level`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_category_item_level` AS select `n`.`id` AS `id`,`n`.`name` AS `name`,`n`.`lft` AS `lft`,`n`.`rgt` AS `rgt`,`n`.`url` AS `url`,`n`.`order_value` AS `order_value`,(count(`p`.`id`) - 1) AS `level_value` from (`catelory` `n` left join `catelory` `p` on((`n`.`lft` between `p`.`lft` and `p`.`rgt`))) group by `n`.`id`,`n`.`name`,`n`.`lft`,`n`.`rgt` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_entity_infor`
--

/*!50001 DROP VIEW IF EXISTS `view_entity_infor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_entity_infor` AS select `e`.`id` AS `id`,`e`.`name` AS `name`,`e`.`menu_id` AS `menu_id`,`e`.`image` AS `image`,`e`.`price` AS `price`,`e`.`created_at` AS `created_at`,`e`.`updated_at` AS `updated_at`,`m`.`store_id` AS `store_id`,`ep`.`id` AS `entity_prop_id`,`ep`.`data_type_code` AS `data_type_code`,`ept`.`name` AS `prop_data_type`,`ep`.`property_label` AS `property_label`,`ep`.`property_name` AS `property_name`,`epv`.`value` AS `value` from ((((`store_entities` `e` left join `store_menu` `m` on((`e`.`menu_id` = `m`.`id`))) left join `store_entity_property_values` `epv` on((`epv`.`entity_id` = `e`.`id`))) left join `store_entity_properties` `ep` on((`epv`.`property_id` = `ep`.`id`))) left join `store_prop_data_types` `ept` on((`ept`.`code_value` = `ep`.`data_type_code`))) order by `e`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-14 17:52:54
