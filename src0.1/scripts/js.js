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
		
		HTML += '<p class="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin felis ac nibh blandit imperdiet. Donec consequat tellus eu tortor molestie vel fermentum metus iaculis. Quisque ullamcorper metus sit amet sapien consectetur eu consequat ante consectetur. Nulla facilisi. Aenean nisi turpis, accumsan sit amet pellentesque id, vestibulum ac nisi. Maecenas quis dolor non mauris lobortis posuere. Nulla neque augue, gravida vel imperdiet id, sagittis non ante. Proin ultricies pretium nulla lacinia tempor.</p>';
		
		break;
	case "contact":
	
		HTML += '<p class="b">Contact</p>';
		
		HTML += '<p class="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin felis ac nibh blandit imperdiet. Donec consequat tellus eu tortor molestie vel fermentum metus iaculis. Quisque ullamcorper metus sit amet sapien consectetur eu consequat ante consectetur. Nulla facilisi. Aenean nisi turpis, accumsan sit amet pellentesque id, vestibulum ac nisi. Maecenas quis dolor non mauris lobortis posuere. Nulla neque augue, gravida vel imperdiet id, sagittis non ante. Proin ultricies pretium nulla lacinia tempor.</p>';
		
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
			
			// ajax call
			var classId = 'CS 1332'; // may require multiple DB queries
			var name = 'Joseph Gee Kim';
			var email = 'jkim498@gatech.edu';
			var admin = Math.floor(Math.random() * 2) == 0 ? true : false;
			var info = 'Hello! My name is Joseph Jihoon Kim, and I am currently a TA for <b>CS 1332 -- Data Structures and Algorithms</b>!<br/><br/>I am also a lover of music. I play the piano and bass and am a member of the Georgia Tech Symphony Orchestra!<br/><br/>I appreciate music theory and love composing/recording all genres of music!';
			var picture = 'TApics/42.jpg'; // relative URL
			
			HTML += '<p class="b left">View profile: ' + username + '</p>';
			
			HTML += '<table border="0" cellpadding="0" cellspacing="0" width="400">';
				
			HTML += '<tr>';
			HTML += 	'<td width="100" class="vat">';
			HTML += 	'<img src="' + picture + '" alt="TA Pic" class="tapic" />';
			HTML += 	classId + ' ' + (admin ? 'Admin' : 'TA');
			HTML += 	'</td>';
			HTML += 	'<td width="20"></td>';
			HTML += 	'<td width="290" class="vat left"><h2>' + name + '</h2><b>' + email + '</b><hr/><p>' + info + '</p><hr/></td>';
			HTML += '</tr>';
				
			HTML += '</table><br/>';
		
		}
		// EDIT profile
		else if (content.substr(0,8) == '_profile')
		{
			var username = content.substr(9);
			
			// ajax call
		}
	
		break;
	}
	
	// footer
	HTML += '<a href="" onclick="closePopUp();return false;">Close Window</a>';
	
	$("#popUp").html(HTML);
	
	$("#popUpBG").fadeTo("fast",0.5);
	$("#popUp").fadeIn("fast");

	/* OLD-FASHIONED POP-UP
	if (!window.focus)
		return true;
	
	var href;
	
	if (typeof(mylink) == 'string')
	   href = mylink;
	else
	   href = mylink.href;
	   
	pWidth = 400;
	pHeight = 300;
	
	wLeft = (screen.width - pWidth) / 2;
	wTop = (screen.height - pHeight) / 2;
	
	window.open(href, windowname,
		'width='+pWidth+','+
		'height='+pHeight+','+
		'left='+wLeft+','+
		'top='+wTop+','+
		'scrollbars=no'
	);
	return false;
	*/
}

function closePopUp()
{
	$("#popUp").fadeOut("fast");
	$("#popUpBG").fadeOut("fast");
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
