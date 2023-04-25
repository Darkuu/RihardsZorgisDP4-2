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
        <h1>Pievieno Ierīci</h1>
        <form class="Form" action="templates/device.php" method="post">
                <div class="txtfield">
                    <input type="text" name="Name" required />
                    <span></span>
                    <label>Nosaukums</label>
                </div>
                <div class="txtfield">
                    <input type="text" name="Type" required />
                    <span></span>
                    <label>Kabinets</label>
                </div>
            <input type="submit" value="Pievienot" />
            <a href="devices.php">
                <button class="backbutton">Atgriezties</button>
            </a>
        </form>
    </div>
    
</body>
</html>