-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: npc
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `preview` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_news_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `collection_id` int(10) unsigned NOT NULL DEFAULT 0,
  `hidden` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_source_unique` (`source`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'2020/04/23_remont_pamyatnikov_voinam.xml','2020/04/23_remont_pamyatnikov_voinam.xml','2020-04-23 12:00:00',0,0,NULL,NULL,NULL),(2,'2020/05/08_remont_memorialov_vow.xml','2020/05/08_remont_memorialov_vow.xml','2020-05-08 12:00:00',0,0,NULL,NULL,NULL),(3,'2020/09/08_money_na_remont_okn.xml','2020/09/08_money_na_remont_okn.xml','2020-09-08 12:00:00',0,0,NULL,NULL,NULL),(4,'2020/10/30_finish_rabot_po_remontu_okn.xml','2020/10/30_finish_rabot_po_remontu_okn.xml','2020-10-30 12:00:00',0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `firewalls`
--

DROP TABLE IF EXISTS `firewalls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firewalls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` int(10) unsigned NOT NULL DEFAULT 0,
  `mask` int(10) unsigned NOT NULL DEFAULT 0,
  `bitmask` int(10) unsigned NOT NULL DEFAULT 0,
  `authtype` set('login','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `off` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firewalls_ip_unique` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firewalls`
--

LOCK TABLES `firewalls` WRITE;
/*!40000 ALTER TABLE `firewalls` DISABLE KEYS */;
INSERT INTO `firewalls` VALUES (1,2130706432,4294967040,4294967295,'login,email',0,'2021-11-12 05:46:35','2021-11-12 05:46:35'),(2,168390144,4294967040,4294967295,'login,email',0,'2021-11-12 05:46:35','2021-11-12 05:46:35'),(3,0,0,16777215,'email',0,'2021-11-12 05:46:35','2021-11-12 05:46:35');
/*!40000 ALTER TABLE `firewalls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL DEFAULT 0,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `preview` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pack_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,3,'/gosuslugi.png',NULL,'6a486f353c6c8d64c5629f05519b021f','Image0001',0,'2021-11-09 06:27:15','2021-11-09 06:27:54'),(2,3,'/heroic.jpg',NULL,'6a486f353c6c8d64c5629f05519b021f','Image0002',0,'2021-11-09 06:27:15','2021-11-09 06:29:57'),(3,3,'/memory.jpg',NULL,'6a486f353c6c8d64c5629f05519b021f','Image0003',0,'2021-11-09 06:27:15','2021-11-09 06:30:17'),(4,3,'/kgu.png',NULL,'6a486f353c6c8d64c5629f05519b021f','Image0004',0,'2021-11-09 06:27:15','2021-11-09 06:30:36'),(5,2,'/20200423_Shumkov.jpg','preview/20200423_Shumkov.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0005',0,'2021-11-12 15:03:57','2021-11-12 15:06:18'),(6,2,'/20200508_Sevostyanov.jpg','preview/20200508_Sevostyanov.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0006',0,'2021-11-12 15:03:57','2021-11-12 15:07:37'),(7,2,'/20200908_Sevostyanov.jpg','preview/20200908_Sevostyanov.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0007',0,'2021-11-12 15:03:57','2021-11-12 15:08:24'),(8,2,'/20201030_dalmatovskymuseum.jpg','preview/20201030_dalmatovskymuseum.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0008',0,'2021-11-12 15:03:57','2021-11-12 15:10:10'),(9,2,'/20210424_lesoposadki.jpg','preview/20210424_lesoposadki.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0009',0,'2021-11-12 15:03:57','2021-11-12 15:10:45'),(10,2,'/20210429_Shumkov.jpg','preview/20210429_Shumkov.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0010',0,'2021-11-12 15:03:57','2021-11-12 15:11:13'),(11,2,'/20210517_Savin.jpg','preview/20210517_Savin.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0011',0,'2021-11-12 15:03:57','2021-11-12 15:11:42'),(12,2,'/20210521_Savin.jpg','preview/20210521_Savin.jpg','8a8c560bd61b3ee54ee5941eefdc484c','Image0012',0,'2021-11-12 15:03:57','2021-11-12 15:12:13');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `rel_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Хранилище загрузок','/../storage/reception',0,'2021-11-08 11:58:41','2021-11-08 11:58:41'),(2,'Новости','/images/news',0,'2021-11-09 06:23:04','2021-11-09 06:23:04'),(3,'Баннеры','/images/banners',0,'2021-11-09 06:23:55','2021-11-09 06:23:55');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuitems`
--

DROP TABLE IF EXISTS `menuitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_group_id` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `node` int(10) unsigned NOT NULL DEFAULT 0,
  `mode` int(10) unsigned NOT NULL DEFAULT 1,
  `level` int(10) unsigned NOT NULL DEFAULT 0,
  `parent` int(10) unsigned NOT NULL DEFAULT 0,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mnemo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `behaviour` enum('link','folder') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `section_id` int(10) unsigned DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `off` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menuitems_access_group_id_node_mode_level_parent_unique` (`access_group_id`,`node`,`mode`,`level`,`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuitems`
--

LOCK TABLES `menuitems` WRITE;
/*!40000 ALTER TABLE `menuitems` DISABLE KEYS */;
INSERT INTO `menuitems` VALUES (1,0,1,1,0,0,1,'main','home','/','link',1,1,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(2,0,2,2,0,0,2,'main','activity','/activity','link',2,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(3,0,3,3,0,0,3,'main','architecture','/architecture','link',3,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(4,0,4,4,0,0,4,'main','archeology','/archeology','link',4,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(5,0,5,5,0,0,5,'main','contacts','/contacts','link',5,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(6,0,6,6,0,0,6,'extra','anticorruption','/anticorruption','link',6,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(7,0,7,7,0,0,7,'extra','about','/about','link',7,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(8,0,8,8,0,0,8,'extra','news','/news','link',8,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(9,0,9,9,0,0,9,'collections','photos','/photos','link',9,1,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(10,0,10,10,0,0,10,'collections','videos','/videos','link',10,1,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(11,0,11,11,0,0,11,'search','search','/search','link',11,1,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(12,0,2,1,1,2,1,'submenu','documents','/documents','link',12,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(13,0,2,2,1,2,2,'submenu','publications','/publications','link',13,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(14,0,2,3,1,2,3,'submenu','history','/history','link',14,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(15,0,3,1,1,3,1,'submenu','buildings','/buildings','link',15,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(16,0,3,2,1,3,2,'submenu','restoration','/restoration','link',16,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(17,0,3,3,1,3,3,'submenu','temples','/temples','link',17,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(18,0,4,1,1,4,1,'submenu','archeodept','/archeodept','link',18,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(19,0,4,2,1,4,2,'submenu','researchist','/researchist','link',19,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(50,1,1,1,0,0,1,'main','collections','getSubmenu(1, 1, 1, 1, 50, this)','folder',NULL,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(51,1,1,1,1,50,1,'images','images','/cms/images','link',51,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(52,1,1,2,1,50,2,'videos','videos','/cms/videos','link',52,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(53,1,1,3,1,50,3,'banners','banners','/cms/banners','link',53,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(60,1,2,1,0,0,2,'main','topics','getSubmenu(1, 2, 1, 1, 60, this)','folder',NULL,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(61,1,2,1,1,60,1,'news','news','/cms/news','link',61,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(70,1,3,1,0,0,3,'main','references','getSubmenu(1, 3, 1, 1, 70, this)','folder',NULL,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(71,1,3,1,1,70,1,'locations','locations','/cms/locations','link',71,0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33');
/*!40000 ALTER TABLE `menuitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (10,'2014_10_12_000000_create_users_table',1),(11,'2014_10_12_100000_create_password_resets_table',1),(12,'2019_08_19_000000_create_failed_jobs_table',1),(13,'2021_06_21_095902_create_sections_table',1),(14,'2021_06_21_101958_create_menuitems_table',1),(15,'2021_07_04_213019_create_events_table',1),(16,'2021_07_07_113942_create_firewalls_table',1),(17,'2021_07_23_143424_create_images_table',1),(18,'2021_10_06_143437_create_locations_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bip` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gen_view` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `off` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sections_name_bip_unique` (`name`,`bip`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,'home','templates.guest.default','default','templates.guest.homepage',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(8,1,'news','templates.guest.news','newspage','templates.guest.newspage',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(51,16777215,'images','templates.cms.default','cms.collections','templates.cms.images',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(52,16777215,'videos','templates.cms.default','cms.collections','templates.cms.videos',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(53,16777215,'banners','templates.cms.default','cms.collections','templates.cms.banners',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(61,16777215,'news','templates.cms.default','cms.desktop','templates.cms.news',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33'),(71,16777215,'locations','templates.cms.default','cms.references','templates.cms.locations',0,0,'2021-11-12 05:46:33','2021-11-12 05:46:33');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `passhash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkhash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bip` int(10) unsigned NOT NULL DEFAULT 0,
  `userdir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tries` tinyint(3) unsigned NOT NULL DEFAULT 3,
  `locked_till` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `status` enum('frozen','valid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'frozen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_checkhash_unique` (`checkhash`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Merry Roger','merry_roger@yahoo.com','5b5fd82b0de5e6c3b8b438b5957908fd','60fce956f0544bf27c12d2110b3f541d',16777215,'users/60fce956f0544bf27c12d2110b3f541d',3,'2000-01-01 00:00:00','valid','2021-11-12 05:46:32','2021-11-12 05:46:32',NULL);
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

-- Dump completed on 2021-11-17 11:25:46
