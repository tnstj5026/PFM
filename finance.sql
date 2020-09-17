-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: 
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!50606 SET @OLD_INNODB_STATS_AUTO_RECALC=@@INNODB_STATS_AUTO_RECALC */;
/*!50606 SET GLOBAL INNODB_STATS_AUTO_RECALC=OFF */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `finance`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `finance` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `finance`;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `subcode` int(11) NOT NULL,
  PRIMARY KEY (`account`),
  KEY `R_5` (`uid`),
  CONSTRAINT `R_5` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('1234567895','sju2010','Hana',2,0),('2254688525','sejong20','Shinhan',3.5,0),('2365846525','sejong20','Hana',4,0),('3546856987','sju2010','Hana',4,0),('4564564568','sju2010','KB',2,0),('4565556599','sju2010','IBK',3,0),('4568455444','sju2010','NH',2.2,0),('4568886985','sju2010','IBK',3,0),('4569874562','sju2010','IBK',2,0),('4582224456','sejong20','KB',2,0),('4584558965','sju2010','IBK',2,0),('4588984556','sejong20','IBK',3,0),('5022565985','sju2010','KB',2.5,0),('5026584875','sju2010','Shinhan',3,0),('5655458956','sju2010','KB',2,0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `merchant` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`no`),
  KEY `R_4` (`uid`),
  CONSTRAINT `R_4` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (1,'sju2010','2010-03-02','Food',30000,'Seven'),(2,'sju2010','2015-06-09','Food',25600,'CU'),(3,'sju2010','2020-03-02','Desk',85000,'Lotte'),(4,'sju2010','2020-05-14','Snack',30000,'CU'),(5,'admin','2020-06-09','Food, Alcohol',25000,'CU'),(6,'sejong20','2020-01-05','Food',33000,'E-mart'),(7,'sejong20','2020-03-08','Computer',25600,'E-mart'),(8,'sejong20','2020-02-25','Alcohol',48090,'CU'),(9,'sejong20','2020-04-22','Snack',34700,'GS25'),(10,'sejong20','2019-05-20','Food',65400,'7-Eleven'),(11,'sju2010','2020-06-24','Food',35000,'E-mart'),(12,'sju2010','2020-06-29','Food',65000,'E-mart');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposit`
--

DROP TABLE IF EXISTS `deposit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deposit` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draw` int(11) DEFAULT NULL,
  `save` int(11) DEFAULT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`no`),
  KEY `R_2` (`uid`),
  CONSTRAINT `R_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposit`
--

LOCK TABLES `deposit` WRITE;
/*!40000 ALTER TABLE `deposit` DISABLE KEYS */;
INSERT INTO `deposit` VALUES (1,'sju2010','2020-01-01','IB',5000,NULL,'YouTube Premium'),(2,'sju2010','2020-03-01','Check',2500,NULL,'Hong Sunseo'),(3,'sju2010','2020-04-01','Cash',NULL,1500,'Jamsil BR'),(4,'sju2010','2020-01-03','IB',NULL,30000,'Brian Choi'),(5,'sju2010','2020-06-02','IB',25000,NULL,'UNICEF donation'),(6,'sju2010','2020-06-02','IB',25000,NULL,'Ryan Kim'),(7,'sju2010','2020-06-03','Cash',NULL,50000,'Sejong Univ. BR'),(8,'sju2010','2020-06-17','Check',NULL,25000,'Jamsil BR'),(9,'sju2010','2020-06-15','Cash',30000,NULL,'Jamsil BR'),(10,'admin','2020-06-01','IB',25000,NULL,'Phone Bill'),(11,'sju2010','2019-12-01','Cash',30000,NULL,'Jamsil BR'),(12,'sju2010','2020-06-24','Cash',250000,NULL,'Sejong Univ. BR'),(13,'admin','2019-12-20','IB',20000,NULL,'Phone Bill'),(14,'sju2010','2020-03-19','IB',NULL,100000,'Pocket money'),(15,'sju2010','2020-06-29','IB',30000,NULL,'Phone Bill');
/*!40000 ALTER TABLE `deposit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fare`
--

DROP TABLE IF EXISTS `fare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fare` (
  `subcode` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`subcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fare`
--

LOCK TABLES `fare` WRITE;
/*!40000 ALTER TABLE `fare` DISABLE KEYS */;
INSERT INTO `fare` VALUES (0,2000),(1,3000);
/*!40000 ALTER TABLE `fare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract` date NOT NULL,
  `maturity` date NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`no`),
  UNIQUE KEY `trs_UNIQUE` (`account`,`contract`,`maturity`,`amount`),
  CONSTRAINT `R_6` FOREIGN KEY (`account`) REFERENCES `account` (`account`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (15,'2254688525','2000-01-03','2010-01-01',2500000),(16,'2254688525','2010-01-01','2011-01-01',3000000),(17,'2365846525','2015-03-26','2017-04-06',4000000),(9,'3546856987','2010-07-24','2020-07-24',3000000),(6,'3546856987','2015-06-11','2025-06-24',2000000),(21,'4564564568','2020-06-17','2020-06-30',250000),(5,'4568455444','2020-01-01','2020-12-20',2500000),(10,'4568886985','2017-08-01','2020-06-02',3500000),(18,'4582224456','2019-01-02','2027-05-26',3300000),(19,'4588984556','2020-01-01','2022-04-22',4500000),(3,'5026584875','2002-03-02','2015-08-09',6500000);
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `uid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`code`),
  KEY `R_15_idx` (`code`),
  CONSTRAINT `R_14` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_15` FOREIGN KEY (`code`) REFERENCES `value` (`code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES ('admin',5012,10000,20),('sejong20',5000,20000,20),('sejong20',5001,33000,10),('sejong20',5003,33000,25),('sejong20',5012,45000,15),('sejong20',5015,40000,45),('sju2010',5000,25000,30),('sju2010',5001,33888,90),('sju2010',5003,32000,60),('sju2010',5012,50000,40),('sju2010',5015,25000,30),('sju2010',5016,35000,20);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `uid` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcode` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `R_1_idx` (`subcode`),
  CONSTRAINT `R_1` FOREIGN KEY (`subcode`) REFERENCES `fare` (`subcode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','Admin','12345','admin2020@naver.com',1),('Joon50','Hong','mysql456','joon50@naver.com',0),('sejong20','Jeon','hi123','sejong@naver.com',0),('sejong30','Min','why123','min@naver.com',0),('sejong40','Seong','db456','seong20@naver.com',1),('sju2010','Kim Minho','12345','sju2010@gmail.com',1),('sju2011','Lee','1234','sju2011@yahoo.com',0),('sju2012','Park','123123','sju2012@gmail.com',0),('test2','test','testa','test@gmail.com',0),('test3','test','test','test@gmail.com',0),('test4','tewst','test','test@gmail.com',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `value`
--

DROP TABLE IF EXISTS `value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `value` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=5017 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `value`
--

LOCK TABLES `value` WRITE;
/*!40000 ALTER TABLE `value` DISABLE KEYS */;
INSERT INTO `value` VALUES (5000,'LG',30000),(5001,'Samsung',60000),(5002,'Doosan',29000),(5003,'SK',31200),(5004,'Intel',50000),(5005,'KAKAO',150000),(5008,'NEVER',200000),(5009,'NC SOFT',200000),(5012,'S-oil',95000),(5015,'Lotte',30000),(5016,'Google',60000);
/*!40000 ALTER TABLE `value` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!50606 SET GLOBAL INNODB_STATS_AUTO_RECALC=@OLD_INNODB_STATS_AUTO_RECALC */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-01 15:06:33
