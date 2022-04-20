/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ pita /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE pita;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `grade` int(3) NOT NULL,
  `section` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
INSERT INTO users(user_id,username,password,fname,mname,lname,grade,section,user_type,is_active,date_created,date_modified) VALUES(1,'admin','admin','admin','admin','admin',999,'admin','ADMIN',1,'2022-04-16','2022-04-16'),(2,'student','student','student','student','student',3,'sample','STUDENT',1,'2022-04-16','2022-04-16'),(3,'teacher','teacher','TEACHER','TEACHER','TEACHER',9,'TEACHER','TEACHER',1,'2022-04-16','2022-04-16'),(4,'student1','student1','student1','student1','student1',3,'student1','STUDENT',0,'2022-04-16','2022-04-16');