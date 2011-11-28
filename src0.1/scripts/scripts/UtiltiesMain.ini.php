<?php

function include_js(){
	echo '
<script type="text/javascript" src="js/class_services.js"> </script>
<script type="text/javascript" src="js/User.js"> </script>
<script type="text/javascript" src="js/user_services.js"> </script>
<script type="text/javascript" src="js/Event.js"> </script>
<script type="text/javascript" src="js/event_services.js"> </script>
<script type="text/javascript" src="js/js_test.js"> </script>
<script type="text/javascript" src="js/form_validation.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="TacoComponents/TSWBrowserDetect.js"></script>
<script type="text/javascript" src="TacoComponents/TSWUtils.js"></script>
<script type="text/javascript" src="TacoComponents/TSWDateAndTime.js"></script>
<script type="text/javascript" src="TacoComponents/TSWFormCalendar.js"></script>
';
}

function include_css(){
	echo '
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="TacoComponents/TSWFormCalendar_myFormCalendar.css" />
<link rel="stylesheet" type="text/css" href="TacoComponents/TSWFormCalendar_myFormCalendar22.css" />
';
}

// This function is used to make including PHP files easier.
// You should only include this file in a source file and 
// include any other script you might need below.
function includeUtils() {
	include_once "scripts/connection.ini.php";
	include_once "scripts/User.php";
	include_once "scripts/DatabaseController.php";
	include_once "scripts/DatabaseController_User.php";
	include_once "scripts/DatabaseController_Trip.php";
	include_once "scripts/DatabaseController_Event.php";
	include_once "scripts/PageContent.php";
	include_once "scripts/Events.php";
	include_once "scripts/sndEmail.ini.php";
	include_once "scripts/utils_functions.ini.php";
	include_once "scripts/displayUtils/displayLogin.php";
	include_once "scripts/displayUtils/debugging.ini.php";
	include_once "scripts/displayUtils/msg_display.ini.php";
	include_once "scripts/displayUtils/HTMLGenerator_User.php";
	include_once "scripts/displayUtils/HTMLGenerator_Event.php";
	include_once "scripts/displayUtils/HTMLGenerator_edit.php";
}
?>
