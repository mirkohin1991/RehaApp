<?php

// 2013-07-15 first implementation, E.Hanser (Ha)
// 2013-07-25 Ha

session_start();

include ("RehaAppEdFunc.php");

// TEST EH
/*foreach($_SESSION as $key => $value)
{
	echo "<b>".$key.":</b>   ".$value."<br />";
}*/

// set $nbrNode from SESSION variable
$nbrNode = $_SESSION['nbrNode'];

// Raw XML node
$xmlstr = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<SmartCruizerData>
</SmartCruizerData>
XML;


// Submit code

// Build and save XML node
$xmlobj = simplexml_load_file($strContentPath);
if ($xmlobj)
{
	// Article number
	$articleNbr = $nbrNode;
	
  // set XML-Node, treat "Umlaute", http://tinyurl.com/lm39xc
	$strTitle = $_POST["title"];
	$strTitle = iconv ("ISO-8859-1//TRANSLIT", "UTF-8", $strTitle);
	
	$strThumbnail = $_POST["thumbnail"];
	$strThumbnail = iconv ("ISO-8859-1//TRANSLIT", "UTF-8", $strThumbnail);
	
	$strShorttext = $_POST["shorttext"];
	$strShorttext = iconv ("ISO-8859-1//TRANSLIT", "UTF-8", $strShorttext);
	
	$strLongtext = $_POST["longtext"];
	$strLongtext = iconv ("ISO-8859-1//TRANSLIT", "UTF-8", $strLongtext);
	
	// fill new object $xmlsav with new <Article>-nodes
	$xmlsav = new SimpleXMLElement($xmlstr);
	
	$nodeMax = $xmlobj->Article->count();
	for ($i = 0; $i < $nodeMax; $i++)
	{
		$xmlArticle = $xmlsav->addChild("Article");

		// set new Article node	
		if ($i == $articleNbr)
		{
			$xmlArticle->addChild("Heading", $strTitle);
			$xmlArticle->addChild("ShortText", $strShorttext);
			$xmlArticle->addChild("Thumbnail", $strThumbnail);
			$xmlArticle->addChild("Text", $strLongtext);
		}
		else
		{
			$xmlArticle->addChild("Heading", (string)$xmlobj->Article[$i]->Heading);
			$xmlArticle->addChild("ShortText", (string)$xmlobj->Article[$i]->ShortText);
			$xmlArticle->addChild("Thumbnail", (string)$xmlobj->Article[$i]->Thumbnail);
			$xmlArticle->addChild("Text", (string)$xmlobj->Article[$i]->Text);
		}
	}		
	
  // TEST EH
  //print_r ($xmlsav);

	$xmlsav->asXML($strContentPath);
}

// redirect to editor	
header("Location: RehaAppEditor.php");

?>