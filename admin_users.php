<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/admin/users.css" />
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->

    <title>RTU Uzskaite</title>
</head>

   <!-- Navbar Function -->
   <?php
        if(isset($_COOKIE['user']) == ''): 
            header("Location: index.html");
            ?>
    <?php else: ?>
        <ul class="nav nav-pills"> 
            <a class="navbar-brand"  href="adminpage.php">
            <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false" >
            </li>
            <li class="">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_request.php">Pieprasījumi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_devices.php">Inventārs</a>
            <li class="nav-item-left">
                <a class="nav-link" href="admin_users.php">Lietotāji</a>
            </li>
            <li class="nav-item-left">
                <a class="nav-link" href="admin_rooms.php">Kabineti</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
    <?php endif; ?>


<body>
    <table class="table" id="table-request">
        <tr>
            <th>Lietotāja ID</th>
            <th>Status</th>
            <th>PersonasKods</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>E-pasts</th>
            <th>Profesija</th>
        </tr>
        <tr id="Values">
            <?php

         $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

        foreach ($db->query("SELECT * FROM user ORDER BY id asc") as $results) {
            echo "<tr>";
            echo "<td>" . $results["ID"] . "</td>";
            echo "<td>" . $results["Status"] . "</td>";
            echo "<td>" . $results["PersonalCode"] . "</td>";
            echo "<td>" . $results["Name"] . "</td>";
            echo "<td>" . $results["Surname"] . "</td>";
            echo "<td>" . $results["Email"] . "</td>";
            echo "<td>" . $results["Profession"] . "</td>";
            echo "<td style='width:5vw'>" . "<a class='editbutton' href='admin_edituser.php?id=" . $results["ID"] . "'>Rediģēt</a>" . "</td>";
            echo "<td style='width:5vw'>" . "<input type='submit' class='deletebutton' name='delete' value='Dzēst' />" . "</td>";
            echo "</tr>";
        }

        ?>
        </tr>
    </table>
    <a href="admin_adduser.php">
        <button class="addbutton">Pievienot</button>
    </a>
</body>

</html>