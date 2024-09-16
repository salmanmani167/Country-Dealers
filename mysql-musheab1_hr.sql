

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
DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `agencies` WRITE;
/*!40000 ALTER TABLE `agencies` DISABLE KEYS */;
INSERT INTO `agencies` VALUES (1,'First Agency','John Doe','233542441933','146 Jose Gardens\nNew Hardyfurt, KY 50551-0458.','2024-03-02 11:33:02','2024-03-02 11:33:02'),(2,'Cale Huels','Gerhard Vandervort','331.815.5283','787 Metz Causeway','2024-03-02 11:35:13','2024-03-02 11:35:13'),(3,'Myah Boyle','Ramiro Stehr DVM','+17702606204','604 Price Spurs Suite 758','2024-03-02 11:35:13','2024-03-02 11:35:13'),(4,'David Dietrich DVM','Lea Kulas','323-333-9456','55846 Miller Estates Suite 257','2024-03-02 11:35:13','2024-03-02 11:35:13'),(5,'Prof. Jett Keebler','Evalyn Douglas','1-484-960-0931','391 Ariane Dam Suite 513','2024-03-02 11:35:13','2024-03-02 11:35:13'),(6,'Rosetta DuBuque','Prof. Destini Swaniawski','+1-440-603-9174','54991 Abdul Plain Suite 767','2024-03-02 11:35:13','2024-03-02 11:35:13');
/*!40000 ALTER TABLE `agencies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_user_id_foreign` (`user_id`),
  CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ast_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_from` varchar(255) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `ast_condition` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `cost` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_user_id_foreign` (`user_id`),
  CONSTRAINT `assets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `checkin` time NOT NULL DEFAULT '22:56:28',
  `checkout` time DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_employee_id_foreign` (`employee_id`),
  CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clt_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_user_id_foreign` (`user_id`),
  KEY `clients_employee_id_foreign` (`employee_id`),
  CONSTRAINT `clients_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'CLT-000001',26,'Mushe','2024-04-06 19:59:51','2024-04-06 19:59:51',2);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'IT','2024-03-02 10:47:00','2024-03-02 10:47:00'),(2,'Management','2024-03-02 10:47:27','2024-03-02 10:47:27'),(3,'Accounts','2024-03-02 10:47:42','2024-03-02 10:47:42'),(4,'Security','2024-03-02 10:47:56','2024-03-02 10:47:56');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `designations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designations_department_id_foreign` (`department_id`),
  CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `designations` WRITE;
/*!40000 ALTER TABLE `designations` DISABLE KEYS */;
INSERT INTO `designations` VALUES (1,'Software Developer',1,'2024-03-02 10:48:28','2024-03-02 10:48:28'),(2,'UI Designer',1,'2024-03-02 10:48:49','2024-03-02 10:48:49'),(3,'Business Manager',3,'2024-03-02 10:49:12','2024-03-02 10:49:12');
/*!40000 ALTER TABLE `designations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) DEFAULT NULL,
  `ssn_id` varchar(255) DEFAULT NULL,
  `marital_stat` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `passport_no` varchar(255) DEFAULT NULL,
  `passport_expiry_date` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `spouse_employement` varchar(255) DEFAULT NULL,
  `no_of_children` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `designation_id` bigint(20) unsigned DEFAULT NULL,
  `agency_id` bigint(20) unsigned DEFAULT NULL,
  `house_id` bigint(20) unsigned DEFAULT NULL,
  `education` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`education`)),
  `experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`experience`)),
  `emergency_contacts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`emergency_contacts`)),
  `work_availability` varchar(255) DEFAULT NULL,
  `work_days` varchar(255) DEFAULT NULL,
  `work_transportation` varchar(255) DEFAULT NULL,
  `have_driver_license` tinyint(1) DEFAULT NULL,
  `driver_license_no` varchar(255) DEFAULT NULL,
  `work_restrictions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`work_restrictions`)),
  `date_joined` date DEFAULT '2024-02-26',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bank_information`)),
  `family_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`family_information`)),
  PRIMARY KEY (`id`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_department_id_foreign` (`department_id`),
  KEY `employees_designation_id_foreign` (`designation_id`),
  KEY `employees_agency_id_foreign` (`agency_id`),
  KEY `employees_house_id_foreign` (`house_id`),
  CONSTRAINT `employees_agency_id_foreign` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'EMP-000001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,1,2,1,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-02','2024-03-02 11:41:42','2024-03-02 11:41:42',NULL,NULL),(2,'EMP-000002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,1,1,2,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-02','2024-03-02 11:42:55','2024-03-02 11:42:55',NULL,NULL),(3,'EMP-000003',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,1,1,6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1984-01-09','2024-03-02 12:01:25','2024-03-02 12:01:25',NULL,NULL),(4,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,16,1,1,3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1979-07-11','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(5,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,3,3,4,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1991-05-06','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(6,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,3,3,5,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1977-06-26','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(7,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,1,1,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-12-23','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(8,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,1,2,2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1971-11-05','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(9,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,1,2,3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-10-06','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(10,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,1,1,3,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2013-09-13','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(11,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,23,3,3,2,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-07-28','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL),(12,'EMP-000004',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,24,1,1,5,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1996-04-22','2024-03-02 12:10:23','2024-03-02 12:10:23',NULL,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_` date NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'General Management Meeting','2024-03-01','Primary','2024-03-02 10:45:10','2024-03-02 10:45:10'),(2,'Staff Metting','2024-03-10','Purple','2024-03-02 10:45:35','2024-03-02 10:45:35'),(3,'Zoom Metting','2024-03-27','Teal','2024-03-02 10:46:04','2024-03-02 10:46:04'),(4,'Zoom Metting','2024-04-10','Pink','2024-04-10 19:38:51','2024-04-10 19:38:51'),(5,'Test1','2024-04-29','Primary','2024-04-10 19:39:08','2024-04-10 19:39:08'),(6,'Staff Metting','2024-05-08','Inverse','2024-04-10 19:39:29','2024-04-10 19:39:29'),(7,'Christmas','2024-12-25','Brown','2024-04-10 19:39:58','2024-04-10 19:39:58');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `purchased_from` varchar(255) DEFAULT NULL,
  `purchased_date` varchar(255) DEFAULT '2024-02-26',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'First item','MusheCode','2023-05-11',5,'Cash','200',NULL,'Approved','2024-04-10 19:23:09','2024-04-10 19:23:09'),(2,'Second item','MusheCode LTD','2023-05-11',7,'Cheque','250',NULL,'Approved','2024-04-10 19:23:33','2024-04-10 19:23:33'),(3,'Cameron Herrera','Culpa est sapiente s','1989-10-08',16,'Cheque','937','WhatsApp Image 2024-06-28 at 4.14.40 AM.jpeg','Approved','2024-06-29 14:09:40','2024-06-29 14:09:40');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `feature` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `features_feature_unique` (`feature`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `features` WRITE;
/*!40000 ALTER TABLE `features` DISABLE KEYS */;
INSERT INTO `features` VALUES (1,NULL,'apps',NULL,'2024-02-26 22:56:29'),(2,NULL,'calendar',NULL,'2024-02-26 22:56:29'),(3,NULL,'filemanager',NULL,'2024-02-26 22:56:29'),(4,NULL,'company',NULL,'2024-02-26 22:56:29'),(5,NULL,'employees',NULL,'2024-02-26 22:56:29'),(6,NULL,'attendance',NULL,'2024-02-26 22:56:29'),(7,NULL,'holidays',NULL,'2024-02-26 22:56:29'),(8,NULL,'vacations',NULL,'2024-02-26 22:56:29'),(9,NULL,'timesheet',NULL,'2024-02-26 22:56:29'),(10,NULL,'overtime',NULL,'2024-02-26 22:56:29'),(11,NULL,'shifts',NULL,'2024-02-26 22:56:29'),(12,NULL,'clients',NULL,'2024-02-26 22:56:29'),(13,NULL,'projects',NULL,'2024-02-26 22:56:29'),(14,NULL,'leads',NULL,'2024-02-26 22:56:29'),(15,NULL,'tickets',NULL,'2024-02-26 22:56:29'),(16,NULL,'accounts',NULL,'2024-02-26 22:56:29'),(17,NULL,'invoices',NULL,'2024-02-26 22:56:29'),(18,NULL,'expenses',NULL,'2024-02-26 22:56:29'),(19,NULL,'provident-fund',NULL,'2024-02-26 22:56:29'),(20,NULL,'taxes',NULL,'2024-02-26 22:56:29'),(21,NULL,'products',NULL,'2024-02-26 22:56:29'),(22,NULL,'sales',NULL,'2024-02-26 22:56:29'),(23,NULL,'policies',NULL,'2024-02-26 22:56:29'),(24,NULL,'jobs',NULL,'2024-02-26 22:56:29'),(25,NULL,'reports',NULL,'2024-02-26 22:56:29'),(26,NULL,'goals',NULL,'2024-02-26 22:56:29'),(27,NULL,'assets',NULL,'2024-02-26 22:56:29'),(28,NULL,'announcement',NULL,'2024-02-26 22:56:29'),(29,NULL,'backups',NULL,'2024-02-26 22:56:29');
/*!40000 ALTER TABLE `features` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `goal_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `goal_types` WRITE;
/*!40000 ALTER TABLE `goal_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_types` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `goal_type_id` bigint(20) unsigned DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `progress` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `goals` WRITE;
/*!40000 ALTER TABLE `goals` DISABLE KEYS */;
/*!40000 ALTER TABLE `goals` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,'Christmas','2023-12-25',0,'2024-03-02 11:28:10','2024-03-02 11:28:10');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `houses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `houses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `cordinator_id` bigint(20) unsigned DEFAULT NULL,
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `houses_cordinator_id_foreign` (`cordinator_id`),
  KEY `houses_manager_id_foreign` (`manager_id`),
  KEY `houses_client_id_foreign` (`client_id`),
  CONSTRAINT `houses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `houses_cordinator_id_foreign` FOREIGN KEY (`cordinator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `houses_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `houses` WRITE;
/*!40000 ALTER TABLE `houses` DISABLE KEYS */;
INSERT INTO `houses` VALUES (1,'439204232','2024-03-02 11:32:01','2024-03-02 11:32:01','146 Jose Gardens\nNew Hardyfurt, KY 50551-0458.','02233',1,1,NULL),(2,'2026198903','2024-03-02 11:39:56','2024-03-02 11:39:56','66654 Darlene Views Apt. 192\nNorth Abnerberg, TX 62765','BJ',7,9,NULL),(3,'1266088428','2024-03-02 11:39:56','2024-03-02 11:39:56','15117 Bartoletti Village\nLake Tomasa, TN 61609-8736','IR',9,10,NULL),(4,'1006909782','2024-03-02 11:39:56','2024-03-02 11:39:56','4890 Strosin Crossroad Apt. 189\nJacquelynburgh, AL 83314-4446','ET',7,4,NULL),(5,'1689484768','2024-03-02 11:39:56','2024-03-02 11:39:56','54259 Cindy Ferry Apt. 340\nBoyleton, IL 28608-3310','UM',7,1,NULL),(6,'964588043','2024-03-02 11:39:56','2024-03-02 11:39:56','65497 Gerda Squares Apt. 302\nBraunchester, MD 10510','VI',2,2,NULL),(7,'309220956','2024-03-02 11:39:56','2024-03-02 11:39:56','331 Luettgen Common Apt. 048\nChristaport, WI 06934','FK',4,6,NULL),(8,'1019598867','2024-03-02 11:39:56','2024-03-02 11:39:56','6435 Sanford Station\nGretahaven, MN 23129-4834','FI',4,10,NULL),(9,'256060701','2024-03-02 11:39:56','2024-03-02 11:39:56','31982 Monahan Pike\nHattieberg, CO 88020-5627','PK',1,11,NULL),(10,'1626367653','2024-03-02 11:39:56','2024-03-02 11:39:56','20245 Marguerite Heights\nWest Maxineton, LA 82864','KE',12,7,NULL),(11,'75127983','2024-03-02 11:39:56','2024-03-02 11:39:56','8283 Adela Mission Apt. 731\nAmericoside, WY 56370-5052','PF',9,1,NULL);
/*!40000 ALTER TABLE `houses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inv_id` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `tax_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `note` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_project_id_foreign` (`project_id`),
  KEY `invoices_tax_id_foreign` (`tax_id`),
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_applicants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_applicants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_applicants_job_id_foreign` (`job_id`),
  CONSTRAINT `job_applicants_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_applicants` WRITE;
/*!40000 ALTER TABLE `job_applicants` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_applicants` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `vacancies` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `salary_from` varchar(255) DEFAULT NULL,
  `salary_to` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `description` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_department_id_foreign` (`department_id`),
  CONSTRAINT `jobs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` VALUES (1,'Maternity Leave','60','2024-03-02 11:28:45','2024-03-02 11:28:45');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `leave_type_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `starts_on` date NOT NULL,
  `ends_on` date NOT NULL,
  `days` int(11) NOT NULL,
  `reason` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remaning_leaves` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaves_leave_type_id_foreign` (`leave_type_id`),
  KEY `leaves_employee_id_foreign` (`employee_id`),
  CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `leaves` WRITE;
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2021_05_27_182017_create_holidays_table',1),(6,'2021_06_01_014651_create_leave_types_table',1),(7,'2021_07_19_194902_create_goal_types_table',1),(8,'2021_07_19_202741_create_goals_table',1),(9,'2022_04_14_083707_create_settings_table',1),(10,'2022_05_01_033105_create_company_settings',1),(11,'2022_05_01_053041_create_theme_settings',1),(12,'2022_05_01_054943_create_invoice_settings',1),(13,'2022_05_01_061804_create_attendance_settings',1),(14,'2023_07_15_171025_create_departments_table',1),(15,'2023_07_16_041837_create_designations_table',1),(16,'2023_07_17_011843_create_houses_table',1),(17,'2023_07_17_230535_create_jobs_table',1),(18,'2023_07_17_235505_create_job_applicants_table',1),(19,'2023_07_19_143422_create_policies_table',1),(20,'2023_07_21_174456_create_agencies_table',1),(21,'2023_07_25_221329_create_employees_table',1),(22,'2023_07_25_224923_add_new_columns_to_houses_table',1),(23,'2023_07_27_190632_create_leaves_table',1),(24,'2023_07_27_224401_create_events_table',1),(25,'2023_07_28_014329_create_clients_table',1),(26,'2023_07_28_134000_create_projects_table',1),(27,'2023_07_28_134011_create_project_teams_table',1),(28,'2023_07_29_042216_add_bank_and_family_info_to_employees_table',1),(29,'2023_07_29_120307_create_permission_tables',1),(30,'2023_08_05_150951_create_attendances_table',1),(31,'2023_08_12_184124_create_overtimes_table',1),(32,'2023_08_12_200312_create_timesheets_table',1),(33,'2023_08_12_202518_create_shifts_table',1),(34,'2023_08_15_022541_create_shift_schedules_table',1),(35,'2023_08_15_210715_create_tickets_table',1),(36,'2023_08_21_010916_create_taxes_table',1),(37,'2023_08_21_013919_create_provident_funds_table',1),(38,'2023_08_21_024115_create_expenses_table',1),(39,'2023_08_21_231801_create_invoices_table',1),(40,'2023_08_24_224623_create_assets_table',1),(41,'2023_08_25_015400_add_client_id_to_houses_table',1),(42,'2023_08_25_021217_add_employee_id_to_clients_table',1),(43,'2023_08_29_061939_create_announcements_table',1),(44,'2024_01_03_071602_create_products_table',1),(45,'2024_01_03_071620_create_sales_table',1),(46,'2024_01_03_071834_create_sale_products_table',1),(47,'2024_01_20_012415_create_notifications_table',1),(48,'2024_01_20_021251_create_features_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `overtimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `overtimes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `overtime_date` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `overtimes_employee_id_foreign` (`employee_id`),
  CONSTRAINT `overtimes_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `overtimes` WRITE;
/*!40000 ALTER TABLE `overtimes` DISABLE KEYS */;
/*!40000 ALTER TABLE `overtimes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view-backups','backups','web',NULL,NULL),(2,'create-backup','backups','web',NULL,NULL),(3,'download-backup','backups','web',NULL,NULL),(4,'delete-backup','backups','web',NULL,NULL),(5,'view-users','users','web',NULL,NULL),(6,'create-user','users','web',NULL,NULL),(7,'edit-user','users','web',NULL,NULL),(8,'delete-user','users','web',NULL,NULL),(9,'view-roles','roles','web',NULL,NULL),(10,'create-role','roles','web',NULL,NULL),(11,'edit-role','roles','web',NULL,NULL),(12,'delete-role','roles','web',NULL,NULL),(13,'view-permissions','permissions','web',NULL,NULL),(14,'create-permission','permissions','web',NULL,NULL),(15,'edit-permission','permissions','web',NULL,NULL),(16,'delete-permission','permissions','web',NULL,NULL),(17,'view-settings','settings','web',NULL,NULL),(18,'impersonate-users','impersonate','web',NULL,NULL),(19,'impersonate-clients','impersonate','web',NULL,NULL),(20,'impersonate-employees','impersonate','web',NULL,NULL),(21,'view-logs','logs','web',NULL,NULL),(22,'view-calendar','calendar','web',NULL,NULL),(23,'view-clients','clients','web',NULL,NULL),(24,'create-client','clients','web',NULL,NULL),(25,'edit-client','clients','web',NULL,NULL),(26,'delete-client','clients','web',NULL,NULL),(27,'view-projects','projects','web',NULL,NULL),(28,'create-project','projects','web',NULL,NULL),(29,'edit-project','projects','web',NULL,NULL),(30,'delete-project','projects','web',NULL,NULL),(31,'view-policies','policies','web',NULL,NULL),(32,'create-policy','policies','web',NULL,NULL),(33,'edit-policy','policies','web',NULL,NULL),(34,'delete-policy','policies','web',NULL,NULL),(35,'view-employees','employees','web',NULL,NULL),(36,'create-employee','employees','web',NULL,NULL),(37,'edit-employee','employees','web',NULL,NULL),(38,'delete-employee','employees','web',NULL,NULL),(39,'view-departments','departments','web',NULL,NULL),(40,'create-department','departments','web',NULL,NULL),(41,'edit-department','departments','web',NULL,NULL),(42,'delete-department','departments','web',NULL,NULL),(43,'view-designations','designations','web',NULL,NULL),(44,'create-designation','designations','web',NULL,NULL),(45,'edit-designation','designations','web',NULL,NULL),(46,'delete-designation','designations','web',NULL,NULL),(47,'view-holidays','holidays','web',NULL,NULL),(48,'create-holiday','holidays','web',NULL,NULL),(49,'edit-holiday','holidays','web',NULL,NULL),(50,'delete-holiday','holidays','web',NULL,NULL),(51,'view-vacationType','vacation Types','web',NULL,NULL),(52,'create-vacationType','vacation Types','web',NULL,NULL),(53,'edit-vacationType','vacation Types','web',NULL,NULL),(54,'delete-vacationType','vacation Types','web',NULL,NULL),(55,'view-vacations','vacations','web',NULL,NULL),(56,'create-vacation','vacations','web',NULL,NULL),(57,'edit-vacation','vacations','web',NULL,NULL),(58,'delete-vacation','vacations','web',NULL,NULL),(59,'view-houses','houses','web',NULL,NULL),(60,'create-house','houses','web',NULL,NULL),(61,'edit-house','houses','web',NULL,NULL),(62,'delete-house','houses','web',NULL,NULL),(63,'view-agencies','agencies','web',NULL,NULL),(64,'create-agency','agencies','web',NULL,NULL),(65,'edit-agency','agencies','web',NULL,NULL),(66,'delete-agency','agencies','web',NULL,NULL),(67,'view-timesheets','timesheets','web',NULL,NULL),(68,'create-timesheet','timesheets','web',NULL,NULL),(69,'edit-timesheet','timesheets','web',NULL,NULL),(70,'delete-timesheet','timesheets','web',NULL,NULL),(71,'view-shifts','shift','web',NULL,NULL),(72,'create-shift','shift','web',NULL,NULL),(73,'edit-shift','shift','web',NULL,NULL),(74,'delete-shift','shift','web',NULL,NULL),(75,'view-shiftSchedules','shiftSchedule','web',NULL,NULL),(76,'create-shiftSchedule','shiftSchedule','web',NULL,NULL),(77,'edit-shiftSchedule','shiftSchedule','web',NULL,NULL),(78,'delete-shiftSchedule','shiftSchedule','web',NULL,NULL),(79,'view-overtimes','overtime','web',NULL,NULL),(80,'create-overtime','overtime','web',NULL,NULL),(81,'edit-overtime','overtime','web',NULL,NULL),(82,'delete-overtime','overtime','web',NULL,NULL),(83,'view-goals','goals','web',NULL,NULL),(84,'create-goal','goals','web',NULL,NULL),(85,'edit-goal','goals','web',NULL,NULL),(86,'delete-goal','goals','web',NULL,NULL),(87,'view-goalTypes','goalTypes','web',NULL,NULL),(88,'create-goalType','goalTypes','web',NULL,NULL),(89,'edit-goalType','goalTypes','web',NULL,NULL),(90,'delete-goalType','goalTypes','web',NULL,NULL),(91,'view-assets','assets','web',NULL,NULL),(92,'create-asset','assets','web',NULL,NULL),(93,'edit-asset','assets','web',NULL,NULL),(94,'delete-asset','assets','web',NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `policies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `policies_department_id_foreign` (`department_id`),
  CONSTRAINT `policies_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `policies` WRITE;
/*!40000 ALTER TABLE `policies` DISABLE KEYS */;
INSERT INTO `policies` VALUES (1,'illo','I don\'t remember where.\' \'Well, it must make me larger, it must make me larger, it must make me grow larger, I can listen all day to day.\' This was quite pleased to have any pepper in that case I.',3,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(2,'cum','Alice indignantly. \'Ah! then yours wasn\'t a really good school,\' said the Cat. \'Do you take me for asking! No, it\'ll never do to come before that!\' \'Call the first verse,\' said the Rabbit just under.',2,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(3,'vel','And yet I don\'t want to be?\' it asked. \'Oh, I\'m not the right way of expressing yourself.\' The baby grunted again, and the pair of white kid gloves and the Hatter went on, taking first one side and.',3,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(4,'necessitatibus','Hatter. \'I deny it!\' said the Mock Turtle; \'but it doesn\'t understand English,\' thought Alice; \'I might as well as she could do, lying down with her friend. When she got back to the end: then stop.\'.',1,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(5,'aut','Pigeon; \'but I know I have to ask them what the next witness!\' said the Hatter: \'I\'m on the second time round, she came suddenly upon an open place, with a little anxiously. \'Yes,\' said Alice.',4,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(6,'ducimus','She had quite forgotten the words.\' So they went up to the other, trying every door, she walked sadly down the bottle, she found to be done, I wonder?\' Alice guessed in a whisper, half afraid that.',3,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(7,'ea','The cook threw a frying-pan after her as she went on growing, and very angrily. \'A knot!\' said Alice, rather doubtfully, as she wandered about in the sea, some children digging in the sea, \'and in.',3,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(8,'dolores','King. (The jury all wrote down on their hands and feet at the Gryphon whispered in a sorrowful tone; \'at least there\'s no harm in trying.\' So she set off at once, while all the time at the bottom of.',3,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(9,'culpa','French lesson-book. The Mouse did not notice this question, but hurriedly went on, yawning and rubbing its eyes, for it flashed across her mind that she was walking by the time she had not gone (We.',2,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14'),(10,'ullam','I used to come before that!\' \'Call the next witness.\' And he added in a moment that it might end, you know,\' the Hatter replied. \'Of course they were\', said the Cat. \'--so long as I used--and I.',4,'https://example.com/files/document1.pdf','2024-03-02 11:39:14','2024-03-02 11:39:14');
/*!40000 ALTER TABLE `policies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `product_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_sale` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `product_sale` WRITE;
/*!40000 ALTER TABLE `product_sale` DISABLE KEYS */;
INSERT INTO `product_sale` VALUES (1,1,1,105,1,'2024-04-10 19:24:06','2024-04-10 19:24:06'),(2,2,1,105,2,'2024-04-10 19:24:13','2024-04-10 19:24:13');
/*!40000 ALTER TABLE `product_sale` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `cost_price` double NOT NULL,
  `retail_price` double NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Prouct 1','MusheCode','2',100,105,'This is the description of the product','2024-04-06 20:07:48','2024-04-06 20:07:48');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `project_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_teams_project_id_foreign` (`project_id`),
  KEY `project_teams_employee_id_foreign` (`employee_id`),
  CONSTRAINT `project_teams_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_teams_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `project_teams` WRITE;
/*!40000 ALTER TABLE `project_teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_teams` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `starts_on` date NOT NULL,
  `ends_on` date NOT NULL,
  `rate` double NOT NULL,
  `rate_type` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `leader_id` bigint(20) unsigned DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`files`)),
  `deadline` date DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_client_id_foreign` (`client_id`),
  KEY `projects_leader_id_foreign` (`leader_id`),
  KEY `projects_added_by_foreign` (`added_by`),
  CONSTRAINT `projects_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_leader_id_foreign` FOREIGN KEY (`leader_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `provident_funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provident_funds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `employee_share_amount` varchar(255) DEFAULT NULL,
  `org_share_amount` varchar(255) DEFAULT NULL,
  `employee_share_percent` varchar(255) DEFAULT NULL,
  `org_share_percent` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provident_funds_employee_id_foreign` (`employee_id`),
  CONSTRAINT `provident_funds_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `provident_funds` WRITE;
/*!40000 ALTER TABLE `provident_funds` DISABLE KEYS */;
/*!40000 ALTER TABLE `provident_funds` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(71,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2),(90,2),(91,2),(92,2),(93,2),(94,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2024-02-26 22:56:42','2024-02-26 22:56:42'),(2,'Super Admin','web','2024-02-26 22:56:42','2024-02-26 22:56:42');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,105,'2024-04-10 19:24:06','2024-04-10 19:24:06'),(2,210,'2024-04-10 19:24:13','2024-04-10 19:24:13');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_group_name_unique` (`group`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'company','company_name',0,'\"HR Management\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(2,'company','contact_person',0,'\"Mushe Abdul Hakim\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(3,'company','address',0,'\"3864 Quiet Valley Lane, Sherman Oaks, CA, 91403\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(4,'company','country',0,'\"g\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(5,'company','city',0,'\"h\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(6,'company','province',0,'\"California\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(7,'company','postal_code',0,'\"0233\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(8,'company','email',0,'\"testcompany@mail.com\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(9,'company','phone',0,'\"233209229025\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(10,'company','mobile',0,'\"233209229025\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(11,'company','fax',0,'\"818-978-7102\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(12,'company','website_url',0,'\"https:\\/\\/www.example.com\"','2024-02-26 22:56:28','2024-07-08 18:09:31'),(13,'theme','site_name',0,'\"HR Management Software\"','2024-02-26 22:56:28','2024-06-27 06:13:09'),(14,'theme','logo',0,'\"\"','2024-02-26 22:56:28','2024-06-27 06:13:09'),(15,'theme','favicon',0,'\"\"','2024-02-26 22:56:28','2024-06-27 06:13:09'),(16,'theme','currency_symbol',0,'\"$\"','2024-02-26 22:56:28','2024-06-27 06:13:09'),(17,'theme','currency_code',0,'\"USD\"','2024-02-26 22:56:28','2024-06-27 06:13:09'),(18,'invoice','logo',0,'\"\"','2024-02-26 22:56:28','2024-02-26 22:56:28'),(19,'invoice','prefix',0,'\"INV-\"','2024-02-26 22:56:28','2024-02-26 22:56:28'),(20,'attendance','checkin_time',0,'\"05:00\"','2024-02-26 22:56:28','2024-02-26 22:56:28'),(21,'attendance','checkout_time',0,'\"17:00\"','2024-02-26 22:56:28','2024-02-26 22:56:28');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `shift_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shift_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `shift_id` bigint(20) unsigned DEFAULT NULL,
  `date_` date DEFAULT '2024-02-26',
  `accept_extra_hrs` tinyint(1) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `shift_start_time` varchar(255) DEFAULT NULL,
  `shift_end_time` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shift_schedules_employee_id_foreign` (`employee_id`),
  KEY `shift_schedules_shift_id_foreign` (`shift_id`),
  CONSTRAINT `shift_schedules_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shift_schedules_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `shift_schedules` WRITE;
/*!40000 ALTER TABLE `shift_schedules` DISABLE KEYS */;
INSERT INTO `shift_schedules` VALUES (1,1,1,'2024-04-12',0,1,'2024-04-12 07:30:00','2024-04-12 01:30:00','This is for you only',NULL,'2024-04-10 19:58:32','2024-04-10 19:58:32'),(2,3,1,'2024-07-10',0,1,'2024-07-10 07:30:00','2024-07-10 01:30:00',NULL,NULL,'2024-07-10 08:04:01','2024-07-10 08:04:01'),(3,1,1,'2024-07-10',0,1,'2024-07-10 07:30:00','2024-07-10 01:30:00',NULL,NULL,'2024-07-10 11:39:55','2024-07-10 11:39:55');
/*!40000 ALTER TABLE `shift_schedules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `min_start_time` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) NOT NULL,
  `max_start_time` varchar(255) DEFAULT NULL,
  `min_end_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) NOT NULL,
  `max_end_time` varchar(255) DEFAULT NULL,
  `break` time DEFAULT NULL,
  `recurring` tinyint(1) DEFAULT 0,
  `repeat_weeks` int(11) DEFAULT NULL,
  `days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`days`)),
  `ends_on` date DEFAULT NULL,
  `indefinite` tinyint(1) DEFAULT 0,
  `tag` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `shifts` WRITE;
/*!40000 ALTER TABLE `shifts` DISABLE KEYS */;
INSERT INTO `shifts` VALUES (1,'Morning Shift',NULL,'07:30:00',NULL,NULL,'01:30:00',NULL,NULL,1,1,'[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]',NULL,1,'Morning Shift','This is just for morning staff','2024-04-10 19:55:54','2024-04-10 19:55:54');
/*!40000 ALTER TABLE `shifts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
INSERT INTO `taxes` VALUES (1,'VAT','1','active','2024-04-06 20:05:06','2024-04-06 20:05:06');
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tk_id` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `priority` varchar(255) NOT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `followers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`followers`)),
  `description` longtext DEFAULT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`files`)),
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_assigned_to_foreign` (`assigned_to`),
  KEY `tickets_client_id_foreign` (`client_id`),
  KEY `tickets_added_by_foreign` (`added_by`),
  CONSTRAINT `tickets_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'#TKT-00001','This is a test ticket',3,1,'Medium',NULL,'[\"4\"]','This is my description of the problem I have.',NULL,2,NULL,'2024-04-06 20:02:50','2024-04-06 20:02:50');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `timesheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timesheets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `date_` date DEFAULT '2024-02-26',
  `hours` varchar(255) DEFAULT NULL,
  `total_hours` varchar(255) DEFAULT NULL,
  `remaining_hours` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timesheets_employee_id_foreign` (`employee_id`),
  KEY `timesheets_project_id_foreign` (`project_id`),
  CONSTRAINT `timesheets_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `timesheets_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `timesheets` WRITE;
/*!40000 ALTER TABLE `timesheets` DISABLE KEYS */;
/*!40000 ALTER TABLE `timesheets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_client` tinyint(1) DEFAULT 0,
  `is_employee` tinyint(1) DEFAULT 0,
  `is_cordinator` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `gender` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Doe','admin','admin@admin.com','233542441933',0,0,0,NULL,1,'male',NULL,NULL,'Ghana','Accra','0233',NULL,'$2y$10$ztyvv00drf9bmhxtnby1F.i5znf51CC8QDNDli2GsAsk88PNpAXkG',NULL,'2024-02-26 22:56:29','2024-02-26 22:56:29'),(2,'Super','Admin','superadmin','super@admin.com','233542441933',0,0,0,NULL,1,'male','2023-07-30','My address','Ghana','Accra','0233',NULL,'$2y$10$5V3i5g2wP209Koe0ILIwbeYsNBpmmtVrD8YgFOol90qj2YYK8vjkO',NULL,'2024-02-26 22:56:42','2024-02-26 22:56:42'),(3,'Itzel','Cummerata','adams.alisha','rhoda.douglas@example.org','458.315.8766',0,1,0,'2024-03-02 11:36:53',1,'male','1976-08-30','88590 Walsh Meadows\nNorth Shanonville, NH 59910','Saudi Arabia','Beattyburgh','IS',NULL,'$2y$10$49mtUW.Zltryka1pRWNLCeXxJnychd6bUV3W5YVI4LKahbzlZrGt6','0jLdeKFKB5','2024-03-02 11:36:53','2024-03-02 11:36:53'),(4,'Iva','Carter','pbosco','hulda.legros@example.net','+1.231.340.0816',0,0,1,'2024-03-02 11:36:53',1,'female','2020-01-01','161 Kaelyn Shoals\nJacobsonstad, AL 05083-2278','Hong Kong','Metzport','VN',NULL,'$2y$10$bXV.//b0Sd7WXRCdAr5VF.QVyr8P.I1s277Ba/zuXBY9UM4K5MHda','5FBLALDe8b','2024-03-02 11:36:53','2024-03-02 11:36:53'),(5,'Marion','Larkin','ratke.laurel','caesar.hyatt@example.net','+15044567943',0,0,1,'2024-03-02 11:36:53',1,'male','1998-07-24','779 Jordi Pines\nLake Santa, NC 28198','Saint Vincent and the Grenadines','Mosciskishire','BM',NULL,'$2y$10$JG3b.NHIMryw5xis53V/NOaCTuC3XDmx3uapMif2E/x6z6yYee0p.','eWxmZG9dpg','2024-03-02 11:36:53','2024-03-02 11:36:53'),(6,'Brenden','Jakubowski','lon34','laisha.mcclure@example.com','520.901.9558',0,1,0,'2024-03-02 11:36:53',1,'female','1997-05-28','908 Allison Rapids Suite 275\nAlverashire, AL 97849-0184','Solomon Islands','Port Waylonmouth','US',NULL,'$2y$10$/5Mrksgvn5XvhtWuevOA2eJudcoQ7LTdRIBdEbEFd4Ym.MPFeQFB2','zqQlIqYk3M','2024-03-02 11:36:53','2024-03-02 11:36:53'),(7,'Mary','Berge','rowe.louvenia','ahilpert@example.org','+1 (530) 361-6367',1,0,0,'2024-03-02 11:36:53',1,'male','1993-07-18','19254 Thea Wall Apt. 623\nEast Dixie, MO 29502-1143','Gabon','Nolanshire','MH',NULL,'$2y$10$Y9CWTLZJCOlZWLuuFrosfucRLEy85e1udommBMaQdQN31Ok8oWnNq','6mp4qPfWAV','2024-03-02 11:36:53','2024-03-02 11:36:53'),(8,'Roxane','Vandervort','cheyenne55','glover.audra@example.net','+1-743-348-4421',1,0,1,'2024-03-02 11:36:53',1,'male','1991-03-13','2178 Kiana Trafficway Suite 414\nNew Monserratfurt, NJ 68871-1038','Gambia','Reichertview','KR',NULL,'$2y$10$rCku2WvjDeAqIVLeykr/mufnkYNuk9q3iEhh3BvaIqUgNsbxtFR2W','v7zGVCPfUy','2024-03-02 11:36:53','2024-03-02 11:36:53'),(9,'Devon','Sauer','ada.reichel','doyle.marjorie@example.com','564-641-3621',0,1,1,'2024-03-02 11:36:53',1,'female','1976-09-12','6884 Alexis Stravenue Suite 489\nFerryland, WI 91272','Fiji','Morarmouth','RW',NULL,'$2y$10$xubSOtv96.wAuwQDQj4YpO3PJGzwPzI/HDErsLgu7xFsX67YdwzBi','Vudo17Irpk','2024-03-02 11:36:53','2024-03-02 11:36:53'),(10,'Maryse','Bayer','emely82','zula61@example.com','+12602348890',0,0,0,'2024-03-02 11:36:53',1,'female','2001-08-03','6064 Herman Fall\nSouth Viva, NV 10141','Lebanon','East Enola','GM',NULL,'$2y$10$mXDqiZKjb.Bc1nJ28nsb8e39ItJFUSILBdTR2gAN6DXD/Oytl6n66','c8HA9U5N13','2024-03-02 11:36:53','2024-03-02 11:36:53'),(11,'Nikita','Harvey','schoen.marlin','ethyl39@example.com','+1-213-472-5830',1,0,1,'2024-03-02 11:36:53',1,'male','2016-12-18','78606 Gabe Point\nKutchview, WI 55680-2758','Italy','East Treva','AW',NULL,'$2y$10$/mosb8XyihwptjBCP9V4z.Od.zFgcM8CSiep8jzx0AXF/LwV95nuu','tSPDiJtQ6H','2024-03-02 11:36:53','2024-03-02 11:36:53'),(12,'Eriberto','Erdman','jerrold.boehm','tyrel05@example.net','872-817-4789',1,1,0,'2024-03-02 11:36:53',1,'female','1991-04-13','6272 Ruthe Canyon\nLehnershire, IN 46039','Slovenia','Robertsbury','CI',NULL,'$2y$10$TIDd6ccW7c5MuAR2LVRfAu8z2MR/FizA.zTAkPv/bZXAXjyU3t2RW','KJgxbmjpZ8','2024-03-02 11:36:53','2024-03-02 11:36:53'),(13,'Bertram','Schamberger','bertram','alvah16@example.org','19098698968',0,1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$561nYNsv6pPkPF0NzpXC/eJ.o85M5suyssDuTFf4Adtvx2IaYF4Gq',NULL,'2024-03-02 11:41:42','2024-03-02 11:41:42'),(14,'Trafalgra','Law','traf','tra@gmail.com','2134432',0,1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$2KMXCxNj8pT/mZevklOVWe7NhyquP8yG.mbAZ59BejipLCCaCoRJK',NULL,'2024-03-02 11:42:55','2024-03-02 11:42:55'),(15,'Waldo','Weissnat','corwin.alessia','klarson@example.com','601.618.0003',0,1,1,'2024-03-02 12:01:25',1,'female','1991-08-05','6164 Blake Trafficway\nFishermouth, IL 08305','Latvia','South Zacharyside','CC',NULL,'$2y$10$PkR4NupXbzVbf3jvVWDK8uczKgdritc/PoVVZY1Mpy8FI.1plJdQG','AchNkvhlAy','2024-03-02 12:01:25','2024-03-02 12:01:25'),(16,'Rozella','Runolfsdottir','wilbert.stanton','buford.kuhlman@example.org','+17169419616',0,1,1,'2024-03-02 12:10:23',1,'male','1999-02-22','68864 Abbie Estate\nEast Keon, AK 05908-8206','Oman','Geraldfort','LC',NULL,'$2y$10$RScoEkJPYDxkJkN47MsuyurMKOgKwwe/2xawbb9jFjTTmPg8j7Ho.','6ZDnu4Sfp9','2024-03-02 12:10:23','2024-03-02 12:10:23'),(17,'Makenzie','Pollich','orunolfsson','ftrantow@example.net','1-979-952-6551',0,1,0,'2024-03-02 12:10:23',1,'female','1988-10-03','256 Alvis Avenue Suite 858\nSamanthachester, MN 03437','Cuba','West Velma','SG',NULL,'$2y$10$HqGZWRKZeKTcgyNbNAN3JuYLcX9B2DN3F49vILaH3fQl2h0AxJPjW','KMUzPezHKx','2024-03-02 12:10:23','2024-03-02 12:10:23'),(18,'Joaquin','Hoppe','bemard','carroll.vincent@example.org','1-380-397-5501',0,1,0,'2024-03-02 12:10:23',1,'female','2019-12-27','301 Reynolds Lodge Apt. 250\nEast Erynhaven, WV 93572-6169','Mayotte','Macejkovicmouth','SB',NULL,'$2y$10$DPnmsWmDDuwhaEwBqLLcbeFDW8loNWmpMP2socYQAmyPBzqGKBzAm','jUqhEXT51v','2024-03-02 12:10:23','2024-03-02 12:10:23'),(19,'Esta','Kirlin','hbartell','ymante@example.com','540-581-1714',0,1,0,'2024-03-02 12:10:23',1,'male','2022-01-10','54429 Bernhard Vista\nNorth Ludwigchester, AL 05557-8029','Cuba','Gaylordbury','OM',NULL,'$2y$10$7gawxqgUyogcMgs39uGGIuKZH2G2eKQ3TCnY6OcDryU2zdPs.OPu6','UOwgqXPs0D','2024-03-02 12:10:23','2024-03-02 12:10:23'),(20,'Hope','Kertzmann','lester69','jason32@example.org','+1-432-500-7997',0,1,0,'2024-03-02 12:10:23',1,'male','1971-06-03','45126 Jamie Center Apt. 522\nNorth Keanuport, KS 15713-9801','Azerbaijan','Marleneburgh','UZ',NULL,'$2y$10$bIo3TmGtcj3oWvt3xit3R.7aU/cRTBnGF93FaTzMS3s5hHl1jJLji','6dXcPq9iSI','2024-03-02 12:10:23','2024-03-02 12:10:23'),(21,'Ericka','O\'Conner','delphia11','bo.parker@example.org','+1 (938) 582-2717',0,1,0,'2024-03-02 12:10:23',1,'male','1985-03-28','33862 Sydnee Streets Suite 511\nAltenwerthmouth, FL 68224','Norfolk Island','East Catharineshire','DM',NULL,'$2y$10$VwD9lDExSUhHmKd5kr7bf.34XcZE4jvtyKoAEMU2VggM.JE0NMdm2','WxJGiBItoa','2024-03-02 12:10:23','2024-03-02 12:10:23'),(22,'Greyson','Gusikowski','reilly.maxime','camren.sipes@example.org','+1-743-318-5951',0,1,0,'2024-03-02 12:10:23',1,'male','1988-02-27','8085 Bradly Meadow Suite 199\nWest Cletusland, WV 31000','Trinidad and Tobago','Fadelview','GE',NULL,'$2y$10$ST/cf1gKHVdi6LRqMynfsemrD1wZpt4U3KiT0KAAuKo7rXmrLC9Bq','fLcmrP1mOx','2024-03-02 12:10:23','2024-03-02 12:10:23'),(23,'Murl','Bernhard','iabbott','hortense58@example.org','(878) 868-4892',0,1,1,'2024-03-02 12:10:23',1,'male','2023-07-18','887 Gilda Ways Apt. 220\nJordaneton, KY 27979-0603','Uzbekistan','South Kari','CF',NULL,'$2y$10$2DT4hkM7TIgstP9xktVaQ.5tLUt/5t66QxW8VXaXyaXgd.3tMea9C','6cAZYKnMPv','2024-03-02 12:10:23','2024-03-02 12:10:23'),(24,'Astrid','Boyer','bailey.eliezer','al91@example.net','+1.662.316.3935',0,1,1,'2024-03-02 12:10:23',1,'male','2011-04-19','675 Schuster Creek\nPort Maudieton, LA 17680-2282','Montenegro','Kieranton','GI',NULL,'$2y$10$h7UULn/0LUxnHCmLyGRwr.KwhayCQUuTFyzAGV5esf/p6l5LCWFHS','VSrc6YGnnJ','2024-03-02 12:10:23','2024-03-02 12:10:23'),(26,'Tobi','Ajanaku','tobi','digienergy0@gmail.Com','+1 (757) 658-9660',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$58BoRUXl/gUQ0jYZMc40i.B2eQL9qn.IVw8Jmk0URSC.XEiFtkOKm',NULL,'2024-04-06 19:59:51','2024-04-06 19:59:51'),(27,'Ali','Hassan','ali_hassanji627926','zyuswras687@gmail.com',NULL,1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$NOJF7ZPRUoK.DJZ13xV.0.xMlemnVpqKEsSYSWDtma1NIAflFNe0i',NULL,'2024-06-27 05:27:38','2024-06-27 05:27:38'),(28,'coba','coba','coba','coba@email.com',NULL,1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$B.iVZZaZKWR1UuNyXtpTxuyeNaOpTx62F676bTpP16.9qyQMbWlEK',NULL,'2024-07-07 04:04:27','2024-07-07 04:04:27'),(29,'abdualnaser','alsayadi','abdualnaser2013.a','abdualnaser2013.a@gmail.com',NULL,1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$Y2U.Va5N16zhKEMn.Klfq.e7ph7Cl63gSxLafRfmZQ5svzE38NG9G',NULL,'2024-07-08 18:03:57','2024-07-08 18:03:57'),(30,'Alana','Black','fifyju','lafapip@mailinator.com',NULL,1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$Ulwxqe/lP6BTlXvNcZJBueNBOws5MadafaGxDFin1ZDsHqtUdgZS.',NULL,'2024-07-09 13:59:14','2024-07-09 13:59:14'),(31,'Roanna','Santos','bufarori','kalol@mailinator.com',NULL,1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$.eUqN9JF/whqmecaWfo7vuWUuPqKmX6Jdu3zvaaACyNNrFQ3SllI.',NULL,'2024-07-09 13:59:34','2024-07-09 13:59:34');
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

