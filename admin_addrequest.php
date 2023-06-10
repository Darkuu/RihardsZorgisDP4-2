<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/admin/addrequest.css" />
    <link
        rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png"
    />
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
        <form class="Form" action="templates/adminphp/request.php" method="post" onsubmit="return validateTime()">
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

            <div class="checkbox-container">
                <input type="checkbox" id="ShowAllDevices" onchange="toggleDeviceSelection()" />
                <label for="ShowAllDevices">Ārpus Kabineta</label>
            </div>
            
            <div class="txtfield">
                <select name="Room" id="Room" class="option" onchange="filterInventoryOptions()">
                    <option value="" disabled selected hidden>Izvēlies kabinetu</option>
                    <?php
                    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                    foreach ($db->query("SELECT * FROM Room") as $results) {
                        echo "<option value='" . $results["RoomID"] . "'>" . $results["RoomID"] . ' - ' . $results["Name"] . "</option>";
                    }
                    ?>
                </select>
            </div>  

        
            <div class="txtfield">
                <select name="Inventory" id="Inventory" class="option">
                    <option value="" disabled selected hidden>Inventārs</option>
                    <?php
                    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

                    // Fetch all inventory options from the database
                    $inventoryQuery = $db->query("SELECT * FROM Inventory");
                    $inventoryOptions = $inventoryQuery->fetchAll(PDO::FETCH_ASSOC);

                    // Generate the inventory options as HTML
                    foreach ($inventoryOptions as $option) {
                        echo "<option data-roomid='" . $option["RoomID"] . "' value='" . $option["InventoryID"] . "'>" . $option["InventoryID"] . ' - ' . $option["Name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            
            <input type="submit" value="Pievienot" />
            <a href="javascript:history.back()" class="backbutton">Atgriezties</a>

        </form>
    </div>

    <script>
//Inventory Filter thing 
    function filterInventoryOptions() {
        var selectedRoom = document.getElementById("Room").value;
        var inventoryOptions = document.getElementById("Inventory").options;
        document.getElementById("Inventory").selectedIndex = 0;
        for (var i = 0; i < inventoryOptions.length; i++) {
            var option = inventoryOptions[i];
            var roomID = option.getAttribute("data-roomid");

          
            option.style.display = roomID === selectedRoom || selectedRoom === "" ? "block" : "none";
        }
    }
// Make sure time isnt negative.
    function validateTime() {
        var startTime = document.getElementsByName("StartTime")[0].value;
        var endTime = document.getElementsByName("EndTime")[0].value;
        if (startTime >= endTime) {
            alert("Beigu laiks nevar būt agrāks vai vienāds ar sākuma laiku!");
            return false;
        }

        return true;
    }
//Checkmark
    var checkbox = document.getElementById('ShowAllDevices');
    var roomSelect = document.getElementById('Room');
    if (checkbox.checked) {
        roomSelect.disabled = true;
        roomSelect.selectedIndex = -1;
    } else {
        roomSelect.disabled = false;
    }

// Checkmark Selection, makes room selection impossible & set the value to something
function toggleDeviceSelection() {
    var showAllDevicesCheckbox = document.getElementById("ShowAllDevices");
    var roomSelect = document.getElementById("Room");
    var inventorySelect = document.getElementById("Inventory");

    if (showAllDevicesCheckbox.checked) {
        roomSelect.disabled = true;
        roomSelect.selectedIndex = -1;
        roomSelect.classList.add("disabled-select");
        roomSelect.value = "Nav"; 
    } else {
        roomSelect.disabled = false;
        roomSelect.classList.remove("disabled-select");

        var temporaryOption = roomSelect.querySelector('option[value=""]');
        if (!temporaryOption) {
            temporaryOption = document.createElement("option");
            temporaryOption.value = "";
            temporaryOption.disabled = true;
            temporaryOption.selected = true;
            temporaryOption.textContent = "Izvēlies kabinetu";
            roomSelect.appendChild(temporaryOption);
        }
    }
}
    </script>
</body>

</html>