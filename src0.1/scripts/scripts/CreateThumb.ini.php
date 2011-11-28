<?php
// Variables
$width = 250.0;
$height = 170.0;

// Setter Functions
function setSize($h, $w)
{
	global $height, $width;
	$height = $h;
	$width = $w;
}

// Public Function
function savePicture($fileArray)
{
	$size = $_FILES["file"]["size"] / 1000;
	if($size < 150)
	{
		$dir = '../scripts/RTEpics';
		$count = 0;
		if(is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while ($file = readdir($handle)) 
				{
					if (($file <> ".") && ($file <> "..")) 
					{
						$count++;
					}
				}
				closedir($handle);
			} 
			$file = crteForumThumb($_FILES["file"]["tmp_name"], "$dir/$count.jpg", $_FILES["file"]["type"] , $count);
			return "http://www.admin.DEdesigns.org/scripts/RTEpics/$file";
		}
		else
			return "Could Not Find the Specified Directory.";
	}
	else
		return "File is too large ($size KB). Please make image smaller than 150 KB.";
}

// Private Picture Functions
function crteThumb($sourceImage, $savePath, $id, $type)
{
	if($type == 'image/jpeg')
	{
		$src = imagecreatefromjpeg($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/gif')
	{
		$src = imagecreatefromgif($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/png')
	{
		$src = imagecreatefrompng($sourceImage);
		$continue = 1;
	}

	if($continue)
	{
		$ext = ".jpg";
		$size = getimagesize($sourceImage);
		$sw = $size[0];
		$sheight = $size[1];
		$width = 230.0;
		$height = 250.0;
		$test = $height/$sheight - $width/$sw;
		if($test <= 0)
		{	
			$swidth = $sw;
			$width = (int)($swidth * $height / $sheight);
			$hoff = 0;
		}
		else
		{
			$swidth = $width * $sheight / $height;
			$hoff = (int)(($sw - $swidth)/2);
		}
		$dst = imagecreatetruecolor($width,$height);
		imagecopyresized($dst, $src, 0, 0, $hoff, 0, $width,$height,$swidth,$sheight);
		$saveHere = $savePath . $id . $ext;
		imagejpeg($dst, $saveHere);
		imagedestroy($src);
		imagedestroy($dst);
		return "$id$ext";
	}
	else
		return NULL;
}

function crteForumThumb($sourceImage, $savePath, $type, $id)
{
	global $height, $width;
	
	if($type == 'image/jpeg')
	{
		$src = imagecreatefromjpeg($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/gif')
	{
		$src = imagecreatefromgif($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/png')
	{
		$src = imagecreatefrompng($sourceImage);
		$continue = 1;
	}

	if($continue)
	{
		$size = getimagesize($sourceImage);
		$sw = $size[0];
		$sheight = $size[1];
		$test = $height/$sheight - $width/$sw;
		if($test <= 0)
		{	
			$swidth = $sw;
			$width = (int)($swidth * $height / $sheight);
			$hoff = 0;
		}
		else
		{
			$swidth = $width * $sheight / $height;
			$hoff = (int)(($sw - $swidth)/2);
		}
		$dst = imagecreatetruecolor($width,$height);
		imagecopyresized($dst, $src, 0, 0, $hoff, 0, $width,$height,$swidth,$sheight);
		$saveHere = $savePath;
		imagejpeg($dst, $saveHere);
		imagedestroy($src);
		imagedestroy($dst);
		return "$id.jpg";
	}
	else
		return NULL;
}

function crtePgalThumb($sourceImage, $savePath, $id, $type)
{
	if($type == 'image/jpeg' || $type == 2)
	{
		$src = imagecreatefromjpeg($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/gif' || $type == 1)
	{
		$src = imagecreatefromgif($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/png' || $type == 3)
	{
		$src = imagecreatefrompng($sourceImage);
		$continue = 1;
	}

	if($continue)
	{
		$ext = ".jpg";
		$size = getimagesize($sourceImage);
		$sw = $size[0];
		$sheight = $size[1];
		$width = 100.0;
		$height = 100.0;
		$test = $height/$sheight - $width/$sw;
		if($test <= 0)
		{	
			$swidth = $sw;
			$width = (int)($swidth * $height / $sheight);
			$hoff = 0;
		}
		else
		{
			$swidth = $width * $sheight / $height;
			$hoff = (int)(($sw - $swidth)/2);
		}
		$dst = imagecreatetruecolor($width,$height);
		imagecopyresized($dst, $src, 0, 0, $hoff, 0, $width,$height,$swidth,$sheight);
		$saveHere = $savePath . $id . $ext;
		imagejpeg($dst, $saveHere);
		imagedestroy($src);
		imagedestroy($dst);
		return "$id$ext";
	}
	else
		return NULL;
}

function crteThumbNoID($sourceImage, $savePath, $name, $type)
{
	if($type == 'image/jpeg' || $type == 2)
	{
		$src = imagecreatefromjpeg($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/gif' || $type == 1)
	{
		$src = imagecreatefromgif($sourceImage);
		$continue = 1;
	}
	else if($type == 'image/png' || $type == 3)
	{
		$src = imagecreatefrompng($sourceImage);
		$continue = 1;
	}

	if($continue)
	{
		$size = getimagesize($sourceImage);
		$sw = $size[0];
		$sheight = $size[1];
		$width = 100.0;
		$height = 100.0;
		$test = $height/$sheight - $width/$sw;
		if($test <= 0)
		{	
			$swidth = $sw;
			$width = (int)($swidth * $height / $sheight);
			$hoff = 0;
		}
		else
		{
			$swidth = $width * $sheight / $height;
			$hoff = (int)(($sw - $swidth)/2);
		}
		$dst = imagecreatetruecolor($width,$height);
		imagecopyresized($dst, $src, 0, 0, $hoff, 0, $width,$height,$swidth,$sheight);
		$saveHere = $savePath . $name;
		imagejpeg($dst, $saveHere);
		imagedestroy($src);
		imagedestroy($dst);
		return $name;
	}
	else
		return NULL;
}
?>
