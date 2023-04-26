<?php
    function create_pub_dropdown()
    {
	$_SESSION['USERNAME'] = $_POST["USERNAME"];
	$_SESSION['PASSWORD'] =	$_POST["PASSWORD"];
	$conn = hsu_conn_sess($_SESSION['USERNAME'], $_SESSION['PASSWORD']);
	if((!array_key_exists("USERNAME", $_SESSION)) or
	   (trim($_SESSION["USERNAME"]) == "") or
	   (! isset ($_SESSION["USERNAME"])))
	{
	?>
	   <h2> Failed Connection </h2>
	<?php
	}
	?>

	<h1> Hello <?= $_SESSION["USERNAME"] ?>, choose a publisher! </h1>
	<?php
	$pub_name_qry = "select pub_name
				from publisher";
	$pub_name_stmt = oci_parse($conn, $pub_name_qry);
	oci_execute($pub_name_stmt, OCI_DEFAULT);
	?>
	<form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
		<select name="pubs">
		<?php
		while(oci_fetch($pub_name_stmt))
		{
			$curr_pub_name = oci_result($pub_name_stmt, 1);
		?>
			<option value="<?= $curr_pub_name ?>"> <?=$curr_pub_name ?> </option>
			<?php
		}
	?>
	<input type="submit" value="SUBMIT" />
	</form>
	<?php
	
	}
?>
