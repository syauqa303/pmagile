<?

/*write a file
params $filename and content
returns nothing*/
function writeFile($fileName,$content){
	$filename = $fileName;
	$somecontent = $content;

// Let's make sure the file exists and is writable first.
	if (is_writable($filename)) {
	
	    // In our example we're opening $filename in append mode.
	    // The file pointer is at the bottom of the file hence 
	    // that's where $somecontent will go when we fwrite() it.
	    if (!$handle = fopen($filename, 'a')) {
	         echo "Cannot open file ($filename)";
	         exit;
	    }
	
	    // Write $somecontent to our opened file.
	    if (fwrite($handle, $somecontent) === FALSE) {
	        echo "Cannot write to file ($filename)";
	        exit;
	    }
	    
	    echo "Success, wrote ($somecontent) to file ($filename)";
	    
	    fclose($handle);
	                    
	} else {
	    echo "The file $filename is not writable";
	}
}

//copys an image in a lower resolution
function copyimg($src,$dest,$mw=500,$mh=500){
	$ar = array();
	$ar = getimagesize($src);
	$ratio=1;
	if($ar[0]>$mw || $ar[1]>$mh){
		if($ar[0]>$mw){ //width beshi
			$ratio = $ar[0]/$mw;
		}
		else{
			$ratio = $ar[1]/$mh;
		}
	}
	$width = $ar[0]/$ratio;
	$height = $ar[1]/$ratio;
	$imd = @imagecreatetruecolor($width,$height);
	if($ratio==1){
		copy($src,$dest);
	}else{
		$ims = @imagecreatefromjpeg($src);
		imagecopyresampled($imd,$ims,0,0,0,0,$width,$height,$ar[0],$ar[1]);
		imagejpeg($imd,$dest);
	}
}
?>