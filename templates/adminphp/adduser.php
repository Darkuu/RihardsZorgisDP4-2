<?php
 
    $db = mysqli_connect("localhost", "root", "", "school");
    
    // Check connection
    if($db === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // Input Values Defining
    $Personcode =  $_REQUEST['PersonasKods'];
    $Name = $_REQUEST['Vards'];
    $Surname = $_REQUEST['Uzvards'];
    $Position = $_REQUEST['Profesija'];
    $Email = $_REQUEST['Epasts'];
    $Password = $_REQUEST['Parole'];
    
    // Performing insert query execution
     $sql = "INSERT INTO user (PersonalCode, Name, Surname, Profession, Email, Password) VALUES 
    ('$Personcode', '$Name', '$Surname', '$Position', '$Email', '$Password')";
    mysqli_query($db,$sql);

    // Close connection
    mysqli_close($db);
    //redirect
    header('Location: /schoolpage/admin_users.php');
?>
