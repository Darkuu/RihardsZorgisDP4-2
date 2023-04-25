<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
        <title>RTU Uzskaite</title>
    </head>

    </body>

<!-- Navbar Function -->
 <?php
        if(isset($_COOKIE['user']) == ''): 
            header("Location: index.html");
            ?>
    <?php else: ?>
<!-- Logged in  -->
<ul class="nav nav-pills"> 
            <a class="navbar-brand"  href="adminpage.php">
            <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false" >
            </li>
            <li class="">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="request.php">Pieprasījumi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="devices.php">Datori</a>
            <li class="nav-item-left">
                <a class="nav-link" href="users.php">Lietotāji</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Log Out</button>
            </li>
        </ul>
        <img class="title-image" src="/images/RTUEKA.jpg" alt="..." ></div>



    <?php endif; ?>
<!-- HTML START -->
    <body>
        <div class="title">Sveicināts Pamatlīdzekļu laika uzskaites sistēmā administrātora režīmā!</div>
        <div class="title-text">Spied pogas augša lai sāktu darbu!</div>
</html>

<!-- IMPORT  CSS   -->

<style>
    <?php include "css/styles.css" ?>
</style>

