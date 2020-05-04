CREATE DATABASE  IF NOT EXISTS `reaver` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reaver`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: reaver
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_for`
--

DROP TABLE IF EXISTS `admin_for`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_for` (
  `ua_name` varchar(30) NOT NULL,
  `c_name` varchar(45) NOT NULL,
  KEY `c_name_idx` (`c_name`),
  KEY `auser_name_idx` (`ua_name`),
  CONSTRAINT `auser_name` FOREIGN KEY (`ua_name`) REFERENCES `player` (`user_name`),
  CONSTRAINT `c_name` FOREIGN KEY (`c_name`) REFERENCES `category` (`c_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_for`
--

LOCK TABLES `admin_for` WRITE;
/*!40000 ALTER TABLE `admin_for` DISABLE KEYS */;
INSERT INTO `admin_for` VALUES ('t_fried','Cryptography');
/*!40000 ALTER TABLE `admin_for` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `c_name` varchar(80) NOT NULL,
  `p_complete` int DEFAULT NULL,
  PRIMARY KEY (`c_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES ('Cryptography',NULL),('Trivia',NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_belongs_to`
--

DROP TABLE IF EXISTS `p_belongs_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `p_belongs_to` (
  `c_name` varchar(45) NOT NULL,
  `p_no` int NOT NULL,
  PRIMARY KEY (`c_name`,`p_no`),
  KEY `puzzle_idx` (`p_no`),
  CONSTRAINT `category` FOREIGN KEY (`c_name`) REFERENCES `category` (`c_name`),
  CONSTRAINT `puzzle` FOREIGN KEY (`p_no`) REFERENCES `puzzle` (`puzz_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_belongs_to`
--

LOCK TABLES `p_belongs_to` WRITE;
/*!40000 ALTER TABLE `p_belongs_to` DISABLE KEYS */;
INSERT INTO `p_belongs_to` VALUES ('Trivia',2),('Cryptography',3),('Cryptography',4);
/*!40000 ALTER TABLE `p_belongs_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player` (
  `user_name` varchar(30) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `score` double DEFAULT '0',
  `admin` int DEFAULT '0',
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES ('bobert','$2y$10$11b4JplCofShTv49zUM57.kg0gkV3Cc.Mj0y6V5x3qhS2yXkfCh9e',0,0),('man','$2y$10$xycIn7W/LDtnzIolk9RVCuwSgH1aj9LXQQ7mChirtl/QDg1Yj.c2G',0,0),('t_fried','$2y$10$jnsmsxsDrWYxa4m1DAsiF.Da8vKXwMZErI/9N9LKmDqs1dJD9yTiu',0,1),('tester_man','$2y$10$xhsmh/LV3c/F1r22ONLUveDl8bMZSUGRfFzS5xKDckG9uOmgnY/de',950,0);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puzzle`
--

DROP TABLE IF EXISTS `puzzle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puzzle` (
  `puzz_no` int NOT NULL,
  `puzz_val` int NOT NULL,
  `puzz_flag` varchar(45) NOT NULL,
  `puzz_name` varchar(45) NOT NULL,
  `puzz_body` varchar(255) NOT NULL,
  PRIMARY KEY (`puzz_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puzzle`
--

LOCK TABLES `puzzle` WRITE;
/*!40000 ALTER TABLE `puzzle` DISABLE KEYS */;
INSERT INTO `puzzle` VALUES (1,50,'reaverCTF{Brazil}','Coffee Shop','Which country produces the most coffee in the world?'),(2,50,'reaverCTF{three}','Octopus','How many hearts does an octopus have?'),(3,100,'reaverCTF{scr4mbl3d_w1th_ch3353}','I like my eggs served...','63 6d 56 68 64 6d 56 79 51 31 52 47 65 33 4e 6a 63 6a 52 74 59 6d 77 7a 5a 46 39 33 4d 58 52 6f 58 32 4e 6f 4d 7a 4d 31 4d 33 30 3d'),(4,150,'reaverCTF{password123}','Super Secure Pass','We found this on a sticky note. Maybe it\'s a password?');
/*!40000 ALTER TABLE `puzzle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_has_solved`
--

DROP TABLE IF EXISTS `t_has_solved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_has_solved` (
  `t_name` varchar(45) NOT NULL,
  `p_number` int NOT NULL,
  PRIMARY KEY (`t_name`,`p_number`),
  KEY `puzz_no_idx` (`p_number`),
  CONSTRAINT `puzz_no` FOREIGN KEY (`p_number`) REFERENCES `puzzle` (`puzz_no`),
  CONSTRAINT `team_name` FOREIGN KEY (`t_name`) REFERENCES `team` (`t_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_has_solved`
--

LOCK TABLES `t_has_solved` WRITE;
/*!40000 ALTER TABLE `t_has_solved` DISABLE KEYS */;
INSERT INTO `t_has_solved` VALUES ('M57',2),('M57',3),('M57',4);
/*!40000 ALTER TABLE `t_has_solved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team` (
  `t_name` varchar(80) NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `rank` int DEFAULT NULL,
  PRIMARY KEY (`t_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES ('lameos',0,NULL),('M57',1430,NULL),('Manners',0,NULL);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `u_belongs_to`
--

DROP TABLE IF EXISTS `u_belongs_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `u_belongs_to` (
  `u_name` varchar(30) NOT NULL,
  `t_name` varchar(45) NOT NULL,
  PRIMARY KEY (`u_name`,`t_name`),
  KEY `t_name_idx` (`t_name`),
  CONSTRAINT `teams_name` FOREIGN KEY (`t_name`) REFERENCES `team` (`t_name`),
  CONSTRAINT `users_name` FOREIGN KEY (`u_name`) REFERENCES `player` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `u_belongs_to`
--

LOCK TABLES `u_belongs_to` WRITE;
/*!40000 ALTER TABLE `u_belongs_to` DISABLE KEYS */;
INSERT INTO `u_belongs_to` VALUES ('bobert','lameos'),('t_fried','M57'),('tester_man','M57'),('man','Manners');
/*!40000 ALTER TABLE `u_belongs_to` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `u_has_solved`
--

DROP TABLE IF EXISTS `u_has_solved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `u_has_solved` (
  `u_name` varchar(45) NOT NULL,
  `p_number` int NOT NULL,
  PRIMARY KEY (`u_name`,`p_number`),
  KEY `puzz_idx` (`p_number`),
  CONSTRAINT `puzz` FOREIGN KEY (`p_number`) REFERENCES `puzzle` (`puzz_no`),
  CONSTRAINT `user` FOREIGN KEY (`u_name`) REFERENCES `player` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `u_has_solved`
--

LOCK TABLES `u_has_solved` WRITE;
/*!40000 ALTER TABLE `u_has_solved` DISABLE KEYS */;
INSERT INTO `u_has_solved` VALUES ('tester_man',2),('tester_man',3),('tester_man',4);
/*!40000 ALTER TABLE `u_has_solved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'reaver'
--

--
-- Dumping routines for database 'reaver'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-03 23:20:39
