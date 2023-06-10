
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Input Values Defining
 $ID = $_GET;
  
 // Performing insert query execution
 $sql = "UPDATE inventory SET TotalTime = '0'WHERE InventoryID = '$ID[id]'" ;

 mysqli_query($db,$sql);

 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/admin_devices.php');
?>