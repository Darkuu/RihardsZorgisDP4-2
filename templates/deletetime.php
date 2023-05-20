
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Input Values Defining
 $ID = $_REQUEST['InventoryID'];
  
 // Performing insert query execution
 $sql = "UPDATE inventory SET TimeLimit = '0' WHERE InventoryID = '$ID'" ;

 mysqli_query($db,$sql);

 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/devices.php');
?>