<?php
$con = mysqli_connect("localhost","root","","social");

if(mysqli_connect_errno()){
	echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL,'Austin')")
?>
<!DOCTYPE html>
<html>
<head>
	<title>Swirl Feed</title>
</head>
<body>
Hello Austin!!!
</body>
</html>