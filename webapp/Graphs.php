<?php
		$gene = $_POST['data'];
		$Organism = $_POST['Organism'];
		
		//Connection Credentials

	$servername = "localhost";
	$username = "root";
	$password = "0645";
	$datasetname = "kcatulator";
					
	$con = mysqli_connect($servername, $username, $password, $datasetname);
	
  $result = mysqli_query($con,"Select * From tbl_conditions where ID=(SELECT DISTINCT ID from tbl_reactions WHERE Gene_Name='".$gene."') AND Organism LIKE '%".$Organism."%'"); 
	$EnzArray = array();
	while ($row = mysqli_fetch_array($result))
	{
		$EnzArray[$row['Condition']] = $row['Enzyme_Amount']."-".$row['Flux'];
		;
	}
	
	mysqli_close($con);
	echo json_encode($EnzArray);
		
?>
