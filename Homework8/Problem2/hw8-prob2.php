<?php
/* Script Name: hw8-prob2.php
   By: Haley Hill
   URL: https://nrs-projects.humboldt.edu/~hh125/328hw8/hw8-prob2.php
*/
session_start();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--
    URL you can run this from:
    https://nrs-projects.humboldt.edu/~hh125/328hw8/hw8-prob2.php

    Haley Hill
    last modified: 2023-04-26
-->

<head>
   <title> Homework 8 Problem 2 </title>
   <meta charset="utf-8"/>

   <link href="http://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
          type="text/css" rel="stylesheet" />
    <link href="bks.css" type="text/css" rel="stylesheet"/>

   <?php
	require_once("hsu_conn_sess.php");
	require_once("create_login_form.php");
	require_once("hw8-prob2-dropdown.php"); //create_isbn_dropdown()
	require_once("hw8-prob2-function.php"); //call_title_total_cost()
   ?>
</head>
<body>
	<h1> Wild Reeds Bookstore </h1>
	<h2> Haley Hill </h2>
	<?php
	   if(! array_key_exists("next_state", $_SESSION))
	   {
		create_login_form("USERNAME", "PASSWORD", "SUBMIT");
		$_SESSION["next_state"] = "isbn_drop";
	   }
	   elseif($_SESSION["next_state"] == "isbn_drop")
	   {
		create_isbn_dropdown();
		$_SESSION["next_state"] = "isbn_choice";
	   }
	  elseif($_SESSION["next_state"] == "isbn_choice")
	  {
		call_title_total_cost();
		session_destroy();
	  }
	?>
</body>
</html>

