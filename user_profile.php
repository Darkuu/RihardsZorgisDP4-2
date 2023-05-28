<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/general/styles.css" />
    <link rel="stylesheet" href="css/user/profile.css" />
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

<?php else: ?>
<ul class="nav nav-pills">
    <a class="navbar-brand" href="userpage.php">
        <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false">
        <li class="">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user_request.php">Mani Pieprasījumi</a>
        </li>

        <li class="nav-item-left">
            <a class="nav-link" href="user_profile.php">Profils</a>
        </li>
        <li class="nav-item-right">
            <button class="nav-link" onclick="location.href='templates/exit.php';">Atslēgties</button>
        </li>
    </ul>
<?php endif; ?>


<body>
    <!-- Navbar section content... -->

    <!-- HTML Start -->
    <div class="background-image"></div>
    <div id="profile" class="profile">
        <div id="profile-title" class="profile-title">Tavs profils</div>
        <table id="profile-table" class="table table-borderless">
            <thead>
                <tr>
                    <th>Personas Kods</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Profesija</th>
                    <th>E-pasts</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                $userid = $_COOKIE["userinfo"];
                foreach ($db->query("SELECT ID, PersonalCode , Name , Surname, Profession, Email FROM user WHERE ID = $userid") as $user) {
                    echo "<tr>";
                    echo "<td>" . $user["PersonalCode"] . "</td>";
                    echo "<td>" . $user["Name"] . "</td>";
                    echo "<td>" . $user["Surname"] . "</td>";
                    echo "<td>" . $user["Profession"] . "</td>";
                    echo "<td>" . $user["Email"] . "</td>";
                    echo "<a class='editbutton' href='user_edituser.php? id="  .  $user["ID"] ." '> Rediģēt</a>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
<script>
  var userinfo = document.cookie
    .split(";")
    .map(cookie => cookie.trim())
    .find(cookie => cookie.startsWith("userinfo="))
    .split("=")[1];
</script>


</html>