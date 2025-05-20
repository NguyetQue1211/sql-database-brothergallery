<div id="select webform">
<h2>Web Form</h2>
<form action="" method="post">
<label> StaffCode :</label>
<input type="text" name="StaffCode" required placeholder="Please Enter StaffCode"/><br><br>
<input type="submit" value=" Submit Information " name="submit"/><br />
</form>
</div>

<?php

if(isset($_POST["submit"])){
include 'dbconfig.php';

$sql = "SELECT S.StaffCode, S.FirstName, S.LastName,  SUM(Total) AS Sales
FROM ARTWORK_ORDER AO JOIN SALESPERSON S
ON AO.StaffCode = S.StaffCode
WHERE AO.StaffCode = '".$_POST["StaffCode"]."';";

$result = $conn->query($sql);

/* fetch associative array to display */
echo "<BR>";	
while ($row = $result->fetch_assoc()) {
    printf("Staff %s %s with StaffCode %s achieves total sales %s", $row["FirstName"], $row["LastName"],$row["StaffCode"], $row["Sales"]);
	echo "<BR>";
}
	

$conn->close();
}
?>