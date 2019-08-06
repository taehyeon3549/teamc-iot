-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: teamc-2019summer
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.16.04.1

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
-- Table structure for table `Air_Sensor_value`
--

DROP TABLE IF EXISTS `Air_Sensor_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Air_Sensor_value` (
  `a_no` int(11) NOT NULL,
  `a_ssn` int(11) NOT NULL,
  `a_PM2.5` float NOT NULL,
  `a_PM10` float NOT NULL,
  `a_O3` float NOT NULL,
  `a_CO` float NOT NULL,
  `a_NO2` float NOT NULL,
  `a_SO2` float NOT NULL,
  `a_Temperture` float NOT NULL,
  `a_latitude` float NOT NULL,
  `a_longitude` float NOT NULL,
  `a_time` datetime(6) NOT NULL,
  PRIMARY KEY (`a_no`,`a_ssn`),
  KEY `Air_SSN_FK` (`a_ssn`),
  CONSTRAINT `Air_Sensor_value_ibfk_1` FOREIGN KEY (`a_ssn`) REFERENCES `Sensor` (`SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Air_Sensor_value`
--

LOCK TABLES `Air_Sensor_value` WRITE;
/*!40000 ALTER TABLE `Air_Sensor_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `Air_Sensor_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Air_standard`
--

DROP TABLE IF EXISTS `Air_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Air_standard` (
  `air_element` varchar(45) NOT NULL,
  `air_value` float NOT NULL,
  PRIMARY KEY (`air_element`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Air_standard`
--

LOCK TABLES `Air_standard` WRITE;
/*!40000 ALTER TABLE `Air_standard` DISABLE KEYS */;
/*!40000 ALTER TABLE `Air_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Alert_history`
--

DROP TABLE IF EXISTS `Alert_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Alert_history` (
  `al_no` int(11) NOT NULL,
  `al_USN` int(11) NOT NULL,
  `al_time` date NOT NULL,
  `polar_value_no` int(11) NOT NULL,
  `air_value_no` int(11) NOT NULL,
  PRIMARY KEY (`al_no`),
  KEY `Alert_USN_FK` (`al_USN`),
  KEY `Alert_no_FK_polar` (`polar_value_no`),
  KEY `Alert_no_FK_air` (`air_value_no`) USING BTREE,
  CONSTRAINT `Alert_history_ibfk_1` FOREIGN KEY (`al_USN`) REFERENCES `User` (`USN`),
  CONSTRAINT `Alert_history_ibfk_2` FOREIGN KEY (`polar_value_no`) REFERENCES `Air_Sensor_value` (`a_no`),
  CONSTRAINT `Alert_history_ibfk_3` FOREIGN KEY (`polar_value_no`) REFERENCES `Polar_Sensor_value` (`p_no`),
  CONSTRAINT `Alert_history_ibfk_4` FOREIGN KEY (`air_value_no`) REFERENCES `Air_Sensor_value` (`a_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alert_history`
--

LOCK TABLES `Alert_history` WRITE;
/*!40000 ALTER TABLE `Alert_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `Alert_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Certification`
--

DROP TABLE IF EXISTS `Certification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Certification` (
  `certi_email` varchar(64) NOT NULL,
  `certi_code` varchar(8) NOT NULL,
  `certi_state` tinyint(1) NOT NULL,
  PRIMARY KEY (`certi_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Certification`
--

LOCK TABLES `Certification` WRITE;
/*!40000 ALTER TABLE `Certification` DISABLE KEYS */;
/*!40000 ALTER TABLE `Certification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Polar_Sensor_value`
--

DROP TABLE IF EXISTS `Polar_Sensor_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Polar_Sensor_value` (
  `p_no` int(11) NOT NULL,
  `p_ssn` int(11) NOT NULL,
  `p_heartrate` int(11) NOT NULL,
  `p_RR_interval` int(11) NOT NULL,
  `p_latitude` float NOT NULL,
  `p_longitude` int(11) NOT NULL,
  `p_time` datetime(6) NOT NULL,
  PRIMARY KEY (`p_no`,`p_ssn`),
  KEY `polar_ssn_FK` (`p_ssn`),
  CONSTRAINT `Polar_Sensor_value_ibfk_1` FOREIGN KEY (`p_ssn`) REFERENCES `Sensor` (`SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Polar_Sensor_value`
--

LOCK TABLES `Polar_Sensor_value` WRITE;
/*!40000 ALTER TABLE `Polar_Sensor_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `Polar_Sensor_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Polar_standard`
--

DROP TABLE IF EXISTS `Polar_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Polar_standard` (
  `pol_gender` tinyint(1) NOT NULL,
  `pol_age` int(11) NOT NULL,
  `pol_value` float NOT NULL,
  PRIMARY KEY (`pol_gender`,`pol_age`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Polar_standard`
--

LOCK TABLES `Polar_standard` WRITE;
/*!40000 ALTER TABLE `Polar_standard` DISABLE KEYS */;
/*!40000 ALTER TABLE `Polar_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sensor`
--

DROP TABLE IF EXISTS `Sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sensor` (
  `SSN` int(11) NOT NULL,
  `s_user` int(11) NOT NULL,
  `s_MAC` varchar(8) NOT NULL,
  `s_name` varchar(16) NOT NULL,
  `s_state` tinyint(1) NOT NULL,
  PRIMARY KEY (`SSN`),
  KEY `sensor_user_FK` (`s_user`),
  CONSTRAINT `Sensor_ibfk_1` FOREIGN KEY (`s_user`) REFERENCES `User` (`USN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sensor`
--

LOCK TABLES `Sensor` WRITE;
/*!40000 ALTER TABLE `Sensor` DISABLE KEYS */;
/*!40000 ALTER TABLE `Sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Temperature_standard`
--

DROP TABLE IF EXISTS `Temperature_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Temperature_standard` (
  `season` varchar(8) NOT NULL,
  `temperature` float NOT NULL,
  PRIMARY KEY (`season`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Temperature_standard`
--

LOCK TABLES `Temperature_standard` WRITE;
/*!40000 ALTER TABLE `Temperature_standard` DISABLE KEYS */;
/*!40000 ALTER TABLE `Temperature_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `USN` int(11) NOT NULL AUTO_INCREMENT,
  `hashed` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birth` date NOT NULL,
  `emergency_call` varchar(16) NOT NULL,
  `sign_state` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`USN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-26 11:42:40
