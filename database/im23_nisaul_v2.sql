/*
 Navicat Premium Dump SQL

 Source Server         : 1.Localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : im23_nisaul

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 15/10/2026 12:02:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_locks_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for destinasi
-- ----------------------------
DROP TABLE IF EXISTS `destinasi`;
CREATE TABLE `destinasi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_tiket` int UNSIGNED NOT NULL DEFAULT 0,
  `jam_operasional` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unggulan` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `destinasi_slug_unique`(`slug` ASC) USING BTREE,
  INDEX `destinasi_kategori_id_foreign`(`kategori_id` ASC) USING BTREE,
  CONSTRAINT `destinasi_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of destinasi
-- ----------------------------
INSERT INTO `destinasi` VALUES (1, 1, 'Labuan Bajo', 'labuan-bajo', 'Manggarai Barat, Nusa Tenggara Timur', 'Gerbang menuju Taman Nasional Komodo dengan gugusan pulau dan laut sebening kristal.', 'Labuan Bajo adalah kota pelabuhan kecil di ujung barat Pulau Flores yang menjadi pintu masuk Taman Nasional Komodo, situs Warisan Dunia UNESCO.\n\nWisatawan dapat berlayar dengan kapal phinisi, mendaki Pulau Padar untuk menikmati panorama tiga teluk, bersnorkeling bersama pari manta, hingga melihat langsung komodo di habitat aslinya.', 150000, 'Setiap hari, 06.00 - 18.00 WITA', 'img/labuan bajo.jpg', 1, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (2, 2, 'Gunung Bromo', 'gunung-bromo', 'Probolinggo, Jawa Timur', 'Gunung api aktif dengan lautan pasir dan matahari terbit paling terkenal di Jawa.', 'Gunung Bromo berada di kawasan Taman Nasional Bromo Tengger Semeru. Kalderanya yang luas dikelilingi lautan pasir yang memukau.\n\nAktivitas favorit adalah menyaksikan matahari terbit dari Penanjakan, menunggang kuda melintasi lautan pasir, dan mendaki anak tangga menuju bibir kawah.', 54000, 'Setiap hari, 24 jam', 'img/bromo.jpg', 1, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (3, 3, 'Candi Prambanan', 'candi-prambanan', 'Sleman, Daerah Istimewa Yogyakarta', 'Kompleks candi Hindu terbesar di Indonesia peninggalan abad ke-9.', 'Candi Prambanan dibangun pada abad ke-9 Masehi dan dipersembahkan untuk Trimurti: Brahma, Wisnu, dan Siwa. Candi utamanya menjulang setinggi 47 meter.\n\nPengunjung dapat menikmati relief kisah Ramayana di dinding candi serta pertunjukan Sendratari Ramayana di panggung terbuka saat malam hari.', 50000, 'Setiap hari, 06.30 - 17.00 WIB', 'img/Candi prambanan.jpg', 1, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (4, 2, 'Ranu Kumbolo', 'ranu-kumbolo', 'Lumajang, Jawa Timur', 'Danau jernih di ketinggian 2.400 mdpl, tempat singgah para pendaki Semeru.', 'Ranu Kumbolo adalah danau air tawar yang berada di jalur pendakian Gunung Semeru. Airnya tenang dan memantulkan langit serta bukit di sekelilingnya.\n\nTempat ini menjadi lokasi berkemah favorit pendaki, terutama untuk menyaksikan matahari terbit di antara dua bukit. Jangan lewatkan Tanjakan Cinta dan padang lavender Oro-Oro Ombo.', 35000, 'Mengikuti jadwal buka jalur pendakian', 'img/Ranu kumbolo.jpg', 0, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (5, 4, 'Air Terjun Tumpak Sewu', 'air-terjun-tumpak-sewu', 'Lumajang, Jawa Timur', 'Air terjun bertingkat berbentuk tirai raksasa dengan latar Gunung Semeru.', 'Tumpak Sewu berarti \"seribu air terjun\". Aliran airnya jatuh dari tebing setinggi sekitar 120 meter membentuk tirai setengah lingkaran yang megah.\n\nPengunjung bisa menikmatinya dari panorama atas atau turun ke dasar lembah melalui jalur tangga dan bebatuan untuk merasakan percikan airnya dari dekat.', 20000, 'Setiap hari, 06.00 - 17.00 WIB', 'img/air terjun tumpak sewu.jpg', 1, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (6, 1, 'Pantai Anyer', 'pantai-anyer', 'Serang, Banten', 'Pantai berpasir putih yang mudah dijangkau dari Jakarta dengan mercusuar bersejarah.', 'Pantai Anyer terletak di pesisir barat Pulau Jawa dan menjadi tujuan liburan akhir pekan favorit warga Jabodetabek.\n\nSelain berenang dan bermain pasir, pengunjung dapat mengunjungi Mercusuar Cikoneng peninggalan Belanda serta menikmati matahari terbenam di Selat Sunda.', 25000, 'Setiap hari, 24 jam', 'img/Pantai anyer.jpg', 0, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (7, 1, 'Pink Beach Lombok', 'pink-beach-lombok', 'Lombok Timur, Nusa Tenggara Barat', 'Pantai dengan pasir bernuansa merah muda dan air laut toska yang tenang.', 'Pantai Tangsi atau Pink Beach Lombok memiliki pasir berwarna merah muda yang berasal dari serpihan karang merah bercampur pasir putih.\n\nPerairannya yang tenang sangat cocok untuk snorkeling. Dari bukit di sisi pantai, pengunjung bisa melihat panorama laut lepas dan pulau-pulau kecil di sekitarnya.', 10000, 'Setiap hari, 07.00 - 18.00 WITA', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80', 0, '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `destinasi` VALUES (8, 3, 'Pura Ulun Danu Beratan', 'pura-ulun-danu-beratan', 'Tabanan, Bali', 'Pura ikonik yang seolah mengapung di tepi Danau Beratan yang sejuk.', 'Pura Ulun Danu Beratan dibangun pada abad ke-17 untuk memuja Dewi Danu, dewi air dan kesuburan. Bangunan meru bertingkatnya tampak mengapung saat air danau sedang pasang.\n\nBerada di dataran tinggi Bedugul, kawasan ini berhawa sejuk dan dikelilingi taman bunga serta perbukitan hijau.', 75000, 'Setiap hari, 07.00 - 19.00 WITA', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80', 0, '2026-10-15 11:53:54', '2026-10-15 11:53:54');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for galeri
-- ----------------------------
DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `destinasi_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `galeri_destinasi_id_foreign`(`destinasi_id` ASC) USING BTREE,
  CONSTRAINT `galeri_destinasi_id_foreign` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of galeri
-- ----------------------------
INSERT INTO `galeri` VALUES (1, 1, 'Teluk Labuan Bajo', 'img/labuan bajo.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (2, 1, 'Berlayar di Laut Flores', 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (3, 2, 'Kaldera Bromo', 'img/bromo.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (4, 2, 'Pagi di Pegunungan', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (5, 3, 'Candi Utama Prambanan', 'img/Candi prambanan.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (6, 4, 'Danau Ranu Kumbolo', 'img/Ranu kumbolo.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (7, 4, 'Danau di Lembah Hijau', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (8, 5, 'Tirai Air Tumpak Sewu', 'img/air terjun tumpak sewu.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (9, 6, 'Pesisir Anyer', 'img/Pantai anyer.jpg', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (10, 6, 'Pasir Putih', 'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (11, 7, 'Laut Toska Lombok', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `galeri` VALUES (12, 8, 'Pura di Tepi Danau', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=900&q=80', '2026-10-15 11:53:54', '2026-10-15 11:53:54');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ikon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bi-geo-alt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `kategori_slug_unique`(`slug` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Pantai & Bahari', 'pantai-bahari', 'bi-water', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `kategori` VALUES (2, 'Pegunungan', 'pegunungan', 'bi-triangle', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `kategori` VALUES (3, 'Sejarah & Budaya', 'sejarah-budaya', 'bi-bank', '2026-10-15 11:53:54', '2026-10-15 11:53:54');
INSERT INTO `kategori` VALUES (4, 'Air Terjun', 'air-terjun', 'bi-droplet', '2026-10-15 11:53:54', '2026-10-15 11:53:54');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2026_10_15_000001_create_kategori_table', 1);
INSERT INTO `migrations` VALUES (5, '2026_10_15_000002_create_destinasi_table', 1);
INSERT INTO `migrations` VALUES (6, '2026_10_15_000003_create_galeri_table', 1);
INSERT INTO `migrations` VALUES (7, '2026_10_15_000004_create_pesan_kontak_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for pesan_kontak
-- ----------------------------
DROP TABLE IF EXISTS `pesan_kontak`;
CREATE TABLE `pesan_kontak`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subjek` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pesan_kontak
-- ----------------------------
INSERT INTO `pesan_kontak` VALUES (1, 'Budi Santoso', 'budi.santoso@example.com', '081234567890', 'Informasi paket rombongan', 'Apakah ada harga khusus untuk rombongan 30 orang ke Gunung Bromo?', '2026-10-15 11:53:54', '2026-10-15 11:53:54');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('PfRFgOZeeOATG1gfiAov1cSiJmmmQyjDHkG5yLsC', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHlGdk1Ua1JrWnZva01ad0lWMVQ5aHpYbXZsQ2swaGw3VGk2M3VsYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9sb2NhbGhvc3QvSU0yM0MvdGlrZXQtd2lzYXRhL3dpc2F0YS1sYXJhdmVsL3B1YmxpYy9rb250YWsiO3M6NToicm91dGUiO3M6Njoia29udGFrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792040475);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin Wisata', 'admin@pariwisatanusantara.com', NULL, '$2y$12$LN1CK/BgY.6MbX.4cQNTTOnPDn70XWNQ4E8AxFvLZYLImhjLLPHrq', NULL, '2026-10-15 11:53:54', '2026-10-15 11:53:54');

SET FOREIGN_KEY_CHECKS = 1;
