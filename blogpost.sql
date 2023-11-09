-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: blogpost
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Football','Football','2023-11-07 02:51:28','2023-11-07 02:51:28'),(2,'Travel','Travel','2023-11-07 02:51:54','2023-11-07 02:51:54'),(3,'Food','Food','2023-11-07 02:52:04','2023-11-07 02:52:04'),(4,'Lifestyle','Lifestyle','2023-11-07 02:52:22','2023-11-07 02:52:35'),(5,'Fashion','Fashion','2023-11-07 02:52:59','2023-11-07 02:52:59');
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
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_11_01_071853_create_roles_table',1),(6,'2023_11_01_072453_create_categories_table',1),(7,'2023_11_01_072641_create_posts_table',1),(8,'2023_11_01_073017_create_post_comments_table',1),(9,'2023_11_07_100507_edit_tbl_post',2),(10,'2023_11_07_164114_edit_tbl_postcomment',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `author_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_comments`
--

LOCK TABLES `post_comments` WRITE;
/*!40000 ALTER TABLE `post_comments` DISABLE KEYS */;
INSERT INTO `post_comments` VALUES (1,'we ewgwegwe weg wegwe gwegwegweg wegwegweg  wegweg wgwegweg  weg wegwe  vbwe gbwegew  gweg weg weg w weg we',2,3,NULL,NULL,NULL),(2,'we ewgwegwe weg wegwe gwegwegweg wegwegweg  wegweg wgwegweg  weg wegwe  vbwe gbwegew  gweg weg weg w weg we',2,3,NULL,NULL,NULL),(3,'we ewgwegwe weg wegwe gwegwegweg wegwegweg  wegweg wgwegweg  weg wegwe  vbwe gbwegew  gweg weg weg w weg we',2,3,NULL,NULL,NULL),(4,'qwfqwfqwf',2,3,NULL,'2023-11-08 02:24:42','2023-11-08 02:24:42'),(5,'asvasvasv',2,3,NULL,'2023-11-08 02:28:02','2023-11-08 02:28:02'),(6,'asvasvasvasv',2,3,NULL,'2023-11-08 02:29:26','2023-11-08 02:29:26'),(7,'qwfqwfqwf',2,1,NULL,'2023-11-08 02:32:07','2023-11-08 02:32:07'),(8,'qwfqwf',2,1,NULL,'2023-11-08 02:32:17','2023-11-08 02:32:17'),(9,'helloooo',2,1,NULL,'2023-11-08 02:37:52','2023-11-08 02:37:52'),(10,'ávasvasv',2,1,NULL,'2023-11-08 02:39:47','2023-11-08 02:39:47'),(11,'ávasvasvaaaa',2,1,NULL,'2023-11-08 02:39:50','2023-11-08 02:39:50'),(12,'qwfqwfqwf',2,1,NULL,'2023-11-08 02:40:13','2023-11-08 02:40:13'),(13,'qwfqwfqwf',2,3,NULL,'2023-11-08 02:43:30','2023-11-08 02:43:30'),(14,'asvasvasv',2,2,NULL,'2023-11-08 02:44:00','2023-11-08 02:44:00'),(15,'asdasd',2,2,NULL,'2023-11-08 02:44:21','2023-11-08 02:44:21'),(16,'âsasas',2,2,NULL,'2023-11-08 02:46:20','2023-11-08 02:46:20'),(17,'asvasvasv',2,2,NULL,'2023-11-08 02:48:21','2023-11-08 02:48:21'),(18,'aaaaa',2,2,NULL,'2023-11-08 02:49:09','2023-11-08 02:49:09'),(19,'asvasvasv',2,2,NULL,'2023-11-08 02:49:19','2023-11-08 02:49:19'),(20,'a',2,2,NULL,'2023-11-08 02:51:19','2023-11-08 02:51:19'),(21,'assaas',2,4,NULL,'2023-11-08 02:53:27','2023-11-08 02:53:27'),(22,'asas',2,4,NULL,'2023-11-08 02:58:51','2023-11-08 02:58:51'),(23,'âsfasf',2,4,NULL,'2023-11-08 03:00:33','2023-11-08 03:00:33'),(24,'qwfqwfqwf',9,1,NULL,'2023-11-08 03:16:53','2023-11-08 03:16:53'),(25,'aaaaa',8,1,NULL,'2023-11-08 03:17:12','2023-11-08 03:17:12');
/*!40000 ALTER TABLE `post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(2000) NOT NULL,
  `cover_path` varchar(200) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `author_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Những loài động vật lai kỳ lạ nhất thế giới','<p>Các loài lai giữa hai động vật là kết quả từ cả lai tạo trong môi trường nuôi nhốt và lai tự nhiên, từ sư hổ tới chó lai cáo.</p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-1-1699197166.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=bbkorlQTQpFflIyzUDW_Nw\"></p><p><strong>Loài khỉ bí ẩn ở Borneo</strong></p><p>Một con khỉ bí ẩn phát hiện ở Borneo là loài lai giữa khỉ vòi (<em>Nasalis larvatus</em>), nổi tiếng với chiếc mũi dài và voọc bạc (<em>Trachypithecus cristatus</em>). Loài khỉ lai ở Borneo đặc biệt hiếm bởi vì nó đến từ hai loài họ hàng xa không cùng chi. Cạnh tranh không gian trong rừng có thể là nguyên nhân phía sau sự lai tạo này. Môi trường sống thu hẹp thúc đẩy khỉ vòi đực tiếp quản những đàn voọc. Loài lai thường vô sinh, nhưng các nhà nghiên cứu nhận thấy con lai khỉ vòi - voọc dường như đang nuôi con nhỏ. Ảnh:&nbsp;<em>Nicole Lee</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-2-1699197167.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nWbUW0CewJl5CS_WFp8fUw\"></p><p><strong>Gấu pizzly</strong></p><p>Khi một con gấu Bắc Cực (<em>Ursus maritimus</em>) và một con gấu xám Bắc Mỹ (<em>Ursus arctos horribilis</em>) ghép đôi, chúng có thể tạo ra loài lai gọi là gấu \"pizzly\" hoặc \"grolar\". Dù gấu lai rất hiếm trong tự nhiên, loài lai pizzly đang bắt đầu lan rộng khắp Bắc Cực do biến đổi khí hậu. Gấu Bắc Cực đói mồi đang tiến xa hơn về phương nam để kiếm nhiều thức ăn hơn, trong khi thế giới ấm lên cho phép gấu xám thích nghi tốt mở rộng về phương bắc. Sự dịch chuyển dẫn tới nhiều tương tác hơn giữa hai loài và ghép đôi nhiều hơn. Ảnh:&nbsp;<em>Philippe Clement</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-3-1699197168.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=aZuZnidZVKf7rbOKSkuufg\"></p><p><strong>Loài lai họ mèo</strong></p><p>Con người tạo ra nhiều loài lai họ mèo nhờ lai tạo các loài khác nhau trong môi trường nuôi nhốt. Kết quả là những con lai kỳ lạ như sư hổ khổng lồ (lai sư tử - hổ) và pumapard nhỏ bé (lai sư tử núi - báo hoa mai).</p><p>Các chuyên gia bảo tồn lên án việc lai tạo có chủ đích là phi đạo đức và cho rằng loài lai không giúp ích cho nỗ lực bảo tồn động vật hoang dã. Tuy nhiên, điều đó chứng minh các loài mèo hoang dã khác nhau có thể lai tạo. Một nghiên cứu công bố năm 2016 trên tạp chí Genome Research tìm thấy bằng chứng về loài lai mèo cổ đại, có thể định hình sự tiến hóa của mèo hiện đại. Ảnh:&nbsp;<em>Giusparta</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-4-1699197169.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=qaCEHsy8fbuseayOtEFusw\"></p><p><strong>Chim manakin mũ miện vàng</strong></p><p>Chim manakin mũ miện vàng (<em>Lepidothrix vilasboasi</em>) là loài chim lai ở rừng mưa Amazon. Chúng sinh ra từ sự lai tạo giữa chim manakin mũ tuyết (<em>Lepidothrix nattereri</em>) và chim manakin mũ miện opal (<em>Lepidothrix iris</em>). Không giống các động vật lai khác, chim manakin mũ miện vàng có một quần thể ổn định. Nghiên cứu công bố năm 2017 trên tạp chí PNAS nhận dạng loài chim này và nhận thấy những dòng sông nhiều khả năng ngăn cách chúng với các loài chim bố mẹ. Ảnh:&nbsp;<em>Dysmorodrepanis</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-5-1699197169.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=0En2UNz3fjxdpwM0klDCWQ\"></p><p><strong>Dogxim</strong></p><p>Bác sĩ thú y ở miền nam Brazil không thể xác định họ đang chăm sóc một con chó hay cáo khi con vật đến điều trị năm 2021. Con vật có biệt danh \"dogxim\" chia sẻ những đặc điểm của cả chó nhà (<em>Canis lupus familiaris</em>) và cáo đồng cỏ Nam Mỹ (<em>Lycalopex gymnocercus</em>). Trên thực tế, đây là con lai đầu tiên giữa chó và cáo. Cáo đồng cỏ có quan hệ gần với chó hơn một số loài cáo khác như cáo đỏ (<em>Vulpes vulpes</em>). Tuy nhiên, các nhà nghiên cứu cho rằng đây là lần đầu tiên chó lai ghép với loài khác ngoài chi Canis. Ảnh:&nbsp;<em>Thales Renato Ochotorena</em>&nbsp;<em>de Freitas</em>&nbsp;&amp;&nbsp;<em>Bruna Elenara Szynwelski</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-6-1699197170.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=2KNdXJ6CiSvmcgnhgZe_TQ\"></p><p><strong>Narluga</strong></p><p>Vào thập niên 1980, một thợ săn Inuit bắt được 3 con cá voi kỳ lạ. Những con vật sở hữu vây trước giống cá voi trắng (<em>Delphinapterus leucas</em>), đuôi của kỳ lân biển (<em>Monodon monoceros</em>) và răng dường như pha trộn giữa hai loài. Thợ săn giữ lại hộp sọ từ một con vật và các nhà nghiên cứu sau này xác nhận đó là con lai đầu tiên giữa cá voi trắng và kỳ lân biển. Hai loài sinh sống ở nhiều khu vực trùng nhau tại Bắc Cực không vài năm. Dù chúng không thường ghép đôi, giới nghiên cứu từng tìm thấy một con kỳ lân biển đực sống giữa đàn cá voi trắng. Ảnh:&nbsp;<em>Markus Bühler</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-7-1699197171.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=3btxPot8oDSeUaxxjPknqQ\"></p><p><strong>Coywolf</strong></p><p>Cả chó sói, chó nhà và sói đồng cỏ đều có thể lai với nhau để tạo ra loài lai. Việc lai tạo luôn xảy ra trong môi trường nuôi nuốt dưới sự tác động của con người. Sói đồng cỏ phương đông thường được gọi là coywolf hoặc coydog do chúng lai với chó sói và chó nhà qua nhiều thế hệ trong quá khứ, khiến chúng to lớn hơn sói đồng cỏ phương tây nhưng nhỏ hơn chó sói. Ảnh:&nbsp;<em>Puffin\'s Pictures</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-8-1699197171.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Yu2-2GDfSOMGuORs4lPgiQ\"></p><p><strong>Sturddlefish</strong></p><p>Các nhà khoa học Hungary tình cờ tạo ra loài cá lai vào năm 2019 bằng cách lai cá tầm Nga vây nhọn (<em>Acipenser gueldenstaedtii</em>) và cá tầm thìa Mỹ mũi dài (<em>Polyodon spathula</em>). Hai loài không có tổ tiên chung trong 184 triệu năm và thậm chí không cùng họ. Vì vậy, nhóm nghiên cứu không hy vọng tạo ra con lai khi sử dụng tinh trùng của cá tầm thìa Mỹ để thúc đẩy sinh sản vô tính ở cá tầm thìa Nga. Điều khiến họ bất ngờ là tinh trùng cá tầm thìa kết hợp với hàng trăm trứng cá tầm, tạo ra loài lai \"sturddlefish\". Ảnh:&nbsp;<em>Genes 2020</em></p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/05/VNE-Ani-9-1699198294.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=QgVmTJRY_UpjGR4cqC6apw\"></p><p><strong>Wolphin</strong></p><p>Cá thể wolphin đầu tiên là con lai của cá voi sát thủ giả (<em>Pseudorca crassidens</em>) và cá heo mũi chai Đại Tây Dương (<em>Tursiops truncatus</em>) ở thủy cung Sea Life Park tại Hawaii. Từ sau đó, con người đã tạo một số con lai cá heo khác trong môi trường nuôi nhốt. Trong tự nhiên, giới nghiên cứu từng phát hiện con lai của cá voi đầu dưa (<em>Peponocephala electra</em>) và cá heo răng nhám (Steno bredanensis) ngoài khơi Hawaii năm 2017. Ảnh:&nbsp;<em>Barry King</em></p>','Các loài lai giữa hai động vật là kết quả từ cả lai tạo trong môi trường nuôi nhốt và lai tự nhiên, từ sư hổ tới chó lai cáo.','mP5oYsF4ZejPnCoI44HvTiED2x0OkaJRMwvdaGdZ.jpg',1,4,2,'2023-11-07 03:09:21','2023-11-07 03:10:55'),(2,'Chelsea đè bẹp Tottenham khi chơi hơn hai người','<p>Tottenham thua trận đầu tiên tại Ngoại hạng Anh mùa này trong thế chín người, với tỷ số 1-4 trước Chelsea ở trận muộn vòng 11.</p><p>Đội nhà thua đậm nhưng khán giả Tottenham vẫn đồng loại đứng dậy sau hiệu còi mãn cuộc, vỗ tay tán thưởng nỗ lực của Son Heung-min và đồng đội. Dù phải chơi với chín người trong phần lớn hiệp hai, chủ nhà vẫn đẩy cao đội hình mà không lùi về tử thủ. Còn Chelsea thắng đậm nhưng với hai bàn được ghi trong những phút bù hiệp hai.</p><p>Tiền đạo Nicolas Jackson lập hat-trick, nhưng bỏ lỡ nhiều cơ hội nguy hiểm hơn thế. Tuy nhiên HLV Mauricio Pochettino vẫn được hưởng niềm vui sau cùng, trong ngày tái ngộ đội bóng cũ. Còn với khán giả trung lập, trận derby London này sẽ khó quên.</p><p><img src=\"https://i1-thethao.vnecdn.net/2023/11/07/jackson-2-jpeg-1699310874-7255-1699311208.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=5DbfQTnOW_aTRlTDcwIjbA\" alt=\"Cầu thủ Chelsea mừng bàn của Jackson (giữa) vào lưới chủ nhà trên sân Tottenham Hotspur, thành phố London, vòng 11 Ngoại hạng Anh tối 6/11/2023. Ảnh: Reuters\"></p><p>Cầu thủ Chelsea mừng bàn của Jackson (giữa) vào lưới chủ nhà trên sân Tottenham Hotspur, thành phố London, vòng 11 Ngoại hạng Anh tối 6/11/2023. Ảnh:&nbsp;<em>Reuters</em></p><p>Hiệp một có nhiều tình tiết để nhắc tới, đặc biệt là khi trọng tài Michael Oliver thổi còi mãn hiệp khi đồng hồ chỉ sang phút 58. Với 12 phút bù, hai bàn thắng, ba bàn bị từ chối, năm thẻ vàng, một thẻ đỏ, ít nhất bảy lần VAR soi tình huống và ba lần chủ nhà phải thay người, hiệp đấu này đem lại nhiều cảm xúc bậc nhất mùa giải.</p><p>Bữa tiệc bắt đầu từ phút thứ sáu, khi Tottenham triển khai bóng ngắn từ sân nhà, để Malang Sarr mở biên phải cho Dejan Kulusevski. Tiền vệ người Thụy Điển ngoặt bóng vào trung lộ rồi sút chân trái trúng hậu vệ Colwill đổi hưởng về góc gần vào lưới, trong khi thủ môn Robert Sanchez đã đổ người về góc xa. Tottenham bay cao ở Ngoại hạng Anh và bàn thắng này càng giúp khán giả chủ nhà thêm phần hưng phấn.</p><p>HLV Ange Postecoglou chỉ đạo hàng thủ Tottenham dâng cao ở trận này, giúp đội nhà chơi tấn công nguy hiểm. Phút 15, tiền vệ trái Brennan Johnson chồng biên cho hậu vệ 21 tuổi Destiny Udogie dâng cao và căng ngang để Son Heung-min đệm sệt về góc xa vào lưới. Tuy nhiên bàn thắng của Son không được công nhận vì việt vị, và VAR cũng xác nhận điều này dù khoảng cách chỉ tính khoảng vài centimet.</p><p>Cứ khoảng vài phút, trận đấu lại có điểm nhấn. Đến phút 19, Udogie vào bóng bằng cả hai gầm giày, trúng bóng nhưng sượt qua chân Raheem Sterling. Trọng tài Oliver phạt Udogie thẻ vàng, còn VAR cũng xem xét tình huống nhưng không can thiệp. Theo&nbsp;<em>Guardian</em>, hậu vệ trẻ người Italy \"rất may mắn khi thoát thẻ đỏ\".</p><p>Ba phút sau, Thiago Silva đẩy sau khiến Cristian Romero ngã, nhưng trọng tài không thổi phạt. Romero trong lúc nằm sân, đá mạnh vào bắp chân của Colwill khiến hậu vệ này ngã xuống. Trọng tài vẫn không thổi còi, nên Chelsea tiếp tục phản công với pha rê dắt của Sterling vào cấm địa, rồi anh sút trúng tay thủ môn Guglielmo Vicario vào lưới.</p><p>Trọng tài ban đầu công nhận bàn, nhưng Sterling mừng không quá cuồng nhiệt bởi anh biết rõ đã để bóng chạm tay. Trước khi Sterling, hậu vệ Pedro Porro phá bóng trúng tay anh, nên tình huống này không qua nổi mắt của VAR. Tuy nhiên, các trọng tài lại không phạt thẻ Romero ở tình huống đó.&nbsp;<em>Guardian</em>&nbsp;ví pha phạm lỗi của Romero giống như David Beckham đã làm Diego Simeone tại vòng 1/8 World Cup 1998, nhưng khi đó tuyển thủ Anh phải nhận thẻ đỏ trực tiếp.</p><p>Romero dường như không kiềm chế được cảm xúc sau tình huống đó, tiếp tục chơi cẩu thả. Phút 30, Sterling rê bóng trong cấm địa rồi ngã xuống sau cú phá hụt của trung vệ Micky van de Ven. Bóng rơi ra và Romero lao tới phá bóng bằng lòng trong chân, nhưng gầm giày tiếp tục phi tới ống chân của đồng hương Enzo Fernandez. Bóng bay ra và lần này tiền vệ Moises Caicedo sút xa về góc thấp bên trái vào lưới, nhưng trọng tài phất cờ báo việt vị.</p><p>Bàn của Caicedo không được VAR công nhận, do Nicolas Jackson ở tư thế việt vị, nhảy lên tránh bóng và bị coi là can thiệp vào tình huống. VAR sau đó quay sang kiểm tra liệu Sterling bị phạm lỗi hay chưa, nhưng quay chậm cho thấy Ven chưa đá vào chân tiền đạo Chelsea. Cuối cùng, VAR kiểm tra liệu Romero đã phạm lỗi chưa, và đây là nguyên nhân khiến họ gọi trọng tài Oliver ra xem lại tình huống.</p><p>Oliver không mất nhiều thời gian để quyết định thổi phạt đền cho Chelsea, và rút thẻ đỏ trực tiếp truất quyền thi đấu của Romero. Qua 75 trận cho Tottenham, trung vệ Argentina đã nhận tới 23 thẻ vàng và bốn thẻ đỏ. Romero có thể coi là tội đồ của Tottenham trong trận này, dù anh chơi hay từ đầu mùa.</p><p><img src=\"https://i1-thethao.vnecdn.net/2023/11/07/romero-jpeg-2784-1699308135.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=nmiVhV-csKfHEB5u7-LgYw\" alt=\"Trọng tài Oliver rút thẻ đỏ, truất quyền thi đấu của Romero. Ảnh: Reuters\"></p><p>Trọng tài Oliver rút thẻ đỏ, truất quyền thi đấu của Romero. Ảnh:&nbsp;<em>Reuters</em></p><p>Trên chấm phạt đền, Cole Palmer sút về góc phải và thủ môn Vicario chạm được tay vào nhưng bóng vẫn trúng mép trong cột dọc vào lưới. Sau bàn này, các cầu thủ Chelsea giơ ngón trỏ lên trước miệng ám chỉ khán giả Tottenham hãy im lặng. Kể từ đó, thế trận đảo chiều khi chủ nhà chơi thiếu người.</p><p>HLV Postecoglou phẫn nộ với diễn biến trận đấu, nên phải nhận thẻ vàng. Ông còn đau đầu hơn khi tiền vệ sáng tạo James Maddison tự chấn thương bàn chân ở phút 42, sau đó đến lượt trung vệ Ven dường như bị rách cơ đùi mà không va vào ai. Cả hai cầu thủ này đều phải rời sân sau đó, và Ven thậm chí phải nhờ hai người dìu mới di chuyển được.</p><p>Hiệp đấu này sẽ còn được nhắc đến nhiều, khi đến phút cuối vẫn khó lường. Hậu vệ Reece James trong lúc nhảy lên tranh bóng bổng, thúc tay vào mặt Udogie, nhưng VAR không can thiệp tình huống này. Cựu hậu vệ kiêm bình luận viên Gary Neville ví tình huống này giống như&nbsp;<a href=\"https://vnexpress.net/vi-sao-var-khong-ke-vach-viet-vi-o-ban-thua-cua-arsenal-4673119.html\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(7, 109, 182);\">pha đánh khuỷu tay</a>&nbsp;của Bruno Guimaraes vào đầu Jorginho ở trận Newcastle gặp Arsenal một ngày trước.</p><p>HLV người Australia vẫn chỉ đạo Tottenham chơi với hàng thủ dâng cao trong hiệp hai, giúp đội khách tạo ra hàng tá cơ hội nguy hiểm. Hàng thủ chủ nhà càng mỏng hơn sau khi Udogie nhận thẻ vàng thứ hai ở phút 55. Chelsea phản công ba đánh hai, nhưng Sterling chuyền lỗi và lỡ thời cơ. Tuy nhiên, tiền đạo này cướp bóng nhanh hơn một nhịp trước khi Udogie lao vào chuồi và phạm lỗi. Trọng tài Oliver nhanh chóng rút thẻ vàng thứ hai cho Udogie, đồng nghĩa thẻ đỏ gián tiếp, khiến Tottenham chỉ còn chín người trên sân.</p><p><img src=\"https://i1-thethao.vnecdn.net/2023/11/07/tottenham-chelsea-jpeg-1699310-8195-4980-1699311208.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=O-IY3x_5pcTmI4o7jB-fYw\" alt=\"Hàng thủ Tottenham (áo trắng) dâng cao bẫy việt vị trong một tình huống bóng sống. Ảnh: chụp màn hình\"></p><p>Hàng thủ Tottenham (áo trắng) dâng cao bẫy việt vị trong một tình huống bóng sống. Ảnh:&nbsp;<em>chụp màn hình</em></p><p>Lợi thế chơi hai người quá lớn, nhưng Jackson, Sterling, Mykhailo Mudryk rồi đến Marc Cucurella phung phí những cơ hội đối mặt. Phải đến phút 75, Chelsea mới ghi bàn thứ hai, cũng từ tình huống phá bẫy việt vị. Lần này Sterling căng ngang từ bên phải đúng tầm cho Jackson đệm chân trái vào sát cột trái, nâng tỷ số lên 2-1 cho đội khách.</p><p>Tottenham đưa bóng vào lưới lần nữa, chỉ sau đó bốn phút, khi Eric Dier vô-lê một chạm ở cột hai. Tuy nhiên bàn thắng không được công nhận, bởi anh đã việt vị một khoảng cách nhỏ. Khán giả Tottenham mừng hụt, nhưng tiếp tục động viên cầu thủ chiến đấu.</p><p>Chủ nhà tiếp tục đẩy cao đội hình gây áp lực, nhưng biến thành con dao hai lưỡi. Ngay sau khi cú sút chìm chéo góc của Son bị thủ môn Sanchez đẩy ra, Chelsea phản công và lần này Mudryk phá bẫy việt vị trước khi căng ngang cho Jackson đệm vào lưới giống như bàn thứ hai của Chelsea. Son cắn áo tiếc nuối sau khi bỏ lỡ cơ hội trước đó.</p><p><img src=\"https://i1-thethao.vnecdn.net/2023/11/07/jackson-jpeg-2114-1699311208.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=ZRVRreEWChtygbHTqchI2g\" alt=\"Tiền đạo Nicolas Jackson đệm vào lưới ghi bàn ấn định thắng lợi 4-1 cho Chelsea. Ảnh: Guardian\"></p><p>Tiền đạo Nicolas Jackson đệm vào lưới ghi bàn ấn định thắng lợi 4-1 cho Chelsea. Ảnh:&nbsp;<em>Guardian</em></p><p>Trận đấu ngã ngũ ở phút bù thứ bảy hiệp hai, khi Palmer chuyền một chạm từ sân nhà lên xuyên qua hàng thủ Tottenham, để Jackson lao xuống lừa qua thủ môn rồi đệm vào lưới trống đơn giản, hoàn tất hat-trick. Sau bàn này, tiền đạo người Senegal nhảy xoay mừng bàn kiểu Cristiano Ronaldo, và khán đài cũng vang lên tiếng \"siuuu\" quen thuộc.</p><p>Thất bại này có thể không ảnh hưởng tới tinh thần của Tottenham, nhưng họ sẽ tổn thất lực lượng khi Romero vắng ba trận, còn Ven và Maddison chưa rõ khi nào trở lại. Điểm tích cực với Tottenham là sắp tới họ chỉ đấu mỗi tuần một trận, và hy vọng các trụ cột sẽ sớm trở lại.</p>','Tottenham thua trận đầu tiên tại Ngoại hạng Anh mùa này trong thế chín người, với tỷ số 1-4 trước Chelsea ở trận muộn vòng 11.','wLte8slyg2Xm9IJGwmern87wvutHkoVcKr376pBf.jpg',1,1,2,'2023-11-07 03:12:50','2023-11-07 08:31:11'),(3,'Khu nghỉ dưỡng Angsana & Dhawa Hồ Tràm được công nhận 5 sao','<p>Angsana và Dhawa Hồ Tràm được Tổng cục Du lịch công nhận đạt tiêu chuẩn 5 sao nhờ vị trí đắc địa cùng thiết kế và dịch vụ, tiện ích đẳng cấp.</p><p>Dự án tọa lạc trên cung đường ven biển Hồ Tràm - Bình Châu, cách TP HCM hai tiếng di chuyển. Tổ hợp nghỉ dưỡng được bao bọc giữa một bên là rừng nhiệt đới bạt ngàn, một bên là biển, mang đến cho du khách không gian nghỉ dưỡng đa dạng.</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/11/06/Hinh-1-1164-1699264481.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Huz8_zwNHdveske7vkpaHQ\" alt=\"Angsana &amp; Dhawa Hồ Tràm từ trên cao, được bao quanh bởi thiên nhiên rừng và biển\"></p><p>Angsana &amp; Dhawa Hồ Tràm từ trên cao, được bao quanh bởi rừng và biển. Ảnh:&nbsp;<em>Banyan Tree Group</em></p><p>Không gian nghỉ dưỡng phủ xanh là một trong những yếu tố quan trọng giúp Angsana &amp; Dhawa Hồ đạt tiêu chuẩn khách sạn 5 sao. Dự án đáp ứng các tiêu chuẩn công trình xanh, được chứng nhận bởi Earthcheck – tổ chức chứng nhận và tư vấn khoa học hàng đầu thế giới trong ngành du lịch (nguồn).</p><p>Không gian lưu trú tại Angsana &amp; Dhawa Hồ Tràm gồm 162 phòng khách sạn và 52 căn biệt thự nghỉ dưỡng. Chủ đầu tư bố trí nội ngoại thất cao cấp với thiết kế tôn vinh vẻ đẹp tự nhiên, giúp du khách hòa mình vào thiên nhiên.</p><p>Dự án được quản lý &amp; vận hành bởi Angsana và Dhawa- hai thương hiệu toàn cầu nổi tiếng của Banyan Tree Group. Lựa chọn đơn vị vận hành có năng lực quản lý đẳng cấp quốc tế là một trong những yếu tố bảo chứng cho chất lượng và giá trị của dự án.</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/11/06/Hinh-3-9234-1699264481.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=9fZnuK7kKEqAgybzWBcQzw\" alt=\"Bên trong biệt thự nghỉ dưỡng &amp; khách sạn 5 sao Angsana &amp; Dhawa Hồ Tràm.\"></p><p>Bên trong biệt thự nghỉ dưỡng &amp; khách sạn 5 sao Angsana &amp; Dhawa Hồ Tràm. Ảnh:&nbsp;<em>Banyan Tree Group</em></p><p>Du khách tới nghỉ dưỡng sẽ được chăm sóc tại Angsana Spa với những chuyên viên trị liệu được đào tạo chuẩn mực bởi các chuyên gia hàng đầu tại Banyan Tree. Nếu đam mê vận động, du khách không thể bỏ qua phòng tập thể dục Activa, trong khi các em nhỏ được khám phá Play Play Kids’ Club, sân chơi ngoài trời với sân gôn mini, tàu cướp biển và các trò chơi dưới nước. Bên cạnh đó là hệ thống ẩm thực phong phú tại nhà hàng biển Azura theo phong cách Địa Trung Hải, nhà hàng Nook với những món ăn bản địa và quốc tế đặc sản. Ngoài ra, phòng hội nghị sức chứa 300 người sẽ đáp ứng những nhu cầu hội họp của nhóm đối tượng khách hàng doanh nghiệp.</p><p>Một trong những trải nghiệm đắt giá tại Angsana &amp; Dhawa Hồ Tràm là biệt thự Stella Sky Suite tầm nhìn 360 độ, phong cách thượng lưu với tiệc hồ bơi trên không. Không gian phù hợp để tổ chức các sự kiện họp mặt riêng tư, lễ đính hôn, lễ cưới hay các hội nghị lãnh đạo cấp cao.</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/11/06/Hinh-5-4785-1699264481.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=wGlz_aC8fPNgV4_qXLJ7TA\" alt=\"Tiện ích nội khu bao gồm khu vực spa, nhà hàng biển theo tiêu chuẩn chất lượng 5 sao.\"></p><p>Tiện ích nội khu bao gồm khu vực spa, nhà hàng biển theo tiêu chuẩn chất lượng 5 sao. Ảnh:&nbsp;<em>Banyan Tree Group</em></p><p>Nhân sự kiện đạt chứng nhận tiêu chuẩn 5 sao, tổ hợp Angsana &amp; Dhawa Hồ Tràm ưu đãi giá phòng nghỉ lên tới 35% cùng nhiều hoạt động khác dành cho du khách.</p>','Angsana và Dhawa Hồ Tràm được Tổng cục Du lịch công nhận đạt tiêu chuẩn 5 sao nhờ vị trí đắc địa cùng thiết kế và dịch vụ, tiện ích đẳng cấp.','6EhK9FkVRmjs4GUYSuG09s3grezbjVZP6Cfr07Va.jpg',1,2,2,'2023-11-07 03:14:50','2023-11-07 03:14:50'),(4,'Hương vị cung đình của ẩm thực Huế','<p>Ẩm thực xứ Huế luôn đáp ứng các yêu cầu chế biến công phu, trình bày đẹp mắt và mang sự hài hòa trong hương vị.</p><p>Từ Đại Nội cổ kính đến những kiến trúc mang đậm tính biểu tượng văn hóa Việt, không gian xứ Huế như luôn mang lại cho du khách cảm xúc hoài niệm. Nét giao thoa giữa cảnh đẹp thiên nhiên, lịch sử văn hóa và sự nồng hậu của con người Huế được gói trọn trong hương vị ẩm thực nơi đây. Các món ăn Huế đa dạng từ phong cách cung đình cầu kỳ đến dân dã, mộc mạc.</p><p><br></p><p><img src=\"https://i1-dulich.vnecdn.net/2023/10/27/1-3837-1698401528.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=urVbu-LVlx1a5CCRYMZ1RQ\"></p><p><br></p><p>Cố đô Huế với phong cảnh hữu tình và bề dày văn hoá. Ảnh: Maggi</p><p>Với hơn 1.300 món ăn, Cố đô Huế được ví như kho tàng ẩm thực phong phú nhất Việt Nam. Những món ăn nơi đây không chỉ là nhu cầu hàng ngày, còn được người dân nâng tầm thành nghệ thuật.</p><p>Họ cầu kỳ trong cách bài trí món ăn, bởi bên cạnh ngon, món ăn còn cần đẹp, thơm và người thưởng thức sẽ dùng tất cả giác quan để tận hưởng. Ví dụ, một đĩa nem công - món ăn đứng đầu bát trân (8 món ăn dâng lên vua chúa) là biểu tượng của sự thanh nhã. Để làm được món ăn này hoàn hảo, nghệ nhân phải tỉ mỉ làm đầu chim phượng từ củ cải, cà rốt, rồi lại tạo thân chim công từ những cây nem.</p><p>Ngay cả một đĩa rau sống của người Huế cũng phải hài hoà về màu sắc, với cà chua đỏ rực như mặt trời, khế vàng hình ngôi sao, những lát vả thái hình trăng khuyết. Nét cầu kỳ của người con xứ Huế còn thể hiện trong dụng cụ ăn uống. Với họ, mỗi món phải có cách ăn thích hợp: ăn cơm hến phải dùng tô đất, chè hạt sen hay chè đậu ngự phải dùng chén sứ...</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/10/27/2-5763-1698401528.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=_sodni3Q6xVFbQgThkPGkg\"></p><p><br></p><p>Nem công là món ăn đứng đầu bát trân của cung đình Huế. Ảnh:&nbsp;</p><p>Bùi Thủy</p><p><br></p><p>Ngoài các món cung đình, những món dân dã cũng tạo nên nét khác biệt, cầu kỳ của ẩm thực Huế. Bún bò Huế là một trong những món ăn sáng khoái khẩu của hầu hết người dân và du khách đến đây. Món ăn này còn được đầu bếp Anthony Bourdain đánh giá là một trong những món ngon nhất thế giới. Bát bún bò đòi hỏi sự khéo léo và chăm chút của người nấu bếp. Người Huế nêm nếm gia vị món bún bò theo mùa. Mùa hè chỉ nêm muối nhạt, mùa đông sẽ mặn hơn để trung hòa giữa thời tiết và hương vị món ăn, mang đến trải nghiệm ẩm thực hoàn hảo nhất cho thực khách.</p><p>Bạn cũng có thể chọn cơm hến cho bữa ăn trưa - món ăn với tuổi đời hơn 200 năm và từng được nhà Nguyễn đưa vào danh sách các món ăn cung đình. Tuy được làm từ những nguyên liệu giản dị nhưng công đoạn chế biến của món cơm hến lại cầu kỳ. Đầu bếp phải đi bắt hến ở cồn Hến trên sông Hương, chuẩn bị tỉ mỉ ruốc thơm, rau sống, môn bạc hà, bắp chuối xắt mỏng, rau má, khế, rau thơm thái nhỏ và cơm nguội. Vì người Huế thích ăn cay nên một tô cơm Huế đúng vị phải cay \"trào nước mắt\". Đây cũng là điểm độc đáo trong phong cách thưởng thức ẩm thực của người dân nơi đây.</p><p>Khi các hàng quán đóng cửa, du khách tới Huế lại được thưởng thức cơm âm phủ. Tên gọi này bắt nguồn từ việc quán cơm thường mở vào lúc 0h, phục vụ các món bình dân cho người Huế.</p><p>Cơm âm phủ là sự kết hợp hài hòa của những thức ngon: thịt ram, giò lụa, nem chua, tôm, trứng tráng, rau thơm, dưa món... cùng cơm trắng và nước mắm tỏi ớt chua cay.</p><p>Một trong những lý do khiến món ăn này đặc sắc là do bàn tay khéo léo của người chế biến. Thịt ướp nướng trên than củi phải đảm bảo xém thơm bên ngoài nhưng mọng nước bên trong, tôm tươi được nêm đậm đà, trứng vịt béo ngậy tráng mỏng tang, cơm đơm vào bát không được nén. Đặc biệt, vị các món được nêm nếm vừa vặn, kết hợp rau thịt đủ màu, đủ vị xếp tỏa xung quanh. Thực khách có thể chế biến món ăn này tại nhà và nên nêm nếm bằng nước tương, hạt nêm, dầu hào Maggi.</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/10/27/3-3707-1698401528.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=oqF42XUdp5HC_uYElS5C8g\"></p><p><br></p><p>Bún bò Huế - đặc sản nổi tiếng vươn ra thế giới. Ảnh:&nbsp;</p><p>Maggi</p><p><br></p><p>Người Huế thường tráng miệng sau bữa ăn bằng chè. Trong đó, món chè hấp dẫn và lạ miệng hơn cả là chè bột lọc heo quay. Xưa kia, đây là một trong những món tiến cung với công thức bí truyền của dòng họ Công Tằng Tôn Nữ. Ngày nay, bất cứ ai cũng có thể thưởng thức món chè độc đáo với hương vị được hài hòa giữa mặn và ngọt, giữa vị dai của lớp vỏ bằng bột lọc và vị béo ngậy từ nhân thịt heo quay. Mỗi quán chè ở Huế luôn có trên dưới 20 loại khác nhau như bột lọc bọc dừa, bọc đậu phộng, xanh đánh, xanh hột, đậu ván đặc, ván nước, bông cau, đậu đỏ, đậu đen, đậu trắng, chè chuối, chè bưởi, đậu ngự, trái cây, chè khoai tía...</p><p>Các loại bánh cũng góp phần tạo nên sự phong phú cho ẩm thực Cố đô. Bánh nậm - một đặc sản lâu đời được làm từ bột gạo tráng mỏng, gói trong lá dong, ăn cùng chả tôm và nước mắm cay ngọt là thức quà phổ biến ở mảnh đất này. Hay bánh khoái Huế giòn rụm với hương vị riêng biệt, được đông đảo người dân và du khách phương xa ưa chuộng.</p><p>Danh sách các món bánh Huế nên thử không thể thiếu bánh bèo trứ danh. Món ăn này có mặt trong các dịp lễ, tết và cả trong bữa cơm hàng ngày, góp phần tạo nên nét đặc sắc trong văn hóa ẩm thực Cố đô. Bánh được đúc trong những chiếc chén nhỏ, ăn cùng tôm cháy, tóp mỡ, mỡ hành, hành phi và nước mắm ớt cay ngọt.</p><p>Cuối cùng là bánh bột lọc Huế chinh phục nhiều thực khách từ cái nhìn đầu tiên. Bánh trong suốt, dai sần sật, điểm xuyết bên trong là màu đỏ gạch của tôm cùng lát thịt ba chỉ thái nhỏ. Khi thưởng thức, du khách phải chấm bánh ngập trong nước mắm cay ngọt đặc trưng để thỏa mãn vị giác và mang lại hương vị thơm ngon.</p><p><img src=\"https://i1-dulich.vnecdn.net/2023/10/27/4-4700-1698401529.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=EGQV7Kiu2VVWjF0HxCOFkw\"></p><p><br></p><p>Các món bánh đường phố là thức quà đậm vị Huế khi du khách vi vu tới đây. Ảnh:&nbsp;</p><p>Maggi</p><p><br></p><p>Trải qua nhiều thế kỷ, ẩm thực xứ Huế liên tục được tích lũy, duy trì và phát huy, trở thành một phần di sản của vùng đất Cố đô, bên cạnh những công trình kiến trúc nguy nga và phong cảnh thiên nhiên trữ tình.</p>','Ẩm thực xứ Huế luôn đáp ứng các yêu cầu chế biến công phu, trình bày đẹp mắt và mang sự hài hòa trong hương vị.','teAJJk2WWDReqabrwdLR3YeiuYOvGz4bDmjwnnQK.png',1,3,2,'2023-11-07 03:16:12','2023-11-07 03:16:12'),(5,'4 suy nghĩ sai lầm không thể thoát nghèo','<p>Nghèo khó về tài chính không đáng sợ bằng nghèo khó trong tư duy. Nếu còn giữ mãi những suy nghĩ này sẽ khó thoát khỏi bế tắc trong cuộc sống.</p><p>Dưới đây là 4 suy nghĩ sai lầm mà nhiều người mắc phải, khiến bản thân khó có thể thành công và thoát nghèo.</p><p><img src=\"https://i1-giadinh.vnecdn.net/2023/11/05/anh-minh-hoa-3846-1699153449.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=QhJzSO7g8AqQGvOU3qYnxA\" alt=\"Ảnh minh họa: xueqi\"></p><p>Ảnh minh họa:&nbsp;<em>xueqi</em></p><p><strong>Làm việc chăm chỉ là con đường duy nhất trở nên giàu có</strong></p><p>Từ khi còn nhỏ, ai cũng được dạy phải làm việc chăm chỉ mới đạt được thành công. Nhưng thực tế, \"làm việc chăm chỉ\" chưa bao giờ là đủ để đạt được ước mơ làm giàu.</p><p>Triệu phú tự thân, nhà sáng lập và giám đốc điều hành của VaynerMedia - Gary Vaynerchuk từng nói: \"Nếu tất cả những gì bạn làm cả đời là chăm chỉ làm việc, bạn sẽ không bao giờ trở nên giàu có được. Bởi làm việc chăm chỉ chưa đủ để bạn kiếm tiền và tiết kiệm\". Theo ông, ngoài chăm chỉ còn cần nhiều yếu tố khác để thành công như cơ hội, sự đổi mới, sáng tạo hay các mối quan hệ...</p><p>Dù chăm chỉ làm việc nhưng nếu không có tư duy đổi mới sáng tạo, không có tinh thần học hỏi và khả năng giao tiếp thì chỉ làm công ăn lương bình thường. Ngoài ra, nếu không biết phát triển các mối quan hệ, cả đời cũng sẽ tụt lùi lại phía sau.</p><p>Thực tế, hiệu quả lao động cũng chất lượng công việc không phụ thuộc vào thời gian làm việc. Những người thành công và giàu có luôn cân bằng giữa cuộc sống và công việc. Họ tận dụng từng giây từng phút để nâng cao hiệu quả công việc, chăm sóc bản thân và mở rộng giao lưu, học hỏi thêm những kiến thức mới. Rõ ràng, bên cạnh sự cố gắng và chăm chỉ, còn rất nhiều yếu tố khác quyết định đến thành công của mỗi người.</p><p><strong>Chỉ người có trình độ học vấn cao mới tìm được công việc ổn định</strong></p><p>Theo quan niệm truyền thống, nhiều người vẫn cho rằng chỉ khi có bằng cấp hay trình độ học vấn mới có thể tìm được công việc tốt.</p><p>Tuy nhiên, với sự phát triển của xã hội, nhu cầu của các công ty, doanh nghiệp đối với nhân tài không chỉ là một tấm bằng tốt nghiệp. Quan trọng hơn cả, họ cần năng lực \"thực chiến\" của con người. So với tài năng thực sự và kinh nghiệm thực tế, bằng cấp chỉ là một tờ giấy.</p><p>Bằng cấp không có lỗi, lỗi là nhiều người nhận thức sai lầm chỉ cần bằng cấp là đủ để xin việc làm. Thực chất bằng cấp giống như một tấm vé vào cửa để bạn bước vào cuộc sống trưởng thành hơn, mà không có quyền năng đặc biệt đủ để có chỗ đứng trong xã hội. Khi vào đời, chẳng mấy ai nhớ tới \"tấm vé\" bằng cấp mà chính kiến thức, kỹ năng mềm mới là hành trang theo mỗi người tới suốt sự nghiệp. Do đó, luôn cần biết mình là ai, năng lực thế nào để chọn nghề phù hợp.</p><p><strong>Nhiều của cải sẽ khiến con người có suy nghĩ sai lệch</strong></p><p>Steve Siebold - tác giả của cuốn sách \"Người giàu nghĩ thế nào\" cho hay, người nghèo luôn nghĩ rằng người giàu là những kẻ kiêu căng, bởi vậy người giàu chỉ muốn kết giao với những người có tư tưởng giống mình. Người giàu không thể hiểu được thông điệp của sự bất hạnh và não nề, khi mà số đông lại xem đây là biểu hiện của thói hợm hĩnh.</p><p>Thực tế tư cách cũng như đạo đức của một người không được quyết định bởi việc họ có nhiều tiền hay không. Đa số người thành công, giàu có, có khối tài sản kếch xù vẫn luôn khiêm tốn. Họ dùng chính tài sản của mình để giúp đỡ người khác và cống hiến cho xã hội. Bởi vậy, không phải sự giàu có sẽ làm \"biến chất\" con người, mà sẽ giúp con người nâng cao hiểu biết, sử dụng của cải hiệu quả và ý nghĩa.</p><p><strong>Nói về tiền bạc sẽ làm tổn thương cảm xúc</strong></p><p>\"Đề cập tới tiền bạc\" là xu hướng nhiều người thường tránh né trong mọi mối quan hệ. Họ cho rằng, nhắc đến tiền sẽ khiến các mối quan hệ xa cách, bị tổn hại, thậm chí tan vỡ. Nhưng thực tế, tiền bạc rất quan trọng trong đời sống cũng như mọi mối quan hệ xã hội. Tiền không phân tốt hay xấu, ngược lại cách người ta dùng tiền mới khiến nó trở thành tốt hay xấu. Bàn về tiền một cách tự nhiên, nghiêm túc, rõ ràng, sòng phẳng, sẽ tốt cho cả hai bên. Thẳng thắn nhắc đến tiền càng dễ hòa hợp hơn là ngại ngùng.</p><p>Bởi vậy dù ở mối quan hệ nào, không cần ngại ngùng khi nhắc tới tiền. Thông qua đó, hai bên có thể thấu hiểu nhau về quan điểm cũng như mong muốn. Từ đó nâng cao sự hiểu biết, tạo sự tin tưởng hơn trong các mối quan hệ.</p>','Nghèo khó về tài chính không đáng sợ bằng nghèo khó trong tư duy. Nếu còn giữ mãi những suy nghĩ này sẽ khó thoát khỏi bế tắc trong cuộc sống.','HAaYPqAG0er9KNxepaL6v14opHMB7vRhUyC96HDR.jpg',1,4,2,'2023-11-07 03:17:17','2023-11-07 03:17:17'),(9,'Thủ lĩnh Hamas - người qua mặt Israel suốt ba thập kỷ','<p>Thủ lĩnh Hamas Sinwar từng bị Israel kết án tù, nhưng đã qua mặt tình báo nước này để được trả tự do và âm thầm lên kế hoạch tấn công.</p><p>Năm 1988, lực lượng Israel bắt Yahya Sinwar với cáo buộc tham gia vào các vụ sát hại binh sĩ Israel và người Palestine cộng tác với họ. Tòa án quân sự Israel tuyên Sinwar án chung thân tại một nhà tù nghiêm ngặt, khiến thành viên nhóm Hamas này gần như không còn cơ hội được tự do.</p><p>Phản ứng của Sinwar là học tiếng Do Thái. \"Ông ta đã đọc tất cả sách về những người Israel nổi tiếng như Vladimir Jabotinsky, Menachem Begin và Yitzhak Rabin. Ông ta nghiên cứu mọi thứ về chúng tôi\", Micha Kobi, thành viên cơ quan tình báo Shin Bet từng tham gia thẩm vấn Sinwar, nói.</p><p>Sau khi ngồi tù 15 năm, Sinwar đã có thể nói thành thạo tiếng Do Thái trong cuộc phỏng vấn trên truyền hình Israel. Thay vì chiến tranh, ông kêu gọi công chúng Israel ủng hộ lệnh ngừng bắn với Hamas.</p><p>\"Chúng tôi biết Israel có 200 đầu đạn hạt nhân và có lực lượng không quân hiện đại nhất khu vực. Chúng tôi biết mình không có khả năng phá hủy Israel\", Sinwar nói trong cuộc phỏng vấn.</p><p>Tuy nhiên, người đàn ông 61 tuổi này hiện là kẻ bị truy nã gắt gao nhất của Israel và bị Thủ tướng Israel Benjamin Netanyahu mô tả ông là \"cá nằm trên thớt\". Từ một tù nhân thụ án chung thân, Sinwar trở thành thủ lĩnh Hamas ở Dải Gaza và được coi là người chịu trách nhiệm lớn nhất về cuộc đột kích ngày 7/10 khiến khoảng 1.400 người thiệt mạng ở Israel.</p><p>Loại bỏ Sinwar là mục tiêu chính của chiến dịch \"phá hủy\" Hamas mà Israel đang tiến hành. Quan chức ở Gaza cho biết ít nhất 9.770 người thiệt mạng và 26.000 người bị thương kể từ khi Tel Aviv tiến hành chiến dịch đáp trả Hamas.</p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/06/2023-04-14T182332Z-2118100606-3316-7953-1699246038.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=48GsHsIK7OGUF6OYsqqn6w\" alt=\"Thủ lĩnh Hamas Yahya Sinwar tại lễ kỷ niệm Ngày Quốc tế Quds ở Dải Gaza ngày 14/4. Ảnh: Reuters\"></p><p>Thủ lĩnh Hamas Yahya Sinwar tại lễ kỷ niệm Ngày Quốc tế Quds ở Dải Gaza ngày 14/4. Ảnh:&nbsp;<em>Reuters</em></p><p>Trước cuộc đột kích của Hamas,&nbsp;<a href=\"https://vnexpress.net/chu-de/israel-2396\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(7, 109, 182);\">Israel</a>&nbsp;đã có gần 40 năm kinh nghiệm đối phó với Sinwar, người đàn ông có thân hình gầy gò và mái tóc cắt ngắn. Tuy nhiên, lực lượng an ninh Israel đã bị ru ngủ trong cảm giác tự mãn sai lầm dựa trên những hiểu biết đó.</p><p>Trước thềm xung đột, Israel xem Sinwar là kẻ cực đoan nguy hiểm nhưng vẫn có thể đàm phán, người quan tâm củng cố năng lực cai trị của Hamas ở Gaza và muốn phát triển kinh tế hơn là phá hủy nhà nước Do Thái. Nhận định sai lầm này là khởi đầu cho thất bại tình báo lớn nhất của Israel. Đối với nhiều người Israel, Sinwar đã đánh lừa họ suốt hơn ba thập kỷ.</p><p>\"Chúng tôi không hiểu chút gì về ông ta. Hoàn toàn không\", Michael Milstein, cựu sĩ quan tình báo quân sự Israel và hiện là chuyên gia về các vấn đề Palestine, nói.</p><p>Ấn tượng về Sinwar mà một số người từng tiếp xúc với ông suốt nhiều thập kỷ vẽ ra cho thấy đây là người đàn ông ít nói, nhanh nhạy và có tư chất chỉ huy.</p><p>Kobi nhớ lại cuộc thẩm vấn Sinwar năm 1989. Đó là giai đoạn đỉnh điểm của phong trào nổi dậy chống Israel (intifada) lần thứ nhất của người Palestine. Kobi là sĩ quan Shin Bet chuyên săn lùng các thành viên Hamas, khi đó mới là nhóm vũ trang nhỏ đang nổi lên ở Gaza.</p><p>Sinwar, người còn được biết đến với tên gọi Abu Ibrahim, là thành viên nhánh chính trị của Hamas, nhưng cũng tham gia xây dựng nhánh vũ trang Lữ đoàn Qassam từ những ngày đầu. Lữ đoàn Qassam có nhiệm vụ săn lùng những người Palestine bị nghi cộng tác với Israel và hoạt động này đã khiến Sinwar bị bắt.</p><p>Kobi nói Sinwar từng đề cập đến hình phạt mà Lữ đoàn Qassam áp dụng với một đặc tình. Sinwar đã triệu tập anh trai người này, là thành viên Hamas, và bắt anh ta chôn sống em trai bằng một chiếc thìa.</p><p>Sau khi bị bắt, Sinwar phát huy khả năng lãnh đạo của mình và trở thành người đứng đầu nhóm tù nhân Hamas trong nhà tù Israel. Năm 2004, ông từng trải qua cuộc phẫu thuật ổ áp xe gần não, theo quan chức Israel.</p><p>Đánh giá tình báo về Sinwar của Israel trong thời gian ở tù đã chỉ ra ông là người \"tàn nhẫn, có ảnh hưởng và quyền lực, có khả năng chịu đựng phi thường, xảo quyệt, giữ bí mật và có tố chất lãnh đạo\".</p><p>Tin rằng Sinwar không còn là mối đe dọa lớn sau 22 năm ngồi tù, Israel năm 2011 đồng ý thả ông này cùng khoảng 1.000 người Palestine để đổi tự do cho binh sĩ Israel Gilad Shalit, người bị Hamas giam ở Gaza.</p><p>\"Bất cứ ai ra đưa tên Sinwar vào danh sách những người cần được trả tự do để trao đổi binh sĩ Shalit đều biết rằng ông ta là tù nhân có giá trị rất lớn\", Joe Truzman, chuyên gia tại Quỹ Bảo vệ Dân chủ ở Mỹ, nhận định.</p><p>6 năm sau khi ra tù, Sinwar được bầu làm lãnh đạo Hamas, thay thế Ismail Haniyeh, người trở thành lãnh đạo chính trị của nhóm và chuyển tới Qatar.</p><p>Dưới sự lãnh đạo ông, Hamas thay đổi chính sách, giảm bớt sử dụng vũ lực để thúc đẩy Israel tham gia các cuộc đàm phán gián tiếp qua trung gian Ai Cập, Qatar và Liên Hợp Quốc. Israel những năm gần đây trao nhiều nhượng bộ đáng kể cho Gaza, như cho phép Qatar hỗ trợ tài chính và cấp hàng nghìn giấy phép lao động ở Israel. Nhưng trong vài năm qua, Hamas đã âm thầm chuẩn bị cho chiến dịch tấn công Israel.</p><p>Những người biết Sinwar nói rằng sự trỗi dậy của ông trong nhóm Hamas chủ yếu dựa vào cách làm việc quyết liệt, không nương tay, khiến ngay cả những người đứng đầu của Hamas cũng phải e sợ.</p><p>\"Họ sợ ông ta. Không ai trong số họ dám phản đối quyết định thực hiện vụ tấn công ngày 7/10. Đó là một chiến dịch hoàn hảo nhưng để lại hậu quả khủng khiếp\", một người có nhiều năm tiếp xúc trực tiếp với Sinwar nói.</p><p><img src=\"https://i1-vnexpress.vnecdn.net/2023/11/06/33ZU4XP-highres-8961-1699246038.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=pxaah0mTO7wRb1AFtw76qQ\" alt=\"Binh sĩ và xe tăng Israel tại một địa điểm ở miền bắc Dải Gaza trong hình ảnh được quân đội nước này công bố ngày 5/11. Ảnh: AFP\"></p><p>Binh sĩ và xe tăng Israel tại một địa điểm ở miền bắc Dải Gaza trong hình ảnh được quân đội nước này công bố ngày 5/11. Ảnh:&nbsp;<em>AFP</em></p><p>Động cơ của Sinwar khi tiến hành cuộc&nbsp;<a href=\"https://vnexpress.net/nhung-tai-lieu-he-lo-cach-hamas-len-ke-hoach-dot-kich-israel-4664525.html\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(7, 109, 182);\">đột kích</a>&nbsp;ngày 7/10 hiện là câu hỏi chưa có lời đáp.</p><p>\"Ông ấy không phải người chấp nhận nhún nhường. Ông ấy có cái tôi lớn và xem bản thân đang thực hiện sứ mệnh. Ông ấy không quan tâm đến chuyện hy sinh hàng chục nghìn mạng người hay thậm chí nhiều hơn để đạt được mục tiêu của mình\", một người quen của Sinwar nói.</p><p>Năm 2021, Sinwar cần một phiếu bầu trong cuộc bầu cử nội bộ của Hamas để giữ vững vị trí. Vài tháng sau, Israel và Hamas có cuộc giao tranh 11 ngày. Sinwar sau đó ngồi trên chiếc ghế giữa đống đổ nát tại nơi từng là nhà của ông và tuyên bố chiến thắng.</p><p>Trong năm qua, một quan chức Israel có quan hệ thân thiết với&nbsp;<a href=\"https://vnexpress.net/chu-de/dai-gaza-6809\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(7, 109, 182);\">Gaza</a>&nbsp;đã tới lãnh thổ này nhiều lần để đàm phán với Hamas. Ông thường xuyên gặp Sinwar và khẳng định hai bên \"có sự tôn trọng nhau\".</p><p>Tuy nhiên, trong chuyến thăm Gaza cuối cùng của quan chức này hồi đầu năm nay, Sinwar \"hoàn toàn biến mất\". Người này nói \"có những dấu hiệu chúng tôi đáng lẽ nên để ý. Ngoại giao chỉ là lớp vỏ bọc cho âm mưu quân sự\".</p><p>Song đánh giá chính thức của Israel cho rằng Hamas do Sinwar lãnh đạo đã không còn quan tâm tới ý định phát động chiến tranh và giờ tập trung vào việc đạt thỏa thuận với Tel Aviv.</p><p>Theo tình báo Israel, cuộc tấn công của Hamas đòi hỏi ít nhất một năm lên kế hoạch. Quan chức và giới phân tích của Israel giờ khẳng định thái độ hòa hoãn của Sinwar thực chất chỉ là chiêu trò câu giờ.</p><p>\"Chúng tôi cần đối mặt với thực tế rằng ông ấy luôn nung nấu hận thù, muốn tàn sát và hủy diệt Israel\", Milstein, sĩ quan tình báo quân sự Israel, nói.</p><p>Gaza đang đối mặt cuộc tấn công dữ dội với Sinwar là mục tiêu chính. Song một Israel bị sỉ nhục và số phận khu vực bấp bênh có thể đủ được xem là chiến thắng với Sinwar. \"Ông ta sẽ không đầu hàng. Ông ta sẽ chết ở Gaza\", Kobi nói.</p>','Thủ lĩnh Hamas Sinwar từng bị Israel kết án tù, nhưng đã qua mặt tình báo nước này để được trả tự do và âm thầm lên kế hoạch tấn công.','9Pm7HhrmCPWvrzOoAVJRrmHHlVZ2Ka7RS3EvWMAo.jpg',1,5,2,'2023-11-07 03:43:02','2023-11-07 03:43:02');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin',NULL,NULL),(2,'Customer',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `birth_day` datetime DEFAULT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Admin','admin','admin@email.com',NULL,'$2y$12$3AX8l/Q134HfaesoUyUn8.DeOi/cd0FNKbEcRH550QfshSPOHSRZK','123457890','Can Tho',0,'lo3x6QuTDrNP10CEtfe2u87lIslJbEGlLhGpBgJe.jpg','1969-12-30 00:00:00',1,NULL,NULL,'2023-11-08 07:22:19'),(8,'test','test','test@gmail.com',NULL,'$2y$12$bb0GrT0p29qb3kO4DLfhNeaXXahlcgpkJr.okIU9rfwoGzIN1UN62','112312312311','can tho',0,'7yqoJ58VwOoOy6IyKIMnygH4wEWr4B333qn6IqPs.jpg','2023-10-29 00:00:00',1,NULL,'2023-11-07 02:51:14','2023-11-07 02:51:14'),(9,'Test','test2','test2@gmail.com',NULL,'$2y$12$okIAlzorgR/szpt33i8keOAZgNs1y4uOWYdlzBX.G4UIwP9A0uhNG','1231231231',NULL,NULL,NULL,NULL,2,NULL,'2023-11-07 03:46:13','2023-11-07 03:46:13'),(10,'Testtt','test3','test3@gmail.com',NULL,'$2y$12$YfuFyJfC.1ORtZrAJzq0Xu58fK4saTcLGaoBqt9xs30nvj11mVQcC','12312312311','can tho',0,'rz7el1xPNeNXQuGWQ6mVsK7jwUmdBeWeiNujr4qy.jpg','2023-11-02 00:00:00',1,NULL,'2023-11-07 07:30:40','2023-11-07 07:30:40');
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

-- Dump completed on 2023-11-08 15:07:57
