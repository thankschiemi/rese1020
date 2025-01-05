-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_db
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `restaurant_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorites_member_id_restaurant_id_unique` (`member_id`,`restaurant_id`),
  KEY `favorites_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `favorites_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,1,9,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(2,1,13,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(3,1,20,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(4,2,1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(5,2,5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(6,2,7,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(7,3,5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(8,4,11,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(9,5,3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(10,5,11,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(11,6,1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(12,6,6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(13,6,15,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(14,7,6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(15,8,2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(16,8,8,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(17,8,12,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(18,9,10,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(19,9,14,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(20,10,10,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(21,10,13,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(22,10,16,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(23,11,2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(24,11,20,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(25,12,4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(26,12,6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(27,12,11,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(28,2,21,'2024-12-28 07:15:28','2024-12-28 07:15:28'),(31,18,6,'2024-12-29 07:42:23','2024-12-29 07:42:23'),(32,18,10,'2024-12-29 07:42:24','2024-12-29 07:42:24'),(33,18,9,'2024-12-29 07:42:26','2024-12-29 07:42:26'),(34,18,11,'2024-12-29 07:42:29','2024-12-29 07:42:29'),(35,20,21,'2024-12-30 11:48:22','2024-12-30 11:48:22'),(36,20,22,'2024-12-30 11:48:23','2024-12-30 11:48:23');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genres_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'寿司',NULL,NULL),(2,'焼肉',NULL,NULL),(3,'居酒屋',NULL,NULL),(4,'イタリアン',NULL,NULL),(5,'ラーメン',NULL,NULL);
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user' COMMENT '権限区分（admin, owner, user）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Test Admin','admin@example.com','2024-12-28 07:13:43','$2y$10$osTxMjuGKabF5aimFunq3ehHamihSBpRmNrJVywKhiDva2O2HMVNS','chOMpgoNrLAHv50cmp53sZ9HsglbkLZHS4GUHN6GvVeEFsbvbMnRcqoxfi8l','2024-12-28 07:13:43','2024-12-28 07:13:43','admin'),(2,'Test Owner','owner@example.com','2024-12-28 07:13:43','$2y$10$/kqqY4jpcEZQW3Ra8yexVOOsrSvHHJ2fmP9RnjJFkFDnIWkCDHZAW','yrKZpoJT1vtSiSxYeJoSzfSyrJopGdZI7BwdVub0ET0YhMG96GzUiTQReIfc','2024-12-28 07:13:43','2024-12-28 07:13:43','owner'),(3,'喜嶋 翔太','fujimoto.soutaro@example.org','2024-12-28 07:13:43','$2y$10$VeCeldLsjpnIPVvLdJx/gu5ncEXJMyYWvWdLf4kZd4c90j7OdCPHq','wfcd7T1HKc','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(4,'津田 聡太郎','hanako30@example.org','2024-12-28 07:13:43','$2y$10$ASeZ8mAga7M5FmuhZleQXe18eOo1vojR9K5T/rHBAp8SPE8xkt.ka','DdrEdnEgl4','2024-12-28 07:13:44','2024-12-29 08:09:16','user'),(5,'宮沢 香織','ukondo@example.org','2024-12-28 07:13:43','$2y$10$zm1ascNWWkxqTQRlzQimb.9jo4W5eUw2qr2d8XgPayiD4NMu7neM.','nx67f6axcg','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(6,'大垣 陽子','ogaki.mitsuru@example.net','2024-12-28 07:13:43','$2y$10$1ka7BqTHz4E3TAuLeqmdwOxpSyiehHSY229g3sVALb/8c/dukYGrK','ryA7MN7tUq','2024-12-28 07:13:44','2024-12-28 07:35:42','owner'),(7,'浜田 太一','nakamura.atsushi@example.com','2024-12-28 07:13:43','$2y$10$1qgABHp.rBi2KaX5z5c4UOgXvEFrcbDOp93M73J1FFN/avNxii04O','zmZL0g9aaM','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(8,'渚 亮介','hkanou@example.net','2024-12-28 07:13:43','$2y$10$VUR6pLzlZ.bQDrsKYJZjSeNAD4RF.dLxSrVvBzfrH/qklx00Eipqm','gSBfk2Vn8t','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(9,'斉藤 七夏','kumiko.kiriyama@example.net','2024-12-28 07:13:43','$2y$10$nMCFB3WpGpoUuxvDaNMGg.R/Qjs9r5M040xbcdTV8LJYRBrq2TOiq','9d5Q07f7CW','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(10,'藤本 明美','cwakamatsu@example.org','2024-12-28 07:13:43','$2y$10$QRFVVSqbqI21XM2UbHQojeiKO2a5ucZ32qA8FTzjZEQVGVuQUNNzm','b03ZEpKM9n','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(11,'小泉 春香','matsumoto.osamu@example.net','2024-12-28 07:13:44','$2y$10$o0Rt4gXYqrj9B3rUTUSWHeKzHD/t3i8lk3wCtRMfUBTdoHALbIiiW','9GnTI0CX3b','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(12,'伊藤 さゆり','kaori.aota@example.net','2024-12-28 07:13:44','$2y$10$6y2hKKUFenXSZrpbU/hF3u6hMEYgvysy664dCPF8KB5VbBrONTcSa','ZTvyBgZamm','2024-12-28 07:13:44','2024-12-28 07:13:44','member'),(13,'ふーちゃん','hu@gmail.com','2024-12-28 07:19:01','$2y$10$WUM3LLUAuZEIQkWCb7nJFeGiWG2Cg5.uReg6xPvCfiTG.ivIavxGS',NULL,'2024-12-28 07:18:19','2024-12-28 07:47:41','admin'),(14,'鈴木英文','hide@gmail.com',NULL,'$2y$10$tmeTr8g4HBoxzAmN95cn0.J1mcVelcyj6NU72C/fdDsZz/LRQWm6W',NULL,'2024-12-28 07:21:30','2024-12-28 07:21:30','owner'),(15,'森山龍一郎','ryuu@gmail.com',NULL,'$2y$10$BKeebQkyvOTH8I0W4I73J..m/2Z3nfq8D/aPO9mxHOScDvtLPt5XO',NULL,'2024-12-28 07:22:28','2024-12-28 07:22:28','owner'),(16,'鈴木','suzuki@gmail.com',NULL,'$2y$10$/czrvLgFha7QIMoUpborQO.N0WX61TH.Duqx4PJiriRugbdTCdD1a',NULL,'2024-12-28 07:48:11','2024-12-28 07:53:49','user'),(17,'さちよ','sachiyo@gmail.com',NULL,'$2y$10$N32PMGHy/0eCu5gV3Gpa.eAphmaQKsMw8x7Bh82b/mROFa6D/g2Zi',NULL,'2024-12-28 07:52:06','2024-12-28 07:52:06','owner'),(18,'ふうちゃん','h@gmail.com','2024-12-29 07:04:07','$2y$10$6jN1lCmFgRCwbapnZfE70OOMCV3pjtIK4s50a6bQO9c3XK.ltlcwi',NULL,'2024-12-29 07:02:54','2024-12-29 07:04:07','user'),(19,'ちえみ','chimail@gmail.com',NULL,'$2y$10$sFg9nOsMs1I7kjXnOqUT/uBKuCR4mZJK0BJBmSZpJ0th6GjY/mCVu',NULL,'2024-12-29 08:04:49','2024-12-29 08:04:49','owner'),(20,'森山和雄','kazuo@gmail.com','2024-12-30 11:47:57','$2y$10$a94uXl4emlfNUhAdBPfkwOd.iEvSppESH5wOtHS4nb2tjG/GMmmTy',NULL,'2024-12-30 11:47:42','2024-12-30 11:47:57','user'),(21,'肩こり','kata@gmail.com','2024-12-30 12:12:12','$2y$10$nyLj3VFKoBrygsHMyetOROs1vWBWB4Gfs5RPK0JUGe4x4LX0y6oBW',NULL,'2024-12-30 12:11:44','2024-12-30 12:12:12','owner');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (14,'2014_10_12_000000_create_users_table',1),(15,'2014_10_12_100000_create_password_resets_table',1),(16,'2019_08_19_000000_create_failed_jobs_table',1),(17,'2019_12_14_000001_create_personal_access_tokens_table',1),(18,'2024_10_27_210940_create_regions_table',1),(19,'2024_10_27_210950_create_genres_table',1),(20,'2024_10_27_210955_create_restaurants_table',1),(21,'2024_10_29_140222_create_members_table',1),(22,'2024_10_29_150000_create_reservations_table',1),(23,'2024_11_02_185545_create_favorites_table',1),(24,'2024_11_20_133456_create_reviews_table',1),(25,'2024_11_29_214705_add_role_to_members_table',1),(26,'2024_12_03_162713_add_member_id_to_restaurants_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'東京都',NULL,NULL),(2,'大阪府',NULL,NULL),(3,'福岡県',NULL,NULL);
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `restaurant_id` bigint unsigned NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `number_of_people` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_member_id_foreign` (`member_id`),
  KEY `reservations_restaurant_id_foreign` (`restaurant_id`),
  CONSTRAINT `reservations_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,10,15,'2024-12-29','06:22:41',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(2,10,15,'2025-01-17','01:07:38',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(3,10,15,'2025-01-23','22:32:56',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(4,10,15,'2025-01-02','19:26:28',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(5,10,15,'2024-12-29','21:01:06',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(6,10,15,'2025-01-26','05:25:33',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(7,10,15,'2025-01-08','08:03:29',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(8,10,15,'2025-01-16','04:34:04',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(9,10,15,'2025-01-23','07:51:38',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(10,10,15,'2025-01-03','18:08:04',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(11,10,15,'2025-01-03','03:38:05',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(12,10,15,'2025-01-10','05:59:50',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(13,10,15,'2025-01-25','05:05:26',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(14,10,15,'2025-01-01','03:25:27',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(15,10,15,'2025-01-05','06:36:52',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(16,10,15,'2025-01-20','12:12:30',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(17,10,15,'2025-01-14','01:08:59',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(18,10,15,'2025-01-20','09:22:21',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(19,10,15,'2025-01-26','17:22:49',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(20,10,15,'2025-01-04','00:47:05',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(21,10,15,'2025-01-22','08:44:14',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(22,10,15,'2025-01-23','03:04:16',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(23,10,15,'2025-01-03','00:24:37',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(24,10,15,'2025-01-21','01:44:34',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(25,10,15,'2025-01-24','13:31:42',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(26,10,15,'2025-01-11','12:13:50',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(27,10,15,'2025-01-01','07:43:38',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(28,10,15,'2025-01-10','18:37:57',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(29,10,15,'2024-12-31','06:43:53',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(30,10,15,'2025-01-07','12:25:57',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(31,10,15,'2025-01-10','22:51:28',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(32,10,15,'2025-01-07','23:42:01',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(33,10,15,'2025-01-21','15:31:16',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(34,10,15,'2025-01-09','02:58:51',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(35,10,15,'2025-01-21','21:14:01',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(36,10,15,'2025-01-16','14:34:52',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(37,10,15,'2024-12-29','03:29:30',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(38,10,15,'2025-01-11','05:21:55',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(39,10,15,'2025-01-07','09:15:38',2,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(40,10,15,'2025-01-23','21:04:43',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(41,10,15,'2025-01-11','21:56:37',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(42,10,15,'2025-01-09','18:16:35',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(43,10,15,'2025-01-05','21:44:37',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(44,10,15,'2025-01-09','17:09:20',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(45,10,15,'2025-01-26','13:14:00',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(46,10,15,'2024-12-31','11:43:24',6,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(47,10,15,'2025-01-16','08:20:45',1,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(48,10,15,'2025-01-26','14:04:54',3,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(49,10,15,'2025-01-22','10:48:24',5,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(50,10,15,'2025-01-16','23:52:06',4,'2024-12-28 07:13:44','2024-12-28 07:13:44'),(53,20,21,'2024-12-31','11:00:00',2,'2024-12-30 11:48:42','2024-12-30 11:53:29'),(55,20,22,'2024-12-31','12:00:00',5,'2024-12-30 11:52:42','2024-12-30 11:52:42'),(56,21,23,'2024-12-31','11:00:00',3,'2024-12-30 12:13:56','2024-12-30 12:13:56');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` bigint unsigned NOT NULL,
  `genre_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurants_region_id_foreign` (`region_id`),
  KEY `restaurants_genre_id_foreign` (`genre_id`),
  KEY `restaurants_member_id_foreign` (`member_id`),
  CONSTRAINT `restaurants_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  CONSTRAINT `restaurants_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restaurants_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,NULL,'仙人',1,1,'料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。','images/sushi-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(2,NULL,'牛助',2,2,'焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。','images/yakiniku-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(3,NULL,'戦慄',3,3,'気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。','images/izakaya-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(4,NULL,'ルーク',1,4,'都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。','images/italian-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(5,NULL,'志摩屋',3,5,'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しており、居酒屋としても利用できます。ぜひご来店をお待ちしております。','images/ramen-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(6,NULL,'香',1,2,'大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。','images/yakiniku-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(7,NULL,'JJ',2,4,'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。','images/italian-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(8,NULL,'らーめん極み',1,5,'一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。','images/ramen-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(9,NULL,'鳥雨',2,3,'素材の旨味を存分に引き出す為に、塩焼を中心としたお店です。比内地鶏を中心に、厳選素材を職人が備長炭で豪快に焼き上げます。清潔な内装に包まれた大人の隠れ家で贅沢で優雅な時間をお過ごし下さい。','images/izakaya-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(10,NULL,'築地色合',1,1,'鮨好きの方の為の鮨屋として、迫力ある大きさの握りを1貫ずつ提供致します。','images/sushi-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(11,NULL,'晴海',2,2,'毎年チャンピオン牛を買い付け、仙台市長から表彰されるほどの上質な仕入れをする精肉店オーナーの本当に美味しい国産牛を食べてもらいたいという思いから誕生したお店です。','images/yakiniku-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(12,NULL,'三子',3,2,'最高級の美味しいお肉で日々の疲れを軽減していただければと贅沢にサーロインを盛り込んだ御膳をご用意しております。','images/yakiniku-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(13,NULL,'八戒',1,3,'当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。','images/izakaya-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(14,NULL,'福助',2,1,'ミシュラン掲載店で磨いた、寿司職人の旨さへのこだわりはもちろん、 食事をゆっくりと楽しんでいただける空間作りも意識し続けております。 接待や大切なお食事にはぜひご利用ください。','images/sushi-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(15,NULL,'ラー北',1,5,'お昼にはランチを求められるサラリーマン、夕方から夜にかけては、学生や会社帰りのサラリーマン、小上がり席もありファミリー層にも大人気です。','images/ramen-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(16,NULL,'翔',2,3,'博多出身の店主自ら厳選した新鮮な旬の素材を使ったコース料理をご提供します。一人一人のお客様に目が届くようにしております。','images/izakaya-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(17,NULL,'経緯',1,1,'職人が一つ一つ心を込めて丁寧に仕上げた、江戸前鮨ならではの味をお楽しみ頂けます。鮨に合った希少なお酒も数多くご用意しております。他にはない海鮮太巻き、当店自慢の蒸し鮑、是非ご賞味下さい。','images/sushi-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(18,NULL,'漆',1,2,'店内に一歩足を踏み入れると、肉の焼ける音と芳香が猛烈に食欲を掻き立ててくる。そんな漆で味わえるのは至極の焼き肉です。','images/yakiniku-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(19,NULL,'THE TOOL',3,4,'非日常的な空間で日頃の疲れを癒し、ゆったりとした上質な時間を過ごせる大人の為のレストラン&バーです。','images/italian-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(20,NULL,'木船',2,1,'毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。また、選りすぐりの種類豊富なドリンクもご用意しております。','images/sushi-image.jpg','2024-12-28 07:13:43','2024-12-28 07:13:43'),(21,2,'ふうちゃん',3,1,'カリカリでにぎってやるよ',NULL,'2024-12-28 07:15:08','2024-12-28 07:15:15'),(22,2,'鈴木英文',2,2,'イタリア',NULL,'2024-12-29 08:21:17','2024-12-29 08:24:58'),(23,21,'鈴木ふうこ',1,3,'ねこねこにゃんやん',NULL,'2024-12-30 12:12:47','2024-12-30 12:13:11');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint unsigned NOT NULL,
  `restaurant_id` bigint unsigned NOT NULL,
  `member_id` bigint unsigned NOT NULL,
  `rating` tinyint NOT NULL COMMENT '1～5の評価スコア',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_reservation_id_foreign` (`reservation_id`),
  KEY `reviews_restaurant_id_foreign` (`restaurant_id`),
  KEY `reviews_member_id_foreign` (`member_id`),
  CONSTRAINT `reviews_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,15,20,3,2,'Quidem sed qui saepe laborum ullam vero.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(2,25,13,10,3,'Necessitatibus doloribus nostrum qui repudiandae sunt molestias nemo nam ut dolorem beatae nesciunt soluta.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(3,3,4,8,3,'Soluta expedita et sunt labore eos incidunt atque officia accusamus.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(4,29,8,2,3,'Molestiae culpa et dicta et id quia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(5,21,13,3,1,'Officiis voluptas nemo harum et voluptatum qui.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(6,11,18,8,1,'Omnis itaque aspernatur perferendis blanditiis id sunt corrupti sint sed dolorum est modi.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(7,38,5,5,2,'Dolores aut veritatis quia distinctio et et dolorem minus maiores.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(8,10,20,5,3,'Id deleniti molestiae in ut magni eos ut et ipsum expedita necessitatibus asperiores quis.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(9,45,14,4,2,'Fuga culpa sed iste magnam rerum nemo nihil quos distinctio consectetur quidem.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(10,25,15,6,3,'Explicabo illo minus accusamus dolores ratione quo soluta cumque eius et.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(11,9,5,8,4,'Et tenetur suscipit explicabo exercitationem magnam omnis culpa quia enim quis aut.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(12,35,8,9,3,'Similique aut asperiores ut quam aut sapiente velit unde ut sit nulla.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(13,23,10,5,1,'Quia modi perferendis iusto porro voluptatum alias ratione repudiandae accusamus quod est sunt quia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(14,34,8,5,4,'Animi nam in amet rerum voluptas sunt et explicabo corrupti culpa officia sunt.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(15,25,14,7,3,'Ut hic est repellendus quibusdam voluptatibus debitis.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(16,26,12,4,2,'Aut consequatur iure et voluptas voluptatem qui ex qui.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(17,46,10,1,1,'Et inventore laboriosam maxime minima consequatur cumque fuga et expedita quia velit quibusdam quia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(18,12,8,6,1,'Magnam consequatur illo sequi iste quia necessitatibus tenetur dolorem.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(19,37,8,2,1,'Enim praesentium qui fugit quisquam et cum cumque voluptatem nobis ut aperiam.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(20,29,17,4,1,'Qui voluptatem sint praesentium voluptatem recusandae quia est hic quos perspiciatis accusamus sunt.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(21,49,11,9,1,'Possimus voluptatem culpa ratione doloremque dolores minima cumque magni eos enim.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(22,21,19,11,4,'Est tempore alias rerum molestiae aut est officiis.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(23,47,1,5,1,'Vel non omnis tenetur fugiat nihil vel excepturi provident aspernatur quisquam.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(24,22,4,8,3,'Reiciendis ut consequatur necessitatibus voluptatem qui distinctio facere distinctio quasi et.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(25,32,7,5,2,'Porro ut sed cumque vel sed quas aliquam dicta similique ad numquam suscipit ea.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(26,25,9,10,4,'Nemo perferendis sed possimus voluptatem ut quo omnis vero.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(27,2,18,7,4,'Velit nam commodi inventore quia odit est quisquam ea quo quae odio.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(28,45,18,2,1,'Sint dolor voluptatem et fugiat suscipit delectus repellat aut ex nulla.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(29,42,15,1,4,'Blanditiis omnis est vel doloremque in maiores et velit illo deserunt corrupti odit aspernatur.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(30,34,20,8,3,'Sapiente qui voluptas dolorem id dignissimos quo similique.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(31,37,8,1,2,'Ut cum molestiae eos quaerat aut consequatur quia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(32,28,8,8,1,'Tempore magni eos officiis aliquid tempora sint accusantium iste dolores sed aut.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(33,19,9,8,2,'Ratione voluptas suscipit aspernatur harum consequatur unde reiciendis excepturi aut dolores ut harum.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(34,32,18,6,1,'Ducimus ut sit quae tenetur sit aut molestiae recusandae voluptatem provident sint.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(35,18,6,5,4,'Labore est ratione et nemo quo facere saepe eum omnis doloribus.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(36,16,6,12,5,'Magni ut quo velit cumque adipisci voluptatibus sed ad vel nostrum neque laboriosam.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(37,22,16,5,3,'Recusandae dolorem in porro at quo iure deleniti vero deleniti est iste dolores.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(38,18,15,2,1,'Et rerum voluptates nobis neque laborum et et earum praesentium amet.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(39,33,8,1,3,'Sapiente optio incidunt quos a est expedita ut tenetur.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(40,39,2,7,4,'Quia at aut nisi et voluptate quia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(41,38,8,1,1,'Consectetur et id tempora provident expedita vel ea quisquam officia.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(42,45,18,12,1,'Perferendis voluptas fugiat et magni vitae corporis eius et officia fuga sed.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(43,38,18,4,2,'Vel sint est culpa ea delectus maiores non tempore quae sint dicta sed.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(44,49,11,4,4,'Asperiores qui occaecati rerum in fugiat laboriosam.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(45,20,16,3,4,'Vel ad atque assumenda qui non at sint perferendis natus.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(46,3,4,8,1,'Aliquid perferendis perferendis et velit voluptas ipsam dolorum magnam.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(47,42,14,11,3,'Nesciunt eum culpa qui eaque deserunt animi sed dolorum quaerat.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(48,4,18,1,1,'Amet nihil iure et veniam sint id pariatur.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(49,28,8,4,5,'Aut quia odio alias provident vel et voluptas sed voluptatem.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(50,40,3,1,1,'Non ex voluptatem nihil facere ex placeat ipsam accusamus ipsum architecto suscipit.','2024-12-28 07:13:44','2024-12-28 07:13:44'),(53,53,21,20,1,NULL,'2024-12-30 11:53:46','2024-12-30 11:53:46');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-30 12:49:13
