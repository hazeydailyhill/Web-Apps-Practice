<?php
    function create_login_form($username_field, $password_field, $
submit_label)
	{
	    
	    if($_SERVER["REQUEST_METHOD"] == "GET")
	    {
		?>
	    <form method="post" action="<?= htmlentities($_SERVER[
'PHP_SELF'], ENT_QUOTES) ?>">
	    <fieldset>
	    <?php
	    if($username_field != " " && $password_field != " ")
	    {
		//echo "$username_field", "$password_field";
		?>
	    	<input type="text" name="<?= $username_field ?>" i
d="<?= $username_field ?>"  />
                <label for="<?= $username_field ?>"> Username </la
bel><br />
		<input type="password" name="<?= $password_field ?
>" id="<?= $password_field ?>"  />
		<label for="<?= $password_field ?>"> Password </la
bel><br />
	    <input type="submit" value="<?= $submit_label?>" />
	    </fieldset>
	    </form>
	    <?php
	    }
	    }
	    else{
		//print_R($_POST);		
		//$_SESSION["USERNAME"] = $_POST["USERNAME"];
		//$_SESSION["PASSWORD"] = $_POST["PASSWORD"]; 
	    }
	}
?>
