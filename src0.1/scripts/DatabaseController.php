<?php

include_once "Connection.ini.php";

//************************************************************************
//========================================================================
//			  Database Utilities
//========================================================================

// DONE ... 
function get_all_subjects_db(){
	$con = connectToDB();
	if($con){
		$sql = "SELECT DISTINCT `subject` FROM `techcsondemand`.`ClassCollection`;";
		$rtn = array();
		$result = desql($sql);
		while ($row = mysql_fetch_row($result))
			$rtn[] = $row[0];
		breakCon($con);
	}
	return $rtn;
}

// DONE ... 
function get_all_tags_db($class) {
	$con = connectToDB();
	if($con){
		$sql = "SELECT DISTINCT `tag` FROM `techcsondemand`.`PostCollection$class`;";
		$rtn = array();
		$result = desql($sql);
		while ($row = mysql_fetch_row($result))
			$rtn[] = $row[0];
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// 			  Database Utilities
//========================================================================
//************************************************************************
?>
