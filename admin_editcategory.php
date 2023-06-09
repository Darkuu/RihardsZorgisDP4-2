<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/General/styles.css" />
    <link rel="stylesheet" href="css/adddcategory.css" />
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
<?php
             $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
             $id = $_GET;
             foreach ($db->query("SELECT * FROM category where ID = $id[id] ") as $results)
        ?>
    <div class="center">
        <h1>Rediģēt Kategoriju</h1>
        <form class="Form" action="templates/editcategory.php" method="post">
            <div name="InventoryID" required">
                <?php
                    echo   "<label>Ierīces ID - ⠀⠀ </label>";    
                    echo "<input class='ID' type='text' name='InventoryID' value='$results[ID]' required readonly />";
                ?>
                </div>
            <div class="txtfield" name="CategoryName" required>
            <input type='text' name='CategoryName' value=''  required />
            <label>Jauns Nosaukums</label>
            </div>

            <input type="submit" value="Pievienot" />
            <a href="admincategories.php">
            </a>
            <button class="backbutton">Atgriezties</button>
        </form>
    </div>
    
</body>
</html>