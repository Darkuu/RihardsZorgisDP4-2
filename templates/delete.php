
<?php
 $db = mysqli_connect("localhost", "root", "", "school");
  
 if(isset($_get['inventoryID'])){
// Performing insert query execution
$sql = "DELETE FROM Inventory WHERE InventoryID = '$id'";
mysqli_query($db,$sql);
// Close connection
mysqli_close($db);
//redirect
header('Location: /schoolpage/devices.php');

}else{
    print_r($_GET);
}
 ?>

