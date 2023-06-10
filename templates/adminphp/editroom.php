
<?php
 
 $db = mysqli_connect("localhost", "root", "", "school");
  
 // Check connection
 if($db === false){
     die("ERROR: Could not connect. "
         . mysqli_connect_error());
 }

 // Input Values Defining
 $RoomID = $_REQUEST['RoomID'];
 $Name =  $_REQUEST['RoomName'];

 // Performing insert query execution
 $sql = "UPDATE room SET RoomID = '$RoomID', Name = '$Name'  WHERE RoomID = '$RoomID'" ;

 mysqli_query($db,$sql);

 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/admin_rooms.php');
?>