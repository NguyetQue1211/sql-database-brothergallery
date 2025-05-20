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

<div id="webform">
<h2>Web Form</h2>
<form action="" method="post">
<label> ArtworkOrderNumber :</label>
<input type="text" name="varArtworkOrderNumber" required placeholder="Please Enter ArtworkName"/><br><br>
<label> ArtworkNumber :</label>
<input type="text" name="varArtworkNumber" required placeholder="Enter DateCreated"/><br><br>
<br><br>
<input type="submit" value=" Submit Information " name="submit"/><br />
</form>
</div>

<?php
include 'dbconfig.php';

$query1 = "SELECT *
FROM ARTWORK AS A 
WHERE NOT EXISTS (
SELECT *
FROM PURCHASED_ARTWORK AS PA
WHERE A.ArtworkNumber = PA.ArtworkNumber);";
$result1 = $conn->query($query1);

echo "<h4> Artworks are not in PURCHASED_ORDER </h4>";
echo "<table><tr><th>ArtworkNumber</th><th>ArtworkName </th><th> DateCreated </th><th> Style </th><th> Price </th></tr>";
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkNumber"]."</td><td>".$row["ArtworkName"]." </td><td>".$row["DateCreated"]." </td><td>".$row["Style"]." </td><td>".$row["Price"]."</td></tr>";
  }
  echo "</table>";

$query2 = "SELECT *
FROM ARTWORK_ORDER;";
$result2 = $conn->query($query2);

echo "<h4> All Artwork_Orders </h4>";
echo "<table><tr><th>ArtworkOrderNumber</th><th>DateOrder </th><th> Total </th><th> CustomerID </th><th> StaffCode </th></tr>";
  // output data of each row
  while($row = $result2->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkOrderNumber"]."</td><td>".$row["DateOrder"]." </td><td>".$row["Total"]." </td><td>".$row["CustomerID"]." </td><td>".$row["StaffCode"]."</td></tr>";
  }
  echo "</table>";

$query3 = "SELECT *
FROM ARTWORK_ORDER AS AO 
WHERE NOT EXISTS (
SELECT *
FROM PURCHASED_ARTWORK AS PA
WHERE AO.ArtworkOrderNumber = PA.ArtworkOrderNumber);";
$result3 = $conn->query($query3);
  
echo "<h4> Artwork_Orders are not in  PURCHASED_ORDER </h4>";
echo "<table><tr><th>ArtworkOrderNumber</th><th>DateOrder </th><th> Total </th><th> CustomerID </th><th> StaffCode </th></tr>";
    // output data of each row
while($row = $result3->fetch_assoc()) {
    echo "<tr><td>".$row["ArtworkOrderNumber"]."</td><td>".$row["DateOrder"]." </td><td>".$row["Total"]." </td><td>".$row["CustomerID"]." </td><td>".$row["StaffCode"]."</td></tr>";
    }
    echo "</table>";

if(isset($_POST["submit"])){

$query3 = "INSERT INTO PURCHASED_ARTWORK VALUES ('".$_POST["varArtworkOrderNumber"]."','".$_POST["varArtworkNumber"]."');";	

if ($conn->query($query3) === TRUE) {
echo "
    <script type= 'text/javascript'>
        alert('New purchased artwork inserted successfully');
    </script>";
} 
else 
{
    echo 
    "<script type= 'text/javascript'>
        alert('Error: " . $sql . "<br>" . $conn->error."');
    </script>";
}

$conn->close();
}
?>