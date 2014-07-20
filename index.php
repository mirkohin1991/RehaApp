
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>

<!-- Set Global PHP Variables ================================================== 
	================================================== -->    
	<?php
	
	// 2013-07-03 first implementation, E.Hanser (Ha)
	// 2013-07-25 Ha
	session_start ();
	
	include ("RehaAppEdFunc.php");
	
	// set $nbrNode from SESSION variable
	// Mirko: Damit ist es möglich den ausgewählten Toggle-Button zu speichern!
	if (isset ( $_SESSION ['nbrNode'] ))
		$nbrNode = ( int ) $_SESSION ['nbrNode'];
	else {
		$nbrNode = 0;
		$_SESSION ['nbrNode'] = $nbrNode;
	}
	
	// Hier wird jeweils reingeschrieben um welche Seite es sich handelt
	$_SESSION ['xmlSource'] = "/HomeContent/Home.xml";
	$_SESSION ['pageSource'] = "index.php";
	
	?>

<!-- End of set Global PHP Variables ================================================== 
	================================================== -->

<!-- Basic Page Needs ================================================== 
	================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title> JG Gruppe-RehaApp Editor</title>
<meta name="description" content="Place to put your description text">
<meta name="author" content="">
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

<!-- Mobile Specific Metas ================================================== 
	================================================== -->

<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- CSS ==================================================
	================================================== -->

<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/skeleton.css">
<link rel="stylesheet" href="css/screen.css">
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css"
	media="screen" />

<!-- Favicons ==================================================
	================================================== -->

<link rel="shortcut icon" href="images/favicon.png">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/apple-touch-icon-114x114.png">

<!-- Google Fonts ==================================================
	================================================== -->

<link
	href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic'
	rel='stylesheet' type='text/css'>
</head>
<body>

	<!-- Home - Content Part ==================================================
	================================================== -->
	<div id="header">
		<div class="container header">
			<!-- Header | Logo, Menu
			================================================== -->
			<header>
				<div class="logo">
					<a href="index.php"><img src="images/logo.png" alt="" width="57%" /></a>
				</div>
				<div class="mainmenu">
					<div id="mainmenu">
						<ul class="sf-menu">
							<li><a href="index.php" id="visited"><span class="home"><img
										src="images/home.png" alt="" /></span>Home</a></li>
							<li><a href="freizeit.php"><span class="home"><img
										src="images/freizeit.png" alt="" /></span>Freizeit</a></li>
							<li><a href="soziales.php"><span class="home"><img
										src="images/sozial.png" alt="" /></span>Soziales</a></li>
							<li><a href="speiseplan.php"><span class="home"><img
										src="images/speiseplan.png" alt="" /></span>Speiseplan</a></li>
							<li><a href="news-infos.php"><span class="home"><img
										src="images/news.png" alt="" /></span>News / Infos</a></li>
						</ul>
					</div>

					<!-- Responsive Menu -->

					<form id="responsive-menu" action="#" method="post">
						<select>
							<option value="">Navigation</option>
							<option value="index.php">Home</option>
							<option value="freizeit.php">Freizeit</option>
							<option value="soziales.php">Soziales</option>
							<option value="speiseplan.php">Speiseplan</option>
							<option value="news-infos.php">News / Infos</option>
						</select>
					</form>
				</div>
			</header>
		</div>
	</div>


	<!-- Contact Content Part - Contact Form ==================================================
	================================================== -->
	<div class="container" style="min-height: 600px;">
		<div class="blankSeparator"></div>
		<!-- Contact Sidebar ==================================================
		================================================== -->
		<div class="one_third contactsidebar">
			<section class="first">
				<h3>Reha App Content Editor</h3>
				<div class="boxtwosep"></div>
				<ul class="contactsidebarList">
					<li>Angemeldet als: Benutzername</li>
					<li>Hier k&ouml;nnen Sie die Texte eingeben, die auf der Startseite der
						App angezeigt werden.</li>
				</ul>
			</section>
		</div>
		<!-- one_third ends here -->



		<div class="two_third lastcolumn contact1">
			<div id="contactForm">
				<h2>Inhalte der Home Seite</h2>

				<div class="sepContainer"></div>

				<div style="color: black">
					<form action="RehaAppEdChg.php" method="post">
						<label style="float: left" class="radio_button"> <input type="radio"
							name="selectedEntry" value="0"
							<?php if ($nbrNode == 0) { echo 'checked="checked"';} ?>
							onclick="javascript: submit()"> <span  style="padding-left: 15px; padding-right: 15px;">Eintrag 1</span>
						</label> <label > <input type="radio" name="selectedEntry" 
							value="1"
							<?php if ($nbrNode == 1) { echo 'checked="checked"'; } ?>
							onclick="javascript: submit()"> <span style="padding-left: 15px; padding-right: 15px;">Eintrag 2</span>
						</label>

					</form>
				</div>
				<form action="<?php echo 'save.php?nodeID=' . $nbrNode ?>"
					method="post" id="contact_form" enctype="multipart/form-data">

					<div class="name">
						<label for="name">Überschrift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
						<?php 
						if (isset ( $_SESSION ['heading_empty'] )) {
							echo '<span><img src="images/error.png" style="width:14px;" alt=""><span style="color:#c80226">' . $_SESSION ['heading_empty'] . '</span>';
							unset ( $_SESSION ['heading_empty'] );
						}
						?>
						</label> 

						<input id=heading name=heading type=text VALUE="<?php echo getTitle($nbrNode) ?>"/>
							
					</div>
					<div class="kurztext">
						<label for="bild">Bild:</label> 
						
						<?php
						
					if (checkPictureAvailable ( $nbrNode ) == true) {
							echo '<div> <img alt="" class="img-background" style="width:100px;" src="' . getThumbnail ( $nbrNode ) . '"> </div>';
						}
						?>
						
						<input id=thumbnail name=thumbnail type="file" accept=".jpg"
							<?php
							
					if (checkPictureAvailable ( $nbrNode ) == false) {
								echo 'required';
							}
							?> /> 

							 	<?php
									
									if (isset ( $_SESSION ['file_error'] )) {
										echo '<img src="images/error.png" style="width:14px;" alt=""><span style="color:#c80226">' . $_SESSION ['file_error'] . '</span>';
										unset ( $_SESSION ['file_error'] );
									}
									?>
						</div>
					<div class="kurztext">
						<label for="kurztext">Kurztext:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
						if (isset ( $_SESSION ['shorttext_empty'] )) {
							echo '<span><img src="images/error.png" style="width:14px;" alt=""><span style="color:#c80226">' . $_SESSION ['shorttext_empty'] . '</span>';
							unset ( $_SESSION ['shorttext_empty'] );
						}
						?>
						</label> 
						<textarea id=shortText name=shortText type=text
							style="height: 50px;" /><?php echo getShorttext($nbrNode) ?></textarea>
					</div>

					<div class="message">
						<label for="message">Text:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
						if (isset ( $_SESSION ['text_empty'] )) {
							echo '<span><img src="images/error.png" style="width:14px;" alt=""><span style="color:#c80226">' . $_SESSION ['text_empty'] . '</span>';
							unset ( $_SESSION ['text_empty'] );
						}
						?>
						</label> 
						<textarea id=text name=text  rows="15"><?php echo getLongtext($nbrNode)  ?></textarea>
					</div>
					<div id="loader">
						<input type="submit" name="saveContent" value="Speichern" />
													 
					<?php
					if (isset ( $_SESSION ['file_saved'] )) {
						echo '<span><img src="images/check.png" style="width:22px;" alt=""><span style="color:#80c78f">' . $_SESSION ['file_saved'] . '</span>';
						unset ( $_SESSION ['file_saved'] );
					}
					?>
					</div>
				</form>
			</div>
			<!-- end contactForm -->
		</div>
	</div>
	<div class="blankSeparator2"></div>
	<!--Footer ==================================================
	================================================== -->
	<div id="copyright">
		<div class="container">
			<div class="eleven columns alpha">
				<div class="copyright">
					&copy; Copyright
					<script type="text/javascript" language="JavaScript"> 
						actDate = new Date(); 
						actYear = actDate.getFullYear(); 
						document.write(actYear);
					</script>
					. BFW
				</div>
			</div>

		</div>
		<!-- container ends here -->
	</div>
</body>
</html>