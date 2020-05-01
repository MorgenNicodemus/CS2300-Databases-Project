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
  PRIMARY KEY (`ua_name`),
  KEY `c_name_idx` (`c_name`),
  CONSTRAINT `auser_name` FOREIGN KEY (`ua_name`) REFERENCES `admins` (`auser_name`),
  CONSTRAINT `c_name` FOREIGN KEY (`c_name`) REFERENCES `category` (`c_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_for`
--

LOCK TABLES `admin_for` WRITE;
/*!40000 ALTER TABLE `admin_for` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_for` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `auser_name` varchar(30) NOT NULL,
  `admins_pass` varchar(80) NOT NULL,
  PRIMARY KEY (`auser_name`),
  UNIQUE KEY `auser_name_UNIQUE` (`auser_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES ('admin','$2y$10$kSeAlb1EOESRXN57ahP57earj0nFODQLE9AROZFJu6Dz/GdYkEBx6'),('admin_man','$2y$10$9eIUsFF7d9XW0kkXB33DYevEHG2sSbBOfgw4dV7I1i8rYjSvLYFXG');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advisor`
--

DROP TABLE IF EXISTS `advisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advisor` (
  `a_name` varchar(30) NOT NULL,
  `t_name` varchar(45) NOT NULL,
  PRIMARY KEY (`a_name`,`t_name`),
  KEY `t_name_idx` (`t_name`),
  CONSTRAINT `t_name` FOREIGN KEY (`t_name`) REFERENCES `team` (`t_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisor`
--

LOCK TABLES `advisor` WRITE;
/*!40000 ALTER TABLE `advisor` DISABLE KEYS */;
/*!40000 ALTER TABLE `advisor` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
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
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES ('tester_man','$2y$10$xhsmh/LV3c/F1r22ONLUveDl8bMZSUGRfFzS5xKDckG9uOmgnY/de',0);
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
  `puzz_body` varchar(100) NOT NULL,
  PRIMARY KEY (`puzz_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puzzle`
--

LOCK TABLES `puzzle` WRITE;
/*!40000 ALTER TABLE `puzzle` DISABLE KEYS */;
/*!40000 ALTER TABLE `puzzle` ENABLE KEYS */;
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
INSERT INTO `team` VALUES ('lameos',0,NULL),('M57',30,NULL);
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
INSERT INTO `u_belongs_to` VALUES ('tester_man','M57');
/*!40000 ALTER TABLE `u_belongs_to` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-01 16:23:10
