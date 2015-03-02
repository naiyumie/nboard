/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.14 : Database - naiyumie
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nboard` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `nboard`;

/*Table structure for table `board` */

DROP TABLE IF EXISTS `board`;

CREATE TABLE `board` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유값',
  `category` varchar(20) NOT NULL DEFAULT 'freeboard' COMMENT '카테고리 FK',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `content` text COMMENT '내용',
  `writer` int(11) NOT NULL COMMENT '작성자 FK',
  `dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '작성일',
  `times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '작성시간',
  `hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `is_blind` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제여부',
  `recommend` int(11) NOT NULL DEFAULT '0' COMMENT '추천수',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '갤러리 - 섬네일',
  `gallery_main_display` enum('Y','N') DEFAULT 'N' COMMENT '갤러리 - 섬네일 메인에 노출',
  PRIMARY KEY (`uid`),
  KEY `fk_board_board_category_idx` (`category`),
  KEY `fk_board_members1_idx` (`writer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `board` */

/*Table structure for table `board_category` */

DROP TABLE IF EXISTS `board_category`;

CREATE TABLE `board_category` (
  `category` varchar(20) NOT NULL COMMENT '카테고리 PK',
  `names` varchar(255) NOT NULL COMMENT '카테고리 이름',
  `appearance` enum('basic','notice','gallery') NOT NULL DEFAULT 'basic' COMMENT '해당 게시판 모양',
  PRIMARY KEY (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `board_category` */

insert  into `board_category`(`category`,`names`,`appearance`) values ('freeboard','자유게시판','basic'),('noticeboard','공지사항','notice'),('updatenews','업데이트소식','notice'),('gallery','갤러리','gallery');

/*Table structure for table `board_comment` */

DROP TABLE IF EXISTS `board_comment`;

CREATE TABLE `board_comment` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유값',
  `board_uid` int(11) NOT NULL COMMENT '게시판 FK',
  `parent_uid` int(11) NOT NULL DEFAULT '0' COMMENT '댓글에 답글 부모 아이디',
  `comment_reply_writer` int(11) NOT NULL DEFAULT '0' COMMENT '댓글에 답글에 부모의 writer_id',
  `writer` int(11) NOT NULL COMMENT '작성자 users FK',
  `content` text COMMENT '내용',
  `dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '커멘트 작성 일',
  `times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '커멘트 작성 시',
  `is_blind` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '삭제 여부',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `board_comment` */

/*Table structure for table `board_recommend` */

DROP TABLE IF EXISTS `board_recommend`;

CREATE TABLE `board_recommend` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유값',
  `board_uid` int(11) NOT NULL COMMENT '게시판 FK',
  `writer` int(11) NOT NULL COMMENT '작성자 users FK',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `board_recommend` */

/*Table structure for table `captcha` */

DROP TABLE IF EXISTS `captcha`;

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

/*Data for the table `captcha` */

insert  into `captcha`(`captcha_id`,`captcha_time`,`ip_address`,`word`) values (117,1425268934,'::1','ew7ku'),(118,1425268982,'::1','zbghv'),(119,1425268989,'::1','sdxuc'),(120,1425269375,'::1','qy2og'),(121,1425269839,'::1','unsui');

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`session_id`,`user_data`,`ip_address`,`user_agent`,`last_activity`) values ('a95febf594e48aab81fafe597d396ac0','a:5:{s:9:\"user_data\";s:0:\"\";s:10:\"sign_state\";b:1;s:9:\"signed_id\";s:5:\"admin\";s:11:\"signed_data\";a:20:{s:3:\"uid\";s:1:\"4\";s:7:\"user_id\";s:5:\"admin\";s:4:\"nick\";s:9:\"관리자\";s:5:\"email\";s:20:\"nonaiyumie@gmail.com\";s:4:\"type\";s:5:\"admin\";s:5:\"level\";s:1:\"1\";s:14:\"term_agreement\";s:5:\"agree\";s:14:\"privacy_polish\";s:5:\"agree\";s:5:\"dates\";s:10:\"2015-03-02\";s:5:\"times\";s:8:\"13:09:40\";s:12:\"signed_dates\";s:10:\"2015-03-02\";s:12:\"signed_times\";s:8:\"13:19:24\";s:7:\"captcha\";s:5:\"qy2og\";s:12:\"count_signed\";s:1:\"1\";s:19:\"count_write_article\";s:1:\"0\";s:19:\"count_write_comment\";s:1:\"0\";s:8:\"is_blind\";s:1:\"N\";s:12:\"leaved_dates\";s:10:\"2000-01-01\";s:12:\"leaved_times\";s:8:\"00:00:00\";s:14:\"leaved_message\";N;}s:14:\"read_board_uid\";s:1:\"|\";}','::1','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.74 Safari/537.36',1425295784);

/*Table structure for table `crud` */

DROP TABLE IF EXISTS `crud`;

CREATE TABLE `crud` (
  `uid` int(10) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `textfield` varchar(255) NOT NULL COMMENT '텍스트필드',
  `textarea` text NOT NULL COMMENT '텍스트에어리어',
  `checkbox` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '체크박스',
  `radio` enum('type_a','type_b') NOT NULL DEFAULT 'type_a' COMMENT '레디오',
  `select` enum('type_1','type_2','type_3') NOT NULL DEFAULT 'type_1' COMMENT '셀렉트',
  `dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '일',
  `times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '시',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crud` */

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유값',
  `user_id` varchar(100) NOT NULL COMMENT '아이디',
  `user_pw` varchar(100) NOT NULL COMMENT '패스워드',
  `nick` varchar(100) NOT NULL COMMENT '닉네임',
  `email` varchar(40) NOT NULL COMMENT '이메일',
  `introduce` text COMMENT '소개',
  `type` enum('admin','users') NOT NULL DEFAULT 'users' COMMENT '유저 타입',
  `level` int(11) NOT NULL DEFAULT '1' COMMENT '레벨',
  `term_agreement` enum('donotagree','agree') NOT NULL DEFAULT 'donotagree' COMMENT '이용약관',
  `privacy_polish` enum('donotagree','agree') NOT NULL DEFAULT 'donotagree' COMMENT '개인정보보호정책',
  `dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '가입일',
  `times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '가입시',
  `signed_dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '마지막 사인인 일',
  `signed_times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '마지막 사인인 시',
  `captcha` varchar(6) DEFAULT NULL COMMENT '캡챠입력정보',
  `count_signed` int(11) NOT NULL DEFAULT '0' COMMENT '사인인 횟수',
  `count_write_article` int(11) NOT NULL DEFAULT '0' COMMENT '게시글 작성수',
  `count_write_comment` int(11) NOT NULL DEFAULT '0' COMMENT '댓글 작성수',
  `is_blind` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT '탈퇴 여부',
  `leaved_dates` varchar(10) NOT NULL DEFAULT '2000-01-01' COMMENT '탈퇴 일',
  `leaved_times` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT '탈퇴 시',
  `leaved_message` text COMMENT '탈퇴 메시지',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `members` */

insert  into `members`(`uid`,`user_id`,`user_pw`,`nick`,`email`,`introduce`,`type`,`level`,`term_agreement`,`privacy_polish`,`dates`,`times`,`signed_dates`,`signed_times`,`captcha`,`count_signed`,`count_write_article`,`count_write_comment`,`is_blind`,`leaved_dates`,`leaved_times`,`leaved_message`) values (5,'member1','xMOniBKBAXjwUmVZdMIZ361SdI+FBBYf5PU0XC8VayBqH6FyUHQeT0ws/t50YMqB77kQyOnls6GcA3KueM0flw==','멤버테스트','naiyumie@naver.com','naiyumie@naver.com','users',1,'agree','agree','2015-03-02','13:17:25','2015-03-02','13:17:37','unsui',1,0,0,'N','2000-01-01','00:00:00',NULL),(4,'admin','V0XFmWHqSzqAgG76bLEZrtMhQPc/8iWyNl+cxcJ64S+HdfGgxhH962XuIYP6MWQrpKSoRb8w09z4JprsioqOFg==','관리자','nonaiyumie@gmail.com','관리자 입니다. ','admin',1,'agree','agree','2015-03-02','13:09:40','2015-03-02','13:19:24','qy2og',1,0,0,'N','2000-01-01','00:00:00',NULL),(3,'tester','bHEOtXodlZPotyYurynqmL1WFrTcni2d04BBeupL0It+bviXYfcXBqfsthJ8/yFAZm/Qqgc/GMXGrz0T1luArw==','테스트관리자','naiyumie@gmail3.com','관리자 테스트 계정.','admin',1,'agree','agree','2015-03-02','13:03:14','2015-03-02','13:08:05','sdxuc',2,0,0,'N','2000-01-01','00:00:00',NULL),(2,'guest','qMpCxz5GmqY4Q2C2Tmt/yTBi6YJnSuG7el07XXGvM2eHW8B4XN0zPQoDaTa7GLFDHqDqrZA6vzGcnxToAqt4uA==','방문객','naiyumie@gmail2.com','방문객 테스트 계정.','users',1,'agree','agree','2015-03-02','13:02:20','2015-03-02','13:02:26','ew7ku',1,0,0,'N','2000-01-01','00:00:00',NULL),(1,'naiyumie','tuav7QUwbRJYUodOhZUGElo9/6OECtR6p9t6H+tgSjKfuJ/BOWOK1+PNTLrbZe8T5h0pEu8zM4XrHJXEV2EaHg==','나이유미','naiyumie@gmail.com','게시판개발자','users',1,'agree','agree','2015-03-02','10:31:45','2015-03-02','12:47:20','fqp8v',12,0,0,'N','2000-01-01','00:00:00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
