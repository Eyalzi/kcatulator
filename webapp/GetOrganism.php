<?php
$gene = $_POST['data']; //Get Gene

//Connection Credentials

	$servername = "localhost";
	$username = "root";
	$password = "0645";
	$datasetname = "kcatulator";
					
	$con = mysqli_connect($servername, $username, $password, $datasetname);
	
	    // Iterating through the product array
	    $result = mysqli_query($con,"Select Organism from tbl_reactions where Gene_Name ='".$gene."'");         
			$ReactionArray = array();
			$id = 0;
			while ($row = mysqli_fetch_array($result))
			{
				 $ReactionArray[$id] = $row['Organism'];
				 $id += 1;
			}
			
			mysqli_close($con);
			echo json_encode($ReactionArray);
?>
