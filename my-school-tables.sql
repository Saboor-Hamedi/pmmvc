-- MariaDB dump 10.19-11.1.0-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: school
-- ------------------------------------------------------
-- Server version	11.1.0-MariaDB

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
-- Table structure for table `all_grades`
--

DROP TABLE IF EXISTS `all_grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `grades` tinyint(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_grades`
--

LOCK TABLES `all_grades` WRITE;
/*!40000 ALTER TABLE `all_grades` DISABLE KEYS */;
INSERT INTO `all_grades` VALUES
(1,'1 A',1,'2023-08-11 14:20:04'),
(2,'2 A',2,'2023-08-11 14:20:04'),
(3,'4 D',4,'2023-08-15 12:51:50'),
(4,'5 C',5,'2023-08-15 12:51:50');
/*!40000 ALTER TABLE `all_grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `subject_names` varchar(100) NOT NULL,
  `start_class` timestamp NULL DEFAULT current_timestamp(),
  `end_class` timestamp NULL DEFAULT current_timestamp(),
  `grades` tinyint(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES
(6,4,13,'Computer Science','2023-08-17 05:44:00','2023-08-17 05:44:00',5),
(7,4,2,'Business Administration','2023-08-19 09:09:00','2023-08-19 09:09:00',1),
(8,4,2,'Early Childhood Education','2023-08-19 09:09:00','2023-08-19 09:09:00',1),
(9,4,2,'Special Education','2023-08-19 09:09:00','2023-08-19 09:09:00',1),
(10,4,13,'Special Education','2023-08-19 09:09:00','2023-08-19 09:09:00',2),
(11,4,13,'Geography','2023-08-19 09:09:00','2023-08-19 09:09:00',2),
(12,8,2,'Business Administration','2023-09-20 06:02:00','2023-08-20 06:02:00',1);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES
(1,1,1,'author 1 said: I think this post is very well-written.','2023-07-16'),
(2,11,1,'someone 1 said: I disagree with the author\'s point of view.','2023-07-16'),
(3,2,2,'user 2 said: This post was very informative.','2023-07-16'),
(4,12,2,'user 2 said: I think this post is very well-written.','2023-07-16'),
(5,3,4,'author 4 said: I really enjoyed this post!','2023-07-16'),
(6,13,4,'someone 4 said: This post was very informative.','2023-07-16'),
(7,4,5,'user 5 said: This post was very informative.','2023-07-16'),
(8,14,5,'someone 5 said: I disagree with the author\'s point of view.','2023-07-16'),
(9,5,6,'someone 6 said: I disagree with the author\'s point of view.','2023-07-16'),
(10,15,6,'user 6 said: I disagree with the author\'s point of view.','2023-07-16'),
(11,6,7,'someone 7 said: I really enjoyed this post!','2023-07-16'),
(12,16,7,'author 7 said: I have a few questions about this post.','2023-07-16'),
(13,7,8,'user 8 said: I think this post is very well-written.','2023-07-16'),
(14,17,8,'author 8 said: I disagree with the author\'s point of view.','2023-07-16'),
(15,8,9,'user 9 said: I disagree with the author\'s point of view.','2023-07-16'),
(16,18,9,'author 9 said: I have a few questions about this post.','2023-07-16'),
(17,9,10,'user 10 said: I think this post is very well-written.','2023-07-16'),
(18,19,10,'author 10 said: I disagree with the author\'s point of view.','2023-07-16'),
(19,10,11,'user 11 said: I think this post is very well-written.','2023-07-16'),
(20,20,11,'someone 11 said: I disagree with the author\'s point of view.','2023-07-16');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrollment_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(1,1,'Post by Author 1','This is a post by author 1','2023-07-16'),
(2,2,'Post by Author 2','This is a post by author 2','2023-07-16'),
(3,4,'Post by Author 4','This is a post by author 4','2023-07-16'),
(4,5,'Post by Author 5','This is a post by author 5','2023-07-16'),
(5,6,'Post by Author 6','This is a post by author 6','2023-07-16'),
(6,7,'Post by Author 7','This is a post by author 7','2023-07-16'),
(7,8,'Post by Author 8','This is a post by author 8','2023-07-16'),
(8,9,'Post by Author 9','This is a post by author 9','2023-07-16'),
(9,10,'Post by Author 10','This is a post by author 10','2023-07-16'),
(10,11,'Post by Author 11','This is a post by author 11','2023-07-16'),
(11,1,'Post by Author 1','This is a post by author 1','2023-07-16'),
(12,2,'Post by Author 2','This is a post by author 2','2023-07-16'),
(13,4,'Post by Author 4','This is a post by author 4','2023-07-16'),
(14,5,'Post by Author 5','This is a post by author 5','2023-07-16'),
(15,6,'Post by Author 6','This is a post by author 6','2023-07-16'),
(16,7,'Post by Author 7','This is a post by author 7','2023-07-16'),
(17,8,'Post by Author 8','This is a post by author 8','2023-07-16'),
(18,9,'Post by Author 9','This is a post by author 9','2023-07-16'),
(19,10,'Post by Author 10','This is a post by author 10','2023-07-16'),
(20,11,'Post by Author 11','This is a post by author 11','2023-07-16');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(13) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES
(2,12,'Mike','male','mike@gmail.com',89333333),
(3,13,'update','male','update@gmail.com',7902345243),
(10,2,'asdfasdf','male','asdfasf@gmail.com',333333333333333333);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `entrol` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `start_class` timestamp NULL DEFAULT current_timestamp(),
  `end_class` timestamp NULL DEFAULT current_timestamp(),
  `grades` varchar(10) DEFAULT '0-A',
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects_repositories`
--

DROP TABLE IF EXISTS `subjects_repositories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects_repositories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects_repositories`
--

LOCK TABLES `subjects_repositories` WRITE;
/*!40000 ALTER TABLE `subjects_repositories` DISABLE KEYS */;
INSERT INTO `subjects_repositories` VALUES
(1,'Science','2023-07-18 06:16:24'),
(2,'Social Work','2023-07-18 06:16:24'),
(3,'Information Technology','2023-07-18 06:16:24'),
(4,'Economics','2023-07-18 06:16:24'),
(5,'Home Economics','2023-07-18 06:16:24'),
(6,'Business Administration','2023-07-18 06:16:24'),
(7,'Physical Education','2023-07-18 06:16:24'),
(8,'Government','2023-07-18 06:16:24'),
(9,'Sociology','2023-07-18 06:16:24'),
(10,'Art','2023-07-18 06:16:24'),
(11,'Chemistry','2023-07-18 06:16:24'),
(12,'Media Studies','2023-07-18 06:16:24'),
(13,'Engineering','2023-07-18 06:16:24'),
(14,'Health','2023-07-18 06:16:24'),
(15,'Business Administration','2023-07-18 06:16:24'),
(16,'History','2023-07-18 06:16:24'),
(17,'Computer Science','2023-07-18 06:16:24'),
(18,'Early Childhood Education','2023-07-18 06:16:24'),
(19,'Biology','2023-07-18 06:16:24'),
(20,'Nursing','2023-07-18 06:16:24'),
(21,'Computer Science','2023-07-18 06:16:24'),
(22,'Social Work','2023-07-18 06:16:24'),
(23,'Chemistry','2023-07-18 06:16:24'),
(24,'Philosophy','2023-07-18 06:16:24'),
(25,'History','2023-07-18 06:16:24'),
(26,'Foreign Languages','2023-07-18 06:16:24'),
(27,'Environmental Science','2023-07-18 06:16:24'),
(28,'Engineering','2023-07-18 06:16:24'),
(29,'Drama','2023-07-18 06:16:24'),
(30,'Marketing','2023-07-18 06:16:24'),
(31,'Sociology','2023-07-18 06:16:24'),
(32,'Government','2023-07-18 06:16:24'),
(33,'Special Education','2023-07-18 06:16:24'),
(34,'Biology','2023-07-18 06:16:24'),
(35,'Economics','2023-07-18 06:16:24'),
(36,'Language Arts','2023-07-18 06:16:24'),
(37,'Foreign Languages','2023-07-18 06:16:24'),
(38,'Spanish','2023-07-18 06:16:24'),
(39,'Art','2023-07-18 06:16:24'),
(40,'Geography','2023-07-18 06:16:24'),
(41,'Chemistry','2023-07-18 06:16:24'),
(42,'Criminal Justice','2023-07-18 06:16:24'),
(43,'Marketing','2023-07-18 06:16:24'),
(44,'Environmental Science','2023-07-18 06:16:24'),
(45,'Early Childhood Education','2023-07-18 06:16:24'),
(46,'French','2023-07-18 06:16:24'),
(47,'Foreign Languages','2023-07-18 06:16:24'),
(48,'Health','2023-07-18 06:16:24'),
(49,'Literature','2023-07-18 06:16:24'),
(50,'Visual Arts','2023-07-18 06:16:24'),
(51,'Physics','2023-07-18 06:16:24'),
(52,'Computer Science','2023-07-18 06:16:24'),
(53,'Government','2023-07-18 06:16:24'),
(54,'Psychology','2023-07-18 06:16:24'),
(55,'Nursing','2023-07-18 06:16:24'),
(56,'Performing Arts','2023-07-18 06:16:24'),
(57,'Environmental Science','2023-07-18 06:16:24'),
(58,'History','2023-07-18 06:16:24'),
(59,'Home Economics','2023-07-18 06:16:24'),
(60,'Literature','2023-07-18 06:16:24'),
(61,'Physical Education','2023-07-18 06:16:24'),
(62,'Physical Education','2023-07-18 06:16:24'),
(63,'Special Education','2023-07-18 06:16:24'),
(64,'Language Arts','2023-07-18 06:16:24'),
(65,'Health','2023-07-18 06:16:24'),
(66,'Math','2023-07-18 06:16:24'),
(67,'Health','2023-07-18 06:16:24'),
(68,'Spanish','2023-07-18 06:16:24'),
(69,'Special Education','2023-07-18 06:16:24'),
(70,'Science','2023-07-18 06:16:24'),
(71,'Psychology','2023-07-18 06:16:24'),
(72,'Media Studies','2023-07-18 06:16:24'),
(73,'Government','2023-07-18 06:16:24'),
(74,'Chemistry','2023-07-18 06:16:24'),
(75,'Geography','2023-07-18 06:16:24'),
(76,'Government','2023-07-18 06:16:24'),
(77,'Marketing','2023-07-18 06:16:24'),
(78,'Psychology','2023-07-18 06:16:24'),
(79,'English','2023-07-18 06:16:24'),
(80,'Foreign Languages','2023-07-18 06:16:24'),
(81,'Chemistry','2023-07-18 06:16:24'),
(82,'Law','2023-07-18 06:16:24'),
(83,'Chemistry','2023-07-18 06:16:24'),
(84,'Literature','2023-07-18 06:16:24'),
(85,'Performing Arts','2023-07-18 06:16:24'),
(86,'Government','2023-07-18 06:16:24'),
(87,'Philosophy','2023-07-18 06:16:24'),
(88,'Science','2023-07-18 06:16:24'),
(89,'Environmental Science','2023-07-18 06:16:24'),
(90,'Music','2023-07-18 06:16:24'),
(91,'Home Economics','2023-07-18 06:16:24'),
(92,'Foreign Languages','2023-07-18 06:16:24'),
(93,'French','2023-07-18 06:16:24'),
(94,'Foreign Languages','2023-07-18 06:16:24'),
(95,'Chemistry','2023-07-18 06:16:24'),
(96,'Science','2023-07-18 06:16:24'),
(97,'Physics','2023-07-18 06:16:24'),
(98,'Math','2023-07-18 06:16:24'),
(99,'Social Work','2023-07-18 06:16:24'),
(100,'Sociology','2023-07-18 06:16:24');
/*!40000 ALTER TABLE `subjects_repositories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `qualifications` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `subjects_taught` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`teacher_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES
(1,4,'Assign homework and projects and grading student work',15,'Create a stimulating learning environment','Early Childhood Education','2023-07-18 05:35:18'),
(2,7,'asdfasdf',32,'English, Math, Physic ','asdfasdfasdf','2023-08-19 13:08:08'),
(3,8,'Nothing',10,'English, Math, Physic ','English, and math','2023-08-19 13:11:43');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinformation`
--

DROP TABLE IF EXISTS `userinformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `userinformation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinformation`
--

LOCK TABLES `userinformation` WRITE;
/*!40000 ALTER TABLE `userinformation` DISABLE KEYS */;
INSERT INTO `userinformation` VALUES
(1,2,'Afghanistan','Indonesia','14519','08957329143'),
(2,4,'Indonesia','Bogor','15834','0898765896'),
(3,5,'America','Washington DC','83922','09832842342');
/*!40000 ALTER TABLE `userinformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `roles` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin','admin@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-12 15:22:50',0),
(2,'Student','student@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-12 15:22:50',1),
(4,'Teacher','teacher@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-14 16:43:10',2),
(5,'New User','newuser@gmail.com','$2y$10$NCEcvkbJGtARhvmFtljWG.G01yXdr30zcBZgqn5Di6J8sA7IB44Ta','2023-06-14 16:58:03',2),
(6,'Mike','mike@yahoo.com','$2y$10$XVJ.7wdvkjBSUgmm9XjLl.o.A0M8lUdNgY7FqMQUslQNDBn3lJzwa','2023-06-14 16:58:10',2),
(7,'newuser','newuser3@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-14 17:11:54',2),
(8,'adfadsf','asdfasdf@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-14 17:18:02',2),
(9,'mike','asdfas@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-14 17:18:36',2),
(10,'tom','update-users@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-06-14 17:56:37',2),
(11,'success','success@gmail.com','$2y$10$PYSj4E.fTrJ7VOQ.QVFAw.oDVT8b8MpsULLWp0ZKNzBCjSHRIA8mi','2023-06-19 05:34:14',2),
(12,'Mike','mike@gmail.com','$2y$10$bMLzmrMa70Of5xbvxHBcYui.Joh5DyPbm4FCPzTJtPfLXMG5HM9ie','2023-08-12 02:02:21',1),
(13,'insert','insert@gmail.com','$2y$10$m7pa2Za5A5J6DzCEZF9Me.lxP7OPmjawz67vaoZucydsQltGOqUJa','2023-08-12 13:36:14',1),
(14,'miketyson','miketyson@gmail.com','$2y$10$L52fwvWuoPt8T5IIRNbET.yTyM6FH6M6xbxWMkFzsVMeNWdVOAqni','2023-08-19 07:41:04',0);
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

-- Dump completed on 2023-08-24 10:00:45
