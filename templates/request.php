<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Define va Values
 $StartTime =  $_REQUEST['StartTime']; ;
 $EndTime =  $_REQUEST['EndTime']; ;
 $Enddate =  date("Y-m-d", strtotime($_REQUEST['EndDate'])); ;
 $Inventory = $_REQUEST['Inventory'];
 $Room = $_REQUEST['Room'];
 $TimeSpent = $StartTime - $EndTime;

 // Performing insert query execution
 $sql = "INSERT INTO Request (InventoryID, RoomID, End_Date, Start_time, End_time, Time_Spent) VALUES 
 ('$Inventory' , '$Room' , '$Enddate', '$StartTime', '$EndTime', $TimeSpent)";
 mysqli_query($db,$sql);

     $sql = "INSERT INTO inventars (Nosaukums, Tips) VALUES 
     ('$Name', '$Type')";
 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/devices.php');
?>

