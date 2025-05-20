<div id="webform">
<h2>Web Form</h2>
<form action="" method="post">
<label> ArtworkName :</label>
<input type="text" name="ArtworkName" required placeholder="Please Enter ArtworkName"/><br><br>
<label> DateCreated :</label>
<input type="text" name="DateCreated" required placeholder="Enter DateCreated"/><br><br>
<label> Stylet :</label>
<input type="text" name="Style" required placeholder="Enter Artwork's Style"/><br><br>
<label> Price :</label>
<input type="text" name="Price" required placeholder="Enter Artwork's Price"/><br><br>
<br><br>
<input type="submit" value=" Submit Information " name="submit"/><br />
</form>
</div>
<?php
if(isset($_POST["submit"])){
include 'dbconfig.php';
	
/* insert the new Artwork's information*/		
$ArtworkName = 	$_POST["ArtworkName"];
$DateCreated = 	$_POST["DateCreated"];
$Style = 	$_POST["Style"];
$Price = 	$_POST["Price"];

$sql = "INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES ('$ArtworkName','$DateCreated','$Style', '$Price');";	

if ($conn->query($sql) === TRUE) {
echo "
    <script type= 'text/javascript'>
        alert('New Artwork created successfully');
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