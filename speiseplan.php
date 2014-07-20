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


// Hier wird jeweils reingeschrieben um welche Seite es sich handelt
 $_SESSION['xmlSource'] = "/SpeiseplanContent/";
 $_SESSION['pageSource'] = "speiseplan.php";

?>



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

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- CSS ==================================================
================================================== -->

<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/skeleton.css">
<link rel="stylesheet" href="css/screen.css">
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />

<!-- Favicons ==================================================
================================================== -->

<link rel="shortcut icon" href="images/favicon.png">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<!-- Google Fonts ==================================================
================================================== -->

<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- Home - Content Part ==================================================
================================================== -->
<div id="header">
  <div class="container header"> 
    <!-- Header | Logo, Menu
    ================================================== -->
        <header>
      <div class="logo"><a href="index.php"><img src="images/logo.png" alt="" width="57%" /></a></div>
      <div class="mainmenu">
        <div id="mainmenu">
          <ul class="sf-menu">
            <li><a href="index.php"><span class="home"><img src="images/home.png" alt="" /></span>Home</a></li>
            <li><a href="freizeit.php"><span class="home"><img src="images/freizeit.png" alt="" /></span>Freizeit</a></li>
            <li><a href="soziales.php"><span class="home"><img src="images/sozial.png" alt="" /></span>Soziales</a></li>
            <li><a href="speiseplan.php" id="visited"><span class="home"><img src="images/speiseplan.png" alt="" /></span>Speiseplan</a></li>
            <li><a href="news-infos.php"><span class="home"><img src="images/news.png" alt="" /></span>News / Infos</a></li>
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
        <li>Hier k&ouml;nnen Sie die Texte eingeben, die auf der Startseite der App angezeigt werden.</li>
      </ul>
    </section>
  </div>
  <!-- one_third ends here -->

  <div class="two_third lastcolumn contact1"> 
    <div id="contactForm">
      <h2>Inhalte der Speisekarte Seite</h2>
      <div class="sepContainer"></div>
      <form action="save.php" method="post" id="contact_form" enctype="multipart/form-data" style="min-height:280px">
    
       <div class="kurztext">
          <label for="bild">Speiseplan:</label>
          <?php 
          if (checkDietAvailable()  == true) {
							echo '<div> <img alt="" class="img-background" style="width:300px;" margin-top:2%" src="dhbw/SpeiseplanContent/Speiseplan.jpg"></div>';
						}
						?>
  
          
          <input id="thumbnail" name="thumbnail" type="file" accept=".jpg" required />
          
          <?php if (isset($_SESSION['file_error'])) {
         					  echo '<img src="images/error.png" style="width:14px;" alt=""><span style="color:#c80226">' . $_SESSION['file_error'] . '</span>';
         					   unset($_SESSION['file_error']);
         					 }?>


        </div>

        
        <div style="padding-top:20px;" id="loader">
          <input type="submit" name="uploadDiet" value="Speichern" />
             
             <?php      
                    if (isset ( $_SESSION ['file_saved'] )) {
                  echo '<img src="images/check.png" style="width:22px;" alt=""><span style="color:#80c78f">' . $_SESSION ['file_saved'] . '</span>';
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
<!-- copyright ends here --> 
<!-- End Document
================================================== --> 
<!-- Scripts ==================================================
================================================== --> 
<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script> 

<!-- Main js files --> 
<script src="js/screen.js" type="text/javascript"></script> 
<!-- Tooltip --> 
<script src="js/poshytip-1.0/src/jquery.poshytip.min.js" type="text/javascript"></script> 
<!-- Include prettyPhoto --> 
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script> 
<!-- Include Superfish --> 
<script src="js/superfish.js" type="text/javascript"></script> 
<script src="js/hoverIntent.js" type="text/javascript"></script> 
<!-- Flexslider --> 
<script src="js/jquery.flexslider-min.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/modernizr.custom.29473.js"></script>
</body>
</html>