<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->

    <title>RTU Uzskaite</title>
</head>

<!-- Navbar Function -->
<?php
    if(isset($_COOKIE['user']) == '' ):  
        ?>
<?php else: ?>
    
<!-- Logged in  -->
<ul class="nav nav-pills">

    <a class="navbar-brand" href="index.html">
        <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false">
        </li>
        <li class="">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="userrequest.php">Pieprasījumi</a>
        </li>
        <!-- 
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profils</a>
            </li>
                --->
        <li class="nav-item-left">
            <button class="nav-link" onclick="location.href='templates/exit.php';">Atslēgties</button>
        </li>
</ul>
<img class="title-image" src="/images/RTUEKA.jpg" alt="..."></div>

<?php endif; ?>







<!-- HTML -->
    <body>

        <div class="title">Sveicināts Pamatlīdzekļu laika pieprasījuma sistēmā!</div>
        <div class="title-text">Spied pogas augša lai sāktu darbu!</div>


    </body>

</html>