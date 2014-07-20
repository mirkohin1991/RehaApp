<?php


// Liefert den selektieren Eintrag
 $nbrNode = $_POST["selectedEntry"];


// set SESSION variable nbrNode
session_start();

$_SESSION['nbrNode'] = $nbrNode;


// redirect to editor	
header("Location: index.php");

?>