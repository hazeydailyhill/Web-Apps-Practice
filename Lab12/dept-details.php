<?php 
/* Script Name: dept_details.php
   Names: Bryan Portillo and Haley Hill
   Url: https://nrs-projects.humboldt.edu/~hh125/328lab12/dept-det
ails.php
*/

session_start();

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!-- class HTML template: last modified 2023-02-13 -->

<!--
    by: Bryan Portillo and Haley Hill
    last modified: 4/24/2023

    you can run this using the URL:
	https://nrs-projects.humboldt.edu/~hh125/328lab12/dept-det
ails.php
-->

<head>
    <title> page title here </title>
    <meta charset="utf-8" />
    <?php
	require_once("hsu_conn_sess.php");
	require_once("create_login_form.php");
	require_once("create_dept_dropdown.php");
	require_once("get_dept_info.php");
	//require_once("name-pwd-fieldset.html");
	//require_once("complain_and_exit.php");	
    ?>

</head>

<body>
    <h1> CS 328 - Wk 12 Lab </h1> 
    <?php
	if(! array_key_exists("next_state", $_SESSION))
	{
	     create_login_form("USERNAME", "PASSWORD", "SUBMIT");
       	     $_SESSION["next_state"] = "dept_drop";
	}
	elseif ($_SESSION["next_state"] == "dept_drop")
	{     
	     create_dept_dropdown();
	     $_SESSION["next_state"] = "dept_choice";	
	}
	elseif ($_SESSION["next_state"] == "dept_choice")
	{
	     get_dept_info();
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

