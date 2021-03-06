DROP DATABASE techcsondemand;

CREATE DATABASE techcsondemand;

USE techcsondemand;

CREATE TABLE IF NOT EXISTS `ClassCollection` (
  `classid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` mediumtext,
  `subject` varchar(20) NOT NULL,
  `number` int(4) NOT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE `techcsondemand`.`TaCollection`(
	`taid`		INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`classid`	INT UNSIGNED NOT NULL,
	`name`		VARCHAR(100) NOT NULL,
	`email`		VARCHAR(100) NOT NULL,
	`password`	VARCHAR(100) NOT NULL,
	`active`	INT(1)   DEFAULT 1 COMMENT 'default true || if the TA is taking a semester off',
	`admin`		INT(1)   DEFAULT 0 COMMENT 'default false || To specify a professor. Allowed to edit other users',
	`info`		VARCHAR(255) COMMENT 'general TA description',
	`picture`	VARCHAR(100),
	PRIMARY KEY (`taid`),
	UNIQUE (`email`, `picture`),
	INDEX ( `classid` )
);

CREATE TABLE `techcsondemand`.`PostCollection1332` (
	`postid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`taid`	 	INT UNSIGNED NOT NULL,
	`title`		VARCHAR(100) NOT NULL,
	`description`	VARCHAR(255),
	`created`	DATETIME     NOT NULL,
	`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`tag`  		VARCHAR(20)  COMMENT 'how subjects are seperated in class: { Trees, HashTables, Stacks, ... }',
	PRIMARY KEY (`postid`)
);

CREATE TABLE `techcsondemand`.`MediaCollection1332` (
	`mediaid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`postid`	INT UNSIGNED NOT NULL,
	`taid`		INT UNSIGNED NOT NULL,
	`filename`	VARCHAR(100) NOT NULL,
	`created`	DATETIME     NOT NULL,
	`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`type`		INT  NOT NULL COMMENT 'type of media { image, audio, video, Java, Python, ... }',
	PRIMARY KEY	(`mediaid`),
	INDEX(`postid`),
	UNIQUE(`filename`)
);

CREATE TABLE `techcsondemand`.`CommentCollection1332` (
	`commentid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`postid`	INT UNSIGNED NOT NULL,
	`taid`		INT UNSIGNED NOT NULL,
	`comment`	VARCHAR(255) NOT NULL,
	`rating`	INT          DEFAULT 0 COMMENT 'users can rate comments down and delete them',
	`created`	DATETIME     NOT NULL,
	`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`commentid`),
	INDEX(`postid`, `taid`)
);

INSERT INTO `techcsondemand`.`ClassCollection` (`classid`, `title`, `description`, `number`, `subject`)
	VALUES (NULL, 'CS1332', 'Data Structures And Algorithms', '1332', 'Computer Science');

INSERT INTO `techcsondemand`.`TaCollection` (`taid`, `classid`, `name`, `email`, `password`, `info`, `picture`)
	VALUES (NULL, 1, 'New TA', 'TA@TA.com', 'password', 'Coming Soon...', NULL);

INSERT INTO `techcsondemand`.`PostCollection1332` (`postid`, `taid`, `title`, `description`, `tag`, `created`)
	VALUES (NULL, '1', 'Sample Post', 'This post is a sample post', 'Sample', CURRENT_TIMESTAMP);

INSERT INTO `techcsondemand`.`MediaCollection1332` (`mediaid`, `postid`, `taid`, `filename`, `type`, `created`)
	VALUES (NULL, 1, 1, 'samplefile.ext', 2, CURRENT_TIMESTAMP);

INSERT INTO `techcsondemand`.`CommentCollection1332` (`commentid`, `postid`, `taid`, `comment`, `created`)
	VALUES (NULL, 1, 1, 'This is a sample comment', CURRENT_TIMESTAMP);

