-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: im23_nisaul
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Current Database: `im23_nisaul`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `im23_nisaul` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `im23_nisaul`;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinasi`
--

DROP TABLE IF EXISTS `destinasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint(20) unsigned NOT NULL,
  `nama` varchar(150) NOT NULL,
  `slug` varchar(170) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `ringkasan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_tiket` int(10) unsigned NOT NULL DEFAULT 0,
  `jam_operasional` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `unggulan` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinasi_slug_unique` (`slug`),
  KEY `destinasi_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `destinasi_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinasi`
--

LOCK TABLES `destinasi` WRITE;
/*!40000 ALTER TABLE `destinasi` DISABLE KEYS */;
INSERT INTO `destinasi` VALUES (1,1,'Labuan Bajo','labuan-bajo','Manggarai Barat, Nusa Tenggara Timur','Gerbang menuju Taman Nasional Komodo dengan gugusan pulau dan laut sebening kristal.','Labuan Bajo adalah kota pelabuhan kecil di ujung barat Pulau Flores yang menjadi pintu masuk Taman Nasional Komodo, situs Warisan Dunia UNESCO.\n\nWisatawan dapat berlayar dengan kapal phinisi, mendaki Pulau Padar untuk menikmati panorama tiga teluk, bersnorkeling bersama pari manta, hingga melihat langsung komodo di habitat aslinya.',150000,'Setiap hari, 06.00 - 18.00 WITA','img/labuan bajo.jpg',1,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(2,2,'Gunung Bromo','gunung-bromo','Probolinggo, Jawa Timur','Gunung api aktif dengan lautan pasir dan matahari terbit paling terkenal di Jawa.','Gunung Bromo berada di kawasan Taman Nasional Bromo Tengger Semeru. Kalderanya yang luas dikelilingi lautan pasir yang memukau.\n\nAktivitas favorit adalah menyaksikan matahari terbit dari Penanjakan, menunggang kuda melintasi lautan pasir, dan mendaki anak tangga menuju bibir kawah.',54000,'Setiap hari, 24 jam','img/bromo.jpg',1,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(3,3,'Candi Prambanan','candi-prambanan','Sleman, Daerah Istimewa Yogyakarta','Kompleks candi Hindu terbesar di Indonesia peninggalan abad ke-9.','Candi Prambanan dibangun pada abad ke-9 Masehi dan dipersembahkan untuk Trimurti: Brahma, Wisnu, dan Siwa. Candi utamanya menjulang setinggi 47 meter.\n\nPengunjung dapat menikmati relief kisah Ramayana di dinding candi serta pertunjukan Sendratari Ramayana di panggung terbuka saat malam hari.',50000,'Setiap hari, 06.30 - 17.00 WIB','img/Candi prambanan.jpg',1,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(4,2,'Ranu Kumbolo','ranu-kumbolo','Lumajang, Jawa Timur','Danau jernih di ketinggian 2.400 mdpl, tempat singgah para pendaki Semeru.','Ranu Kumbolo adalah danau air tawar yang berada di jalur pendakian Gunung Semeru. Airnya tenang dan memantulkan langit serta bukit di sekelilingnya.\n\nTempat ini menjadi lokasi berkemah favorit pendaki, terutama untuk menyaksikan matahari terbit di antara dua bukit. Jangan lewatkan Tanjakan Cinta dan padang lavender Oro-Oro Ombo.',35000,'Mengikuti jadwal buka jalur pendakian','img/Ranu kumbolo.jpg',0,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(5,4,'Air Terjun Tumpak Sewu','air-terjun-tumpak-sewu','Lumajang, Jawa Timur','Air terjun bertingkat berbentuk tirai raksasa dengan latar Gunung Semeru.','Tumpak Sewu berarti \"seribu air terjun\". Aliran airnya jatuh dari tebing setinggi sekitar 120 meter membentuk tirai setengah lingkaran yang megah.\n\nPengunjung bisa menikmatinya dari panorama atas atau turun ke dasar lembah melalui jalur tangga dan bebatuan untuk merasakan percikan airnya dari dekat.',20000,'Setiap hari, 06.00 - 17.00 WIB','img/air terjun tumpak sewu.jpg',1,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(6,1,'Pantai Anyer','pantai-anyer','Serang, Banten','Pantai berpasir putih yang mudah dijangkau dari Jakarta dengan mercusuar bersejarah.','Pantai Anyer terletak di pesisir barat Pulau Jawa dan menjadi tujuan liburan akhir pekan favorit warga Jabodetabek.\n\nSelain berenang dan bermain pasir, pengunjung dapat mengunjungi Mercusuar Cikoneng peninggalan Belanda serta menikmati matahari terbenam di Selat Sunda.',25000,'Setiap hari, 24 jam','img/Pantai anyer.jpg',0,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(7,1,'Pink Beach Lombok','pink-beach-lombok','Lombok Timur, Nusa Tenggara Barat','Pantai dengan pasir bernuansa merah muda dan air laut toska yang tenang.','Pantai Tangsi atau Pink Beach Lombok memiliki pasir berwarna merah muda yang berasal dari serpihan karang merah bercampur pasir putih.\n\nPerairannya yang tenang sangat cocok untuk snorkeling. Dari bukit di sisi pantai, pengunjung bisa melihat panorama laut lepas dan pulau-pulau kecil di sekitarnya.',10000,'Setiap hari, 07.00 - 18.00 WITA','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',0,'2026-10-15 04:53:54','2026-10-15 04:53:54'),(8,3,'Pura Ulun Danu Beratan','pura-ulun-danu-beratan','Tabanan, Bali','Pura ikonik yang seolah mengapung di tepi Danau Beratan yang sejuk.','Pura Ulun Danu Beratan dibangun pada abad ke-17 untuk memuja Dewi Danu, dewi air dan kesuburan. Bangunan meru bertingkatnya tampak mengapung saat air danau sedang pasang.\n\nBerada di dataran tinggi Bedugul, kawasan ini berhawa sejuk dan dikelilingi taman bunga serta perbukitan hijau.',75000,'Setiap hari, 07.00 - 19.00 WITA','https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',0,'2026-10-15 04:53:54','2026-10-15 04:53:54');
/*!40000 ALTER TABLE `destinasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

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

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeri`
--

DROP TABLE IF EXISTS `galeri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeri` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `destinasi_id` bigint(20) unsigned NOT NULL,
  `judul` varchar(150) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeri_destinasi_id_foreign` (`destinasi_id`),
  CONSTRAINT `galeri_destinasi_id_foreign` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeri`
--

LOCK TABLES `galeri` WRITE;
/*!40000 ALTER TABLE `galeri` DISABLE KEYS */;
INSERT INTO `galeri` VALUES (1,1,'Teluk Labuan Bajo','img/labuan bajo.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(2,1,'Berlayar di Laut Flores','https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54'),(3,2,'Kaldera Bromo','img/bromo.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(4,2,'Pagi di Pegunungan','https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54'),(5,3,'Candi Utama Prambanan','img/Candi prambanan.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(6,4,'Danau Ranu Kumbolo','img/Ranu kumbolo.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(7,4,'Danau di Lembah Hijau','https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54'),(8,5,'Tirai Air Tumpak Sewu','img/air terjun tumpak sewu.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(9,6,'Pesisir Anyer','img/Pantai anyer.jpg','2026-10-15 04:53:54','2026-10-15 04:53:54'),(10,6,'Pasir Putih','https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54'),(11,7,'Laut Toska Lombok','https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54'),(12,8,'Pura di Tepi Danau','https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=900&q=80','2026-10-15 04:53:54','2026-10-15 04:53:54');
/*!40000 ALTER TABLE `galeri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `ikon` varchar(50) NOT NULL DEFAULT 'bi-geo-alt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Pantai & Bahari','pantai-bahari','bi-water','2026-10-15 04:53:54','2026-10-15 04:53:54'),(2,'Pegunungan','pegunungan','bi-triangle','2026-10-15 04:53:54','2026-10-15 04:53:54'),(3,'Sejarah & Budaya','sejarah-budaya','bi-bank','2026-10-15 04:53:54','2026-10-15 04:53:54'),(4,'Air Terjun','air-terjun','bi-droplet','2026-10-15 04:53:54','2026-10-15 04:53:54');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_15_000001_create_kategori_table',1),(5,'2026_10_15_000002_create_destinasi_table',1),(6,'2026_10_15_000003_create_galeri_table',1),(7,'2026_10_15_000004_create_pesan_kontak_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

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

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesan_kontak`
--

DROP TABLE IF EXISTS `pesan_kontak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesan_kontak` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `subjek` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesan_kontak`
--

LOCK TABLES `pesan_kontak` WRITE;
/*!40000 ALTER TABLE `pesan_kontak` DISABLE KEYS */;
INSERT INTO `pesan_kontak` VALUES (1,'Budi Santoso','budi.santoso@example.com','081234567890','Informasi paket rombongan','Apakah ada harga khusus untuk rombongan 30 orang ke Gunung Bromo?','2026-10-15 04:53:54','2026-10-15 04:53:54');
/*!40000 ALTER TABLE `pesan_kontak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Wisata','admin@pariwisatanusantara.com',NULL,'$2y$12$LN1CK/BgY.6MbX.4cQNTTOnPDn70XWNQ4E8AxFvLZYLImhjLLPHrq',NULL,'2026-10-15 04:53:54','2026-10-15 04:53:54');
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

-- Dump completed
