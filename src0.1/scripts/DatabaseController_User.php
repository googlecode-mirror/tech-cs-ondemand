<?php

include_once "OnDemandObjects.ini.php";
include_once "Connection.ini.php";

//************************************************************************
//========================================================================
// 								  User
//========================================================================

//========================================================================
// Create
//========================================================================
function create_user_db($user){

	`taid`		INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`classid`	INT UNSIGNED NOT NULL,
	`name`		VARCHAR(100) NOT NULL,
	`email`		VARCHAR(100) NOT NULL,
	`password`	VARCHAR(100) NOT NULL,
	`active`	INT(1)   DEFAULT 1 COMMENT 'default true || if the TA is taking a semester off',
	`admin`		INT(1)   DEFAULT 0 COMMENT 'default false || To specify a professor. Allowed to edit other users',
	`info`		VARCHAR(255) COMMENT 'general TA description',
	`picture`	VARCHAR(100),

	$con = connectToDB();
	$last_id = 0;
	$classId = mysql_real_escape_string($user->classId);
	$name = mysql_real_escape_string($user->name);
	$email = mysql_real_escape_string($user->email);
	$password = md5($user->password);
	// active
	// admin
	$info = mysql_real_escape_string($user->info);
	$picture = mysql_real_escape_string($user->picture);
	if($con){
		$sql = "INSERT INTO `techcsondemand`.`TaCollection` (`classid`, `name`, `email`, `password`, `info`, `picture`) " .
 				"VALUES ('$classId', '$name', '$email', '$password', '$info', '$picture');";
		if(desql($sql))
		  $last_id = mysql_insert_id();
	}
	if ($con){
		breakCon($con);
	}
	return $last_id;
}

//========================================================================
// Edit
//========================================================================
function update_user_pass_db($uid, $pass) {
	$password = md5($pass);
	$con = connectToDB();
	if($con){
		$sql = "UPDATE user SET password='$password' WHERE userid=$uid;";
		$res = desql($sql);
		breakCon($con);
		return $res;
	}
	return 0;
}

function update_user_info_db($uid, $name, $email, $cell, $cell_carrier, $ec_name, $ec_cell) {
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

function set_user_status_db($uid, $status){
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

function set_user_type_db($uid, $type){
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
function get_user_by_id_db($user_id){
	$con = connectToDB();
	if($con){
		$sql = "SELECT * FROM user, phone 
				WHERE phone.userid=$user_id 
				AND phone.userid=user.userid";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$arr = parse_user_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $arr;
}

function get_member_by_id_db($user_id){
	$con = connectToDB();
	if($con){
		$sql = "SELECT * FROM user, phone 
				WHERE phone.userid=$user_id 
				AND phone.userid=user.userid";
		$result = desql($sql);
		if($result){
			if(mysql_num_rows($result) == 1)
			$arr = parse_member_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $arr;
}

function get_login_by_email_db($user_email){
	$con = connectToDB();
	if($con){
		$sql = "SELECT password, userid FROM user 
				WHERE email='$user_email';";
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
function get_all_users_db($is_paid, $paid, $is_type, $type, $email_like, $email, $is_GT, $GT, $active){
	$active = ($active ? "!" : "") . "= 'Inactive'";
	$sql = "SELECT * FROM user, phone 
			WHERE user.userid=phone.userid
			AND user.userstatus $active ";
	if($is_paid){
		$paid = ($paid ? "" : "!") . "= 'Paid'";
		$sql .= "AND user.userstatus $paid ";
	}
	if($is_type){
		$sql .= "AND user.usertype = '$type' ";
	}
	if($email_like){
		$sql .= "AND user.email LIKE '%$email%' ";
	}
	if($is_GT){
		$GT = ($GT ? "!" : "") . "= 'User'";
		$sql .= "AND user.userstatus $GT ";
	}
	return get_all_users_sql_db($sql);
}

function get_all_users_sql_db($sql){
	$con = connectToDB();
	$arr = array();
	if($con){
		$result = desql($sql);
		$num_results = mysql_num_rows($result);
		for($i=0;$i<$num_results;$i++){
			$arr[] = parse_user_row_db(mysql_fetch_array($result));
		}
		breakCon($con);
	}
	return $arr;
}

//========================================================================
// Helpers
//========================================================================
function parse_user_row_db($row){
	if(!$row)
	return 0;
	$id = $row["userid"];
	$name = $row["username"];
	$password = $row["password"];
	$email = $row["email"];

	$cell_number = $row["phonenumber"];
	$cell_carrier = $row["phonecarrier"];

	$emg_contact_name = $row["emgcntname"];
	$emg_contact_number = $row["emgcntnum"];

	$status = $row["userstatus"];
	$type = $row["usertype"];
	$trips = "";
	$events = "";

	$arr = array("id"=>$id, "password"=>$password ,"name"=>$name, "email"=>$email,
					 "cell_number"=>$cell_number, "cell_carrier"=>$cell_carrier,
					 "emg_contact_name"=>$emg_contact_name, "emg_contact_number"=>$emg_contact_number,
					 "status"=>$status, "type"=>$type,
					 "trips_att"=>$trips, "events_att"=>$events);
	return $arr;
}

function parse_member_row_db($row){
	if(!$row)
	return 0;

	$arr = parse_user_row_db($row);
	$arr["paid"] = $row["paid"];
	
	return $arr;
}

function unique_email_db($email){
	$con = connectToDB();
	if($con){
		$sql = "SELECT * FROM user WHERE email='$email';";
		$result = desql($sql);
		$num_results = !mysql_num_rows($result);
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