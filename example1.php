 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <style>
  table, th, td {
	  border: 1px solid black;
	}
  </style>
	<body>
	<h2>Database Tables</h2>
<?php

	// return connection to database
	function connect() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shopdb";

		return	$conn = new mysqli($servername, $username, $password, $dbname);
	}
	// prints all the column names of the table
	function printColumns($var){
		$sql = "SHOW COLUMNS FROM $var";
		$conn = connect();
		$result = $conn->query($sql);
		echo "<tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<th>". $row['Field'] . "</th>";
		}
		echo "</tr>";
	}
	// prints all the rows of each column
	function printRows1($row, $columns){
		$columns = $columns - 1;
		for ($i = 0; $i < count($row); $i++)  {
			if ($i == 0 ) {
				echo "<tr><td>" . $row[$i] ."</td>";
			}else if ($i != $columns){
				echo  "<td>" . $row[$i]. "</td> ";	
			}else
				echo "<td>" . $row[$i] ."</td></tr>";
			}
	}
	// prints contents of a table
	function printTable($tableName, $columns){
		$sql = "SELECT * FROM $tableName";
		$conn = connect();
		$result = $conn->query($sql);
		
		if($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		  exit();
		} else if ($result) {
		  echo "<table><caption>" . $tableName . " Table </caption>";
		  printColumns($tableName);
		  while ($row = $result->fetch_row()) {
			  printRows1($row, $columns);
		  }
		   echo "</table>";
		  // Free result set
		  $result -> free_result();
		} else {
		  echo "failure";
		}
	}
	printTable("ItemOrder", 4);
	printTable("customer", 3);
	printTable("item", 3);
?> 
	<p>Example Query 1: return all the everything from the customer table <button onclick="#">Click me</button> </p>
	</body>
</html>
