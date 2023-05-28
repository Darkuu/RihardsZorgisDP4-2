<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/request.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->
    <script src="templates/navbar.js"></script>

    <title>RTU Uzskaite</title>
    </head>

<!-- Navbar Function -->
    <?php
        if(isset($_COOKIE['user']) == '' ):  
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
            <a class="nav-link" href="user_request.php">Pieprasījumi</a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="user_profile.php">Profils</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>


    <?php endif; ?>
        <!-- HTML -->


<body>
<table class="table" id="table-request">
    <tr>
        <th>Inventars</th>
        <th>Telpas</th>
        <th>Datums</th>   
        <th>Sakuma un Beigu Laiks</th>   
    </tr>
    <tr id="Values">
        <?php
        $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
     foreach ($db->query("SELECT * FROM Request WHERE End_Date >= CURDATE() ORDER BY End_Date ASC") as $results) {
            echo "<td>" . $results["Inventory_Name"] . "</td>";
            echo "<td>" . $results["RoomID"] . "</td>";
            echo "<td>" . $results["End_Date"] . "</td>";
            echo "<td>" . $results["VisibleStartTime"] . " - " . $results["VisibleEndTime"] . "</tr>";
        }
        ?>
    </tr>
</table>
<a href="user_addrequest.php">
    <button class="addbutton">Pievienot</button>
</a>
</body>


</html>