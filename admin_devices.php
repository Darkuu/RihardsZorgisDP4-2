<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <title>RTU Uzskaite</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<!--  PHP | Navbar Function  -->
<?php
if (isset($_COOKIE['user']) == '') :
    header("Location: index.html");
?>

<?php else : ?>
<ul class="nav nav-pills">
    <a class="navbar-brand" href="admin_page.php">
        <img class="navbar-logo" src="images/RTULOGO.png" alt="..." width="150" height="80" draggable="false">
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
            <button class="nav-link" onclick="location.href='templates/exit.php';">Atslēgties</button>
        </li>
</ul>
<?php endif; ?>


<!--  HTML Start  -->

<body onLoad="myFunction()">

    <table class="table" id="table-request">

        <tr>
            <th>Inventāra Nummurs</th>
            <th>Nosaukums</th>
            <th>Kabinets</th>
            <th>Pavadītais Laiks</br>
        (Stundas:minutes)</th>
            <th>Laika Limits</br>
            (Stundas:minutes)</th>
        </tr>
        <!--  PHP | Print values from device table  -->

<?php
$db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

foreach ($db->query("SELECT * FROM inventory") as $results) {
    echo "<tr>";
    echo "<td>" . $results["InventoryID"] . "</td>";
    echo "<td>" . "<a href='admin_devicedesc.php? id=" . $results["InventoryID"] . " '> $results[Name]</a>" .  "</td>";
    echo "<td>" . $results["RoomID"] . "</td>";

    // Convert TotalTime  and TimeLimit to hours and minutes format for displaying
    $totalTime = $results["TotalTime"];
    $totalTimeHours = floor($totalTime / 60);
    $totalTimeMinutes = $totalTime % 60;
    echo "<td>" . $totalTimeHours . ":" . sprintf("%02d", $totalTimeMinutes) . "</td>";

    $timeLimit = $results["TimeLimit"];
    $timeLimitHours = floor($timeLimit / 60);
    $timeLimitMinutes = $timeLimit % 60;
    echo "<td>" . $timeLimitHours . ":" . sprintf("%02d", $timeLimitMinutes) . "</td>";

    echo "</tr>";
}
?>
    </table>

    <!-- Math on how to get row amount -->
    <?php
    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
    $count = 0;
    foreach ($db->query("SELECT COUNT(InventoryID) FROM inventory") as $row) {
        $count = $row[0];
    }
    ?>

    <!-- Print Table into a PDF using html2PDF plug-in. -->
    <button class="downloadbutton" id="dl-pdf" onclick="PrintPDF()">Lejupielādēt PDF</button>

    <script>
        function PrintPDF() {
            var element = document.getElementById('table-request');

            var opt = {
                margin: 1,
                filename: 'Ierices.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1,
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait',
                    format: [20, 30]
                },
            };
            html2pdf().set(opt).from(element).save();
        };
    </script>

    <!-- Javascript alert if devices have reached their limit -->
    <script type="text/javascript">
        const rownum = "<?php echo $count; ?>";
        const timespent = [];
        const timelimit = [];

        // Loop through the rows and extract time spent and time limit
        const table = document.getElementById('table-request');
        for (let i = 1; i < table.rows.length; i++) {
            const row = table.rows[i];
            timespent.push(parseInt(row.cells[3].innerHTML));
            timelimit.push(parseInt(row.cells[4].innerHTML));
        }

        function myFunction() {
            for (let i = 0; i < rownum; i++) {
                if (timespent[i] > timelimit[i]) {
                    var row = document.getElementById('table-request').rows[i + 1];
                    row.style.color = 'red';
                } else if (timespent[i] === timelimit[i] / 2) {
                    var row = document.getElementById('table-request').rows[i + 1];
                    row.style.color = 'orange';
                }
            }
        };

            // Calculate the number of devices in red and yellow
    let redCount = 0;
    let yellowCount = 0;

    for (let i = 0; i < rownum; i++) {
        if (timespent[i] > timelimit[i]) {
            redCount++;
        } else if (timespent[i] === timelimit[i] / 2) {
            yellowCount++;
        }
    }

    if (redCount > 0 || yellowCount > 0) {
        // Create and display the notification popup
        const popup = document.createElement('div');
        popup.className = 'popup';
        let message = '';

        if (redCount > 0) {
            message += `Ierīces pārsniegušas limitu: ${redCount}<br>`;
        }

        if (yellowCount > 0) {
            message += `Ierīces tuvojas pārsniegšanas limitam: ${yellowCount}<br>`;
        }

        popup.innerHTML = `
            <h2>Uzmanību</h2>
            <p>${message}</p>
            <button class="close-button" onclick="closePopup()">Aizvērt</button>
        `;
        document.body.appendChild(popup);
    }

    function closePopup() {
        const popup = document.querySelector('.popup');
        document.body.removeChild(popup);
    }

</script>

    <a href="admin_adddevice.php">
        <button class="addbutton">Pievienot</button>
    </a>

    <a href="admin_categories.php">
        <button class="categorybutton">Kategorijas</button>
    </a>

</body>

</html>
<style>
    <?php include "css/General/styles.css" ?>
    <?php include "css/devices.css" ?>
</style>