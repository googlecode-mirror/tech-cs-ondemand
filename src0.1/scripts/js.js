function bgCheck()
{
	// search for stored bg color cookie entry
	search = "rgb=";
	entries = document.cookie.split(';');
	for (i=0; i < entries.length; i++)
	{
		entry = entries[i];
		
		// clear whitespace
		while (entry.charAt(0) == ' ') entry = entry.substring(1, entry.length);
		
		// if rgb entry found, restore stored bg color
		if (entry.indexOf(search) == 0)
		{
			rgb = entry.substring(search.length, entry.length);
			document.getElementById("bg").style.backgroundColor = rgb;
		}
	}
}

function bgSwitch()
{
	c = 256; // 8 bits per channel (24-bit RGB)
	
	// New random color
	r = Math.floor(Math.random()*c);
	g = Math.floor(Math.random()*c);
	b = Math.floor(Math.random()*c);
	
	rgb = 'rgb(' + r + ',' + g + ',' + b + ')';
	
	document.getElementById("bg").style.backgroundColor = rgb;
	
	// store into cookie (expires on browser close)
	document.cookie = "rgb="+rgb+"; path=/";
}

/**
 * Destroy the document cookie
 */
function resetCookie()
{
    var cookies = document.cookie.split(";");

    for (i=0; i < cookies.length; i++)
	{
        var cookie = cookies[i];
		
		// clear whitespace
		while (cookie.charAt(0) == ' ') cookie = cookie.substring(1, cookie.length);
		
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    }
}

// More generic cookie operations

/**
 * Searches for and retrieves a value from the document cookie
 *
 * @param search the key to search for in the cookie
 * @return the value found (as a string) or false if not found
 */
function getCookie(search)
{
	entries = document.cookie.split(';');
	for (i=0; i < entries.length; i++)
	{
		entry = entries[i];
		
		// clear whitespace
		while (entry.charAt(0) == ' ') entry = entry.substring(1, entry.length);
		
		if (entry.indexOf(search) == 0)
			return entry.substring(search.length+1, entry.length);
	}

	// not found
	return false;
}

function setCookie(key, value)
{
	document.cookie = key + "=" + value + "; path=/";
}

function freshen(field)
{
	if (field.value == "Username" || field.value == "Password")
	{
		if (field.value == "Password")
		{
			$("#pfield").html('<input type="password" name="password" class="textField" id="_pfield" />');
			$("#_pfield").focus();
		}

		field.value = "";
		field.style.color = "#000000";
	}
}

function popUp(content)
{
	var HTML = "";
	
	// header
	HTML += '<img src="banner_s.jpg" alt="TECH ON DEMAND" />';
	
	switch (content)
	{
	case "about":
	
		HTML += '<p class="b">About</p>';
		
		HTML += '<p class="left">Best viewed with Google Chrome</p>';
		
		break;
		
	case "contact":
	
		HTML += '<p class="b">Contact</p>';
		
		HTML += '<p class="left">This site is still a work in progress. Please leave contact with any errors, suggestions, comments, or any other feedback. Thank you!</p>';
		
		break;
		
	case "login":
	
		HTML += '<p class="b">Login</p>';
	
		HTML += "<p class=\"left\">Currently, only authorized class administration personnel are assigned accounts to this site (e.g. instructors and TA's). If you qualify as a member of this set, contact your course instructor and/or site administration.</p>";
		
		HTML += '<form action="" method="post">';
		
		HTML += '<div class="textFieldWrapper">';
		HTML += '<input type="text" name="username" class="textField" style="color:#AAAAAA" value="Username" onfocus="freshen(this)" />';
		HTML += '</div>';
		
		HTML += '<div class="textFieldWrapper" id="pfield">';
		HTML += '<input type="text" name="password" class="textField" style="color:#AAAAAA" value="Password" onfocus="freshen(this)" />';
		HTML += '</div>';
		
		HTML += '<input type="submit" value="Login" />';
		
		HTML += '</form><br/>';
	
		break;
		
	// view/edit profile
	default:
		
		// clear header
		HTML = "";
		
		// VIEW profile
		if (content.substr(0,7) == 'profile')
		{
			var username = content.substr(8);
			var query = profileAJAXquery(username);
			
			HTML += '<p class="b left">View profile: ' + username + '</p>';
			
			HTML += '<table border="0" cellpadding="0" cellspacing="0" width="400">';
				
			HTML += '<tr>';
			HTML += 	'<td width="100" class="vat">';
			HTML += 	'<img src="' + query["picture"] + '" alt="TA Pic" class="tapic" />';
			HTML += 	query["classId"] + ' ' + (query["admin"] ? 'Admin' : 'TA');
			HTML += 	'</td>';
			HTML += 	'<td width="20"></td>';
			HTML += 	'<td width="290" class="vat left"><h2>' + query["name"] + '</h2><b>' + query["email"] + '</b><hr/><p>' + query["info"] + '</p><hr/></td>';
			HTML += '</tr>';
				
			HTML += '</table><br/>';
		
		}
		// EDIT profile
		else if (content.substr(0,8) == '_profile')
		{
			var username = content.substr(9);
			var query = profileAJAXquery(username);
			
			HTML += '<p class="b left">Edit profile: ' + username + '</p>';
			
			HTML += '<form action="" method="post" enctype="multipart/form-data">';
			
			// table: 1 row 3 cells
			HTML += '<table border="0" cellpadding="0" cellspacing="0" width="400">';
				
			HTML += '<tr>';
			
			// cell 1: pic
			HTML += 	'<td width="100" class="vat">';
			HTML += 	'<img src="' + query["picture"] + '" alt="TA Pic" class="tapic" />';
			HTML += 	query["classId"] + ' ' + (query["admin"] ? 'Admin' : 'TA');
			HTML += 	'</td>';
			
			// cell 2: spacer
			HTML += 	'<td width="20"></td>';
			
			// cell 3: form content
			HTML += 	'<td width="290" class="vat left">';
			// inner table: 3 rows 3 cells (per each form entry)
			HTML += 	'<table border="0" cellpadding="0" cellspacing="0" width="290">';
			// row 1: name field
			HTML += 	'<tr><td width="40" class="vam right b">Name&nbsp;&nbsp;</td>';
			HTML += 	'<td width="250"><input type="text" name="name" value="'+ query["name"] +'" style="width:100%" /></td></tr>';
			// row 2: email field
			HTML += 	'<tr><td width="40" class="vam right b">Email&nbsp;&nbsp;</td>';
			HTML += 	'<td width="250"><input type="text" name="email" value="' + query["email"] + '" style="width:100%" /></td></tr>';
			// row 3: info/bio field
			HTML += 	'<tr><td width="40" class="vat right b">Bio&nbsp;&nbsp;</td>';
			HTML += 	'<td width="250"><textarea name="info" rows="5" id="bioTextField" style="width:100%" maxlength="255" oninput="updateCharsLeft();">' + query["info"] + '</textarea><br/>';
			HTML += '255 characters max (<div id="charsLeft" style="display:inline"></div> left)';
			HTML += '<script type="text/javascript">updateCharsLeft();</script>';
			HTML += '</td>';
			HTML += 	'</tr></table>';
			
			HTML += '<br/><b>Update profile picture</b><br/><input type="file" name="tapic" /><br/>Image must have .jpg extension, square dimensions (100px by 100px), and be < 50 KB<br/><br/>';
			HTML += '<input type="submit" value="Save changes" />';
			HTML += '</td></tr>';
				
			HTML += '</table></form><br/>';
			
		}
	
		break;
	}
	
	// footer
	HTML += '<a href="" onclick="closePopUp();return false;">Close Window</a>';
	
	$("#popUp").html(HTML);
	
	$("#popUpBG").fadeTo("fast",0.5);
	$("#popUp").fadeIn("fast");
}

/**
 * ESC key listener for closing popup dialog
 */
function _closePopUp(event)
{
	var popUp = $("#popUp");
	if (popUp.css("display") != "none" && event.keyCode == 27)
		closePopUp();
}

function closePopUp()
{
	$("#popUp").fadeOut("fast");
	$("#popUpBG").fadeOut("fast");
}

// set key listener
document.onkeydown = _closePopUp;

/**
 * AJAX query to the server looking up information
 * to be displayed when opening a profile
 *
 * @param username the unique string username of a user
 * @return associative array containing data with the following keys:
 *	classId : String (eg: "CS 1332")
 *	name : String
 *	email : String
 *	admin : boolean
 *	info : String
 *	pic : String (relative URL)
 */
function profileAJAXquery(username)
{
	var result = new Array();

	result["classId"] = 'CS 1332'; // may require multiple DB queries
	result["name"] = 'Joseph Gee Kim';
	result["email"] = 'jkim498@gatech.edu';
	result["admin"] = Math.floor(Math.random() * 2) == 0 ? true : false;
	result["info"] = 'This bio text field should filter out HTML entities and trim all whitespace down to one space to enforce a linear max character limit in order to ensure the dialog box fits in a minimal resolution.';
	result["picture"] = 'TApics/42.jpg'; // relative URL
	
	return result;
}

function updateCharsLeft()
{
	var textField = document.getElementById("bioTextField");
	$("#charsLeft").html(255 - textField.value.length);
}

WebFontConfig = {
    google: { families: [ 'Wire+One::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
