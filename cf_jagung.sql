/*
 Navicat Premium Data Transfer

 Source Server         : Database
 Source Server Type    : MySQL
 Source Server Version : 80040
 Source Host           : localhost:3306
 Source Schema         : cf_jagung

 Target Server Type    : MySQL
 Target Server Version : 80040
 File Encoding         : 65001

 Date: 05/06/2025 17:36:13
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
  PRIMARY KEY (`key`) USING BTREE
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
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for diagnoses
-- ----------------------------
DROP TABLE IF EXISTS `diagnoses`;
CREATE TABLE `diagnoses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `user_session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected_symptoms` json NOT NULL,
  `user_confidence_levels` json NULL,
  `results` json NOT NULL,
  `user_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `diagnoses_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `diagnoses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of diagnoses
-- ----------------------------
INSERT INTO `diagnoses` VALUES (31, 5, '6Kabe8lRl90sNhALMdptN8V23qNu33nQ07Hwnwej', '[\"1\", \"2\"]', '{\"1\": \"yakin\", \"2\": \"yakin\", \"3\": \"yakin\", \"4\": \"yakin\", \"5\": \"yakin\", \"6\": \"yakin\", \"7\": \"yakin\"}', '[{\"disease\": {\"id\": 1, \"code\": \"P01\", \"name\": \"Hawar Daun\", \"rules\": [{\"id\": 1, \"code\": \"R01\", \"cf_value\": \"0.70\", \"created_at\": \"2025-06-05T03:47:54.000000Z\", \"disease_id\": 1, \"symptom_id\": 1, \"updated_at\": \"2025-06-05T03:47:54.000000Z\"}, {\"id\": 2, \"code\": \"R02\", \"cf_value\": \"0.60\", \"created_at\": \"2025-06-05T03:47:54.000000Z\", \"disease_id\": 1, \"symptom_id\": 2, \"updated_at\": \"2025-06-05T03:47:54.000000Z\"}], \"causes\": \"Disebabkan oleh jamur Exserohilum turcicum (Helminthosporium turcicum). Kondisi lembab dengan kelembaban tinggi (>80%) dan suhu 18-27°C sangat mendukung perkembangan penyakit ini.\", \"created_at\": \"2025-06-05T03:46:20.000000Z\", \"image_path\": null, \"updated_at\": \"2025-06-05T03:46:20.000000Z\", \"description\": \"Penyakit hawar daun adalah salah satu penyakit utama pada tanaman jagung yang disebabkan oleh jamur. Penyakit ini dapat menyebabkan penurunan hasil yang signifikan jika tidak ditangani dengan baik.\", \"control_methods\": \"1. Gunakan varietas jagung yang tahan terhadap hawar daun\\n2. Rotasi tanaman dengan tanaman non-graminae (kacang-kacangan, umbi-umbian)\\n3. Aplikasi fungisida berbahan aktif mankozeb atau klorotalonil setiap 7-10 hari\\n4. Sanitasi lahan dengan membersihkan sisa-sisa tanaman setelah panen\\n5. Pengaturan jarak tanam yang tepat (75x25 cm) untuk sirkulasi udara yang baik\\n6. Pemupukan berimbang untuk meningkatkan ketahanan tanaman\", \"symptoms_description\": \"Bercak lonjong keabu-abuan pada daun, daun mengering dimulai dari ujung daun, biji pada tongkol tidak terisi penuh akibat gangguan fotosintesis.\"}, \"cf_value\": 0.7712, \"percentage\": 77.12, \"confidence_level\": \"Yakin\"}]', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '2025-06-05 06:02:38', '2025-06-05 06:02:38');

-- ----------------------------
-- Table structure for disease_symptom_rules
-- ----------------------------
DROP TABLE IF EXISTS `disease_symptom_rules`;
CREATE TABLE `disease_symptom_rules`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_id` bigint UNSIGNED NOT NULL,
  `symptom_id` bigint UNSIGNED NOT NULL,
  `cf_value` decimal(3, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `disease_symptom_rules_disease_id_symptom_id_unique`(`disease_id` ASC, `symptom_id` ASC) USING BTREE,
  UNIQUE INDEX `disease_symptom_rules_code_unique`(`code` ASC) USING BTREE,
  INDEX `disease_symptom_rules_symptom_id_foreign`(`symptom_id` ASC) USING BTREE,
  CONSTRAINT `disease_symptom_rules_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `disease_symptom_rules_symptom_id_foreign` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of disease_symptom_rules
-- ----------------------------
INSERT INTO `disease_symptom_rules` VALUES (1, 'R01', 1, 1, 0.70, '2025-06-05 03:47:54', '2025-06-05 03:47:54');
INSERT INTO `disease_symptom_rules` VALUES (2, 'R02', 1, 2, 0.60, '2025-06-05 03:47:54', '2025-06-05 03:47:54');
INSERT INTO `disease_symptom_rules` VALUES (3, 'R03', 2, 3, 0.80, '2025-06-05 03:47:54', '2025-06-05 03:47:54');
INSERT INTO `disease_symptom_rules` VALUES (4, 'R04', 2, 4, 0.40, '2025-06-05 03:47:54', '2025-06-05 03:47:54');
INSERT INTO `disease_symptom_rules` VALUES (5, 'R05', 3, 5, 0.85, '2025-06-05 03:47:55', '2025-06-05 03:47:55');
INSERT INTO `disease_symptom_rules` VALUES (6, 'R06', 3, 6, 0.70, '2025-06-05 03:47:55', '2025-06-05 03:47:55');
INSERT INTO `disease_symptom_rules` VALUES (7, 'R07', 1, 7, 0.30, '2025-06-05 03:47:55', '2025-06-05 03:47:55');

-- ----------------------------
-- Table structure for diseases
-- ----------------------------
DROP TABLE IF EXISTS `diseases`;
CREATE TABLE `diseases`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `causes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `symptoms_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `control_methods` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `diseases_code_unique`(`code` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of diseases
-- ----------------------------
INSERT INTO `diseases` VALUES (1, 'P01', 'Hawar Daun', 'Penyakit hawar daun adalah salah satu penyakit utama pada tanaman jagung yang disebabkan oleh jamur. Penyakit ini dapat menyebabkan penurunan hasil yang signifikan jika tidak ditangani dengan baik.', 'Disebabkan oleh jamur Exserohilum turcicum (Helminthosporium turcicum). Kondisi lembab dengan kelembaban tinggi (>80%) dan suhu 18-27°C sangat mendukung perkembangan penyakit ini.', 'Bercak lonjong keabu-abuan pada daun, daun mengering dimulai dari ujung daun, biji pada tongkol tidak terisi penuh akibat gangguan fotosintesis.', '1. Gunakan varietas jagung yang tahan terhadap hawar daun\n2. Rotasi tanaman dengan tanaman non-graminae (kacang-kacangan, umbi-umbian)\n3. Aplikasi fungisida berbahan aktif mankozeb atau klorotalonil setiap 7-10 hari\n4. Sanitasi lahan dengan membersihkan sisa-sisa tanaman setelah panen\n5. Pengaturan jarak tanam yang tepat (75x25 cm) untuk sirkulasi udara yang baik\n6. Pemupukan berimbang untuk meningkatkan ketahanan tanaman', NULL, '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `diseases` VALUES (2, 'P02', 'Karat Daun', 'Penyakit karat daun disebabkan oleh jamur Puccinia sorghi yang menyerang daun jagung. Penyakit ini ditandai dengan munculnya serbuk berwarna karat pada permukaan daun yang dapat mengurangi kemampuan fotosintesis tanaman.', 'Disebabkan oleh jamur Puccinia sorghi. Kondisi lembab dengan embun pagi, kelembaban tinggi (85-95%), dan suhu sedang (20-25°C) sangat mendukung perkembangan dan penyebaran spora jamur.', 'Terdapat serbuk berwarna karat (orange-coklat) pada permukaan daun, bercak kecil basah seperti embun tepung di daun, spora mudah rontok jika daun disentuh.', '1. Aplikasi fungisida sistemik berbahan aktif propikonazol atau tebukonazol\n2. Penanaman varietas jagung yang tahan terhadap karat daun\n3. Pengaturan jarak tanam untuk sirkulasi udara yang baik\n4. Hindari penyiraman dari atas (overhead irrigation) yang dapat menyebarkan spora\n5. Pemupukan berimbang terutama kalium untuk meningkatkan ketahanan tanaman\n6. Monitoring rutin dan aplikasi fungisida pada gejala awal', NULL, '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `diseases` VALUES (3, 'P03', 'Busuk Pangkal Batang', 'Penyakit busuk pangkal batang disebabkan oleh jamur tanah yang menyerang sistem perakaran dan pangkal batang. Penyakit ini sangat berbahaya karena dapat menyebabkan kematian tanaman secara keseluruhan.', 'Disebabkan oleh kompleks jamur tanah seperti Fusarium spp., Pythium spp., dan Rhizoctonia solani. Kondisi tanah yang tergenang air, drainase buruk, dan kelembaban tanah yang tinggi mendukung perkembangan penyakit.', 'Pangkal batang membusuk dan berwarna gelap (coklat kehitaman), tanaman layu secara keseluruhan meskipun kondisi air cukup, akar menjadi coklat dan mudah putus.', '1. Perbaiki sistem drainase lahan untuk mencegah genangan air\n2. Buang dan musnahkan tanaman yang terinfeksi dengan cara dibakar\n3. Aplikasi fungisida berbahan aktif metalaksil atau fosetil-aluminium pada tanah\n4. Gunakan benih bersertifikat dan sehat\n5. Lakukan pengolahan tanah yang baik dengan penambahan bahan organik\n6. Aplikasi pupuk organik untuk meningkatkan kesehatan dan struktur tanah\n7. Rotasi tanaman dengan tanaman yang tidak rentan terhadap jamur tanah', NULL, '2025-06-05 03:46:20', '2025-06-05 03:46:20');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

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
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2025_06_05_015435_create_diseases_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_06_05_015439_create_symptoms_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_06_05_015444_create_disease_symptom_rules_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_06_05_015448_create_diagnoses_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_06_05_030651_add_confidence_level_to_diagnoses_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_06_05_033000_add_role_to_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_06_05_033026_add_role_to_users_table', 1);

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
INSERT INTO `sessions` VALUES ('6Kabe8lRl90sNhALMdptN8V23qNu33nQ07Hwnwej', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3l3TnNrcGNGS0NONEpaVUZKc0RRWkNqcE9MSW5FcHlzUnJBMlFqVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9jZi1qYWd1bmcudGVzdC91c2VyL2hpc3RvcnkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1749103488);
INSERT INTO `sessions` VALUES ('Qv8IaU0gsFHWtgYgvtbxxrFLyTvbrPvOH2wONVUH', 5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib0pMSTB4OVJjY3czM05xckt1V1p5Q281V1o2dUlRVzlROU4zcm9teSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODg4OC91c2VyL2hpc3Rvcnk/cGFnZT0xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1749103281);
INSERT INTO `sessions` VALUES ('vd67FmNYEIGpxo0B7pOojb3rAyH6hW5wVfsavos9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1hiOVBhc2lEUEJzU3lHd1hLb2lGQkNkZTA2dUhRdjJnSEx1NnlNUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9jZi1qYWd1bmcudGVzdC9hZG1pbi9sb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly9jZi1qYWd1bmcudGVzdC9hZG1pbi9kaWFnbm9zZXMiO319', 1749103478);

-- ----------------------------
-- Table structure for symptoms
-- ----------------------------
DROP TABLE IF EXISTS `symptoms`;
CREATE TABLE `symptoms`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `symptoms_code_unique`(`code` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of symptoms
-- ----------------------------
INSERT INTO `symptoms` VALUES (1, 'G01', 'Bercak lonjong keabu-abuan pada daun', 'Munculnya bercak-bercak berbentuk lonjong dengan warna keabu-abuan pada permukaan daun jagung. Bercak ini biasanya dimulai sebagai titik kecil kemudian berkembang menjadi bercak memanjang yang mengikuti arah tulang daun.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (2, 'G02', 'Daun mengering, dimulai dari ujung daun', 'Daun jagung mengalami pengeringan yang dimulai dari bagian ujung daun dan secara bertahap menyebar ke arah pangkal daun. Proses pengeringan ini menyebabkan daun menjadi coklat dan rapuh.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (3, 'G03', 'Terdapat serbuk berwarna karat pada daun', 'Munculnya serbuk halus berwarna karat (orange-coklat) pada permukaan daun, terutama pada bagian bawah daun. Serbuk ini merupakan spora jamur yang mudah rontok jika daun disentuh atau tertiup angin.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (4, 'G04', 'Bercak kecil basah (embun tepung) di daun', 'Terdapat bercak-bercak kecil yang tampak basah seperti embun tepung pada permukaan daun. Bercak ini biasanya berwarna putih keabu-abuan dan terasa lembab saat disentuh.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (5, 'G05', 'Pangkal batang membusuk dan berwarna gelap', 'Bagian pangkal batang mengalami pembusukan dengan perubahan warna menjadi gelap (coklat kehitaman). Area yang membusuk terasa lunak dan mudah hancur jika ditekan.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (6, 'G06', 'Tanaman layu secara keseluruhan', 'Seluruh bagian tanaman menunjukkan gejala layu meskipun kondisi air dan kelembaban tanah cukup. Daun terlihat lemas, menggantung, dan kehilangan turgiditas.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `symptoms` VALUES (7, 'G07', 'Biji pada tongkol tidak terisi penuh', 'Tongkol jagung menunjukkan biji-biji yang tidak terisi penuh atau kosong. Hal ini disebabkan oleh gangguan proses fotosintesis dan translokasi nutrisi akibat kerusakan pada daun.', '2025-06-05 03:46:20', '2025-06-05 03:46:20');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@example.com', 'user', '2025-06-05 03:46:19', '$2y$12$rGhHUj..unKOQf2l7p2WQuKuf.vOu0XorjHjnFCiOv2IdwDaT0vBK', 'rL3vMyxr69', '2025-06-05 03:46:20', '2025-06-05 03:46:20');
INSERT INTO `users` VALUES (3, 'admin', 'admin@admin.com', 'admin', NULL, '$2y$12$YvNtRlk42imh9c7Yq.GKN.nX4YebFh/aHX2qELlKI1qvPBIxI/8Rq', NULL, '2025-06-05 03:49:18', '2025-06-05 03:49:18');
INSERT INTO `users` VALUES (4, 'fatihurroyyan', 'fatihur17@gmail.com', 'user', NULL, '$2y$12$QPxz46wRrz7H9R6INlS.j.xnpXy1ywUvy5J5kHjxodgRtqC/gyC72', NULL, '2025-06-05 03:52:06', '2025-06-05 03:52:06');
INSERT INTO `users` VALUES (5, 'Test User', 'test@gmail.com', 'user', NULL, '$2y$12$WEfY4W49.Evn0JeyDlaz2ukM0K9/TO76GE.EQ80HJaI9z69Q4FmwW', NULL, '2025-06-05 05:46:51', '2025-06-05 05:46:51');

SET FOREIGN_KEY_CHECKS = 1;
