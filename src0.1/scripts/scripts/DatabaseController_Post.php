<?php
include_once "OnDemandObjects.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// Create
//========================================================================
	// DONE
function create_post_db($post, $class){
	$con = connectToDB();
	$last_id = 0;
	$rtn = 0;
	$taid = $post->getTAid();
	$title = mysql_real_escape_string($post->title);
	$description = mysql_real_escape_string($post->description);
	$tag = $post->topic;
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`PostCollection$class` (`taid`, `title`, `description`, `created`, `tag`) " .
 				"VALUES ('$taid', '$title', '$description', CURRENT_TIMESTAMP, '$tag');";
		echo "$sql<br /><br />";
		// ($id, $title, $description, $taid, $topic, $created = 0, $lastModified = 0)
		if(desql($sql))
			$rtn = new OdPost(mysql_insert_id(), $title, $description, $taid, $tag, date_create(time()), date_create(time()));
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// Update
//========================================================================
function update_post_rating_db($comment, $rating) {
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
	// DONE
function get_post_byId_db($id, $class) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`PostCollection$class`
				WHERE `postid`=$id;";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$rtn = parse_post_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $rtn;
}

	// DONE
function get_all_posts_db($class, $tag = 0) {
	$sql = "SELECT * FROM `techcsondemand`.`PostCollection$class`";
	if($tag){
		$sql .= " WHERE `tag`='$tag'";
	}
	return get_all_posts_sql_db($sql . ";");
}

	// DONE ... 
function get_all_posts_sql_db($sql){
	$con = connectToDB();
	$arr = array();
	if($con){
		echo "$sql<br/><br />";
		$result = desql($sql);
		$num_results = mysql_num_rows($result);
		for($i=0;$i<$num_results;$i++)
			$arr[] = parse_post_row_db(mysql_fetch_array($result));
		breakCon($con);
	}
	return $arr;
}


	// DONE
function parse_post_row_db($row) {
	// __construct($id, $title, $description, $taid, $topic, $created = 0, $lastModified = 0) {
	return new OdPost($row["postid"],$row["title"],$row["description"],$row["taid"],$row["tag"],date_create($row["created"]),date_create($row["timestamp"]));
 }

	// DONE
function delete_post_db($id) {
	$con = connectToDB();
	$rtn = 0;
	if($con){
		$sql = "DELETE `techcsondemand`.`PostCollection` WHERE `postid`=$id;";
		$rtn = desql($sql);
		breakCon();
	}
	return $rtn;
}

?>
