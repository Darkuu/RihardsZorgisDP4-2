
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Input Values Defining
 $ID = $_REQUEST['InventoryID'];
 $Name =  $_REQUEST['name'];
 $Description = $_REQUEST['Description'];
 $RoomID = $_REQUEST['Room'];
 $Category = $_REQUEST['Category'];
 $TimeLimit = $_REQUEST['TimeLimit'];
  
 // Performing insert query execution
 $sql = "UPDATE inventory SET InventoryID = '$ID', Name = '$Name' , RoomID = '$RoomID', CategoryID = '$Category', TimeLimit ='$TimeLimit', 
 Description = '$Description', TimeLimit = '$TimeLimit' WHERE InventoryID = '$ID'" ;

 mysqli_query($db,$sql);

 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/devices.php');
?>