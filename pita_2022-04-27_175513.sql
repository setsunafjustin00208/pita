/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ pita /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE pita;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `grade` int(3) NOT NULL,
  `section` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `verification` int(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
INSERT INTO users(user_id,email,username,password,fname,mname,lname,grade,section,user_type,is_active,verification,date_created,date_modified) VALUES(1,'admin@admin.com','admin','admin','admin','admin','admin',999,'admin','ADMIN','ACTIVE',0,'2022-04-16','2022-04-16'),(2,'student@student.com','student','student','student','student','student',3,'sample','STUDENT','ACTIVE',0,'2022-04-16','2022-04-16'),(3,'teacher@teacher.com','teacher','teacher','TEACHER','TEACHER','TEACHER',9,'TEACHER','TEACHER','ACTIVE',0,'2022-04-16','2022-04-16'),(10,'setsunafjustin00208@gmail.com','gundam250','aza123','gundam','gundam','gundam',3,'gundam','STUDENT','DISABLED',0,'2022-04-27','2022-04-27'),(20,'teacher2@teacher2.com','teacher2','teacher2','teacher2','teacher2','teacher2',3,'teacher2','TEACHER','ACTIVE',0,'2022-04-27','2022-04-27'),(21,'teacher3@teacher3.com','teacher3','teacher3','teacher3','teacher3','teacher3',1,'teacher3','TEACHER','DISABLED',0,'2022-04-27','2022-04-27'),(22,'teacher4@teacher4.com','teacher4','teacher4','teacher4','teacher4','teacher4',2,'teacher4','TEACHER','ACTIVE',0,'2022-04-27','2022-04-27');