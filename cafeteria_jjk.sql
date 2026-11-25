-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cafeteria_jjk
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
INSERT INTO `cache` VALUES ('laravel-cache-admin@jujutsu.com|::1','i:1;',1793121366),('laravel-cache-admin@jujutsu.com|::1:timer','i:1793121366;',1793121366);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_15_010042_add_role_to_users_table',2),(5,'2026_10_15_010156_create_productos_table',2),(6,'2026_10_16_002301_create_pedidos_table',3),(7,'2026_10_16_002309_create_pedido_detalles_table',3),(8,'2026_10_29_163500_add_activo_to_productos_table',4);
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
-- Table structure for table `pedido_detalles`
--

DROP TABLE IF EXISTS `pedido_detalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `producto_id` bigint(20) unsigned DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_detalles_pedido_id_foreign` (`pedido_id`),
  KEY `pedido_detalles_producto_id_foreign` (`producto_id`),
  CONSTRAINT `pedido_detalles_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pedido_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_detalles`
--

LOCK TABLES `pedido_detalles` WRITE;
/*!40000 ALTER TABLE `pedido_detalles` DISABLE KEYS */;
INSERT INTO `pedido_detalles` VALUES (1,2,8,'Vac├¡o P├║rpura',35.00,1,'2026-10-16 07:09:05','2026-10-16 07:09:05'),(2,2,13,'T├®cnica de Sombras de Diez Megumi',40.00,1,'2026-10-16 07:09:05','2026-10-16 07:09:05'),(3,3,NULL,'Restricci├│n Celestial',20.00,1,'2026-10-17 09:22:10','2026-10-17 09:22:10'),(4,3,14,'Juicio de Higuruma',35.00,1,'2026-10-17 09:22:10','2026-10-17 09:22:10');
/*!40000 ALTER TABLE `pedido_detalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_user_id_foreign` (`user_id`),
  CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (2,2,75.00,'cancelado','2026-10-16 07:09:05','2026-10-17 09:02:48'),(3,2,55.00,'preparando','2026-10-17 09:22:10','2026-10-17 09:23:30');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (5,'Latte Infinito de Gojo','Un caf├® con leche perfectamente texturizado, cubierto con una capa de espuma ligera y un toque de color azul brillante simulando el Vainilla-Menta. Tan dulce y abrumador que parece no tener fin.',35.00,'Bebidas','img/productos/prod_6ad1729b081b0.jpg',1,'2026-10-16 06:40:59','2026-10-16 06:40:59'),(6,'T├®cnica de la Rosa','Una delicada infusi├│n de t├® verde org├ínico con notas de jazm├¡n y p├®talos de rosa comestibles. Ideal para calmar los nervios despu├®s de un largo d├¡a combatiendo maldiciones de grado especial.',45.00,'Bebidas','img/productos/prod_6ad173156cf04.jpg',1,'2026-10-16 06:43:01','2026-10-16 06:44:51'),(7,'El Rey de las Sombras','Una bebida fr├¡a y cremosa a base de t├® matcha ceremonial con leche de almendras y un remolino de jarabe de mora azul oscura en las paredes del vaso, representando el poder del Sukuna.',23.00,'Bebidas','img/productos/prod_6ad173752fdd5.jpg',1,'2026-10-16 06:44:37','2026-10-16 06:44:37'),(8,'Vac├¡o P├║rpura','Delicioso chocolate semi-amargo humeante coronado con malvaviscos tostados y un toque secreto de jarabe de lavanda que le otorga un tono viol├íceo ├║nico.',35.00,'Bebidas','img/productos/prod_6ad173ede21a3.jpg',1,'2026-10-16 06:46:37','2026-10-16 06:46:37'),(9,'Rika','Inspirado en el imponente esp├¡ritu maldito de Rika Orimoto. Es un pastel denso y h├║medo de triple chocolate oscuro, relleno de ganache de avellana y decorado con un glaseado brillante que evoca su enorme presencia.',35.00,'Postres','img/productos/prod_6ad174381617b.jpg',1,'2026-10-16 06:47:52','2026-10-16 06:47:52'),(10,'Prisi├│n Confinada','Un cremoso pastel de queso al estilo Nueva York cubierto por una mermelada espesa de frutos rojos (fresa y zarzamora) que simula el sello de la Prisi├│n Confinada. ┬íTan adictivo que no querr├ís escapar!',38.00,'Postres','img/productos/prod_6ad174906f648.jpg',1,'2026-10-16 06:49:20','2026-10-16 06:49:20'),(11,'Dedos Malditos','Un muffin de vainilla y chispas de chocolate horneado con una forma alargada muy peculiar, acompa├▒ado de una jeringa de jarabe de chocolate espeso para simular un \"Dedo Maldito\" comestible.',28.00,'Postres','img/productos/prod_6ad174fa3276b.jpg',1,'2026-10-16 06:51:06','2026-10-16 06:51:06'),(12,'Inumaki','Un suave y esponjoso mochi japon├®s relleno de pasta de frijol dulce (anko) y una fresa entera en su interior. ┬íSalm├│n y hojuelas! Una explosi├│n de sabor tradicional.',30.00,'Postres','img/productos/prod_6ad1756848721.jpg',1,'2026-10-16 06:52:56','2026-10-16 06:52:56'),(13,'T├®cnica de Sombras de Diez Megumi','Dos waffles belgas crujientes en forma de cuadr├¡cula, acompa├▒ados de helado de vainilla artesanal, pl├ítano en rodajas y un chorro de cajeta espesa que simula los animales de sombra emergiendo del plato.',40.00,'Especiales','img/productos/prod_6ad175b4e4320.jpg',1,'2026-10-16 06:54:12','2026-10-16 06:54:12'),(14,'Juicio de Higuruma','Torre de tres panqueques esponjosos ba├▒ados en miel de maple pura, acompa├▒ados de frutos frescos y una peque├▒a balanza de chocolate amargo comestible sobre la cima. ┬íDeclarados culpables de querer repetir!',35.00,'Especiales','img/productos/prod_6ad17611d7aa4.jpg',0,'2026-10-16 06:55:45','2026-11-13 23:44:00'),(15,'Vac├¡o Inconmensurable','Una malteada hiper-cremosita de galleta Oreo con helado de vainilla, decorada con crema batida azul, polvo de estrellas comestible y un borde de jarabe de chocolate oscuro. Su sabor es tan intenso que detendr├í tus sentidos por un momento.',30.00,'Especiales','img/productos/prod_6ad1766806ab6.jpg',0,'2026-10-16 06:57:12','2026-11-13 23:42:50');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('5Kl9lINdzBy3UdDXZmC2JKDCCnXy59vQ2KQK1bfV',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTnpmWmhNQ3N0cURqZjhoaG93QmIxQmtIb0JEckRScTFyYTNYb2FqcSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQzOiJodHRwczovL2NhZmV0ZXJpYS1qamsuZHVja2Rucy5vcmcvY2FmZXRlcmlhIjtzOjU6InJvdXRlIjtzOjk6ImNhZmV0ZXJpYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjVmNzliMzk2MDM2Yzk3NWQ2YTY3Y2ZlZWNiYTRkNTIzODliYTk2MmFhZWU3ZTU3MWJlMGY5YTdhYWY5YWU4OTEiO30=',1795498786),('5sqaiva9a8dFrk91hZWykE8EMweJUUJxtyvqVtyb',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHdBbkp4a3lNU0l0NnZ5ZmxObUpkZ1R5R2lpTGJhSHgzRUJ2RUVuQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vY2FmZXRlcmlhLWpqay5kdWNrZG5zLm9yZyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794490203),('iCSp65HH8kqh6HrDogZG38b8Cnvwd4xphiYANoV7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmxvd3djeUxXdFdQTFFPQU5YVkdncEdkMnVVTzUzckQ5YjlHZGRqbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9lYXN5LXRveXMtZHJlYW0ubG9jYS5sdC9yZWdpc3RlciI7czo1OiJyb3V0ZSI7czo4OiJyZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794331680),('pLLwwXko2zYFVt0H4GDvkfYFI5v75H6zOQAX1eyF',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3NLMTJtYjZPSWZCN3ZwNG8wOVBNRG1sN3JucTdVcDJMNHNwbnVYQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3QvY2FmZXRlcmlhLWpqay9wdWJsaWMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792513927),('qd2JYbR45uGpUrA1XOuAMC0wuJ0ZIZWqDZzVSkWd',NULL,'127.0.0.1','Mediapartners-Google','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDI1Y1NqNUxZS3JkUnh5OGw0aWpJQ1ZCcHp1UndvQ0FZS3l4UWw5TCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9lYXN5LXRveXMtZHJlYW0ubG9jYS5sdCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1794331707),('TtOeTuusnUItTXQvB6ybocwl6dUZeTgNT49cFemY',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzdvakZWTE9rUWdhY2ZvRFdwVjlFR05QQzNDeTJpT2hhMENLUXlhWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3QvY2FmZXRlcmlhLWpqay9wdWJsaWMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1793985724),('ukJAUn7kzHNmu7kZMF37rU2ycYgDv1Yxr0nwjShd',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiejFkWjlqZ3dMcDdONm5GUFk4bDNrU1pMY0xkRVNad1htbnNyTEw3UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vY2FmZXRlcmlhLWpqay5kdWNrZG5zLm9yZy9hZG1pbi9wcm9kdWN0b3MiO3M6NToicm91dGUiO3M6MjE6ImFkbWluLnByb2R1Y3Rvcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjZkMTVhMzk5YjQyYzZkYTlmN2E2NTNkNzliNWYxYWUwMmI2MjQ1ZjVmNDMwZjEwMzEyNmY0MTUwMWFmYzlhMTQiO30=',1794591841),('y4avloEMYJYxHyEBqgCRFjbojIlgOe4sr8abKURC',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUdqRXJKUlVEd1BxZWZFOWpuRXQzWXVMQzFFRjJaSmZGdXBkZ2J2biI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3QvY2FmZXRlcmlhLWpqay9wdWJsaWMvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1793121356),('ylFN8TIYDdKiv1QFqmBp1imZzYndgMXtxm00pKpd',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkdNSVJLYWF4bWdidzdoeDR3N050emxUWEM5bkxBMGQzYmQyQW1nNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3QvY2FmZXRlcmlhLWpqay9wdWJsaWMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1794329747),('Yqr0gbJHWjWF5DN0oeXCKKRX54jFXNRTqUHMifVi',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3Q0aHRKYTlRbU50SXlTcUpYYkE0dHNqSmlzZGlTNFp1QkFqT1JBSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3QvY2FmZXRlcmlhLWpqay9wdWJsaWMiO3M6NToicm91dGUiO047fX0=',1792207461);
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
  `role` varchar(255) NOT NULL DEFAULT 'cliente',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sam','sam@gmail.com','admin',NULL,'$2y$12$cqk0N/71MQ9S0FpLVd1szuGXzphn0wnCW1sqIE2vEKh1Gy1APW.gO',NULL,'2026-10-15 07:47:07','2026-10-15 07:47:07'),(2,'Samantita Gasca','samantitag@gmail.com','cliente',NULL,'$2y$12$Gn2.QYZw64F66/TbLaDKIOSzQ17OuS2xmyrSwk4Qy5T1EZ5FU4P8a',NULL,'2026-10-15 08:10:50','2026-10-15 08:10:50'),(3,'Nadia','nadia@gmail.com','cliente',NULL,'$2y$12$EiQtUlL5YEUiZIgoJJzdzevaxxumiDPrcrXokgHO50.3.DAS2JZQK',NULL,'2026-10-15 21:57:50','2026-10-15 21:57:50');
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

-- Dump completed on 2026-11-25 15:53:20
