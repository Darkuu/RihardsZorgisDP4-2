
    <?php
 
        $db = mysqli_connect("localhost", "root", "", "school");
         
        // Check connection
        if($db === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        // Input Values Defining
        $Name =  $_REQUEST['Name'];
        $RoomID = $_REQUEST['Room'];
        $Description = $_REQUEST['Description'];
        
         
        // Performing insert query execution
        $sql = "INSERT INTO inventory (Name, RoomID, Description) VALUES 
        ('$Name', '$RoomID', '$Description')";

        mysqli_query($db,$sql);

        // Close connection
        mysqli_close($db);
        //redirect
        header('Location: /schoolpage/devices.php');
    ?>