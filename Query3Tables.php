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
<label> ArtworkOrderNumber :</label>
<input type="text" name="varArtworkOrderNumber" required placeholder="Enter ArtworkOrderNumber"/><br><br>
<input type="submit" value=" Submit Information " name="submit"/><br />
</form>
</div>

<?php
include 'dbconfig.php';

$query1 = "SELECT * FROM ARTWORK_ORDER;";
$result1 = $conn->query($query1);

echo "<table><tr><th>ArtworkOrderNumber</th><th>DateOrder</th><th> StaffCode </th></tr>";
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkOrderNumber"]."</td><td>".$row["DateOrder"]." </td><td>".$row["StaffCode"]."</td></tr>";
  }
  echo "</table>";


if(isset($_POST["submit"])){

$query2 = "SELECT *
FROM ARTWORK A JOIN PURCHASED_ARTWORK PA 
ON A.ArtworkNumber = PA.ArtworkNumber 
JOIN ARTWORK_ORDER AO ON PA.ArtworkOrderNumber = AO.ArtworkOrderNumber
WHERE AO.ArtworkOrderNumber = '".$_POST["varArtworkOrderNumber"]."';";

$result2 = $conn->query($query2);

/* fetch associative array to display */
echo "<table><tr><th>ArtworkOrderNumber</th><th>DateOrder </th><th> StaffCode </th><th> ArtworkName  </th><th> DateCreated  </th><th> Style  </th><th> Price </th></tr>";	
while ($row = $result2->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkOrderNumber"]."</td><td>".$row["DateOrder"]." </td><td>".$row["StaffCode"]." </td><td> ".$row["ArtworkName"]." </td><td> ".$row["DateCreated"]." </td><td> ".$row["Style"]." </td><td> ".$row["Price"]." </td></tr>";	
}
echo "</table>";
	

$conn->close();
}
?>