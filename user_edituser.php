<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/general/styles.css" />
    <link rel="stylesheet" href="css/user/edituser.css" />
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
        <h1>Rediģēt Datus</h1>
        <?php
        $db = new PDO('mysql:host=localhost;dbname=school', 'root', '');
        $id = $_GET['id'];
        $query = $db->prepare("SELECT * FROM user WHERE ID = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        ?>
        <form class="Form" action="templates/userphp/edituser.php" method="post" onsubmit="return validateForm()">
            <div class="ID" name="UserID" required>
                <input type="hidden" name="UserID" value="<?php echo $user['ID']; ?>" />
            </div>
            <div class="txtfield" name="Name" required>
                <input type="text" name="Name" value="<?php echo $user['Name']; ?>" required />
                <label>Vārds</label>
            </div>
            <div class="txtfield" name="Surname" required>
                <input type="text" name="Surname" value="<?php echo $user['Surname']; ?>" required />
                <label>Uzvārds</label>
            </div>
            <div class="txtfield" name="Profession" required>
                <input type="text" name="Profession" value="<?php echo $user['Profession']; ?>" required />
                <label>Profesija</label>
            </div>
            <div class="txtfield" name="Email" required>
                <input type="email" name="Email" value="<?php echo $user['Email']; ?>" required />
                <label>E-pasts</label>
            </div>
            <div class="txtfield" name="Password" required>
                <input type="password" name="Password" required />
                <label>Jaunā parole</label>
            </div>
            <input type="submit" value="Saglabāt" />
            <a href="admin_edituser.php">
                <button class="backbutton">Atgriezties</button>
            </a>
        </form>
    </div>
</body>
</html>