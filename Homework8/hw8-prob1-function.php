<?php
	function get_pub_info()
	{
		$username= $_SESSION['USERNAME'];
		$password= $_SESSION['PASSWORD'];
		$conn = hsu_conn_sess($username, $password);
		$pub_name = $_POST['pubs'];
		
		$pub_qry ="select pub_city, pub_state
				from publisher
				where pub_name = :pub_name";
		$pub_info_stmt = oci_parse($conn, $pub_qry);
		oci_bind_by_name($pub_info_stmt, ":pub_name", $pub_name);
		oci_execute($pub_info_stmt, OCI_DEFAULT);
		oci_fetch($pub_info_stmt);

		?>
		<table>
		<caption> Publisher Info </caption>
		<tr> <th scope="col"> City </th>
		     <th scope="col"> State </th>
		</tr>
		<?php
		oci_execute($pub_info_stmt, OCI_DEFAULT);		
		while(oci_fetch($pub_info_stmt))
		{
			$curr_pub_city = oci_result($pub_info_stmt, 1);
			$curr_pub_state = oci_result($pub_info_stmt, 2);
			?>
			<tr> <td> <?= $curr_pub_city ?> </td>
                 	     <td> <?= $curr_pub_state ?> </td> 
			</tr>
			<?php
		}
		?>
		</table>
	<?php		
	oci_free_statement($pub_info_stmt);	
	}	
?>
