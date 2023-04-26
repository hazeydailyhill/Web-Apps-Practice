<?php
/* Script Name: hw8-prob1.php
   By: Haley Hill
   URL: https://nrs-projects.humboldt.edu/~hh125/328hw8/hw8-prob1.php
   
   CHOICE: 
   a dynamic select statement that, based on a publisher name
   given by the user, projects the city and state for that
   publisher

*/
session_start();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--
    URL you can run this from:
    https://nrs-projects.humboldt.edu/~hh125/328hw8/hw8-prob1.php

    Haley Hill
    last modified: 2023-04-25
-->

<head>
   <title> Wild Reeds Bookstore </title>
   <meta charset="utf-8"/>
   <?php
	require_once("hsu_conn_sess.php");
	require_once("create_login_form.php");
	require_once("hw8-prob1-dropdown.php"); //create_pub_dropdown()
	require_once("hw8-prob1-function.php"); //get_pub_info()
   ?>
</head>
<body>
	<h1> Wild Reeds Bookstore </h1>
	<h2> Haley Hill <h2>
	<?php
	   if(! array_key_exists("next_state", $_SESSION))
	   {
	      create_login_form("USERNAME", "PASSWORD", "SUBMIT");
	      $_SESSION["next_state"] = "pub_drop";
	   }
	   elseif($_SESSION["next_state"] == "pub_drop")
	   {
	      create_pub_dropdown();
	      $_SESSION["next_state"] = "pub_choice";
	   }
	   elseif($_SESSION["next_state"] == "pub_choice")
	   {
	      get_pub_info();
	      session_destroy();
	   }
	?>
	<footer>
	<hr />
	<p>
	    Validate by pasting .xhtml copy's URL into<br />
            <a href="https://html5.validator.nu/">
            https://html5.validator.nu/
            </a>
    </p>
    </footer>
</body>
</html>
