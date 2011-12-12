<?php

include_once "OnDemandObjects.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// 								  User
//========================================================================

//========================================================================
// Create
//========================================================================
	// DONE ... TESTED
function create_ta_db($ta){
	$con = connectToDB();
	$last_id = 0;
	$classId = $ta->classId;
	$name = mysql_real_escape_string($ta->name);
	$email = mysql_real_escape_string($ta->email);
	$password = md5($ta->password);
	$active = 1;
	$admin = 0;
	$info = mysql_real_escape_string($ta->info);
	$picture = mysql_real_escape_string($ta->picture);
	$rtn = 0;
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`TaCollection` (`name`, `email`, `password`, `info`, `picture`) " .
 				"VALUES ('$name', '$email', '$password', '$info', '$picture');";
		if(desql($sql)) {
			  $last_id = mysql_insert_id();
			  if ($classId) {
				for($i=0;$i<count($classId);$i++)
					update_ta_add_class_db($last_id, $classId[$i]);
				$rtn = new OdTA($last_id, $classId, $name, $email, $password, $active, $admin, $info, $picture);
			  } else
				$rtn = new OdTA($last_id, array(), $name, $email, $password, $active, $admin, $info, $picture);			  
		}
	}
	if ($con){
		breakCon($con);
	}
	return $rtn;
}

//========================================================================
// Edit
//========================================================================
	// DONE
function update_ta_pass_db($uid, $pass) {
	$password = md5($pass);
	$con = connectToDB();
	if($con){
		$sql = "UPDATE `techcsondemand`.`TaCollection` SET `password`='$pass' WHERE `taid`=$uid;";
		$res = desql($sql);
		breakCon($con);
		return $res;
	}
	return 0;
}

	// DONE ... TESTED
// NOTE: !! expects connection !!
function update_ta_add_class_db($taid, $classId) {
	$sql = "INSERT INTO `techcsondemand`.`TaClasses` (`taid`, `classid`) " .
			"VALUES ('$taid', '$classId');";
	$res = desql($sql);
	return $res;
}

function update_ta_info_db($uid, $name, $email, $cell, $cell_carrier, $ec_name, $ec_cell) {
	$con = connectToDB();
	if($con){
		$sql = "UPDATE user SET username='$name', email='$email', emgcntname='$ec_name', emgcntnum='$ec_cell' WHERE userid=$uid;";
		if(desql($sql)){
			$sql = "UPDATE phone SET phonenumber='$cell', phonecarrier='$cell_carrier' WHERE userid=$uid;";

			$res = desql($sql);
			breakCon($con);
			return $res;
		}
		breakCon($con);
	}
	return 0;
}

function set_ta_status_db($uid, $status){
	$con = connectToDB();
	if($con){
		$sql = "UPDATE user SET userstatus='$status' 
				WHERE userid=$uid;";
		$result = desql($sql);
		breakCon($con);
		return $result;
	}
	return 0;
}

function set_ta_type_db($uid, $type){
	$con = connectToDB();
	if($con){
		$sql = "UPDATE user SET usertype='$type' 
				WHERE userid=$uid;";
		$result = desql($sql);
		breakCon($con);
		return $result;
	}
	return 0;
}

//========================================================================
// Get
//========================================================================

	// DONE ... TESTED
function get_ta_by_id_db($ta_id, $con=0){
	$res = $con;
	$con = connectToDB();
	$ta = 0;
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`TaCollection` 
				WHERE `taid`=$ta_id;";
		$result = desql($sql);
		if($result && mysql_num_rows($result) == 1)
				$ta = parse_ta_row_db(mysql_fetch_array($result));
		if(!$res)
			breakCon($con);
	}
	return $ta;
}

	// DONE
function get_login_by_email_db($ta_email){
	$con = connectToDB();
	if($con){
		$sql = "SELECT password, taid FROM `techcsondemand`.`TaCollection`
				WHERE email='$ta_email';";
		$result = desql($sql);
		if(mysql_num_rows($result) == 1){
			$row = mysql_fetch_array($result);
			$arr = array("password"=>$row["password"], "id"=>$row["userid"]);
			breakCon($con);
			return $arr;
		}
		breakCon($con);
	}
	return 0;
}

//========================================================================
// Get All
//========================================================================
	// DONE ... TESTED
function get_all_tas_db($classId=0){
	$con = connectToDB();
	$arr = array();
	if($con){
		$sql = "SELECT * FROM ";
		if ($classId) {
			$sql .= "`techcsondemand`.`TaClasses` WHERE `classid`=$classId;";
			$result = desql($sql);
			while ($row = mysql_fetch_array($result))
				$arr[] = get_ta_by_id_db($row['taid'], $con);
		} else {
			$sql .= "`techcsondemand`.`TaCollection`;";
			$result = desql($sql);
			while ($row = mysql_fetch_array($result))
				$arr[] = parse_ta_row_db($row);
		}
		breakCon($con);
	}
	return $arr;
}

//========================================================================
// Helpers
//========================================================================
	// DONE ... TESTED
function parse_ta_row_db($row){
	if(!$row)
		return 0;
	$id = $row["taid"];
	$classid = array();
	$name = $row["name"];
	$password = $row["password"];
	$email = $row["email"];
	$active = $row["active"];
	$admin = $row["admin"];
	$info = $row["info"];
	$picture = $row["picture"];

	$ta = new OdTA($id, $classid, $name, $email, $password, $active, $admin, $info, $picture);

	$sql = "SELECT * FROM `techcsondemand`.`TaClasses`
			WHERE `taid`=$id;";
	$result = desql($sql);
	
	return $ta;
	//return parse_ta_classes_db($result, $ta);
}

	// DONE ... TESTED
function parse_ta_classes_db($classResults, $ta) {
	while($row = mysql_fetch_array($classResults))
		$ta->addClass($row['classid']);
	return $ta;
}

	// DONE ... TESTED
function unique_email_db($email){
	$con = connectToDB();
	if($con){
		$sql = "SELECT * FROM `techcsondemand`.`TaCollection` WHERE `email`='$email';";
		$result = desql($sql);
		$num_results = mysql_num_rows($result) ? 0 : 1;
		breakCon($con);
		return $num_results;
	}
	return 0;
}
//========================================================================
// 								  User
//========================================================================
//************************************************************************
?>