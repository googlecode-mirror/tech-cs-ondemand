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

function popUp(mylink, windowname)
{
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
