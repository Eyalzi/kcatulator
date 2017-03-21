<?php

//Connection Credentials
$servername = "localhost";
$username = "root";
$password = "0645";
$datasetname = "kcatulator";
				
$con = mysqli_connect($servername, $username, $password, $datasetname);
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//echo "Connected successfully";
        // Iterating through the product array
        $result = mysqli_query($con,"Select DISTINCT Gene_Name,Gene_ID From tbl_reactions where Gene_Name !="."''"); //Select DISTINCT Gene_Name,Gene_ID From tbl_reactions         
				
		$GeneArray = array();
		$id = 0;
		 while ($row = mysqli_fetch_array($result))
		{
			 $GeneArray[$id] = $row['Gene_Name']." - ".$row['Gene_ID'];
			 $id += 1;
		 }
		mysqli_close($con);
		echo json_encode($GeneArray);
?>
