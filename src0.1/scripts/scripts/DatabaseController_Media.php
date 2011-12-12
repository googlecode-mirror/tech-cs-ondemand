<?php
include_once "OnDemandObjects.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// Create
//========================================================================

// @functional
function create_media_db($media, $class){
	$con = connectToDB();
	$last_id = 0;
	$rtn = 0;
	$postid = $media->getPostId();
	$taid = $media->getTAid();
	$filename = mysql_real_escape_string($media->filename);
	$type = $media->type;
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`MediaCollection$class` (`postid`, `taid`, `filename`, `type`, `created`) " .
 				"VALUES ('$postid', '$taid', '$filename', '$type', CURRENT_TIMESTAMP);";
		//  __construct($id, $filename, $type, $taid, $postid, $created = 0, $lastModified = 0)
		if(desql($sql))
			$rtn = new OdMedia(mysql_insert_id(), $filename, $type, $taid, $postid);
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// Update
//========================================================================
function update_media_rating_db($comment, $rating) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "UPDATE `techcsondemand`.`CommentCollection` SET `rating`=$rating WHERE `commentid`=".$comment->commentid;
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

//========================================================================
// Update
//========================================================================

// @functional
function get_media_byId_db($id, $class) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`MediaCollection$class`
				WHERE `mediaid`=$id;";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$rtn = parse_media_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $rtn;
}

	// DONE ... TESTED
function get_all_media_db($class, $postId, $taid, $rating, $ratingComp) {
	$needAnd = 0;
	$sql = "SELECT * FROM `techcsondemand`.`MediaCollection$class`
			WHERE ";
	if($postId){
		$sql .= "`postid`=$postId";
		$needAnd = 1;
	}
	if($taid){
		$sql .= ($needAnd ? " AND " : " ") . "`taid`=$taid";
		$needAnd = 1;
	}
	if($rating){
		$ratingComp = !$ratingComp ? "=" : $ratingComp < 0 ? "<" : ">";
		$sql .= ($needAnd ? " AND " : " ") . " $ratingComp $rating";
	}
	return get_all_media_sql_db($sql . ";");
}

	// DONE ... TESTED
function get_all_media_sql_db($sql){
	$con = connectToDB();
	$arr = array();
	if($con){
		$result = desql($sql);
		$num_results = mysql_num_rows($result);
		for($i=0;$i<$num_results;$i++)
			$arr[] = parse_media_row_db(mysql_fetch_array($result));
		breakCon($con);
	}
	return $arr;
}


// @functional
function parse_media_row_db($row) {
	 //  __construct($id, $filename, $type, $taid, $postid, $created = 0, $lastModified = 0)
	return new OdMedia($row["mediaid"],$row["filename"],$row["type"],$row["taid"],$row["postid"],date_create($row["created"]),date_create($row["timestamp"]));
 }

function delete_media_db($id) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "DELETE `techcsondemand`.`CommentCollection` WHERE `commentid`=" . $comment->commentid . ";";
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

?>