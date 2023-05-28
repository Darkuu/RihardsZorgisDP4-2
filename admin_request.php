<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/admin/request.css" />
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
                <a class="nav-link" href="admin_rooms.php">Kabineti</a>
            </li>
            <li class="nav-item-left">
            <button class="nav-link"  onclick="location.href='templates/exit.php';">Atslēgties</button>
            </li>
        </ul>
    <?php endif; ?>

        <!-- HTML -->
        <body>
        <input  class="searchbar" type="text" id="SearchBar" onkeyup="SearchFunction()" placeholder="Ievadi tekstu..."> 
            <!-- Dropdown Selection for the table categories-->
  <select class="DropDown" id="myDropdown" onchange="handleDropdownChange()">
    <option value="0">Izvēlies Kategoriju</option>
    <option value="0">Inventāra NR</option>
    <option value="1">Telpas NR</option>
    <option value="2">Datums</option>
    <option value="4">Pavaditais laiks</option>
  </select>

<table class="table" id="table-request">

    <tr>
        <th>Inventara Nr.</th>
        <th>Telpas Nr.</th>
        <th>Datums</th>   
        <th>Sākuma un Beigu Laiks</th>   
        <th>Pavadītais Laiks <br> (minūtēs)</th>   
    </tr>
    <tr id="Values">
        <?php $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
        foreach ($db->query("SELECT * FROM Request " ) as $results)
        {
        echo "<td>" . $results["InventoryID"] . "</td>";
        echo "<td>" . $results["RoomID"] . "</td>";
        echo "<td>" . $results["End_Date"] . "</td>";
        echo "<td>" . substr($results["VisibleStartTime"], 0, 5) . " - " . substr($results["VisibleEndTime"], 0, 5) . "</td>";
        echo "<td>" . $results["Time_Spent"] . "</td>";
        echo "<td style='width:5vw'>" . "<a class='deletebutton' href='templates/adminphp/requestdelete.php? id=" . $results["ID"] . "' onclick='confirmDelete(event)'>Dzēst</a>"  . "</tr>" . "</td>";
      }
            ?>
        </tr>
</table>
 </div>
<a href="admin_addrequest.php">
    <button class="addbutton">Pievienot</button>
</a>

<!-- Print Table into a PDF using html2PDF plug-in. -->

<button class="downloadbutton" id="dl-pdf" onclick="PrintPDF()"">Lejupielādēt PDF </button>

<script>
function PrintPDF() {
  var element = document.getElementById('table-request');
  var currentDate = new Date().toLocaleDateString(); // Get the current date
  var filename = 'Pieprasijumi_' + currentDate + '.pdf'; 
  var title = 'Pieprasījumu datu tabula - ' + currentDate; 
  var opt = {
    margin: 1,
    filename: filename, 
    title: title, 
    image: { type: 'jpeg', quality: 1 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait', format: [15, 20] },
  };

  // Table clone creation
  var tableClone = element.cloneNode(true);
  tableClone.style.display = 'table';
  tableClone.style.height = '100%'; // Set the width to fit the PDF

  // Title
  var titleElement = document.createElement('h1');
  titleElement.textContent = title;

  // Temporary element
  var tempElement = document.createElement('div');
  tempElement.style.width = '100%'; 
  tempElement.appendChild(titleElement);
  tempElement.appendChild(tableClone);

  html2pdf().set(opt).from(tempElement).save();
}


// Search bar category fucntion
  var selectedValue = ''; 

function handleDropdownChange() {
  var dropdown = document.getElementById("myDropdown");
  selectedValue = dropdown.options[dropdown.selectedIndex].value;
  console.log(selectedValue);
}
    
 // Confirmation for deletion
 function confirmDelete(event) {
    if (confirm('Vai tiešam vēlaties dzēst?')) {
    } else {
      event.preventDefault();
    }
  }

// Search function itself.
function SearchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("SearchBar");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-request");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[selectedValue];
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

</body>
</html>