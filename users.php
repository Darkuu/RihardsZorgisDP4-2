<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/devices.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->
    <script src="templates/navbar.js"></script>

    <title>RTU Uzskaite</title>
</head>

   <!-- Navbar Function -->
   <?php
        if(isset($_COOKIE['user']) == ''): 
            header("Location: index.html");
            ?>
    <?php else: ?>
            <!-- Logged in  -->
<ul class="nav nav-pills"> 

            <a class="navbar-brand"  href="userpage.php">
            <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false" >
            </li>
            <li class="">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="request.php">Pieprasījumi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="devices.php">Inventars</a>
            <li class="nav-item-left">
                <a class="nav-link" href="users.php">Lietotāji</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
        <img class="title-image" src="/images/RTUEKA.jpg" alt="..." ></div>

    <?php endif; ?>


<body>
    <table class="table" id="table-request">
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>PersonasKods</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Profesija</th>
        </tr>
        <tr id="Values">
            <?php

            $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');


            foreach ($db->query("SELECT * FROM lietotājs ORDER BY id asc")  as $results)
            {
            echo "<td>" . $results["ID"] . "</td>";
            echo "<td>" . $results["Status"] . "</td>";
            echo "<td>" . $results["PersonasKods"] . "</td>";
            echo "<td>" . $results["Vārds"] . "</td>";
            echo "<td>" . $results["Uzvārds"] . "</td>";
            echo "<td>" . $results["Profesija"] . "</td>";
            echo "<td style='width:5vw' >" . "<input type='submit' class='editbutton' name='Edit' value='Edit' />" . "</td>";
            echo "<td style='width:5vw' >" . "<input type='submit' class='deletebutton' name='delete' value='Delete' />" . "</tr>" . "</td>";
            }

            ?>
        </tr>
    </table>
    <a href="addusers.php">
        <button class="addbutton">Pievienot</button>
    </a>
</body>

</html>