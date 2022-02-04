<?php

require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$sql1 = "SELECT * FROM tAmmunitionhold ORDER BY AmmunitionholdID ASC;";
$result1 = $conn->query($sql1);

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$isAmmunitionamountValid = True;

if (isset($_GET['Ammunitionamount'])) {
    $isAmmunitionamountValid = $_GET['Ammunitionamount'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Fracht Hinzufügen</title>
    <script src="../Controller/javascript.js"></script>
    <style>
        body {
            background-image: url("");
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>
    <h3 class="text-center"> Neue Munition erfassen </h3>
    <form class="needs-validation" novalidate method="POST" action="../Controller/save-ammo.php">
        <input type="hidden" name="id" value="">
        <label for="Ammunitionname" class="form-label">Ammunitionname</label> <br>
        <select name="Ammunitionname" class="custom-select custom-select-lg mb-3">
            <?php while ($row1 = $result1->fetch_assoc()) { ?>
                <option value="<?php echo $row1['Ammunitionname']; ?>"><?php echo $row1['Ammunitionname']; ?></option>
            <?php } ?>
        </select>
        <div class="mb-3">
            <label for="Ammunitionamount" class="form-label">Ammunitionamount</label>
            <input type="text" class="form-control" id="Ammunitionamount" name="Ammunitionamount" value="" required>
            <?php if ($isAmmunitionamountValid == false) { ?>
                <h6 id="notValid">Keine Munitionsmenge eingetragen!</h6>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="Shipname" class="form-label">Spaceshipname</label> <br>
            <select name="Shipname" class="custom-select custom-select-lg mb-3">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <option value="<?php echo $row2['Shipname']; ?>"><?php echo $row2['Shipname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="fv_datenbank.php" class="btn btn-danger">Zurück</a>
    </form>

</body>