<?php
//************************************************************************
//========================================================================
// 								  Database Utilities
//========================================================================

function get_page_content_by_name_db($page_name){
	$con = connectToDB();
	if($con){
		$sql = "SELECT pagecontent FROM pagecontent WHERE pagename='$page_name';";
		$result = desql($sql);
		if($result && mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$content = $row["pagecontent"];
		}
		breakCon($con);
	}
	return $content;
}

function update_page_content_db($page_name, $content, $uid){
	$con = connectToDB();
	if($con){
		$sql = "UPDATE `pagecontent` SET 
				`pagecontent`='$content',
				`adminid`=$uid,
				`editeddate` = NOW( )
				WHERE `pagename`='$page_name';";
		$result = desql($sql);
		breakCon($con);
	}
	return $result;
}

//========================================================================
// 								  Database Utilities
//========================================================================
//************************************************************************
?>