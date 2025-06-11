-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant_adminspace
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Alaa2','alaaotay@gmail.com','$2y$12$S7WkSWwuABJoJ/T2Hfss/.IDCYcuNQhDXBPQcfg/08jIn33nfhT4a','2024-08-07 16:51:10','2024-08-12 08:51:20'),(3,'yes2dev','info@yes2dev.com','$2y$12$w.3gv6W5ysXAg38V8RipF.VuqSRkFI34Fk8w7GD1YnwTyZOXuc08a','2024-08-07 18:17:48','2024-08-07 18:17:48');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fast food','uploaded_img/5b35ThBfQYM41OLskMyxbyIBFB6Tn5C1QsOVZxgI.png','2024-08-07 17:45:55','2024-08-07 17:45:55'),(2,'main dishes','uploaded_img/wKmKOYoMDoy0WJT8E8yqpgT6GYuBaFN6l3T2UCsi.png','2024-08-07 18:18:18','2024-08-07 18:18:18'),(3,'drinks','uploaded_img/NER9RWSqjmW4OkXsiO5IXOj0G9c6dbj2QPT765Ee.png','2024-08-07 18:18:30','2024-08-07 18:18:30'),(4,'desserts','uploaded_img/VZAEWZBJpngHefv2atYj9mmqyDVKfdRc4KrLccaD.png','2024-08-07 18:18:43','2024-08-07 18:18:43');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (52,'2014_10_12_100000_create_password_reset_tokens_table',1),(53,'2019_08_19_000000_create_failed_jobs_table',1),(54,'2019_12_14_000001_create_personal_access_tokens_table',1),(55,'2024_07_17_113337_create_admins_table',1),(56,'2024_07_17_113507_create_messages_table',1),(57,'2024_07_22_081946_create_categories_table',1),(58,'2024_07_24_104440_create_products_table',1),(60,'2024_07_28_212432_create_tables_table',1),(61,'2024_07_28_213452_create_orders_table',1),(62,'2024_08_08_031611_create_carts_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `table_id` bigint unsigned NOT NULL,
  `order_products` json NOT NULL,
  `total_products` int NOT NULL,
  `total_price` int NOT NULL,
  `remarks` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `placed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_table_id_foreign` (`table_id`),
  CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,2,'[{\"id\": 1, \"price\": 12, \"quantity\": \"2\"}, {\"id\": 13, \"price\": 15, \"quantity\": \"2\"}, {\"id\": 7, \"price\": 6.5, \"quantity\": \"2\"}]',6,67,NULL,'completed','2024-08-08 00:34:19','2024-08-07 23:34:19','2024-08-08 01:57:53'),(2,1,'[{\"id\": \"2\", \"price\": 9.99, \"quantity\": \"1\"}, {\"id\": \"15\", \"price\": 11.5, \"quantity\": \"1\"}, {\"id\": \"7\", \"price\": 6.5, \"quantity\": \"1\"}, {\"id\": \"8\", \"price\": 10.5, \"quantity\": \"1\"}]',4,38,'burger spicy','pending','2024-08-09 09:41:24','2024-08-09 08:41:24','2024-08-12 08:38:51'),(3,3,'[{\"id\": \"1\", \"price\": 12, \"quantity\": \"2\"}, {\"id\": \"13\", \"price\": 15, \"quantity\": \"1\"}, {\"id\": \"5\", \"price\": 11, \"quantity\": \"1\"}, {\"id\": \"7\", \"price\": 6.5, \"quantity\": \"1\"}]',5,57,NULL,'pending','2024-08-12 09:52:52','2024-08-12 08:52:52','2024-08-12 08:52:52');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Vegetarian Pizza',1,12.00,'uploaded_img/YBm4rVgDkQbXxCVD8QeyNAkY7dsmUgl1QUyCRD1Z.png','2024-07-22 07:52:53','2024-07-22 12:12:15'),(2,'Burger',1,9.99,'uploaded_img/g4OHTGqrJpbnZBkA9H6m93gTUuemkWqvUdH2d3fc.png','2024-07-22 08:09:18','2024-07-22 08:09:18'),(3,'spaghetti',2,18.50,'uploaded_img/IPhDObedxxUA1C6oE9DTfNBXrIwpCygONagK6efC.png','2024-07-22 08:25:17','2024-07-22 08:25:17'),(4,'coffee',3,3.50,'uploaded_img/Nmm1U3r670J7BDn1MUfe2cVFCGt3jYrm5hAWMUJZ.png','2024-07-22 08:35:37','2024-07-22 09:53:36'),(5,'strawberry milkshake',3,11.00,'uploaded_img/ut3fOs1m66ehPsf1i7tQyIcyYZZh8EMSWpYXNnCp.png','2024-07-22 08:37:03','2024-07-22 08:37:03'),(6,'chocolate milkshake',3,10.50,'uploaded_img/YsZGM5BeuQneWVEspLynjBLBH1T9rEzC5JT728Mw.png','2024-07-22 08:38:02','2024-07-22 08:38:02'),(7,'fresh orange juice',3,6.50,'uploaded_img/pgaI9Pnnd3CDqKEHeVAdvmJOmU5miCBflxL7sjBX.png','2024-07-22 08:38:57','2024-07-22 08:38:57'),(8,'mojito',3,10.50,'uploaded_img/hfwMAvdFgA3k4NZt8ZFvDXuOafsX3QJ7qwN37VuN.png','2024-07-22 08:39:51','2024-07-22 08:39:51'),(9,'strawberry cake',4,8.00,'uploaded_img/7HGDrefLdqQ9oW29BZNtE912hNa3yIddSAbmqOo7.png','2024-07-22 08:43:27','2024-07-22 08:43:27'),(10,'Mint Chocolate Slice',4,10.00,'uploaded_img/HBXQI1FA5FzGssgwhki8wv4fmFMt84EKFqHdc3Ir.png','2024-07-22 08:45:34','2024-07-22 08:45:34'),(11,'Chocolate Cupcake',4,6.50,'uploaded_img/jUIicSGEw43FuVX6SmmQuSlyXf8FxGO1OPWwsrhf.png','2024-07-22 08:46:45','2024-07-22 08:46:45'),(12,'Asian-Style Noodle Dish',2,19.00,'uploaded_img/g5HoxjJeEtFQsW75qAj3NggPL4o3BCS04pdubW9h.png','2024-07-22 08:48:33','2024-07-22 08:48:33'),(13,'Ham and Mushroom Pizza',1,15.00,'uploaded_img/wYaLIUJKRtF08s3ELge5MRSfnbtPe1kYNfwc5KtM.png','2024-07-22 08:50:13','2024-07-22 08:50:13'),(14,'Steak Stir-Fry',2,25.00,'uploaded_img/o7O5kSsIEmCn2f64sFEsu2ovUbaM4qnKIlbOpyNO.png','2024-07-22 08:51:55','2024-07-22 08:51:55'),(16,'tacos',1,11.50,'uploaded_img/PhdSL9gFlT8EAUk7SiCYo7UFKoz6SAqzm8IcYApC.jpg','2024-08-12 07:21:02','2024-08-12 07:21:02');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `table_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_reserved` tinyint(1) NOT NULL DEFAULT '0',
  `hall` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tables_table_number_unique` (`table_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'tab1 h1',1,'hall 1','2024-08-07 21:40:02','2024-08-12 08:38:38'),(2,'tab2 h1',1,'hall 1','2024-08-07 21:40:42','2024-08-12 08:52:05'),(3,'tab3 h1',1,'hall 1','2024-08-07 21:41:12','2024-08-12 08:52:50'),(4,'tab4 h2',0,'hall 2','2024-08-07 21:41:39','2024-08-08 01:54:44'),(5,'tab5 h2',0,'hall 2','2024-08-07 21:41:57','2024-08-07 21:41:57');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-12 13:01:31
