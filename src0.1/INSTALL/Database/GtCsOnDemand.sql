DROP DATABASE techcsondemand;

CREATE DATABASE techcsondemand;

--USE techcsondemand;

-- OnDemand Database Conventions
-- class desc		MEDIUMTEXT(3000)
-- TA/post desc		VARCHAR(255)
-- comment		VARCHAR(140)
-- filenames are	VARCHAR(100)
-- personal info is	VARCHAR(100)
-- types or tags are	VARCHAR(20)


CREATE TABLE `ClassCollection` (
  `classid` 	INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `title` 	VARCHAR( 255 ) NOT NULL ,
  `description` MEDIUMTEXT NOT NULL ,
  `alias` 	VARCHAR( 20 ) NOT NULL COMMENT 'how the link will display to the user GET variables',
  `type` 	VARCHAR( 20 ) NOT NULL COMMENT 'I don''t know what this is...',
  UNIQUE (`alias`)
);


CREATE TABLE `ClassTypes` (
  `classid`	INT( 10 ) NOT NULL ,
  `category`	VARCHAR( 100 ) NOT NULL COMMENT 'Subject the class belongs to: {Computer Science, Mathematics, ... }',
  PRIMARY KEY ( `classid` )
);


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
	`type`		VARCHAR(20)  NOT NULL COMMENT 'type of media { image, audio, video, Java, Python, ... }',
	PRIMARY KEY	(`mediaid`),
	INDEX(`postid`),
	UNIQUE(`filename`)
);

CREATE TABLE `techcsondemand`.`CommentCollection1332` (
	`commentid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`postid`	INT UNSIGNED NOT NULL,
	`taid`		INT UNSIGNED NOT NULL,
	`comment`	VARCHAR(140) NOT NULL,
	`rating`	INT          DEFAULT 0 COMMENT 'users can rate comments down and delete them',
	`created`	DATETIME     NOT NULL,
	`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`commentid`),
	INDEX(`postid`, `taid`)
);

/* techcsondemand */
-- INSERT
--USE techcsondemand;
INSERT INTO `techcsondemand`.`ClassCollection` (`classid`, `title`, `description`, `alias`, `type`)
	VALUES (NULL, 'CS1332', 'Data Structures And Algorithms', '1332', 'Computer Science');

INSERT INTO `techcsondemand`.`ClassTypes` (`classid`, `category`)
	VALUES (1, 'Computer Science');

INSERT INTO `techcsondemand`.`TaCollection` (`taid`, `classid`, `name`, `email`, `password`, `info`, `picture`)
	VALUES (NULL, 1, 'New TA', 'TA@TA.com', 'password', 'Coming Soon...', NULL);

INSERT INTO `techcsondemand`.`PostCollection1332` (`postid`, `taid`, `title`, `description`, `tag`, `created`)
	VALUES (NULL, '1', 'Sample Post', 'This post is a sample post', 'Sample', CURRENT_TIMESTAMP);

INSERT INTO `techcsondemand`.`MediaCollection1332` (`mediaid`, `postid`, `taid`, `filename`, `type`, `created`)
	VALUES (NULL, 1, 1, 'samplefile.ext', 'Sample', CURRENT_TIMESTAMP);

INSERT INTO `techcsondemand`.`CommentCollection1332` (`commentid`, `postid`, `taid`, `comment`, `created`)
	VALUES (NULL, 1, 1, 'This is a sample comment', CURRENT_TIMESTAMP);

-- CLEAN TABLES
--USE techcsondemand;
TRUNCATE TABLE `techcsondemand`.`ClassCollection`;
TRUNCATE TABLE `techcsondemand`.`ClassTypes`;
TRUNCATE TABLE `techcsondemand`.`TaCollection`;
TRUNCATE TABLE `techcsondemand`.`PostCollection1332`;
TRUNCATE TABLE `techcsondemand`.`MediaCollection1332`;
TRUNCATE TABLE `techcsondemand`.`CommentCollection1332`;
