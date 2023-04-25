<?php

 $db = mysqli_connect("localhost", "root", "", "school");

     // Input Values Defining
    $username = $_REQUEST['email'];
    $password = $_REQUEST['password'];

     // Check for information
    if($result = $db->query("SELECT * FROM `lietotājs` WHERE Epasts = '$username' AND Parole = '$password'")){
        while ($user = $result->fetch_assoc()) {
            setcookie('user', $user['Epasts'], time() + 3600, "/");
            $status = ($user['Status']);

            // Decide where to move the user (TEMPORARY FIX, CAN STILL ACESS THE ADMIN SIDE)
            if($status == 'admin') {
                header('Location: /schoolpage/adminpage.php');
            } else {
                header('Location: /schoolpage/userpage.php');
            }
        }

        if (mysqli_num_rows($result = $db->query("SELECT * FROM `lietotājs` WHERE Epasts = '$username' AND Parole = '$password'")) == 0) {
            echo "<script>
            alert('Username or Password is incorrect!');
            window.location.href='/schoolpage/index.html';
            </script>";
            exit();
        }
    }

    $db->close();


