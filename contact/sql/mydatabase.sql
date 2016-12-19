CREATE DATABASE IF NOT EXISTS mydatabase;
USE mydatabase;
-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: mydatabase
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '联系人记录ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '联系人姓名',
  `gender` enum('男','女') DEFAULT NULL COMMENT '联系人性别',
  `tel` varchar(16) NOT NULL DEFAULT '' COMMENT '联系人电话号码',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '联系人邮箱',
  `birth` date NOT NULL COMMENT '联系人生日',
  `address` varchar(128) NOT NULL DEFAULT '' COMMENT '联系人住址',
  `remark` varchar(256) DEFAULT NULL COMMENT '备注',
  `gid` tinyint(4) DEFAULT NULL COMMENT '分组ID',
  `uid` int(11) NOT NULL COMMENT '这条通信录条目所属用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COMMENT='联系人表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (33,'张三','女','1234567890','1234568@qq.com','0000-00-00','1234132','张三',NULL,12),(34,'李四','男','123412341234','1234132@gmail.com','0000-00-00','12341321324','李四李四李四李四李四李四李四',NULL,12),(35,'李四','女','15002757009','1234132@gmail.com','0000-00-00','whpu','李四李四李四李四李四李四李四',NULL,12),(36,'WTF','女','12343','1234312@gmail.com','0000-00-00','12341234','ウエブサーバ',NULL,12),(37,'りき','男','1234132','12341234@163.com','0000-00-00','','12341324',3,12),(39,'アドミン','男','1234132132','','0000-00-00','','1234132',3,12),(42,'管理员','女','18771099613','123413241234@qq.com','1992-12-31','湖北武汉','我是管理员',3,12),(44,'12341324','女','1520110968115812','15201109681158@163.com','1988-12-12','1234','范雅 15201109681158',3,12),(46,'qwer','男','1059178008','junwg@microsoft.com','1234-12-31','1234132','1059178008	',6,12),(47,'user1','男','123456','123456@gmail.com','1991-12-03','http://localhost/oop/contact/add.php','user1 himself',NULL,2),(48,'אחד\'\"\'','男','1234123','cherkassky@yahoo.com','0231-12-31','Israel','אחדאחד',6,12),(50,'<script>alert(1)</script>','女','1234132','','0000-00-00','<script>alert(2)</script>','1241234',6,12),(51,'q1wf','女','15012725937','','0423-12-31','广东 深圳',NULL,2,12),(52,'夏明称','男','13888347317','13888347317@163.com','1991-01-01','云南 昆明','云南 昆明',2,12),(53,'张三',NULL,'1234567890','','0000-00-00','',NULL,2,12),(54,'李四',NULL,'123412341234','','0000-00-00','',NULL,3,12),(55,'李四',NULL,'15002757009','','0000-00-00','',NULL,3,12),(57,'aaaaa',NULL,'1234132','','0000-00-00','',NULL,3,12),(58,'ookuho','男','18771099612','','1988-05-24','',NULL,3,12),(61,'管理员',NULL,'18771099613','','0000-00-00','',NULL,3,12),(62,'1234123',NULL,'1520110968115812','','0000-00-00','',NULL,3,12),(63,'junwg','男','1059178008','','0000-00-00','',NULL,6,12),(65,'Cherkassky','男','12341231234','','0000-00-00','',NULL,5,12),(66,'<script>alert(1)</script>','男','1234132','212334@gmail.com','1990-12-31','',NULL,5,12),(67,'王琴','女','15012725937','15012725937@qq.com','0000-00-00','','fasdfsda',3,12),(68,'夏明称','男','13888347317','13888347317@qq.com','1991-12-31','云南昆明',NULL,3,12),(84,'司磊',NULL,'18911228058','','0000-00-00','','司磊 18911228058北京 北京',8,2),(85,'文字列','男','1234321234','1234@example.com','0000-00-00','1234','1234',2,12);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grp`
--

DROP TABLE IF EXISTS `grp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grp` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '分组ID',
  `name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '分组名',
  `uid` int(11) NOT NULL COMMENT '创建这个通信录分组的用户ＩＤ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='联系人分组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grp`
--

LOCK TABLES `grp` WRITE;
/*!40000 ALTER TABLE `grp` DISABLE KEYS */;
INSERT INTO `grp` VALUES (2,'%EF%BD%81%EF%BD%8E%EF%BD%84%EF%BD%92%EF%BD%8F%EF%BD%89%EF%BD%84',12),(3,'%E6%B5%8B%E8%AF%95%E5%88%86%E7%BB%84',12),(5,'group2',12),(6,'group1',12),(8,'%E5%90%8C%E4%BA%8B',2),(12,'test',2),(14,'MyContacts%5C',0),(16,'new%20group',0),(17,'test',0);
/*!40000 ALTER TABLE `grp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `pwd` char(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'phpacademy','e10adc3949ba59abbe56e057f20f883e'),(2,'user1','24c9e15e52afc47c225b757e7bee1f9d'),(3,'user2','e10adc3949ba59abbe56e057f20f883e'),(11,'user3','e10adc3949ba59abbe56e057f20f883e'),(12,'admin','21232f297a57a5a743894a0e4a801fc3'),(13,'administrator','e10adc3949ba59abbe56e057f20f883e'),(14,'phpMyAdmin','e10adc3949ba59abbe56e057f20f883e'),(15,'mzh','172c1e85d2a66a1a9eefc9ab05e6ac26'),(16,'shrek','4b60aaf3227b41090abb25977f585648');
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

-- Dump completed on 2016-12-19 19:50:00
