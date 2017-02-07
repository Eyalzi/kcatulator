<?php
$gene = $_POST['data']; //Get Gene

//Connection Credentials

	$servername = "localhost";
	$username = "root";
	$password = "0645";
	$datasetname = "kcatulator";
					
	$con = mysqli_connect($servername, $username, $password, $datasetname);
	
	        // Iterating through the product array
	        $result = mysqli_query($con,"Select Reaction_Name,Reaction_String from tbl_reactions where Gene_Name ='".$gene."'"); //Select DISTINCT Gene_Name,Gene_ID From tbl_reactions         
			$ReactionArray = array();
			$id = 0;
			while ($row = mysqli_fetch_array($result))
			{
				 $ReactionArray[$id] = $row['Reaction_Name']." - ".$row['Reaction_String'];
				 $id += 1;
			}
			
			mysqli_close($con);
			echo json_encode($ReactionArray);
		
		
		// // Set your CSV feed
		// $feed = 'data.csv';
		// // Arrays we'll use later
		// $keys = array();
		// $newArray = array();
		// // Function to convert CSV into associative array
		// function csvToArray($file, $delimiter) { 
		  // if (($handle = fopen($file, 'r')) !== FALSE) { 
			// $i = 0; 
			// while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
			  // for ($j = 0; $j < count($lineArray); $j++) { 
				// $arr[$i][$j] = $lineArray[$j]; 
			  // } 
			  // $i++; 
			// } 
			// fclose($handle); 
		  // } 
		  // return $arr; 
		// } 
// 	
		// // Do it
		// $data = csvToArray($feed, ',');
		// // Set number of elements (minus 1 because we shift off the first row)
		// $count = count($data) - 1;
// 		  
		// //Use first row for names  
		// $labels = array_shift($data);  
		// foreach ($labels as $label) {
		  // $keys[] = $label;
		// }
		// // Add Ids, just in case we want them later
		// $keys[] = 'id';
		// for ($i = 0; $i < $count; $i++) {
		  // $data[$i][] = $i;
		// }
// 		  
		// // Bring it all together
		// for ($j = 0; $j < $count; $j++) {
		  // $d = array_combine($keys, $data[$j]);
		  // $d = json_encode($d);
		  // $newArray[$j] = json_decode($d);
		// }
// 
		// //echo $newArray[0]->reaction;
		// $search = array();
		// $id = 0;
		// foreach ($newArray as $current) {
			// $current_gene = $current->gene_name;
			// if (strcmp($current_gene, $gene) == 0) {
				// $search[$id] = "$current->reaction - $current->reaction_string";
				// $id += 1;
			// }
// 			
		// }
// 		
		// echo json_encode($search);
// 		
?>
