<?php
include_once "OnDemandObjects.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// Create
//========================================================================

// @functional
function create_comment_db($comment, $class){
	$con = connectToDB();
	$last_id = 0;
	$rtn = 0;
	$postid = $comment->getPostid();
	$taid = $comment->getTAid();
	$rating = $comment->getRating();
	$commentStr = mysql_real_escape_string($comment->comment);
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`CommentCollection$class` (`postid`, `taid`, `comment`, `rating`, `created`) " .
 				"VALUES ('$postid', '$taid', '$commentStr', '$rating', CURRENT_TIMESTAMP);";
		//  __construct($id, $postid, $taid, $rating, $comment, $created = 0, $lastModified = 0)
		if(desql($sql))
			$rtn = new OdComment(mysql_insert_id(), $postid, $taid, $rating, $commentStr);
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// Update
//========================================================================
function update_comment_rating_db($comment, $rating) {
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

// @functional
function get_comment_byId_db($id, $class) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`CommentCollection$class`
				WHERE `commentid`=$id;";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$rtn = parse_comment_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $rtn;
}

function get_all_comments_db($class, $postid, $taid, $rating, $ratingComp) {
	$needAnd = 0;
	$sql = "SELECT * FROM `techcsondemand`.`CommentCollection$class`
			WHERE ";
	if($postid){
		$sql .= "`postid`=$postid";
		$needAnd = 1;
	}
	if($taid){
		$sql .= ($needAnd ? " AND " : " ") . "`taid`=$taid";
		$needAnd = 1;
	}
	if($rating){
		$ratingComp = !$ratingComp ? "=" : $ratingComp < 0 ? "<" : ">";
		$sql .= ($needAnd ? " AND " : " ") . "`taid` $ratingComp $rating";
	}
	return get_all_comments_sql_db($sql . ";");
}

function get_all_comments_sql_db($sql){
	$con = connectToDB();
	$arr = array();
	if($con){
		$result = desql($sql);
		$num_results = mysql_num_rows($result);
		for($i=0;$i<$num_results;$i++){
			$arr[] = parse_comment_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $arr;
}

//  @functional
function parse_comment_row_db($row) {
	 //  __construct($id, $postid, $taid, $rating, $comment, $created = 0, $lastModified = 0)
	return new OdComment($row["commentid"],$row["postid"],$row["taid"],$row["rating"],$row["comment"],date_create($row["created"]),date_create($row["timestamp"]));
 }

function delete_comment_db($id) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "DELETE `techcsondemand`.`CommentCollection$class` WHERE `commentid`=" . $comment->commentid . ";";
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

?>
