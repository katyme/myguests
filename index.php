<!doctype html>
<html>

<!-- Login to Server and Database -->
<?
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<!-- Login to Server and Database Ends -->

<head>

<title>  Guest Registration </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Satisfy&display=swap" rel="stylesheet">

<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<style>

h1,h2, nav {
  font-weight: bold;
}

form, table {
  font-size: 18px;
}

body {
  font-family: 'Satisfy', cursive, sans-serif;
  background-image: url('gold-pen.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}

</style>

</head>


<body>



<!-- Add guest -->
<?
if(isset($_POST['addguest'])) {

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

  $sql = "INSERT INTO MyGuests (firstname, lastname, email)
  VALUES ('{$firstname}', '{$lastname}', '{$email}')";
  
  if ($conn->query($sql) === TRUE) {
      echo '<div class="alert alert-success">
      <strong>Success!</strong> Guest added!
    </div>';

    // Send email to Admin //
$to = "kmfontanez@gmail.com";
$subject = "Guest Added";
$txt = "$firstname $lastname was added to the database";
$headers = "From: webmaster@example.com";

mail($to,$subject,$txt,$headers);
  // Email ends //

} else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  

}

?>
<!-- Add guest ends -->


<?
// Update
if(isset($_POST['updateguest'])) {

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

$sql = "UPDATE MyGuests SET firstname='{$firstname}',lastname='{$lastname}',email='{$email}' WHERE id='{$_POST['id']}'";

if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-success">
    <strong>Success!</strong> Guest updated.
  </div>';
} else {
    echo "Error updating record: " . $conn->error;
}
}
?>
<!-- Update Ends -->

<?
// Delete
if(isset($_POST['deletethis'])) {
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

// sql to delete a record
$sql = "DELETE FROM MyGuests WHERE id='{$_POST['id']}'";

if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-danger">
  <strong>Success!</strong> Guest deleted!
</div>';
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
}
?>
<!-- Delete Statement Ends -->

<div class="container">
<div class="row">

<div class="col-md-1">

</div>

<div class="col-md-10">

  <h1 style="text-align:center;"><i>Hello, Guests!</i></h1>
  <h2>Please Register</h2>
  <br>


<!-- Form Begins -->
<form action="index.php" method="POST">
  <b>First name:</b><br>
  <?
 echo '<input type="hidden" name="id" value="'.$_POST['id'].'">';
  if(isset($_POST['firstname'])) {
  echo '<input type="text" name="firstname" value="'.$_POST['firstname'].'">';
} else {
  echo '<input type="text" name="firstname">';
} ?> <br>
  <b>Last name:</b><br>
  <?
if(isset($_POST['lastname'])) {
  echo '<input type="text" name="lastname" value="'.$_POST['lastname'].'">';
} else {
  echo '<input type="text" name="lastname">';
} ?> <br>
  <b> Email:</b><br>
  <?
if(isset($_POST['email'])) {
  echo '<input type="text" name="email" value="'.$_POST['email'].'">';
} else {
  echo '<input type="text" name="email">';
} ?><br><br>
  <?
if(isset($_POST['editthis'])) {
  echo '<input type="submit" name="updateguest" value="Update Guest" class="btn btn-info">';
} else {
  echo '<input type="submit" name="addguest" value="Add Guest" class="btn btn-success">';
}
?>
</form><br>
<!-- Form Ends -->

<br>
<h2> My Guest List </h2>


<!-- Select Statement and Table begins -->
<?php

$sql = "SELECT * FROM MyGuests";
$result = $conn->query($sql);
echo '<table class="table table-bordered table-hover">
<thead>
      <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Edit</th>
      <th>Delete</th>
      </tr>
      </thead>';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
      <tbody>
      <tr>
      <td><?=$row['id']?></td>
      <td><?=$row['firstname']?></td>
      <td><?=$row['lastname']?></td>
      <td><?=$row['email']?></td>
      <td><form action="index.php" method="POST">
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="hidden" name="firstname" value="<?=$row['firstname']?>">
      <input type="hidden" name="lastname" value="<?=$row['lastname']?>">
      <input type="hidden" name="email" value="<?=$row['email']?>">
      <input type="submit" name="editthis" value="Edit" class="btn btn-success btn-xs">
      </form></td>
      <td><form action="index.php" method="POST">
      <input type="hidden" name="id" value="<?=$row['id']?>">
      <input type="hidden" name="firstname" value="<?=$row['firstname']?>">
      <input type="hidden" name="email" value="<?=$row['email']?>">
      <input type="submit" name="deletethis" value="Delete" class="btn btn-warning btn-xs">
      </form>
      </td></tr>
      <?
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!-- Select Statement Ends -->


</tbody>
</table>

<br>

<!-- Footer -->

<hr>
&copy; <?=date('Y')?>, MyGuests App | Created by: Katy Melendez
</div>

<div class="col-md-1">


</body>
</html>