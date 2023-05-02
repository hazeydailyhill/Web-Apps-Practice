<?php
    function create_isbn_dropdown()
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

	<h1> Hello <?= $_SESSION["USERNAME"] ?>, choose an isbn! </h1>
	<?php
	$ttl_isbn_qry = "select ttl_isbn, ttl_name
				from title";
	$ttl_isbn_stmt = oci_parse($conn, $ttl_isbn_qry);
	oci_execute($ttl_isbn_stmt, OCI_DEFAULT);
	?>
	<form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
		<select name="isbn_choice">
		<?php
		while(oci_fetch($ttl_isbn_stmt))
		{
			$curr_ttl_isbn = oci_result($ttl_isbn_stmt, 1);
			$curr_ttl_name = oci_result($ttl_isbn_stmt, 2);
		?>
			<option value="<?= $curr_ttl_isbn ?>"> <?= $curr_ttl_isbn?> - <?=$curr_ttl_name ?> </option>
			<?php
		}
	?>
	<input type="submit" value="SUBMIT" />
	</form>
	<?php
	
	}
?>
