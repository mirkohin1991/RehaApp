<?php
session_start ();

include 'RehaAppEdFunc.php';

$file_size_error = ' Die ausgewählte Datei ist zu groß. (maximal 100 KB)';
$file_format_error = ' Bilder sind nur im .jpg-Format erlaubt';
$file_upload_error = 'Beim Upload ist ein Fehler passiert';
$file_saved = ' Eintrag gespeichert';
$heading_empty = ' Bitte geben Sie eine Überschrift ein';
$shorttext_empty = ' Bitte geben Sie einen Kurztext ein';
$text_empty = ' Bitte geben Sie einen Text ein';

if (isset ( $_POST ['saveContent'] ) || isset ( $_POST ['deleteContent'] )) {
	
	// Load XML
	$xml = new DOMDocument ( '1.0', 'utf-8' );
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	
	$contentPath = getContentPath ();
	$xml->load ( $contentPath );
}

if (isset ( $_POST ['saveContent'] )) {
	
	$node = ( int ) $_GET ['nodeID'];
	
	if (  $_FILES ['thumbnail']['name'] != "" ) {
		
		if (checkFileFormat () == true) {
			
			if (checkFileSize () == true) {
				unset ( $_SESSION ['file_error'] );
				
				$result = uploadThumbnail ( $node );
				
				if ($result == false) {
					$_SESSION ['file_error'] = $file_upload_error;
				}
			} else {
				$_SESSION ['file_error'] = $file_size_error;
			}
		} else {
			
			$_SESSION ['file_error'] = $file_format_error;
		}
	}
	
	// set XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
	if (isset ( $_POST ["heading"] )) {
		if (empty($_POST["heading"])) {
			$_SESSION ['heading_empty'] = $heading_empty;
		} else {
			$strTitle = $_POST ["heading"];
			$strTitle = iconv ( "ISO-8859-1//TRANSLIT", "UTF-8", $strTitle );
			unset( $_SESSION ['heading_empty']);
		}
	}
	
	if (isset ( $_POST ["shortText"] )) {
		if (empty($_POST["shortText"])) {
			$_SESSION ['shorttext_empty'] = $shorttext_empty;
		} else {
			$strShorttext = $_POST ["shortText"];
			$strShorttext = iconv ( "ISO-8859-1//TRANSLIT", "UTF-8", $strShorttext );
			unset(	$_SESSION ['$shorttext_empty']);
		}
	}
	
	if (isset ( $_POST ["text"] )) {
		if (empty($_POST["text"])) {
			$_SESSION ['text_empty'] = $text_empty;
		} else {
			$strLongtext = $_POST ["text"];
			$strLongtext = iconv ( "ISO-8859-1//TRANSLIT", "UTF-8", $strLongtext );
			unset(	$_SESSION ['$text_empty']);
		}
	}
	
	// It's a new entry
	if (getMaxNode () < $node) {
		
		$newItem = $xml->createElement ( 'Article' );
		$newItem->appendChild ( $xml->createElement ( 'Heading', $strTitle ) );
		$newItem->appendChild ( $xml->createElement ( 'ShortText', $strShorttext ) );
		$newItem->appendChild ( $xml->createElement ( 'Text', $strLongtext ) );
		
		$xml->getElementsByTagName ( 'SmartCruizerData' )->item ( 0 )->appendChild ( $newItem );
	}
	
	// It's an existing entry
	if (getMaxNode () >= $node) {
		
		// Get item Element
		$element = $xml->getElementsByTagName ( 'Article' )->item ( $node );
		// Load child elements
		$heading = $element->getElementsByTagName ( 'Heading' )->item ( 0 );
		$shorttext = $element->getElementsByTagName ( 'ShortText' )->item ( 0 );
		$text = $element->getElementsByTagName ( 'Text' )->item ( 0 );
		
		// set XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
		if (isset ( $_POST ["heading"] )) {
			$heading->nodeValue = $strTitle;
		}
		
		if (isset ( $_POST ["shortText"] )) {
			$shorttext->nodeValue = $strShorttext;
		}
		
		if (isset ( $_POST ["text"] )) {
			$text->nodeValue = $strLongtext;
		}
		
		// Replace old elements with new ones
		$element->replaceChild ( $heading, $heading );
		// $element->replaceChild ( $thumbnail, $thumbnail );
		$element->replaceChild ( $shorttext, $shorttext );
		$element->replaceChild ( $text, $text );
	}
	

//Checks if the form fields are not empty. If not, save the content and show a message
 if ( 
        //There is no heading/shortText/text-field within the form or there is one and not empty
 		(!isset($_POST["heading"]) || !empty($_POST["heading"])) 
 		&& (!isset($_POST["shortText"]) || !empty($_POST["shortText"]))
 		&& (!isset($_POST["text"]) || !empty($_POST["text"]))
)
		{
			$xml->save ( getContentPath () );
		}
		
	// Checks if the $_SESSION['file_error'] exists and if during validation no error occured.
	//If not, the changes has been saved
		if (! isset ( $_SESSION ['file_error'] )
         && ! isset ( $_SESSION ['heading_empty'] )
		&& ! isset ( $_SESSION ['shorttext_empty'] )
		&& ! isset ( $_SESSION ['text_empty'] )
) 
		{
			$_SESSION ['file_saved'] = $file_saved;
		}
	

}

if (isset ( $_POST ['deleteContent'] )) {
	
	$parent = $xml->getElementsByTagName ( 'SmartCruizerData' )->item ( 0 );
	
	$node = $_GET ['nodeID'];
	
	// Get item Element
	$element = $xml->getElementsByTagName ( 'Article' )->item ( $node );
	
	$parent->removeChild ( $element );
	// $xml->removeChild($element);
	
	$xml->save ( getContentPath () );
}

if (isset ( $_POST ['uploadDiet'] )) {
	
	// Call upload Function from RehaAppEdFunc.php
	
	if (checkFileFormat () == true) {
		
		if (checkFileSize () == true) {
			unset ( $_SESSION ['file_error'] );
			
			$result = uploadDiet ();
			
			if ($result == false) {
				$_SESSION ['file_error'] = $file_upload_error;
			}
		} else {
			$_SESSION ['file_error'] = $file_size_error;
		}
	} else {
		
		$_SESSION ['file_error'] = $file_format_error;
	}
	
	// Checks if the $_SESSION['file_error'] exists. If not, there are no errors. So the form was successfully saved.
	//Also if no validation errors occured, is checked
	if (! isset ( $_SESSION ['file_error'] ) ) {
		$_SESSION ['file_saved'] = $file_saved;
	}
}
// redirect to editor
header ( "Location: " . $_SESSION ['pageSource'] );
?>
