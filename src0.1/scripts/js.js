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

function popUp(content)
{
	var HTML = "";
	
	// header
	HTML += '<img src="banner_s.jpg" alt="TECH ON DEMAND" />';
	
	switch (content)
	{
	case "about":
	
		HTML += '<p class="b">About</p>';
		
		HTML += '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin felis ac nibh blandit imperdiet. Donec consequat tellus eu tortor molestie vel fermentum metus iaculis. Quisque ullamcorper metus sit amet sapien consectetur eu consequat ante consectetur. Nulla facilisi. Aenean nisi turpis, accumsan sit amet pellentesque id, vestibulum ac nisi. Maecenas quis dolor non mauris lobortis posuere. Nulla neque augue, gravida vel imperdiet id, sagittis non ante. Proin ultricies pretium nulla lacinia tempor.</p>';
		
		break;
	case "contact":
	
		HTML += '<p class="b">Contact</p>';
		
		HTML += '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin felis ac nibh blandit imperdiet. Donec consequat tellus eu tortor molestie vel fermentum metus iaculis. Quisque ullamcorper metus sit amet sapien consectetur eu consequat ante consectetur. Nulla facilisi. Aenean nisi turpis, accumsan sit amet pellentesque id, vestibulum ac nisi. Maecenas quis dolor non mauris lobortis posuere. Nulla neque augue, gravida vel imperdiet id, sagittis non ante. Proin ultricies pretium nulla lacinia tempor.</p>';
		
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
