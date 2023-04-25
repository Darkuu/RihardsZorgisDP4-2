<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/adduser.css" />
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
        <form class="Form" action="templates/user.php" method="post">
                <div class="txtfield">
                    <input type="text" name="PersonasKods" required />
                    <span></span>
                    <label>Personas Kods</label>
                </div>
                <div class="txtfield">
                    <input type="text" name="Vards" required />
                    <span></span>
                    <label>Vards</label>
                </div>
                <div class="txtfield">
                    <input type="text" name="Uzvards" required />
                    <span></span>
                    <label>Uzvards</label>
                </div>
                <div class="txtfield">
                    <input type="text" name="Profesija" required />
                    <span></span>
                    <label>Profesija</label>
                </div> 
                <div class="txtfield">
                    <input type="text" name="Epasts" required />
                    <span></span>
                    <label>Epasts</label>
                </div>
                <div class="txtfield">
                    <input type="text" name="Parole" required />
                    <span></span>
                    <label>Parole</label>
                </div>
            <input type="submit" value="Pievienot" />
            <a href="users.php">
                <button class="backbutton">Atgriezties</button>
            </a>
        </form>
    </div>
    
</body>
</html>