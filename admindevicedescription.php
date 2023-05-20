<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/DeviceDescription.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->

    <title>RTU Uzskaite</title>
</head>

<!-- Navbar Function -->

<?php
    if(isset($_COOKIE['user']) == ''): 
    header("Location: index.html");
?>


<!-- NavBar -->
<?php else: ?>

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
                <a class="nav-link" href="devices.php">Inventārs</a>
            <li class="nav-item-left">
                <a class="nav-link" href="users.php">Lietotāji</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
        <img class="title-image" src="/images/RTUEKA.jpg" alt="..." ></div>
<?php endif; ?>


<!-- HTML Start -->

<body>

    <div class="background-image"></div>
        <div id="profile" class="profile">
            <div id="profile-title" class="profile-title">Ierīces apraksts un statistika</div>
                <table id="profile-table" class="table table-borderless">
                    <div class="profile-info">
<table class="table" id="table-request">

        <tr>
            <th>ID </th>
            <th>Nosaukums</th>
            <th>Kabinets</th>
            <th>Kategorija</th>
            <th>Ierīces nolietotais laika limits</th>
            <th>Ierīces nolietotais laiks</th>
        </tr>
<!--  PHP | Print values from device table  -->
        <tr id="Values">
        <?php
             $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
             $id = $_GET;
             foreach ($db->query("SELECT * FROM inventory where InventoryID = $id[id] ") as $results)

             {
                 echo "<td>" . $results["InventoryID"] . "</td>";
                 echo "<td>" . $results["Name"] . "</td>";
                 echo "<td>" . $results["RoomID"] .   "</td>";
                 echo "<td>" . $results["CategoryID"] .   "</td>";
                 echo "<td>" . $results["TimeLimit"] .   "</td>";
                 echo "<td>" . $results["TotalTime"] .   "</td> ";
             }
        ?>
        </tr>
    </table>
    <h2> Ierīces pilnais apraksts</h2>
    <?php
             $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
             $id = $_GET;
             foreach ($db->query("SELECT * FROM inventory where InventoryID = $id[id] ") as $results)
             {
                 echo  $results["Description"] ;
             } 
             echo "<a class='delete2button' href='templates/delete.php? id="  .  $results["InventoryID"] ." '> Dzēst Nolietoto Laiku</a>";
             echo "<a class='editbutton' href='admineditdevice.php? id="  .  $results["InventoryID"] ." '> Rediģēt</a>";
             echo "<a class='deletebutton' href='templates/delete.php? id="  . $results["InventoryID"] . " '>Dzēst</a>";
        ?>
        <a href="devices.php">
                <button class="backbutton">Atgriezties</button>
        </a>
        </div>
       </div> 
    </div>
</body>

</html>