<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Define Values
 $StartTime =  strtotime($_REQUEST['StartTime']) ;
 $EndTime =  strtotime($_REQUEST['EndTime']) ;
 $Enddate =  date("Y-m-d", strtotime($_REQUEST['EndDate'])); ;
 $Inventory = $_REQUEST['Inventory'];
 $InventoryID = $_REQUEST['InventoryID'];
 $Room = $_REQUEST['Room'];
 $VisibleStartTime =  $_REQUEST['StartTime'];
 $VisibleEndTime =  $_REQUEST['EndTime'];
 $TimeSpent = ($StartTime - $EndTime)   / -60 ;
 echo"$InventoryID ";
 
 // Performing insert query execution
 $sql = "INSERT INTO Request (Inventory_Name, InventoryID, RoomID, End_Date, Start_time, End_time, Time_Spent, VisibleStartTime, VisibleEndTime ) VALUES 
('$Inventory', '$InventoryID', '$Room' , '$Enddate', '$StartTime', '$EndTime', '$TimeSpent', '$VisibleStartTime', '$VisibleEndTime')";
 mysqli_query($db,$sql);

 Foreach ($db->query("SELECT Time_Spent FROM request WHERE InventoryID = $InventoryID ")as $timespent);
 Foreach ($db->query("SELECT TotalTime FROM inventory WHERE InventoryID = $InventoryID ")as $Totaltime);
 $Totaltime = array_map('intval', $Totaltime);
 echo $Totaltime = implode($timespent) + implode($Totaltime);

 $sql1 = "UPDATE inventory SET TotalTime ='$Totaltime' WHERE InventoryID = '$InventoryID'";
 mysqli_query($db,$sql1);
 header('Location: /schoolpage/request.php');

 // Close connection
 mysqli_close($db);
 //redirect

?>

