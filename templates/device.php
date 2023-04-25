
    <?php
 
        $db = mysqli_connect("localhost", "root", "", "school");
         
        // Check connection
        if($db === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        // Input Values Defining
        $Name =  $_REQUEST['Name'];
        $RoomID = $_REQUEST['Type'];
         
        // Performing insert query execution
        $sql = "INSERT INTO inventory (Name, RoomID) VALUES 
        ('$Name', '$RoomID')";

        mysqli_query($db,$sql);

        // Close connection
        mysqli_close($db);
        //redirect
        header('Location: /schoolpage/devices.php');
    ?>