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
	if (field.value == "E-mail" || field.value == "Password")
	{
		if (field.value == "Password")
		{
			$("#pfield").html('<input type="password" name="login_password" class="textField" id="_pfield" />');
			$("#_pfield").focus();
		}

		field.value = "";
		field.style.color = "#000000";
	}
}

closeButton = '<p class="right" style="margin:0;padding:0;"><a href="" class="X" onclick="closePopUp();return false;">X</a></p>';
popUpSplash = '<img src="images/banner_s.jpg" alt="TECH ON DEMAND" />';

/**
 * Custom dialog popup overlay
 *
 * @param content one of several identifiers selecting which content to display
 * @param cid GET variable for current page's class ID
 * @param pid GET variable for current page's post ID (if exists)
 * @param arg0 optional parameter used for additional message passing
 * @param arg1 same as arg0 -- both of these should be null if unused
 * @param ... additional argN params could be added in the future
 */
function popUp(content, cid, pid, arg0, arg1)
{
	$("#popUp").html(closeButton); // empty previous popUp's HTML

	switch (content)
	{
	case "about":
		var HTML = "";

		HTML += closeButton;
		HTML += popUpSplash;
	
		HTML += '<p class="b">About</p>';
		
		HTML += '<p class="left">';
		
		HTML += 'Tech OnDemand is an open repository of academic resources aimed to educate anyone who is interested in the various technical topics offered at the Georgia Institute of Technology. All resources hosted on this site are authored by the teaching community at Georgia Tech&mdash;mainly Teaching Assistants (TA\'s) and class administration personnel. Whether you use these resources as a student to help study or just as a means to enhance your knowledge, we hope Tech OnDemand can teach you something new today!<br/><br/>Please note that this site currently is not officially affiliated with or endorsed by the Georgia Institute of Technology. We are pending formal acknowledgment from the institute.'
		
		HTML += '</p>';
		
		HTML += '<p class="cen"><i>Best viewed with the Google Chrome browser</i></p>';
		
		$("#popUp").html(HTML);
		break;
		
	case "contact":
		var HTML = "";

		HTML += closeButton;
		HTML += popUpSplash;
	
		HTML += '<p class="b">Contact</p>';
		
		HTML += '<p class="left">';
		
		HTML += 'Tech OnDemand is a project authored by David Esposito and Joseph Gee Kim during the Fall 2011 semester at the Georgia Institute of Technology originally for a computer science course, CS1332: Data Structures and Algorithms.<br/><br/>It is still a work in progress, so please contribute by sending any feedback including bugs, comments, questions, or other suggestions to <span style="color:#8888FF">admin@tech-ondemand.com</span> &mdash; Thank you!';
		
		HTML += '</p>';
		
		$("#popUp").html(HTML);
		break;
		
	case "login":
		var HTML = "";

		HTML += closeButton;
		HTML += popUpSplash;
	
		HTML += '<p class="b">Login</p>';
	
		HTML += "<p class=\"left\">Currently, only authorized class administration personnel are assigned accounts to this site (e.g. instructors and TA's). If you qualify as a member of this set, contact your course instructor and/or site administration.</p>";
		
		if (pid == null)
			HTML += '<form action="class.php?cid='+cid+'" method="post">';
		else
			HTML += '<form action="post.php?cid='+cid+'&pid='+pid+'" method="post">';
		
		HTML += '<div class="textFieldWrapper">';
		
		if (arg0 == null)
			HTML += '<input type="text" name="login_email" class="textField" style="color:#AAAAAA" value="E-mail" onfocus="freshen(this)" />';
		else
			HTML += '<input type="text" name="login_email" class="textField" value="' + arg0 + '" />';
		HTML += '</div>';
		
		HTML += '<div class="textFieldWrapper" id="pfield">';
		HTML += '<input type="text" name="login_password" class="textField" style="color:#AAAAAA" value="Password" onfocus="freshen(this)" />';
		HTML += '</div>';
		
		// Error message
		if (arg1 != null)
			HTML += '<p style="color:#FF0000">' + arg1 + '</p>';
		
		HTML += '<input type="submit" value="Login" />';
		
		HTML += '</form>';
	
		$("#popUp").html(HTML);
		break;
	
	// VIEW profile
	case "profile":

		var xmlhttp = new XMLHttpRequest();
	
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) // RDY & OK response
			{
				var response = xmlhttp.responseText;
				response = response.split('<delim>');

				var query = new Array();
				query["classId"] = response[0];
				query["name"] = response[1];
				query["email"] = response[2];
				query["admin"] = parseInt(response[3]);
				query["info"] = response[4];
				query["picture"] = 'TApics/' + arg0 + '.jpg';

				//////////////////////////////////////////////////////////////////////
				var HTML = "";
				HTML += closeButton;
				HTML += '<br/>';
	
				HTML += '<table border="0" cellpadding="0" cellspacing="0" width="400">';
					
				HTML += '<tr>';
				HTML += 	'<td width="100" class="vat">';
				HTML += 	'<img src="' + query["picture"] + '?t='+Math.random()+'" alt="TA Pic" class="tapic" />';
				HTML += 	query["classId"] + ' ' + (query["admin"] ? 'Admin' : 'TA');
				HTML += 	'</td>';
				HTML += 	'<td width="20"></td>';
				HTML += 	'<td width="290" class="vat left"><h2>' + query["name"] + '</h2><b>' + query["email"] + '</b><hr/><p>' + query["info"] + '</p><hr/></td>';
				HTML += '</tr>';
					
				HTML += '</table>';
				//////////////////////////////////////////////////////////////////////

				$("#popUp").html(HTML);
			}
		};
		
		// prevent caching with GET var t
		xmlhttp.open("GET","scripts/AJAXprofile.php?id="+arg0+"&t=" + Math.random(),true);
		xmlhttp.send();
		
		break;
	
	// EDIT profile
	case "_profile":
	
		var xmlhttp = new XMLHttpRequest();
	
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) // RDY & OK response
			{
				var response = xmlhttp.responseText;
				response = response.split('<delim>');

				var query = new Array();
				query["classId"] = response[0];
				query["name"] = response[1];
				query["email"] = response[2];
				query["admin"] = parseInt(response[3]);
				query["info"] = response[4];
				query["picture"] = 'TApics/' + arg0 + '.jpg';

				//////////////////////////////////////////////////////////////////////
				var HTML = "";
				HTML += closeButton;
				HTML += '<br/>';
	
				if (pid == null)
					HTML += '<form action="class.php?cid='+cid+'" method="post" enctype="multipart/form-data">';
				else
					HTML += '<form action="post.php?cid='+cid+'&pid='+pid+'" method="post" enctype="multipart/form-data">';
			
				// table: 1 row 3 cells
				HTML += '<table border="0" cellpadding="0" cellspacing="0" width="400">';
				
				HTML += '<tr>';
			
				// cell 1: pic
				HTML += 	'<td width="100" class="vat">';
				HTML += 	'<img src="' + query["picture"] + '?t='+Math.random()+'" alt="TA Pic" class="tapic" />';
				HTML += 	query["classId"] + ' ' + (query["admin"] ? 'Admin' : 'TA');
				HTML += 	'</td>';
			
				// cell 2: spacer
				HTML += 	'<td width="20"></td>';
			
				// cell 3: form content
				HTML += 	'<td width="290" class="vat left">';
				// inner table: 2 rows 2 cells (per each form entry)
				HTML += 	'<table border="0" cellpadding="0" cellspacing="0" width="290">';
				// row 1: name field
				HTML += 	'<tr><td width="40" class="vam right b">Name&nbsp;&nbsp;</td>';
				HTML += 	'<td width="250"><input type="text" name="profile_name" value="'+ query["name"] +'" style="width:100%" /></td></tr>';
				// row 2: info/bio field
				HTML += 	'<tr><td width="40" class="vat right b">Bio&nbsp;&nbsp;</td>';
				HTML += 	'<td width="250"><textarea name="profile_info" rows="6" id="bioTextField" style="width:100%" maxlength="255" oninput="updateCharsLeft();">' + query["info"] + '</textarea><br/>';
				HTML += '255 characters max (<div id="charsLeft" style="display:inline"></div> left)';
				HTML += '<script type="text/javascript">updateCharsLeft();</script>';
				HTML += '</td>';
				HTML += 	'</tr></table>';
			
				HTML += '<br/><b>Update profile picture</b><br/><input type="file" name="profile_tapic" /><br/>Image must have .jpg extension, square dimensions (100px by 100px), and be < 50 KB<br/><br/>';
				HTML += '<input type="submit" value="Save changes" />';
				HTML += '</td></tr>';
				
				HTML += '</table></form>';
				//////////////////////////////////////////////////////////////////////

				$("#popUp").html(HTML);
			}
		};
		
		// prevent caching with GET var t
		xmlhttp.open("GET","scripts/AJAXprofile.php?id="+arg0+"&t=" + Math.random(),true);
		xmlhttp.send();

		break;
	}
		
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
