<?php
$db = mysqli_connect("localhost", "root", "", "school");

// Input Values Defining for later use
$username = $_REQUEST['email'];
$password = $_REQUEST['password'];

// Check for information, if its correct
if ($result = $db->query("SELECT * FROM `user` WHERE Email = '$username' AND Password = '$password'")) {
    while ($user = $result->fetch_assoc()) {
        setcookie('user', $user['Email'], time() + 3600, "/");
        setcookie('userinfo', $user['ID'], time() + 3600, "/"); // Set the 'userinfo' cookie with the user's ID for later use 
        $Status = ($user['Status']);

        // Decide where to move the user dependin on status.
        if ($Status == 'admin') {
            header('Location: /schoolpage/admin_page.php');
        } else {
            header('Location: /schoolpage/user_page.php');
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
?>






