<?php

// Can also be used for text messages
function sendEmail($subject, $message, $from, $to)
{
  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // Additional headers
  $headers .= "Reply-To: $from" . "\r\n";
  $headers .= "From: [GTski] <$from>" . "\r\n";
  //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
  //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

  // Mail it
  wordwrap($msg,70);
  return mail($to, $subject, $message, $headers);
}

function send_password_reset_email($email){
	$login = get_login_by_email($email);
	$uid = $login["id"];
	$user = get_user_by_id($uid);
	if($user){
		$subject = "[GT Water Ski] Password Reset Request";
		$link = "http://www.DavidEsposito.info/gtwaterski/ChangePassword.php?email=$email&key=$user->password";
		$msg = '
A password reset request from the GT Waterski Scheduling website has been submitted. If you did not'. 
'submit a request, you may ignore this message or contact an administrator of the site.<br /><br />

Please visit the following link to reset your password:<br />
&emsp;' . $link . '
<br /><br />
Feel free to contact the site administrators with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $email, $email);
	}
	return 0;
}

function send_confirmation_email($user, $email){
	$key = md5($user->name . $user->email);
	if($user){
		$subject = "[GT Water Ski] Confirm GT Email";
		$link = "http://www.DavidEsposito.info/gtwaterski/index.php?u=$user->id&key=$key";
		$msg = '		
If you did not create an account for the GT Waterski Scheduling Website you may ignore this message 
or contact an administrator of the site.<br /><br />

Hey '.$user->name.'<br />
Thanks for registering with the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

Please visit the following link to confirm this email:<br />
&emsp;' . $link . '
<br /><br />
Feel free to contact the site administrators with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $email, $email);
	}
	return 0;
}

function send_trip_join_notification($rider, $driver, $trip){
	if($rider && $driver && $trip){
		$txt = "$rider->name joined your trip (" . html_Trip_short_string($trip).")";
		if (sendEmail("", $txt, "GTski", $driver->cell_number . "@" . $driver->cell_carrier)){
			return 1;
		}
		$subject = "[GT Water Ski] Trip Notification";
		$msg = '
If you did not create an account for the GT Waterski Scheduling Website you may ignore this message 
or contact an administrator of the site.<br /><br />
		
Thanks for registering with the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

Please visit the following link to confirm this email:<br />
&emsp;' . $link . '
<br /><br />
Feel free to contact the site administrators with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $driver->email, $driver->email);
	}
	return 0;
}

function send_rider_approved_notification($rider, $driver_string, $trip_string){
	if($rider && $driver_string && $trip_string){
		$subject = "[GT Water Ski] Trip Notification";
		$msg = '
		
Thanks for using the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

You have been approved to attend the following event:<br />
' . $trip_string . '
<br /><br />
Feel free to contact the driver ('.$driver_string.') with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $rider->email, $rider->email);
	}
	return 0;
}

function send_rider_denied_notification($rider, $driver_string, $trip_string){
	if($rider && $driver_string && $trip_string){
		$subject = "[GT Water Ski] Trip Notification";
		$msg = '
		
Thanks for using the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

We regret to inform you that you have been denied attendance the following event:<br />
' . $trip_string . '
<br /><br />
This can occur when the trip is full or when the driver has to shorten the length 
of the trip and cut available seats. Thanks for understanding and feel free to 
contact the driver ('.$driver_string.') with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $rider->email, $rider->email);
	}
	return 0;
}

function send_trip_changed_notification($rider, $driver_string, $trip_string){
	if($rider && $driver_string && $trip_string){
		$subject = "[GT Water Ski] Trip Notification";
		$msg = '
		
Thanks for using the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

A driver has changed a trip that you are currently attending. The new details are below:<br /><br />
' . $trip_string . '
<br /><br />
Feel free to contact the driver ('.$driver_string.') with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $rider->email, $rider->email);
	}
	return 0;
}

function send_trip_cancelled_notification($rider, $driver_string, $trip_string){
	if($rider && $driver_string && $trip_string){
		$subject = "[GT Water Ski] Trip Notification";
		$msg = '
		
Thanks for using the GT Waterski Scheduling website! We look forward to getting out on 
the water with you. <br /><br />

We regret to inform you that a trip you are attending has been <u><b>cancelled</b></u>. 
The following trip will not be taking place:<br /><br />
' . $trip_string . '
<br /><br />
Feel free to contact the driver ('.$driver_string.') with any questions. Thanks,
<br /><br />
Georgia Tech Waterski Club
';
		return sendEmail($subject, $msg, $rider->email, $rider->email);
	}
	return 0;
}
?>
