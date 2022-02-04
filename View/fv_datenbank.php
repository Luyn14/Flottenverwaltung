<?php
require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$sql1 = "SELECT * FROM tSpaceship 
        JOIN tSpaceshiprole ON tSpaceshiprole.SpaceshiproleID=tSpaceship.SpaceshiproleFID
        JOIN tDivision ON tDivision.DivisionID=tSpaceship.DivisionFID
        JOIN tFleet ON tFleet.FleetID=tDivision.FleetFID
        JOIN tDest_Moon ON tDest_Moon.DestmoonID=tSpaceship.DestmoonFID
        JOIN tMoon ON tMoon.MoonID=tDest_Moon.MoonFID
        JOIN tDestination ON tDestination.DestinationID=tDest_Moon.DestinationFID
        ORDER BY SpaceshipID ASC";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM tCrew 
        JOIN tCrewRole ON tCrewRole.CrewroleID=tCrew.CrewroleFID
        JOIN tCrew_Spaceship ON tCrew_Spaceship.CrewFID=tCrew.CrewID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tCrew_Spaceship.SpaceshipFID";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tShipequipment 
        JOIN tSpaceship_Shipequipment ON tSpaceship_Shipequipment.ShipequipmentFID=tShipequipment.ShipequipmentID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Shipequipment.SpaceshipFID
        ORDER BY ShipequipmentID ASC, Equipmentsize ASC, Equipmentamount ASC";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM tCargohold
        JOIN tSpaceship_Cargo ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Cargo.SpaceshipFID";
$result4 = $conn->query($sql4);

$sql5 = "SELECT * FROM tAmmunitionhold
        JOIN tSpaceship_Ammunition ON tSpaceship_Ammunition.AmmunitionholdFID=tAmmunitionhold.AmmunitionholdID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Ammunition.SpaceshipFID";
$result5 = $conn->query($sql5);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="../Controller/javascript.js"></script>
    <title>Datenbank-Übersicht</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center" id="text-underlay-log"> Datenbank </h1>
    </div>
    <div class="container">
        <button type="button" class="btn btn-info" onclick="myCargo()">Cargohold</button>
        <button type="button" class="btn btn-info" onclick="myAmmunition()">Ammunitionhold</button>
        <div id="cargo_style">
            <h1 class="text-center">Fracht</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Shipname</th>
                        <th scope="col">Cargoname</th>
                        <th scope="col">Cargoamount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row4 = $result4->fetch_assoc()) {

                    ?>

                        <tr>
                            <th scope="row"><?php echo $row4['Shipname'] ?></th>
                            <td><?php echo $row4['Cargoname'] ?></td>
                            <td><?php echo $row4['Cargoamount'] ?></td>
                            <td><a href="fv_edit-cargo.php?id=<?php echo $row4['SpaceshipID']; ?>&c_id=<?php echo $row4['CargoholdID']; ?>" class="btn btn-primary">Bearbeiten</a>
                            <td><a href="fv_delete-cargo.php?shipid=<?php echo $row4['SpaceshipID']; ?>&cargoid=<?php echo $row4['CargoholdID']; ?>" class="btn btn-danger">Löschen</a>
                        </tr>

                    <?php

                    }

                    ?>
                </tbody>
            </table>
            <a href="fv_add-cargo.php" class="btn btn-primary">Neue Fracht Hinzufügen</a>
        </div>
        <div id="ammunition_style">
            <h1 class="text-center">Munition</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Shipname</th>
                        <th scope="col">Ammunitionname</th>
                        <th scope="col">Ammunitionamount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row5 = $result5->fetch_assoc()) {

                    ?>

                        <tr>
                            <th scope="row"><?php echo $row5['Shipname'] ?></th>
                            <td><?php echo $row5['Ammunitionname'] ?></td>
                            <td><?php echo $row5['Ammunitionamount'] ?></td>
                            <td><a href="fv_edit-ammo.php?id=<?php echo $row5['SpaceshipID']; ?>&a_id=<?php echo $row5['AmmunitionholdID']; ?>" class="btn btn-primary">Bearbeiten</a>
                            <td><a href="fv_delete-ammo.php?shipid=<?php echo $row5['SpaceshipID']; ?>&ammoid=<?php echo $row5['AmmunitionholdID']; ?>" class="btn btn-danger">Löschen</a>
                        </tr>

                    <?php

                    }

                    ?>
                </tbody>
            </table>
            <a href="fv_add-ammo.php" class="btn btn-primary">Neue Munition hinzufügen</a>
        </div>
    </div>
    <div class="container">
        <br>
        <a href="flottenverwaltung_Login.php" class="btn btn-danger">Zurück</a>

    </div>
</body>

</html>