
<?php
 $db = mysqli_connect("localhost", "root", "", "school");
 $id = $_GET;
 if(isset($id)){
// Performing insert query execution
print_r($_GET);
$sql = "DELETE FROM room WHERE RoomID = $id[id] ";
mysqli_query($db,$sql);
// Close connection
mysqli_close($db);
//redirect
header('Location: /schoolpage/room.php');

}else{
    print_r($_GET);
}
 ?>

