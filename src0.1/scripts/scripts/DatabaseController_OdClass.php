<?php
include_once "OnDemandObjects.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// Create
//========================================================================

	// DONE
function create_class_db($odClass){
	$con = connectToDB();
	$last_id = 0;
	$rtn = 0;
	$subject = $odClass->subject;
	$number = $odClass->number;
	$title = $odClass->title;
	$description = mysql_real_escape_string($odClass->description);
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`ClassCollection` (`title`, `description`, `subject`, `number`) " .
 				"VALUES ('$title', '$description', '$subject', '$number');";
		if(desql($sql)) {
			$last_id = mysql_insert_id();
			$rtn = new OdClass($last_id, $subject, $number, $title, $description);
			$sql = "CREATE TABLE `techcsondemand`.`PostCollection$number` (
					`postid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
					`taid`	 	INT UNSIGNED NOT NULL,
					`title`		VARCHAR(100) NOT NULL,
					`description`	VARCHAR(255),
					`created`	DATETIME     NOT NULL,
					`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					`tag`  		VARCHAR(20)
					PRIMARY KEY (`postid`)
				);";
			desql($sql);
			$sql = "CREATE TABLE `techcsondemand`.`MediaCollection$number` (
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
				);";
			desql($sql);
			$sql = "CREATE TABLE `techcsondemand`.`CommentCollection$number` (
					`commentid`	INT UNSIGNED NOT NULL AUTO_INCREMENT,
					`postid`	INT UNSIGNED NOT NULL,
					`taid`		INT UNSIGNED NOT NULL,
					`comment`	VARCHAR(255) NOT NULL,
					`rating`	INT          DEFAULT 0 COMMENT 'users can rate comments down and delete them',
					`created`	DATETIME     NOT NULL,
					`timestamp`	TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					PRIMARY KEY (`commentid`),
					INDEX(`postid`, `taid`)
				);";
			desql($sql);
		}
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// Update
//========================================================================
function update_class_db($comment, $rating) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "UPDATE `techcsondemand`.`CommentCollection$class` SET `rating`=$rating WHERE `commentid`=".$comment->commentid;
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

//========================================================================
// Read
//========================================================================

	// DONE
function get_class_byId_db($id) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`ClassCollection`
				WHERE `classid`=$id;";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$rtn = parse_classes_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $rtn;
}

	// DONE
function get_class_byNumber_db($number) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`ClassCollection`
				WHERE `number`=$number;";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$rtn = parse_classes_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $rtn;
}

	// DONE
function get_all_classes_db($subject=0) {
	$needAnd = 0;
	$sql = "SELECT * FROM `techcsondemand`.`ClassCollection`";
	if($subject)
		$sql .= " WHERE `subject`='$subject'";
	return get_all_classes_sql_db($sql . ";");
}

	// DONE
function get_all_classes_sql_db($sql){
	$con = connectToDB();
	$arr = array();
	if($con){
		$result = desql($sql);
		$num_results = mysql_num_rows($result);
		for($i=0;$i<$num_results;$i++){
			$arr[] = parse_classes_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $arr;
}

	// DONE
function parse_classes_row_db($row) {
	 //  __construct($id, $postid, $taid, $rating, $comment, $created = 0, $lastModified = 0)
	return new OdClass($row['classid'], $row['subject'], $row['number'], $row['title'], $row['description']);
 }

	// DONE
function delete_class_db($id) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "DELETE `techcsondemand`.`ClassCollection` WHERE `classid`=$id;";
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

?>