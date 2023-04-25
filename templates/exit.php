<?php
    setcookie('user', $user['Epasts'], time() - 3600, "/");
    header('Location: /schoolpage/index.html');

     // Stops the cookie from working, by removing its time limit
?>

