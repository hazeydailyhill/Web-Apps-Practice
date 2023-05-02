<?php
    /*===
        function: call_title_total_cost
        last modified: 2023-05-02
    ===*/
    function call_title_total_cost()
    {
      //connect to oracle
      $username = $_SESSION['USERNAME'];
      $password = $_SESSION['PASSWORD'];
      $conn = hsu_conn_sess($username, $password);
	
      //getting the isbn chosen from drowpdown
      //$desired_isbn = strip_tags($_POST['isbns']);
	
      //call function        
      $ttc_call = "begin :ttlcost := title_total_cost(:ttl_isbn); end;";
      $ttc_stmt = oci_parse($conn, $ttc_call);

      //input bind variable
      $desired_isbn = strip_tags($_POST['isbn_choice']);
      oci_bind_by_name($ttc_stmt, ":ttl_isbn", $desired_isbn);
      //output bind variable
      oci_bind_by_name($ttc_stmt, ":ttlcost", $ttl_cost, 4);

      //now executing
      oci_execute($ttc_stmt, OCI_DEFAULT);
      ?>
      
      <p> title_total_cost call for <?= $desired_isbn ?> </br>
	  returned <?= $ttl_cost ?> for cost </p> 

    <?php
    oci_free_statement($ttc_stmt);      
    oci_close($conn);
    }
?>
