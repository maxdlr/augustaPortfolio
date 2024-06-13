-- MariaDB dump 10.19  Distrib 10.6.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: AUGUSTAPORTFOLIO
-- ------------------------------------------------------
-- Server version	10.6.16-MariaDB-0ubuntu0.22.04.1

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
-- Table structure for table `cvitem`
--

DROP TABLE IF EXISTS `cvitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cvitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label_link` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `created_on` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cvitem`
--

LOCK TABLES `cvitem` WRITE;
/*!40000 ALTER TABLE `cvitem` DISABLE KEYS */;
INSERT INTO `cvitem` VALUES (1,'illum pariatur qui','qui','http://www.greenholt.org/non-est-et-aut-autem-ut-nam-totam-eos.html','Iste est quisquam sed aut. Sit ut sapiente exercitationem magni culpa.','2024-06-13 19:42:03','INTERVENTION'),(2,'ut est perferendis','id','http://pollich.com/ab-vel-odit-beatae-excepturi-tempora-et','Dolor occaecati et odio repellat omnis cupiditate. Iure ut sed dolorum quae libero id. Similique ullam fuga molestiae eum quisquam porro.','2024-06-13 19:42:03','SKILL'),(3,'eum rerum dolor','ut','https://mayert.com/voluptatem-voluptatum-molestiae-ipsam-cumque-minus-ducimus.html','Et dolores ratione ut eum. Aut voluptatem voluptate quo repellat. Unde vero aliquam quia voluptatibus.','2024-06-13 19:42:03','SKILL'),(4,'occaecati qui possimus','omnis','https://larkin.com/nisi-fuga-ducimus-ad-voluptatibus-occaecati-et.html','Qui in voluptates voluptas illum sint facere. Enim cumque architecto veritatis mollitia et. Iusto cupiditate sunt excepturi quis accusantium dolor est.','2024-06-13 19:42:03','INTERVENTION'),(5,'optio pariatur ad','accusantium','http://www.orn.info/','Unde eos omnis eos ipsa. A quos aut laudantium alias sequi. Commodi aut ut et omnis occaecati praesentium nihil quasi.','2024-06-13 19:42:03','EXPERIENCE'),(6,'architecto possimus autem','cumque','https://www.green.info/ut-quibusdam-quia-impedit-tempore-ut-sit-dolorem','Odio voluptatem ea quos necessitatibus velit. Minima vero eos reiciendis autem ut iste.','2024-06-13 19:42:03','SKILL'),(7,'id dicta et','laboriosam','http://denesik.com/magni-dolorem-quibusdam-quis-quo','Odio necessitatibus animi in sequi dolorum corrupti totam. Nemo et voluptatem delectus officia ut.','2024-06-13 19:42:03','INTERVENTION'),(8,'rerum repellat vero','est','http://www.reichert.net/dolor-veritatis-blanditiis-vitae-quos-cupiditate-ratione-enim-architecto','Harum esse maxime sed quaerat. Vitae facilis commodi cum consequatur.','2024-06-13 19:42:03','SKILL'),(9,'eligendi quas aperiam','non','https://www.hahn.com/at-illo-ut-id-consectetur-dicta-magni-corrupti','Mollitia dolor necessitatibus et ducimus. Magnam suscipit ipsum modi ipsum qui molestiae voluptates fugiat.','2024-06-13 19:42:03','INTERVENTION'),(10,'dolor sit accusantium','dolorem','http://www.hansen.net/','Eos sint repudiandae ut. Nisi eveniet et quia accusamus quidem.','2024-06-13 19:42:03','SKILL');
/*!40000 ALTER TABLE `cvitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240522094606','2024-06-13 19:42:02',26),('DoctrineMigrations\\Version20240522132920','2024-06-13 19:42:02',33),('DoctrineMigrations\\Version20240527185521','2024-06-13 19:42:02',21),('DoctrineMigrations\\Version20240528114519','2024-06-13 19:42:02',33),('DoctrineMigrations\\Version20240529120212','2024-06-13 19:42:02',36),('DoctrineMigrations\\Version20240607191619','2024-06-13 19:42:02',33),('DoctrineMigrations\\Version20240612110144','2024-06-13 19:42:02',85),('DoctrineMigrations\\Version20240612193429','2024-06-13 19:42:02',21);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_path` varchar(255) NOT NULL,
  `media_size` double NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'showreel_thumbnail/showreel-thumbnail.jpeg',97685,'2024-06-13 19:42:03',NULL,'SHOWREEL_THUMBNAIL'),(2,'motion/04_ancient_GIF_SDtwitter.gif',8938927,'2024-06-13 19:42:03',NULL,'MOTION'),(3,'motion/07_dizzy_nft_sd.gif',1584734,'2024-06-13 19:42:03',NULL,'MOTION'),(4,'motion/07_fancy_nft_low.gif',4184511,'2024-06-13 19:42:03',NULL,'MOTION'),(5,'motion/12_microscopic_insta_1.gif',19667423,'2024-06-13 19:42:03',NULL,'MOTION'),(6,'motion/12_slice.gif',11207867,'2024-06-13 19:42:03',NULL,'MOTION'),(7,'motion/14_shield_dribbble_XLOW2.gif',11264660,'2024-06-13 19:42:03',NULL,'MOTION'),(8,'motion/18_cat_1.gif',29163785,'2024-06-13 19:42:03',NULL,'MOTION'),(9,'motion/2024_.gif',18576742,'2024-06-13 19:42:03',NULL,'MOTION'),(10,'motion/20_trick_hd_notitle.gif',16714376,'2024-06-13 19:42:03',NULL,'MOTION'),(11,'motion/26_space_HD_notitle.gif',65189305,'2024-06-13 19:42:03',NULL,'MOTION'),(12,'motion/30_pull_HD_notitle.gif',24051242,'2024-06-13 19:42:03',NULL,'MOTION'),(13,'motion/31_crawl_nft_low.gif',4018762,'2024-06-13 19:42:03',NULL,'MOTION'),(14,'motion/Dirbbble_stand_1_1.gif',3660162,'2024-06-13 19:42:03',NULL,'MOTION'),(15,'motion/Overthinking_gif.gif',16773284,'2024-06-13 19:42:03',NULL,'MOTION'),(16,'motion/Ski_site.gif',10078945,'2024-06-13 19:42:03',NULL,'MOTION'),(17,'motion/blade_nft_sd.gif',2292374,'2024-06-13 19:42:03',NULL,'MOTION'),(18,'motion/hallucination.gif',54393408,'2024-06-13 19:42:03',NULL,'MOTION'),(19,'motion/monster_dribbble1 (3).gif',4654406,'2024-06-13 19:42:03',NULL,'MOTION'),(20,'motion/penche.gif',25989388,'2024-06-13 19:42:03',NULL,'MOTION'),(21,'motion/torche.gif',27665620,'2024-06-13 19:42:03',NULL,'MOTION'),(22,'illustration/abstract_vdf.jpg',919955,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(23,'illustration/abstracts_bottle.jpg',686270,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(24,'illustration/accompagner.jpg',426478,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(25,'illustration/alll_competences.jpg',486944,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(26,'illustration/caviste.jpg',524641,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(27,'illustration/checkbox.jpg',622992,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(28,'illustration/circles.jpg',483764,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(29,'illustration/consultation.jpg',461946,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(30,'illustration/dionysos.jpg',481912,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(31,'illustration/formation.jpg',476351,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(32,'illustration/grandsvinscreatifs.jpg',806138,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(33,'illustration/jeunes_recherches.jpg',421408,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(34,'illustration/motsduvins.jpg',539610,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(35,'illustration/plante_1.jpg',868353,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(36,'illustration/plante_2.jpg',949105,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(37,'illustration/plante_3.jpg',896694,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(38,'illustration/plante_4.jpg',916855,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(39,'illustration/plante_5.jpg',892245,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(40,'illustration/plante_6.jpg',872319,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(41,'illustration/plante_7.jpg',833217,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(42,'illustration/plante_8.jpg',951495,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(43,'illustration/plante_9.jpg',871157,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(44,'illustration/reunion.jpg',484806,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(45,'illustration/rose_mule.jpg',924845,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(46,'illustration/sauvignon.jpg',1023863,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(47,'illustration/titre_vdf.jpg',864251,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(48,'illustration/verre_closeup.jpg',432287,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(49,'illustration/verres.jpg',674235,'2024-06-13 19:42:03',NULL,'ILLUSTRATION'),(50,'meuf/meuf.gif',17769238,'2024-06-13 19:42:03',NULL,'MEUF'),(51,'contact/plante_1.jpg',868353,'2024-06-13 19:42:03',NULL,'CONTACT'),(52,'contact/plante_2.jpg',949105,'2024-06-13 19:42:03',NULL,'CONTACT'),(53,'contact/plante_3.jpg',896694,'2024-06-13 19:42:03',NULL,'CONTACT'),(54,'823390186',0,'2024-06-13 19:42:03',NULL,'SHOWREEL_VIDEO'),(55,'cursor/arrow-left-cursor.webp',4096,'2024-06-13 19:42:03',NULL,'CURSOR'),(56,'cursor/arrow-right-cursor.webp',4064,'2024-06-13 19:42:03',NULL,'CURSOR'),(57,'cursor/eye-cursor.webp',4454,'2024-06-13 19:42:03',NULL,'CURSOR'),(58,'cursor/pointer.webp',5532,'2024-06-13 19:42:03',NULL,'CURSOR');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_item`
--

DROP TABLE IF EXISTS `social_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_item`
--

LOCK TABLES `social_item` WRITE;
/*!40000 ALTER TABLE `social_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'augusta@qimono.tv','[\"ROLE_ADMIN\"]','$2y$13$4J19GRxxUQbEi8AQDwCrt.yMGXaPJhWu/jDrmxTV9ghKS4kmWinBi');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_config`
--

DROP TABLE IF EXISTS `website_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_img_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_460FCB5745FE87B9` (`seo_img_id`),
  CONSTRAINT `FK_460FCB5745FE87B9` FOREIGN KEY (`seo_img_id`) REFERENCES `media` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_config`
--

LOCK TABLES `website_config` WRITE;
/*!40000 ALTER TABLE `website_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `website_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-13 21:42:31
