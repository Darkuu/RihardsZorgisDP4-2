<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/addrequest.css" />
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <title>RTU Uzskaite</title>
</head>

<!-- PHP | Navbar Creation -->

<?php
    if (isset($_COOKIE['user']) == '') {
        header("Location: index.html");
    }
?>

<!-- HTML START -->

<body>
    <div class="center">
        <h1>Pievieno Pieprasījumu</h1>
        <form class="Form" action="templates/userphp/request.php" method="post" onsubmit="return validateTime()">
            <div class="txtfield">
                Sakuma Laiks
                <input type="time" name="StartTime" required class="date" placeholder="Sākuma Laiks" />
                <span></span>
            </div>
            <div class="txtfield">
                Beigu Laiks
                <input type="time" name="EndTime" required class="date" />
                <span></span>
            </div>

            <div class="txtfield">
                Datums
                <input type="date" name="EndDate" required class="date" />
                <span></span>
            </div>

            <div class="txtfield">
                <select name="Inventory" id="Inventory" class="option">
                    <option value="" disabled selected hidden>Inventārs</option>
                    <?php
                    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                    foreach ($db->query("SELECT * FROM Inventory") as $results) {
                        echo "<option>" . $results["InventoryID"] . ' - ' . $results["Name"] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- PHP | call rooms from table -->

            <div class="txtfield">
                <select name="Room" id="Room" class="option">
                    <option value="" disabled selected hidden>Kabinets</option>
                    <?php
                    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                    foreach ($db->query("SELECT * FROM Room") as $results) {
                        echo "<option>" . $results["RoomID"] . ' - ' . $results["Name"] . "</option>";
                    }
                    ?>
                </select>

            </div>
            <input type="submit" value="Pievienot" />
                    <a href="user_request.php">
                        </a>
            <input type="submit" value="Atgriezties" />
                    <a href="user_request.php">
        </a>
        </form>
    </div>

    <script>
        function validateTime() {
            var startTime = document.getElementsByName("StartTime")[0].value;
            var endTime = document.getElementsByName("EndTime")[0].value;

            if (startTime >= endTime) {
                alert("Beigu laiks nevar būt agrāks vai vienāds ar sākuma laiku!");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>