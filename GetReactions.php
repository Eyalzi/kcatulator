<?php
$gene = $_POST['data']; //Get Gene

//Connection Credentials

	$servername = "localhost";
	$username = "root";
	$password = "0645";
	$datasetname = "kcatulator";
					
	$con = mysqli_connect($servername, $username, $password, $datasetname);
	
	    // Iterating through the product array
	    $result = mysqli_query($con,"Select Distinct Reaction_Name,Reaction_String from tbl_reactions where Gene_Name ='".$gene."'"); //Select DISTINCT Gene_Name,Gene_ID From tbl_reactions         
			$ReactionArray = array();
			$id = 0;
			while ($row = mysqli_fetch_array($result))
			{
				 $ReactionArray[$id] = $row['Reaction_Name']." - ".$row['Reaction_String'];
				 $id += 1;
			}
			
			mysqli_close($con);
			echo json_encode($ReactionArray);
?>
