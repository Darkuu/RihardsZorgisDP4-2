
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Defining input values.
 $ID = $_REQUEST['InventoryID'];
 $Name =  $_REQUEST['name'];
 $Description = $_REQUEST['Description'];
 $RoomID = $_REQUEST['Room'];
 $Category = $_REQUEST['Category'];
 $TimeLimit = $_REQUEST['TimeLimit'];
  
 $Exploded = explode("-",$Category);

 // Performing insert query execution
 $sql = "UPDATE inventory SET InventoryID = '$ID', Name = '$Name' , RoomID = '$RoomID', CategoryID = '$Exploded[0]', TimeLimit ='$TimeLimit', 
 Description = '$Description', TimeLimit = '$TimeLimit' WHERE InventoryID = '$ID'" ;

 mysqli_query($db,$sql);

 // Close connection to database
 mysqli_close($db);
 //redirect back to devices.php
 header('Location: /schoolpage/admin_devices.php');
?>