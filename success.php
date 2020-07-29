<!doctype html>
<html>


<head>

<title>  Guest Registration </title>

</head>


<body>
<h1> Thank you for registering! </h1>

<?
if(isset($_POST['signupform'])) {

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

?>

<?php
$servername = "localhost";
$username = "jaxcode5";
$password = "hola2019";
$dbname = "jaxcode5";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO checkin (firstname, lastname, email)
VALUES ('{$firstname}','{$lastname}',  '{$email}',)";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>

<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO checkin (firstname, lastname, email)
VALUES ('{$firstname}','{$lastname}',  '{$email}',)";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>


</body>
</html>