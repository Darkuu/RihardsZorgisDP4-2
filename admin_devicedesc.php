<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/admin/DeviceDescription.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a class="navbar-brand"  href="admin_page.php">
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
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
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
             echo "<a class='delete2button' href='templates/adminphp/deletetime.php? id="  .  $results["InventoryID"] ."'' onclick='confirmDelete(event)'> Dzēst Nolietoto Laiku</a>";
             echo "<a class='editbutton' href='admin_editdevice.php? id="  .  $results["InventoryID"] ." '> Rediģēt</a>";
             echo "<a class='deletebutton' href='templates/adminphp/delete.php? id="  . $results["InventoryID"] . " ' onclick='confirmDelete(event)''>Dzēst</a>";
        ?>
            <a href="admin_devices.php">
                    <button class="backbutton">Atgriezties</button>
            </a>
        </div>
        <div class="graph-container">
    <canvas id="deviceUsageGraph"></canvas>
        </div>
<?php
$db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
$data = array();
foreach ($db->query("SELECT End_Date, SUM(Time_Spent) AS TotalTimeSpent FROM Request WHERE InventoryID = $results[InventoryID] GROUP BY End_Date") as $graph) {
    $data[] = array(
        "date" => $graph["End_Date"],
        "timeSpent" => $graph["TotalTimeSpent"]
    );
}
?>
       </div> 
    </div>
</body>

<script>
            // PHP code to retrieve data
        var deviceData = <?php echo json_encode($data); ?>;

        // Filter data for the current month
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth() + 1; 
        var filteredData = deviceData.filter(item => {
            var dateParts = item.date.split("-");
            var month = parseInt(dateParts[1]);
            return month === currentMonth;
        });

        // Sort the filtered data by dates
        filteredData.sort((a, b) => {
            var dateA = new Date(a.date);
            var dateB = new Date(b.date);
            return dateA - dateB;
        });

        // Preparing data for chart
        var chartLabels = filteredData.map(item => item.date);
        var chartData = filteredData.map(item => item.timeSpent);

        // Chart Creation
        var ctx = document.getElementById("deviceUsageGraph").getContext("2d");
        var deviceUsageChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: chartLabels,
                datasets: [{
                    label: "Ierce",
                    data: chartData,
                     backgroundColor: "rgba(3, 146, 91, 0.5)",
                     borderColor: "rgba(3, 146, 91, 1)",
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                  aspectRatio: 0.1, 
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Datums"
                        }
                    },
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        title: {
                            display: true,
                            text: "Kopējais pavadītais laiks minūtēs"
                        }
                    }
                }
            }
        });

  function confirmDelete(event) {
    if (confirm('Vai tiešam vēlaties dzēst ierīces nolietoto Laiku?')) {
    } else {
      event.preventDefault();
    }
  }
</script>

</html>