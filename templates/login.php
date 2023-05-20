<?php

 $db = mysqli_connect("localhost", "root", "", "school");

     // Input Values Defining
    $username = $_REQUEST['email'];
    $password = $_REQUEST['password'];

     // Check for information
    if($result = $db->query("SELECT * FROM `user` WHERE Email = '$username' AND Password = '$password'")){
        while ($user = $result->fetch_assoc()) {
            setcookie('user', $user['Email'], time() + 3600, "/");
            setcookie('userinfo', $user['ID'] );
            $Status = ($user['Status']);

            // Decide where to move the user.
            if($Status == 'admin') {
                header('Location: /schoolpage/adminpage.php');
            } else {
                header('Location: /schoolpage/userpage.php');
            }
        }

        if (mysqli_num_rows($result = $db->query("SELECT * FROM `user` WHERE email = '$username' AND Password = '$password'")) == 0) {
            echo "<script>
            alert('E-pasts vai parole ir nepareizi ievadīts!');
            window.location.href='/schoolpage/index.html';
            </script>";
            exit();
        }
    }

    $db->close();


