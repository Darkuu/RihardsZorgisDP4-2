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
 $Room = $_REQUEST['Room'];
 $VisibleStartTime =  $_REQUEST['StartTime'];
 $VisibleEndTime =  $_REQUEST['EndTime'];
 $TimeSpent = ($StartTime - $EndTime)   / -60 ;
 $Exploded = explode("-",$Inventory);
print_r($Exploded);
 // Performing insert query execution
 $sql = "INSERT INTO Request (Inventory_Name, InventoryID, RoomID, End_Date, Start_time, End_time, Time_Spent, VisibleStartTime, VisibleEndTime ) VALUES 
('$Exploded[1]', '$Exploded[0]', '$Room' , '$Enddate', '$StartTime', '$EndTime', '$TimeSpent', '$VisibleStartTime', '$VisibleEndTime')";
 mysqli_query($db,$sql);

 Foreach ($db->query("SELECT Time_Spent FROM request WHERE InventoryID = $Exploded[0] ")as $timespent);
 Foreach ($db->query("SELECT TotalTime FROM inventory WHERE InventoryID = $Exploded[0] ")as $Totaltime);
 $Totaltime = array_map('intval', $Totaltime);
 echo $Totaltime = implode($timespent) + implode($Totaltime);

 $sql1 = "UPDATE inventory SET TotalTime ='$Totaltime' WHERE InventoryID = '$Exploded[0]'";
 mysqli_query($db,$sql1);

 header('Location: /schoolpage/user_request.php');
 // Close connection
 mysqli_close($db);
 //redirect

?>

