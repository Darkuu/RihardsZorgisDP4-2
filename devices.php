<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="icon"href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
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
                <a class="nav-link" href="request.php">Pieprasījumi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="devices.php">Inventārs</a>
            <li class="nav-item-left">
                <a class="nav-link" href="users.php">Lietotāji</a>
            </li>
            <li class="nav-item-left">
                <a class="nav-link" href="room.php">Kabineti</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
        <img class="title-image" src="/images/RTUEKA.jpg" alt="..." ></div>
    <?php endif; ?>

    
<!--  HTML Start  -->

<body onLoad="myFunction()">
    

    <table class="table" id="table-request">

        <tr>
            <th>Inventāra Nummurs</th>
            <th>Nosaukums</th>
            <th>Kabinets</th>
        </tr>
        
<!--  PHP | Print values from device table  -->

        <tr id="Values">
        <?php
            $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

            foreach ($db->query("SELECT * FROM inventory") as $results)
            {
                echo "<td>" . $results["InventoryID"] . "</td>";
                echo "<td>" . "<a href='admindevicedescription.php? id="  .  $results["InventoryID"] ." '> $results[Name]</a>" .  "</td>";
                echo "<td>" . $results["RoomID"] . "</tr>" . "</td>";
            }
            
        ?>
        </tr>
    </table>


    <!-- Print Table into a PDF using html2PDF plug-in. -->

<button class="downloadbutton " id="dl-pdf" onclick="PrintPDF()"">Lejupielādēt PDF </button>

<script>
function PrintPDF() {
    var element = document.getElementById('table-request');

    var opt = {
        margin:       1,
        filename:     'Ierices.pdf',
        image:        { type: 'jpeg', quality: 1, },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait', format: [20, 30]},
        
        
        };
        html2pdf().set(opt).from(element).save();
};
</script>


    <!-- Javascript alert if devices have reached their limit -->
<?php
    $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
?>



<script type="text/javascript">''
const TotalTime="<?php echo $results["TotalTime"] ; ?>";
const TimeLimit="<?php echo $results["TimeLimit"] ; ?>";
const InventoryID="<?php echo $results["InventoryID"] ; ?>";
const DeviceLimit="Ierīce ar šo Inventāra nummuru ir pārsinegusi atļauto laiku - "
function myFunction() {

  if( TotalTime > TimeLimit) {
    alert(DeviceLimit +  InventoryID);
    $field.val(InventoryID);
  }
  
};
</script>


    <a href="adddevice.php">
        <button class="addbutton">Pievienot</button>
    </a>
    
    <a href="admincategories.php">
        <button class="categorybutton">Kategorijas</button>
    </a>


</body>
</html>
<style>
    <?php include "css/styles.css"?>
    <?php include "css/devices.css"?>
</style>
