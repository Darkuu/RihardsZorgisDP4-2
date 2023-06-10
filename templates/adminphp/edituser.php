
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
// Check connection
if ($db === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Input Values Defining
$userID = $_POST['UserID'];
$name = $_POST['Name'];
$surname = $_POST['Surname'];
$profession = $_POST['Profession'];
$email = $_POST['Email'];
$password = $_POST['Password'];

// Performing update query execution on the table
$sql = "UPDATE user SET Name = '$name', Surname = '$surname', Profession = '$profession', Email = '$email', Password = '$password' WHERE ID = $userID";

if (mysqli_query($db, $sql)) {
    // Close connection
    mysqli_close($db);
    // Redirect to page
    header('Location: /schoolpage/profile.php');
    exit();
} else {
    echo "Error updating record: " . mysqli_error($db);
}

?>