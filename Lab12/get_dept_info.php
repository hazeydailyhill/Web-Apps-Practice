<?php
	function get_dept_info()
	{
		$username= $_SESSION['USERNAME'];
		$password= $_SESSION['PASSWORD'];
		$conn = hsu_conn_sess($username, $password);
		$dept_name = $_POST['depts'];
		
		$dept_qry = "select dept_num 
			     from dept
			     where dept_name = :dept_name";
		$dept_info_stmt = oci_parse($conn, $dept_qry);
		oci_bind_by_name($dept_info_stmt, ":dept_name", $d
ept_name);
		oci_execute($dept_info_stmt, OCI_DEFAULT);
		oci_fetch($dept_info_stmt);

		$dept_name = oci_result($dept_info_stmt, 1);
		$dept_qry = "select dept_loc, count(*), max(salary
)
				  from dept d, empl e
				  where d.dept_num = e.dept_num
					and d.dept_num = :dept_num
_choice
				  group by dept_loc";
		$dept_info_stmt = oci_parse($conn, $dept_qry);
		oci_bind_by_name($dept_info_stmt, ":dept_num_choic
e", $dept_name);
		?>
		<table>
		<caption> Dept Query Result </caption>
		<tr> <th scope="col"> Location </th>
		     <th scope="col"> Count </th>
		     <th scope="col"> Salary </th>
		</tr>
		<?php
		oci_execute($dept_info_stmt, OCI_DEFAULT);
		//oci_execute($dept_info_stmt));		
		while(oci_fetch($dept_info_stmt))
		{
			//print_R(oci_result($dept_info_stmt, 1));
			$curr_dept_loc = oci_result($dept_info_stm
t, 1);
			$curr_dept_count = oci_result($dept_info_s
tmt, 2);
			$curr_dept_salary = oci_result($dept_info_
stmt, 3);
			?>
			<tr> <td> <?= $curr_dept_loc ?> </td>
                 	     <td> <?= $curr_dept_count ?> </td>
                             <td> <?= $curr_dept_salary ?> </td> 
			</tr>
			<?php
		}
		?>
		</table>
	<?php		
	oci_free_statement($dept_info_stmt);
	//oci_close($conn);	
	}	
?>
