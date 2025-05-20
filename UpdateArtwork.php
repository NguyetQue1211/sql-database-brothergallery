<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
	
<div id="select webform">
<h2>Web Form</h2>
<form action="" method="post">
<label> ArtworkNumber :</label>
<input type="text" name="varArtworkNumber" required placeholder="Please Enter ArtworkNumber"/><br><br>
<label> If changes. Please Enter new ArtworkName :</label>
<input type="text" name="varArtworkName" required placeholder="Please Enter new ArtworkName"/><br><br>
<label> If changes. Please Enter new DateCreated :</label>
<input type="text" name="varDateCreated" required placeholder="Please Enter new DateCreated"/><br><br>
<label> If changes. Please Enter new Style :</label>
<input type="text" name="varStyle" required placeholder="Please Enter new Style"/><br><br>
<label> If changes. Please Enter new Price :</label>
<input type="text" name="varPrice" required placeholder="Please Enter new Price"/><br><br>
<input type="submit" value=" Submit Information " name="submit"/><br />
</form>
</div>

<?php

include 'dbconfig.php';

$query1 = "SELECT * FROM ARTWORK;";
$result1 = $conn->query($query1);

echo "<table><tr><th>ArtworkNumber</th><th>ArtworkName</th><th> DateCreated </th><th> Style </th><th> Price </th></tr>";
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkNumber"]."</td><td>".$row["ArtworkName"]." </td><td> ".$row["DateCreated"]." </td><td>".$row["Style"]."</td><td> ".$row["Price"]." </td></tr>";
  }
  echo "</table>";

if(isset($_POST["submit"])){

$query2 = "SELECT * FROM ARTWORK WHERE ArtworkNumber = '".$_POST["varArtworkNumber"]."';";
$result2 = $conn->query($query2);
$CurrentRow = $result2->fetch_assoc();

if ($_POST["varArtworkName"] <> "NA") {
    $ArtworkName = 	$_POST["varArtworkName"];
} else {
    $ArtworkName = $CurrentRow['ArtworkName'];
}

if ($_POST["varDateCreated"] <> "NA") {
    $DateCreated = 	$_POST["varDateCreated"];
} else {
    $DateCreated = $CurrentRow['DateCreated'];
}

if ($_POST["varStyle"] <> "NA") {
    $Style = $_POST["varStyle"];
} else {
    $Style = $CurrentRow['Style'];
}

if ($_POST["varPrice"] <> "NA") {
    $Price = 	$_POST["varPrice"];
} else {
    $Price = $CurrentRow['Price'];
}


$query3 = " UPDATE ARTWORK SET ArtworkName = '$ArtworkName', DateCreated = '$DateCreated', Style = '$Style', Price = '$Price' WHERE ArtworkNumber = '".$_POST["varArtworkNumber"]."';";	

if ($conn->query($query3) === TRUE) {
echo "
    <script type= 'text/javascript'>
        alert('New Artwork updated successfully');
    </script>";
} 
else 
{
    echo 
    "<script type= 'text/javascript'>
        alert('Error: " . $query3 . "<br>" . $conn->error."');
    </script>";
}	

$conn->close();
}