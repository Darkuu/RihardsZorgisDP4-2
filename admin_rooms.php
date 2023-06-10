<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="icon"href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <link rel="stylesheet" href="css/admin/users.css" />
        <link rel="stylesheet" href="css/General/styles.css" />
    <title>RTU Uzskaite</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<!--  PHP | Navbar Function  -->
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

    
<!--  HTML Start  -->

<body>

    <table class="table" id="table-request">

        <tr>
            <th>Kabineta Nummurs</th>
            <th>Nosaukums</th>
        </tr>
        
<!--  PHP | Print values from device table  -->

        <tr id="Values">
        <?php
            $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

            foreach ($db->query("SELECT * FROM Room") as $results)
            {
                echo "<td>" . $results["RoomID"] . "</td>";
                echo "<td>" . $results["Name"]  . "</td>";
                echo "<td style='width:5vw' >". "<a class='deletebutton' href='admin_editroom.php? id="  . $results["RoomID"] ." '> Rediģēt</a>" .  "</td>";
                echo "<td style='width:5vw' >" . "<a class='deletebutton' href='templates/adminphp/deleteroom.php? id="  . $results["RoomID"] . " '>Dzēst</a>" . "</tr>" . "</td>";
            }
            
        ?>
        </tr>
    </table>


    <a href="admin_addroom.php">
        <button class="addbutton">Pievienot</button>
    </a>
    

</body>
</html>

