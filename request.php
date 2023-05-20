<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/request.css" />
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>RTU Uzskaite</title>
</head>
<!-- Navbar Function -->
    <?php
        if(isset($_COOKIE['user']) == '' ):  
            ?>
    <?php else: ?>

            <!-- Logged in  -->
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



        <!-- HTML -->
        <body>

        <input  class="searchbar" type="text" id="SearchBar" onkeyup="SearchFunction()" placeholder="Meklēt pēc nosaukuma..."> 
<table class="table" id="table-request">
    <tr>
        <th>Inventara Nr.</th>
        <th>Telpas Nr.</th>
        <th>Datums</th>   
        <th>Sakuma un Beigu Laiks</th>   
        <th>Pavadītais Laiks <br> (minūtēs)</th>   
    </tr>
    <tr id="Values">
        <?php

        $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');

        foreach ($db->query("SELECT * FROM Request " ) as $results)
        {
        echo "<td>" . $results["InventoryID"] . "</td>";
        echo "<td>" . $results["RoomID"] . "</td>";
        echo "<td>" . $results["End_Date"] . "</td>";
        echo "<td>" . $results["VisibleStartTime"] . " - "  . $results["VisibleEndTime"] .  "</td>";
        echo "<td>" . $results["Time_Spent"]  .  "</td>";
        echo "<td style='width:5vw' >" . "<a class='deletebutton' href='templates/requestdelete.php? id="  . $results["ID"] . " '>Dzēst</a>" . "</tr>" . "</td>";
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
        filename:     'Pieprasijumi.pdf',
        image:        { type: 'jpeg', quality: 1, },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait', format: [20, 30]},
        };
        html2pdf().set(opt).from(element).save();
};
</script>

<!-- Search Bar Function -->
<script>
function SearchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("SearchBar");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-request");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>



<a href="addrequest.php">
    <button class="addbutton">Pievienot</button>
</a>
</body>
</html>