<?php
    function create_dept_dropdown()
	{
	    //print_R($_SESSION);
	    $_SESSION['USERNAME'] = $_POST["USERNAME"];
	    $_SESSION["PASSWORD"] = $_POST["PASSWORD"];
	    $conn = hsu_conn_sess($_SESSION['USERNAME'], $_SESSION
['PASSWORD']);  
	    if ( (! array_key_exists("USERNAME", $_SESSION)) or
	     	(trim($_SESSION["USERNAME"]) == "") or
	    	(! isset ($_SESSION["USERNAME"])) )
	    {
	    	//complain_and_exit('user_name_field');
	    ?>	
		<h2> Failed Connection </h2>
	    <?php
	    }
	    ?>
	    <h1> Hello <?= $_SESSION["USERNAME"] ?>, choose a depa
rtment! </h1>
	    <?php
	    $dept_name_qry = "select dept_name
			      from dept";
	    $dept_name_stmt = oci_parse($conn, $dept_name_qry);
	    oci_execute($dept_name_stmt, OCI_DEFAULT);
	    //if($_SERVER["REQUEST_METHOD"] == "GET")
	    //{
	    ?>		
	    <form method="post" action="<?= htmlentities($_SERVER[
'PHP_SELF'], ENT_QUOTES) ?>">
		<select name="depts">
	<?php	   
		while(oci_fetch($dept_name_stmt)){
			$curr_dept_name = oci_result($dept_name_st
mt, 1);
			?>
			<option value="<?= $curr_dept_name ?>"> <?
= $curr_dept_name ?> </option>
			<?php
		}
  	?>
	    <input type="submit" value="SUBMIT" />
	     </form>
	<?php
	     //}
		//else{
	//}
	}

?>
