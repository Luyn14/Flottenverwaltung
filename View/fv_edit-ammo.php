<?php

require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$id = 0;
$a_id = $_GET['a_id'];

if (!empty($_GET)) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tSpaceship
            JOIN tSpaceship_Ammunition ON tSpaceship_Ammunition.SpaceshipFID=tSpaceship.SpaceshipID
            JOIN tAmmunitionhold ON tAmmunitionhold.AmmunitionholdID=tSpaceship_Ammunition.AmmunitionholdFID
            WHERE SpaceshipID = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tAmmunitionhold";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM tAmmunitionhold
        JOIN tSpaceship_Ammunition ON tSpaceship_Ammunition.AmmunitionholdFID=tAmmunitionhold.AmmunitionholdID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Ammunition.SpaceshipFID
        WHERE AmmunitionholdID = '$a_id' AND SpaceshipID = '$id'";
$result4 = $conn->query($sql4);
$AmmunitionholdID_ar = $result4->fetch_assoc();
$AmmunitionholdID = $AmmunitionholdID_ar['AmmunitionholdID'];
$Ammunitionamount = $AmmunitionholdID_ar['Ammunitionamount'];
$SpaceshipID = $AmmunitionholdID_ar['SpaceshipID'];

$sql5 = "SELECT * FROM tCrew
        JOIN tCrew_Spaceship ON tCrew_Spaceship.CrewFID=tCrew.CrewID
        JOIn tSpaceship On tSpaceship.SpaceshipID=tCrew_Spaceship.SpaceshipFID
        WHERE CrewID = '$id'";
$result5 = $conn->query($sql5);
$Shipname_ar = $result5->fetch_assoc();
$Shipname = $Shipname_ar['Shipname'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="../Controller/javascript.js"></script>
    <title>Ammunition Bearbeiten</title>
</head>

<body>
    <div class="container">
        <h3 class="text-center"> Ammunition Bearbeiten </h3>
        <form method="POST" class="needs-validation" action="../Controller/edit-ammo.php?aid=<?php echo $a_id ?>&sid=<?php echo $id ?>">
            <div class="mb-3">
                <label for="Shipname" class="form-label">Shipname</label> <br>
                <select name="Shipname" class="custom-select custom-select-lg mb-3" disabled>
                    <?php while ($row2 = $result2->fetch_assoc()) { ?>
                        <option value="<?php echo $row2['SpaceshipID']; ?>" <?php if ($row2['SpaceshipID'] == $SpaceshipID) { ?> selected <?php }; ?>><?php echo $row2['Shipname']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Ammunitionname" class="form-label">Ammunitionname</label> <br>
                <select name="Ammunitionname" class="custom-select custom-select-lg mb-3" disabled>
                    <?php while ($row3 = $result3->fetch_assoc()) { ?>
                        <option value="<?php echo $row3['AmmunitionholdID']; ?>" <?php if ($row3['AmmunitionholdID'] == $AmmunitionholdID) { ?> selected <?php }; ?>><?php echo $row3['Ammunitionname']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="Ammunitionamount" class="form-label">Ammunitionamount</label>
                <input type="text" class="form-control" id="Ammunitionamount" name="Ammunitionamount" value="<?php echo $Ammunitionamount ?>" required>
            </div>
            <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="fv_datenbank.php" class="btn btn-danger">Zurück</a>
        </form>
    </div>

</body>