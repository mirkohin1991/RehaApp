<?php

// LocalPath has to be replaced by ServerPath when going live
$strLocalPath = "/dhbw";
$strServerPath = "";
$strContentPath;
function getContentPath() {
	global $strLocalPath;
	$strContentPath = "." . $strLocalPath . $_SESSION ['xmlSource'];
	return $strContentPath;
}

// delivering the last available node
function getMaxNode() {
	if (file_exists ( getContentPath () )) {
		$xmlobj = simplexml_load_file ( getContentPath () );
		if ($xmlobj)
			$nodeMax = $xmlobj->Article->count () - 1;
		else
			$nodeMax = - 1;
	}
	return $nodeMax;
}
function getNodeCount() {
	if (file_exists ( getContentPath () )) {
		$xmlobj = simplexml_load_file ( getContentPath () );
		if ($xmlobj)
			$nodeCount = $xmlobj->Article->count ();
		else
			$nodeCount = - 1;
	}
	return $nodeCount;
}
function getTitle($nbr) {
	$strRet = "XML-Datei nicht gefunden.";
	
	if (file_exists ( getContentPath () )) {
		$contentPath = getContentPath ();
		$xmlobj = simplexml_load_file ( $contentPath );
		if ($xmlobj) {
			// get XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
			$strRet = ( string ) $xmlobj->Article [$nbr]->Heading;
			$strRet = iconv ( "UTF-8", "ISO-8859-1//TRANSLIT", $strRet );
		}
	}
	return $strRet;
}
function getThumbnail($nbr) {
	$strRet = "XML-Datei nicht gefunden.";
	
	if (file_exists ( getContentPath () )) {
		$xmlobj = simplexml_load_file ( getContentPath () );
		if ($xmlobj) {
			// get XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
			$strRet = ( string ) $xmlobj->Article [$nbr]->Thumbnail;
			$strRet = iconv ( "UTF-8", "ISO-8859-1//TRANSLIT", $strRet );
		}
	}
	return $strRet;
}
function getShorttext($nbr) {
	$strRet = "XML-Datei nicht gefunden.";
	
	if (file_exists ( getContentPath () )) {
		$xmlobj = simplexml_load_file ( getContentPath () );
		if ($xmlobj) {
			// get XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
			$strRet = ( string ) $xmlobj->Article [$nbr]->ShortText;
			$strRet = iconv ( "UTF-8", "ISO-8859-1//TRANSLIT", $strRet );
		}
	}
	return $strRet;
}
function getLongtext($nbr) {
	$strRet = "XML-Datei nicht gefunden.";
	
	if (file_exists ( getContentPath () )) {
		$xmlobj = simplexml_load_file ( getContentPath () );
		if ($xmlobj) {
			// TEST EH
			// print_r ($xmlobj);
			
			// get XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
			$strRet = ( string ) $xmlobj->Article [$nbr]->Text;
			$strRet = iconv ( "UTF-8", "ISO-8859-1//TRANSLIT", $strRet );
		}
	}
	return $strRet;
}
function checkFileSize() {
	//loading the size of the selected file
	$value = ($_FILES ['thumbnail'] ['size']);
	
	//Only 100kb allowed
	$maxSize = 102400;
	
	if (! empty ( $value )) {
		//picture is to big
		if ($value > $maxSize) {
			return false;
		} else {
			return true;
		}
		// no picture found
	} else {
		return false;
	}
}

//Check if the user selected a file with valid format 
function checkFileFormat() {
	$imageData = @getimagesize ( $_FILES ["thumbnail"] ["tmp_name"] );
	
	//only JPG allowed
	if ($imageData === FALSE || ! ($imageData [2] == IMAGETYPE_JPEG)) {
		return false;
	} else {
		return true;
	}
}


function uploadDiet() {
	
	define ( "UPLOAD_DIR", getContentPath () );
	unlink ( UPLOAD_DIR, "Speiseplan.jpg" );
	
	// Uploading the file, if no error 
	if (isset ( $_FILES ["thumbnail"] ) and ! $_FILES ["thumbnail"] ["error"]) {
		
		$result = @move_uploaded_file ( $_FILES ["thumbnail"] ["tmp_name"], UPLOAD_DIR . "Speiseplan.jpg" );
		
		//Upload was successful
		if ($result == true)
			return true;
		else 
			return false;
		
	} else {
		return false;
	}
}

;
function uploadThumbnail($nbr) {
	
	define ( "UPLOAD_DIR", "dhbw/HomeContent/" );
	
	unlink ( UPLOAD_DIR, "image_art_" . $nbr . ".jpg" );
	
     // Uploading the file, if no error 
	if (isset ( $_FILES ["thumbnail"] ) and ! $_FILES ["thumbnail"] ["error"]) {
		
		$result = @move_uploaded_file ( $_FILES ["thumbnail"] ["tmp_name"], UPLOAD_DIR . "image_art_" . $nbr . ".jpg" );
	
		//Upload was successful
		if ($result == true)
			return true;
		else 
			return false;
		
	} else {
		return false;
	}
}


function checkPictureAvailable($nbr){
	
	if(file_exists(getThumbnail($nbr))) {
		return true;
	} else {
		return false;
	}
}

function checkDietAvailable() {
	if(file_exists("dhbw/SpeiseplanContent/Speiseplan.jpg")) {
		return true;
	} else {
		return false;
	}
}

// -->
?>