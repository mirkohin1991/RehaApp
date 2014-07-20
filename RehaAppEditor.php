<?php

// 2013-07-03 first implementation, E.Hanser (Ha)
// 2013-07-25 Ha
session_start ();

include ("RehaAppEdFunc.php");

// TEST EH
/*
 * foreach($_SESSION as $key => $value) { echo "<b>".$key.":</b> ".$value."<br />"; }
 */

// set $nbrNode from SESSION variable
if (isset ( $_SESSION ['nbrNode'] ))
	$nbrNode = $_SESSION ['nbrNode'];
else {
	$nbrNode = 0;
	$_SESSION ['nbrNode'] = $nbrNode;
}

?>

<head>
<style type="text/css">
.style1 {
	width: 448px;
}

#Button1 {
	width: 183px;
}

#Button2 {
	width: 149px;
}

#btnLoad {
	width: 119px;
}

#btnStore {
	width: 192px;
}

.style2 {
	background-color: #CCCCCC;
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: small;
}

.style3 {
	color: #000000;
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: small;
}

#TextArea1 {
	width: 800px;
	height: 267px;
	margin-top: 0px;
}

.style4 {
	background-color: #CCCCCC;
	height: 267px;
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: small;
}

.style5 {
	width: 448px;
	height: 267px;
}

.style6 {
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: small;
	width: 382px;
}

.style7 {
	background-color: #CCCCCC;
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: small;
	width: 96px;
}

#btnChg {
	width: 192px;
}
</style>
</head>

<BODY>
	<div style="font-family: verdana">
		<h1>
			<img alt="" src="ic_launcher.png"
				style="width: 122px; height: 113px;" /><img alt=""
				src="logo_dhbw_loe.png" style="height: 113px; width: 261px" />
		</h1>
		<h1 style="font-style: italic">Reha App -
			Content-Editor&nbsp;&nbsp;&nbsp;</h1>
		<h3>&quot;Home&quot;-Inhalte:</h3>
		<i
			style="background-color: #CCCCCC; font-family: Arial, Helvetica, Sans-Serif; font-size: x-small; color: #FFFFFF;">(Eckhart
			Hanser, 25.07.2013, V0.94)</i><br>
		<br>
		<FORM NAME="frm_change" ACTION="RehaAppEdChg.php" METHOD="POST"
			style="width: 900px">
			<TABLE>
				<TR>
					<TD style="text-align: right" class="style7">Inhalt</TD>
					<TD class="style1"><SELECT id="selectContentID"
						name="selectContent" class="style6">
<?php
for($i = 0; $i <= getMaxNode (); $i ++) {
	if ($i == $nbrNode)
		echo "<OPTION SELECTED>" . getTitle ( $i ) . "</OPTION>";
	else
		echo "<OPTION>" . getTitle ( $i ) . "</OPTION>";
}
?>					
				</SELECT></TD>
				</TR>
			</TABLE>
			<INPUT id="btnChg" type="submit" name="change" value="wechseln" />
		</FORM>
		<FORM NAME="frm_save" ACTION="RehaAppEdSave.php" METHOD="POST"
			style="width: 900px">
			<TABLE>
				<TR>
					<TD style="text-align: right" class="style2">Überschrift</TD>
					<TD class="style1"><INPUT NAME="title" TYPE="Text"
						VALUE="<?php echo getTitle($nbrNode) ?>" style="width: 800px"
						class="style6"><span class="style6"> </span></TD>
				</TR>
				<TR>
					<TD style="text-align: right; background-color: #CCCCCC;"
						class="style3">Bild</TD>
					<TD class="style1"><INPUT NAME="thumbnail" TYPE="Text"
						VALUE="<?php echo getThumbnail($nbrNode) ?>" style="width: 800px"
						class="style6"><span class="style6"> </span></TD>
				</TR>
				<TR>
					<TD style="text-align: right; background-color: #CCCCCC;"
						class="style6">Kurztext</TD>
					<TD class="style1"><INPUT NAME="shorttext" TYPE="Text"
						VALUE="<?php echo getShorttext($nbrNode) ?>" style="width: 800px"
						class="style6"><span class="style6"> </span></TD>
				</TR>
				<TR>
					<TD style="text-align: right" class="style4">Text</TD>
					<TD class="style5"><textarea id="TextArea1" name="longtext"
							class="style6" cols="20"><?php echo getLongtext($nbrNode) ?></textarea></TD>
				</TR>
			</TABLE>
			<INPUT id="btnStore" type="submit" name="store" value="speichern" />
		</FORM>
	</div>
</BODY>
</HTML>
