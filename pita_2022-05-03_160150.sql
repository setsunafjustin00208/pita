/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ pita /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE pita;

DROP TABLE IF EXISTS actvities;
CREATE TABLE `actvities` (
  `activity_id` int(255) NOT NULL AUTO_INCREMENT,
  `activity_title` varchar(30) NOT NULL,
  `activity_details` text NOT NULL,
  `activity_output` text NOT NULL,
  `activity_score` int(3) NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `grade` int(3) NOT NULL,
  `section` varchar(30) NOT NULL,
  `date_created` date DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS announcements;
CREATE TABLE `announcements` (
  `a_id` int(255) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(30) NOT NULL,
  `announcement_details` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS scores;
CREATE TABLE `scores` (
  `score_id` int(255) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(255) NOT NULL,
  `student_id` int(3) NOT NULL,
  `activity_id` int(255) NOT NULL,
  `student_score` int(3) NOT NULL,
  `student_output` text NOT NULL,
  `student_evidence` varchar(255) NOT NULL,
  `grade` int(3) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS teacher_announcements;
CREATE TABLE `teacher_announcements` (
  `ta_id` int(255) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(255) NOT NULL,
  `teacher_grade` int(11) NOT NULL,
  `teacher_section` varchar(10) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_body` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date DEFAULT current_timestamp(),
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

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
  `img_pic` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `verification` int(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

INSERT INTO actvities(activity_id,activity_title,activity_details,activity_output,activity_score,teacher_id,grade,section,date_created,date_modified) VALUES(8,'Hello World',X'5072696e742048656c6c6f20576f726c64',X'48656c6c6f20576f726c64',5,3,3,'TEACHER','2022-05-01','2022-05-01'),(9,'Gundam',X'5072696e742047756e64616d0d0a5072696e742047756e64616d0d0a5072696e742047756e64616d',X'5072696e742047756e64616d',10,3,3,'TEACHER','2022-05-03','2022-05-03');

INSERT INTO announcements(a_id,announcement_title,announcement_details,date_created,date_modified) VALUES(1,'sample3',X'73616d706c6533','2022-04-28','2022-04-28'),(3,'First Deployment!',X'57656c636f6d65206920686f706520796f752063616e20656e6a6f79207468697320776562206170706c69636174696f6e','2022-05-02','2022-05-02');

INSERT INTO scores(score_id,teacher_id,student_id,activity_id,student_score,student_output,student_evidence,grade,section,date_created,date_modified) VALUES(6,3,2,8,5,X'48656c6c6f20576f726c64','http://localhost/pita/public/assets/uploads/1651479566_d147e1574ce23a22d318.png',3,'TEACHER','2022-05-02','2022-05-02'),(7,3,2,9,10,X'5072696e742047756e64616d','http://localhost/pita/public/assets/uploads/1651559588_90ecca8e4cb2fcc26336.png',3,'TEACHER','2022-05-03','2022-05-03');

INSERT INTO teacher_announcements(ta_id,teacher_id,teacher_grade,teacher_section,announcement_title,announcement_body,date_created,date_modified) VALUES(3,3,3,'TEACHER','sample3',X'73616d706c6533','2022-04-30','2022-04-30'),(5,3,3,'TEACHER','Do first Activity',X'436865636b20796f7572206163746976697469657320616e642070726f64756365207468652073616964206f7574707574','2022-04-30','2022-04-30');
INSERT INTO users(user_id,email,username,password,fname,mname,lname,grade,section,img_pic,about,user_type,is_active,verification,date_created,date_modified) VALUES(1,'admin@admin.com','admin223','admin','admin22','admin','admin',999,'admin','http://localhost/pita/public/assets/uploads/1.png',X'6461736461736461736461736432323334333232','ADMIN','ACTIVE',0,'2022-04-16','2022-04-16'),(2,'student@student.com','student','student','student','student','student',3,'TEACHER','http://localhost/pita/public/assets/uploads/1651384183_d19f14ed6875ba6cb24f.jpg',X'617364617364736164','STUDENT','ACTIVE',0,'2022-04-16','2022-04-29'),(3,'teacher@teacher.com','teacher1','teacher','TEACHER1','TEACHER','TEACHER',3,'TEACHER','http://localhost/pita/public/assets/uploads/11.png',X'67756e64616d','TEACHER','ACTIVE',0,'2022-04-16','2022-04-29'),(10,'setsunafjustin00208@gmail.com','gundam2500','aza123','gundam','gundam','gundam',3,'gundam','',X'','STUDENT','ACTIVE',0,'2022-04-27','2022-05-01'),(20,'teacher2@teacher2.com','teacher2','teacher2','teacher2','teacher2','teacher2',3,'teacher2','',X'','TEACHER','DISABLED',0,'2022-04-27','2022-04-27'),(21,'teacher3@teacher3.com','teacher3','teacher3','teacher3','teacher3','teacher3',1,'teacher3','',X'','TEACHER','DISABLED',0,'2022-04-27','2022-04-27'),(22,'teacher4@teacher4.com','teacher4','teacher4','teacher4','teacher4','teacher4',2,'teacher4','',X'','TEACHER','DISABLED',0,'2022-04-27','2022-04-27'),(24,'admin2@admin2.com','admin2','admin2','admin2','admin2','admin2',999,'ADMIN','',X'','ADMIN','ACTIVE',0,'2022-04-28','2022-04-28'),(25,'student2@student2.com','student2','student2','student2','student2','student2',3,'TEACHER','',X'','STUDENT','ACTIVE',0,'2022-04-29','2022-04-29'),(28,'setsunafjustin002@gmail.com','setsunafjustin002','i am gundam 002!','Justin Ed Pierre','Cabrales','Tecson',3,'TEACHER','http://localhost/pita/public/assets/uploads/1651550932_fe92a01918d9e16b3d96.jpg',X'','STUDENT','ACTIVE',0,'2022-05-01','2022-05-01');