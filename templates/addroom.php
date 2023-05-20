
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
 $sql = "INSERT INTO room (RoomID, Name) VALUES
('$RoomID' ,'$Name')";
 mysqli_query($db,$sql);



 // Close connection
 mysqli_close($db);
 //redirect
 header('Location: /schoolpage/room.php');
?>