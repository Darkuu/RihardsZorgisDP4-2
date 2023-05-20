<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/adddevice.css" />
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/lv/thumb/f/fd/RTU_logo_2017.svg/1232px-RTU_logo_2017.svg.png" />
    <title>RTU Uzskaite</title>
</head>

<!-- Navbar Creation PHP code -->

 <?php
        if(isset($_COOKIE['user']) == ''): 
            header("Location: index.html");
            ?>
    
    <?php else: ?>  
    <?php endif; ?>     

<!-- HTML -->

<body>

    <div class="center">
        <h1>Rediģet Inventāru</h1>
        <?php
             $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
             $id = $_GET;
             foreach ($db->query("SELECT * FROM inventory where InventoryID = $id[id] ") as $results)
        ?>
        <form class="Form" action="templates/edit.php" method="post">
            
        <div class="ID" name="InventoryID" required">
                <?php
            echo   "<label>Ierīces ID</label>";    
            echo "<input type='text' name='InventoryID' value='$results[InventoryID]' required readonly />";
             ?>

            <div class="txtfield" name="Name" required">
                <?php
            echo "<input type='text' name='name' value='$results[Name]'  required />";
            echo   "<label>Nosaukums</label>";
             ?>
            </div>
             <div class="txtfield" name="Description" required>
             <?php
                echo "<input type='text' name='Description' value='$results[Description]'  required />";
                echo "<label>Apraksts</label>";
                ?>
             </div>
             
            <div  name="TimeLimit" class="txtfield" required>
             <?php
                echo "Laika Limits stundās";
                echo "<input type='number' name='TimeLimit' value='$results[TimeLimit]'  required />";
                ?>
             </div>

            <div class="txtfield">
                <select name="Room" id="Room" class="option">
                ?>
                    <option value="" disabled selected hidden>Kabinets</option>
                        <?php
                        $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                        foreach ($db->query("SELECT * FROM Room") as $results)
                        {
                            echo "<option>" . $results["RoomID"]  . "</option>";
                        }
                        ?>
                    </select>
               
            </div>

            <div class="txtfield">
                <select name="Category" id="Category" class="option">
                    <option value="" disabled selected hidden>Kategorija</option>
                        <?php
                        $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
                        foreach ($db->query("SELECT * FROM Category") as $results)
                        {
                            echo "<option>" . $results["Name"] . "</option>";
                        }
                        ?>
            </div>


            <input type="submit" value="Pievienot" />
            <a href="edit.php">
                <button class="backbutton">Atgriezties</button>
            </a>
        </form>
    </div>
    
</body>
</html>